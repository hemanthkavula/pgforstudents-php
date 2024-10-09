<?php
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
		
	$change =  passFunc(4, '1234567890');

    session_start();
   require "connect.php";
   if(!empty($_POST['email'])){  
        $email=$_POST['email'];
        $code=$change;
        $query="insert into forgot_details(email,code) values('$email', '$code')";
        $result=mysqli_query($conn,$query) or die(mysqli_error());
        if($result){
            echo header("location:forgotemail.php");
        }
    }
    if(isset($_POST['submit'])){
        $_SESSION["email"]=$email;
        $_SESSION["code"]=$code;
    }
	?>	

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot User</title>
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet"/>
    <style>
    @media (min-width:768px){
        .form{
            margin-top: 150px;
        }
}
    </style>
</head>
<body>
    <div class="row row1">
        <div class="col-6 img">
        <img src="img/logo.jpg" class="img1">
    </div>
    <center>
    <div class="col-6 form">
        <i class="fas fa-users signup"></i>
        <h1 class="signup1">Forgot User</h1>
        <form method="POST">
            <input type="email" placeholder="Email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>*<br/><br/>
            <input type="submit" name="submit" value="Send Code">
        </form>
        </div>
        </center>
    </div>
</body>
</html>