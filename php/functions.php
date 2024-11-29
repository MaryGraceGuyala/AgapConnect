<?php
include '../include/dbconnect.php';

function get_applications($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM assistance_applications");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>