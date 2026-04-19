<?php
include 'db.php';

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "Cart empty";
    exit;
}

foreach ($cart as $product_id => $qty) {

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) continue;
    ?>

    <div style="border:1px solid #ccc; margin:10px; padding:10px">
        <h3><?= htmlspecialchars($product['name']) ?></h3>
        <p>Price: <?= $product['price'] ?></p>
        <p>Qty: <?= $qty ?></p>

        <a href="/electro-Template/php/admin/qty.php?id=<?= $product_id ?>&type=plus">+</a>
<a href="/electro-Template/php/admin/qty.php?id=<?= $product_id ?>&type=minus">-</a>
<!-- <a href="/electro-Template/php/admin/qty.php?id=<?= $product_id ?>&type=remove">Remove</a> -->


    </div>

<?php } ?>
