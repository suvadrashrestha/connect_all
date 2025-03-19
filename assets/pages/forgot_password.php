<?php

if (isset($_SESSION['forgot_code']) && (!isset($_SESSION['auth_temp']))) {
  $action = 'verifycode';
} elseif (isset($_SESSION['forgot_code']) && (isset($_SESSION['auth_temp']))) {
  $action = 'changepassword';
} else {
  $action = 'forgotpassword';
}
?>
<?= isset($_SESSION['auth_temp']) ?>
<section style="display:flex; justify-content:center; align-items:center; height:100vh; width:100%">
  <div class="container" style="width:500px;">
    <form method="POST" action="assets/php/actions.php?<?= $action ?>" novalidate>
      <h2 style="text-align: center;">Find your account </h2>
      <?php
      if ($action == 'forgotpassword') {
      ?>

        <p style="text-align: center;margin:20px 0px;">Please enter your email address to reset your password.</p>
        <div class="inputBox">
          <input type="email" name="email" class="email" required onpaste="off">
          <label for="username">Email</label>
        </div>
        <div class="submit">
          <?= showError('email') ?>
          <input type="submit" value="Send verification code " class="button">
        </div>
      <?php
      }
      ?>
      <?php
      if ($action == 'verifycode') {
      ?>
        <p style="text-align: center;margin:20px 0px;">Enter 6 digit code sended to you <?= $_SESSION['forgot_email'] ?></p>
        <div class="inputBox" style="margin:0px">
          <input type="text" name="code" class="email" required onpaste="off">
          <label for="code">Code</label>
        </div>

        <div class="submit">
          <?= showError('email_verify') ?>

          <input type="submit" value="Verify code " class="button">
        </div>
      <?php
      }
      ?>

      <?php

      if ($action == 'changepassword') {
      ?>

        <p style="text-align: center;margin:20px 0px;">Enter new password</p>

        <div class="inputBox" style="margin:0px">
          <input value="<?= showFormData('password') ?>" type="password" name="password" class="email" required onpaste="off">
          <label for="password">New Password</label>
        </div>

        <div class="submit">
          <?= showError('password') ?>
          <input type="submit" value=" change password " class="button">
        </div>
      <?php
      }
      ?>
    </form>
    <br>
    <a style="color:#19e6d5; cursor:pointer;text-decoration:none" href="?login">Back to login page</a>
  </div>
</section>