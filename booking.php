<?php
session_start();
require "connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$email= $_SESSION['email'];
$sql2="select * from students_details where email='$email'";
$result2 = mysqli_query($conn, $sql2);
if (!$result2) {
    echo "Something went wrong!";
    return;
}
$details = mysqli_fetch_assoc($result2);
if (!$details) {
    echo "Something went wrong!";
    return;
}
$property_id=$details['property_id'];

$sql_1 = "SELECT *, p.id AS property_id, p.name AS property_name, c.name AS college_name 
            FROM properties p
            INNER JOIN colleges c ON p.college_id = c.id 
            WHERE p.id = $property_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$property = mysqli_fetch_assoc($result_1);
if (!$property) {
    echo "Something went wrong!";
    return;
}
$sql1="select * from properties where id=$property_id";
$result1 = mysqli_query($conn, $sql1);
if (!$result1) {
    echo "Something went wrong!";
    return;
}
$property1 = mysqli_fetch_assoc($result1);
if (!$property1) {
    echo "Something went wrong!";
    return;
}
$sql2="select * from students_details where user_id=$user_id";
$result2 = mysqli_query($conn, $sql2);
if (!$result2) {
    echo "Something went wrong!";
    return;
}
$details = mysqli_fetch_assoc($result2);
if (!$details) {
    echo "Something went wrong!";
    return;
}
$email=$details['email'];
$firstname=$details['firstname'];
$property2=$property1['id'];
$months=$details['months'];
$rent=$property1['rent'];
$share=$details['share'];
$ac=$details['ac'];
if ($share == '1 - Sharing' && $ac=='With AC'){
    $rent=floor($rent);
}
elseif($share == '1 - Sharing' && $ac=='Without AC'){
    $rent=floor($rent/1.5);
}
elseif($share == '2 - Sharing' && $ac=='With AC'){
    $rent=floor($rent/2);
}
elseif($share == '2 - Sharing' && $ac=='Without AC'){
    $rent=floor($rent/2.5);
}
elseif($share == '3 - Sharing' && $ac=='With AC'){
    $rent=floor($rent/3);
}
elseif($share == '3 - Sharing' && $ac=='Without AC'){
    $rent=floor($rent/3.5);
}
elseif($share == '4 - Sharing' && $ac=='With AC'){
    $rent=floor($rent/4);
}
else{
    $rent=floor($rent/4.5);
}
if (isset($_POST['submit'])){
    $_SESSION['email']=$email;
    $_SESSION['firstname']=$firstname;
    $query="update students_details set bookedornot= 'Paid',rent='$rent' where user_id=$user_id";
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
        if($result){
            header("location:payment.php");
        }
}
$maintainance=$rent*0.1;
$total=$rent+$maintainance;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <?php
    include "head_links.php";
    ?>
    <link href="css/property detail.css" rel="stylesheet"/>
    <style>
        tr,th,td{
          border: 2px solid black;
          text-align: center;
          padding:5px;
      }
      th{
          width: 50%;
      }
    </style>
</head>
<body>
<?php
    include "header.php";
    ?>
    <div class="row">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center">
              <li class="breadcrumb-item"><a class="home" href="index.php">Home</a></li>
              <li class="breadcrumb-item" ><a class="home" href="college.php?college=<?= $property['college_name']; ?>"><?= $property['college_name']; ?></a></li>
              <li class="breadcrumb-item"><a class="home" href="property_detail.php?property_id=<?= $property1['id']; ?>"><?= $property['property_name']; ?></a></li>
            </ol>
          </nav>
    </div><br>
    <div class="row">
        <center>
            <h2>Payment Details</h2><br>
        </center>
    </div>
    <div class="row">
        <center>
        <table border="5" style="width: 50%; margin-left: 50px">
            <tr>
                <th>Original Price</th>
                <td><?php echo $rent." "."*"." ".$months." "."="." ".$rent*$months  ?></td>
            </tr>
            <tr>
            <th>Maintainance</th>
            <td><?php echo $maintainance." "."*"." ".$months." "."="." ".$maintainance*$months ?></td>
            </tr>
            <tr>
            <th>Total</th>
            <td><?php echo $rent*$months + $maintainance*$months  ?></td>
            </tr>
    </table><br>
        <form method="POST"> 
            <input type="submit" name="submit" value="Book">
        </form>
        </center>
    </div>
    <br><br><br>
    <?php
    include "footer.php"
    ?>
</body></html>