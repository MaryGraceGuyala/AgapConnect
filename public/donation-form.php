<?php
require '../include/dbconnect.php'; 

function generateTransactionNumber() {
    return uniqid(true);  
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donor_first_name = $_POST['donor_first_name'];
    $donor_middle_name = $_POST['donor_middle_name'];
    $donor_last_name = $_POST['donor_last_name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $contact_number = $_POST['contact_number'];
    $donation_type = isset($_POST['donation_type']) ? implode(", ", $_POST['donation_type']) : '';
    $donation_items = $_POST['donation_items'];
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];

    $uploads = ['proof_of_donation'];
    $file_paths = [];

    foreach ($uploads as $upload) {
        if (isset($_FILES[$upload]) && $_FILES[$upload]['error'] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES[$upload]["name"]);
            if (move_uploaded_file($_FILES[$upload]["tmp_name"], $target_file)) {
                $file_paths[$upload] = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            $file_paths[$upload] = null;
        }
    }

    $transaction_number = generateTransactionNumber(); 

    $sql = "INSERT INTO donations (donor_first_name, donor_middle_name, donor_last_name, address, age, sex, contact_number, donation_type, donation_items, amount, quantity, proof_of_donation, transaction_number)
            VALUES (:donor_first_name, :donor_middle_name, :donor_last_name, :address, :age, :sex, :contact_number, :donation_type, :donation_items, :amount, :quantity, :proof_of_donation, :transaction_number)";

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([
        ':donor_first_name'=> $donor_first_name, 
        ':donor_middle_name'=> $donor_middle_name, 
        ':donor_last_name'=> $donor_last_name, 
        ':address'=>$address, 
        ':age'=> $age, 
        ':sex'=> $sex, 
        ':contact_number'=> $contact_number, 
        ':donation_type'=> $donation_type, 
        ':donation_items'=> $donation_items, 
        ':amount'=> $amount, 
        ':quantity'=> $quantity,
        ':proof_of_donation'=> $file_paths['proof_of_donation'],
        ':transaction_number'=> $transaction_number
    ])) { 
        
        $notification_sql = "INSERT INTO notifications (message) VALUES (:message)";
        $notification_stmt = $pdo->prepare($notification_sql);
        $message = "New donation received from " . $donor_first_name . " " . $donor_last_name . " (Transaction #: $transaction_number)";
        $notification_stmt->execute([':message' => $message]);

        
        header ('Location: donation_history.php?donor_first_name=' . urlencode($donor_first_name));
    } else {
        echo "Error submitting donation.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Donate Now</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Hero-Clean-Reverse.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script>
        function toggleFields() {
    const cashChecked = document.querySelector('input[name="donation_type[]"][value="cash"]').checked;
    const healthcareChecked = document.querySelector('input[name="donation_type[]"][value="healthcare"]').checked;
    const suppliesChecked = document.querySelector('input[name="donation_type[]"][value="supplies"]').checked;

    const amountField = document.querySelector('input[name="amount"]');
    const quantityField = document.querySelector('input[name="quantity"]');

   
    if (cashChecked && healthcareChecked && suppliesChecked) {
        amountField.disabled = false;
        quantityField.disabled = false;
    }
    if (cashChecked && healthcareChecked || cashChecked && suppliesChecked) {
        amountField.disabled = false;
        quantityField.disabled = false;
    }
    else if (cashChecked) {
        amountField.disabled = false;
        quantityField.disabled = true;
        quantityField.value = ''; 
    }
    
    else if (healthcareChecked || suppliesChecked) {
        quantityField.disabled = false;
        amountField.disabled = true;
        amountField.value = ''; 
    }
    else {
        amountField.disabled = true;
        quantityField.disabled = true;
        amountField.value = '';
        quantityField.value = '';
    }
}
    </script>
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
    <main class="main-index" id="main-index" style="margin-top: 60px;"> 
    <section class="section dashboard" style="margin-top: 60px;padding: 12px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="padding: 12px;">
                         <div class="card-header">
                             <h2>Help us to get to know you better. Please provide us with your contact information.</h2>
                         </div>
                         <div class="card-body">
                            <form class="row" method="POST" action="donation-form.php" enctype="multipart/form-data" style="padding: 12px;">
                                <div class="col-md-12" style="padding: 4px;">
                                    <h2>Donor Information</h2>
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label for="donor_first_name" class="form-label">First Name</label>
                                    <input type="text" name="donor_first_name" class="form-control" id="donor_first_name" required>
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">Middle Name</label>
                                    <input class="form-control" type="text" name="donor_middle_name">
                                </div>
                                <div class="col-md-4" style="padding: 4px;">
                                    <label class="form-label">Last Name</label>
                                    <input class="form-control" type="text" name="donor_last_name" required>
                                </div>
                                <div class="col-md-6" style="padding: 4px;">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" type="text" name="address" required>
                                </div>
                                <div class="col-md-6" style="padding: 4px;">
                                    <label class="form-label">Age</label>
                                    <input class="form-control" type="number" name="age" required>
                                </div>
                                <div class="col-md-6" style="padding: 4px;">
                                    <label class="form-label">Sex</label>
                                    <select class="form-select" name="sex" required>
                                        <option value="" selected="">Please select...</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6" style="padding: 4px;">
                                    <label class="form-label">Contact Number</label>
                                    <input class="form-control" type="text" name="contact_number" maxLength=11 required>
                                </div>
                                <div class="col-md-12" style="padding: 4px;">
                                    <h2>Donation Type</h2>
                                </div>
                                <div class="col-md-12" style="padding: 4px;">
                                    <label class="form-label">Type of Donation:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="donation_type[]" value="healthcare" onchange="toggleFields()">
                                        <label class="form-check-label">Healthcare</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="donation_type[]" value="cash" onchange="toggleFields()">
                                        <label class="form-check-label">Cash</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="donation_type[]" value="supplies" onchange="toggleFields()">
                                        <label class="form-check-label">Supplies</label>
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding: 4px;">
                                    <label class="form-label">Donation Items:</label>
                                    <input class="form-control" type="text" name="donation_items" required>
                                </div>
                                <div class="col-md-12" style="padding: 4px;">
                                    <h4>Donation Payment</h4>
                                </div>
                                <div class="col-md-12">
                                    <span style="font-size: 19px;">For cash donations</span>
                                    <div class="d-grid justify-content-center align-items-center" style="font-size: 19px;">
                                        <label class="form-label" style="text-align: center;font-size: 19px;">Scan to Donate</label>
                                        <img class="d-md-flex" src="assets/img/scantopay.jpeg" style="width: 250px;height: 250px;" /></div>
                                    <div>
                                        <label class="form-label" style="font-size: 19px;">Amount</label>
                                        <input class="form-control" type="text" style="font-size: 19px;" name="amount" disabled>
                                    </div>
                                    <div>
                                        <span style="font-size: 19px;">
                                            <br/>For healthcare and supplies donations<br />
                                            <br/>
                                        </span>
                                        <label class="form-label" style="font-size: 19px;">Quantity</label>
                                        <input class="form-control" type="number" style="font-size: 19px;" name="quantity" disabled>
                                    </div>
                                    <div>
                                        <label class="form-label" style="font-size: 19px;">Proof of Donation</label>
                                        <input class="form-control" type="file" style="font-size: 19px;" name="proof_of_donation">
                                    </div>
                                </div> 
                                <div class="col-md-12 text-center d-flex justify-content-evenly" style="padding: 4px; text-align: center;">
                                    <button type="submit" class="btn btn-primary" style="background: rgb(5,108,34);font-size: 19px;height: 42px;width: 113.9px;border-style: none;">Submit</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>          
            </div>
        </div>
    </section>
</main>

</body>
</html>

