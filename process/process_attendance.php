<?php
// process/process_attendance.php
session_start();
require_once "../config/Database.php";
require_once "../classes/Student.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/student_dashboard.php");
    exit;
}

$status = $_POST['status'] ?? 'Present';

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);

$student->markAttendance($_SESSION['student_id'], $status);

header("Location: ../views/student_dashboard.php");
exit;
?>
