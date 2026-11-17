<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Ie_data;
use App\Models\File_data;
use App\Helpers\LogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Http\Requests\UpdateFile_dataRequest;

class FileDataController extends Controller
{
    private const LODGEMENT_MAX = 94020;

    public function index()
    {
        //
    }

    public function create()
    {
        return view('admin.file_datas.create', $this->formData());
    }

    public function createin()
    {
        return view('admin.file_datas.createin', $this->formData());
    }

    /**
     * Shared data for create / createin (was duplicated).
     */
    private function formData(): array
    {
        $year = Carbon::now()->year;
        $file_data = File_data::with('agent')->latest('id')->first();

        $next_lodgement_no = $this->nextLodgementNo($file_data);

        $lastagent = $file_data?->agent?->name;
        $lastagent_id = $file_data?->agent?->id;

        $agents = Agent::select('id', 'name', 'ain_no')->orderBy('name')->get();

        return compact('next_lodgement_no', 'file_data', 'lastagent', 'lastagent_id', 'agents', 'year');
    }

    /**
     * Single source of truth for the lodgement number.
     * Resets to 1 on a new year or after LODGEMENT_MAX.
     * FIX: store() previously ignored the year reset that create() applied.
     */
    private function nextLodgementNo(?File_data $latest): int
    {
        if (!$latest || $latest->created_at->year !== Carbon::now()->year) {
            return 1;
        }

        $current = (int) $latest->lodgement_no;

        return $current >= self::LODGEMENT_MAX ? 1 : $current + 1;
    }

    private function calculateItems($pages): int
    {
        $pages = (int) $pages;

        return $pages > 1 ? (int) ceil(($pages - 1) / 3 + 1) : 1;
    }

    public function store(Request $request)
    {
        $request->validate([
            'be_number' => [
                'nullable',
                'regex:/^\d+$/',   // FIX: digits_between:1,999999 was a length range, not a sensible rule
                'max:20',
                Rule::unique('file_datas', 'be_number')->where(
                    fn ($q) => $q->whereBetween('created_at', [
                        now()->startOfYear(),
                        now()->endOfYear(),
                    ])
                ),
            ],
            'manifest_no'     => ['required', 'string', 'max:50'],
            'page'            => ['nullable', 'integer', 'min:1'],
            'agentain'        => ['nullable', 'string', 'max:50'],
            'impexp'          => ['nullable', 'string', 'max:255'],
        ], [
            'be_number.regex'  => 'The BE number must contain digits only.',
            'be_number.unique' => 'This BE number already exists for this year.',
        ]);

        $agent_id = $request->filled('agentain')
            ? Agent::where('name', $request->agentain)->value('id')
            : null;

        $ie_data_id = $request->filled('impexp')
            ? Ie_data::where('name', $request->impexp)->value('id')
            : null;

        // FIX: lock + transaction so two simultaneous requests can't get the same lodgement number
        $file_data = DB::transaction(function () use ($request, $agent_id, $ie_data_id) {
            $latest = File_data::latest('id')->lockForUpdate()->first();

            $file_data = new File_data();
            $file_data->be_date         = $request->be_date;
            $file_data->lodgement_date  = $request->lodgement_date;
            $file_data->manifest_date   = $request->manifest_date;
            $file_data->lodgement_no    = $this->nextLodgementNo($latest);
            $file_data->manifest_no     = $request->manifest_no;

            if ($request->filled('be_number')) {
                $file_data->be_number = $request->be_number;
            }
            if ($request->filled('page')) {
                $file_data->page = (int) $request->page;
                $file_data->no_of_items = $this->calculateItems($request->page);
            }
            if ($agent_id) {
                $file_data->agent_id = $agent_id;
            }
            if ($ie_data_id) {
                $file_data->ie_data_id = $ie_data_id;
            }

            $file_data->status = 'Received';
            $file_data->reciver_id = Auth::id();
            $file_data->save();

            return $file_data;
        });

        if (Auth::user()->hasRole('extra') && $request->filled('be_number')) {
            if (!$file_data->sms_sent) {
                $smsSent = $this->sendRegistrationSms($file_data);

                $file_data->status = 'Printed';
                $file_data->sms_sent = $smsSent;
                $file_data->save();
            }

            // FIX: $agent, $agent_email, $ie_name were undefined (fatal error)
            $this->sendRegistrationEmail($file_data);

            return redirect()->route('file_datas.show', $file_data->id)
                ->with(['status' => 200, 'message' => 'File Received and Printed!']);
        }

        return redirect()->route('file_datas.createin')
            ->with(['status' => 200, 'message' => 'File Received!']);
    }

