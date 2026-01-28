<?php
require_once 'db.php';

function getAllProducts($pdo, $filter = 'all') {
    $sql = "SELECT * FROM products";
    if ($filter === 'keyboard') {
        $sql .= " WHERE type = 'keyboard'";
    } elseif ($filter === 'chair') {
        $sql .= " WHERE type = 'chair'";
    }
    $sql .= " ORDER BY created_at DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProductById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createProduct($pdo, $name, $type, $price, $image, $description) {
    $sql = "INSERT INTO products (name, type, price, image, description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$name, $type, $price, $image, $description]);
}

function updateProduct($pdo, $id, $name, $type, $price, $image, $description) {
    $sql = "UPDATE products SET name = ?, type = ?, price = ?, image = ?, description = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$name, $type, $price, $image, $description, $id]);
}

function deleteProduct($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    return $stmt->execute([$id]);
}
?>
