<?php

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME'], 1), '/');

include '../config.php';
include '../dashboard/functions/setting.php';

$system_name = get_setting('system_name');
$system_full_name = get_setting('system_full_name');
$system_logo = get_setting('system_logo');
$system_cover = get_setting('system_cover_img');

include '../includes/auth-header.php';
?>

<div class="login-box">
    <div class="login-logo">
        <?php if ($system_logo): ?>
            <img src="../<?= $system_logo ?>" alt="System Logo" style="height: 80px;"><br>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><strong><?= $system_name ?></strong>: <?= $system_full_name ?: 'Admin Panel' ?>
            </p>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'username' => $user['username'],
                        'user_type' => $user['user_type'],
                        'profile_img' => $user['profile_img'] ?: 'uploads/default.png'
                    ];
                    header("Location: ../dashboard/index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger'>Invalid credentials</div>";
                }
            }
            ?>

            <form method="POST">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control rounded-pill" required
                        placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text rounded-pill"><span class="fas fa-key"></span></div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control rounded-pill" required
                        placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text rounded-pill">
                            <span class="fas fa-lock" onclick="togglePassword()" style="cursor: pointer;"
                                id="toggleIcon"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill">Sign In</button>
                    </div>
                </div>
            </form>

            <!-- Install App Button - Outside the form -->
            <div class="text-center mt-3">
                <button id="installBtn" class="btn btn-success" style="display: none;">
                    <i class="fas fa-download"></i> Install App
                </button>
            </div>

        </div>
    </div>
</div>

<?php include '../includes/auth-footer.php'; ?>