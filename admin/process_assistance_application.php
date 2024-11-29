<?php
include '../include/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!isset($_POST['application_id']) || !isset($_POST['decision'])) {
        echo "Error: Both application_id and decision are required.";
        exit;
    }

    $application_id = intval($_POST['application_id']);
    $decision = $_POST['decision']; 

    $query = "";
    if ($decision === 'accept') {
        $query = "UPDATE assistance_applications SET status = 'accepted' WHERE id = :id";
    } elseif ($decision === 'decline') {
        $query = "UPDATE assistance_applications SET status = 'declined' WHERE id = :id";
    } else {
        echo "Error: Invalid decision value.";
        exit;
    }
    
    
    $stmt = $pdo->prepare($query);
  
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->errorInfo()[2]));
    }

    if (!$stmt->bindValue(':id', $application_id, PDO::PARAM_INT)) {
        die('Bind failed: ' . htmlspecialchars($stmt->errorInfo()[2]));
    }

    if ($stmt->execute()) {
        $memberQuery = "SELECT * FROM assistance_applications WHERE id = :id";
        $memberStmt = $pdo->prepare($memberQuery);
        
        if ($memberStmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->errorInfo()[2]));
        }
        
        $memberStmt->bindValue(':id', $application_id, PDO::PARAM_INT);
        $memberStmt->execute();
        $memberDetails = $memberStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($memberDetails) {
            $applicantPhoneNumber = $memberDetails['contact_number']; 
            $smsMessage = $decision === 'accept' 
                ? "Your application has been accepted successfully." 
                : "Your application has been declined.";
            sendSmsNotification($applicantPhoneNumber, $smsMessage);
     
            if ($decision === 'accept') {
                header("Location: beneficiaries_info.php?id={$memberDetails['id']}&message=Application accepted successfully");
                exit; 
            } else {
                header("Location: assistance_request.php?message=Application declined successfully");
                exit;
            }
        } else {
            echo "Error: Beneficiary not found.";
        }
        
        $memberStmt->closeCursor();
    } else {
        echo "Error processing request: " . htmlspecialchars($stmt->errorInfo()[2]);
    }

    $stmt->closeCursor();
}


function sendSmsNotification($phoneNumber, $message) {
    $url = "http://"; 
    $data = [
        'to' => $phoneNumber,
        'message' => $message,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}
?>