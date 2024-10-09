<?php
session_start();
$email=$_SESSION['email'];
$firstname=$_SESSION['firstname'];
$to = $email;
$subject = "Booking a PG";
$body = "Hi"." " .$firstname."!!!". " "."You Have Successfully Booked a Hostel on Hostels For Students";
if(mail($to, $subject, $body)){
  echo header("location:booking1.html");
}
?>