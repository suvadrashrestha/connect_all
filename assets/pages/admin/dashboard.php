<?php
global $user;
global $search_param;
$currentPage = "dashboard";
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
                <p><?php echo count(getPostCount()); ?></p>

            </div>
            <div class="card">
                <h3>Comments</h3>
                <p><?php echo getCommentCount() ?></p>
            </div>
        </div>

        <!-- Second Row: Table -->
        <div class="user-table">
            <h3>List of Users</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john@example.com</td>
                        <td>User</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane@example.com</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Sam Wilson</td>
                        <td>sam@example.com</td>
                        <td>User</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>