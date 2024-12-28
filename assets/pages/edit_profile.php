<?php global $user; ?>

<form method="post" action="assets/php/actions.php?updateprofile" enctype="multipart/form-data" 
      style="max-width: 800px; margin: auto; font-family: Arial, sans-serif; border: 1px solid #ddd; border-radius: 10px; padding: 20px; background-color: #f9f9f9;">
    <h1 style="text-align: center; color: #333;">Edit Profile</h1>
    
    <!-- Profile Picture -->
    <div style="text-align: center; margin-bottom: 20px;">
        <img style="width: 140px; height: 140px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc;" 
             src="assets/images/profiles/<?= $user['profile_pic'] ?: 'default_profile_pic.png' ?>" alt="Profile Picture">
    </div>

    <!-- Change Profile Picture -->
    <div style="margin-bottom: 20px;">
        <label for="formFile" style="font-weight: bold; display: block; margin-bottom: 5px; text-align:center;">Change Profile Picture</label>
        <input name="profile_pic" type="file" id="formFile" 
               style="width: 40%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;margin-left:240px;">
        <?= showError('profile_pic') ?>
    </div>

    <!-- First Name -->
    <div style="margin-bottom: 20px;">
        <label for="first_name" style="font-weight: bold; display: block; margin-bottom: 5px;margin-left:40px;">First Name</label>
        <input name="first_name" value="<?= $user['first_name'] ?>" type="text" id="first_name" 
               placeholder="Enter your first name" 
               style="width: 80%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;margin-left:40px;">
        <?= showError('first_name') ?>
    </div>

    <!-- Last Name -->
    <div style="margin-bottom: 20px;">
        <label for="last_name" style="font-weight: bold; display: block; margin-bottom: 5px;margin-left:40px;">Last Name</label>
        <input name="last_name" value="<?= $user['last_name'] ?>" type="text" id="last_name" 
               placeholder="Enter your last name" 
               style="width: 80%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;margin-left:40px;">
        <?= showError('last_name') ?>
    </div>

    <!-- Gender -->
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold; display: block; margin-bottom: 5px;margin-left:40px;">Gender</label>
        <div style="display: flex; gap: 20px; align-items: center;">
            <label style="display: flex; align-items: center; gap: 5px;margin-left:40px;">
                <input type="radio" name="exampleRadios" value="1" <?= $user['gender'] == 1 ? "checked" : "" ?>> Male
            </label>
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="radio" name="exampleRadios" value="2" <?= $user['gender'] == 2 ? "checked" : "" ?>> Female
            </label>
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="radio" name="exampleRadios" value="0" <?= $user['gender'] == 0 ? "checked" : "" ?>> Other
            </label>
        </div>
    </div>

    <!-- Email -->
    <div style="margin-bottom: 20px;">
        <label for="email" style="font-weight: bold; display: block; margin-bottom: 5px;margin-left:40px;">Email</label>
        <input type="email" id="email" value="<?= $user['email'] ?>" disabled 
               style="width: 80%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f1f1f1;margin-left:40px;">
    </div>

   

    <!-- Submit Button -->
    <div style="text-align: center; margin-top: 20px;">
        <button type="submit" 
                style="width: 150px; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            Update
        </button>
    </div>
</form>
