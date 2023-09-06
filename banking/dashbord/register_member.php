<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking System</title>
    <link rel="stylesheet" href="../../public/css/banking.css">
</head>
<body>
<div class="container1">
    <div class="navbar">
        <div class="left">
            <a href="../../index.php">Home</a>
            <a href="../../auth/logout.php">Logout</a>
            <a href="./dashbord.php">Back</a>
        </div>
        <div class="right"></div>
    </div>
  
    <section class="new-member-section">
        <div class="side-navbar">
     <?php require "../reg_files/sidenav.php"?>
        </div>
       
        <div class="section-content">
         
    <?php if(isset($_GET['page'])){
        $page = $_GET['page'];
        if($page=='form')  require "../reg_files/reg_form.php"; 
        if($page=='deposite')  require "../transaction/deposite.php"; 
        if($page=='withdraw')  require "../transaction/withdraws.php"; 
        if($page=='history')  require "../transaction/transaction_history.php"; 

        echo " <input type='hidden' id='hidden' value='$page'>";
    } ?>
   
        </div>
    </section>

   
</div>
</body>
<script src="../../public/js/banking.js"></script>
<script>
    const pages = document.getElementById('hidden').value;
    if(pages){
       const activelink = document.querySelector(`.${pages}`)
       activelink.style.backgroundColor='green' 
    }
</script>
</html>