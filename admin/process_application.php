<?php
include '../include/dbconnect.php';
require_once '../php/sms_service.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (!isset($_POST['application_id']) || !isset($_POST['decision'])) {
        echo "Error: Both application_id and decision are required.";
        exit;
    }

    $application_id = intval($_POST['application_id']);
    $decision = $_POST['decision']; 

    
    $query = "";
    if ($decision === 'accept') {
        $query = "UPDATE membership_requests SET status = 'accepted' WHERE application_number = :id";
    } elseif ($decision === 'decline') {
        $query = "UPDATE membership_requests SET status = 'declined' WHERE application_number = :id";
    } else {
        echo "Error: Invalid decision value.";
        exit;
    }
    
   
    $stmt = $pdo->prepare($query);
    if (!$stmt) {
        die('Prepare failed: ' . htmlspecialchars($pdo->errorInfo()[2]));
    }

    $stmt->bindValue(':id', $application_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        
        $memberQuery = "SELECT * FROM membership_requests WHERE application_number = :id";
        $memberStmt = $pdo->prepare($memberQuery);
        
        if (!$memberStmt) {
            die('Prepare failed: ' . htmlspecialchars($pdo->errorInfo()[2]));
        }
        
        $memberStmt->bindValue(':id', $application_id, PDO::PARAM_INT);
        $memberStmt->execute();
        $memberDetails = $memberStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($memberDetails) {
            $applicantPhoneNumber = $memberDetails['members_contact_number']; 
            $smsMessage = $decision === 'accept' 
                ? "Good day! We are pleased to inform you that your application for membership has been successfully accepted." 
                : "Sorry! Your application has been declined.";
            sendSmsNotification($applicantPhoneNumber, $smsMessage);
     
            
            if ($decision === 'accept') {
                header("Location: members_info.php?id={$memberDetails['application_number']}&message=Application accepted successfully");
                exit; 
            } else {
                header("Location: membership_request.php?message=Application declined successfully");
                exit;
            }
        } else {
            echo "Error: Member not found.";
        }
        
        $memberStmt->closeCursor();
    } else {
        echo "Error processing request: " . htmlspecialchars($stmt->errorInfo()[2]);
    }

    $stmt->closeCursor();
}
?>