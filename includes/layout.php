<?php
include '../config.php';
include '../includes/auth.php';

include '../dashboard/functions/setting.php';

$system_name = get_setting('system_name');
$system_full_name = get_setting('system_full_name');
$system_logo = get_setting('system_logo');
$system_cover = get_setting('system_cover_img');

// Fetch latest profile image from DB
$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare("SELECT profile_img FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
$profile_img = $user['profile_img'] ?? null;

include '../includes/header.php';
include '../includes/sidebar.php';

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0"><?= $title ?? 'Dashboard' ?></h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <?php
            $page = $_GET['page'] ?? 'home';
            $file = __DIR__ . '/../dashboard/pages/' . $page . '.php';

            if (file_exists($file)) {
                include $file;
            } else {
                include '../404.html';
            }
            ?>
        </div>
    </div>
</div>

<div class="position-fixed w-100 d-flex justify-content-center" style="bottom: 1rem; z-index: 9999;">
    <div id="adminToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <strong class="mr-auto"><i class="fas fa-check-circle mr-2"></i>Success</strong>
            <small>Now</small>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toast-body-text">
            <!-- Message goes here -->
        </div>
    </div>
</div>

<div class="position-fixed w-100 d-flex justify-content-center" style="bottom: 1rem; z-index: 9999;">
    <div id="adminToast" class="toast text-white" role="alert" aria-live="assertive" aria-atomic="true"
        data-delay="5000">
        <div class="toast-header">
            <strong class="mr-auto" id="toast-title"></strong>
            <small>Now</small>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toast-body-text"></div>
    </div>
</div>


<?php include '../includes/footer.php'; ?>