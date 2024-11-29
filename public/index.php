<?php
require '../include/dbconnect.php';

function generateApplicationNumber() {
    return uniqid(true);  
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $members_name = $_POST['members_name'];
    $members_address = $_POST['members_address'];
    $members_birthdate = $_POST['members_birthdate'];
    $members_age = $_POST['members_age'];
    $members_civil_status = $_POST['members_civil_status'];
    $members_gender = $_POST['members_gender'];
    $members_contact_number = $_POST['members_contact_number'];
    $members_work = $_POST['members_work'];
    $members_household_income = $_POST['members_household_income'];
    $contact_name = $_POST['contact_name'];
    $contact_address = $_POST['contact_address'];
    $contact_age = $_POST['contact_age'];
    $contact_phone = $_POST['contact_phone'];
    $members_beneficiary_name = $_POST['members_beneficiary_name'];
    $members_beneficiary_age = $_POST['members_beneficiary_age'];
    $members_beneficiary_address = $_POST['members_beneficiary_address'];
    $members_beneficiary_relationship = $_POST['members_beneficiary_relationship'];
    $members_beneficiary_income = $_POST['members_beneficiary_income'];

    $uploadDir = '../uploads/';
    $fileDirectories = [
        'members_identity' => 'members_identity/',
        'proof_of_payment' => 'proof_of_payment/',
    ];

    $filePaths = [];
    foreach ($fileDirectories as $inputName => $dir) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK) {
            $filePath = $uploadDir . $dir . basename($_FILES[$inputName]['name']);
            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $filePath)) {
                $filePaths[$inputName] = $filePath; 
            } else {
                echo "Error uploading file: " . $_FILES[$inputName]['name'];
                exit;
            }
        } else {
            echo "Error with file upload for: " . $inputName;
            exit;
        }
    }

    $application_number = generateApplicationNumber();

    $sql = "INSERT INTO membership_requests (members_name, members_address, members_birthdate, members_age, members_civil_status, members_gender, members_contact_number, members_work, members_household_income, contact_name, contact_address, contact_age, contact_phone, members_beneficiary_name, members_beneficiary_age, members_beneficiary_address, members_beneficiary_relationship, members_beneficiary_income, members_identity_path, proof_of_payment_path, application_number) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        $members_name, 
        $members_address, 
        $members_birthdate, 
        $members_age, 
        $members_civil_status, 
        $members_gender, 
        $members_contact_number, 
        $members_work, 
        $members_household_income, 
        $contact_name, 
        $contact_address, 
        $contact_age, 
        $contact_phone, 
        $members_beneficiary_name, 
        $members_beneficiary_age, 
        $members_beneficiary_address, 
        $members_beneficiary_relationship, 
        $members_beneficiary_income, 
        $filePaths['members_identity'], 
        $filePaths['proof_of_payment'],
        $applicationtion_number
    ])) {

        $notification_sql = "INSERT INTO notifications (message) VALUES (:message)";
        $notification_stmt = $pdo->prepare($notification_sql);
        $message = "New membership request from " . $members_name .  " (Application #: $application_number)";
        $notification_stmt->execute([':message' => $message]);
    } else {
        echo "Error submitting application.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Welcome to AgapConnect</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Hero-Clean-Reverse.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .lists-of-beneficiaries {
            margin: 20px;
        }
        .beneficiary-entry {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .beneficiary-entry input,
        .beneficiary-entry select {
            margin-right: 10px;
            flex: 1; 
        }
        .del {
            display: none; 
            cursor: pointer;
            color: red;
            margin-left: 10px;
        }
        .del.visible {
            display: inline;
        }
    </style>
</head>

<body class="index-page" data-aos-easing="ease-in-out" data-aos-duration="600" data-aos-delay="0">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between"><a class="logo d-flex align-items-center me-auto me-xl-0" href="index.php"><img src="assets/img/AgapConnect%20(3).png" style="width: 150px;height: 50px;"></a>
            <nav class="navbar navbar-light navbar-expand-md text-center navmenu" id="navmenu">
                <div class="container-fluid"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                            <li class="nav-item"><a class="nav-link d-flex justify-content-between align-items-lg-center" href="#about">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="#team">Our Team</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </nav><a class="order-last" href="#donations" style="padding: 15px;color: rgb(255,255,255);background: #018f42;text-decoration: none;border-radius: 4px;padding-right: 5px;padding-top: 10px;padding-bottom: 10px;padding-left: 5px;">Donate Now</a>
        </div>
    </header>
    <main id="main-index" class="main">
        <section id="home" class="home">
            <div class="container py-4 py-xl-5" style="margin-bottom: 10px;">
                <div class="row gy-4 gy-md-0">
                    <div class="col-md-6">
                        <div class="p-xl-5 m-xl-5 slides">
                            <img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="assets/img/agapbuhay.jpg">
                        </div>
                        <div class="p-xl-5 m-xl-5 slides">
                            <img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="assets/img/medicalequip.jpeg">
                        </div>
                        <div class="p-xl-5 m-xl-5 slides">
                            <img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="assets/img/wheelchair1.jpeg">
                        </div>
                        <div class="p-xl-5 m-xl-5 slides">
                            <img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="assets/img/housing2.jpeg">
                        </div>
                        <div class="p-xl-5 m-xl-5 slides">
                            <img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="assets/img/received_1212528529632403.jpeg">
                        </div>
                        <div class="p-xl-5 m-xl-5 slides">
                            <img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="assets/img/program1.jpg">
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div class="text-center" style="max-width: 350px;">
                            <h2 class="text-uppercase fw-bold" style="font-family: Acme, sans-serif;">Kada taga-bulan, buhay agapan</h2>
                            <p class="my-3" style="font-family: ABeeZee, sans-serif;">Kaagap Incorporated aims to aid the financial burden of every less fortunate residents of Bulan.</p>
                            <div>
                                <a class="btn btn-primary btn-lg me-2" role="button" href="#" data-bs-toggle="modal" data-bs-target="#membership-form" style="background: rgb(19,77,70);">Be our Member</a>
                            
                                <div class="modal fade" tabindex="-1" id="membership-form">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Apply for Membership</h5>

                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="far fa-window-close"><span class="path1"></span>
                                                    <span class="path2"></span></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row" method="POST" action="index.php" enctype="multipart/form-data" style="padding: 12px;">
                                                    <div class="personal-info">
                                                        <div class="row"  style="color: rgb(0,0,0);font-size: 16px;font-family: ABeeZee, sans-serif; text-align:left;">
                                                            <h4>Personal Details</h4>
                                                            <div class="col-md-12" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Name</label>
                                                                <input class="form-control" type="text" name="members_name" required>
                                                            </div>
                                                            <div class="col-md-12" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Address</label>
                                                                <input class="form-control" type="text" name="members_address" required>
                                                            </div>
                                                            <div class="col-md-4" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Birthdate</label>
                                                                <input class="form-control" type="date" name="members_birthdate" required onchange="calculateAge(this)">
                                                            </div>
                                                            <div class="col-md-4" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Age</label>
                                                                <input class="form-control" type="number" name="members_age" min="18" required>
                                                            </div>
                                                            <div class="col-md-4" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Civil Status</label>
                                                                <select class="form-control" type="select" name="members_civil_status" required>
                                                                    <option value="">Please select...</option>
                                                                    <option value="Single">Single</option>
                                                                    <option value="Married">Married</option>
                                                                    <option value="Widow">Widow</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Gender</label>
                                                                <select class="form-control" type="select" name="members_gender" required>
                                                                    <option value="">Please select...</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Contact Number</label>
                                                                <input class="form-control" type="tel" name="members_contact_number" maxLength="11" required>
                                                            </div>
                                                            <div class="col-md-4" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Work</label>
                                                                <input class="form-control" type="text" name="members_work" required>
                                                            </div>
                                                            <div class="col-md-12" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Household Monthly Income</label>
                                                                <select class="form-control" type="select" name="members_household_income" required>
                                                                    <option value="">Please select...</option>
                                                                    <option value="Less than Php 5,000.00">Less than Php 5,000.00</option>
                                                                    <option value="Php 5,000.00 to Php 10,000.00">Php 5,000.00 to Php 10,000.00</option>
                                                                    <option value="Php 10,000.00 to Php 20,000.00">Php 10,000.00 to Php 20,000.00</option>
                                                                    <option value="Php 20,000.00 to Php 50,000.00">Php 20,000.00 to Php 50,000.00</option>
                                                                    <option value="More than Php 50,000.00">More than Php 50,000.00</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="emergengency-contact">
                                                        <div class="row" style="color: rgb(0,0,0);font-size: 16px;font-family: ABeeZee, sans-serif; text-align:left;">
                                                            <h3>In case of emergency, please notify:</h3>
                                                            <div class="col-md-12" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Name</label>
                                                                <input class="form-control" type="text" name="contact_name" required>
                                                            </div>
                                                            <div class="col-md-12" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Address</label>
                                                                <input class="form-control" type="text" name="contact_address" required>
                                                            <div class="col-md-12" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Age</label>
                                                                <input class="form-control" type="number" name="contact_age" min="18" required>
                                                            </div>
                                                            <div class="col-md-12" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Contact Number</label>
                                                                <input class="form-control" type="tel" name="contact_phone" maxLength="11" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="lists-of-beneficiaries">
                                                        <div class="row"  style="color: rgb(0,0,0);font-size: 16px; display: flex;font-family: ABeeZee, sans-serif; text-align:left;">
                                                            <h4>List of Beneficiaries:</h4>
                                                            <div id="beneficiaryContainer">
                                                                <div class="beneficiary-entry">
                                                                    <div class="col-md-2" style="padding: 4px; text-align: left;">
                                                                        <label class="form-label">Name</label>
                                                                        <input class="form-control" type="text" name="members_beneficiary_name" required>
                                                                    </div>
                                                                    <div class="col-md-2" style="padding: 4px; text-align: left;">
                                                                        <label class="form-label">Age</label>
                                                                        <input class="form-control" type="number" name="members_beneficiary_age" required>
                                                                    </div>
                                                                    <div class="col-md-2" style="padding: 4px; text-align: left;">
                                                                        <label class="form-label">Address</label>
                                                                        <input class="form-control" type="text" name="members_beneficiary_address" required>
                                                                    </div>
                                                                    <div class="col-md-2" style="padding: 4px; text-align: left;">
                                                                        <label class="form-label">Relationship</label>
                                                                        <input class="form-control" type="text" name="members_beneficiary_relationship"  required>
                                                                    </div>
                                                                    <div class="col-md-3" style="padding: 4px; text-align: left;">
                                                                        <label class="form-label" style="font-size:14px;">Household Monthly Income</label>
                                                                        <select class="form-control" type="select" name="members_beneficiary_income" required>
                                                                            <option value="">Please select...</option>
                                                                            <option value="Less than Php 5,000">Less than Php 5,000</option>
                                                                            <option value="Php 5,000.00 to Php 10,000.00">Php 5,000.00 to Php 10,000.00</option>
                                                                            <option value="Php 10,000.00 to Php 20,000.00">Php 10,000.00 to Php 20,000.00</option>
                                                                            <option value="Php 20,000.00 to Php 50,000.00">Php 20,000.00 to Php 50,000.00</option>
                                                                            <option value="More than Php 50,000">More than Php 50,000</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="del" onclick="removeEntry(this)"><i class="fas fa-trash-alt  fs-3 text-success"></i></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button type="button" class="btn btn-primary" style="padding: 2px; padding-left: 5px; padding-right: 5px;  text-align: center; float: right;background: rgb(19,77,70); border-radius: 10px;" onclick="addBeneficiary()">Add Value</button>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="requirements">
                                                        <div class="row"  style="color: rgb(0,0,0);font-size: 16px;font-family: ABeeZee, sans-serif; text-align:left;">
                                                            <h4>Upload your Requirements:</h4>
                                                            <h5>
                                                                Upload any of the following:
                                                                <ul>
                                                                    <li>Barangay Indigency</li>
                                                                    <li>Valid ID</li>
                                                                </ul>
                                                            </h5>
                                                            <div class="col-md-12" style="padding: 4px; text-align: left;">
                                                                <label class="form-label">Identification Document</label>
                                                                <input class="form-control" type="file" name="members_identity" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="payment">
                                                        <div class="row"  style="color: rgb(0,0,0);font-size: 16px;font-family: ABeeZee, sans-serif; text-align:left;">
                                                            <h3>Please scan to pay membership fee</h3>
                                                            <img src="assets/img/scantopay.jpeg" style="width:250px;height:250px;">
                                                                <div class="col-md-12" style="padding: 4px; text-align: left;">
                                                                    <label class="form-label">Proof of Payment</label>
                                                                    <input class="form-control" type="file" name="proof_of_payment" required>
                                                                </div>
                                                                <div class="col-md-12" style="padding: 4px; text-align: center;">
                                                                   
                                                                    <button type="submit" class="btn btn-primary" style="background: rgb(19,77,70);">Submit Application</button>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="services" class="services">
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <h1 class="text-center" style="font-family: Acme, sans-serif;">What We Do</h1>
                <p style="text-align: center;font-family: ABeeZee, sans-serif;">Kaagap Incorporated helps less fortunate people of Bulan through providing an access to the following assistance:</p>
            </div>
            <div class="container">
                <div class="row gy-4" style="margin-bottom: 15px;">
                    <div class="col-lg-6 aos-init aos-animate">
                        <h1 class="title" style="color: rgb(4,4,4);">
                            <a href="assistance_application.php" data-assistance-type="financial" style="color: rgb(0,0,0);text-decoration: none;font-size: 24px;">
                                <i class="fas fa-money-check-alt fs-2 text-success" style="padding-right: 15px;"></i>Financial Assistance
                            </a>
                        </h1>
                    </div>
                    <div class="col-lg-6 aos-init aos-animate">
                        <h1 class="title" style="color: rgb(4,4,4);">
                            <a href="assistance_application.php" data-assistance-type="medical" style="color: rgb(0,0,0);text-decoration: none;font-size: 24px;">
                                <i class="fas fa-file-medical fs-2 text-success" style="padding-right: 15px;"></i>Medical Assistance
                            </a>
                        </h1>
                    </div>
                    <div class="col-lg-6 aos-init aos-animate">
                        <h1 class="title" style="color: rgb(4,4,4);">
                            <a href="assistance_application.php" data-assistance-type="burial" style="color: rgb(0,0,0);text-decoration: none;font-size: 24px;">
                                <i class="fas fa-cross fs-2 text-success" style="padding-right: 15px;"></i>Burial Assistance
                            </a>
                        </h1>
                    </div>
                    <div class="col-lg-6 aos-init aos-animate">
                        <h1 class="title" style="color: rgb(4,4,4);">
                            <a href="assistance_application.php" data-assistance-type="housing" style="color: rgb(0,0,0);text-decoration: none;font-size: 24px;">
                                <i class="fas fa-home fs-2 text-success" style="padding-right: 15px;"></i>Housing Assistance
                            </a>
                        </h1>
                    </div>
                    <div class="col-lg-6 aos-init aos-animate">
                        <h1 class="title" style="color: rgb(4,4,4);">
                            <a href="assistance_application.php" data-assistance-type="transportation" style="color: rgb(0,0,0);text-decoration: none;font-size: 24px;">
                                <i class="fas fa-truck-moving fs-2 text-success" style="padding-right: 15px;"></i>Transportation Assistance
                            </a>
                        </h1>
                    </div>
                    <div class="col-lg-6 aos-init aos-animate">
                        <h1 class="title" style="color: rgb(4,4,4);">
                            <a href="assistance_application.php" data-assistance-type="medicines" style="color: rgb(0,0,0);text-decoration: none;font-size: 24px;">
                                <i class="fas fa-pills fs-2 text-success" style="padding-right: 15px;"></i>Free Medicines
                            </a>
                        </h1>
                    </div>
                    <div class="col-lg-6 aos-init aos-animate">
                        <h1 class="title" style="color: rgb(4,4,4);">
                            <a href="assistance_application.php" data-assistance-type="medicalequipment" style="color: rgb(0,0,0);text-decoration: none;font-size: 24px;">
                                <i class="fas fa-medkit fs-2 text-success" style="padding-right: 15px;"></i>Borrowing Medical Equipment
                            </a>
                        </h1>
                    </div>

                </div>
            </div>
        </section>
        <section id="about" class="about">
            <div class="container section-title aos-init aos-animate">
                <h1 class="text-center" style="font-family: Acme, sans-serif;margin: 15px;">About Us</h1>
            </div>
            <div class="container">
                <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="text-align: center;">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-title" style="text-align: center;font-family: Anybody, serif;font-weight: bold;">Our History</h4>
                                <p class="card-text">During the 2020 pandemic, Ms. Dina Camu Golpeo, a government employee from Bulan, Sorsogon, initiated Kaagap Incorporated to help a homeless man named Tatay Cadio. The LGU Bulan built a home for Cadio and visited him weekly. However, they had limited resources to help all the less fortunate in Bulan. Mr. Fiel Gerero urged them to transform into an association, which was granted on December 20, 2023, at Bulan Freedom Park.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-title" style="text-align: center;font-family: Anybody, serif;font-weight: bold;">Our Vision</h4>
                                <p class="card-text"> Kaagap Incorporated envisions community of empowered Bulaneños wherein everyone possesses the commitment to freely lend a hand in any way he/she is capable in crisis situations, and willingly contribute for the development of the health, economy, and socio-culture status of the Municipality of Bulan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-title" style="text-align: center;font-weight: bold;font-family: Anybody, serif;">Our Mission</h4>
                                <p class="card-text" style="text-align: justify;">To assist alleviate the hardships faced by the less and least fortunate Bulaneños, strive to reduce the burden on impoverished and vulnerable families through various means of assistance, and actively involve the members in fulfilling the purpose and objectives of Kaagap Incorporated.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="team" class="team" style="margin: 15px;">
            <div class="container section-title aos-init aos-animate">
                <h2 class="text-center" style="font-family: Acme, sans-serif;">Our Team</h2>
            </div>
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-4 col-md-6 member aos-init aos-animate" style="padding: 12px;">
                        <div class="text-center members-img"><img class="rounded-circle" src="assets/img/sirfiel.jpg" style="width: 250px;height: 250px;"></div>
                        <div>
                            <h1 class="text-center" style="font-family: Acme, sans-serif;">Fiel Gerero</h1>
                            <p class="text-center" style="font-size: 20px;font-family: ABeeZee, sans-serif;">Kaagap Incorporated President</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 member aos-init aos-animate" style="padding: 12px;">
                        <div class="text-center members-img"><img class="rounded-circle" src="assets/img/sirted.jpg" style="width: 250px;height: 250px;"></div>
                        <div>
                            <h1 class="text-center" style="font-family: Acme, sans-serif;">Ted Simoun De Leon</h1>
                            <p class="text-center" style="font-size: 20px;font-family: ABeeZee, sans-serif;">Kaagap Incorporated Secretary</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 member aos-init aos-animate" style="background: #ffffff;padding: 12px;">
                        <div class="text-center members-img"><img class="rounded-circle" src="assets/img/sirrc.png" style="width: 250px;height: 250px;background: #ffffff;"></div>
                        <div>
                            <h1 class="text-center" style="font-family: Acme, sans-serif;">RC Bañares</h1>
                            <p class="text-center" style="font-size: 20px;font-family: ABeeZee, sans-serif;">Kaagap Incorporated Staff</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="donations" class="donations" style="margin: 15px;">
            <div class="container">
                <h1 class="text-center" style="font-family: ABeeZee, sans-serif;">Support our Mission</h1>
                <div class="text-center row">
                    <div class="text-center col-lg-4" style="padding: 12px;">
                        <div class="card" style="box-shadow: 0px 0px 5px rgb(76,156,88);">
                            <div class="text-center card-body" style="box-shadow: 0px 0px;">
                                <h1 style="font-family: ABeeZee, sans-serif;margin: 15px;">Healthcare</h1><i class="fas fa-hand-holding-heart fs-1 text-success border rounded-circle rounded-circle" style="padding: 12px;background: rgb(217,231,225);margin: 15px;"></i>
                                <div class="text-center rounded-circle" style="padding: 15px;width: 71px;"></div><a class="btn btn-primary" role="button" style="background: rgb(6,132,71);font-family: Aclonica, sans-serif;font-size: 19PX;border-radius: 5PX;" href="donation-form.php">DONATE NOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center col-lg-4" style="padding: 12px;">
                        <div class="card" style="box-shadow: 0px 0px 5px rgb(76,156,88);">
                            <div class="text-center card-body" style="box-shadow: 0px 0px rgb(108,174,134);">
                                <h1 style="font-family: ABeeZee, sans-serif;margin: 15px;">Cash</h1><i class="fas fa-money-check-alt fs-1 text-success border rounded-circle rounded-circle" style="padding: 12px;background: rgb(217,231,225);margin: 15px;"></i>
                                <div class="text-center rounded-circle" style="padding: 15px;width: 71px;"></div><a class="btn btn-primary" role="button" style="background: rgb(6,132,71);font-family: Aclonica, sans-serif;font-size: 19PX;border-radius: 5PX;" href="donation-form.php">DONATE NOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center col-lg-4" style="padding: 12px;">
                        <div class="card" style="box-shadow: 0px 0px 5px rgb(76,156,88);">
                            <div class="text-center card-body" style="box-shadow: 0px 0px;">
                                <h1 style="font-family: ABeeZee, sans-serif;margin: 15px;">Supplies</h1><i class="fas fa-boxes fs-1 text-success border rounded-circle rounded-circle" style="padding: 12px;background: rgb(217,231,225);margin: 15px;"></i>
                                <div class="text-center rounded-circle" style="padding: 15px;width: 71px;"></div><a class="btn btn-primary" role="button" style="background: rgb(6,132,71);font-family: Aclonica, sans-serif;font-size: 19PX;border-radius: 5PX;" href="donation-form.php">DONATE NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer id="contact" class="contact">
            <div class="container">
                <div class="row gy-4" style="margin: 15px;">
                    <h1 class="text-center" style="font-family: ABeeZee, sans-serif;">Contact Us</h1>
                    <div class="col-md-6">
                        <div class="info-item"><i class="fas fa-search-location fs-1" style="margin-bottom: 5px;color: rgb(35,147,53);"></i>
                            <h4 style="font-family: ABeeZee, sans-serif;margin: 5px;">Address</h4>
                            <p style="font-size: 18px;font-family: Acme, sans-serif;">N. Roque St. Phase 1 Annex Building, Second Floor, Bulan Public Market, Zone-4, Bulan, Sorsogon</p>
                        </div>
                        <div class="info-item"><i class="fas fa-envelope fs-1" style="margin-bottom: 5px;color: rgb(55,149,76);"></i>
                            <h4 style="font-family: ABeeZee, sans-serif;margin: 5px;">Email</h4>
                            <p style="font-size: 18px;font-family: Acme, sans-serif;">agapbuhayassociationinc23@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item"><i class="fab fa-facebook fs-1" style="margin-bottom: 5px;color: rgb(55,149,76);"></i>
                            <h4 style="font-family: ABeeZee, sans-serif;margin: 5px;">Facebook</h4>
                            <p style="font-size: 18px;font-family: Acme, sans-serif;">https://www.facebook.com/KaagapINC</p>
                        </div>
                        <div class="info-item"><i class="fas fa-phone fs-1" style="margin-bottom: 5px;color: rgb(55,149,76);"></i>
                            <h4 style="font-family: ABeeZee, sans-serif;margin: 5px;">Call Us</h4>
                            <p style="font-size: 18px;font-family: Acme, sans-serif;">0949-101-0459</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        function toggleDeleteIcon(input) {
            const entry = input.closest('.beneficiary-entry');
            const deleteIcon = entry.querySelector('.del');
            const allInputsFilled = Array.from(entry.querySelectorAll('input, select')).every(input => input.value.trim() !== '');
            deleteIcon.classList.toggle('visible', allInputsFilled);
        }

        function addBeneficiary() {
    const container = document.getElementById('beneficiaryContainer');
    const newEntry = document.createElement('div');
    newEntry.className = 'beneficiary-entry';
    newEntry.innerHTML = `
        <div class="col-md-2" style="padding: 4px; text-align: left;">
            <input class="form-control" type="text" name="members_beneficiary_name" required oninput="toggleDeleteIcon(this)">
        </div>
        <div class="col-md-2" style="padding: 4px; text-align: left;">
            <input class="form-control" type="number" name="members_beneficiary_age" required min="18" oninput="toggleDeleteIcon(this)">
        </div>
        <div class="col-md-2" style="padding: 4px; text-align: left;">
            <input class="form-control" type="text" name="members_beneficiary_address" required oninput="toggleDeleteIcon(this)">
        </div>
        <div class="col-md-2" style="padding: 4px; text-align: left;">
            <input class="form-control" type="text" name="members_beneficiary_relationship" required oninput="toggleDeleteIcon(this)">
        </div>
        <div class="col-md-3" style="padding: 4px; text-align: left;">
            <select class="form-control" type="select" name="members_beneficiary_income" required oninput="toggleDeleteIcon(this)">
                <option value="">Please select...</option>
                <option value="less5">Less than Php 5,000</option>
                <option value="5to10">Php 5,000.00 to Php 10,000.00</option>
                <option value="10to20">Php 10,000.00 to Php 20,000.00</option>
                <option value="20to50">Php 20,000.00 to Php 50,000.00</option>
                <option value="morethan50">More than Php 50,000</option>
            </select>
        </div>
        <div class="del visible" onclick="removeEntry(this)"><i class="fas fa-trash-alt"></i></div>
    `;
    container.appendChild(newEntry);
}
        function removeEntry(deleteIcon) {
            const entry = deleteIcon.closest('.beneficiary-entry');
            entry.remove();
        }
        function calculateAge(birthdateInput) {
    const birthdate = new Date(birthdateInput.value);
    const today = new Date();
    let age = today.getFullYear() - birthdate.getFullYear();
    const monthDifference = today.getMonth() - birthdate.getMonth();
 
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdate.getDate())) {
        age--;
    }
    const ageInput = document.querySelector('input[name="members_age"]');
    ageInput.value = age;
}
    </script>

</body>
</html>
