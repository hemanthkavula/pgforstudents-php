<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Details</title>
</head>
<body>
<tr>
    <th>ID</th>
    <th>NAME</th>
</tr>
<?php
session_start();
require "connect.php";
$sql="select * from colleges";
$query=mysqli_query($conn,$sql);
if(mysqli_num_rows($query)>0){
    while($result=mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?php echo $result['id'] ?></td>
                <td><?php echo $result['name'] ?></td>
            </tr>
    <?php    
    }
}

?>
</body>
</html>