
<h4>Vicoba Registration Form</h4>
<form id="new-member-form" action="../reg_files/form_process.php" method="post" enctype="multipart/form-data">
  
   <div class="form-first-container">
   <div class="personal-details">
   <h4>Personal details</h4>
   <label for="Name Of Group Admin">Name Of Group Admin</label>
    <input type="text" name="fname">

    <label for="">Name of his/her Kikoba group</label>
    <input type="text" name="gname">

    <label for="">Address</label>
    <input type="text" name="address">

    <label for="">Email</label>
    <input type="text" name="email" placeholder="this will be your user name">

    <label for="">Password</label>
    <input type="password" name="pass">
   </div>

   <div class="document-veridation">
   <h4>Document Validation</h4>
   <div class="photo">
   <label for="">Upload your photo</label>
   <div class="profile-img">
   <img src="../../assets/file.png" alt="photo" class="photo" >
   </div>
    
     <input type="file" name="photo" id="photo">
   </div>

   <div class="document">
   <label for="">Upload Valid document (Passport, National ID, driving license or Vote ID)</label>
    <div class="images"><img src="../../assets/card.png" alt="" class="document-image"> </div>
     <div class="document-element">
        Upload
     </div>
     
     <input type="file" name="document"  id="document">
   </div>
   </div>
   </div>
  <input type="submit" name="sbtn" value="Register">

  <div class="feedback-element <?php if(isset($_GET['msg'])) echo 'show'?>" >
         <?php if(isset($_GET['msg'])) echo base64_decode($_GET['msg'])?>
    </div>

    <div class="feedback-element <?php if(isset($_GET['info'])) echo 'show_ifo'?>" >
         <?php if(isset($_GET['info'])) echo "Successfull Register  "?>
    </div>
</form>