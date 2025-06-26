<?php
$page = $_GET['page'] ?? 'home';

$titleMap = [
    'home' => 'Dashboard',
    'users' => 'User Management',
    'settings' => 'Settings',
    'reports' => 'Reports',
    'profile' => 'My Profile',
    // add more as needed
];

// fallback if page not in map
$title = $titleMap[$page] ?? 'Page Not Found';

include '../includes/layout.php';
