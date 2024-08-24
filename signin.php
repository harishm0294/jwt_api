<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

$secretKey = 'your-secret-key';
$refreshSecretKey = 'your-refresh-secret-key';

try {
    $db = new PDO('mysql:host=db;dbname=jwt_api', 'root', 'rootpassword');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        
        //Check for Valid Email
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if (!preg_match($pattern, $email)) {
            echo json_encode(['status'=>false, 'message' => 'Please Enter Valid Email Address']);
            return false;
        }

        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $accessToken = JWT::encode([
                'userId' => $user['id'],
                'exp' => time() + 30 //30 sec
            ], $secretKey, 'HS256');

            $refreshToken = JWT::encode([
                'userId' => $user['id'],
                'exp' => time() + 604800 // 1 week expiration
            ], $refreshSecretKey, 'HS256');

            $stmt = $db->prepare("UPDATE users SET refresh_token = ? WHERE id = ?");
            $stmt->execute([$refreshToken, $user['id']]);

            echo json_encode([
                'accessToken' => $accessToken,
                'refreshToken' => $refreshToken
            ]);
        } else {
            echo json_encode(['error' => 'Invalid email or password']);
        }
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
