<?php
require_once("../../db/dbconnect.php");
$amount = $_POST['amount'];
$account = $_POST['token'];
$group = $_POST['group'];
$reciept = md5(rand(1000,9000));



$insertSql = "INSERT into transactions (transaction_type,amount,av_balance,reciept_no,utoken,groupname,withdraw_permision)
VALUES ('withdraw','$amount',0,'$reciept','$account','$group','currently')";

$insertQuery = mysqli_query($conn, $insertSql);

if($insertQuery){
    session_start();
    $_SESSION['amount'] = $amount;
    $_SESSION['balance'] = $hasBalance;
    $_SESSION['reciept'] = $reciept;
//let us remove credit transactions from credit table
$crSQL = "UPDATE credit SET amount=0 where utoken='$account' AND groupname='$group'";
$crQuery = mysqli_query($conn, $crSQL);

if($crQuery){
    //let us remove realbalance from credit table
$realBalanceSQL = "UPDATE realbalance SET amount=0 where utoken='$account' AND groupname='$group'";
$realBalanceQuery = mysqli_query($conn, $realBalanceSQL);

}
if($realBalanceQuery) header("location:./admin_withdraw.php?info=success");

   
}
?>