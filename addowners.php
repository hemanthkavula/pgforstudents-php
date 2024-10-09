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
		
?>
<?php 
	$change =  passFunc(6, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
	?>	




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Owner</title>
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet"/>
    <style>
        .but{
            font-size: 20px;
            border: 2px solid black;
            border-radius: 5px;
        }
        @media (min-width:768px){
        .form{
            margin-top: 50px;
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
        <h1 class="signup1">Add Owner</h1>
        <form method="POST" action="addowners.php">
            <input type="text" placeholder="owner id" name="owner_id" id="owner_id" required><br/><br/>
            <input type="text" placeholder="phone number" name="phone" id="phone" maxlength="10" required><br/><br/>
            <input type="text" placeholder="Owner Name" name="name" id="name" required><br/><br/>
            <input type="password" placeholder="password" name="password" id="password" required><br/><br/>
            <input class="but" type = "button" value = "Generate Password" onclick = "document.getElementById('password').value = '<?php echo $change?>'"><br><br>
            <input type="submit" value="Submit" class="register"><br/><br/>
        </form>
        </div>
        </center>
    </div>
</body>
</html>

<?php
   session_start();
   require "connect.php";
   // connection 
   if($conn){
   }
   else{
       die("error on the connection". mysqli_error());
   }
   if(!empty($_POST['owner_id']) && !empty($_POST['phone']) && !empty($_POST['name']) && !empty($_POST['password'])){
    $owner_id=$_POST['owner_id'];    
    $phone=$_POST['phone'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    $query="insert into owners(id,phone,name,password) values('$owner_id','$phone','$name', '$password')";
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    if($result){
        echo header("location:addowners.php");
    }
}
?>