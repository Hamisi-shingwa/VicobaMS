<?php 
require_once("../../db/dbconnect.php");
$isNotAvailable = false;
if(isset($_POST['sbtn1'])){
    $account = $_POST['utoken'];
    $sql = "SELECT * from users where utoken='$account'";
    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query)==0) $isNotAvailable = true;
    if(mysqli_num_rows($query)!=0){
        header("location:./register_member.php?page=deposite&&token=$account");
    }
}


?>

<div class="deposite-container">
   <h3>Deposite</h3>
   <form action="" method="post" id="account-form">
    <label for="">Type Account Number</label>
    <input type="text" name="utoken" id="account-input">
    <input class="subimt" type="submit" name="sbtn1"  value="continue">
   </form>
 
   <?php 
   if($isNotAvailable) echo "<div class='notavailable'>
   That account does not exist 
  </div>";
   ?>
   
   <?php
    if(isset($_GET['token'])){
        $account = $_GET['token'];
        $sql = "SELECT * from users where utoken='$account'";
        $query = mysqli_query($conn, $sql);

        $data = mysqli_fetch_array($query);
        $name = $data['fullname'];
        $account = $data['utoken'];
        $group = $data['groupname'];
 
        echo " 
        <form class='transaction-details' action='../transaction/deposite_process.php' method='post'>
             <h4>$name</h4><br>
             <h4>$account</h4><br>
             <input type='hidden' name='account' value='$account'>
             <input type='hidden' name='group' value='$group'>
             <label for=''>Write Amount to continue</label>
             <input type='number' name='amount' id='transaction_input'>
             <input class='subimt' type='submit' name='sbtn2'  value='Deposite'>
        </form>";
       if(isset($_GET['info'])){
        $info = $_GET['info'];
        if($info=='success'){
            session_start();
      $amount = $_SESSION['amount'];
      $hasBalance =  $_SESSION['balance'];
      $reciept = $_SESSION['reciept'];
    echo "<div class='hasdeposite'>
      <div class='info'>Successfull deposite</div>
      <div class='details'>Acount No:  <b>$account</b></div>
      <div class='details'>Amount:  <b>$amount Tsh</b></div>
      <div class='details'>Available balance:  <b>$hasBalance Tsh</b></div>
      <div class='details'>Reciept No:  <b>$reciept </b></div>
     </div>";
        }
       }
    }
  ?>
</div>
