<?php
require_once "User.php";

class Student extends User {
    public function register($name, $course_id, $year_level, $email, $password) {
        $query = "INSERT INTO students (name, course_id, year_level, email, password)
                  VALUES (:name, :course_id, :year_level, :email, :password)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':name' => $name,
            ':course_id' => $course_id,
            ':year_level' => $year_level,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
    }

    public function markAttendance($student_id, $status) {
        $query = "INSERT INTO attendance (student_id, date, time_in, status)
                  VALUES (:student_id, CURDATE(), CURTIME(), :status)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':student_id' => $student_id, ':status' => $status]);
    }

    public function getHistory($student_id) {
        $query = "SELECT * FROM attendance WHERE student_id = :student_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':student_id' => $student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
