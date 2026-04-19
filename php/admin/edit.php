<?php
include 'db.php';

// ----------- UPDATE PRODUCT -----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = (int) $_POST['product_id'];
    $name        = $_POST['name'] ?? '';
    $price       = $_POST['price'] ?? 0;
    $stock       = $_POST['stock'] ?? 0;
    $category    = $_POST['category'] ?? '';
    $description = $_POST['description'] ?? '';
    $imageName   = null;

    if (!empty($_FILES['product_image']['name'])) {
        $imageName = $_FILES['product_image']['name'];
        move_uploaded_file($_FILES['product_image']['tmp_name'], "../../images/" . $imageName);
    }

    $sql = "UPDATE products SET name=?, price=?, stock=?, category=?, description=?";
    $params = [$name, $price, $stock, $category, $description];

    if ($imageName) {
        $sql .= ", product_image=?";
        $params[] = $imageName;
    }

    $sql .= " WHERE id=?";
    $params[] = $id;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    echo "Updated successfully";
    exit;
}

// ----------- FETCH PRODUCT -----------
if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id'])) {
    die("Invalid product id");
}

$id = (int) $_GET['product_id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) die("Product not found");
?>

<!-- ----------- SIMPLE FORM ----------- -->
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" placeholder="Name"><br>
    <input type="number" name="price" value="<?= $product['price'] ?>" placeholder="Price"><br>
    <input type="number" name="stock" value="<?= $product['stock'] ?>" placeholder="Stock"><br>
    <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" placeholder="Category"><br>

    <?php if (!empty($product['product_image'])): ?>
        <img src="/electro-Template/images/<?= $product['product_image'] ?>" width="80"><br>
    <?php endif; ?>
    <input type="file" name="product_image"><br>

    <input type="text" name="description" value="<?= htmlspecialchars($product['description']) ?>" placeholder="Description"><br><br>

    <button type="submit">Update</button>
</form>
