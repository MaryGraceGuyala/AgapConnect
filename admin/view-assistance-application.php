<?php
include '../include/dbconnect.php';

if (isset($_GET['id'])) {
    $application_id = intval($_GET['id']); 
    $query = "SELECT * FROM assistance_applications WHERE id = :assistance_id";
    
    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':assistance_id', $application_id, PDO::PARAM_INT);
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
    <title>Review Application</title>
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

        <form class="row" method="POST" action="process_assistance_application.php" enctype="multipart/form-data" style="padding: 12px;">
            <input type="hidden" name="application_id" value="<?php echo $application['id']; ?>">
            <div class="personal-info">
                    <div class="row"  style="color: rgb(0,0,0);font-size: 16px;font-family: Rubik, sans-serif; text-align:left;">
                        <div class="col-md-12">
                            <label class="form-label col-md-12 col-form-label" style="color: rgb(0,0,0);font-family: Acme, sans-serif;font-size: 16px;text-align: justify;">Type of Assistance:</label>
                            <div class="form-control" style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['assistance_type']); ?>
                            </div>
                        </div>
                        <h4>Personal Details</h4>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">First Name</label>
                            <div class="form-control" style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['fname']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Middle Name</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['mname']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Last Name</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['lname']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Birthdate</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['birthdate']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Age</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['age']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Address</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['address']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Sex</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['sex']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Civil Status</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['civil_status']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px; text-align: left;">
                            <label class="form-label">Contact Number</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['contact_number']); ?>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 4px; text-align: left;">
                            <label class="form-label">Household Monthly Income</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                                <?php echo htmlspecialchars($application['household_income']); ?>
                            </div>
                        </div>
                    </div>
                </div> 
                <div id="medical-fields" class="row mb-3" style="margin-top: 10px;padding-top: 12px;">
                    <h5 style="text-align: justify;font-size: 16px;color: rgb(51,49,49);">This should be filled up if the type of assistance chosen is Medical Assistance</h5>
                    <div class="col-md-4" style="padding: 4px;">
                        <label class="form-label">Complete Diagnosis&nbsp;</label>
                        <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;">
                            <?php echo htmlspecialchars($application['medical_diagnosis']); ?>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 4px;">
                        <label class="form-label">Patient Type</label>
                        <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;"> 
                            <?php echo htmlspecialchars($application['patient_type']); ?>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 4px;">
                        <label class="form-label">Hospital</label>
                        <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;"> 
                            <?php echo htmlspecialchars($application['hospital']); ?>
                        </div>                    
                    </div>       
                    <div class="row mb-3">
                        <h4>Representative</h4>
                        <div class="col-md-12" style="padding: 4px;">
                            <label class="form-label">Name of Representative</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;"> 
                                <?php echo htmlspecialchars($application['representative_name']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px;">
                            <label class="form-label">Age</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;"> 
                                <?php echo htmlspecialchars($application['representative_age']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px;">
                            <label class="form-label">Relationship</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;"> 
                                <?php echo htmlspecialchars($application['representative_relationship']); ?>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 4px;">
                            <label class="form-label">Contact Number</label>
                            <div class="form-control"style="background: #f8f9fa; border: 1px solid #ced4da; pointer-events: none;"> 
                                <?php echo htmlspecialchars($application['representative_contact_number']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex row mb-3" id="step2" style="display: none;">
                        <div style="padding-left: 2px;">
                        <h4 style="margin-top: 8px;">Uploaded Requirements</h4>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6" style="padding: 4px;">
                            <label class="form-label">Barangay Certificate of Indigency</label>
                            <?php if (!empty($application['barangay_certificate_of_indigency'])): ?>
                                <div>
                                    <a href="<?php echo htmlspecialchars($application['barangay_certificate_of_indigency']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download >Download Barangay Certificate of Indigency</a>
                                </div>
                            <?php else: ?>
                                <p>No file uploaded or file not found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6" style="padding: 4px;">
                            <label class="form-label">Valid ID (Processor)</label>
                            <?php if (!empty($application['valid_id'])): ?>
                                <div>
                                    <a href="<?php echo htmlspecialchars($application['valid_id']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download>Download Valid ID</a>
                                </div>
                            <?php else: ?>
                                <p>No file uploaded or file not found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <h5>Requirements for Medical Assistance</h5>
                        <div class="col-md-6" style="padding: 4px;">
                            <label class="form-label">Medical Abstract/Certificate</label>
                            <?php if (!empty($application['medical_abstract'])): ?>
                                <div>
                                    <a href="<?php echo htmlspecialchars($application['medical_abstract']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download>Download Medical Abstract/Certificate</a>                                
                                </div>
                            <?php else: ?>
                                <p>No file uploaded or file not found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6" style="padding: 4px;">
                            <label class="form-label">Updated Prescription</label>
                            <?php if (!empty($application['prescription'])): ?>
                                <div>
                                    <a href="<?php echo htmlspecialchars($application['prescription']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download>Download Updated Prescription</a>                                
                                </div>
                            <?php else: ?>
                                <p>No file uploaded or file not found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6" style="padding: 4px;">
                            <label class="form-label">Laboratory / Medical Request</label>
                            <?php if (!empty($application['lab_requests'])): ?>
                                <div>
                                    <a href="<?php echo htmlspecialchars($application['lab_requests']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download>Download Laboratory / Medical Request</a>
                                </div>
                            <?php else: ?>
                                <p>No file uploaded or file not found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <h5>Requirements for Burial Assistance</h5>
                        <div class="col-md-6" style="padding: 4px;">
                            <label class="form-label">Death Certificate</label>
                            <?php if (!empty($application['death_certificate'])): ?>
                                <div>
                                    <a href="<?php echo htmlspecialchars($application['death_certificate']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download>Download Death Certificate</a>
                                </div>
                            <?php else: ?>
                                <p>No file uploaded or file not found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6" style="padding: 4px;">
                            <label class="form-label">Funeral Contract</label>
                            <?php if (!empty($application['funeral_contract'])): ?>
                                <div>
                                    <a href="<?php echo htmlspecialchars($application['funeral_contract']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download>Download Funeral Contract</a>
                                </div>
                            <?php else: ?>
                                <p>No file uploaded or file not found.</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6" style="padding: 4px;">
                            <label class="form-label">Funeral Balance</label>
                            <?php if (!empty($application['funeral_balance'])): ?>
                                <div>
                                    <a href="<?php echo htmlspecialchars($application['funeral_balance']); ?>" style="text-decoration: none; font-family: Rubik, san-serif;" download>Download Funeral Balance</a>
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
            </div>
        </form>
    </div>
   </section>
</body>
</html>