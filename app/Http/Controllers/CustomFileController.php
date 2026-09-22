<?php

namespace App\Http\Controllers;

use App\Models\CustomFile;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomFileRequest;
use App\Http\Requests\UpdateCustomFileRequest;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class CustomFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $user = auth()->user();

            $query = CustomFile::query()
                ->select([
                    'id',
                    'name',
                    'be_number',
                    'fees',
                    'type',
                    'status',
                    'year',
                    'created_at',
                ]);

            /*
            |--------------------------------------------------------------------------
            | Role Control
            |--------------------------------------------------------------------------
            |
            | payunpay + checker can only see Unpaid files.
            |
            */
            if (
                $user->hasRole('payunpay') ||
                $user->hasRole('checker')
            ) {
                $query->where('status', 'Unpaid');
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()

                /*
                |--------------------------------------------------------------------------
                | Status
                |--------------------------------------------------------------------------
                */
                ->addColumn('status_column', function ($row) use ($user) {

                    // Checker should never receive/display status
                    if ($user->hasRole('checker')) {
                        return '';
                    }

                    $class = $row->status === 'Unpaid'
                        ? 'text-red-400'
                        : 'text-green-600';

                    return '
                        <button
                            type="button"
                            onclick="toggleStatus(' . $row->id . ')"
                            class="status-btn cursor-pointer hover:opacity-75 transition-opacity ' . $class . '"
                            data-id="' . $row->id . '"
                        >
                            ' . e($row->status) . '
                        </button>
                    ';
                })

                /*
                |--------------------------------------------------------------------------
                | Action
                |--------------------------------------------------------------------------
                |
                | payunpay + checker should not receive action column.
                |
                */
                ->addColumn('action', function ($row) use ($user) {

                    if (
                        $user->hasRole('payunpay') ||
                        $user->hasRole('checker')
                    ) {
                        return '';
                    }

                    return '
                        <div class="flex justify-end items-center gap-2">

                            <a
                                class="text-seagreen/70 hover:text-seagreen hover:scale-105 transition duration-150 ease-in-out text-2xl"
                                href="' . route('customfiles.edit', $row->id) . '"
                            >
                                <span class="menu-icon">
                                    <i class="mdi mdi-table-edit"></i>
                                </span>
                            </a>

                            <a
                                href="' . route('customfiles.destroy', $row->id) . '"
                                class="text-red-500/70 hover:text-red hover:scale-105 transition duration-150 ease-in-out text-2xl"
                                onclick="event.preventDefault(); document.getElementById(\'delete-form-' . $row->id . '\').submit();"
                            >
                                <span class="menu-icon">
                                    <i class="mdi mdi-delete"></i>
                                </span>
                            </a>

                            <form
                                id="delete-form-' . $row->id . '"
                                action="' . route('customfiles.destroy', $row->id) . '"
                                method="POST"
                                style="display:none;"
                            >
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                            </form>

                        </div>
                    ';
                })

                ->rawColumns([
                    'status_column',
                    'action',
                ])

                ->make(true);
        }

        return view('admin.customfiles.index');
    }



    // public function index()
    // {
    //     // Retrieve all CustomFile records from the database and order by status
    //     // and then by created_at in descending order
    //     $customFiles = CustomFile::orderBy('status', 'desc')
    //         ->get();

    //     //If auth user have checker or payunpay role then redirect him to custom file page
    //     if (auth()->user()->hasRole('payunpay')|| auth()->user()->hasRole('checker')) {
    //         $customFiles = CustomFile::where('status', 'Unpaid')
    //         ->get();
    //     }

    //     // Return a view with the list of CustomFiles
    //     return view('admin.customfiles.index', compact('customFiles'));
    // }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customFiles = CustomFile::where('year', date('Y') - 1)
            ->orderBy('status', 'desc')
            ->get();

        //If auth user have checker or payunpay role then redirect him to custom file page
        if (auth()->user()->hasRole('payunpay')|| auth()->user()->hasRole('checker')) {
            $customFiles = CustomFile::where('year', date('Y') - 1)
            ->where('status', 'Unpaid')
            ->get();
        }
        $totalUnpaidFiles = CustomFile::where('year', date('Y') - 1)
        ->where('status', 'Unpaid')
        ->count();
        $totalPaidFiles = CustomFile::where('year', date('Y') - 1)
        ->where('status', 'Paid')
        ->count();
        $totalUnpaidAmount = CustomFile::where('year', date('Y') - 1)
        ->where('status', 'Unpaid')
        ->sum('fees');
        $totalPaidAmount = CustomFile::where('year', date('Y') - 1)
        ->where('status', 'Paid')
        ->sum('fees');
        $totalFiles = CustomFile::where('year', date('Y') - 1)
        ->count();
        // Return a view to display the form for creating a new CustomFile
        return view('admin.customfiles.create', compact(
            'customFiles',
            'totalUnpaidFiles',
            'totalPaidFiles',
            'totalUnpaidAmount',
            'totalPaidAmount',
            'totalFiles'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomFileRequest $request)
    {
        try {
            if ($request->hasFile('excel_file')) {
                $file = $request->file('excel_file');

                // Use Laravel Excel to import the file
                $data = Excel::toArray([], $file);

                // Process each row from the first sheet
                foreach ($data[0] as $index => $row) {
                    // Skip header row
                    if ($index === 0) continue;

                    // Only process non-empty rows
                    if (!empty(array_filter($row))) {
                        // Set fees based on type (IM/EX)
                        $type = trim(strtoupper($row[5] ?? '')); // Convert to uppercase and trim
                        $fees = $type === 'IM' ? 600 : ($type === 'EX' ? 500 : null);

                        // Search for matching agent by name
                        $agentain = trim($row[2] ?? '');
                        $agent = null;
                        if ($agentain) {
                            $agent = Agent::where('ain_no', 'LIKE', '%' . $agentain . '%')
                                        ->first();
                        }
                        // Setting the date
                        $date = $row[4] ?? null;
                        if ($date) {
                            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
                            $date = $date->format('Y-m-d');
                        }

                        CustomFile::create([
                            'name' => $row[1] ?? null,
                            'be_number' => $row[3] ?? null,
                            'fees' => $fees, // Use calculated fees
                            'type' => $type,
                            'status' => 'Unpaid',
                            'date' => $date,
                            'agent_id' => $agent ? $agent->id : null,
                            'year' => date('Y')
                        ]);
                    }
                }
                return redirect()->route('customfiles.index')->with('success', 'Data imported successfully.');
            } else {
                // Manual Entry
                $type = $request->type;
                if($request->fees){
                    $fees = $request->fees;
                }else{
                    $fees = $type === 'IM' ? 600 : ($type === 'EX' ? 500 : null);
                }

                $agent = null;
                if ($request->agentain) {
                    $agent = Agent::where('name', $request->agentain)->first();
                }

                $date = $request->date;
                if ($date) {
                    $date = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
                }

                CustomFile::create([
                    'name' => $agent->name,
                    'be_number' => $request->be_number,
                    'fees' => $fees,
                    'type' => $type,
                    'status' => 'Unpaid',
                    'date' => $date,
                    'year' => $request->year ?? date('Y'),
                    'agent_id' => $agent ? $agent->id : null
                ]);

                if($request->year){
                    return redirect()->route('customfiles.create')->with('success', 'Custom file created successfully.');
                }

                return redirect()->route('customfiles.index')->with('success', 'Custom file created successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing request: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomFile $customFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($customFile)
    {
        $customFile = CustomFile::find($customFile);
        $agents = Agent::orderBy('name')->get();
        return view('admin.customfiles.edit', compact('customFile', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomFileRequest $request, $customFile)
    {
        $customFile = CustomFile::find($customFile);

        try {
            // Set fees based on type if it's changed
            if ($request->type !== $customFile->type) {
                $request->merge([
                    'fees' => $request->type === 'IM' ? 600 : 500
                ]);
            }

            $customFile->update($request->validated());

            if($request->year){
                return redirect()->route('customfiles.create')->with('success', 'Custom file updated successfully.');
            }

            return redirect()->route('customfiles.index')
                ->with('success', 'Custom file updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating custom file: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $customFile)
    {
        $customFile = CustomFile::find($customFile);
        try {
            $customFile->delete();
            return redirect()->route('customfiles.index')
                ->with('success', 'Custom file deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting custom file: ' . $e->getMessage());
        }
    }

    /**
     * Toggle the status of the custom file between Paid and Unpaid
     */
    public function toggleStatus($id)
    {
        try {
            $customFile = CustomFile::with('agent')->findOrFail($id);

            // Only allow changing from Unpaid to Paid
            if ($customFile->status === 'Paid') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot change status from Paid to Unpaid'
                ]);
            }

            $customFile->status = 'Paid';
            $customFile->save();

            return response()->json([
                'success' => true,
                'status' => $customFile->status,
                'agent_id' => $customFile->agent ? $customFile->agent->id : null,
                'agent_name' => $customFile->agent ? $customFile->agent->name : null,
                'type' => $customFile->type,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete all paid custom files older than 2 years
     */
    public function clearOld()
    {
        try {
            $twoYearsAgo = now()->subYears(2);

            // Find and delete old paid records
            $deletedCount = CustomFile::where('status', 'Paid')
                ->where('updated_at', '<', $twoYearsAgo)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => $deletedCount . ' old paid records have been deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting old records: ' . $e->getMessage()
            ], 500);
        }
    }
}
