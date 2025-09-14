<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5 bg-light">
  <div class="container">
    <h1 class="mb-4">👨‍💼 Admin Dashboard</h1>
    <a href="../process/logout.php" class="btn btn-danger mb-4">Logout</a>

    <h3>Add Course</h3>
    <form action="../process/process_course.php" method="POST" class="mb-5">
      <input type="text" name="course_name" placeholder="Course Name" class="form-control mb-2" required>
      <button type="submit" class="btn btn-primary">Add Course</button>
    </form>

    <h3>View Attendance</h3>
    <form action="../process/view_attendance.php" method="POST">
      <div class="row">
        <div class="col-md-6 mb-2">
          <label>Course ID</label>
          <input type="number" name="course_id" class="form-control" required>
        </div>
        <div class="col-md-6 mb-2">
          <label>Year Level</label>
          <input type="number" name="year_level" class="form-control" required>
        </div>
      </div>
      <button type="submit" class="btn btn-success">View Attendance</button>
    </form>
  </div>
</body>
</html>
