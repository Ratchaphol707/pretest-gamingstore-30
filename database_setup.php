<?php
define('SETUP_MODE', true);
require_once 'db.php';

try {
    // Ensure database exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS gamingstore");
    $pdo->exec("USE gamingstore");

    // Create products table
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        type ENUM('keyboard', 'chair') NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        image VARCHAR(255),
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    echo "Database and table 'products' setup successfully.";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
