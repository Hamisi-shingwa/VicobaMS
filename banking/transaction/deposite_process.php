<?php 
require_once("../../db/dbconnect.php");
$amount = $_POST['amount'];
$account = $_POST['account'];
$group = $_POST['group'];
$reciept = md5(rand(1000,9000));
$transaction_id = uniqid(true,$reciept);

$havRealBalance = false;
//First lets check if he/she having any balance on his realbalance
$realB = "SELECT amount from realbalance where utoken='$account' AND groupname='$group'";
$Bquery = mysqli_query($conn,$realB);
if(mysqli_num_rows($Bquery)!=0){
    $havRealBalance = true;
}

//Check if there is any available balance in transaction history table
$chekSql = "SELECT av_balance from transactions where utoken='$account' order by id desc";
$chekQuery = mysqli_query($conn, $chekSql);

$hasBalance = $amount;
if(mysqli_num_rows($chekQuery)!=0){
    $hasBalance = mysqli_fetch_array($chekQuery)['av_balance'] + $amount;
}
//hen before insert in transaction histoey table let first deal with real balance table
if($havRealBalance){
    //Update available balance if it look that someone he/she already have any amount
    $setNewbalance = "UPDATE realbalance SET amount='$hasBalance' where utoken='$account' AND groupname='$group'";
    $setNewbalanceQuery = mysqli_query($conn, $setNewbalance);
}else{
    //Insert new balance if he/she dont have any amount
    $setNewbalance = "INSERT into realbalance (amount,utoken,groupname) VALUES('$hasBalance','$account','$group')";
    $setNewbalanceQuery = mysqli_query($conn, $setNewbalance);
}
//Then let us store history if we have already have realbalance for someone
if($setNewbalanceQuery){
    $insertSql = "INSERT into transactions (transaction_type,amount,av_balance,reciept_no,utoken,groupname,withdraw_permision)
VALUES ('deposite','$amount','$hasBalance','$reciept','$account','$group','notallowed')";
$insertQuery = mysqli_query($conn, $insertSql);

if($insertQuery){
    session_start();
    $_SESSION['amount'] = $amount;
    $_SESSION['balance'] = $hasBalance;
    $_SESSION['reciept'] = $reciept;

    header("location:../dashbord/register_member.php?page=deposite&&token=$account&&info=success");
}
}