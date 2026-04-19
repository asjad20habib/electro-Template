<?php
include 'db.php';

if (isset($_POST['delete']) && isset($_POST['product_id'])) {

    $id = (int) $_POST['product_id'];

    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: dashboard.php");
    exit;
}
