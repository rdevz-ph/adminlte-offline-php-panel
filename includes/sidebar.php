<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link d-flex align-items-center">
        <?php if ($system_logo): ?>
            <img src="../<?= $system_logo ?>" alt="Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8; max-height: 35px;">
        <?php endif; ?>
        <span class="brand-text font-weight-light ml-2"><?= $system_name ?: 'Admin Panel' ?></span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="index.php?page=home"
                        class="nav-link <?= ($_GET['page'] ?? 'home') === 'home' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if ($_SESSION['user']['user_type'] === 'admin'): ?> <!-- Only show these links for admin users -->
                    <li class="nav-item">
                        <a href="index.php?page=users"
                            class="nav-link <?= ($_GET['page'] ?? '') === 'users' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="?page=profile" class="nav-link <?= ($_GET['page'] ?? '') === 'profile' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>My Profile</p>
                    </a>
                </li>

                <?php if ($_SESSION['user']['user_type'] === 'admin'): ?> <!-- Only show these links for admin users -->
                    <li class="nav-item">
                        <a href="index.php?page=settings"
                            class="nav-link <?= ($_GET['page'] ?? '') === 'settings' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>System Settings</p>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- Add more links here -->
            </ul>
        </nav>
    </div>
</aside>