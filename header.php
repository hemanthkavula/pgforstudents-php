<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .header {
    background-color: white;
    font-size: 13px;
}

.header .navbar .nav-item i {
    margin-right: 8px;
}

.header .nav-vl {
    border-left: 2px solid #d6d6d678;
    height: 24px;
    margin: auto 16px;
    display: block;
}
.bold{
    color: black;
}
.overlay-content{
    display: flex;
}

.header .nav-name {
    font-weight: bold;
    margin: auto 16px;
    margin: 8px 0px;
    color: blue;
}
@media (min-width:768px) {
            .bar{
                display: none;
            }
            .overlay .closebtn {
                display: none;
            }
            .nav-vl{
                display: none;
            }
        }
@media (min-width:0px) and (max-width:768px){
    body {
  font-family: 'Lato', sans-serif;
}
.navbar-toggler{
    height: 40px;
}

.overlay {
  height: 0%;
  width: 100%;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.9);
  overflow-y: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 25%;
  width: 100%;
  text-align: center;
  margin-top: 30px;
  display: block;
}
.overlay-content b{
    display: block;
}
.overlay-content .nav-vl{
    display: none;
}

.overlay-content a i,.overlay-content .nav-name{
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color: #818181;
  display: inline;
  transition: 0.3s;
}
.overlay-content a b{
    padding: 8px;
    text-decoration: none;
    font-size: 36px;
    color: #818181;
    display: inline;
    transition: 0.3s;
}

.overlay .visible:hover,.overlay .visible:focus {
  color: white;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
  color: #818181;
}

@media screen and (max-height: 450px) {
  .overlay {overflow-y: auto;}
  .visible{font-size: 20px}
  .overlay .closebtn {
  font-size: 40px;
  top: 15px;
  right: 35px;
  }
}
}
@media (min-width:0px){
}
        #loading {
            display: none;
            background-color: #666666;
            background-image: url("../img/progress_spinner.gif");
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.4;
            position: fixed;
            top: 0px;
            right: 0px;
            width: 100%;
            height: 100%;
            z-index: 10000000;
    }
    .img1{
        width: 250px;
        height: auto;
    }
    
@media(max-width:576px) {
    .img1{
        width: 200px;
        height: auto;
    }
}



</style>
</head>
<body>
<div class="header sticky-top row" >
<nav class="navbar navbar-expand-md navbar-light">
    <div class="col-5">
        <a class="navbar-brand" href="index.php">
            <img class="img1" src="img/logo.jpg"/>
        </a>
    </div>
        <div class="overlay col-7" id="myNav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div class="justify-content-end overlay-content">
                <?php
                //Check if user is loging or not
                if (!isset($_SESSION["email"])) {
                ?>
                        <a class="nav-link" href="signup.php">
                            <i class="fas fa-user visible"></i><b class="bold visible"> Signup</b>
                        </a>
                    <div class="nav-vl"></div>
                        <a class="nav-link" href="login.html">
                            <i class="fas fa-sign-in-alt visible"></i><b class="bold visible"> Login</b>
                        </a>
                <?php
                } else {
                ?>
                    <div class='nav-name align-self-center visible'>
                        <b>Hi, <?php echo $_SESSION["full_name"] ?>!!!</b>
                    </div>
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-user visible"></i><b class="bold visible"> Dashboard</b>
                        </a>
                    <div class="nav-vl"></div>
                        <a class="nav-link" href="logout.php">
                            <i class="fas fa-sign-out-alt visible"></i><b class="bold visible"> Logout</b>
                        </a>
                <?php
                }
                ?>
        </div>
        </div>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()"><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button></span>
</nav>
</div>
<div id="loading">
</div>

<script>
    function openNav() {
  document.getElementById("myNav").style.height = "100%";
}

/* Close */
function closeNav() {
  document.getElementById("myNav").style.height = "0%";
}
    </script>
</body>
</html>