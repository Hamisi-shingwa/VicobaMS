<?php
require_once("../../db/dbconnect.php");
$amount = $_POST['amount'];
$account = $_POST['account'];
$group = $_POST['group'];
$reciept = md5(rand(1000,9000));
$transaction_id = uniqid(true,$reciept);

//Let us perform Credit transaction first 
$insertSql = "INSERT into credit (type,amount,reciept_no,utoken,groupname)
VALUES ('credit','$amount','$reciept','$account','$group')";
$creditQuery = mysqli_query($conn, $insertSql);

$havRealBalance = false;
//Lets check if he/she having any balance on his realbalance
$realB = "SELECT amount from realbalance where utoken='$account' AND groupname='$group'";
$Bquery = mysqli_query($conn,$realB);
if(mysqli_num_rows($Bquery)!=0){
    $havRealBalance = true;
}

if($creditQuery){
    //Check if there is any available balance
$chekSql = "SELECT av_balance from transactions where utoken='$account' order by id desc";
$chekQuery = mysqli_query($conn, $chekSql);

$hasBalance = $amount;
if(mysqli_num_rows($chekQuery)!=0){
    $hasBalance = mysqli_fetch_array($chekQuery)['av_balance'] + $amount;
}

//then before insert in transaction histoey table let first deal with real balance table
if($havRealBalance){
    $realBalance = mysqli_fetch_array($Bquery)['amount'] + $amount;
    //Update available balance if it look that someone he/she already have any amount
    $setNewbalance = "UPDATE realbalance SET amount='$realBalance' where utoken='$account' AND groupname='$group'";
    $setNewbalanceQuery = mysqli_query($conn, $setNewbalance); 
}else{
    //Insert new balance if he/she dont have any amount
    $setNewbalance = "INSERT into realbalance (amount,utoken,groupname) VALUES('$hasBalance','$account','$group')";
    $setNewbalanceQuery = mysqli_query($conn, $setNewbalance);
}

if($setNewbalanceQuery){
    $insertSql = "INSERT into transactions (transaction_type,amount,av_balance,reciept_no,utoken,groupname,withdraw_permision)
VALUES ('credit','$amount','$hasBalance','$reciept','$account','$group','notallowed')";
$insertQuery = mysqli_query($conn, $insertSql);

if($insertQuery){
    session_start();
    $_SESSION['amount'] = $amount;
    $_SESSION['balance'] = $hasBalance;
    $_SESSION['reciept'] = $reciept;

    header("location:./credit.php?token=$account&&info=success");
}
}
}