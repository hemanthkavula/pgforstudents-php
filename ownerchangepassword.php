<?php
session_start();
require "connect.php";
if(!empty($_POST['password'])){  
    $phone=$_SESSION["phone"];
    $password = $_POST['password'];
    $cpassword=$_POST['cpassword'];
    if($password==$cpassword){
    $sql = "update owners set password='$password' where phone='$phone'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        $response = array("success" => false, "message" => "Something went wrong!");
        echo json_encode($response);
        return;
    }
    else{
        echo header("location:owner1.php");
    }
}
else{
    echo "<center><h2>Password and Confirm Password Must be Same!!</h2></center>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/15d438045a.js" crossorigin="anonymous"></script>
    <style>
        @media (min-width:768px){
            .form{
                margin-top: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="row row1">
        <div class="col-6 img">
        <img src="img/logo.jpg" class="img1">
    </div>
    <center>
    <div class="col-6 form">
        <i class="fa-solid fa-unlock signup"></i>
        <h1 class="signup1">Change Password</h1>
        <form method="POST">
            <input type="text" placeholder="phone" name="phone" id="phone" required>*<br/><br/>
            <input type="password" placeholder="New password" name="password" id="password" minlength="6" required>*<br/><br/>
            <input type="password" placeholder="Conform Password" name="cpassword" id="cpassword" minlength="6" required>*<br/><br/>
            <input type="submit" value="Change Password" class="register"><br/><br/>
        </form>
        </div>
        </center>
    </div>
</body>
</html>