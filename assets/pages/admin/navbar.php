<?php
global $user;
global $search_param;


?>
<nav class="navbar">
    <a href="?" class="logo">
        <div class="infinity-symbol" style="width:73px"></div>
    </a>



    <div class="nav-links">
        <div class="user-menu" id="userMenu">
            <div class="avatar"><?= ucfirst($user['first_name'][0]) ?><?= ucfirst($user['last_name'][0]) ?></div>
            <div class="dropdown" id="userDropdown">



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