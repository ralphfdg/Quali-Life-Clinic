<?php

class SmsHelper
{
    // --- CONFIGURATION (Copy from your test_sms.php) ---
    // Example URL: 'http://192.168.1.5:8082' or your public IP
    const GATEWAY_URL = ''; 
    
    // Example Token: 'your-api-token-here' (Leave empty if you turned off auth)
    const API_TOKEN = ''; 
    // ---------------------------------------------------

    /**
     * Sends an SMS via Traccar Gateway
     */
    public static function send($to, $message)
    {
        if (empty($to) || empty($message)) {
            return false;
        }

        // 1. Format the data
        $data = array(
            'to' => $to,
            'message' => $message
        );
        $payload = json_encode($data);

        // 2. Initialize cURL
        $ch = curl_init(self::GATEWAY_URL);
        
        // 3. Set Options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . self::API_TOKEN 
        ));

        // 4. Execute
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Log the result for debugging
        if ($httpCode == 200) {
            Yii::log("SMS Sent to $to: $message", 'info', 'application.sms');
            return true;
        } else {
            Yii::log("SMS Failed ($httpCode): $response", 'error', 'application.sms');
            return false;
        }
    }
}