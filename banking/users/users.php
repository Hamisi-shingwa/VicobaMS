<?php
require_once("../../db/dbconnect.php");
$sql = "SELECT * from users";
$query = mysqli_query($conn, $sql);

$users = [];

while($data = mysqli_fetch_assoc($query)){
    $users[] = $data;
}
echo json_encode($users);
?>