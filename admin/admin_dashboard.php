<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin - Dashboard</title>
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
                        <span class="badge badge-number" style="background: rgb(118,217,94);color: rgb(0,0,0);">0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">"You don't have new notifications."
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="notification-item"></li>
                        <li class="notification-item"></li>
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
                <ul id="requests-nav" class="nav-content collapse show">
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
        <div class="page-title">
            <h1 style="font-family: Acme, sans-serif;font-size: 26px;">Dashboard</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card families-assisted-card" style="padding-right: 0px;">
                                <div class="filter"><a href="#" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h" style="color: rgb(56,59,62);padding-right: 5px;"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">Filter</li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">Today</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Week</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Month</a></li>
                                    </ul>
                                </div>
                                <div class="card-body" style="font-family: ABeeZee, sans-serif;">
                                    <h6>Families Assisted<span>&nbsp;| This Month</span></h6>
                                    <div class="d-flex align-items-center" style="padding: 5px;">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-users fs-3"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h3>126</h3>
                                            <span class="small pt-1 fw-bold">3%</span>
                                            <span class="text-muted small pt-2 ps-1">&nbsp;decrease</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card members-card" style="padding-right: 0px;">
                                <div class="filter"><a href="#" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h" style="color: rgb(56,59,62);padding-right: 5px;"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">Filter</li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">Today</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Week</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Month</a></li>
                                    </ul>
                                </div>
                                <div class="card-body" style="font-family: ABeeZee, sans-serif;">
                                    <h6>Members<span id="time-frame">&nbsp;| This Month</span></h6>
                                    <div class="d-flex align-items-center" style="padding: 5px;">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user-friends fs-3"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h3 id="member-count"></h3>
                                            <span class="small pt-1 fw-bold">25%</span>
                                            <span class="text-muted small pt-2 ps-1">&nbsp;increase</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card donations-card" style="padding-right: 0px;">
                                <div class="filter"><a href="#" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h" style="color: rgb(56,59,62);padding-right: 5px;"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">Filter</li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">Today</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Week</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Month</a></li>
                                    </ul>
                                </div>
                                <div class="card-body" style="font-family: ABeeZee, sans-serif;">
                                    <h6>Donations<span>&nbsp;| This Month</span></h6>
                                    <div class="d-flex align-items-center" style="padding: 5px;">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background: rgba(201,206,224,0.45);color: rgb(95,105,7);"><i class="fas fa-donate fs-3"></i></div>
                                        <div class="ps-3">
                                            <h3>Php. 5,000</h3><span class="small pt-1 fw-bold">36%</span><span class="text-muted small pt-2 ps-1">&nbsp;increase</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card donations-card" style="padding-right: 0px;">
                                <div class="filter"><a href="#" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h" style="color: rgb(56,59,62);padding-right: 5px;"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">Filter</li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">Today</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Week</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Month</a></li>
                                    </ul>
                                </div>
                                <div class="card-body" style="font-family: ABeeZee, sans-serif;">
                                    <h6>Medicines<span>&nbsp;| This Month</span></h6>
                                    <div class="d-flex align-items-center" style="padding: 5px;">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background: rgba(175,182,207,0.45);color: rgb(95,105,7);"><i class="fas fa-pills fs-3" style="color: rgb(28,86,153);"></i></div>
                                        <div class="ps-3">
                                            <h3>45</h3><span class="small pt-1 fw-bold">8%</span><span class="text-muted small pt-2 ps-1">&nbsp;increase</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card info-card visitations-card overflow-auto" style="padding-right: 0px;">
                                <div class="filter"><a href="#" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h" style="color: rgb(56,59,62);padding-right: 5px;"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">Filter</li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">Today</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Week</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Month</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h6 style="font-family: ABeeZee, sans-serif;">Visitations<span>&nbsp;| This Month</span></h6>
                                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                        <div class="datatable-top" style="font-family: ABeeZee, sans-serif;">
                                            <div class="datatable-dropdown" style="padding: 2px;"><label class="form-label"><select class="datatable-selector">
                                                        <option value="5" selected="">5</option>
                                                        <option value="10">10</option>
                                                        <option value="15">15</option>
                                                        <option value="all">All</option>
                                                    </select>&nbsp;entries per page</label></div>
                                            <div class="datatable-search" style="padding: 2px;">
                                                <input type="search" class="datatable-input" placeholder="Search..." name="search" title="Search within the table" style="padding: 2px;">
                                            </div>
                                        </div>
                                        <div class="datatable-container">
                                            <div class="table-responsive table table-borderless datatable datatable-table">
                                                <table class="table">
                                                    <thead>
                                                        <tr style="border-style: none;background: rgb(211,227,201);font-family: ABeeZee, sans-serif;">
                                                            <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Date</button></th>
                                                            <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Time</button></th>
                                                            <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Address</button></th>
                                                            <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Purpose</button></th>
                                                            <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Status</button></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                     
                                                        while($row = $result->fetch_assoc()) {
                                                            echo "<tr style='text-align: center;'>";
                                                            echo "<td>{$row['visitation_date']}</td>";
                                                            echo "<td>{$row['visitation_time']}</td>";
                                                            echo "<td>{$row['visitation_address']}</td>";
                                                            echo "<td>{$row['visitation_purpose']}</td>";
                                                            echo "<td>{$row['visitation_status']}</td>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='13' style=' text-align: center;'>No records found.</td></tr>";
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
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card info-card donations-card" style="padding-right: 0px;">
                    <div class="filter"><a href="#" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h" style="color: rgb(56,59,62);padding-right: 5px;"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">Filter</li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">Today</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Week</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Month</a></li>
                                    </ul>
                                </div>
                        <div class="card-body" style="font-family: ABeeZee, sans-serif;">
                            <h6>Recent Activity<span>&nbsp;| Today</span></h6>
                            <div class="activity" style="padding: 5px;">
                                <div class="activity-item d-flex">
                                    <div class="activite-label"></div>
                                    <i class="fas fa-circle activity-badge text-success align-self-start"></i>
                                    <div class="activity-content">

                                    </div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label"></div>
                                    <i class="fas fa-circle activity-badge text-success align-self-start"></i>
                                    <div class="activity-content"></div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label"></div>
                                    <i class="fas fa-circle activity-badge text-success align-self-start"></i>
                                    <div class="activity-content"></div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label"></div>
                                    <i class="fas fa-circle activity-badge text-success align-self-start"></i>
                                    <div class="activity-content"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card info-card donations-card" style="padding-right: 0px;">
                    <div class="filter"><a href="#" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h" style="color: rgb(56,59,62);padding-right: 5px;"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">Filter</li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">Today</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Week</a></li>
                                        <li class="dropdown-item"><a href="#"  style="text-decoration:none; color: black; font-family: Rubik,sans-serif;">This Month</a></li>
                                    </ul>
                                </div>
                        <div class="card-body" style="font-family: ABeeZee, sans-serif;">
                            <h6>Most Requested Assistance<span>&nbsp;| Today</span></h6>
                            <div id="mostRequested" class="echart" style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); position: relative;" _echarts_instances="ec_1728360024921">
                                <div style="position: relative; width: 287px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                    <div>
                                        <canvas data-bss-chart="{&quot;type&quot;:&quot;pie&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Financial Assistance&quot;,&quot;Medical Assistance&quot;,&quot;Burial Assistance&quot;,&quot;Housing Assistance&quot;,&quot;Transportation Assistance&quot;,&quot;Free Medicines&quot;Borrow Medical Equipment&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Revenue&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#4e73df&quot;,&quot;#4e73df&quot;,&quot;#4e73df&quot;,&quot;#4e73df&quot;,&quot;#4e73df&quot;],&quot;borderColor&quot;:[&quot;#4e73df&quot;,&quot;#4e73df&quot;,&quot;#4e73df&quot;,&quot;#4e73df&quot;,&quot;#4e73df&quot;,&quot;#4e73df&quot;],&quot;data&quot;:[&quot;4500&quot;,&quot;5300&quot;,&quot;6250&quot;,&quot;7800&quot;,&quot;9800&quot;,&quot;15000&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;bold&quot;}}}"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>