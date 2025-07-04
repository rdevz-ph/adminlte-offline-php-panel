<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $system_name ?: 'Admin Panel' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="manifest" href="../manifest.json">
    <meta name="theme-color" content="#0d6efd">
    <link rel="apple-touch-icon" href="../assets/icons/icon-192.png">

    <style>
        .main-sidebar {
            background-color: #0f2a60 !important;
            /* Dark blue sidebar */
        }

        .main-sidebar .nav-link {
            color: #e4e7f2 !important;
            /* Lighter text for items */
        }

        .main-sidebar .nav-link.active {
            background-color: #375a9e !important;
            /* Active item background */
            color: #ffffff !important;
            /* Active item text color */
            border-radius: 0.5rem;
            /* Optional: rounded highlight */
        }

        .main-sidebar .nav-icon {
            color: #d5d9ed !important;
        }

        .main-sidebar .nav-link.active .nav-icon {
            color: #ffffff !important;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link"><?= $system_name ?: 'Admin Panel' ?> - Admin Panel</a>
                </li>
            </ul>

            <!-- 🔻 Right navbar: User dropdown -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
                        <img src="../<?= $profile_img ?>" alt="Profile" class="img-circle elevation-1"
                            style="height: 30px; width: 30px; object-fit: cover;">
                        <span class="ml-2"><?= $_SESSION['user']['name'] ?? 'User' ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item disabled">
                            <i class="fas fa-key mr-2"></i> <?= $_SESSION['user']['username'] ?? '' ?>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../logout.php" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
            <!-- 🔺 End user dropdown -->
        </nav>