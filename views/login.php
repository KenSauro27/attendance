<?php
session_start();
if (isset($_SESSION['student_id'])) {
    header("Location: student_dashboard.php");
    exit;
}
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Login</h2>
  <form method="POST" action="../process/process_login.php" class="w-50">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-select" required>
        <option value="student">Student</option>
        <option value="admin">Admin</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
  <hr>
  <p>
    Not registered? <a href="register_student.php">Register as Student</a> |
    <a href="register_admin.php">Register as Admin</a>
  </p>
</body>
</html>
