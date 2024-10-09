<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Details</title>
    <style>
         .body1{
            margin-left: 30px;
            margin-right: 15px;
        }
    </style>
</head>
<body>
<?php
session_start();
require "connect.php";
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
</body>
</html>