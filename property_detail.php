<?php
session_start();
require "connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$property_id = $_GET ["property_id"];

$sql_1 = "SELECT *, p.id AS property_id, p.name AS property_name, c.name AS college_name 
            FROM properties p
            INNER JOIN colleges c ON p.college_id = c.id 
            WHERE p.id = $property_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$property = mysqli_fetch_assoc($result_1);

if (!$property) {
    echo "Something went wrong!";
    return;
}
$sql1="select * from properties where id=$property_id";
$result1 = mysqli_query($conn, $sql1);
if (!$result1) {
    echo "Something went wrong!";
    return;
}
$property1 = mysqli_fetch_assoc($result1);
if (!$property1) {
    echo "Something went wrong!";
    return;
}
$property_id=$property1['id'];
$strength=$property1['strength'];
$college_id=$property1['college_id'];
$sql5="select * from students_details where property_id=$property_id";
$result6=mysqli_query($conn,$sql5);
$details6=mysqli_num_rows($result6);
$vacancies=$strength-$details6;


$sql_2 = "SELECT * FROM testimonials WHERE property_id = $property_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$testimonials = mysqli_fetch_all($result_2, MYSQLI_ASSOC);


$sql_3 = "SELECT a.* 
            FROM amenities a
            INNER JOIN properties_amenities pa ON a.id = pa.amenity_id
            WHERE pa.property_id = $property_id";
$result_3 = mysqli_query($conn, $sql_3);
if (!$result_3) {
    echo "Something went wrong!";
    return;
}
$amenities = mysqli_fetch_all($result_3, MYSQLI_ASSOC);


