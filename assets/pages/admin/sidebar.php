   <?php
    global $currentPage;
    ?>
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
               <a href="?adminDashboard"
                   class="menu-item <?php if ($currentPage == 'dashboard') echo 'active'; ?>">Dashboard</a>
           </li>
           <li>
               <a href="?adminList" class="menu-item <?php if ($currentPage == 'admin') echo 'active'; ?>">Admin</a>
           </li>
           <li>
               <a href="?usersList" class="menu-item <?php if ($currentPage == 'users') echo 'active'; ?>">Users</a>
           </li>
           <li>
               <a href="?postList" class="menu-item <?php if ($currentPage == 'posts') echo 'active'; ?>">Posts</a>
           </li>
       </ul>
   </aside>

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