<?php if ($_SESSION['user']['user_type'] !== 'admin') {
    echo "<div class='alert alert-danger'>Access denied.</div>";
    exit;
}
include_once __DIR__ . '/../functions/setting.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    echo "<div class='alert alert-success'>Settings updated!</div>";
}
?>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-cogs mr-2"></i>System Settings</h5>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label><i class="fas fa-heading mr-1"></i> System Short Name</label>
                <input type="text" name="system_name" class="form-control"
                    value="<?= htmlspecialchars(get_setting('system_name')) ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-heading mr-1"></i> System Full Name</label>
                <input type="text" name="system_full_name" class="form-control"
                    value="<?= htmlspecialchars(get_setting('system_full_name')) ?>" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-image mr-1"></i> System Logo</label><br>
                <?php $logo = get_setting('system_logo'); ?>
                <?php if ($logo): ?>
                    <img src="../<?= $logo ?>" alt="Logo" class="img-thumbnail mb-2" style="max-height: 60px;">
                <?php endif; ?>
                <input type="file" name="system_logo" class="form-control-file">
            </div>

            <div class="form-group">
                <label><i class="fas fa-photo-video mr-1"></i> Cover Image</label><br>
                <?php $cover = get_setting('system_cover_img'); ?>
                <?php if ($cover): ?>
                    <img src="../<?= $cover ?>" alt="Cover" class="img-thumbnail mb-2" style="max-height: 100px;">
                <?php endif; ?>
                <input type="file" name="system_cover_img" class="form-control-file">
            </div>

            <button class="btn btn-success"><i class="fas fa-save mr-1"></i>Save Settings</button>
        </form>
    </div>
</div>