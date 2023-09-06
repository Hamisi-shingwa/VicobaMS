<?php
require_once("../../db/dbconnect.php");
$account = $_SESSION['user_token'];

$canWithdraw = false;

$sql = "SELECT withdraw_permision from transactions where utoken = '$account'";
$query = mysqli_query($conn, $sql);
if(mysqli_num_rows($query)==0) $canWithdraw = false;
else{
    $data = mysqli_fetch_array($query)['withdraw_permision'];
    if($data=="allowed"){
        $canWithdraw = true;
    }
}
?>
<div class="top">services</div>
<div class="middle-aside">
   <a href="./members.php"><button>View Member</button></a> 
   <a   href="./user_transactions.php"><button class="long-btn">View Transaction History</button></a> 
   <a href="./credit.php"><button>Credit</button></a> 
</div>
<div class="bottom-aside">
   <?php 
   if($canWithdraw){
    echo  "<a href='./withdraw.php'><button>Withdraw</button></a>";
   }
   ?>
</div>