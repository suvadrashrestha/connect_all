<?php global $user; ?>

<div class="editContainer">
    <div class="card">
        <h1>Update Profile</h1>
        <p class="subtitle">Keep your information up to date</p>
        <form id="profileForm" method="post" action="assets/php/actions.php?updateprofile" enctype="multipart/form-data">
            <div class="form-container">
                <div class="profile-section">
                    <div class="profile-pic-container">
                        <img class="profile-pic"
                            src="assets/images/profiles/<?= $user['profile_pic'] ?: 'default_profile_pic.png' ?>" alt="Profile Picture">
                        <div class="profile-pic-overlay" onclick="document.getElementById('fileInput').click()">
                            <svg class="camera-icon" viewBox="0 0 24 24">
                                <path d="M12 15.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4z" />
                                <path d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z" />
                            </svg>
                        </div>
                        <input name="profile_pic" type="file" id="fileInput">
                        <?= showError('profile_pic') ?>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input name="username" id="username" class="form-control" value="<?= $user['username'] ?>" type="text"
                            placeholder="Enter your username">
                        <?= showError('username') ?>
                    </div>
                </div>

                <div class="details-section">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input id="firstname" class="form-control" name="first_name" value="<?= $user['first_name'] ?>" type="text"
                            placeholder="Enter your first name">
                        <?= showError('first_name') ?>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input id="lastname" class="form-control" name="last_name" value="<?= $user['last_name'] ?>" type="text"
                            placeholder="Enter your last name">
                        <?= showError('last_name') ?>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="gender" value="1" <?= $user['gender'] == 1 ? "checked" : "" ?>> Male
                            </label>
                            <label>
                                <input type="radio" name="gender" value="2" <?= $user['gender'] == 2 ? "checked" : "" ?>> Female
                            </label>
                            <label>
                                <input type="radio" name="gender" value="0" <?= $user['gender'] == 0 ? "checked" : "" ?>> Other
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input style="color:gray" type="email" id="email" class="form-control" value="<?= $user['email'] ?>" disabled>
                    </div>

                    <button type="button" class="update-btn" id="updateBtn">Update Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript for confirmation dialog
    document.getElementById('updateBtn').addEventListener('click', function () {
        const confirmUpdate = confirm("Do you really want to update your profile?");
        if (confirmUpdate) {
            document.getElementById('profileForm').submit();
        }
    });

    // Automatically submit form when profile picture is selected
    document.getElementById('fileInput').addEventListener('change', function () {
        document.getElementById('profileForm').submit();
    });
</script>
