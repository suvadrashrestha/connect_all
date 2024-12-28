<?php
// session_start();

// Check if the user is already logged in
if (isset($_SESSION['unique_id'])) {
    // Redirect the user to the dashboard or another page
    header("Location: index.php");
}

// If the user is not logged in, the login form will be displayed below
?>

<div class="container">
    <div class="logo">
        <img src="assets/images/logo-color.png" alt="Connect-All Logo">
    </div>
    <h2>Welcome Back!</h2>
    <p class="tagline">Building connections for a better tomorrow.</p>
    <form method="POST" id="loginForm" action="assets/php/actions.php?login">
        <div class="inputBox">
            <input type="text" style="margin: 10px 0px;" name="username_email" id="username_email"
                value="<?= showFormData('username_email') ?>" required>
            <label for="username">Username/Email</label>
            <?= showError('username_email') ?>
        </div>
        <div class="inputBox">
            <input id="password_login" type="password" value="<?= showFormData('password') ?>" name="password"
                required>
            <label for="password">Password</label>
            <?= showError('password') ?>
            <?= showError('checkuser') ?>
        </div>
        <div class="links">
            <a href="?forgotpassword&newfp">Forgot Password?</a>
            <a href="?signup">Sign Up</a>
        </div>
        <input type="submit" value="login">
    </form>
    <footer>
        <p>Powered by <a href="#">Connect-All</a></p>
    </footer>
</div>

