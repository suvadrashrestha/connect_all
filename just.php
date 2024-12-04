<?php
$currentPage = 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
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
            <!-- First Row: Cards (with 4 columns) -->
            <div class="cards">
                <div class="card">
                    <h3>Admin</h3>
                    <p>10</p>
                </div>
                <div class="card">
                    <h3>Users</h3>
                    <p>450</p>
                </div>
                <div class="card">
                    <h3>Posts</h3>
                    <p>120</p>
                </div>
                <div class="card">
                    <h3>Comments</h3>
                    <p>500</p>
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
</body>

</html>