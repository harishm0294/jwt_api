<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

$secretKey = 'your-secret-key';

function isMediumStrengthPassword($password) {
    $lengthCheck = strlen($password) >= 8;
    $letterAndNumberCheck = preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password);
    $specialCharacterCheck = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);

    return $lengthCheck && $letterAndNumberCheck && $specialCharacterCheck;
}

try {
    $db = new PDO('mysql:host=localhost;dbname=jwt_api', 'root', 'root');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = $_POST['email'];
        
        //Check for Valid Email
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if (!preg_match($pattern, $email)) {
            echo json_encode(['status'=>false, 'message' => 'Please Enter Valid Email Address']);
            return false;
        }

        //Already Email Exists check
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user) {
            echo json_encode(['status'=>false, 'message' => 'Email is already registered with us']);
            return false;
        }

        $password = $_POST['password'];
        
        //Password Stength check
        if (!isMediumStrengthPassword($password)) {
            echo json_encode(['status'=>false, 'message' => 'Password must have Minimum 8 characters in length, At least one letter and one number, At least one special character']);
            return false;
        }

        $password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $password]);

        echo json_encode(['status'=>true, 'message' => 'User registered successfully']);
    }
} catch (PDOException $e) {
    echo json_encode(['status'=>true, 'message' => $e->getMessage()]);
}
?>