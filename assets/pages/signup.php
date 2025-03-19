<?php

// print_r($_SESSION['error'])
// Check if the user is already logged in
if (isset($_SESSION['unique_id'])) {
    // Redirect the user to the dashboard or another page
    header("Location: index.php");
}

// If the user is not logged in, the login form will be displayed below
?>

<div class="registration-container">
    <!-- Branding Section -->
    <div class="branding">
        <div class="infinity-symbol"></div>
        <h1>Connect-All</h1>
        <p>Building connections for a better tomorrow. Join us and stay connected with your world.</p>
    </div>

    <!-- Form Section -->
    <div class="form-container">
        <form method="POST" action="assets/php/actions.php?signup" id="form">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="<?= showFormData('first_name') ?>" placeholder="First name"  pattern="[a-zA-Z'-'\s]*">
                <?= showError('first_name') ?>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="<?= showFormData('last_name') ?>" placeholder="Last Name"  pattern="[a-zA-Z'-'\s]*">
                <?= showError('last_name') ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="<?= showFormData('email') ?>" name="email" placeholder="Enter your email" >
                <?= showError('email') ?>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?= showFormData('username') ?>" placeholder="Username"  >
                <?= showError('username') ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" value="<?= showFormData('password') ?>" placeholder="Password" required>
                <?= showError('password') ?>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <div class="gender-options">


                    <label><input type="radio" name="gender" value="1" <?= showFormData('gender') == 1 ? 'checked' : '' ?>> Male</label>
                    <label><input type="radio" name="gender" value="2" <?= showFormData('gender') == 2 ? 'checked' : '' ?>> Female</label>
                    <label><input type="radio" name="gender" value="0" <?= showFormData('gender') == 0 ? 'checked' : '' ?>> Custom</label>
                </div>
            </div>
            <button type="submit" class="submit-btn">Sign Up</button>
        </form>
        <div class="footer">
            <p>Already have an account? <a href="?login">Login</a></p>
        </div>
    </div>
</div>