<?php

global $profile;
global $posts;
global $user;

?>


<div style="display: flex; justify-content: center; align-items: center;">
    <div class="profile_container">
        <!-- Profile Top Section -->
        <section class="profile-top">
            <div class="profile-header">
                <img src="assets/images/profiles/<?= $profile['profile_pic'] ?>" alt="Profile" class="profile-pic">
                <div class="profile-info">
                    <h1 class="profile-name"><?= $profile['first_name'] ?> <?= $profile['last_name'] ?></h1>
                    <p class="username"><?= $profile['username'] ?></p>
                    <div class="profile-stats">
                        <div class="stat-item" id="postsCount">
                            <div class="stat-value"><?= count($posts) ?></div>
                            <div>Posts</div>
                        </div>
                        <div class="stat-item" id="followersBtn">
                            <div class="stat-value"><?= count($profile['followers']) ?></div>
                            <div>Followers</div>
                        </div>
                        <div class="stat-item" id="followingBtn">
                            <div class="stat-value"><?= count($profile['following']) ?></div>
                            <div>Following</div>
                        </div>
                    </div>
                    <?php
                    if (!($user['id'] == $profile['id'])) {
                        if (checkFollowStatus($profile['id'])) {
                    ?>
                            <button class="followbtn unfollow" data-user-id='<?= $profile['id'] ?>' id="followBtn">Unfollow</button>
                        <?php
                        } else {
                        ?>
                            <button class="followbtn follows" data-user-id='<?= $profile['id'] ?>' id="followBtn">Follow</button>
                        <?php
                        }
                    } else {
                        ?>
                        <a href="?editprofile" style="text-decoration: none; margin-top: 10px;">
                            <button class=" follows">Edit Profile</button>
                        </a>

                    <?php
                    }
                    ?>


                </div>
            </div>
        </section>

        <!-- Main Content Section -->
        <div class="main-content">
            <!-- Left Column -->
            <div class="connections-column" id="connectionsColumn">
                <div class="connections-header">
                    <h3 id="connectionsTitle">Followers</h3>
                    <button style="padding: 5px;" user_id=<?= $profile['id'] ?> id="toggleBtn">Switch to Following</button>
                </div>
                <div id="connectionsList">
                    <?php
                    foreach ($profile['followers'] as $users) {
                    ?>
                        <div class="connection-item">
                            <a href="?u=<?= $users['username'] ?>"> <img loading="lazy" style="object-fit: cover;" src="assets/images/profiles/<?= $users['profile_pic'] ?>" class="connection-pic"></a>
                            <div>
                                <strong><?= ucfirst($users['first_name']) ?> <?= ucfirst($users['last_name']) ?></strong>
                                <div><?= $users['username'] ?></div>
                            </div>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!-- Middle Column -->
            <div class="posts-column" id="postsColumn">
                <?php
                if (($user['id'] == $profile['id'])) {
                ?>
                    <div class="newPost" style="margin-bottom: 10px;">
                        <img style="border: 1px solid gray; object-fit:cover" loading="lazy" class="image" src="assets/images/profiles/<?= $user['profile_pic'] ?>" />
                        <button class="photo_button" id="openModal"> What's on your mind?</button>
                    </div>
                <?php
                }
                ?>

                <?php
                foreach ($posts as $post) {
                    include("parts/profilePosts.php");
                ?>
                    <!-- modal for like -->
                    <div id="modal_user_like_<?= $post['id'] ?>" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Users</h3>
                                <span style="cursor:pointer" data-post-id="<?= $post['id'] ?>" class="close"
                                    id="closeModal">&times;</span>
                            </div>
                            <div id="modal_content_<?= $post['id'] ?>">

                            </div>
                        </div>
                    </div>


                    <!-- modal for comment -->
                    <div id="modal_comment_<?= $post['id'] ?>" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <?php
                                $user_name = getUser($post['user_id'])
                                ?>
                                <h3><?= ucfirst($user_name['first_name']) ?>'s post</h3>
                                <span style="cursor:pointer" class="close comment_close"
                                    id="closeCommentModal<?= $post['id'] ?>">&times;</span>
                            </div>

                            <div class="commentScroll" id="comment_container_<?= $post['id'] ?>"
                                style="max-height:60vh;overflow-y:scroll; overflow-wrap:anywhere;">
                                <?php
                                $comments = getComments($post['id']);
                                foreach ($comments as $comment) {
                                    $comment_user = getUser($comment['user_id']);
                                ?> <div style="display: flex;gap:10px ;margin-bottom:10px; ">
                                        <a href="?u=<?= $comment_user['username'] ?>">

                                            <img class="image" src="assets/images/profiles/<?= $comment_user['profile_pic'] ?>">
                                        </a>
                                        <div style="background-color:#e6f1ff; padding:10px; border-radius:10px;width:100%">
                                            <span><b>
                                                    <a style="text-decoration:none;color:black"
                                                        href="?u=<?= $comment_user['username'] ?> ">
                                                        <?= ucfirst($comment_user['username']) ?>
                                                    </a>
                                                </b></span>
                                            <span style="display:block"><?= $comment['comment'] ?></span>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>


                            </div>

                            <div style="display:flex; gap:10px; align-items:center">
                                <textarea id="comment_value_<?= $post['id'] ?>"
                                    style="width: 90%; padding:10px ; border-radius:10px" placeholder="write a comment"></textarea>
                                <button style="height:40px;width:50px" class="comment_btn" data-post-id="<?= $post['id'] ?>">send</button>
                            </div>


                        </div>
                    </div>
                <?php
                }

                ?>
                <div class="posts" style="margin-top: 0px; margin-bottom: 10px; padding:10px">
                    <h4> No posts</h4>
                </div>

            </div>

            <!-- Right Column -->
            <div class="photos-column">
                <div class="connections-header">
                    <h3>Photos</h3>

                </div>
                <div class="photos-grid" id="photosGrid">
                    <?php
                    foreach ($posts as $post) {
                        if ($post['post_img']) {
                    ?>
                            <div class="photo-item">
                                <img loading="lazy" style="cursor: pointer;" src="assets/images/posts/<?= $post['post_img'] ?>" alt="Photo">
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>
                <div class="popup-overlay" id="popupOverlay">
                    <span class="close-btn" id="closeBtn">&times;</span>
                    <img id="popupImage" src="" alt="Popup Photo">
                </div>
                <div style="padding: 10px;">
                    No photo
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'parts/postmodal.php';
?>
<script>
    const followBtn = document.getElementById('followBtn');
    if (followBtn) {
        followBtn.addEventListener('click', () => {
            if (followBtn.textContent.trim() === 'Follow') {
                followBtn.textContent = 'UnFollow';
                followBtn.style.background = '#e91e63'; // Solid color for "Following"
            } else {
                followBtn.textContent = 'Follow';
                followBtn.style.background = 'linear-gradient(to right, #00bcd4, #e91e63)'; // Gradient for "Follow"
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('toggleBtn'); // Get the toggle button
        const connectionList = document.getElementById("connectionsList"); // Get the connections list container
        const connectionsTitle = document.getElementById("connectionsTitle"); // Get the connections list container

        // Add an event listener to the toggle button
        toggleBtn.addEventListener('click', async () => {
            try {
                const userId = event.target.getAttribute('user_id');
                console.log("userId", userId);
                // Determine the current state and toggle it
                const currentTitleState = connectionsTitle.innerText.trim();
                const titleNewState = currentTitleState === "Followers" ? "Following" : "Followers";
                const currentState = toggleBtn.innerText.trim();
                const newState = currentState === "Switch to Followers" ? "Switch to Following" : "Switch to Followers";
                toggleBtn.innerText = newState;
                connectionsTitle.innerText = titleNewState;

                // Send a request based on the state

                const endpoint = currentState === "Switch to Followers" ? "followers" : "following";
                const response = await fetch(`assets/php/ajax.php?${endpoint}`, {
                    method: 'POST', // Assuming you are sending data, change to 'PUT' if required
                    headers: {
                        'Content-Type': 'application/json', // Set the content type to JSON
                    },
                    body: JSON.stringify({
                        user_id: userId
                    }) // Send user_id in the request body
                });
                if (!response.ok) {
                    throw new Error("Failed to fetch connections data.");
                }

                const data = await response.json(); // Assuming response is JSON
                // Clear the current list and update it with new data
                connectionList.innerHTML = data.data
                    .map(
                        (user) => `
                        <div class="connection-item">
                           <a href="?u=${user.username}"> <img  loading='lazy' style='object-fit:cover' src="assets/images/profiles/${user.profile_pic}" alt="${user.name}" class="connection-pic"> </a>
                            <div>
                                <strong>${user.first_name} ${user.last_name}</strong>
                                <div>${user.username}</div>
                            </div>
                        </div>
                    `
                    )
                    .join('');
                console.log(data);
            } catch (error) {
                console.error("Error updating connections list:", error);
            }
        });
    });
    const photosGrid = document.getElementById('photosGrid');
        const popupOverlay = document.getElementById('popupOverlay');
        const popupImage = document.getElementById('popupImage');
        const closeBtn = document.getElementById('closeBtn');

        // Event listener for image clicks
        photosGrid.addEventListener('click', (event) => {
            if (event.target.tagName === 'IMG') {
                const imgSrc = event.target.src;
                popupImage.src = imgSrc; // Set the clicked image as the popup image
                popupOverlay.style.display = 'flex'; // Show the popup
            }
        });

        // Close the popup when the close button is clicked
        closeBtn.addEventListener('click', () => {
            popupOverlay.style.display = 'none';
        });

        // Close the popup when clicking outside the image
        popupOverlay.addEventListener('click', (event) => {
            if (event.target === popupOverlay) {
                popupOverlay.style.display = 'none';
            }
        });
</script>