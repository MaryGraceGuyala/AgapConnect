<?php
require '../include/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assistance_type = $_POST['assistance_type'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $sex = $_POST['sex'];
    $civil_status = $_POST['civil_status'];
    $contact_number = $_POST['contact_number'];
    $household_income = $_POST['household_income'];
    $medical_diagnosis = $_POST['medical_diagnosis'];
    $patient_type = $_POST['patient_type'];
    $hospital = $_POST['hospital'];
    $representative_name = $_POST['representative_name'];
    $representative_age = $_POST['representative_age'];
    $representative_relationship = $_POST['representative_relationship'];
    $representative_contact_number = $_POST['representative_contact_number'];

 
    $sql = "INSERT INTO assistance_applications (assistance_type, fname, mname, lname, birthdate, age, address, sex, civil_status, contact_number, household_income, medical_diagnosis, patient_type, hospital, representative_name, representative_age, representative_relationship, representative_contact_number) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);


    if ($stmt->execute([$assistance_type, $fname, $mname, $lname, $birthdate, $age, $address, $sex, $civil_status, $contact_number, $household_income, $medical_diagnosis, $patient_type, $hospital, $representative_name, $representative_age, $representative_relationship, $representative_contact_number])) {

        $applicationId = $pdo->lastInsertId();

        $uploadDir = 'uploads/';
    
    
    $fileDirectories = [
        'barangay_certificate_of_indigency' => 'barangay_certificate/',
        'valid_id' => 'valid_id/',
        'medical_abstract' => 'medical_abstract/',
        'prescription' => 'prescription/',
        'lab_requests' => 'lab_requests/',
        'death_certificate' => 'death_certificate/',
        'funeral_contract' => 'funeral_contract/',
        'funeral_balance' => 'funeral_balance/',
    ];

    foreach ($fileDirectories as $dir) {
        if (!is_dir($uploadDir . $dir)) {
            mkdir($uploadDir . $dir, 0777, true);
        }
    }

    foreach ($fileDirectories as $inputName => $dir) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK) {
            $filePath = $uploadDir . $dir . basename($_FILES[$inputName]['name']);
            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $filePath)) {
                echo "Uploaded $inputName successfully to $filePath.<br>";
            } else {
                echo "Failed to upload $inputName.<br>";
            }
        } else {
            if (isset($_FILES[$inputName])) {
                echo "Error uploading $inputName: " . $_FILES[$inputName]['error'] . "<br>";
            }
        }
    }
    

        sendSmsNotification($contact_number, "Your application has been received. Your application ID is: $applicationId");

        echo "Application submitted successfully!";
    } else {
        echo "Error submitting application.";
    }
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
    curl_close($ch );

    return $response;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Assistance Application</title>
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
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between"><a class="logo d-flex align-items-center me-auto me-xl-0" href="index.php"><img src="assets/img/AgapConnect%20(3).png" style="width: 150px;height: 50px;"></a>
            <nav class="navbar navbar-light navbar-expand-md text-center navmenu" id="navmenu">
                <div class="container-fluid"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php#home">Home</a>
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
            </nav><a class="order-last" href="index.php#donations" style="padding: 15px;color: rgb(255,255,255);background: #018f42;text-decoration: none;border-radius: 4px;padding-right: 5px;padding-top: 10px;padding-bottom: 10px;padding-left: 5px;">Donate Now</a>
        </div>
    </header>
    <main style="padding: 25px; margin-top: 70px;">
        <div class="page-title">
            <h1 style="font-family: Acme, sans-serif;font-size: 26px;">Apply for Assistance</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body" style="box-shadow: 0px 0px 4px;">
                            <h4 class="card-title" style="text-align: justify;">Eligibility in Applying Assistance:</h4>
                            <div class="eligibility" style="text-align: justify;">
                                <span style="color: rgb(7,7,7);text-align: justify;font-family: ABeeZee, sans-serif;font-size: 16px;">1. Applicants must be a bonafide resident of Bulan, Sorsogon.</span>
                            </div>
                            <div class="eligibility" style="text-align: justify;">
                                <span style="color: rgb(7,7,7);text-align: justify;font-family: ABeeZee, sans-serif;font-size: 16px;">2. Applicants must be belong to a less fortunate residents of Bulan, Sorsogon.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="box-shadow: 0px 0px 4px;">
                            <h4 class="card-title" style="text-align: justify;">Requirements for Medical Assistance:</h4>
                                <h5 style="color: rgb(11,11,11);">Inpatient:</h5>
                                    <ul class="requirements-needed" style="color: rgb(0,0,0);font-size: 16px;font-family: ABeeZee, sans-serif;">
                                        <li>Medical Abstract/Certificate</li>
                                        <li style="text-align: justify;">Baranggay Certificate of Indigency</li>
                                        <li>Valid ID (Processor)</li>
                                    </ul>
                            <h5 style="color: rgb(11,11,11);">Outpatient:</h5>
                            <ul class="requirements-needed" style="color: rgb(0,0,0);font-size: 16px;font-family: ABeeZee, sans-serif;">
                                <li>Medical Certificate</li>
                                <li style="text-align: justify;">Baranggay Certificate of Indigency</li>
                                <li>Valid ID (Processor)</li>
                                <li>Updated Resita/Prescription</li>
                                <li>Laboratory/Medical Request</li>
                            </ul>
                        </div>
                    </div>
                <div class="card">
                    <div class="card-body" style="box-shadow: 0px 0px 4px;">
                        <h4 class="card-title" style="text-align: justify;">Requirements for Burial Assistance:</h4>
                        <ul class="requirements-needed" style="color: rgb(0,0,0);font-size: 16px;font-family: ABeeZee, sans-serif;">
                            <li>Funeral Contract</li>
                            <li style="text-align: justify;">Funeral Balance</li>
                            <li style="text-align: justify;">Death Certificate</li>
                            <li>Valid ID (Processor) - Immediate Family Member of Deceased</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card" style="box-shadow: 0px 0px 5px rgb(80,152,62);">
                    <div class="card-body" style="color: rgb(0,0,0);font-size: 16px;font-family: ABeeZee, sans-serif;">
                        <form method="POST" action="assistance_application.php" class="assistance-application-form" style="padding: 3px;">
                            <div id="step1" class="d-flex row mb-3 step-content active">
                                <div class="col-md-12">
                                    <label class="form-label col-md-12 col-form-label" style="color: rgb(0,0,0);font-family: Acme, sans-serif;font-size: 16px;text-align: justify;">Choose type of Assistance:</label>
                                    <select id="assistance-type" name="assistance_type" class="form-select" style="font-family: ABeeZee, sans-serif;" onchange="showMedicalFields()">
                                        <option value selected>Please select here...</option>
                                        <option value="Financial Assistance">Financial Assistance</option>
                                        <option value="Medical Assistance">Medical Assistance</option>
                                        <option value="Burial Assistance">Burial Assistance</option>
                                        <option value="Transportation Assistance">Transportation Assistance</option>
                                        <option value="Housing Assistance">Housing Assistance</option>
                                        <option value="Free Medicines">Free Medicines</option>
                                        <option value="Borrow Medical Equipments">Borrow Medical Equipments</option>
                                    </select></div>
                                <div style="padding-left: 2px;">
                                    <h4 style="margin-top: 8px;">Personal Details</h4>
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">First Name</label>
                                    <input class="form-control" type="text"name="fname" required>
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">Middle Name</label>
                                    <input class="form-control" type="text" name="mname">
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">Last Name</label>
                                    <input class="form-control" type="text" name="lname" required>
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">Birthdate</label>
                                    <input class="form-control" type="text" name="birthdate" required>
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">Age</label>
                                    <input class="form-control" type="text" name="age" required>
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" type="text" id="address" name="address" required>
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">Sex</label>
                                    <select class="form-select"  name="sex" required>
                                        <option value="" selected="">Please select...</option>
                                        <option value="Male" name="sex">Male</option>
                                        <option value="Female" name="sex">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                        <label class="form-label">Civil Status:</label>
                                        <select class="form-select" name="civil_status" required>
                                            <option value="" selected="">Please select...</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widow">Widow</option>
                                        </select>
                                    </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">Contact Number</label>
                                    <input class="form-control" type="tel"name="contact_number" maxLength=11 required>
                                </div>
                                <div class="col-sm-12">
                                        <label class="form-label col-md-12col-form-label" style="color: rgb(0,0,0);font-family: Acme, sans-serif;font-size: 16px;">Household Monthly Income:</label>
                                        <select class="form-select" name="household_income" id="assistance-type-1" style="font-family: ABeeZee, sans-serif;" onchange="showMedicalFields()">
                                            <option value="" selected="">Please select here...</option>
                                            <option value="Less than Php 5,000.00">Less than Php 5,000</option>
                                            <option value="Php 5,000.00 to Php 10,000.00">Php 5,000.00 to Php 10,000.00</option>
                                            <option value="Php 10,000.00 to Php 20,000.00">Php 10,000.00 to Php 20,000.00</option>
                                            <option value="Php 20,000.00 to Php 50,000.00">Php 20,000.00 to Php 50,000.00</option>
                                            <option value="More than Php 50,000.00">More than Php 50,000.00</option>
                                        </select>
                                    </div>
                                    <div id="medical-fields" class="row mb-3" style="margin-top: 10px;padding-top: 12px;">
                                        <h5 style="text-align: justify;font-size: 16px;color: rgb(51,49,49);">This should be filled up if the type of assistance chosen is Medical Assistance</h5>
                                        <div class="col-md-4" style="padding: 4px;">
                                            <label class="form-label">Complete Diagnosis&nbsp;</label>
                                            <input class="form-control" type="text" name="medical_diagnosis">
                                        </div>
                                        <div class="col-md-4" style="padding: 4px;">
                                            <label class="form-label">Patient Type</label>
                                            <select class="form-select" name="patient_type">
                                                <option value="" selected="">Please select...</option>
                                                <option value="Inpatient">In Patient</option>
                                                <option value="Outpatient">Out Patient</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="padding: 4px;">
                                            <label class="form-label">Hospital</label>
                                            <input class="form-control" type="text" name="hospital">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <h4>Representative</h4>
                                        <div class="col-md-12" style="padding: 4px;">
                                            <label class="form-label">Name of Representative</label>
                                            <input class="form-control" type="text" name="representative_name">
                                        </div>
                                        <div class="col-md-4" style="padding: 4px;">
                                            <label class="form-label">Age</label>
                                            <input class="form-control" type="text" name="representative_age">
                                        </div>
                                        <div class="col-md-4" style="padding: 4px;">
                                            <label class="form-label">Relationship</label>
                                            <input class="form-control" type="text"  name="representative_relationship" >
                                        </div>
                                        <div class="col-md-4" style="padding: 4px;">
                                            <label class="form-label">Contact Number</label>
                                            <input class="form-control" type="text"  name="representative_contact_number">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex row mb-3" id="step2" style="display: none;">
                                    <div style="padding-left: 2px;">
                                        <h4 style="margin-top: 8px;">Upload Requirements</h4>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6" style="padding: 4px;">
                                            <label class="form-label">Barangay Certificate of Indigency</label>
                                            <input class="form-control" type="file" name="barangay_certificate_of_indigency">
                                        </div>
                                        <div class="col-md-6" style="padding: 4px;">
                                            <label class="form-label">Valid ID (Processor)</label>
                                            <input class="form-control" type="file" name="valid_id">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <h5>Requirements for Medical Assistance</h5>
                                        <div class="col-md-6" style="padding: 4px;">
                                            <label class="form-label">Medical Abstract/Certificate</label>
                                            <input class="form-control" type="file" name="medical_abstract">
                                        </div>
                                        <div class="col-md-6" style="padding: 4px;">
                                            <label class="form-label">Updated Prescription</label>
                                            <input class="form-control" type="file" name="prescription">
                                        </div>
                                        <div class="col-md-6" style="padding: 4px;">
                                            <label class="form-label">Laboratory / Medical Request</label>
                                            <input class="form-control" type="file" name="lab_requests">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <h5>Requirements for Burial Assistance</h5>
                                        <div class="col-md-6" style="padding: 4px;">
                                            <label class="form-label">Death Certificate</label>
                                            <input class="form-control" type="file" name="death_certificate">
                                        </div>
                                        <div class="col-md-6" style="padding: 4px;">
                                            <label class="form-label">Funeral Contract</label>
                                            <input class="form-control" type="file" name="funeral_contract">
                                        </div>
                                        <div class="col-md-6" style="padding: 4px;">
                                            <label class="form-label">Funeral Balance</label>
                                            <input class="form-control" type="file" name="funeral_balance">
                                        </div>
                                    </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-primary col-md-12" type="submit" style="background: var(--bs-success);border-style: none;">Submit Application</button>
                                </div>
                            </div>
                        </form>
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
    <script>
        const apiKey = '8bb365f57af94dabaf9249fec01bc3c6';
        const url = 'https://api.geoapify.com/v1/geocode/autocomplete?text=863&type=postcode&filter=countrycode:de&format=json&limit=20&apiKey=' + apiKey;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const barangayList = document.getElementById('barangays');
                data.features.forEach(feature => {
                    const li = document.createElement('li');
                    li.textContent = feature.properties.name;
                    barangayList.appendChild(li);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>

</html>