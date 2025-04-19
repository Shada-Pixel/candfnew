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
        $url = $this->baseUrl;

        $response = Http::post($url, [
            'api_token' => $this->apiToken,
            'sid' => $this->sid,
            'msisdn' => $to,
            'sms' => $message,
            'csms_id' => bin2hex(random_bytes(10)),
        ]);

        $data = $response->json();
        
        return [
            'success' => $data['status_code'] === 200,
            'message' => $data['status_code'] === 200 ? 'SMS sent successfully' : ($data['error_message'] ?? 'An error occurred'),
            'response' => $data
        ];
    }

    /**
     * Send Bulk SMS
     */
    public function sendBulkSms($phones, $message)
    {
        // Convert comma-separated string to array if needed
        if (is_string($phones)) {
            $phones = array_map('trim', explode(',', $phones));
        }

        $url = $this->baseUrl ;
        $response = Http::post($url, [
            'api_token' => $this->apiToken,
            'sid' => $this->sid,
            'msisdn' => $phones,
            'sms' => $message,
            'batch_csms_id' => bin2hex(random_bytes(10)),
        ]);

        $data = $response->json();
        
        return [
            'success' => $data['status_code'] === 200,
            'message' => $data['status_code'] === 200 ? 'Bulk SMS sent successfully' : ($data['error_message'] ?? 'An error occurred'),
            'response' => $data
        ];
    }

    /**
     * Send Dynamic SMS (Different Message for Each Recipient)
     */
    public function sendDynamicSms($messages)
    {
        // Format messages into required structure if needed
        $formattedMessages = [];
        foreach ($messages as $index => $message) {
            $formattedMessages[] = [
                'msisdn' => $message['msisdn'],
                'text' => $message['text'],
                'csms_id' => bin2hex(random_bytes(5)) . $index
            ];
        }

        $url = $this->baseUrl . "/send-sms/dynamic";
        $response = Http::post($url, [
            'api_token' => $this->apiToken,
            'sid' => $this->sid,
            'sms' => $formattedMessages,
        ]);

        $data = $response->json();
        
        return [
            'success' => $data['status_code'] === 200,
            'message' => $data['status_code'] === 200 ? 'Dynamic SMS sent successfully' : ($data['error_message'] ?? 'An error occurred'),
            'response' => $data
        ];
    }
}
