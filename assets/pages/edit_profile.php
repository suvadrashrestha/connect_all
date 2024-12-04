<?php global $user; ?>


<form method="post" action="assets/php/actions.php?updateprofile" enctype="multipart/form-data">
    <div>


    </div>
    <h1>Edit Profile</h1>
    <div>
        <img style="width:500px; height:200px" src="assets/images/profiles/<?= $user['profile_pic'] ?>" alt="...">

        <!-- file -->
        <div>
            <label for="formFile">Change Profile Picture</label>
            <input name="profile_pic" type="file" id="formFile">
            <?= showError('profile_pic') ?>
        </div>
    </div>
    <div>
        <!-- first_name -->
        <div>
            <input name="first_name" value="<?= $user['first_name'] ?>" type="text" placeholder="username/email">
            <label for="floatingInput">first name</label>
            <?= showError('first_name') ?>
        </div>
        <!-- last_name -->
        <div>
            <input type="text" name="last_name" value="<?= $user['last_name'] ?>" placeholder="username/email">
            <label for="floatingInput">last name</label>
            <?= showError('last_name') ?>

        </div>
    </div>
    <div>
        <div>
            <!-- gender -->

            <input type="radio" name="exampleRadios" id="exampleRadios1" value="option1"
                <?= $user['gender'] == 1 ? "checked" : "" ?> disabled>
            <label for="exampleRadios1">
                Male
            </label>
        </div>
        <div>
            <input <?= $user['gender'] == 2 ? "checked" : "" ?> disabled type="radio" name="exampleRadios"
                id="exampleRadios3" value="option2">
            <label for="exampleRadios3">
                Female
            </label>
        </div>
        <div>
            <input <?= $user['gender'] == 0 ? "checked" : "" ?> disabled type="radio" name="exampleRadios"
                id="exampleRadios2" value="option2">
            <label for="exampleRadios2">
                Other
            </label>
        </div>
    </div>
    <!--  email -->
    <div>
        <input type="email" value=<?= $user['email'] ?> disabled>
        <label for="floatingInput">email</label>
    </div>
    <div>
        <input value=<?= $user['username'] ?> type="text" name="username" placeholder="username">
        <label for="floatingInput">username</label>
        <?= showError('username') ?>
    </div>


    <div>
        <button type="submit">Update Profile</button>



    </div>

</form>
<script>
    // Check if the URL contains the 'editprofile=success' parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('editprofile') === 'success') {
        alert('Profile picture updated successfully!');

        // Remove 'editprofile=success' from the URL without refreshing the page
        const newUrl = window.location.origin + window.location.pathname;
        window.history.replaceState({}, document.title, newUrl);
    }
</script>