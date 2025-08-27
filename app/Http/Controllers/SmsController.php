<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SmsService;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendSms()
    {
        return view('admin.sms.sendSms');
    }

    /**
     * Send a Single SMS
     */
    public function sendSingleSms(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'regex:/^01[0-9]{9}$/'],
            'message' => 'required|string|max:480',
        ]);

        $sendSMS = Http::post(env('SSL_SMS_BASE_URL'), [
            'api_token' => env('SSL_SMS_API_TOKEN'),
            'sid' => env('SSL_SMS_SID'),
            'msisdn' => $request->phone,
            'sms' => $request->message,
            'csms_id' => bin2hex(random_bytes(10)),
        ]);

        $responseData = $sendSMS->json();

        // Extract status for logging
        $status = $responseData['status'] ?? 'FAILED';
        $statusCode = $responseData['status_code'] ?? 'Unknown';
        $statusMessage = $responseData['error_message'] ?? 'No error message';

        // Log the SMS response
        LogHelper::log(
            action: "SMS Sent to $agent_phone",
            description: "Type: Single SMS, Status: $status, Code: $statusCode, Message: $statusMessage, Text: $request->message",
            log_type: 'sms',
            responseData: $responseData
        );

        return response()->json($sendSMS);
    }

    /**
     * Send Bulk SMS
     */
    public function sendBulkSms(Request $request)
    {
        $request->validate([
            'phones' => 'required|string',
            'message' => 'required|string|max:480',
        ]);

        // Convert phone numbers by adding 88 prefix
        // $phones = array_map(function($phone) {
        //     $phone = trim($phone);
        //     return $phone;
        // }, explode(',', $request->phones));

        $response = $this->smsService->sendBulkSms($phones, $request->message);
        return response()->json($response);
    }

    /**
     * Send Dynamic SMS
     */
    public function sendDynamicSms(Request $request)
    {
        $request->validate([
            'msisdn' => 'required|array',
            'msisdn.*' => ['required', 'regex:/^01[0-9]{9}$/'],
            'text' => 'required|array',
            'text.*' => 'required|string|max:480',
        ]);

        $messages = array_map(function($phone, $text) {
            // Add 88 prefix to the phone number
            $phone = '88' . $phone;
            return ['msisdn' => $phone, 'text' => $text];
        }, $request->msisdn, $request->text);

        $response = $this->smsService->sendDynamicSms($messages);
        return response()->json($response);
    }
}
