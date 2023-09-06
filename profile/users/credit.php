<?php
require_once("../../db/dbconnect.php");
session_start();
if(!$_SESSION['user_name']){
    header("location:../../auth/login.php");
}
  $fname = $_SESSION['user_name'];
  $token = $_SESSION['user_token'];
  $group = $_SESSION['user_group'];

  $maxLoans = 40000;
  $sql = "SELECT SUM(amount) as amounts from credit where utoken='$token' order by id desc";
  $query = mysqli_query($conn,$sql);
  if(mysqli_num_rows($query)!=0){
    $data = mysqli_fetch_array($query)['amounts'];
    $maxLoans = 40000 - $data;
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
<link rel="stylesheet" href="../../public/css/transactions.css">
</head>
<body>
<div class="container withdraw-container">
<!-- top section where navigation bar is -->
<div class="navbar">
  <a href="../../index.php">Home</a>
  <a href="../../auth/logout.php">Logout</a>
  <a href="./dashbord.php">Dashbord</a>
</div>

<!-- bellow is midddle section we call it as section tag -->
<section class="transaction-section">

   <div class="top-section">

<div class="left-top">
     <div class="system-name">Credit Transaction</div>
     <div class="first-details">
        <div class="title">Loan is up to </div>
        <div class="amount-withdraw"><?php echo $maxLoans?></div>
     </div>
     <div class="fee-details">
        <div class="title">Totol Interest fee</div>
        <div class="amount">0.0%</div>
     </div>
    </div>

    <div class="right-top credit-section">
    <form action="./credit_process.php" method="post" class="withdraw-form credit-form">
    <h4>How much you need to borrow</h4>
    <input id="amount" type="number" name="amount" placeholder="enter amount" required>
    <input  type="hidden" name="account" value=<?php echo $token?>>
    <input  type="hidden" name="group" value=<?php echo $group?>>
    <input type="submit" name="sbtn" value="Borrow" >
</form>
    </div>
</div>


</section>

<footer class="<?php if(isset($_GET['info'])) echo 'withdraw-footer'?>">
   <?php
   if(isset($_GET['info'])){
   $amount = $_SESSION['amount'];
    $reciept = $_SESSION['reciept'] ;
    $balance =  $_SESSION['balance'];

    echo "<div class='withdraw-feedback'>
    <h4>Successfull Borrowing</h4>
    <div class='details'><b>Amount</b><span>$amount Tsh</span></div>
    <div class='details'><b>Available Balance</b><span>$balance</span></div>
    <div class='details'><b>Reciept No</b><span>$reciept</span></div>
    <div class='description'>Please Make sure you perform payment early as posible to prevent desturbance
    </div>
    <div class='link'><a href='./dashbord.php'>Back To Dashbord</a></div>
   </div>";
   }
   ?>
</footer>
</div>
</body>
 <script src="../../public/js/credit.js"></script>
</html>