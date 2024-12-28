<?php
$users = getNonAdminUsers();
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

<div class="container">

    <?php
    include "sidebar.php";
    ?>
    <!-- Main Content -->
    <main class="content">
        <form method="GET" id="adminSearchForm">
            <input name="listing"
                style="width:50%;height:40px;margin-bottom:10px;padding:10px;border-radius:20px; border:1px solid blue"
                type="text" placeholder="search by username" />
        </form>

        <!-- Second Row: Table -->
        <div class="user-table">
            <h3>List of Users</h3>
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
                        <th>Action</th>
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
                            <td>
                                <?php
                                 if($user['ac_status']=="Active"){
                                    ?>
                                     <a class="addAdmin" ac_status="<?= htmlspecialchars($user['ac_status']) ?>" username="<?= htmlspecialchars($user['username']) ?>"
                                     user_id="<?= htmlspecialchars($user['id']) ?>"> Add Admin</a>
                                    <?php
                                 }
                                ?>
                           
                                <?php
                                if ($user['ac_status'] == 2) {
                                }
                                ?>
                                <a class="block" ac_status="<?= htmlspecialchars($user['ac_status']) ?>" username="<?= htmlspecialchars($user['username']) ?>"
                                    user_id="<?= htmlspecialchars($user['id']) ?>"> <?= $user['buttonName'] ?></a>
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
               

                const confirmation = confirm( `Are you sure you want to make ${username} as admin?`);

                if (confirmation) {
                    window.location.href =
                        `assets/php/adminActions.php?user_id=${userId}&addAdmin`;
                }
            });
        });
    });
</script>