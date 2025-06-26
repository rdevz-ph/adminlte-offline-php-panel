<?php
session_start();

$host = 'localhost';
$db = 'auth_demo';
$user = 'root'; // or your DB user
$pass = '';     // or your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
