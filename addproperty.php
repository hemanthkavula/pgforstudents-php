<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
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
    <i class="fa-solid fa-hotel signup"></i>
        <h1 class="signup1">Add Property</h1>
        <form method="POST">
            <select name="col_id" id="col_id">
                <option>1.KLU</option>
                <option>2.RVR</option>
                <option>3.OSMANIA</option>
                <option>4.GAYATHRI</option>
                <option>5.SRKR</option>
                <option>6.VIT</option>
            </select><br><br>
            <input type="text" placeholder="owner id" name="owner_id" id="owner_id" required><br/><br/>
            <input type="text" placeholder="Property Name" name="name" id="name" required><br/><br/>
            <textarea rows="5" placeholder="Address" name="address" id="address" required></textarea><br/><br/>
            <textarea rows="5" placeholder="Description" name="description" id="description" required></textarea><br><br>
            <input type="text" placeholder="Phone Number" name="phone" id="phone" required><br/><br/>
            <input type="text" placeholder="Gender" name="gender" id="gender" required><br/><br/>
            <input type="text" placeholder="Rent" name="rent" id="rent" required><br/><br/>
            <select name="ac" id="ac">
                <option>1.AC Available</option>
                <option>2.AC not available</option>
            </select><br><br>
            <input type="text" placeholder="Strength" name="strength" id="strength" required><br/><br/>
            <input type="submit" value="Submit" class="register"><br/><br/>
        </form>
        </div>
        </center>
    </div>
</body>
</html>
<?php
   session_start();
   require "connect.php";
   // connection 
   if($conn){
   }
   else{
       die("error on the connection". mysqli_error());
   }
   if(!empty($_POST['col_id']) && !empty($_POST['owner_id']) && !empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['description']) && !empty($_POST['phone']) && !empty($_POST['gender']) && !empty($_POST['rent']) && !empty($_POST['strength'])){ 
    $col_id=$_POST['col_id'];   
    $owner_id=$_POST['owner_id'];
    $name=$_POST['name'];
    $address=$_POST['address'];
    $description=$_POST['description'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $rent=$_POST['rent'];
    $ac=$_POST['ac']; 
    $strength=$_POST['strength'];
    $query="insert into properties(college_id,owner_id,name,address,description,phone,gender,rent,ac,strength) values('$col_id', '$owner_id', '$name' , '$address', '$description', '$phone', '$gender', '$rent','$ac', '$strength')";
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    if($result){
        echo header("location:addproperty.php");
    }
}
?>