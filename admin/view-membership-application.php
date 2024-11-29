<?php
include '../include/dbconnect.php';

if (isset($_GET['application_number'])) {
    $application_id = intval($_GET['application_number']); 
    $query = "SELECT * FROM membership_requests WHERE application_number = :members_id";
    
    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':members_id', $application_id, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $application = $stmt->fetch(PDO::FETCH_ASSOC); 
        } else {
            echo "No application found.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "No application ID specified.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Membership Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/Navbar-Right-Links.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
   <section class="dashboard">
   <div class="container">
        <h2>Application Details</h2>

        <form class="row" method="POST" action="process_application.php" enctype="multipart/form-data" style="padding: 12px;">
            <input type="hidden" name="application_id" value="<?php echo $application['application_number']; ?>">
            <div class="personal-info">
                    <div class="row"  style="color: rgb(0,0,0);font-size: 16px;font-family: Rubik, sans-serif; text-align:left;">
                        <h4>Personal Details</h4>
                        <div class="col-md-12" style="padding: 4px; text-align: left;">
                            <label class="form-label">Name</label>
                            <div class="form-control" style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_name']); ?>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 4px; text-align: left;">
                            <label class="form-label">Address</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_address']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Birthdate</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_birthdate']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Age</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_age']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Civil Status</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_civil_status']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Gender</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_gender']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Contact Number</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_contact_number']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Work</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_work']); ?>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 4px; text-align: left;">
                            <label class="form-label">Household Monthly Income</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_household_income']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="emergengency-contact">
                    <div class="row" style="color: rgb(0,0,0);font-size: 16px;font-family: Rubik, sans-serif; text-align:left;">
                        <h3>In case of emergency, please notify:</h3>
                        <div class="col-md-12" style="padding: 4px; text-align: left;">
                            <label class="form-label">Name</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['contact_name']); ?>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 4px; text-align: left;">
                            <label class="form-label">Address</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['contact_address']); ?>
                            </div>
                        <div class="col-md-12" style="padding: 4px; text-align: left;">
                            <label class="form-label">Age</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['contact_age']); ?>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 4px; text-align: left;">
                            <label class="form-label">Contact Number</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['contact_phone']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lists-of-beneficiaries">
                    
                    <div class="row" style="color: rgb(0,0,0); font-size: 16px; font-family: Rubik, sans-serif; text-align: left;">
                        <h4>List of Beneficiaries:</h4><br>
                        <div id="beneficiaryContainer">
                            <div class="beneficiary-entry">
                                <div class="col-md-12" style="padding: 4px; text-align: left;">
                                    <label class="form-label">Name</label>
                                    <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                    <?php echo htmlspecialchars($application['members_beneficiary_name']); ?>
                                    </div>
                                   
                                </div>
                                <div class="col-md-12" style="padding: 4px; text-align: left;">
                                    <label class="form-label">Age</label>
                                    <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['members_beneficiary_age']); ?>
                            </div>
                                </div>
                                <div class="col-md-12" style="padding: 4px; text-align: left;">
                                    <label class="form-label">Address</label>
                                    <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                    <?php echo htmlspecialchars($application['members_beneficiary_address']); ?>
                            </div>
                           
                                </div>
                                <div class="col-md-12" style="padding: 4px; text-align: left;">
                                    <label class="form-label">Relationship</label>
                                    <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                    <?php echo htmlspecialchars($application['members_beneficiary_relationship']); ?>
                            </div>
                                </div>
                                <div class="col-md-12" style="padding: 4px; text-align: left;">
                                    <label class="form-label" style="font-size:14px;">Household Monthly Income</label>
                                    <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                    <?php echo ($application['members_beneficiary_income'] == 'less5') ? 'selected' : ''; ?>

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="requirements" style="text-align: center;">
                    <div class="row" style="color: rgb(0,0,0); font-size: 16px; font-family: Rubik, sans-serif;">
                        <div class="col-md-6" style="padding: 4px;">
                            <label class="form-label">Identification Document</label>
                            <?php if (!empty($application['members_identity_path'])): ?>
                                <div>
                                    <a href="<?php echo htmlspecialchars($application['members_identity_path']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download>Download Identification Document</a>
                                </div>
                            <?php else: ?>
                                <p>No file uploaded or file not found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="payment" style="text-align: center;">
                <div class="row" style="color: rgb(0,0,0); font-size: 16px; font-family: Rubik, sans-serif;">
                        <div class="col-md-12" style="padding: 4px;">
                            <label class="form-label">Proof of Payment</label>
                            <?php if (!empty($application['proof_of_payment_path'])): ?>
                                <div>
                                    <strong>Uploaded File (Preview)</strong> 
                                    <br>
                                    <img src="<?php echo htmlspecialchars($application['proof_of_payment_path']); ?>" alt="Uploaded Identification Document" style="width: 550px; height: 350px; margin-top: 10px;"><br>
                                    <a href="<?php echo htmlspecialchars($application['members_identity_path']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download>Download Proof of Payment</a>
                                </div>
                            <?php else: ?>
                                <p>No file uploaded or file not found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="decision" value="accept" class="btn btn-primary">Accept</button>
                    <button type="submit" name="decision" value="decline" class="btn btn-danger">Decline</button>
                </div>
        </form>
    </div>
   </section>
</body>
</html>