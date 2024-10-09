<?php
session_start();
require "connect.php";

if (!isset($_SESSION["email"])) {
    header("location: index.php");
    die();
}
$email = $_SESSION['email'];

$sql1="select * from users where email ='$email'";
$result1 = mysqli_query($conn,$sql1);
$user = mysqli_fetch_assoc($result1);
$id=$user['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <?php
    include "head_links.php";
    ?>
    <link href="css/property list.css" rel="stylesheet" />
    <style>
        @media (max-width: 768px) {
            .profile-img-container {
                text-align: center;
                padding-bottom: 32px;
            }
            .profile{
                text-align: center;
            }
}

.profile-img {
    color: #7d7d7d;
    font-size: 75px;
    text-align: center;
    border: 1px solid #e4e4e4;
    border-radius: 50%;
    height: 100px;
    width: 100px;
    line-height: 100px;
}

.edit-profile {
    font-size: 20px;
    cursor: pointer;
}
.gen_pdf{
    text-decoration: none;
    border: 2px solid black;
    background-color: white;
    color: black;
}
        </style>
</head>

<body>
    <?php
    include "header.php";
    ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="home" href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </nav><br/><br/><br/><br/>
  <div class="row">
  <center><h1 class="offset-1">My Profile</h1><br></center>
      <div class="col-md-5">

      </div>
      <div class="col-md-7">
  <div class="row content">
            <div class="col-md-3 profile-img-container align-items-center">
                <i class="fas fa-user profile-img"></i>
            </div>
            <div class="col-md-9 d-inline">
                <div class="row no-gutters justify-content-between align-items-end">
                    <div class="profile">
                        <b><div class="name"><?= $user['full_name'] ?></div></b>
                        <div class="email"><?= $user['email'] ?></div>
                        <div class="phone"><?= $user['phone'] ?></div>
                        <div class="college"><?= $user['college_name'] ?></div>
                    <div class="edit">
                    <b><div class="edit-profile"><a href="editprofile.php" class="text-decoration-none">Edit Profile</a></div></b>
                    <b><div class="edit-profile"><a href="userchangepassword1.php" class="text-decoration-none">Change Password</a></div></b>
                    </div>
                    </div>
                </div>
            </div>
      </div>
        </div>
    </div>
    <br><br>

<div class="my-interested-properties">
            <div class="page-container">
                <center><h1>Booked Properties</h1></center><br><br>


<?php
$sql5="select * from students_details where email='$email' and bookedornot='Paid'"; 
$result5=mysqli_query($conn,$sql5);
$details5=array();
while($row = mysqli_fetch_assoc($result5)){
    $details5[]=$row;
}
foreach($details5 as $det){
    $property_id=$det['property_id'];
    $sql_3 = "SELECT * 
                        FROM interested_users_properties iup 
                        INNER JOIN properties p ON iup.property_id = p.id
                        WHERE p.id = $property_id";
            $result_3 = mysqli_query($conn, $sql_3);
            if (!$result_3) {
                echo "Something went wrong!";
                return;
            }
            $interested_users_properties = mysqli_fetch_all($result_3, MYSQLI_ASSOC);

            $sql4="select * from properties where id='$property_id'";
            $result4=mysqli_query($conn,$sql4);
            $properties=array();
while($row = mysqli_fetch_assoc($result4)){
    $properties[]=$row;
}
if(mysqli_num_rows($result4)>0){
                foreach ($properties as $property1) {
            $property_images = glob("img/properties/" . $property1['id'] . "/*");
        ?>
  <div class="card mb-3 card" style="max-width: 850px;">
    <div class="row g-0 ">
      <div class="col-md-4 image">
      <img class="img-fluid rounded-start img1" src="<?= $property_images[0] ?>"/>
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <div class="col content">
            <div class="col">
            <?php
                        $total_rating = ($property1['rating_clean'] + $property1['rating_food'] + $property1['rating_safety']) / 3;
                        $total_rating = round($total_rating, 1);
                        ?>
                        <div class="star-container" title="<?= $total_rating ?>">
                            <?php
                            $rating = $total_rating;
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                            ?>
                                    <i class="fas fa-star star"></i>
                                <?php
                                } elseif ($rating >= $i + 0.3) {
                                ?>
                                    <i class="fas fa-star-half-alt star"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="far fa-star star"></i>
                            <?php
                                }
                            }
                            ?>
                        </div>
        </div>
        <div class="col-1">
        <?php
                            $interested_users_count = 0;
                            $is_interested = false;
                            foreach ($interested_users_properties as $interested_user_property) {
                                if ($interested_user_property['property_id'] == $property1['id']) {
                                    $interested_users_count++;

                                    if ($interested_user_property['user_id'] == $id) {
                                        $is_interested = true;
                                    }
                                }
                            }

                            if ($is_interested) {
                            ?>
                                <i class="is-interested-image fas fa-heart heart" property_id="<?= $property1['id'] ?>"></i>
                            <?php
                            } else {
                            ?>
                                <i class="is-interested-image far fa-heart heart" property_id="<?= $property1['id'] ?>"></i>
                            <?php
                            }
                            ?>
                        </div>
                    </div><br>
          <h5 class="card-title"><?= $property1['name'] ?></h5>
          <p class="card-text"><?= $property1['address'] ?></p>
          <?php
                            if ($property1['gender'] == "male") {
                            ?>
                                <img class="male" src="img/male.png" />
                            <?php
                            } elseif ($property1['gender'] == "female") {
                            ?>
                                <img class="male" src="img/female.png" />
                            <?php
                            } else {
                            ?>
                                <img class="male" src="img/unisex.png" />
                            <?php
                            }
                            ?>
          <div class=" row">
            <div class="col-sm-6 amount">
            ₹ <?= number_format($property1['rent']) ?>/-<p class="month"> per month</p>
        </div> 
  </div>
  <div class="row">
      <div class="col-sm-9">
          <p>Total Strength : <?= number_format($property1['strength']) ?> </p>
      </div>
      <?php 
      $sql_4="select * from students_details where property_id=$property_id";
      $result_4=mysqli_query($conn,$sql_4);
      $details=mysqli_num_rows($result_4);
      $strength=$property1['strength'];
      $vacancies=$strength-$details;
      ?>
      <div class="col-sm-3">
          <p>Vacancies : <?= number_format($vacancies) ?> </p>
      </div>
  </div>
  <div class="row">
      <div class="col-sm-6">
          <p>Distance : <?= ($property1['distance']) ?> </p>
      </div>
  <div class="col-sm-6 button1">
              <a href="property_detail.php?property_id=<?= $property1['id'] ?>">
          <button type="button" class="btn btn-primary btn1">View</button>
                        </a>
  </div>
          <div class="row"> 
              <div class="col-sm-9">
              <a href="gen_pdf.php"><button type="button" class="btn btn-secondary"> Generate Receipt</button></a><br><br>
              </div>
              <div class="col-sm-3">
                  <form method="POST"><br>
              <input type="submit" class="btn btn-danger btn1" value="Delete" name="delete">
                  </form>
          <?php
          if(isset($_POST['delete'])){
            $sql6="Delete from students_details where email='$email' and bookedornot='Paid'";
            $result6=mysqli_query($conn,$sql6);
          }
          ?>
              </div>
      </div>
  </div>
        </div>
    </div>
    </div>
  </div>
            </div>
    <?php
        }
    }
    else{
        ?>
            <div class="no-property-container">
                <p>No PG to List</p>
            </div>
        <?php
        }
        ?>
  </div>
    </div>
    <?php
}
include "footer.php";
?>