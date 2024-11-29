<?php
include '../include/dbconnect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donationId = isset($_POST['donation_id']) ? intval($_POST['donation_id']) : 0;
    $donorContact = isset($_POST['donor_contact']) ? $_POST['donor_contact'] : '';

    if ($donationId === 0 || empty($donorContact)) {
        die("Invalid donation ID or donor contact.");
    }

    // Update the donation status in the database
    $stmt = $pdo->prepare("UPDATE donations SET is_confirmed = 1 WHERE transaction_number = :id");
    $stmt->bindParam(':id', $donationId);
    $stmt->execute();

    // Send SMS notification
    sendSMSNotification($donorContact);

    echo "Donation confirmed and SMS notification sent.";
    // Optionally redirect back to the donations info page
    header("Location: donations_info.php");
    exit();
}

function sendSMSNotification($contact) {
    $apiKey = '8d12bb45ef9dc146f1daeaaa49fbfe90'; // Replace with your Semaphore API key
    $apiUrl = 'https://semaphore.co/api/v4/sms/send';

    $message = "Thank you for your donation! Your contribution has been received and confirmed.";

    $data = [
        'apikey' => $apiKey,
        'number' => $contact,
        'message' => $message,
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($apiUrl, false, $context);

    if ($result === FALSE) {
        // Handle error
        echo "Error sending SMS.";
    }
}
?>