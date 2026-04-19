<?php
include 'db.php';

$category_id = $_GET['id'] ?? null;

if (!$category_id) {
    echo "Please select a category.";
    exit; 
}

// 3️⃣ Prepare & execute query safely
$q = "SELECT * FROM products WHERE category_id = ?";
$stmt = $pdo->prepare($q);
$stmt->execute([$category_id]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($products)) {
    echo "No products found in this category.";
    exit;
}

echo "<pre>";
var_dump($products);
echo "</pre>";
?>
