<?php

include '../../config.php';

$id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $profile_img = $_SESSION['user']['profile_img'] ?? null;

    // Upload profile image if provided
    if (!empty($_FILES['profile_img']['tmp_name'])) {
        $ext = pathinfo($_FILES['profile_img']['name'], PATHINFO_EXTENSION);
        $path = 'uploads/profile_' . $id . '.' . $ext;
        move_uploaded_file($_FILES['profile_img']['tmp_name'], __DIR__ . '/../../' . $path);
        $profile_img = $path;
    }

    // Update the user
    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET name=?, username=?, password=?, profile_img=? WHERE id=?");
        $stmt->execute([$name, $username, $hashed, $profile_img, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET name=?, username=?, profile_img=? WHERE id=?");
        $stmt->execute([$name, $username, $profile_img, $id]);
    }

    // Refresh session
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['username'] = $username;
    $_SESSION['user']['profile_img'] = $profile_img;

    // Redirect safely
    header("Location: ../index.php?page=profile&success=Profile+updated+successfully!");
    exit;
}
?>