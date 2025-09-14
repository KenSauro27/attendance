<?php
// index.php - Entry point
session_start();

// Redirect if already logged in
if (isset($_SESSION['student_id'])) {
    header("Location: views/student_dashboard.php");
    exit;
}
if (isset($_SESSION['admin_id'])) {
    header("Location: views/admin_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Attendance System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
  <div class="text-center">
    <h1 class="mb-4">📚 Attendance System</h1>
    <p class="mb-4">Welcome! Please login or register to continue.</p>
    <a href="views/login.php" class="btn btn-primary btn-lg">Login</a>
    <a href="views/register_student.php" class="btn btn-success btn-lg">Register as Student</a>
    <a href="views/register_admin.php" class="btn btn-secondary btn-lg">Register as Admin</a>
  </div>
</body>
</html>
