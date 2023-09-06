<?php
require_once("../db/dbconnect.php");

$fname = $_POST['fname'];
$gname = $_POST['gname'];
// $gname = "something";
$address = $_POST['address']; 
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

handleReg($fname,$gname,$address,$email,$password,$cpassword);

function handleReg($name,$group,$address,$email,$password,$cpassword){
    global $conn;

    //check if all neccessaly values is present
    if($name && $group && $address && $email && $password && $cpassword){
        //lets us check if user able to cmfirm its pasword
    if($cpassword == $password){
    //lets us check if user is available in database
    $check = "SELECT fullname from users where email='$name'";
    $checkQuery = mysqli_query($conn, $check);

    if(mysqli_num_rows($checkQuery) == 0){
        $utoken = uniqid((rand(1000,9000)));
   
        $pass = password_hash($password,PASSWORD_DEFAULT);
       //then let us insert a value to data base
       $sql = "INSERT into users (fullname,groupname,address,email,status,password,utoken) VALUES
       ('$name','$group','$address','$email','normal','$pass','$utoken')";
   
       $query = mysqli_query($conn,$sql);
   
       if($query){
        session_start();
        $_SESSION['user_name'] = $name;
        $_SESSION['user_token'] = $utoken;
        $_SESSION['user_group'] = $group;
        header("location:./login.php");
       }
    }
    else{
        $message = base64_encode("These user already available in our system");
        header("location:./register.php?msg=$message'");
    }
    

    }else{
  $message = base64_encode("Password not match make sure you write password that you will be easy to remember it");
  header("location:./register.php?msg=$message'");
    }
    }
    else{
   $message = base64_encode("Please fill all values");
   header("location:./register.php?msg=$message'");
    }
 
}