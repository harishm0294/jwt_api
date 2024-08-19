<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

$key = "your-secret-key";
$jwt = $_GET['token'];

try {
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    echo "Token is valid. User ID: " . $decoded->userId;
} catch (ExpiredException $e) {
    echo "Token has expired.";
} catch (Exception $e) {
    echo "Token is invalid.";
}
?>