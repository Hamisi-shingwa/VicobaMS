<?php
require_once("../../db/dbconnect.php");
session_start();
if(!$_SESSION['user_name']){
    header("location:../../auth/login.php");
}
  $fname = $_SESSION['user_name'];
  $token = $_SESSION['user_token'];
  $group = $_SESSION['user_group'];

  $classType = 'all';

  if(isset($_GET['type'])){
    $type = $_GET['type'];
    $classType = $type;
    $sql = "SELECT * from transactions where utoken = '$token' AND transaction_type='$type'";
    $query = mysqli_query($conn, $sql);
  }
  else{
    $sql = "SELECT * from transactions where utoken = '$token'";
    $query = mysqli_query($conn, $sql);
  }

  $hasNoTransaction = false;
  if(mysqli_num_rows($query)==0){
    $hasNoTransaction = true;
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
  <a href="./dashbord.php">Dashbord</a>
</div>

<!-- bellow is midddle section we call it as section tag -->
<section class="transaction-section">
   <div class="transaction-top-section">
    <h3>Transaction History</h3>
    <div class="btns">
        <a href="./admin_transactions.php"><button class="all">All Account</button></a>
        <a href="./admin_transactions.php?type=deposite"><button class="deposite">Deposite</button></a>
        <a href="./admin_transactions.php?type=withdraw"><button class="withdraw">Withdraw</button></a>
        <a href="./admin_transactions.php?type=credit"><button class="credit">Credit</button></a>
    </div>
   </div>

   <?php
   if($hasNoTransaction){
    echo "<div class='no-any-transaction'>
    <div class='img'><img src='../../assets/search.png' alt='></div>
    <div class='no-transaction-info'>
        <h4>No any transaction match your filter</h4>
        <span>try another filter</span>
    </div>
   </div>";
   }
   else{
    echo "<div class='have-transaction'>";
 while($data = mysqli_fetch_array($query)){
    $time = $data['time'];
    $type = $data['transaction_type'];
    $amount = $data['amount'];
    $reciept = $data['reciept_no'];
    $rtime = substr($time,0,10);

  echo "<div class='have-transaction-container'>
    <div class='title'>
     <div class='date'>Date:</div>
     <b>$rtime</b>
     </div>
     
     <div class='title'>
     <div class='type'>Type: </div>
     <b>$type</b>  
     </div>

     <div class='title'>
     <div class='amount'>Amount: </div>
     <b>$amount</b>
     </div>

     <div class='title'>
     <div class='reciept'>Reciept No:</div>
     <b>$reciept</b>
     </div>

    </div>";
 }
 echo "<div>";
   
   }
   ?>

<!-- bellow is hidden input all i use its value so as to style a focus filter button -->
<input class="hidden" type="hidden" value="<?php echo $classType ?>">
</section>

<footer>

</footer>
</div>
</body>
<script>
    const type = document.querySelector('.hidden').value
    const btn = document.querySelector(`.${type}`)
    btn.style.backgroundColor = 'rgb(53, 156, 53)'
    </script>
</html>