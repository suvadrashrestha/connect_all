
 <?php 
 
   if(isset($_SESSION['forgot_code']) && (!isset($_SESSION['auth_temp']))){
    $action='verifycode';
   }
   elseif(isset($_SESSION['forgot_code']) && (isset($_SESSION['auth_temp']))){
    $action='changepassword';
   }
   else{
    $action='forgotpassword';
   }
 ?>
 <?=isset($_SESSION['auth_temp'])?>
<section style="display:flex; justify-content:center; align-items:center; height:100vh; width:100%" >
<div class="form" >
<form  method="POST" action="assets/php/actions.php?<?=$action?>"  novalidate>
<h2 style="text-align: center;">Find your account </h2>
         

          <?php

          if($action=='forgotpassword'){
             ?>
           
          <p style="text-align: center;margin:20px 0px;">Please enter you email adress</p>
             
              <div class="fields-input">
                  <input type="email" name="email" class="email" placeholder="Email address" required onpaste="off" >
                 
              </div>
              <div class="submit">
              <?=showError('email')?>
              <input type="submit" value="Send verification code " class="button">
            </div>
             <?php
          }
          ?>



      <?php
          
          if($action=='verifycode'){
             ?>
            
          <p style="text-align: center;margin:20px 0px;">Enter 6 Digit code Sended to you <?=$_SESSION['forgot_email']?></p>
             
              <div class="fields-input">
                  <input type="text" name="code" class="email" placeholder="code" required onpaste="off" >
                 
              </div>
              <div class="submit">
              <?=showError('email_verify')?>

              <input type="submit" value="Verify code " class="button">
            </div>
             <?php
          }
          ?>
           
           <?php
          
          if($action=='changepassword'){
             ?>
            
          <p style="text-align: center;margin:20px 0px;">Enter new password</p>
             
              <div class="fields-input">
                  <input type="password" name="password" class="email" placeholder="new password" required onpaste="off" >
                 
              </div>
              <div class="submit">
                <?=showError('password') ?>
              <input type="submit" value=" change password " class="button">
            </div>
             <?php
          }
          ?>
           
        
          
          </form>
  </div>
</section>