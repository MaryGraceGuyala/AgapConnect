<?php
require '../include/dbconnect.php';

$notifications_sql = "SELECT * FROM notifications ORDER BY created_at DESC";
$notifications_stmt = $pdo->query($notifications_sql);
$notifications = $notifications_stmt->fetchAll();
?>