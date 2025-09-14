<?php
// process/process_course.php
session_start();
require_once "../config/Database.php";
require_once "../classes/Admin.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/admin_dashboard.php");
    exit;
}

$course_name = trim($_POST['course_name'] ?? '');

if ($course_name === '') {
    echo "⚠️ Course name cannot be empty. <a href='../views/admin_dashboard.php'>Go back</a>";
    exit;
}

$db = new Database();
$conn = $db->connect();
$admin = new Admin($conn);

$admin->addCourse($course_name);

header("Location: ../views/admin_dashboard.php");
exit;
?>
