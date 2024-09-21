<?php
// session_start();

// Check if the user is already logged in
if (isset($_SESSION['unique_id'])) {
    // Redirect the user to the dashboard or another page
    header("Location: index.php");
    
}

// If the user is not logged in, the login form will be displayed below
?>



    <div class="main">
        <div class="container">
            <div class="logo">

                <img src="assets/images/logo-color.png" alt="nothing">

                <p> Building connections for a better tomorrow.</p>

            </div>
            <div class="form">
                <h2>login</h2>
                <form method="POST"  action="assets/php/actions.php?login" >
                    
                    <div class="input">

                        <input type="text" style="margin: 10px 0px;" name="username_email"  value="<?=showFormData('username_email')?>" placeholder="Enter your email/username"
                            required>
                            <?=showError('username_email')?>
                    </div>


                    <div class="input">

                        <input type="password" value="<?=showFormData('password')?>" name="password" placeholder="Password" required>
                        <?=showError('password')?>
                        <?=showError('checkuser')?>


                    </div>

                    <div class="link forgot">
                        <a href="?forgotpassword&newfp">forgot password?</a>
                    </div>
                    <div class="line"></div>
                    <div class="error-text">Error</div>
                    <div class="submit">
                        <input type="submit" value="login" class="button">
                    </div>
                    
                </form>
                <div class="link">Don't have an account? <a href="?signup">signup</a> </div>
            </div>
        </div>
    </div>

   