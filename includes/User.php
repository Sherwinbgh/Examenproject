<?php
require_once 'db.php';

class User {

    public static function register($username, $password) {
        $conn = DB::getInstance();
        $hashedPassword = hash('sha256', $password);
        
        $stmt = $conn->prepare("INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashedPassword, 2]);
    }

    public static function login($username, $password) {
        $conn = DB::getInstance();
        $hashedPassword = hash('sha256', $password);
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, $hashedPassword]);
        
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }
}
?>
