<?php
// Initiation of database connection
require_once("../db/dbconnect.php");
$sql = "SELECT distinct groupname from users";
$query = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../public/css/index.css">
    <link rel="stylesheet" href="../public/css/auth.css">
</head>
<body>
    <div class="container">
    <div class="navbar">
        <div class="left">v</div>
        <div class="aside">
            <a href="../index.php">Home</a>
            <a href="./login.php">Login</a>
        </div>
    </div>

   <div class="form">
  
        <form action="./register_process.php" method="post" id="reg">
           <label for="Full Name">Full Name</label>
           <input type="text" name="fname">

           <label for="Group Name">Which group you are</label>
           <select name="gname" id="select">
            <option value="">Select from registered groups</option>
            <?php while($data=mysqli_fetch_array($query)){
                $gname = $data['groupname'];
              if($gname!=""){
                echo "<option value='$gname'>$gname</option>";
              }
            }?>
           </select>
           <!-- <input type="text" name="gname"> -->

           <label for="Address">Address</label>
           <input type="text" name="address">

           <label for="Email">Email</label>
           <input type="email" name="email">

           <label for="Password">Password</label>
           <input type="password" name="password">

           <label for="Comfirm Password">Comfirm Password</label>
           <input type="password" name="cpassword">

          <div class="submit-system">
          <input id="submit" type="submit" name="submit" value="Submit">
          <div class="show-submit">Register</div>
          <div class="circle-element">
            <div class="circle"></div>
          </div>
          </div>
          <div class="have-acount-details">
            <div class="question">Already  have an account ?</div>
             <a href="./login.php">Click here to login</a>
          </div>
        </form>
        <div class="feedback-element <?php if(isset($_GET['msg'])) echo 'show'?>" >
         <?php if(isset($_GET['msg'])) echo base64_decode($_GET['msg'])?>
    </div>
   </div>

<footer></footer>
    </div>
</body>
<script src="../public/js/index.js"></script>
</html>