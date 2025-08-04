<?php
if ($_SESSION['user']['user_type'] !== 'admin') {
    echo "<div class='alert alert-danger'>Access denied.</div>";
    exit;
}
include_once __DIR__ . '/../functions/setting.php';

$success = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation
    if (empty($_POST['system_name']))
        $errors[] = "System Name is required.";
    if (empty($_POST['system_full_name']))
        $errors[] = "System Full Name is required.";

    if (!$errors) {
        update_setting('system_name', $_POST['system_name']);
        update_setting('system_full_name', $_POST['system_full_name']);

        // Handle system logo upload
        if (!empty($_FILES['system_logo']['tmp_name'])) {
            $ext = pathinfo($_FILES['system_logo']['name'], PATHINFO_EXTENSION);
            $path = 'uploads/logo.' . $ext;
            move_uploaded_file($_FILES['system_logo']['tmp_name'], __DIR__ . '/../../' . $path);
            update_setting('system_logo', $path);
        }

        // Handle cover image upload
        if (!empty($_FILES['system_cover_img']['tmp_name'])) {
            $ext = pathinfo($_FILES['system_cover_img']['name'], PATHINFO_EXTENSION);
            $path = 'uploads/cover.' . $ext;
            move_uploaded_file($_FILES['system_cover_img']['tmp_name'], __DIR__ . '/../../' . $path);
            update_setting('system_cover_img', $path);
        }

        $success = "Settings updated!";
    }
}
?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border">
                <div
                    class="card-body d-flex justify-content-between align-items-center bg-primary text-white rounded-top">
                    <div>
                        <h2 class="mb-0">System Settings</h2>
                        <small>Manage your system configuration and appearance</small>
                    </div>
                    <span class="badge badge-info py-2 px-3"><i class="fas fa-cog mr-1"></i> Settings</span>
                </div>
            </div>
        </div>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <?= $success ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php if ($errors): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Settings Form -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border">
                <div class="card-header bg-light">
                    <h5 class="mb-0">System Configuration</h5>
                    <small class="text-muted">Update your system settings and branding</small>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>System Short Name</label>
                            <input type="text" name="system_name" class="form-control"
                                value="<?= htmlspecialchars(get_setting('system_name')) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>System Full Name</label>
                            <input type="text" name="system_full_name" class="form-control"
                                value="<?= htmlspecialchars(get_setting('system_full_name')) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>System Logo</label>
                            <div class="mb-2">
                                <?php $logo = get_setting('system_logo'); ?>
                                <img id="logo_preview" src="../<?= $logo ?: 'assets/img/logo.png' ?>" alt="Logo"
                                    class="img-thumbnail" style="max-height: 64px;">
                            </div>
                            <input type="file" name="system_logo" class="form-control-file" accept="image/*"
                                onchange="previewImage(event, 'logo_preview')">
                            <small class="form-text text-muted">Recommended: 64x64px or higher</small>
                        </div>
                        <div class="form-group">
                            <label>System Cover Image</label>
                            <div class="mb-2">
                                <?php $cover = get_setting('system_cover_img'); ?>
                                <img id="cover_preview" src="../<?= $cover ?: 'assets/img/bg.png' ?>" alt="Cover"
                                    class="img-thumbnail" style="max-height: 480px; width:100%;">
                            </div>
                            <input type="file" name="system_cover_img" class="form-control-file" accept="image/*"
                                onchange="previewImage(event, 'cover_preview')">
                            <small class="form-text text-muted">Used as background for login and auth pages</small>
                        </div>
                        <div class="d-flex justify-content-end pt-3 border-top">
                            <button type="button" class="btn btn-outline-secondary mr-2" onclick="location.reload()">
                                <i class="fas fa-sync-alt mr-1"></i> Reset
                            </button>
                            <button class="btn btn-success">
                                <i class="fas fa-save mr-1"></i> Save Settings
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
                    <h5 class="mb-3">Current Settings</h5>
                    <div class="mb-2">
                        <strong>System Name:</strong>
                        <div><?= htmlspecialchars(get_setting('system_name') ?: 'Not set') ?></div>
                    </div>
                    <div class="mb-2">
                        <strong>Logo Status:</strong>
                        <?php if (get_setting('system_logo')): ?>
                            <span class="badge badge-success"><i class="fas fa-check mr-1"></i> Uploaded</span>
                        <?php else: ?>
                            <span class="badge badge-warning"><i class="fas fa-exclamation mr-1"></i> Default</span>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <strong>Cover Image Status:</strong>
                        <?php if (get_setting('system_cover_img')): ?>
                            <span class="badge badge-success"><i class="fas fa-check mr-1"></i> Uploaded</span>
                        <?php else: ?>
                            <span class="badge badge-warning"><i class="fas fa-exclamation mr-1"></i> Default</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card border-info">
                <div class="card-body">
                    <h6 class="text-info"><i class="fas fa-info-circle mr-1"></i> Settings Help</h6>
                    <ul class="small text-muted mt-2 mb-0 pl-3">
                        <li>System Name appears in the header and browser title</li>
                        <li>Logo is displayed in the sidebar and favicon</li>
                        <li>Cover image is used as background for auth pages</li>
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