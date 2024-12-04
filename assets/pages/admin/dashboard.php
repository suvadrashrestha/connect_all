<?php
global $user;
global $search_param;
$currentPage = "dashboard";

?>
<header style="height:60px">
    <div class="header" style="justify-content:flex-end">
        <!-- <form> -->
        <!-- </form> -->
        <div class="user-menu">
            <img class="logo" src="assets/images/profiles/<?= $user['profile_pic'] ?>" alt="logo" />
            <div id="dropdown">
                <!-- Dropdown Button (Arrow) -->
                <button class="dropdown-btn" id="dropdownButton">Menu</button>

                <!-- Dropdown Content -->
                <div class="dropdown-content" id="dropdownContent">
                    <a style="cursor:pointer" onclick="confirmLogout()">Logout</a>
                    <a href="?">User</a>
                </div>
            </div>
        </div>
    </div>
</header>


<script>
    function confirmLogout() {
        var confirmation = confirm("Are you sure you want to logout?");
        if (confirmation) {
            window.location.href = "assets/php/actions.php?logout";
        }
    }

    // Toggle dropdown visibility on button click
    document
        .getElementById("dropdownButton")
        .addEventListener("click", function() {
            var dropdown = document.getElementById("dropdownContent");
            // Toggle the display between 'block' and 'none'
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        });

    // Optional: Close dropdown if clicked outside of it
    window.onclick = function(event) {
        if (!event.target.matches(".dropdown-btn")) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    };
</script>



<div class="container">
    <!-- Hamburger Icon (Visible on small screens) -->
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Left Menu (Visible on large screens by default) -->
    <aside class="menu">
        <h2>Menu</h2>
        <ul>
            <li>
                <a href="#" class="menu-item <?php if ($currentPage == 'dashboard') echo 'active'; ?>">Dashboard</a>
            </li>
            <li>
                <a href="admin.php" class="menu-item <?php if ($currentPage == 'admin') echo 'active'; ?>">Admin</a>
            </li>
            <li>
                <a href="users.php" class="menu-item <?php if ($currentPage == 'users') echo 'active'; ?>">Users</a>
            </li>
            <li>
                <a href="posts.php" class="menu-item <?php if ($currentPage == 'posts') echo 'active'; ?>">Posts</a>
            </li>
            <li>
                <a href="comments.php"
                    class="menu-item <?php if ($currentPage == 'comments') echo 'active'; ?>">Comments</a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <form method="GET"> <input
                style="width:50%;height:40px;margin-bottom:10px;padding:10px;border-radius:20px; border:1px solid blue"
                value="<?= $search_param ?>" style="width:100%" type="text" id="search" placeholder="search" />
        </form>
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
                <p><?php echo getPostCount(); ?></p>

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

<script>
    // Toggle menu visibility on hamburger click
    const hamburger = document.querySelector(".hamburger");
    const menu = document.querySelector(".menu");
    const menuItems = document.querySelectorAll(".menu-item");

    hamburger.addEventListener("click", () => {
        menu.classList.toggle("open");
    });

    // Hide menu when any menu item is clicked (for small screens)
    menuItems.forEach((item) => {
        item.addEventListener("click", () => {
            if (window.innerWidth <= 768) {
                menu.classList.remove("open");
            }
        });
    });
</script>