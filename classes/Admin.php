<?php
// classes/Admin.php
class Admin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new admin
    public function register($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    // Add a new course
    public function addCourse($courseName) {
        $sql = "INSERT INTO courses (course_name) VALUES (:course_name)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':course_name' => $courseName]);
    }
}
