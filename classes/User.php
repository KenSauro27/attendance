<?php
class User {
    protected $conn;
    public function __construct($db) {
        $this->conn = $db;
    }
}
?>
