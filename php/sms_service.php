<?php
function sendSmsNotification($phoneNumber, $message) {

    $apiKey = 'your_api_key';
    $apiUrl = 'https://sms.api.provider/send';
    $data = [
        'to' => $phoneNumber,
        'message' => $message,
        'apiKey' => $apiKey
    ];
   
    return true; 
}
?>