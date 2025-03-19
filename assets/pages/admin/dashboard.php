<?php
global $search_param;
$currentPage = "dashboard";
?>
<?php
$users = getRecentUsers();
foreach ($users as $key => $user) {
    if ($user['ac_status'] == 1 || $user['ac_status'] == 0) {
        $users[$key]['buttonName'] = "Block";
    } else {
        $users[$key]['buttonName'] = "Unblock";
    }
    switch ($user['gender']) {
        case 0:
            $users[$key]['gender'] = 'Other';
            break;
        case 1:
            $users[$key]['gender'] = 'Male';
            break;
        case 2:
            $users[$key]['gender'] = 'Female';
            break;
    }
    switch ($user['ac_status']) {
        case 0:
            $users[$key]['ac_status'] = 'Inactive';
            break;
        case 1:
            $users[$key]['ac_status'] = 'Active';
            break;
        case 2:
            $users[$key]['ac_status'] = 'Blocked';
            break;
    }
}
// print("<pre>");
// print_r($users);
// var_dump($user);
?>
<?php $posts = getRecentPosts();
?>
<?php
global $user;
global $follow_suggestions;
?>


<div class="container">

    <?php
    include "sidebar.php";
    ?>
    <!-- Main Content -->
    <main class="content">
        <!-- First Row: Cards (with 4 columns) -->
        <div class="cards">
            <div class="card">
                <h3>Admin</h3>
                <p><?php echo count(getAdminUsers()); ?></p>
            </div>
            <div class="card">
                <h3>Users</h3>
                <p><?php echo count(getNonAdminUsers()); ?></p>
            </div>
            <div class="card">
                <h3>Posts</h3>
                <p><?php echo count(getPosts()); ?></p>

            </div>
            <div class="card">
                <h3>Comments</h3>
                <p><?php echo getCommentCount() ?></p>
            </div>
        </div>
        <div class="user-table">
            <h3>List of Recent Users</h3>
            <table>
                <thead>
                    <tr>
                        <th> S/N</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Profile </th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($key + 1) ?></td>
                            <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>

                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['gender']) ?></td>
                            <td><img height="20px" width="20px" src="assets/images/profiles/<?= $user['profile_pic'] ?>" />
                            </td>
                            <td><?= htmlspecialchars($user['ac_status']) ?></td>
                           
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
         <!-- Second Row: Table -->
         <div class="user-table">
            <h3>List of Recent Posts</h3>
            <table>
                <thead>
                    <tr>
                        <th> S/N</th>
                        <th>Image</th>
                        <th>Description</th>

                        <th>Username</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $key => $post): ?>
                       
                       
                        <tr>
                            <td><?= htmlspecialchars($key + 1) ?></td>
                            <td>
                                <?php
                                if ($post['post_img']) {
                                ?>
                                    <div class="profile-post" style="height:150px">
                                        <img style="height:150px; object-fit:contain" loading='lazy' id='myImage' src="assets/images/posts/<?= $post['post_img'] ?>" alt="Connect All"
                                            class="post-image" />
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <p>----</p>
                                <?php
                                }
                                ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(!empty($post['post_text']) ? $post['post_text'] : '-----') ?>
                            </td>
                            <td> <?= ucfirst($post['username']) ?> </td>

                          
                            </td>
                           
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      
    </main>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const deleteButtons = document.getElementsByClassName("block");

        Array.from(deleteButtons).forEach(button => {
            button.addEventListener("click", (event) => {
                event.preventDefault(); // Prevent default link behavior
                const userId = button.getAttribute("user_id");
                const username = button.getAttribute("username");
                const acStatus = button.getAttribute("ac_status"); // Get account status
                const confirmationMessage = acStatus === "Blocked" ?
                    `Are you sure you want to unblock ${username}?` :
                    `Are you sure you want to block ${username}?`;

                const confirmation = confirm(confirmationMessage);

                if (confirmation) {
                    window.location.href =
                        `assets/php/adminActions.php?user_id=${userId}&blockUnblockUser`;
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        const deleteButtons = document.getElementsByClassName("addAdmin");

        Array.from(deleteButtons).forEach(button => {
            button.addEventListener("click", (event) => {
                event.preventDefault(); // Prevent default link behavior
                const userId = button.getAttribute("user_id");
                const username = button.getAttribute("username");


                const confirmation = confirm(`Are you sure you want to make ${username} as admin?`);

                if (confirmation) {
                    window.location.href =
                        `assets/php/adminActions.php?user_id=${userId}&addAdmin`;
                }
            });
        });
    });
</script>
