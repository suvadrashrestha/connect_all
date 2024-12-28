<?php $posts = getPosts();
echo "<pre>";
print_r($posts)
?>
<div class="container">

    <?php
    include "sidebar.php";
    ?>
    <!-- Main Content -->
    <main class="content">
        <form method="GET" action="?DARasearch"> <input
                style="width:50%;height:40px;margin-bottom:10px;padding:10px;border-radius:20px; border:1px solid blue"
                value="" style="width:100%" type="text" placeholder="search" />
        </form>

        <!-- Second Row: Table -->
        <div class="user-table">
            <h3>List of Admins</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Profile </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>

                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['gender']) ?></td>
                            <td><img height="20px" width="20px" src="assets/images/profiles/<?= $user['profile_pic'] ?>" />
                            </td>
                            <td> <button> Edit </button> <button>Delete</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>