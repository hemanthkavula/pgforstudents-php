<?php
session_start();
$email=$_SESSION['email'];
$full_name=$_SESSION['full_name'];
$to = $email;
$subject = "Registration On PG For Students";
$body = "Dear"." " .$full_name."! \n \n Thank You for Completing Registration with Hostels For Students. \n \n This Email serves as a confirmation that your Account is Created Successfully and that you are Officially a part of the Hostels For Students family. \n Enjoy! \n \n Regards, \n The Hostels For Students team" ;
if(mail($to, $subject, $body)){
    header("location:signup1.html");
}
?>