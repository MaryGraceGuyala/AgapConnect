<?php
include '../include/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['f_name'];
    $lastname = $_POST['l_name'];
    $email = $_POST['email_address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    try {
        $stmt = $pdo->prepare("INSERT INTO users_accounts (f_name, l_name, email_address, username, password, role) VALUES (:firstname, :lastname, :email, :username, :password, 'member')");
        $stmt->execute(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email,'username' => $username, 'password' => $hashedPassword, ]);
        echo
        '<div class="row d-flex text-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-center">
                <div class="col-md-12 col-xl-5 text-center" style="background: rgba(255,255,255,0);border-style: none;">
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                Member registered successfully!
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                </div>
            </div>
        </div>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Members Signup</title>
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

<body class="text-muted small pt-2 ps-1" style="background: rgb(55,166,79);">
    <section class="position-relative py-4 py-xl-5" style="padding-top: 24px;padding-bottom: 24px;">
        <div class="container">
            <div class="row justify-content-center mb-2">
                <div class="text-center col-md-8 col-xl-6"><img src="assets/img/user.png" width="150px" height="150px"></div>
            </div>
            <div class="row d-flex d-lg-flex justify-content-center mb-5">
                <div class="col-md-8 col-xl-5">
                    <div class="card" style="padding: 12px;">
                        <div style="text-align: center;"><span style="font-family: Rubik, sans-serif;text-align: center;">Welcome, Kaagap!</span>
                            <p style="text-align: center;font-family: Rubik, sans-serif;">Please enter your personal details to create an account.</p>
                        </div>
                        <form method="post" action="members_signup.php" style="padding: 8PX;">
                            <div class="col-12" style="margin-bottom: 3px;">
                                <input class="form-control" type="text" id="f_name" placeholder="First Name" name="f_name" style="font-family: Rubik, sans-serif;">
                            </div>
                            <div class="col-12" style="margin-bottom: 3px;">
                                <input class="form-control" type="text" id="l_name" placeholder="Last Name" name="l_name" style="font-family: Rubik, sans-serif;">
                            </div>
                            <div class="col-12" style="margin-bottom: 3px;">
                                <input class="form-control" type="text" id="email" placeholder="Email Address" name="email_address" style="font-family: Rubik, sans-serif;">
                            </div>
                            <div class="col-12" style="margin-bottom: 3px;">
                                <input class="form-control" type="text" id="username" placeholder="Username" name="username" style="font-family: Rubik, sans-serif;">
                            </div>
                            <div class="col-12" style="margin-bottom: 3px;">
                                <input class="form-control" type="password" id="password" placeholder="Create Password" name="password" style="font-family: Rubik, sans-serif;">
                            </div>
                            <div class="col-12" style="margin-bottom: 3px;">
                                <input class="form-control" type="password" id="password" placeholder="Confirm Password" name="password" style="font-family: Rubik, sans-serif;">
                            </div>
                            <div class="text-center" style="margin-top: 5PX;margin-bottom: 5PX;">
                                <button class="btn btn-primary" type="submit" style="background: rgb(2,75,27);">SIGN UP</button>
                            </div>
                            <div style="text-align: center;font-family: Rubik, sans-serif;gap:5px;">
                                <span>Already have an account?
                                    <a class="nav-links" href="login.php">LOG IN</a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>