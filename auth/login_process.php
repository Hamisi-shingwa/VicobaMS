<?php 
require_once("../db/dbconnect.php");

$email = $_POST['email'];
$password = $_POST['password'];

function hanleLogin($email, $pass){
    global $conn;
//let us check if all input having values
if($email && $pass){
 //then lets fecth the user
 $users = "SELECT fullname,groupname,status,password,utoken from users where email='$email'";
 $queryUser = mysqli_query($conn,$users);
//check if the user is available
if(mysqli_num_rows($queryUser) != 0){
 $data = mysqli_fetch_array($queryUser);
 $availablePassword = $data['password']; 
 $username = $data['fullname'];
 $utoken = $data['utoken'];
 $status = $data['status'];
 $gname = $data['groupname'];
 

 if(password_verify($pass,$availablePassword)){
   session_start();
   $_SESSION['user_name'] = $username;
   $_SESSION['user_token'] = $utoken;
   $_SESSION['user_group'] = $gname;
 //check if is admin or not
 if($status=='admin'){
   $_SESSION['group_name'] = $gname;
    header("location:../profile/admin/dashbord.php");
 }else if($status=='bank'){
   header("location:../banking/dashbord/dashbord.php");
 }
 else{
    header("location:../profile/users/dashbord.php");
 }
 }
 else{
    $message = base64_encode("wrong username or password");
    header("location:./login.php?msg=$message");
 }
}
else{
 $message = base64_encode("wrong username or password");
 header("location:./login.php?msg=$message");
}
}
else{
    $message = base64_encode("please fill all value");
    header("location:./login.php?msg=$message");
}

}

hanleLogin($email, $password);