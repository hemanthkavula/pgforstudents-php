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

   if(!empty($_POST['college']) && !empty($_POST['rollno']) && !empty($_POST['graduate']) && !empty($_POST['year']) && !empty($_POST['course']) && !empty($_POST['branch'])){  
        $college=$_POST['college'];
        $rollno=$_POST['rollno'];
        $graduate=$_POST['graduate'];
        $year=$_POST['year'];
        $course=$_POST['course'];
        $branch=$_POST['branch'];
        $user_id=$user_id;
        $query="update students_details set college='$college',rollno='$rollno',graduate='$graduate',year='$year',course='$course',branch='$branch' where user_id=$user_id";
        $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
        if($result){
            header("location:booking_details.php?property_id=$property2");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Details</title>
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
            <h2>College Details</h2><br>
        </center>
    </div>
    <div class="row">
        <form method="POST">
            <center>
           <select class="form1" name="college" id="col_id" required>
                <option>KLU</option>
                <option>RVR</option>
                <option>OSMANIA</option>
                <option>GAYATHRI</option>
                <option>SRKR</option>
                <option>VIT</option>
            </select><br><br>
            <input class="form1" type="text" placeholder="Roll Number in college" name="rollno" required><br><br>
            <select class="form1" name="graduate" id="col_id"  required>
                <option>U.G</option>
                <option>P.G</option>
            </select><br><br>
            <select class="form1" name="year" id="col_id"  required>
                <option>First Year</option>
                <option>Second Year</option>
                <option>Third Year</option>
                <option>Fourth Year</option>
            </select><br><br>
            <input class="form1" type="text" placeholder="Course Name" name="course" required><br><br>
            <input class="form1" type="text" placeholder="Branch Name" name="branch" required><br><br>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset"
            </center>
        </form>
    </div>
    <br><br><br>
    <?php
    include "footer.php"
    ?>
</body>
</html>