<?php
$currentUser = $_SESSION['user'];
$id = $currentUser['id'];

// Fetch latest data from DB
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

?>

<div class="card col-md-8 mx-auto">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-user-cog mr-2"></i> Update Profile</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="functions/profile.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>"
                    class="form-control" required>
            </div>

            <div class="form-group">
                <label>New Password <small class="text-muted">(leave blank to keep current)</small></label>
                <input type="password" name="password" class="form-control" placeholder="New Password">
            </div>

            <div class="form-group">
                <label>Profile Image</label><br>
                <?php if ($user['profile_img']): ?>
                    <img src="../<?= $user['profile_img'] ?>" alt="Profile" style="height: 60px;"
                        class="img-thumbnail mb-2"><br>
                <?php endif; ?>
                <input type="file" name="profile_img" class="form-control-file">
            </div>

            <button class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
</div>