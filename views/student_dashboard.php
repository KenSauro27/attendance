<?php
session_start();
require_once "../config/Database.php";
require_once "../classes/Student.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);
$history = $student->getHistory($_SESSION['student_id']);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Welcome Student</h2>

  <form method="POST" action="../process/process_attendance.php" class="mb-3">
    <select name="status" class="form-select w-25 d-inline">
      <option value="Present">Present</option>
      <option value="Late">Late</option>
    </select>
    <button type="submit" class="btn btn-success">Mark Attendance</button>
  </form>

  <h3>Your Attendance History</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Date</th>
        <th>Time In</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($history as $row): ?>
      <tr>
        <td><?= $row['date'] ?></td>
        <td><?= $row['time_in'] ?></td>
        <td><?= $row['status'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="../process/logout.php" class="btn btn-secondary">Logout</a>
</body>
</html>
