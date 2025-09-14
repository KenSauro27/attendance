
<?php
// process/process_register_admin.php
require_once "../config/Database.php";
require_once "../classes/Admin.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/register_admin.php");
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '' || $email === '' || $password === '') {
    echo "⚠️ All fields are required. <a href='../views/register_admin.php'>Go back</a>";
    exit;
}

$db = new Database();
$conn = $db->connect();
$admin = new Admin($conn);

try {
    $success = $admin->register($name, $email, $password);
    if ($success) {
        echo "✅ Admin registered successfully. <a href='../views/login.php'>Login</a>";
    } else {
        echo "❌ Registration failed. <a href='../views/register_admin.php'>Try again</a>";
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo "⚠️ Email already exists. <a href='../views/register_admin.php'>Use another</a>";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>
