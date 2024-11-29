<?php
include '../include/dbconnect.php';

$donor_first_name = isset($_GET['donor_first_name'])  ? $_GET['donor_first_name'] : 'Guest';

$query = "SELECT * FROM donations WHERE donor_first_name = :donor_first_name";
$stmt = $pdo->prepare($query);

$stmt->execute(['donor_first_name' => $donor_first_name]);
$donations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Donation History</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Hero-Clean-Reverse.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="index-page" data-aos-easing="ease-in-out" data-aos-duration="600" data-aos-delay="0">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between"><a class="logo d-flex align-items-center me-auto me-xl-0" href="index.php"><img src="assets/img/AgapConnect%20(3).png" style="width: 150px;height: 50px;"></a>
            <nav class="navbar navbar-light navbar-expand-md text-center navmenu" id="navmenu">
                <div class="container-fluid">
                    <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
                        <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#services">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex justify-content-between align-items-lg-center" href="index.php#about">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#team">Our Team</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#contact">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <a class="order-last" href="#donations" style="padding: 15px;color: rgb(255,255,255);background: #018f42;text-decoration: none;border-radius: 4px;padding-right: 5px;padding-top: 10px;padding-bottom: 10px;padding-left: 5px;">Donate Now</a>
        </div>
    </header>
    <main style="padding: 25px; margin-top: 70px;">
        <div class="page-title">
            <h1 style="font-family: Acme, sans-serif;font-size: 26px;">Donation History</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="padding: 12px;">
                        <div class="card-header" style="text-align:center;">
                            <h2>Hello, <?php echo htmlspecialchars($donor_first_name); ?></h2>
                            <h3>Thank you so much for your donations.</h3>
                        </div>
                        <div class="card-body">
                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-top" style="font-family: ABeeZee, sans-serif;">
                                    <div class="datatable-dropdown" style="padding: 2px;">
                                        <label class="form-label">
                                        <select class="datatable-selector">
                                            <option value="5" selected="">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="all">All</option>
                                        </select>&nbsp;entries per page</label>
                                    </div>
                                    <div class="datatable-search" style="padding: 2px;">
                                        <input type="search" class="datatable-input" placeholder="Search..." name="search" title="Search within the table" style="padding: 2px;">
                                    </div>
                                </div>
                            </div>
                            <div class="datatable-container">
                                <div class="table-responsive table table-borderless datatable datatable-table">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-center" style="border-style: none;background: rgb(211,227,201);font-family: ABeeZee, sans-serif;">
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Donation Date</button></th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Donation Type</button></th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Donation Items</button></th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Amount</button></th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Quantity</button></th>
                                                <th class="datatable-descending" data-sortable="true" scope="col" aria-sort="descending" style="border-style: none;background: rgba(255,255,255,0);"><button class="btn btn-primary datatable-sorter" type="button">Status</button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($donations as $donation): ?>
                                                <tr class="text-center">
                                                    <td><?php echo htmlspecialchars($donation['created_at']); ?></td>
                                                    <td><?php echo htmlspecialchars($donation['donation_type']); ?></td>
                                                    <td><?php echo htmlspecialchars($donation['donation_items']); ?></td>
                                                    <td><?php echo htmlspecialchars($donation['amount']); ?></td>
                                                    <td><?php echo htmlspecialchars($donation['quantity']); ?></td>
                                                    <td><?php echo htmlspecialchars($donation['status']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
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
</body>
</html>
