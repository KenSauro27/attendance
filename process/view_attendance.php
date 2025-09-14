<?php
session_start();
require_once "../config/Database.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/admin_dashboard.php");
    exit;
}

$course_id = $_POST['course_id'] ?? '';
$year_level = $_POST['year_level'] ?? '';

$db = new Database();
$conn = $db->connect();

try {
    $stmt = $conn->prepare("
        SELECT s.name, s.email, a.date, a.time_in, a.status
        FROM attendance a
        INNER JOIN students s ON a.student_id = s.id
        WHERE s.course_id = :course_id AND s.year_level = :year_level
        ORDER BY a.date DESC, a.time_in DESC
    ");
    $stmt->execute([
        ':course_id' => $course_id,
        ':year_level' => $year_level
    ]);

    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Attendance</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5 bg-light">
  <div class="container">
    <h2>Attendance Records</h2>
    <a href="../views/admin_dashboard.php" class="btn btn-secondary mb-3">⬅ Back</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Email</th>
          <th>Date</th>
          <th>Time In</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($records): ?>
          <?php foreach ($records as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['date']) ?></td>
              <td><?= htmlspecialchars($row['time_in']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center">No attendance records found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
