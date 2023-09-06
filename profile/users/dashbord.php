<?php
require_once("../../db/dbconnect.php");
session_start();
if(!$_SESSION['user_name']){
    header("location:../../auth/login.php");
}
  $fname = $_SESSION['user_name'];
  $token = $_SESSION['user_token'];
  $group = $_SESSION['user_group'];

  $sql = "SELECT amount as balance from realbalance where utoken='$token' order by id desc";
  $query = mysqli_query($conn,$sql);
  // echo $sql;
  // die();
 //Some times return null
 $result = mysqli_fetch_array($query);
 if(empty($result['balance'])){ 
     $hasBalance = '00.00';
 }
 else{
     $hasBalance = $result['balance'];
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>dashbord</title>
<link rel="stylesheet" href="../../public/css/dashbord.css">
</head>
<body>
<div class="container">
<!-- top section where navigation bar is -->
<div class="navbar">
  <a href="../../index.php">Home</a>
  <a href="../../auth/logout.php">Logout</a>
</div>

<!-- bellow is midddle section we call it as section tag -->
<section>
    <!-- thise is left side of our section -->
    <div class="left-section">
    <div class="top-left-section">
    <div class="image-profile">
        <img src="../../assets/profile.png" alt="">
    </div>
      <div class="goup-name"><?php echo "<b>$group</b>" ?></div>
    </div>


    <div class="bottom-left-section">
        <div class="full-name"><?php echo $fname?></div>
           <div class="amount">
            <b>Amount</b>
            <span class='balance'><?php echo $hasBalance?> Tsh</span>
          </div>
        </div>

        <div class="service-controll">
       <div class="service-top">
       <span>Group </span>  <b> <?php echo $group?></b>
       </div>
       <div class="service-bottom">
       <span>Account number</span>  <b> <?php echo $token?></b>
       </div>
    
  
     </div>
    </div>

    <!-- and these is right side -->
    <div class="right-section">
    <?php require "./aside-dashbord.php"?>
    </div>

</section>

<footer>

</footer>
</div>
</body>
</html>