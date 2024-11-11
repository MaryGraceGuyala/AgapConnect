<?php
include '../include/dbconnect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $pdo->prepare("SELECT * FROM users_accounts WHERE username = :username AND role = 'admin'");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header('Location: admin_dashboard.php');
        exit();
    } else {
        echo 
        '<div class="row d-flex text-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-center">
                <div class="col-md-8 col-xl-5 text-center" style="background: rgba(255,255,255,0);border-style: none;">
                    <div class="error-message text-center" style=" font-size: 16px;background-color: #ffdddd;border: 1px solid #d8000c;padding: 15px 20px;border-radius: 5px; margin: 20px; margin-top: 30px;font-family: Raleway;">No user found with that credentials.</div>
                </div>
            </div>
        </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LOGIN FOR ADMIN</title>
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
                <div class="text-center col-md-8 col-xl-6">
                    <img src="assets/img/user.png" width="150px" height="150px"></div>
            </div>
            <div class="row d-flex d-lg-flex justify-content-center mb-5">
                <div class="col-md-8 col-xl-5">
                    <div class="card" style="padding: 12px;">
                        <div style="text-align: center;"><span style="font-family: Rubik, sans-serif;text-align: center;">Welcome&nbsp; back, Admin!</span>
                            <p style="text-align: center;font-family: Rubik, sans-serif;">Please enter your login details.</p>
                        </div>
                        <form method="post" action="login.php" style="padding: 8PX;">
                            <div class="col-12" style="margin-bottom: 3px;">
                                <input class="form-control" type="text" id="username" placeholder="Username" name="username" style="font-family: Rubik, sans-serif;">
                            </div>
                            <div class="col-12" style="margin-bottom: 3px;">
                                <input class="form-control" type="password" id="password" placeholder="Password" name="password" style="font-family: Rubik, sans-serif;">
                            </div>
                            <div class="d-flex justify-content-between" style="font-family: Rubik, sans-serif;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="formCheck-1">
                                    <label class="form-check-label" for="formCheck-1">Remember me</label>
                                </div>
                                <a class="nav-links" href="#">Forgot Password?</a>
                            </div>
                            <div class="text-center" style="margin-top: 5PX;margin-bottom: 5PX;">
                                <button class="btn btn-primary" type="submit" style="background: rgb(2,75,27);">LOG IN</button>
                            </div>
                            <div style="text-align: center;font-family: Rubik, sans-serif;gap:5px;">
                                <span>Don't have an account?&nbsp;
                                    <a class="nav-links" href="admin-signup.php">SIGN UP</a>
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