    public function show(File_data $file_data)
    {
        // FIX: previously overwrote ANY status (e.g. "Delivered") with "Printed" on every view
        if (Auth::user()->hasRole('extra') && $file_data->status === 'Received') {
            $file_data->status = 'Printed';
            $file_data->save();
        }

        return view('admin.file_datas.show', compact('file_data'));
    }

    public function edit(File_data $file_data)
    {
        $year = Carbon::now()->year;
        $file_data->load(['ie_data', 'agent']); // FIX: removed redundant re-query

        return view('admin.file_datas.edit', compact('file_data', 'year'));
    }

    public function update(UpdateFile_dataRequest $request, File_data $file_data)
    {
        // FIX: $agent_id / $ie_data_id were undefined when not supplied; now read from the model
        if ($request->filled('agentain')) {
            $agent_id = Agent::where('name', $request->agentain)->value('id');
            if ($agent_id) {
                $file_data->agent_id = $agent_id;
            }
        }

        if ($request->filled('impexp')) {
            $ie_data = Ie_data::firstOrCreate(
                ['name' => $request->impexp],
                ['ie' => 'Import']
            );
            $file_data->ie_data_id = $ie_data->id;
        }

        $file_data->no_of_items    = $this->calculateItems($request->page);
        $file_data->lodgement_no   = $request->lodgement_no;
        $file_data->manifest_no    = $request->manifest_no;
        $file_data->be_date        = $request->be_date;
        $file_data->lodgement_date = $request->lodgement_date;
        $file_data->manifest_date  = $request->manifest_date;
        $file_data->ie_type        = $request->ie_type;
        $file_data->group          = $request->group;
        $file_data->goods_name     = $request->goods_name;
        $file_data->goods_type     = $request->goods_type;
        $file_data->be_number      = $request->be_number;
        $file_data->page           = $request->page;
        $file_data->fees           = $request->fees;
        $file_data->status         = 'Delivered';
        $file_data->delivered_at   = Carbon::now();

        if (Auth::user()->hasRole('operator')) {
            $file_data->deliverer_id = Auth::id(); // FIX: merged into the single save (was a 4th save)
        }

        $file_data->save();

        if (!$file_data->sms_sent) {
            $file_data->sms_sent = $this->sendRegistrationSms($file_data);
            $file_data->save();
        }

        $this->sendRegistrationEmail($file_data);

        if (Auth::user()->hasRole('operator')) {
            return redirect()->route('dashboard')
                ->with(['status' => 200, 'message' => 'File Operated and Delivered!']);
        }

        return redirect()->route('file_datas.show', $file_data->id);
    }

