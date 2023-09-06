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
            <a href="./register.php">Register</a>
        </div>
    </div>

   <div class="form">
   <h3>Login to proceed</h3>
        <form action="./login_process.php" method="post">

           <label for="Email">Email</label>
           <input type="email" name="email">

           <label for="Password">Password</label>
           <input type="password" name="password">

           <div class="submit-system">
           <input id="submit" type="submit" name="submit" value="Login">
           <div class="show-submit">Login</div>
          <div class="circle-element">
            <div class="circle"></div>
          </div>
          </div>
          <div class="have-acount-details">
            <div class="question">Don't have an account ?</div>
             <a href="./register.php">Click here to register</a>
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