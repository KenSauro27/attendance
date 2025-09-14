<?php
// process/process_register_student.php
require_once "../config/Database.php";
require_once "../classes/Student.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/register_student.php");
    exit;
}

$name = trim($_POST['name'] ?? '');
$course_id = $_POST['course_id'] ?? '';
$year_level = $_POST['year_level'] ?? '';
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '' || $course_id === '' || $year_level === '' || $email === '' || $password === '') {
    echo "⚠️ All fields are required. <a href='../views/register_student.php'>Go back</a>";
    exit;
}

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);

try {
    $success = $student->register($name, $course_id, $year_level, $email, $password);
    if ($success) {
        echo "✅ Student registered successfully. <a href='../views/login.php'>Login</a>";
    } else {
        echo "❌ Registration failed. <a href='../views/register_student.php'>Try again</a>";
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo "⚠️ Email already exists. <a href='../views/register_student.php'>Use another</a>";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>
