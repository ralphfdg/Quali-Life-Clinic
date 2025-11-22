<?php
// File: test_local_sms.php

// --- CONFIGURATION ---
$android_ip = ''; // <--- REPLACE WITH YOUR PHONE'S IP from the App
$port = '';              // Default port for Traccar
$token = '';    // The token you set in the app
$to_number = '';  // YOUR verified number
$message = 'Hello! This is a test from QualiLife Local Gateway.';
// ---------------------

$url = "http://$android_ip:$port/";

$data = array(
    'to' => $to_number,
    'message' => $message
);

$payload = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: ' . $token 
));

// Short timeout so your page doesn't hang if phone is offline
curl_setopt($ch, CURLOPT_TIMEOUT, 5); 

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$err = curl_error($ch);
curl_close($ch);

// Output
echo "<h1>Local Gateway Test</h1>";

if ($err) {
    echo "<h3 style='color:red'>Connection Error</h3>";
    echo "Could not connect to phone at $url. <br>";
    echo "1. Are phone and laptop on the same WiFi?<br>";
    echo "2. Is the App Status switch ON?<br>";
    echo "Error: $err";
} else {
    if ($http_code == 200 || $http_code == 204) {
        echo "<h3 style='color:green'>SUCCESS! Sent to Phone.</h3>";
        echo "Your Android phone should now be sending the text message.";
    } else {
        echo "<h3 style='color:orange'>Connected but Failed ($http_code)</h3>";
        echo "Response: " . htmlspecialchars($response);
    }
}
?>