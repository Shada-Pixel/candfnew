<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    private $apiToken;
    private $sid;
    private $baseUrl;

    public function __construct()
    {
        $this->apiToken = env('SSL_SMS_API_TOKEN');
        $this->sid = env('SSL_SMS_SID');
        $this->baseUrl = env('SSL_SMS_BASE_URL');
    }

    /**
     * Send a Single SMS
     */
    public function sendSingleSms($to, $message)
    {
        $url = $this->baseUrl . "/send-sms";
        $response = Http::post($url, [
            'api_token' => $this->apiToken,
            'sid' => $this->sid,
            'msisdn' => $to,
            'sms' => $message,
            'csms_id' => bin2hex(random_bytes(10)),
        ]);

        $data = $response->json();

        if ($data['status_code'] !== 200) {
            return [
                'success' => false,
                'message' => $data['message'] ?? 'An error occurred'
            ];
        }

        return [
            'success' => true,
            'message' => 'SMS sent successfully',
            'response' => $data
        ];
    }

    /**
     * Send Bulk SMS
     */
    public function sendBulkSms(array $recipients, $message)
    {
        $url = $this->baseUrl . "/send-sms/bulk";
        $response = Http::post($url, [
            'api_token' => $this->apiToken,
            'sid' => $this->sid,
            'msisdn' => $recipients,
            'sms' => $message,
            'batch_csms_id' => bin2hex(random_bytes(10)),
        ]);

        return $response->json();
    }

    /**
     * Send Dynamic SMS (Different Message for Each Recipient)
     */
    public function sendDynamicSms(array $messages)
    {
        $url = $this->baseUrl . "/send-sms/dynamic";
        $response = Http::post($url, [
            'api_token' => $this->apiToken,
            'sid' => $this->sid,
            'sms' => $messages,
        ]);

        return $response->json();
    }



    // {"success":true,"message":"SMS sent successfully","response":{"status":"SUCCESS","status_code":200,"error_message":"","smsinfo":[{"sms_status":"SUCCESS","status_message":"Success","msisdn":"8801956113999","sms_type":"EN","sms_body":"test message","csms_id":"4473433434pZ684333392","reference_id":"67cc09279e2a8156495"}]}}
}
