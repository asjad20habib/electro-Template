<?php
 include 'db.php';
// session_start();

echo '<pre>';
print_r($_SESSION['cart'] ?? 'Cart empty');
echo '</pre>';


?>
