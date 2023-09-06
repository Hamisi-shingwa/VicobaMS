<?php
require_once("../../db/dbconnect.php");
$token = $_SESSION['user_token'];
$sql = "SELECT address, email from users where utoken=''"
?>
