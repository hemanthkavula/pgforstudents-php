<?php
session_start();
require "connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$college_name = $_GET["college"];

$sql_1 = "SELECT * FROM colleges WHERE name = '$college_name'";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo  "Something went wrong!";
    return;
    
}
$college = mysqli_fetch_assoc($result_1);
if (!$college) {
    echo "Sorry! We do not have any PG listed around this college.";
    return;
}
$college_id = $college['id'];

$sql_3 = "SELECT * 
            FROM interested_users_properties iup
            INNER JOIN properties p ON iup.property_id = p.id
            WHERE p.college_id = $college_id";
$result_3 = mysqli_query($conn, $sql_3);
if (!$result_3) {
    echo "Something went wrong!!";
    return;
}
$interested_users_properties = mysqli_fetch_all($result_3, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $college_name ?></title>
    <?php
    include "head_links.php";
    ?>
    <link href="css/property list.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <style>
        select{
            width: 400px;
            height: 30px;
        }
        .card-title{
            text-transform: capitalize;
        }
        .colname{
            text-transform: uppercase;
        }
        .but{
            display: inline;
            padding-left: 5px;
            padding-right: 5px;
        }
        @media (max-width:576px){
            select{
                width: 300px;
                height: 20px;
            }
            .but{
                height: 30px;
                display: inline;
                padding-left: 5px;
                padding-right: 5px;
        }
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
      <li class="breadcrumb-item active colname" aria-current="page">
      <?php echo $college_name; ?>
      </li>
    </ol>
  </nav><br/><br/><br/><br/>
  <div class="row">
      <div class="col-lg-3">

      </div>
      <center>
      <div class="col-lg-6">
        <form method="POST">
        <select name="sort" class="sort">
            <option value="no">--- Select Option --- </option>
            <option value="low-high" <?php if(isset($_POST['sort']) && $_POST['sort']=="low-high"){ echo "selected";} ?> >Lowest Rent First</option>
            <option value="high-low" <?php if(isset($_POST['sort']) && $_POST['sort']=="high-low"){ echo "selected";} ?> >Highest Rent First</option>
            <option value="AC Available" <?php if(isset($_POST['sort']) && $_POST['sort']=="AC Available"){ echo "selected";} ?> >AC Available</option>
            <option value="AC not available" <?php if(isset($_POST['sort']) && $_POST['sort']=="AC not available"){ echo "selected";} ?> >AC not available</option>
            <option value="1-sharing" <?php if(isset($_POST['sort']) && $_POST['sort']=="1-sharing"){ echo "selected";} ?> >1-sharing</option>
            <option value="2-sharing" <?php if(isset($_POST['sort']) && $_POST['sort']=="2-sharing"){ echo "selected";} ?> >2-sharing</option>
            <option value="3-sharing" <?php if(isset($_POST['sort']) && $_POST['sort']=="3-sharing"){ echo "selected";} ?> >3-sharing</option>
            <option value="4-sharing" <?php if(isset($_POST['sort']) && $_POST['sort']=="4-sharing"){ echo "selected";} ?> >4-sharing</option>
        </select>
        <button type="submit" class="but">Filter</button>
        </form>
      </div>
  </div></center><br><br><br>
  <?php 
  $sort_option="";
  if(isset($_POST['sort'])){
      if($_POST['sort'] == "low-high"){
          $sort_option="order by rent asc";
      }
      elseif($_POST['sort']== "high-low"){
        $sort_option="order by rent desc";
      }
      elseif($_POST['sort']== "no"){
        $sort_option="";
      }
      elseif($_POST['sort'] == "AC Available"){
          $sort_option=" and ac='AC Available'";
      }
      elseif($_POST['sort']== "AC not available"){
       $sort_option=" and ac='AC not available'";
      }
      elseif($_POST['sort']== "1-sharing"){
        $sort_option=" and share='1-sharing'";
      }
      elseif($_POST['sort']== "2-sharing"){
       $sort_option=" and share='2-sharing'";
      }
      elseif($_POST['sort']== "3-sharing"){
        $sort_option=" and share='3-sharing'";
      }
      elseif($_POST['sort']== "4-sharing"){
        $sort_option=" and share='4-sharing'";
      }
    }
    $sql_2="select * from properties where college_id=$college_id $sort_option";
    $result_2 = mysqli_query($conn, $sql_2);
    if (!$result_2) {
        echo "Something went wrong!!!";
        return;
  }
  $properties = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
  ?>
  <?php
        foreach ($properties as $property) {
            $property_images = glob("img/properties/" . $property['id'] . "/*");
        ?>
        <?php  
        $property_id=$property['id'];
        $strength=$property['strength'];
        $sql_4="select * from students_details where property_id=$property_id $sort_option";
        $result_4=mysqli_query($conn,$sql_4);
        $details=mysqli_num_rows($result_4);
        $vacancies=$strength-$details;
        ?>
  <div class="card mb-3 card property-id-<?= $property['id'] ?>" style="max-width: 850px;">
    <div class="row g-0">
      <div class="col-md-4 image">
      <img class="img-fluid rounded-start img1" src="<?= $property_images[0] ?>" />
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <div class="col content">
            <div class="col">
            <?php
                        $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
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
                                if ($interested_user_property['property_id'] == $property['id']) {
                                    $interested_users_count++;

                                    if ($interested_user_property['user_id'] == $user_id) {
                                        $is_interested = true;
                                    }
                                }
                            }
                            if ($is_interested) {
                            ?>
                                <i id="interested" class="is-interested-image fas fa-heart heart" property_id="<?= $property['id']; ?>"></i>
                            <?php
                            } else {
                            ?>
                                <i id="notinterested" class="is-interested-image far fa-heart heart" property_id="<?= $property['id']; ?>"></i>
                            <?php
                            }
                            ?>
                        </div>
                    </div><br>
          <h5 class="card-title"><?= $property['name'] ?></h5>
          <p class="card-text"><?= $property['address'] ?></p>
          <?php
                            if ($property['gender'] == "male") {
                            ?>
                                <img class="male" src="img/male.png" />
                            <?php
                            } elseif ($property['gender'] == "female") {
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
            ₹ <?= number_format($property['rent']) ?>/-<p class="month"> per month</p>
        </div> 
  </div>
  <div class="row">
      <div class="col-sm-9">
          <p>Total Strength : <?= number_format($property['strength']) ?> </p>
      </div>
      <div class="col-sm-3">
          <p>Vacancies : <?= number_format($vacancies) ?> </p>
      </div>
  </div>
  <div class="row">
      <div class="col-sm-6">
          <p>Distance : <?= ($property['distance']) ?> </p>
      </div>
  <div class="col-sm-6 button1">
              <a href="property_detail.php?property_id=<?= $property['id'] ?>">
          <button type="button" class="btn btn-primary btn1">View</button>
        </a>
      </div>
  </div>
  </div>
      </div>
    </div>
  </div>
    <?php
        }
    if (count($properties) == 0) {
        ?>
            <div class="no-property-container">
                <p>No PG to list</p>
            </div>
        <?php
        }
        ?>
  </div>
  <br><br><br>
    <?php
include "footer.php"
?>
</body>
</html>