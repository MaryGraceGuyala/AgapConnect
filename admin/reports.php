<?php
include '../include/dbconnect.php';
include '../php/notification.php';

$notifications = []; 
$notification_count = 0; 

$stmt = $pdo->prepare("SELECT * FROM notifications WHERE status = 'Unread'"); 
$stmt->execute();
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
$notification_count = count($notifications);


function getAidRequestsCount($pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM assistance_applications");
    $stmt->execute();
    return $stmt->fetchColumn();
}
function getBudgetAllocation($pdo) {
    $stmt = $pdo->prepare("SELECT SUM(allocated_amount) AS total_budget FROM budget_allocation");
    $stmt->execute();
    return $stmt->fetchColumn();
}
function getDonorContributions($pdo) {
    $stmt = $pdo->prepare("SELECT SUM(amount) AS total_contributions FROM donations");
    $stmt->execute();
    return $stmt->fetchColumn();
}

$aidRequestsCount = getAidRequestsCount($pdo);
$budgetAllocation = getBudgetAllocation($pdo);
$donorContributions = getDonorContributions($pdo);

$pdo = null;

$reportData = [
    'aid_requests' => $aidRequestsCount,
    'budget_allocation' => $budgetAllocation,
    'donor_contributions' => $donorContributions,
];

if (isset($_POST['download'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="report.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Report', 'Value']);
    fputcsv($output, ['Quantity of Aid Requests', $reportData['aid_requests']]);
    fputcsv($output, ['Total Budget Allocation', $reportData['budget_allocation']]);
    fputcsv($output, ['Total Donor Contributions', $reportData['donor_contributions']]);
    fclose($output);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin - Reports Module</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Hero-Clean-Reverse.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header class="justify-content-between header fixed-top d-flex align-items-center" id="header" style="padding: 4px;background: url(&quot;assets/img/background.png&quot;) center / cover no-repeat, rgb(255,255,255);">
        <div class="d-flex align-items-center justify-content-between" style="gap: 15px">
            <i class="fas fa-bars toggle-sidebar-btn" style="color: rgb(0,0,0);"></i>
            <a href="#"><img src="assets/img/AgapConnect%20(3).png" width="150px" height="40px"></a>
        </div>
        <div class="search-bar" style="margin-right: 25px;margin-left: 100px;">
            <form class="search-form d-flex align-items-center">
                <input class="form-control" type="text" style="border-top-left-radius: 4px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;" placeholder="Search here..."><button class="btn btn-primary" type="button" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;"><i class="fas fa-search" style="border-color: rgb(25,95,49);color: rgb(25,95,49);"></i></button></form>
        </div>
        <nav class="d-flex justify-content-between align-items-lg-center header-nav ms-auto" style="gap: 10px">
            <ul class="d-lg-flex align-items-lg-center d-flex align-items-center" style="gap:10px;">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle" href="#">
                        <i class="fas fa-search fs-3 text-dark nav-item d-block d-lg-none" style="margin-top: 15px;"></i>
                    </a>
                </li>
                <li class="nav-item dropdown" style="margin-top: 15px;">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" style="margin-right: 10px;">
                        <i class="fas fa-bell fs-3 text-dark"></i>
                        <span class="badge badge-number" style="background: rgb(118,217,94);color: rgb(0,0,0);"> 
                            <?php echo $notification_count > 0 ? $notification_count : '0'; ?>                        
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        <?php 
                        if ($notification_count > 0) {
                            echo "You have $notification_count new notifications.";
                        } else {
                        echo "You don't have new notifications.";
                    }
                    ?>
                    <a href="#">
                        <span class="badge rounded-pill bg-primary p-2 ms-2">View all</span>
                    </a>                        
                </li>
                        <li class="dropdown-divider"></li>
                         
                        <?php if ($notification_count > 0): ?>
                        <?php foreach ($notifications as $notification): ?>
                        <li class="notification-item">
                            <div>
                                <h6><?php echo htmlspecialchars($notification['message']); ?></h6>
                                    <small><?php echo date('Y-m-d H:i:s', strtotime($notification['created_at'])); ?></small>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <li class="notification-item">
                            <div>No notifications available.</div>
                        </li>
                        <?php endif; ?>
                                
                    </ul>
                </li>
            </ul>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="background: rgb(35,123,21);margin-right: 10px;margin-top: 5px;"><img class="border rounded-circle" src="assets/img/user%20(1).png" width="30px" height="30px" style="background: #ffffff;"></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="edit-profile.php">
                        <i class="fas fa-user-edit fs-5 text-dark"></i>Edit Profile
                    </a>
                    <a class="dropdown-item" href="accountsetting.php">
                        <i class="fas fa-user-cog fs-5 text-dark"></i>My Account
                    </a>
                    <a class="dropdown-item" href="logout.php">
                        <i class="fas fa-share-square fs-5 text-dark"></i>Logout
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <aside id="sidebar" class="sidebar">
        <ul id="sidebar-nav" class="sidebar-nav">
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="admin_dashboard.php" style="font-size: 16px;">
                    <i class="fas fa-tachometer-alt"></i><span style="padding-left: 5px;">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="beneficiaries_info.php" style="font-size: 16px;">
                    <i class="fas fa-user-friends"></i><span style="padding-left: 5px;">Beneficiary</span>
                </a>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="members_info.php" style="font-size: 16px;">
                    <i class="fas fa-users"></i><span style="padding-left: 5px;">Members</span>
                </a>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="donations_info.php" style="font-size: 16px;">
                    <i class="fas fa-boxes"></i><span style="padding-left: 5px;">Donations</span>
                </a>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="#" style="font-size: 16px;" data-bs-target="#requests-nav" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-file-signature"></i>
                    <span style="padding-left: 5px;">Requests</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul id="requests-nav" class="nav-content collapse">
                    <li class="nav-item">
                        <a href="assistance_request.php">
                            <i class="fas fa-file-contract"></i><span>&nbsp; Assistance Requests</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="membership_request.php">
                            <i class="fas fa-file-contract"></i><span>&nbsp; Membership Requests</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="visitations.php" style="font-size: 16px;">
                    <i class="fas fa-calendar-alt"></i><span style="padding-left: 5px;">Visitations</span>
                </a>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="reports.php" style="font-size: 16px;">
                    <i class="fas fa-file-alt"></i><span style="padding-left: 5px;">Reports</span>
                </a>
            </li>
        </ul>
    </aside>
    <main id="main" class="main">
    <div class="container mt-5">
        <h1>Reporting Module</h1>
        <div class="card mt-3">
            <div class="card-header">
                Summary Reports
            </div>
            <div class="card-body">
                <h5 class="card-title">Quantity of Aid Requests</h5>
                <p class="card-text"><?php echo $reportData['aid_requests']; ?></p>
                
                <h5 class="card-title">Total Budget Allocation</h5>
                <p class="card-text">Php. <?php echo number_format($reportData['budget_allocation'], 2); ?></p>
                
                <h5 class="card-title">Total Donor Contributions</h5>
                <p class="card-text">Php. <?php echo number_format($reportData['donor_contributions'], 2); ?></p>

                <form method="post">
                    <button type="submit" name="download" class="btn btn-primary">Download Report</button>
                </form>
            </div>
        </div>
    </div>
    </main>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>

</body>
</html>