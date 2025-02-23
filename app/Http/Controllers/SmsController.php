<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SmsService;

class SmsController extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    //
    public function sendSms()
    {
        return view('admin.sm.sendSms');
    }

    /**
     * Send a Single SMS
     */
    public function sendSingleSms(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'message' => 'required',
        ]);

        $csmsId = uniqid(); // Generate a unique ID for the SMS
        $response = $this->smsService->sendSingleSms($request->phone, $request->message, $csmsId);

        return response()->json($response);
    }

    /**
     * Send Bulk SMS
     */
    public function sendBulkSms(Request $request)
    {
        $request->validate([
            'phones' => 'required|array',
            'message' => 'required',
        ]);

        $batchCsmsId = uniqid();
        $response = $this->smsService->sendBulkSms($request->phones, $request->message, $batchCsmsId);

        return response()->json($response);
    }

    /**
     * Send Dynamic SMS
     */
    public function sendDynamicSms(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
        ]);

        $response = $this->smsService->sendDynamicSms($request->messages);

        return response()->json($response);
    }
}