$sql_4 = "SELECT * FROM interested_users_properties WHERE property_id = $property_id";
$result_4 = mysqli_query($conn, $sql_4);
if (!$result_4) {
    echo "Something went wrong!";
    return;
}
$interested_users = mysqli_fetch_all($result_4, MYSQLI_ASSOC);
$interested_users_count = mysqli_num_rows($result_4);
$property2=$property1['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $property['property_name']; ?> </title>
    <?php
    include "head_links.php";
    ?>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="css/property detail.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/jquery.js"></script>
    <style>
        .details-name{
            text-transform: capitalize;
        }
        .rating{
    border: 2px solid green;
    border-radius: 50%;
    width: 150px;
    height: 150px;
    background-color: green;
    color:white;
    padding-top: 30px;
    padding-left: 30px;
}
.rating1{
    padding-left: 15px;
}
.stars{
    color: rgb(75, 221, 221);
}
.star1{
    color: white;
}
.review{
    background-color: rgb(248, 239, 239);
}
.heart{
    color: orangered;
    font-size: 25px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    padding-right: 3px;
}
.round{
    border-radius: 50%;
}
.content{
    margin-left: 0px;
}
body{
    margin-left: 0px;
}
.breadcrumb{
    padding-left: 5px;
}
.body{
    margin-left: 10px;
}
    </style>
</head>
<body>
<?php
    include "header.php";
    ?>
       <div class="row">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center">
              <li class="breadcrumb-item"><a class="home" href="index.php">Home</a></li>
              <li class="breadcrumb-item" ><a class="home" href="college.php?college=<?= $property['college_name']; ?>"><?= $property['college_name']; ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $property['property_name']; ?></li>
            </ol>
          </nav>
    </div>
    <?php
        $property_images = glob("img/properties/" . $property['property_id'] . "/*");
    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo $property_images[0] ?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?php echo $property_images[1] ?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?php echo $property_images[2] ?>" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div><br><br>
    <div class="body">
    <div class="row content">
    <div class="col-3">
        
        </div>
      <div class="col-md-4 stars-all">
      <?php
            $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
            $total_rating = round($total_rating, 1);
            ?>
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
  <div class="col-md-2">
  <?php
                $is_interested = false;
                foreach ($interested_users as $interested_user) {
                    if ($interested_user['user_id'] == $user_id) {
                        $is_interested = true;
                    }
                }

                if ($is_interested) {
                ?>
                    <i id="interested" class="is-interested-image fas fa-heart heart justify-content-end"></i>
                <?php
                } else {
                ?>
                    <i id="notinterested" class="is-interested-image far fa-heart heart justify-content-end"></i>
                <?php
                }
                ?>
  </div>
</div>
<div class="row">
  <div class="col-7">

  </div>
</div><br>
<div class="row">
  <div class="col-3">

  </div>
  <div class="col-md-6">
    <h5 class="details-name"><?= $property['property_name'] ?></h5>
  </div>
</div>
<div class="row">
  <div class="col-3">

  </div>
  <div class="col-md-6">
    <p class="details-address"><?= $property['address'] ?></p>
  </div>
</div>
<div class="row">
  <div class="col-3">

  </div>
  <div class="col-md-9">
  <?php
                if ($property['gender'] == "male") {
                ?>
                    <img class="male" src="img/male.png">
                <?php
                } elseif ($property['gender'] == "female") {
                ?>
                    <img class="male" src="img/female.png">
                <?php
                } else {
                ?>
                    <img class="male" src="img/unisex.png">
                <?php
                }
                ?>
  </div>
</div>
<div class="row">
  <div class="col-3">

  </div>
  <div class="col-md-6">
    <h4 class="amount">₹ <?= number_format($property['rent']) ?>/- Per Month</h4>
  </div>
</div><br/>
<div class="row">
<div class="col-3">

</div>
<div class="col-md-5">
      <h4>Total Strength : <?= number_format($property['strength']) ?></h4>
  </div>
  <div class="col-md-4">
      <h4>Vacancies : <?= number_format($vacancies) ?></h4>
  </div>
</div>
<br>
  <div class="row">
  <div class="col-md-3">

  </div>
  <div class="col-md-5">
  <h4>Distance : <?= $property['distance'] ?></h4>
  </div>
  <div class="col-2">
    <a href="students_details.php?property_id=<?=$property1['id']?>" class="justify-content-end">
      <button type="button" class="btn btn-primary btn1">Book </button>
    </a>
  </div>
</div><br>
<div class="row amenities">
    <div class="row">
        <div class="col-3">

        </div>
        <div class="col-md-6">
            <h2>Contact Information : </h2>
            <h4 class="offset-1">Phone Number : <?= $property['phone'] ?></h3><br><br>
        </div>
    </div>
    <div class="row">
  <div class="col-3">

  </div>
  <div class="col-md-6">
    <div class="page-container">
    <h2>Amenities:</h2><br>
    <div class="row justify-content-between offset-1">
      <div class="col-md-auto">
        <h4>Building</h4>
        <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Building") {
                    ?>
                            <div class="amenity-container">
                                <img src="img/amenities/<?= $amenity['icon'] ?>.svg">
                                <span><?= $amenity['name'] ?></span>
                            </div>
                    <?php
                        }
                    }
                    ?>
      </div>
    <div class="col-md-auto">
      <h4>Common Area</h4>
      <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Common Area") {
                    ?>
                            <div class="amenity-container">
                                <img src="img/amenities/<?= $amenity['icon'] ?>.svg">
                                <span><?= $amenity['name'] ?></span>
                            </div>
                    <?php
                        }
                    }
                    ?>
    </div>
    <div class="col-md-auto">
      <h4>Bedroom</h4>
      <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Bedroom") {
                    ?>
                            <div class="amenity-container">
                                <img src="img/amenities/<?= $amenity['icon'] ?>.svg">
                                <span><?= $amenity['name'] ?></span>
                            </div>
                    <?php
                        }
                    }
                    ?>
    </div>
    <div class="col-md-auto">
      <h4>Washroom</h4>
      <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Washroom") {
                    ?>
                            <div class="amenity-container">
                                <img src="img/amenities/<?= $amenity['icon'] ?>.svg">
                                <span><?= $amenity['name'] ?></span>
                            </div>
                    <?php
                        }
                    }
                    ?>
      </div>
  </div>
  </div><br><br><br>
  <div class="row">
    <h2>About the Property</h2>
        <p><?= $property['description'] ?></p>
  </div>
  <div class="amenities">
      <h2>Property Rating</h2><br><br>
      <div class="row">
        <div class="col-6">
      <div class="row">
      <div class="col-6">
      <span>Cleanliness</span>
      </div>
      <div class="col-md-5 stars-all col-6">
      <?php
                            $rating = $property['rating_clean'];
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                            ?>
                                    <i class="fas fa-star stars"></i>
                                <?php
                                } elseif ($rating >= $i + 0.3) {
                                ?>
                                    <i class="fas fa-star-half-alt stars"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="far fa-star stars"></i>
                            <?php
                                }
                            }
                            ?>
      </div>
    </div><br>
    <div class="row">
    <div class="col-6">
    <span>Food Quality</span>
    </div>
    <div class="col-md-5 stars-all col-6">
    <?php
                            $rating = $property['rating_food'];
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                            ?>
                                    <i class="fas fa-star stars"></i>
                                <?php
                                } elseif ($rating >= $i + 0.3) {
                                ?>
                                    <i class="fas fa-star-half-alt stars"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="far fa-star stars"></i>
                            <?php
                                }
                            }
                            ?>
  </div>
  </div><br>
  <div class="row">
  <div class="col-6">
  <span>Safety</span>
  </div>
    <div class="col-md-5 stars-all col-6">
    <?php
                            $rating = $property['rating_safety'];
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                            ?>
                                    <i class="fas fa-star stars"></i>
                                <?php
                                } elseif ($rating >= $i + 0.3) {
                                ?>
                                    <i class="fas fa-star-half-alt stars"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="far fa-star stars"></i>
                            <?php
                                }
                            }
                            ?>
