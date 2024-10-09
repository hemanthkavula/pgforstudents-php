<?php
session_start();
require "connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php
    include "head_links.php";
    ?>
    <link href="css/home.css" rel="stylesheet"/>
    <style>
      .background{
        background-image: url("img/bg4.jpg");
        background-position:center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
      }
      .round{
    border-radius: 50%;
    box-shadow: 5px 5px 5px 5px rgb(192, 176, 176) ;
    padding: 0px;
    margin: 10px;
}
.college-search {
    max-width: 530px;
    margin: auto;
    position: relative;
}
@media (min-width:972px){
  .round{
    width: 140px;
    height: 140px;
    object-fit: cover;
  }
}
    </style>
</head>
<body>
<?php
    include "header.php";
    ?>
     <div class="row">
     <div class="background"><br/><br><br><br><br><br><br><br><br>
       <form id="search-form" action="college.php" method="GET">
            <div class="input-group college-search">
                <input type="text" class="form-control input-college" id='college' name='college' placeholder="Enter your college to search for PGs" />
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
      </div>
    </div><br/><br/>    
    <center>
        <div class="row">
           <h1 class="cities">Major Colleges</h1>
         </div><br/><br/>
         <div class="row justify-content-center">
           <div class="col-sm-6 col-md-4 col-lg-2">
             <a href="college.php?college=klu"><img class="round" src="img/klu.jpg" width="150px" height="150px"></a>
           </div>
           <div class="col-sm-6 col-md-4 col-lg-2">
             <a href="college.php?college=rvr"><img class="round" src="img/rvr.jpg" width="150px" height="150px"></a>
           </div>
           <div class="col-sm-6 col-md-4 col-lg-2">
             <a href="college.php?college=osmania"><img class="round" src="img/osmania.png" width="150px" height="150px"></a>
           </div>
           <div class="col-sm-6 col-md-4 col-lg-2">
             <a href="college.php?college=gayathri"><img class="round" src="img/gayathri.jpg" width="150px" height="150px"></a>
           </div>
           <div class="col-sm-6 col-md-4 col-lg-2">
             <a href="college.php?college=srkr"><img class="round" src="img/srkr.jpg" width="150px" height="150px"></a>
           </div>
           <div class="col-sm-6 col-md-4 col-lg-2">
             <a href="college.php?college=vit"><img class="round" src="img/vit.png" width="150px" height="150px"></a>
           </div>
         </div><br/><br/><br><br><br><br>
       </center>
       <?php
  include "footer.php";
  ?>
</body>
</html>