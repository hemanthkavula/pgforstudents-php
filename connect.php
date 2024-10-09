<?php

$db_hostname="127.0.0.1";
$db_username="root";
$db_password="";
$db_name="pg";

$conn=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
// connection 
if($conn){
}
else{
    die("error on the connection". mysqli_error());
}
?>
