<?php
include '../include/dbconnect.php';
include '../php/calendar.php';
$calendar = new Calendar();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visitation_date = $_POST['visitation_date'];
    $visitation_time = $_POST['visitation_time'];
    $visitation_address = $_POST['visitation_address'];
    $visitation_purpose = $_POST['visitation_purpose'];


    $sql = "INSERT INTO visitations (visitation_date, visitation_time, visitation_address, visitation_purpose) 
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$visitation_date, $visitation_time, $visitation_address, $visitation_purpose])) {
        $applicationId = $pdo->lastInsertId();

    echo "New schedule has been set!";
    } else {
        echo "Error setting schedule.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Schedule Visitations</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="text-muted small pt-2 ps-1">
    <header class="justify-content-between header fixed-top d-flex align-items-center" id="header" style="padding: 4px;background: url(&quot;assets/img/background.png&quot;) center / cover no-repeat, rgb(255,255,255);">
        <div class="d-flex align-items-center justify-content-between" style="gap: 15px">
            <i class="fas fa-bars toggle-sidebar-btn" style="color: rgb(0,0,0);"></i>
            <a href="#">
                <img src="../assets/img/AgapConnect%20(3).png" width="150px" height="40px">
            </a>
        </div>
        <div class="search-bar" style="margin-right: 25px;margin-left: 100px;">
            <form class="search-form d-flex align-items-center">
                <input class="form-control" type="text" style="border-top-left-radius: 4px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;" placeholder="Search here..."><button class="btn btn-primary" type="button" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;"><i class="fas fa-search" style="border-color: rgb(25,95,49);color: rgb(25,95,49);"></i></button></form>
        </div>
        <nav class="d-flex justify-content-between align-items-lg-center header-nav ms-auto" style="gap: 10px">
            <ul class="d-lg-flex align-items-lg-center d-flex align-items-center" style="gap:10px;">
                <li class="nav-item d-block d-lg-none"><a class="nav-link nav-icon search-bar-toggle" href="#"><i class="fas fa-search fs-3 text-dark nav-item d-block d-lg-none" style="margin-top: 15px;"></i></a></li>
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
                <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="background: rgb(35,123,21);margin-right: 10px;">
                    <img class="border rounded-circle" src="../assets/img/user%20(1).png" width="30px" height="30px" style="background: #ffffff;"></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="editprofile.php"><i class="fas fa-user-edit fs-5 text-dark"></i>Edit Profile</a>
                    <a class="dropdown-item" href="accountsetting.php"><i class="fas fa-user-cog fs-5 text-dark"></i>My Account</a>
                    <a class="dropdown-item" href="logout.php"><i class="fas fa-share-square fs-5 text-dark"></i>Logout</a>
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
                    <li class="nav-item">
                        <a href="donation_request.php">
                            <i class="fas fa-file-contract"></i><span>&nbsp; Donation Requests</span>
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
        <div class="d-flex justify-content-between page-title">
            <h1 style="font-family: Acme, sans-serif;font-size: 26px;">Visitations</h1>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-schedule">
                    <i class="fas fa-plus"></i> Add New Schedule
                </button>
                <div class="modal fade" tabindex="-1" id="new-schedule">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Set New Schedule</h5>

                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="far fa-window-close"><span class="path1"></span>
                                    <span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="visitations.php">
                                    <div class="row">
                                        <div class="col-md-12" style="padding: 4px;">
                                            <label class="form-label">Date</label>
                                            <input class="form-control" type="date" name="visitation_date" required>
                                        </div>
                                        <div class="col-md-12" style="padding: 4px;">
                                            <label class="form-label">Time</label>
                                            <input class="form-control" type="time" name="visitation_time" required>
                                        </div>
                                        <div class="col-md-12" style="padding: 4px;">
                                            <label class="form-label">Address</label>
                                            <input class="form-control" type="text" name="visitation_address" required>
                                        </div>
                                        <div class="col-md-12" style="padding: 4px;">
                                            <label class="form-label">Purpose</label>
                                            <input class="form-control" type="text" name="visitation_purpose" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div>
                            <?=$calendar?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>