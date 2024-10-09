<?php
session_start();
require "connect.php";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$property_id = $_GET["property_id"];

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
$property2=$property1['id'];

    if (!isset($_SESSION["email"])) {
        header("location:login.html");}
      else{
      }
    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['phones']) && !empty($_POST['dob']) && !empty($_POST['address']) && !empty($_POST['fathersname']) && !empty($_POST['phonef']) && !empty($_POST['mothersname']) && !empty($_POST['phonem'])){  
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $phones=$_POST['phones'];
        $dob=$_POST['dob'];
        $address=$_POST['address'];
        $fathersname=$_POST['fathersname'];
        $phonef=$_POST['phonef'];
        $mothersname=$_POST['mothersname'];
        $phonem=$_POST['phonem'];
        $user_id=$user_id;
        $col_id=$property1['college_id'];
        $property_id=$property1['id'];
        $property_name=$property1['name'];
        $email=$_SESSION['email'];
        $booked="Not Paid";
        $query="insert into students_details(user_id,col_id,property_id,property_name,firstname,lastname,email,phones,dob,address,fathersname,phonef,mothersname,phonem,bookedornot) values('$user_id', '$col_id', '$property_id', '$property_name', '$firstname' ,'$lastname' ,'$email' ,'$phones' ,'$dob' ,'$address' ,'$fathersname' ,'$phonef' ,'$mothersname' ,'$phonem', '$booked')";
        $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
        if($result){
           header("location:college_details.php?property_id=$property2");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <?php
    include "head_links.php";
    ?>
    <link href="css/property detail.css" rel="stylesheet"/>
    <style>
        body{
            overflow-x: hidden;
        }
        .form1{
            width: 300px;
        }
        .form2{
            width: 400px;
        }
        .det{
            display: flex;
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
            <h2>Student Details</h2><br>
        </center>
    </div>
    <div class="row">
        <form method="POST">
            <center>
            <input class="form1" type="text" placeholder="First Name" name="firstname" required><br><br>
            <input class="form1" type="text" placeholder="Last Name" name="lastname" required><br><br>
            <input class="form1" type="text" placeholder="Phone Number" name="phones" pattern="[6789][0-9]{9}" required><br><br>
            <input class="form1" type="date" name="dob" required><br><br>
            <textarea class="form1" placeholder="Address" name="address" required></textarea><br><br>
            <input class="form1" type="text" placeholder="Fathers Name" name="fathersname" required><br><br>
            <input class="form1" type="text" placeholder="Fathers Phone Number" name="phonef" pattern="[6789][0-9]{9}" required><br><br>
            <input class="form1" type="text" placeholder="Mothers Name" name="mothersname" required><br><br>
            <input class="form1" type="text" placeholder="Mothers Phone Number" name="phonem" pattern="[6789][0-9]{9}" required ><br><br>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
            </center>
        </form>
    </div><br><br><br>
    <?php
    include "footer.php"
    ?>
</body>
</html>
