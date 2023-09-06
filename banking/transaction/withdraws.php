<?php
require_once('../../db/dbconnect.php');
if(isset($_GET['token'])){
    $account = $_GET['token'];
 $sql = "SELECT fullname, users.groupname,amount,reciept_no,transactions.utoken as token, transactions.time,withdraw_permision            
 from users JOIN transactions ON users.utoken = transactions.utoken 
  where transaction_type='withdraw' AND transactions.utoken='$account'";
$query = mysqli_query($conn, $sql);
}else{
    $sql = "SELECT fullname, users.groupname,amount,reciept_no,transactions.utoken as token, transactions.time,withdraw_permision  
    from users JOIN transactions ON users.utoken = transactions.utoken 
     where transaction_type='withdraw'";
   $query = mysqli_query($conn, $sql);
}
if(isset($_POST['sbtn'])){
    $account = $_POST['account'];
    header("location:./register_member.php?page=withdraw&&token=$account");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pages</title>
    <link rel="stylesheet" href="../../public/css/admin.css">
</head>
<body>
<div class="withdraw-container">
    <form action="" class="search-form" method="post">
        <input type="text" name="account" placeholder="type account number">
        <input type="submit" name="sbtn" value="Search">
        <?php
        if(isset($_GET['status'])){
            $name = $_GET['status'];
            echo "<div class='feedback'>
            Successfull comfirmed that <b>$name</b> was complete
            withdraw
         </div>";
        }
        ?>
    </form>
  
<?php
if($query){
    echo "<div class='withdraws-histry'>";
  echo "<h4>Withdraw Histrory</h4>";
    if(mysqli_num_rows($query)!=0){
        while($data = mysqli_fetch_array($query)){
            $name = $data['fullname'];
            $amount = $data['amount'];
            $time = $data['time'];
            $reciept = $data['reciept_no'];
            $permision = $data['withdraw_permision'];
            $utoken = $data['token'];
            $rtime = substr($time,0,10);
       
            echo "<div class='histories'>";
            echo "<div class='details'><b>Name</b><span>$name</span></div>";
           echo "<div class='details'><b>Date</b><span>$rtime</span></div>";
           echo "<div class='details'><b>Amount</b><span>$amount</span></div>";
           echo "<div class='details'><b>Ref</b><span>$reciept</span></div>";
          if($permision=='currently'){
            echo "<div class='details link'><b></b><a href='../transaction/withdraw_process.php?token=$utoken&&name=$name'>Uncomfirmed</a></div>";
          }else{
           echo "<div class='details link'><b></b><a href=''>comfirmed</a></div>";
          }
       echo "</div>";
           }
           
    }
    else{
  echo "<div class='no-any-history'>
    No any results here
  </div>";
    }
    echo " </div>";
}
?>
   
</div>
</body>
<script>
    const feedback = document.querySelector('.feedback');
   setTimeout(() => {
    if(feedback){
        feedback.style.display='none';
    }
   }, 4000);
</script>
</html>