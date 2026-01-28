<?php
require_once 'db.php';
require_once 'functions.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    if (createProduct($pdo, $name, $type, $price, $image, $description)) {
        header('Location: index.php');
        exit;
    } else {
        $message = "Error creating product.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Gaming Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Add New Product</h1>
            <a href="index.php" class="btn">Back to Home</a>
        </header>

        <div class="product-card" style="padding: 2rem; max-width: 600px; margin: 0 auto;">
            <?php if ($message): ?>
                <p style="color: var(--danger-color)"><?= $message ?></p>
            <?php endif; ?>

            <form action="create.php" method="POST">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" name="type" required>
                        <option value="keyboard">Keyboard</option>
                        <option value="chair">Gaming Chair</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" id="image" name="image" placeholder="https://example.com/image.jpg">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"></textarea>
                </div>

                <button type="submit" class="btn" style="width: 100%">Create Product</button>
            </form>
        </div>
    </div>
</body>
</html>
