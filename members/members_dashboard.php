<?php
session_start();

    
include '../include/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Members - Dashboard</title>
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
                <li class="nav-item dropdown" style="margin-top: 15px;"><a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" style="margin-right: 10px;"><i class="fas fa-bell fs-3 text-dark"></i><span class="badge badge-number" style="background: rgb(118,217,94);color: rgb(0,0,0);">0</span></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">"You don't have new notifications."<a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></li>
                        <li class="dropdown-divider"></li>
                        <li class="notification-item"></li>
                        <li class="notification-item"></li>
                    </ul>
                </li>
            </ul>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="background: rgb(35,123,21);margin-right: 10px;">
                    <img class="border rounded-circle" src="../assets/img/user%20(1).png" width="30px" height="30px" style="background: #ffffff;"></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="edit-profile.php"><i class="fas fa-user-edit fs-5 text-dark"></i>Edit Profile</a>
                    <a class="dropdown-item" href="account_setting.php"><i class="fas fa-user-cog fs-5 text-dark"></i>My Account</a>
                    <a class="dropdown-item" href="logout.php"><i class="fas fa-share-square fs-5 text-dark"></i>Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <aside id="sidebar" class="sidebar" style="font-size: 16px;">
        <ul id="sidebar-nav" class="sidebar-nav">
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="members_dashboard.php" style="font-size: 16px;"><i class="fas fa-tachometer-alt"></i>
                    <span style="padding-left: 5px;">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="assistance_application.php" style="font-size: 16px;"><i class="fas fa-file-contract"></i>
                    <span style="padding-left: 5px;">Assistance Application</span>
                </a>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="kaagapay.php" style="font-size: 16px;"><i class="fas fa-hands-helping"></i>
                    <span style="padding-left: 5px;">Kaagapay Program</span>
                </a>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="request_status.php" style="font-size: 16px;"><i class="fas fa-spinner"></i>
                    <span style="padding-left: 5px;">Requests Status</span>
                </a>
            </li>
            <li class="nav-item" style="color: rgb(13,13,13);">
                <a class="d-xl-flex nav-link" href="request_history.php" style="font-size: 16px;"><i class="fas fa-history"></i>
                    <span style="padding-left: 5px;">Requests History</span>
                </a>
            </li>
        </ul>
    </aside>
    <main id="main" class="main">
        <div class="page-title">
            <h1 style="font-family: Acme, sans-serif;font-size: 26px;">Dashboard</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12" style="font-size: 16px;">
                    <div class="row">
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card families-assisted-card" style="padding-right: 0px;">
                                <div class="card-body" style="font-family: ABeeZee, sans-serif;box-shadow: 0px 0px 5px rgb(108, 117, 125);">
                                    <h6 style="color: rgb(65,66,68);">Who is Kaagap Incorporated?</h6>
                                    <div class="d-flex align-items-center" style="padding: 5px;"><span style="text-align: justify;color: rgb(0,0,0);">Kaagap Incorporated (formerly Agap Buhay Association) is a non-profit organization located at Zone 4, Bulan, Sorsogon. It aims to aid the financial burdens of poor and less fortunate people in Bulan, including its members, </span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card members-card" style="padding-right: 0px;">
                                <div class="card-body" style="font-family: ABeeZee, sans-serif;box-shadow: 0px 0px 5px rgb(108, 117, 125);">
                                    <h6 style="color: rgb(65,66,68);">Our Vision</h6>
                                    <div class="d-flex align-items-center" style="padding: 5px;"><span style="text-align: justify;color: rgb(0,0,0);">Kaagap Incorporated envisions community of empowered Bulaneños wherein everyone possesses the commitment to freely lend a hand in any way he/she is capable in crisis situations, and willingly contribute for the development of the health, economy, and socio-culture status of the Municipality of Bulan</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card donations-card" style="padding-right: 0px;">
                                <div class="card-body" style="font-family: ABeeZee, sans-serif; box-shadow: 0px 0px 5px rgb(108, 117, 125);">
                                    <h6 style="color: rgb(65,66,68);">Our Mission</h6>
                                    <div class="d-flex align-items-center" style="padding: 5px;"><span style="text-align: justify;color: rgb(8,8,8);">To assist alleviate the hardships faced by the less and least fortunate Bulaneños, strive to reduce the burden on impoverished and vulnerable families through various means of assistance, and actively involve the members in fulfilling the purpose and objectives of Kaagap Incorporated.</span></div>
                                </div>
                            </div>
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