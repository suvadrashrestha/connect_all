<?php
global $user;
global $search_param;


?>
<header style="height:60px">
    <div class="header" style="justify-content:flex-end">
        <!-- <form> -->
        <!-- </form> -->
        <div class="user-menu">
            <img style="border: 1px solid gray; object-fit:cover" loading="lazy" class="logo" src="assets/images/profiles/<?= $user['profile_pic'] ?>" alt="logo" />
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