<?php
$servername = "db"; // This should match the service name in docker-compose.yml
$username = "root";
$password = "rootpassword";
$database = "jwt_api";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "DROP TABLE IF EXISTS `users`; CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `refresh_token` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=2;
";

if ($conn->query($query)) {
    echo '<br/>exe successfully';
}

$conn->close();

?>
