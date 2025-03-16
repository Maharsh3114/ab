<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT ID FROM tbluser WHERE Email=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    if($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['hbmsuid'] = $result->ID;
        }
        $_SESSION['login'] = $_POST['email'];
        echo "<script type='text/javascript'> document.location ='index.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Hotel Booking Management System | Login</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <style>
        .login-btn {
            background: orange;
            color: black;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s, color 0.3s;
        }
        .login-btn:hover {
            background: black;
            color: white;
        }
    </style>
</head>
<body style="background: #f4f4f4; font-family: Arial, sans-serif;">

    <!-- Header -->
    <div class="header head-top">
        <div class="container">
            <?php include_once('includes/header.php'); ?>
        </div>
    </div>

    <!-- Login Form -->
    <div class="content">
        <div class="contact">
            <div class="container" style="max-width: 500px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); text-align: center; margin-top: 50px;">
                <h2 style="color: #333; margin-bottom: 20px;">Login to Your Account</h2>
                
                <form method="post">
                    <div style="margin-bottom: 15px; text-align: left;">
                        <label for="email" style="font-weight: bold; color: #555;">Email Address</label>
                        <input type="email" id="email" name="email" required class="form-control"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
                    </div>

                    <div style="margin-bottom: 15px; text-align: left;">
                        <label for="password" style="font-weight: bold; color: #555;">Password</label>
                        <input type="password" id="password" name="password" required class="form-control"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
                    </div>

                    <div style="text-align: right; margin-bottom: 15px;">
                        <a href="forgot-password.php" style="text-decoration: none; color: #007bff;">Forgot your password?</a>
                    </div>

                    <input type="submit" value="Login" name="login" class="login-btn">
                </form>
                
                <!-- <p style="margin-top: 15px;">Don't have an account? <a href="register.php" style="color: #007bff; text-decoration: none;">Sign Up</a></p> -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>

</body>
</html>
