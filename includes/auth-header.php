<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $system_name ?: 'Admin Panel' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

    <link rel="manifest" href="../manifest.json">
    <meta name="theme-color" content="#0d6efd">
    <link rel="apple-touch-icon" href="../assets/icons/icon-192.png">

    <style>
        body.login-page {
            background: url("../<?= $system_cover ?>") no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>

<body class="hold-transition login-page">