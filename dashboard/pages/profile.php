<?php
$currentUser = $_SESSION['user'];
$id = $currentUser['id'];

// Fetch latest data from DB
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border">
                <div
                    class="card-body d-flex justify-content-between align-items-center bg-primary text-white rounded-top">
                    <div>
                        <h2 class="mb-0">Profile Settings</h2>
                        <small>Manage your account information and profile image</small>
                    </div>
                    <span class="badge badge-info py-2 px-3"><i class="fas fa-user-cog mr-1"></i> Profile</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Profile Form -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Account Information</h5>
                    <small class="text-muted">Update your profile details and password</small>
                </div>
                <div class="card-body">
                    <form method="POST" action="functions/profile.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>"
                                class="form-control" required>
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
                            <label>Profile Image</label>
                            <div class="mb-2">
                                <?php $profileImg = $user['profile_img']; ?>
                                <img id="profile_preview" src="../<?= $profileImg ?: 'assets/img/profile_1.png' ?>"
                                    alt="Profile" class="img-thumbnail" style="max-height: 64px;">
                            </div>
                            <input type="file" name="profile_img" class="form-control-file" accept="image/*"
                                onchange="previewImage(event, 'profile_preview')">
                            <small class="form-text text-muted">Recommended: 64x64px or higher</small>
                        </div>
                        <div class="d-flex justify-content-end pt-3 border-top">
                            <button type="button" class="btn btn-outline-secondary mr-2" onclick="location.reload()">
                                <i class="fas fa-sync-alt mr-1"></i> Reset
                            </button>
                            <button class="btn btn-success">
                                <i class="fas fa-save mr-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm border">
                <div class="card-body">
                    <h5 class="mb-3">Current Profile</h5>
                    <div class="mb-2">
                        <strong>Name:</strong>
                        <div><?= htmlspecialchars($user['name'] ?: 'Not set') ?></div>
                    </div>
                    <div class="mb-2">
                        <strong>Username:</strong>
                        <div><?= htmlspecialchars($user['username'] ?: 'Not set') ?></div>
                    </div>
                    <div class="mb-2">
                        <strong>Profile Image Status:</strong>
                        <?php if ($user['profile_img']): ?>
                            <span class="badge badge-success"><i class="fas fa-check mr-1"></i> Uploaded</span>
                        <?php else: ?>
                            <span class="badge badge-warning"><i class="fas fa-exclamation mr-1"></i> Default</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card border-info">
                <div class="card-body">
                    <h6 class="text-info"><i class="fas fa-info-circle mr-1"></i> Profile Help</h6>
                    <ul class="small text-muted mt-2 mb-0 pl-3">
                        <li>Your name and username are used throughout the system</li>
                        <li>Profile image is shown in the sidebar and header</li>
                        <li>Leave password blank to keep your current password</li>
                        <li>Changes take effect immediately after saving</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Image preview JS -->
<script>
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById(previewId).src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>