<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name        = $_POST['product_name'];
    $desc        = $_POST['description'];
    $price       = $_POST['price'];
    $stock       = $_POST['stock'];

    $category_id = $_POST['category_id'] ?? 0;
$category_id = (int)$category_id;

if ($category_id <= 0) {

    die("Invalid category selected");

}



    if (!isset($_FILES['product_image']) || $_FILES['product_image']['error'] !== 0) {
        die("Image upload failed");
    }

    // ✅ CORRECT upload path
    $uploadDir = __DIR__ . '/../../images/';
    $imageName = time() . '_' . basename($_FILES['product_image']['name']);

    // ✅ MOVE ONCE — this is the ONLY move
    if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadDir . $imageName)) {
        die("Image upload error");
    }

    // ✅ DB insert uses SAME filename
    $sql = "INSERT INTO products 
            (name, price, description, image, stock, category_id)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $name,
        $price,
        $desc,
        $imageName,
        $stock,
        $category_id
    ]);

    echo "Product added successfully";

    
}
?>
