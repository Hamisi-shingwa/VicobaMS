<?php
require_once("../../db/dbconnect.php");

$fname = $_POST['fname'];
$gname = $_POST['gname'];
$address = $_POST['address'];
$email = $_POST['email'];
$password = $_POST['pass'];
$photo = $_FILES['photo'];
$document= $_FILES['document'];

function Uploadfile($file){
    $source = $file['tmp_name'];
    $name = $file['name'];
    $firs_ext = explode('.',$name);
    $extention = strtolower(end($firs_ext));
    $unid = uniqid(true,$name).'.'.$extention;
    $destination = "../../assets/server/".$unid;
    move_uploaded_file($source, $destination);
    return $destination;
}

$photoRoot = Uploadfile($photo);
$docRoot = Uploadfile($document);

handleReg($fname,$gname,$address,$email,$password,$photoRoot,$docRoot);

function handleReg($name,$group,$address,$email,$password,$image,$document){
    global $conn;

    //check if all neccessaly values is present
    if($name && $group && $address && $email && $password && $image && $document){

    //lets us check if user is available in database
    $check = "SELECT fullname from users where email='$email'";
    $checkQuery = mysqli_query($conn, $check);

    if(mysqli_num_rows($checkQuery) == 0){
        $utoken = uniqid((rand(1000,9000)));
   
        $pass = password_hash($password,PASSWORD_DEFAULT);
       //then let us insert a value to data base
       $sql = "INSERT into users (fullname,groupname,address,email,status,password,utoken,userphoto,userdocs) VALUES
       ('$name','$group','$address','$email','admin','$pass','$utoken','$image','$document')";
   
       $query = mysqli_query($conn,$sql);
   
       if($query){
        session_start();
        $_SESSION['user_name'] = $name;
        $_SESSION['user_token'] = $utoken;
        // header("location:../profile/users/dashbord.php");
        header("location:../dashbord/register_member.php?info=$password&&page=form");
       }
    }
    else{
        $message = base64_encode("These user already available in our system");
        header("location:../dashbord/register_member.php?msg=$message&&page=form");
    }

    }
    else{
   $message = base64_encode("Please fill all values");
   header("location:../dashbord/register_member.php?msg=$message&&page=form");
    }
 
}