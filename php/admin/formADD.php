<?php

include 'category.php';
var_dump($cat);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="add.php" method="POST" enctype="multipart/form-data">

    <label>Product Name</label><br>
    <input type="text" name="product_name" required>
    <br><br>

    <label>Price</label><br>
    <input type="number" name="price" required>
    <br><br>

    <label>Stock Quantity</label><br>
    <input type="number" name="stock" required>
    <br><br>

    <label>Category</label><br>
            <select name="category_id" required>
    <option value="">Select Category</option>

    <?php foreach ($cat as $c): ?>
        <option value="<?= htmlspecialchars($c['id']); ?>">
            <?= htmlspecialchars($c['name']); ?>
        </option>
    <?php endforeach; ?>

</select>

    <br><br>

    <label>Product Image</label><br>
    <input type="file" name="product_image" accept="image/*" required>
    <br><br>

    <label>Description</label><br>
    <textarea name="description" rows="4" cols="40"></textarea>
    <br><br>

    <button type="submit" name="add_product">Add Product</button>

</form>

</body>
</html>
