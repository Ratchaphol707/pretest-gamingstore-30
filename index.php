<?php
require_once 'db.php';
require_once 'functions.php';

$filter = $_GET['filter'] ?? 'all';
$products = getAllProducts($pdo, $filter);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming Store Inventory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>GAMING STORE</h1>
            <a href="create.php" class="btn">Add New Item</a>
        </header>

        <div class="filters">
            <a href="?filter=all" class="btn filter-btn <?= $filter === 'all' ? 'active' : '' ?>">All</a>
            <a href="?filter=keyboard" class="btn filter-btn <?= $filter === 'keyboard' ? 'active' : '' ?>">Keyboards</a>
            <a href="?filter=chair" class="btn filter-btn <?= $filter === 'chair' ? 'active' : '' ?>">Chairs</a>
        </div>

        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <?php if ($product['image']): ?>
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">
                    <?php else: ?>
                        <div class="product-image" style="display:flex;align-items:center;justify-content:center;color:#444;">
                            No Image
                        </div>
                    <?php endif; ?>
                    
                    <div class="product-info">
                        <div class="product-type"><?= htmlspecialchars($product['type']) ?></div>
                        <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
                        <div class="product-price">$<?= number_format($product['price'], 2) ?></div>
                        <p class="product-desc"><?= htmlspecialchars($product['description']) ?></p>
                        
                        <div class="product-actions">
                            <a href="edit.php?id=<?= $product['id'] ?>" class="btn">Edit</a>
                            <a href="delete.php?id=<?= $product['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>