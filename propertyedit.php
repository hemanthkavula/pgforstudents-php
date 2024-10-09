<?php
session_start();
require "connect.php";

$id=$_SESSION['id'];
$sql="select * from properties where owner_id = '$id'";
$result = mysqli_query($conn, $sql);
$details = mysqli_fetch_assoc($result);

if(!empty($_POST['owner_id']) && !empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['description']) && !empty($_POST['phone']) && !empty($_POST['gender']) && !empty($_POST['rent']) && !empty($_POST['strength'])){  
    $owner_id=$_POST['owner_id'];
    $name=$_POST['name'];
    $address=$_POST['address'];
    $description=$_POST['description'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $rent=$_POST['rent'];
    $strength=$_POST['strength'];
    $query="update properties set owner_id='$owner_id',name='$name',address='$address',description='$description',phone='$phone',gender='$gender',rent='$rent',strength='$strength' where id='$property_id'";
    $result1=mysqli_query($conn,$query) or die(mysqli_error($conn));
    if($result1){
        echo header("location:owner1.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/15d438045a.js" crossorigin="anonymous"></script>
    <style>
        body{
            margin-top: 0px;
        }
        select{
            font-size: 20px;
            border: 2px solid black;
            border-radius: 5px;
        }
        input{
    font-size: 20px;
    border: 2px solid black;
    border-radius: 5px;
}
textarea{
    font-size: 20px;
    border: 2px solid black;
    border-radius: 5px;
}
.img1{
            margin-top: 150px;
            width: 700px;
            height: 200px;
        }
@media (min-width:768px){
    .form{
        margin-top: 30px;
    }
    .img1{
        margin-top: 200px;
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
    <i class="fa-solid fa-pen-to-square signup"></i>
        <h1 class="signup1">Edit Property</h1>
        <form method="POST">
            <select name="col_id" id="col_id" required>
                <option>KLU</option>
                <option>RVR</option>
                <option>OSMANIA</option>
                <option>GAYATHRI</option>
                <option>SRKR</option>
                <option>VIT</option>
            </select><br><br>
            <input type="text" placeholder="owner id" name="owner_id" id="owner_id" value="<?php echo $details['owner_id']; ?>" required><br/><br/>
            <input type="text" placeholder="Property Name" name="name" id="name" value="<?php echo $details['name']; ?>" required><br/><br/>
            <textarea rows="5" placeholder="Address" name="address" id="address" required><?php echo $details['address']; ?></textarea><br/><br/>
            <textarea rows="5" placeholder="Description" name="description" id="description" required><?php echo $details['description']; ?></textarea><br><br>
            <input type="text" placeholder="Phone Number" name="phone" id="phone" value="<?php echo $details['phone']; ?>" required><br/><br/>
            <input type="text" placeholder="Gender" name="gender" id="gender" value="<?php echo $details['gender']; ?>" required><br/><br/>
            <input type="text" placeholder="Rent" name="rent" id="rent" value="<?php echo $details['rent']; ?>" required><br/><br/>
            <input type="text" placeholder="Strength" name="strength" id="strength" value="<?php echo $details['strength']; ?>" required><br/><br/>
            <input type="submit" name="submit" value="Submit" class="register"><br/><br/>
        </form>
        </div>
        </center> 
    </div>
</body>
</html>