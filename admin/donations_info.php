<?php
include '../include/dbconnect.php';
include '../php/notification.php';

$notifications = []; 
$notification_count = 0; 

$stmt = $pdo->prepare("SELECT * FROM notifications WHERE status = 'Unread'"); 
$stmt->execute();
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
$notification_count = count($notifications);


$currentDate = new DateTime();
$oneWeekAgo = $currentDate->modify('-7 days')->format('Y-m-d H:i:s');

$query = "SELECT * FROM donations WHERE is_confirmed = 1 ORDER BY created_at DESC";
$result = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Donations</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/Navbar-Right-Links.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
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
                <input class="form-control" type="text" style="border-top-left-radius: 4px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;" placeholder="Search here...">
                <button class="btn btn-primary" type="button" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;"><i class="fas fa-search" style="border-color: rgb(25,95,49);color: rgb(25,95,49);"></i></button>
            </form>
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
        <div class="page-title">
            <h1 style="font-family: Acme, sans-serif;font-size: 26px;">Donations</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Donation Information</h4>
                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-top" style="font-family: ABeeZee, sans-serif;">
                                    <div class="datatable-dropdown" style="padding: 2px;"><label class="form-label"><select class="datatable-selector">
                                                <option value="5" selected="">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="all">All</option>
                                            </select>&nbsp;entries per page</label></div>
                                    <div class="datatable-search" style="padding: 2px;"><input type="search" class="datatable-input" placeholder="Search..." name="search" title="Search within the table" style="padding: 2px;"></div>
                                </div>
                            </div>
                            <div class="datatable-container">
                                <div class="table-responsive table table-borderless datatable datatable-table">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-center" style="border-style: none;background: rgb(211,227,201);font-family: ABeeZee, sans-serif;">
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">ID</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">First Name</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Middle Name</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Last Name</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Address</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Age</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Sex</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Contact Number</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Type of Donation</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"> Donation Items </th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Amount</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Quantity</th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);">Donation Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result->rowCount() > 0) {
                                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            
                                                    $isNewDonation = (strtotime($row['created_at']) >= strtotime($oneWeekAgo));
                                                    $rowClass = $isNewDonation ? 'table-success' : ''; 
                                                    echo "<tr class='$rowClass'>
                                                            <td>" . htmlspecialchars($row['transaction_number']) . "</td>
                                                            <td>" . htmlspecialchars($row['donor_first_name']) . "</td>
                                                            <td>" . htmlspecialchars($row['donor_middle_name']) . "</td>
                                                            <td>" . htmlspecialchars($row['donor_last_name']) . "</td>
                                                            <td>" . htmlspecialchars($row['address']) . "</td>
                                                            <td>" . htmlspecialchars($row['age']) . "</td>
                                                            <td>" . htmlspecialchars($row['sex']) . "</td>
                                                            <td>" . htmlspecialchars($row['contact_number']) . "</td>
                                                            <td>" . htmlspecialchars($row['donation_type']) . "</td>
                                                            <td>" . htmlspecialchars($row['donation_items']) . "</td>
                                                            <td>" . htmlspecialchars($row['quantity']) . "</td>
                                                            <td>" . htmlspecialchars($row['amount']) . "</td>
                                                            <td>" . htmlspecialchars($row['created_at']) . "</td>
                                                        </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='13' class='text-center'>No donation records found.</td></tr>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
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

