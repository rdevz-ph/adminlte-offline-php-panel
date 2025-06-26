<?php
include_once '../../config.php';

$action = $_GET['action'] ?? null;

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user_type = $_POST['user_type'];

    // Check for duplicate username
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $exists = $stmt->fetchColumn();

    if ($exists > 0) {
        // Redirect back with error
        header("Location: ../index.php?page=users&error=Username+already+exists");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO users (name, username, password, user_type) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $username, $password, $user_type]);

    header("Location: ../index.php?page=users&success=User+created");
    exit;
}

if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET name=?, username=?, user_type=?, password=? WHERE id=?");
        $stmt->execute([$name, $username, $user_type, $hashed, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET name=?, username=?, user_type=? WHERE id=?");
        $stmt->execute([$name, $username, $user_type, $id]);
    }

    header("Location: ../index.php?page=users&success=User+updated");
    exit;
}

if ($action === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
    $stmt->execute([$id]);
    header("Location: ../index.php?page=users&success=User+deleted");
    exit;
}
