<?php
require_once("../../db/dbconnect.php");
session_start();
if(!$_SESSION['user_name']){
    header("location:../../auth/login.php");
}
  $token = $_SESSION['user_token'];
  $group = $_SESSION['user_group'];

  $hasMember = false;

  $sql = "SELECT fullname,address, email from users where groupname='$group'";
  $query = mysqli_query($conn, $sql);

  if(mysqli_num_rows($query)!=0) $hasMember = true;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
    <link rel="stylesheet" href="../../public/css/dashbord.css">
    <link rel="stylesheet" href="../../public/css/member.css">
</head>
<body>
    <div class="container">
        <!-- top section where navigation bar is -->
<div class="navbar">
  <a href="../../index.php">Home</a>
  <a href="../../auth/logout.php">Logout</a>
  <a href="./dashbord.php">Dashord</a>
</div>

<section>
    <?php
    if($hasMember){
        while($data = mysqli_fetch_array($query)){
            $name = $data['fullname'];
            $address = $data['address'];
            $email = $data['email'];

            echo "<div class='member-details'>
            <div class='round'><img src='../../assets/profile.png' alt='sm'></div>
            <div class='have-transaction-container'>
            <div class='title'>
             <div class='date'>Full Name:</div>
             <b>$name</b>
             </div>
             
             <div class='title'>
             <div class='type'>Address: </div>
             <b>$address</b>  
             </div>
        
             <div class='title'>
             <div class='amount'>Email: </div>
             <b>$email</b>
             </div>
        
            </div>
           </div>
            
            ";
        }
    }else{
        echo " <div class='no-member'>
        <div class='info'>
            <div class='text'>There is no any fellow join with you in your Vicoba group</div>
            <a href='./dashbord.php'><button>Back to dashbord</button></a>
        </div>";
    }
    ?>
  
   </div>
</section>
    </div>
</body>
</html>