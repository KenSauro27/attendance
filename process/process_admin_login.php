<?php
// process/process_login_admin.php
session_start();
require_once "../config/Database.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/login.php");
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    echo "⚠️ Please fill in all fields. <a href='../views/login.php'>Go back</a>";
    exit;
}

$db = new Database();
$conn = $db->connect();

try {
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        header("Location: ../views/admin_dashboard.php");
        exit;
    } else {
        echo "❌ Invalid admin login. <a href='../views/login.php'>Try again</a>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
