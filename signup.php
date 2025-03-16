<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mobno = $_POST['mobno'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $ret = "SELECT Email FROM tbluser WHERE Email=:email";
    $query = $dbh->prepare($ret);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() == 0) {
        $sql = "INSERT INTO tbluser (FullName, MobileNumber, Email, Password) VALUES (:fname, :mobno, :email, :password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId) {
            echo "<script>alert('You have successfully registered with us');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    } else {
        echo "<script>alert('Email-id already exists. Please try again');</script>";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Hotel Booking Management System | Sign Up</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <style>
        .signup-btn {
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
        .signup-btn:hover {
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

    <!-- Registration Form -->
    <div class="content">
        <div class="contact">
            <div class="container" style="max-width: 500px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); text-align: center; margin-top: 50px;">
                <h2 style="color: #333; margin-bottom: 20px;">Create an Account</h2>

                <form method="post">
                    <div style="margin-bottom: 15px; text-align: left;">
                        <label for="fname" style="font-weight: bold; color: #555;">Full Name</label>
                        <input type="text" id="fname" name="fname" required class="form-control"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
                    </div>

                    <div style="margin-bottom: 15px; text-align: left;">
                        <label for="mobno" style="font-weight: bold; color: #555;">Mobile Number</label>
                        <input type="text" id="mobno" name="mobno" required maxlength="10" pattern="[0-9]+"
                            class="form-control"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
                    </div>

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

                    <input type="submit" value="Sign Up" name="submit" class="signup-btn">

                    <p style="margin-top: 15px;">Already Registered? <a href="signin.php" style="color: #007bff; text-decoration: none;">Sign In</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>

</body>
</html>
