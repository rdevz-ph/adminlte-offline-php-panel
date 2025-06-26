<?php
include '../config.php';
include '../dashboard/functions/setting.php';

$system_name = get_setting('system_name');
$system_logo = get_setting('system_logo');
$system_cover = get_setting('system_cover_img');

include '../includes/auth-header.php';
?>

<div class="register-box">
    <div class="register-logo"> <?php if ($system_logo): ?>
            <img src="../<?= $system_logo ?>" alt="System Logo" style="height: 80px;"><br>
        <?php endif; ?>
        <strong><?= $system_name ?: 'Admin Panel' ?></strong>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $stmt = $pdo->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");
                try {
                    $stmt->execute([$name, $username, $password]);
                    echo "<div class='alert alert-success'>Registered successfully. <a href='login.php'>Login</a></div>";
                } catch (PDOException $e) {
                    echo "<div class='alert alert-danger'>Email already exists</div>";
                }
            }
            ?>

            <form method="POST">
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" required placeholder="Full name">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="username" name="username" class="form-control" required placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" required placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8"><a href="login.php">I already have an account</a></div>
                    <div class="col-4"><button type="submit" class="btn btn-primary btn-block">Register</button></div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/auth-footer.php'; ?>