<?php
$users = getNonAdminUsers();
foreach ($users as $key => $user) {
    switch ($user['gender']) {
        case 0:
            $users[$key]['gender'] = 'Female';
            break;
        case 1:
            $users[$key]['gender'] = 'Male';
            break;
        case 2:
            $users[$key]['gender'] = 'Other';
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
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>

                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['gender']) ?></td>
                            <td><img height="20px" width="20px" src="assets/images/profiles/<?= $user['profile_pic'] ?>" />
                            </td>
                            <td><?= htmlspecialchars($user['ac_status']) ?></td>
                            <td> <button> Edit </button> <button>Delete</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>