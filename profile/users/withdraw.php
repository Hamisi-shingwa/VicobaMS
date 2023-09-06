<?php
require_once("../../db/dbconnect.php");
session_start();
if(!$_SESSION['user_name']){
    header("location:../../auth/login.php");
}
  $fname = $_SESSION['user_name'];
  $token = $_SESSION['user_token'];
  $group = $_SESSION['user_group'];

   $data = 0;
  $sql = "SELECT amount from realbalance where utoken='$token'";
  $query = mysqli_query($conn,$sql);
  if(mysqli_num_rows($query) !=0){
    $data = mysqli_fetch_array($query)['amount'];
  }
  //check if he/she have loarn
  $haveLoan = false;
  $loarnAmount = 0;
  $lornSql = "SELECT SUM(amount) as amounts from credit where utoken='$token'";
  $query = mysqli_query($conn,$lornSql);
  if(mysqli_num_rows($query)!=0){
    $loarnAmount = mysqli_fetch_array($query)['amounts'];
    $haveLoan = true;
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
     <div class="system-name">VicMas</div>
     <div class="first-details">
        <div class="title">Available amount</div>
        <div class="amount"><?php echo $data ?></div>
     </div>
     <div class="fee-details">
        <div class="title">Total amount to withdraw</div>
        <div class="amount-withdraw"><?php
          if($haveLoan){
            echo $data - $loarnAmount;
          }
          else{
            echo $data;
          }
         ?></div>
         
     </div>
    <?php if($haveLoan && $loarnAmount > 0) echo " <div>You was borrow Tsh <b class='loarn'>$loarnAmount</b></div>"?>
    </div>

    <div class="right-top">
        <div class="icons"><img src="../../assets/warning.png" alt=""></div>
        <div class="details">
            Please Note that this is not banking system you have to withdraw all your fund. It should fall within the suggested
             range and can
            not be more than the available in your account. All funds seen in your account is base on donation
            over your fellow group(Vicoba) member. If you see something wrong please contact your group leader
            for more details
        </div>
    </div>
</div>

<form action="./withdraw_process.php" method="post" class="withdraw-form">
    <h4>Withdraw your fund</h4>
    <input id="amount" type="number" name="amount" placeholder="enter amount" required>
    <input  type="hidden" name="token" value=<?php echo $token?>>
    <input  type="hidden" name="group" value=<?php echo $group?>>
    <input type="submit" name="sbtn" value="Withdraw" >
</form>
</section>

<footer class="<?php if(isset($_GET['info'])) echo 'withdraw-footer'?>">
   <?php
   if(isset($_GET['info'])){
   $amount = $_SESSION['amount'];
    $reciept = $_SESSION['reciept'] ;

    echo "<div class='withdraw-feedback'>
    <h4>Successfull withdraw</h4>
    <div class='details'><b>Amount</b><span>$amount Tsh</span></div>
    <div class='details'><b>Available Balance</b><span>0</span></div>
    <div class='details'><b>Reciept No</b><span>$reciept</span></div>
    <div class='description'>Please visit at any VicMas Agent near by with this reciept no and 
      Your account number to recieve your cash
    </div>
    <div class='link'><a href='./dashbord.php'>Back To Dashbord</a></div>
   </div>";
   }
   ?>
  
</footer>
</div>
</body>
 <script src="../../public/js/withdraw.js"></script>
</html>