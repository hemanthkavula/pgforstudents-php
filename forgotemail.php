<?php
session_start();
$email=$_SESSION["email"];
$code=$_SESSION["code"];
$to = $email;
$subject = "Change Password";
$body ="Hi!". "\n \n Your Verification code is " .$code . "\n \n Enter this Code in our website to Change your Hostels For Students account Password \n \n if you have any questions, \n Send us an Email. \n \n We're glad you're here! \n The Hostels For Students team";
if(mail($to, $subject, $body)){
    header("location:userverification.html");
}
?>