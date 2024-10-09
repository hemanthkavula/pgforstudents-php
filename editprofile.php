<?php
session_start();
require "connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$sql="select * from users where id = $user_id";
$result=mysqli_query($conn,$sql);
$details=mysqli_fetch_assoc($result);

if(!empty($_POST['email']) && !empty($_POST['full_name']) && !empty($_POST['phone']) && !empty($_POST['gender']) && !empty($_POST['college_name'])){  
    $email=$_POST['email'];
    $full_name=$_POST['full_name'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $college_name=$_POST['college_name'];
    $query="update users set email='$email',full_name='$full_name',phone='$phone',gender='$gender',college_name='$college_name' where id='$user_id'";
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    if($result){
        echo header("location:dashboard.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet"/>
</head>
<body>
    <div class="row row1">
        <div class="col-6 img">
        <img src="img/logo.jpg" class="img1">
    </div>
    <center>
    <div class="col-6 form">
        <i class="fas fa-users signup"></i>
        <h1 class="signup1">Edit Profile</h1>
        <form method="POST">
            <input type="text" placeholder="Full name" name="full_name" id="full_name" value="<?php echo $details['full_name']; ?>" required><br/><br/>
            <input type="email" placeholder="Email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $details['email']; ?>" required><br/><br/>
            <input type="text" placeholder="Mobile Number" name="phone" id="phone" maxlength="10" value="<?php echo $details['phone']; ?>" required><br/><br>
            <input type="text" placeholder="College name" name="college_name" id="college_name" value="<?php echo $details['college_name']; ?>" required><br/><br/>
            <select name="gender" class="gen" required>
                <option>Male</option>
                <option>Female</option>
            </select><br><br>
            <input type="submit" name="submit" value="submit" class="register"><br/><br/>
        </form>
        </div>
        </center>
    </div>
</body>
</html>