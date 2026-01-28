<?php
require_once 'db.php';
require_once 'functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$product = getProductById($pdo, $id);
if (!$product) {
    echo "Product not found.";
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    if (updateProduct($pdo, $id, $name, $type, $price, $image, $description)) {
        header('Location: index.php');
        exit;
    } else {
        $message = "Error updating product.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Gaming Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Edit Product</h1>
            <a href="index.php" class="btn">Back to Home</a>
        </header>

        <div class="product-card" style="padding: 2rem; max-width: 600px; margin: 0 auto;">
            <?php if ($message): ?>
                <p style="color: var(--danger-color)"><?= $message ?></p>
            <?php endif; ?>

            <form action="edit.php?id=<?= $product['id'] ?>" method="POST">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" name="type" required>
                        <option value="keyboard" <?= $product['type'] == 'keyboard' ? 'selected' : '' ?>>Keyboard</option>
                        <option value="chair" <?= $product['type'] == 'chair' ? 'selected' : '' ?>>Gaming Chair</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" id="image" name="image" value="<?= htmlspecialchars($product['image']) ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <button type="submit" class="btn" style="width: 100%">Update Product</button>
            </form>
        </div>
    </div>
</body>
</html>
