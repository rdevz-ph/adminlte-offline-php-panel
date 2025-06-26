<?php
session_start();

if (isset($_SESSION['user'])) {
  // If already logged in, go to the dashboard
  header("Location: dashboard/index.php");
  exit;
} else {
  // Not logged in, redirect to login page
  header("Location: auth/login.php");
  exit;
}
