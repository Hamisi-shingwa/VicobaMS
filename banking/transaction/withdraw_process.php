<?php
require_once('../../db/dbconnect.php');
$token = $_GET['token'];
$name = $_GET['name'];

$sql = "UPDATE transactions SET withdraw_permision = 'notallowed' where utoken='$token'";
$qeury = mysqli_query($conn, $sql);

if($qeury){
    header("location:../dashbord/register_member.php?page=withdraw&&status=success&&name=$name");
}
?>