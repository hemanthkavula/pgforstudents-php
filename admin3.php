<?php 
session_start();
require "connect.php";
if (!isset($_SESSION["email"])) {
    echo header('location:admin.html');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php include "head_links.php"?>
    <style>
        body{
            overflow-x: hidden;
        }
        .body1{
            margin-left: 15px;
            margin-right: 15px;
        }
      tr,th,td{
          border: 2px solid black;
          text-align: center;
      }
      .header {
    background-color: white;
    font-size: 13px;
}

.header .navbar .nav-item i {
    margin-right: 8px;
}

.header .nav-vl {
    border-left: 2px solid #d6d6d678;
    height: 24px;
    margin: auto 16px;
    display: block;
}
.bold{
    color: black;
}
.overlay-content{
    display: flex;
}

.header .nav-name {
    font-weight: bold;
    font-size: 15px;
    color: blue;
    margin: auto 16px;
    margin: 8px 0px
}
@media (min-width:768px) {
            .bar{
                display: none;
            }
            .overlay .closebtn {
                display: none;
            }
            .nav-vl{
                display: none;
            }
        }
@media (min-width:0px) and (max-width:768px){
    body {
  font-family: 'Lato', sans-serif;
}
td{
    font-size: 10px;
}
.navbar-toggler{
    height: 40px;
}

.overlay {
  height: 0%;
  width: 100%;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.9);
  overflow-y: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 25%;
  width: 100%;
  text-align: center;
  margin-top: 30px;
  display: block;
}
.overlay-content b{
    display: block;
}
.overlay-content .nav-vl{
    display: none;
}

.overlay-content a i,.overlay-content .nav-name{
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color: #818181;
  display: inline;
  transition: 0.3s;
}
.overlay-content a b{
    padding: 8px;
    text-decoration: none;
    font-size: 36px;
    color: #818181;
    display: inline;
    transition: 0.3s;
}

.overlay .visible:hover,.overlay .visible:focus {
  color: white;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
  color: #818181;
}

@media screen and (max-height: 450px) {
  .overlay {overflow-y: auto;}
  .visible{font-size: 20px}
  .overlay .closebtn {
  font-size: 40px;
  top: 15px;
  right: 35px;
  }
}
}
@media (min-width:0px){
}
        #loading {
            display: none;
            background-color: #666666;
            background-image: url("../img/progress_spinner.gif");
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.4;
            position: fixed;
            top: 0px;
            right: 0px;
            width: 100%;
            height: 100%;
            z-index: 10000000;
    }
    .img1{
        width: 300px;
        height: auto;
    }
    
@media(max-width:576px) {
    .img1{
        width: 200px;
        height: auto;
    }
}
</style>
</head>
<body>
<div class="header sticky-top row" >
<nav class="navbar navbar-expand-md navbar-light">
    <div class="col-4">
        <a class="navbar-brand" href="index.php">
            <img class="img1" src="img/logo.jpeg"/>
        </a>
    </div>
        <div class="overlay col-8 " id="myNav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div class="justify-content-end overlay-content">
                <?php
                if (isset($_SESSION["email"])) {
                ?>
                    <div class='nav-name align-self-center visible'>
                        <b>Hi, Admin!!!</b>
                    </div>
                    <a class="nav-link" href="addcolleges.php">
                        <i class="fas fa-solid fa-plus visible"></i><b class="bold visible"> Add Colleges</b>
                        </a>
                    <div class="nav-vl"></div>
                        <a class="nav-link" href="addowners.php">
                        <i class="fas fa-solid fa-plus visible"></i><b class="bold visible"> Add Owners</b>
                        </a>
                        <div class="nav-vl"></div>
                        <a class="nav-link" href="adminlogout.php">
                        <i class="fas fa-sign-out-alt visible"></i><b class="bold visible"> Logout</b>
                        </a>
                <?php
                }
                ?>
        </div>
        </div>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()"><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button></span>
</nav>
</div>

<div id="loading">
</div>
<div class="body1">
    <div class="row">
        <center>
            <h2>Students Details</h2>
        </center>
    </div>
<?php 
for($id=1;$id<=6;$id++){
$sql1="select * from colleges where id = '$id'";
$result1 = mysqli_query($conn, $sql1);
$details1 = mysqli_fetch_assoc($result1);
$college_name=$details1['name'];

$sql3="select * from students_details where col_id='$id'";
$result3 = mysqli_query($conn,$sql3);
$details3 = array();
while($row = mysqli_fetch_assoc($result3)){
    $details3[]=$row;
}


?>
<div class="body1">
    <div class="row">
        <center>
            <h2><?php echo $college_name?></h2>
        </center>
    </div>
    <?php if(mysqli_num_rows($result3)>0){
        ?>
            <center>
<div class="row">
    <table border="5">
        <tr>
            <th> Hostel Name </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Email </th>
            <th> Phone Number </th>
            <th> College Name </th>
            <th> College Roll no </th>
            <th> Course </th>
            <th> Branch </th>
            <th> Year Of Study </th>
            <th> Sharing </th>
            <th> AC or Non AC </th>
            <th> Status </th>
        </tr>
        <?php
            foreach($details3 as $details){ 
            ?>
            <tr>
                <td><?php echo $details['property_name'];?></td>
                <td><?php echo $details['firstname'];?></td>
                <td><?php echo $details['lastname'];?></td>
                <td><?php echo $details['email'];?></td>
                <td><?php echo $details['phones'];?></td>
                <td><?php echo $details['college'];?></td>
                <td><?php echo $details['rollno'];?></td>
                <td><?php echo $details['course'];?></td>
                <td><?php echo $details['branch'];?></td>
                <td><?php echo $details['year'];?></td>
                <td><?php echo $details['share'];?></td>
                <td><?php echo $details['ac'];?></td>
                <td><?php echo $details['bookedornot'];?></td>
            </tr>
            <?php
            }
        }else{
            echo "<center>No Details Found</center>";
        }
        ?>
    </table>
</div>
</div><br/><br/> 
    <?php
    }
    ?>
    </center>
    <script>
    function openNav() {
  document.getElementById("myNav").style.height = "100%";
}

/* Close */
function closeNav() {
  document.getElementById("myNav").style.height = "0%";
}
    </script>
</body>
</html>
