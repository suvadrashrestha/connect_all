<?php
global $user;
global $search_param;


?>
<nav class="navbar">
 
    <a href="?">
    <div class="infinity-symbol" style="width:73px"></div>
    </a>
     

    <form method="GET" class="search-box">
        <span class="search-icon">🔍</span>
        <input name="search" value="<?= $search_param ?>" type="text" placeholder="Search...">
    </form>

    <div class="nav-links">
        <div class="user-menu" id="userMenu">
            <div class="avatar"><?= ucfirst($user['first_name'][0]) ?><?= ucfirst($user['last_name'][0]) ?></div>
            <div class="dropdown" id="userDropdown">
                <?php
                if (isset($_SESSION['is_admin']) && $_SESSION['admin'] = true) {

                ?>
                    <a style="color:black !important" href="?adminDashboard">⚙️ Admin</a>
                <?php
                }

                ?>

                <a style="color:black !important" href="?u=<?= $user['username'] ?>">👤 My Profile</a>

                <a href="assets/php/actions.php?logout" class="logout-btn">🚪 Logout</a>
            </div>
        </div>
    </div>
</nav>

<script>
    const userMenu = document.getElementById('userMenu');
    const dropdown = document.getElementById('userDropdown');

    userMenu.addEventListener('click', () => {
        dropdown.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target)) {
            dropdown.classList.remove('active');
        }
    });
</script>