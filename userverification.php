<?php
session_start();
require "connect.php";

$email = $_SESSION["email"];
$code = $_POST['code'];

$sql = "SELECT * FROM forgot_details WHERE email='$email' AND code='$code'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}
if (mysqli_num_rows($result)==0) {
    $response = array("success" => false, "message" => "Verification failed!");
    echo json_encode($response);
    return;
}
else{
    echo header("location:userchangepassword.php");
}
?>