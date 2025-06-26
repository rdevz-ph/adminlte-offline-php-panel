<?php
if ($_SESSION['user']['user_type'] !== 'admin') {
    echo "<div class='alert alert-danger'>Access denied.</div>";
    exit;
}

$currentUser = $_SESSION['user'];
$currentUserId = $currentUser['id'];
$currentUserType = $currentUser['user_type'];

if ($currentUserType === 'admin') {
    // Admins can view all users except themselves
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id != ? ORDER BY id DESC");
    $stmt->execute([$currentUserId]);
} else {
    // Non-admins see nothing or limited view
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?"); // or no rows
    $stmt->execute([$currentUserId]); // just their own record (optional)
}

$users = $stmt->fetchAll();
?>

<div class="mb-3">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">Add User</button>
</div>

<div class="card shadow">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-users mr-2"></i>User List</h5>
    </div>
    <div class="card-body">
        <table id="userTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['user_type'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-info edit-btn" data-id="<?= $user['id'] ?>"
                                data-name="<?= htmlspecialchars($user['name']) ?>"
                                data-username="<?= htmlspecialchars($user['username']) ?>"
                                data-user_type="<?= $user['user_type'] ?>" data-toggle="modal" data-target="#editUserModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $user['id'] ?>"
                                data-name="<?= htmlspecialchars($user['name']) ?>" data-toggle="modal"
                                data-target="#deleteUserModal">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="POST" action="functions/user.php?action=add">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="add-name">Name</label>
                    <input type="text" name="name" id="add-name" class="form-control mb-2" placeholder="Name" required>

                    <label for="add-username">Username</label>
                    <input type="text" name="username" id="add-username" class="form-control mb-2"
                        placeholder="Username" required>

                    <label for="add-password">Password</label>
                    <input type="password" name="password" id="add-password" class="form-control mb-2"
                        placeholder="Password" required>

                    <label for="add-user-type">User Type</label>
                    <select name="user_type" id="add-user-type" class="form-control mb-2" required>
                        <option value="" disabled selected>Select user type</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="POST" action="functions/user.php?action=edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">

                    <label for="edit-name">Name</label>
                    <input type="text" name="name" id="edit-name" class="form-control mb-2" required>

                    <label for="edit-username">Username</label>
                    <input type="text" name="username" id="edit-username" class="form-control mb-2" required>

                    <label for="edit-user-type">User Type</label>
                    <select name="user_type" id="edit-user-type" class="form-control mb-2" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>

                    <label for="edit-password">New Password</label>
                    <input type="password" name="password" id="edit-password" class="form-control mb-2"
                        placeholder="New Password (leave blank to keep current)">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="GET" action="functions/user.php" id="deleteUserForm">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" id="delete-user-id">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i> Confirm Deletion</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="delete-user-name">this user</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const userIdField = document.getElementById('delete-user-id');
        const userNameField = document.getElementById('delete-user-name');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const userId = button.getAttribute('data-id');
                const userName = button.getAttribute('data-name');
                userIdField.value = userId;
                userNameField.textContent = userName;
            });
        });
    });
</script>