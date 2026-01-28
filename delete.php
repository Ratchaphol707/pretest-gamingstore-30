<?php
require_once 'db.php';
require_once 'functions.php';

$id = $_GET['id'] ?? null;
if ($id) {
    deleteProduct($pdo, $id);
}

header('Location: index.php');
exit;
?>
