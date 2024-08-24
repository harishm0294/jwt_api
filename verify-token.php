<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

$key = "your-secret-key";
$jwt = $_GET['token'];

try {
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    echo json_encode(['status'=>true, 'message' => 'Token is valid. User ID: ' . $decoded->userId]);
} catch (ExpiredException $e) {
    echo json_encode(['status'=>true, 'message' => 'Token has expired. Please refresh the Token']);
} catch (Exception $e) {
    echo json_encode(['status'=>true, 'message' => 'Token is invalid.']);
}
?>