    public function destroy(File_data $file_data)
    {
        if (!Auth::user()->can('delete', $file_data)) {
            return redirect()->back()->with(['status' => 403, 'message' => 'Unauthorized to delete this file.']);
        }

        try {
            $be_number = $file_data->be_number;
            $file_data->delete();

            // FIX: log only after the delete actually succeeded
            LogHelper::log(
                action: "File Data Deleted",
                description: "File Data with BE number: {$be_number} was deleted",
                log_type: 'delete'
            );

            // FIX: index() is empty (returns nothing), so redirect to a page that renders
            return redirect()->route('dashboard')
                ->with(['status' => 200, 'message' => 'File deleted successfully!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 500, 'message' => 'Error deleting file: ' . $e->getMessage()]);
        }
    }

    /**
     * Send the notification email to the agent. Never throws.
     */
    private function sendRegistrationEmail(File_data $file_data): void
    {
        $file_data->loadMissing(['agent', 'ie_data']);

        $agent = $file_data->agent;
        $agent_email = $agent?->email;

        if (!$agent || empty($agent_email)) {
            return;
        }

        try {
            Mail::send('emails.file_notification', [
                'be_number'     => $file_data->be_number,
                'be_date'       => $file_data->be_date,
                'ie_name'       => $file_data->ie_data?->name ?? 'N/A',
                'manifest_no'   => $file_data->manifest_no,
                'manifest_date' => $file_data->manifest_date,
                'agent_name'    => $agent->name,
            ], function ($message) use ($agent_email, $agent) {
                $message->to($agent_email, $agent->name)
                    ->subject('File Registration Notification - Benapole C&F Agents Association');
            });

            $this->safeLog("Email Sent", "Email notification sent to agent {$agent->name} at {$agent_email}", 'email');
        } catch (\Throwable $e) {
            $this->safeLog("Email Failed", "Failed to send email to {$agent_email}: " . $e->getMessage(), 'error');
        }
    }

    /**
     * Send registration SMS to the agent.
     * Never throws: returns true on success, false on any failure.
     */
    private function sendRegistrationSms(File_data $file_data): bool
    {
        $agentPhone = 'Unknown';

        try {
            $file_data->loadMissing(['agent', 'ie_data']);
            $agent = $file_data->agent;

            if (!$agent || empty($agent->phone)) {
                $this->safeSmsLog("SMS Skipped", "Agent not found or has no phone (agent_id: {$file_data->agent_id})");
                return false;
            }

            $agentPhone = $agent->phone;
            $ieName = $file_data->ie_data?->name ?? 'N/A';

            // FIX: use saved model values, not raw request input
            $smsText = 'Benapole C&F Agents Association, Your register B/E No: ' . $file_data->be_number
                . ' Date:' . $file_data->be_date
                . ' Im/Ex: ' . $ieName
                . ', Manifest No: ' . $file_data->manifest_no
                . ' Date:' . $file_data->manifest_date
                . '. Thank you.';

            $response = Http::connectTimeout(5)
                ->timeout(10)
                ->post(config('services.ssl_sms.base_url'), [
                    'api_token' => config('services.ssl_sms.api_token'),
                    'sid'       => config('services.ssl_sms.sid'),
                    'msisdn'    => $agentPhone,
                    'sms'       => $smsText,
                    'csms_id'   => bin2hex(random_bytes(10)),
                ]);

            $responseData = $response->json() ?? ['raw' => $response->body()];

            $status        = $responseData['status'] ?? 'FAILED';
            $statusCode    = $responseData['status_code'] ?? 'Unknown';
            $statusMessage = $responseData['error_message'] ?? 'No error message';

            $this->safeSmsLog(
                "SMS Sent to $agentPhone",
                "Status: $status, Code: $statusCode, Message: $statusMessage",
                $responseData
            );

            // FIX: strict === 200 failed when the API returned "200" as a string
            return (int) $statusCode === 200;
        } catch (\Throwable $e) {
            $this->safeSmsLog("SMS Failed to $agentPhone", "Exception: " . $e->getMessage(), ['error' => $e->getMessage()]);
            return false;
        }
    }

    private function safeSmsLog(string $action, string $description, $responseData = null): void
    {
        $this->safeLog($action, $description, 'sms', $responseData);
    }

    /**
     * Logging that can never break the caller.
     */
    private function safeLog(string $action, string $description, string $type, $responseData = null): void
    {
        try {
            LogHelper::log(
                action: $action,
                description: $description,
                log_type: $type,
                responseData: $responseData
            );
        } catch (\Throwable $e) {
            Log::error('Log failed: ' . $e->getMessage());
        }
    }
}
