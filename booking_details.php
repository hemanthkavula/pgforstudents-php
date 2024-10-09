<?php
session_start();
require "connect.php";

function passFunc($len, $set = "")
		{
			$gen = "";
			for($i = 0; $i < $len; $i++)
				{
					$set = str_shuffle($set);
					$gen.= $set[0]; 
				}
			return $gen;
		} 
		
$change =  passFunc(8, '1234567890');

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
$rent=$property1['rent'];

   // connection 
   if($conn){
   }
   else{
       die("error on the connection". mysqli_error());
   }
   if(!empty($_POST['share']) && !empty($_POST['ac']) && !empty($_POST['month'])){  
        $share=$_POST['share'];
        $ac=$_POST['ac'];
        $month=$_POST['month'];
        $user_id=$user_id;
        $query="update students_details set share='$share',ac='$ac',booking_id='$change',months='$month' where user_id=$user_id";
        $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
        if($result){
            header("location:booking.php?property_id=$property2");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
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
            <h2>Booking Details</h2><br>
        </center>
    </div>
    <div class="row">
        <form method="POST">
            <center>
            <select class="form1" name="share" id="share" required>
                <option>1 - Sharing</option>
                <option>2 - Sharing</option>
                <option>3 - Sharing</option>
                <option>4 - Sharing</option>
            </select><br><br> 
            <select class="form1" name="ac" id="ac" required>
                <option>With AC</option>
                <option>Without AC</option>
            </select><br><br>
            <select class="form1" name="month" id="month" required>
                <option>1 Month</option>
                <option>2 Months</option>
                <option>3 Months</option>
                <option>4 Months</option>
                <option>5 Months</option>
                <option>6 Months</option>
            </select><br><br>
                <input type="submit" value="Book now">
            </center>
        </form>
    </div>
    <br><br><br>
    <?php
    include "footer.php"
    ?>
</body>
</html>