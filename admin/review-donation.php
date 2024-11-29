<?php
include '../include/dbconnect.php';

function fetchDonations($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM donations ORDER BY donation_date DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateDonationStatus($pdo, $reference_number) {
    $stmt = $pdo->prepare("UPDATE donations SET status = 'Received' WHERE reference_number = :reference_number");
    $stmt->bindParam(':reference_number', $reference_number);
    return $stmt->execute();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_received'])) {
    $reference_number = $_POST['reference_number'];
    if (updateDonationStatus($pdo, $reference_number)) {
        echo "<div class='alert alert-success'>Donation confirmed as received.</div>";
    } else {
        echo "<div class='alert alert-danger'>Failed to update donation status.</div>";
    }
}


$donations = fetchDonations($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Donations</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Review Donations</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Reference Number</th>
                    <th>Donor Name</th>
                    <th>Donation Date</th>
                    <th>Donation Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donations as $donation): ?>
                <tr>
                    <td><?php echo htmlspecialchars($donation['reference_number']); ?></td>
                    <td><?php echo htmlspecialchars($donation['donor_name']); ?></td>
                    <td><?php echo htmlspecialchars($donation['donation_date']); ?></td>
                    <td>Php. <?php echo number_format($donation['donation_amount'], 2); ?></td>
                    <td><?php echo htmlspecialchars($donation['status']); ?></td>
                    <td>
                        <?php if ($donation['status'] === 'Pending'): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="reference_number" value="<?php echo htmlspecialchars($donation['reference_number']); ?>">
                            <button type="submit" name="confirm_received" class="btn btn-success btn-sm">Confirm Received</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>