<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Colleges</title>
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/15d438045a.js" crossorigin="anonymous"></script>
    <style>
       @media (min-width:768px){
        .form{
            margin-top: 150px;
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
    <i class="fa-solid fa-building-columns signup"></i>
        <h1 class="signup1">Add Colleges</h1>
        <form method="POST" action="addcolleges.php">
            <input type="text" placeholder="College Name" name="college_name" id="college_name" required><br/><br/>
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
   if(!empty($_POST['college_name'])){  
        $college_name=$_POST['college_name'];
        $query="insert into colleges(name) values('$college_name')";
        $result=mysqli_query($conn,$query) or die(mysqli_error());
        if($result){
            echo header("location:addcolleges.php");
        }
    }
?>