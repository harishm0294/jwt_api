<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secretKey = 'your-secret-key';
$refreshSecretKey = 'your-refresh-secret-key';

try {
    $db = new PDO('mysql:host=db;dbname=jwt_api', 'root', 'rootpassword');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $refreshToken = $_POST['refreshToken'];

        $decoded = JWT::decode($refreshToken, new Key($refreshSecretKey, 'HS256'));

        if ($decoded) {
            $stmt = $db->prepare("SELECT * FROM users WHERE id = ? AND refresh_token = ?");
            $stmt->execute([$decoded->userId, $refreshToken]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $newAccessToken = JWT::encode([
                    'userId' => $user['id'],
                    'exp' => time() + 3600 // 1 hour expiration
                ], $secretKey, 'HS256');

                echo json_encode(['accessToken' => $newAccessToken]);
            } else {
                echo json_encode(['error' => 'Invalid refresh token']);
            }
        } else {
            echo json_encode(['error' => 'Invalid refresh token']);
        }
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Invalid token']);
}
