<?php

global $user;

?>


<div class="container" style="width:500px">
  <div class="form">
    <h2 style="text-align: center;">Verify Your account</h2>
    <p style="text-align:center">(<?= $user['email'] ?>) </p>
    <p style="text-align: center;margin:20px 0px;">Please enter the 6-digit OTP sent to your email.</p>
    <form method="POST" action="assets/php/actions.php?verify_email" autocomplete="off">

      <div class="inputBox" style="margin:0px">
        <input type="text" name="code" class="otp-field" required>
        <label for="code">Code</label>
      </div>
      <?php
      if (isset($_GET['resended'])) {
      ?>
        <div style="color:#ff4f4f; font-size:15px" >verification code resended</div>
      <?php
      }
      ?>


      <?= showError('email_verify') ?>

      <div class="submit">
      <div class="links" style="margin-top:20px; margin:20px 0px 0px 0px">
      <a  style="color:aquamarine;" href="assets/php/actions.php?resend_code" id="resend-otp" style="float:left;"> resend otp</a>
        </div>
        <input type="submit" value="verify" class="button">
      </div>
    </form>
  </div>
</div>