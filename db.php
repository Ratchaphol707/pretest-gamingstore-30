<?php
$host = 'stock_db_30';
$db   = 'gamingstore';
$user = 'root';
$pass = 'rootpassword';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // If connection fails, try to connect without dbname to check if server is up
    try {
        $dsn_no_db = "mysql:host=$host;charset=$charset";
        $pdo = new PDO($dsn_no_db, $user, $pass, $options);
        
        // If we are NOT in setup mode, we strictly need the database.
        if (!defined('SETUP_MODE')) {
             die("Database '$db' not found or connection failed. <br>Please <a href='database_setup.php'>Run Setup</a> to initialize the system.");
        }

    } catch (\PDOException $e2) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
?>
