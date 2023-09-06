<?php
require_once("../../db/dbconnect.php");

$sql = "SELECT fullname, utoken,status FROM users WHERE groupname='$gname'";
$query1 = mysqli_query($conn, $sql);

if (isset($_POST['submit'])) {
$account = $_POST['select'];

//Important thing is to make sure if he/she already make nany deposite
$hasdepost = "SELECT amount from realbalance where utoken='$account'";
$depositedQuery = mysqli_query($conn,$hasdepost);

if(mysqli_num_rows($depositedQuery)!=0){
   //Let us deals with realbalance first 
$realbalance = "SELECT SUM(amount) as amounts from realbalance where groupname='$gname'";
$realbalanceQuery = mysqli_query($conn, $realbalance);

if($realbalanceQuery){
    $allAmount = mysqli_fetch_array($realbalanceQuery)['amounts'];
    $insertBalanceToAllowed = "UPDATE realbalance SET amount='$allAmount' where utoken='$account' AND groupname='$gname'";
    $AllowedQuery = mysqli_query($conn,$insertBalanceToAllowed);

    //After rel balance to someone who allowed to withdraw then lets updtae to anotheer 
    if($AllowedQuery){
     $upadateToOthers = "UPDATE realbalance SET amount=0 where groupname='$gname' AND NOT utoken='$account'";
    $uPdateQuery = mysqli_query($conn,$upadateToOthers); 

    //Then after update lets us deals transactions history
    if($uPdateQuery){
// Get the available balance for the member who is allowed to withdraw
$balanceSql = "SELECT SUM(av_balance) as totalbalance FROM transactions WHERE groupname='$gname' AND withdraw_permision='notallowed'";
$balanceQuery = mysqli_query($conn, $balanceSql);
if ($balanceQuery) {
$amount = mysqli_fetch_array($balanceQuery)['totalbalance'];

// Insert a new transaction for the member who is allowed to withdraw
$reciept = md5(rand(1000, 9000));
$insertTransactionSql = "INSERT INTO transactions (transaction_type, amount, av_balance, reciept_no, utoken, groupname, withdraw_permision)
                VALUES ('cashin', '$amount', '$amount', '$reciept', '$account', '$gname', 'currently')";
$insertTransactionQuery = mysqli_query($conn, $insertTransactionSql);

if ($insertTransactionQuery) {
// Update the balances for other members to zero
$updateBalancesSql = "UPDATE transactions SET av_balance = 0, reciept_no = MD5(RAND()), withdraw_permision = 'notallowed'
                WHERE groupname = '$gname' AND NOT utoken = '$account'";
$updateBalancesQuery = mysqli_query($conn, $updateBalancesSql);

if ($updateBalancesQuery) {
// Update all other users to not be allowed to withdraw from the group
$updateWithdrawalPermissionSql = "UPDATE transactions SET withdraw_permision = 'notallowed' WHERE groupname = '$gname' AND NOT utoken = '$account'";
$updateWithdrawalPermissionQuery = mysqli_query($conn, $updateWithdrawalPermissionSql);

if ($updateWithdrawalPermissionQuery) {
// Allow only one user to withdraw within the group
$updateWithdrawalPermissionSql2 = "UPDATE transactions SET withdraw_permision = 'allowed' WHERE utoken = '$account' AND groupname = '$gname'";
$updateWithdrawalPermissionQuery2 = mysqli_query($conn, $updateWithdrawalPermissionSql2);

if ($updateWithdrawalPermissionQuery2) {
    header("location: ./dashbord.php?info=success");
}
}
}
}
}
    }
    }
}
 
}else{
    header("location: ./dashbord.php?info=fail"); 
}



}
?>

<form action="" method="post">
<select name="select" id="select">
<option value="default">Select whom one can withdraw</option>
<?php while ($data = mysqli_fetch_array($query1)) {
$name = $data['fullname'];
$token = $data['utoken'];
$status = $data['status'];
echo "<option value='$token'>$name</option>";
} ?>
</select>
<input class="allow" type="submit" name="submit" value="Allow">
</form>
