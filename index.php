<?php
try{
    $db = new PDO('mysql:host=db;dbname=jwt_api', 'root', 'rootpassword');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $createTableQuery = "DROP TABLE IF EXISTS `users`; CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `refresh_token` text DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=2;";
    $db->exec($createTableQuery);

/*     $stmt = $db->query('SELECT COUNT(*) FROM users');
    $rowCount = $stmt->fetchColumn();

    echo "Number of users: " . $rowCount; */
    echo json_encode(['status'=>true, 'message' => 'server started and users table created successfully']);
} catch (PDOException $e) {
    echo json_encode(['status'=>true, 'message' => $e->getMessage()]);
}
?>
