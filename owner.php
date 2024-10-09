<?php
session_start();
require "connect.php";

$phone = $_POST['phone'];
$password = $_POST['password'];

$sql = "SELECT * FROM owners WHERE phone='$phone' AND password='$password'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$row_count = mysqli_num_rows($result);
if ($row_count == 0) {
    $response = array("success" => false, "message" => "Login failed! Invalid Phone Number or password.");
    echo json_encode($response);
    return;
}

$row = mysqli_fetch_assoc($result);
$_SESSION['id'] = $row['id'];
$_SESSION['name'] = $row['name'];
$_SESSION['phone'] = $row['phone'];

echo header("location:owner1.php");
mysqli_close($conn);
?>