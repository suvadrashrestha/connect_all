<?php

// print_r($_SESSION['error'])
// // Check if the user is already logged in
// if (isset($_SESSION['unique_id'])) {
//     // Redirect the user to the dashboard or another page
//     header("Location: index.php");
 
// }

// // If the user is not logged in, the login form will be displayed below
?>



    <div class="main">
        <div class="container">
            <div class="logo">

                <img src="assets/images/logo-color.png" alt="nothing">

                <p> Building connections for a better tomorrow.</p>

            </div>
            <div class="form">
                <h2>Signup</h2>

                <form  method="POST" action="assets/php/actions.php?signup" id="form" >
                    <div class="grid-details">
                        <div class="input">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="<?=showFormData('first_name')?>" placeholder="First name" required pattern="[a-zA-Z'-'\s]*">
                            <?=showError('first_name')?>
                        </div>
                        <div class="input">
                            <label>Last name</label>
                            <input type="text" name="last_name" value="<?=showFormData('last_name')?>" placeholder="Last Name" required pattern="[a-zA-Z'-'\s]*">
                            <?=showError('last_name')?>
                        </div>
                    </div>
                   
                    <div class="input">
                        <label>Email</label>
                        <input type="email" value="<?=showFormData('email')?>" name="email" placeholder="Enter your email" required>
                        <?=showError('email')?>
                    </div>
                    

                    <div class="grid-details">
                        <div class="input">
                            <label>Username</label>
                            <input type="text" name="username" value="<?=showFormData('username')?>" placeholder="Username" required pattern="[a-zA-Z'-'\s]*">
                            <?=showError('username')?>
                        </div>
                        <div class="input">
                            <label>Password</label>
                            <input type="password" name="password" value="<?=showFormData('password')?>" placeholder="Password" required >
                            <?=showError('password')?>
                        </div>
                    </div>
                    
                    <div class="input">
                        <label>Gender</label>
                        <div class="gender-radio">
                            <div class="gender-one">
                                Male <input type="radio" name="gender" value="1"  <?=showFormData('gender')==1?'checked':''?>>
                            </div>
                            <div class="gender-one">
                                Female<input type="radio" name="gender" value="2"    <?=showFormData('gender')==2?'checked':''?>>
                            </div>
                            <div class="gender-one">
                                Custom<input type="radio" name="gender" value="0"   <?=showFormData('gender')==0?'checked':''?>>
                            </div>
                        </div>
                    </div>
                    
                         
                    <div class="submit">
                        <input type="submit" value="signup" class="button">
                    </div>
                </form>
                <div class="link">Already have account ? <a href="?login">login</a> </div>
            </div>
        </div>
    </div>



   