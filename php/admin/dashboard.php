<?php
include 'db.php';

// fetch products
$stmt = $pdo->prepare("SELECT * FROM products ORDER BY id DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>My Products</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Category</th>
        <th>Image</th>
        <th>Action</th>
    </tr>

    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['name'] ?></td>
            <td><?= $p['price'] ?></td>
            <td><?= $p['stock'] ?></td>
            <td><?= $p['category_id'] ?></td>
            <td>
                <img src="/electro-Template/images/<?= $p['image'] ?>" width="80">
            </td>
            <td>
                <form action="delete.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>

                <form action="edit.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                    <button type="submit">Edit</button>
                </form>

                <a href="edit.php?product_id=<?= $p['id'] ?>">Edit</a>




            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