</div>
</div>
</div>
<div class="rating col-4 align-self-center offset-1">
  <div class="rating1">
  <h2><?php
                        $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
                        $total_rating = round($total_rating, 1);
                        ?>
                        <?= $total_rating ?></h2>
  </div>
  <div class="col-md-4 stars-all">
  <?php
                            $rating = $total_rating;
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                            ?>
                                    <i class="fas fa-star star1"></i>
                                <?php
                                } elseif ($rating >= $i + 0.3) {
                                ?>
                                    <i class="fas fa-star-half-alt star1"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="far fa-star star1"></i>
                            <?php
                                }
                            }
                            ?>
</div>
</div>
</div><br><br>
<div class="row">
  <div class="property-testimonials page-container">
        <h1>What Owner say</h1><br><br>
        <?php
        foreach ($testimonials as $testimonial) {
            $owner_id=$testimonial['owner_id'];
            $sql_5="select * from owners where id=$owner_id";
            $result_5=mysqli_query($conn,$sql_5);
            $owners=mysqli_fetch_assoc($result_5);
            $name=$owners['name'];
        ?>
        <center>
            <div class="testimonial-block ">
                <div class="testimonial-image-container">
                    <img class="testimonial-img round" src="img/man.png" width="100px" height="100px">
                </div>
                <div class="testimonial-text">
                    <i class="fa fa-quote-left" aria-hidden="true"></i>
                    <p><?= $testimonial['content'] ?></p>
                </div>
                <div class="testimonial-name"><h3 style="text-transform: capitalize;">- <?= $name ?></h3></div>
            </div>
        </center>
        <?php
        }
        ?>
    </div>
</div><br><br>
<?php 
 if($college_id==1){
?>
<div class="row">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.663145865658!2d80.62040591478295!3d16.44192568865167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a35f0a2a7d81943%3A0x8ba5d78f65df94b8!2sK%20L%20University!5e0!3m2!1sen!2sin!4v1650370718247!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div> <br><br><br>
<?php 
 }
 elseif($college_id==2){
?>
<div class="row">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3830.314492190914!2d80.32170991478043!3d16.255644388766072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a4a76e740000001%3A0xc41c8498715c6da0!2sR.V.R.%20%26%20J.C.College%20of%20Engineering!5e0!3m2!1sen!2sin!4v1650370775059!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div> <br><br><br>
<?php 
 }
 elseif($college_id==3){
?>
<div class="row">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.9642757069064!2d78.52654681479673!3d17.413501988062976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb9973bb0015e9%3A0x2b40415d8a716d20!2sOsmania%20University!5e0!3m2!1sen!2sin!4v1650370824414!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div> <br><br><br>
<?php 
 }
 elseif($college_id==4){
?>
<div class="row">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3798.3875221258136!2d83.34010631480268!3d17.820459687820456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a395bedc7efb603%3A0x87c06caab54e902a!2sGayatri%20Vidya%20Parishad%20College%20of%20Engineering%20(Autonomous)%20(GVP)%20(GVPCE)!5e0!3m2!1sen!2sin!4v1650370869474!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div> <br><br><br>
<?php 
 }
 elseif($college_id==5){
?>
<div class="row">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3824.6622013921174!2d81.49421901478439!3d16.543142788589762!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a362d5e7ef94f99%3A0x3a2b78f9b48493fe!2sSRKR%20Engineering%20College!5e0!3m2!1sen!2sin!4v1650370920282!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div> <br><br><br>
<?php 
 }
 elseif($college_id==6){
?>
<div class="row">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.590154176305!2d80.49847891478372!3d16.49627768861838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a35f27d40f21c55%3A0x1490eacd54859850!2sVIT-AP%20University!5e0!3m2!1sen!2sin!4v1650370963529!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div> <br><br><br>
<?php 
 }
?>
</div>
</div>
</div><br><br><br>
<?php
include "footer.php"
?>
</body>
</html>