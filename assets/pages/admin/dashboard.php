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
                <p><?php echo count(getPosts()); ?></p>

            </div>
            <div class="card">
                <h3>Comments</h3>
                <p><?php echo getCommentCount() ?></p>
            </div>
        </div>

     
    </main>
</div>