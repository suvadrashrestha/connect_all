<?php $users = getAdminUsers();

foreach ($users as $key => $user) {
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
}
?>
<div class="container">

    <?php
    include "sidebar.php";
    ?>
    <!-- Main Content -->
    <main class="content">
       

        <!-- Second Row: Table -->
        <div class="user-table">
            <h3>List of Admins</h3>
            <table>
                <thead>
                    <tr>
                        <th> S/N</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Profile </th>
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
                            <td>
                                <a class="delete" username="<?= htmlspecialchars($user['username']) ?>"
                                    user_id="<?= htmlspecialchars($user['id']) ?>">Remove</a>
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
        const deleteButtons = document.getElementsByClassName("delete");

        Array.from(deleteButtons).forEach(button => {
            button.addEventListener("click", (event) => {
                event.preventDefault(); // Prevent default link behavior
                const userId = button.getAttribute("user_id");
                const username = button.getAttribute("username");
                const confirmation = confirm(
                    ` Are you sure you want to remove ${username} as admin ? `);

                if (confirmation) {
                    // Redirect to another page with user ID as a query parameter
                    window.location.href =
                        `assets/php/adminActions.php?user_id=${userId}&removeAdmin`;
                }
            });
        });
    });
</script>