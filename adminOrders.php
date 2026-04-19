<?php
require_once __DIR__ . '/php/admin/db.php';

// // Admin check
// if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
//     header("Location: php/admin/log.php");
//     exit;
// }

// Stats
$totalProducts   = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalOrders     = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$totalUsers      = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalCategories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();

// Recent Orders
$recentOrders = $pdo->query("
    SELECT orders.*, products.name AS product_name 
    FROM orders 
    LEFT JOIN products ON orders.product_id = products.id 
    ORDER BY orders.created_at DESC 
    LIMIT 5
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background: #f4f6f9; margin: 0; }
    .sidebar {
      width: 240px; min-height: 100vh;
      background: #2c3e50; position: fixed;
      top: 0; left: 0; padding-top: 20px;
      z-index: 100;
    }
    .sidebar h4 { color: #fff; text-align: center; padding: 10px 0 20px; border-bottom: 1px solid #3d5166; }
    .sidebar a { display: block; color: #bdc3c7; padding: 12px 20px; text-decoration: none; transition: 0.2s; }
    .sidebar a:hover, .sidebar a.active { background: #3d5166; color: #fff; }
    .sidebar a i { margin-right: 10px; }
    .main { margin-left: 240px; padding: 30px; }
    .stat-card { border-radius: 10px; padding: 20px; color: #fff; margin-bottom: 20px; }
    .stat-card h3 { font-size: 2rem; font-weight: bold; margin: 5px 0; }
    .topbar { background: #fff; padding: 15px 25px; border-radius: 10px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    .logout-btn { position: absolute; bottom: 20px; width: 100%; }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4><i class="fa-solid fa-bolt"></i> Electro Admin</h4>
  <a href="/electro-Template/dashboards.php" class="active"><i class="fa-solid fa-gauge"></i> Dashboard</a>
  <a href="/electro-Template/php/admin/products.php"><i class="fa-solid fa-box"></i> Products</a>
  <a href="/electro-Template/php/admin/orders.php"><i class="fa-solid fa-cart-shopping"></i> Orders</a>
  <a href="/electro-Template/php/admin/users.php"><i class="fa-solid fa-users"></i> Users</a>
  <a href="/electro-Template/php/admin/categories.php"><i class="fa-solid fa-tags"></i> Categories</a>
  <a href="/electro-Template/index2.php"><i class="fa-solid fa-store"></i> View Store</a>
  <a href="/electro-Template/php/log.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<!-- Main -->
<div class="main">

  <!-- Topbar -->
  <div class="topbar">
    <h5 class="mb-0">Dashboard</h5>
    <span>Welcome, <strong>Admin</strong></span>
  </div>

  <!-- Stat Cards -->
  <div class="row">
    <div class="col-md-3">
      <div class="stat-card" style="background:#3498db;">
        <p>Total Products</p>
        <h3><?= $totalProducts ?></h3>
        <i class="fa-solid fa-box fa-2x"></i>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card" style="background:#e74c3c;">
        <p>Total Orders</p>
        <h3><?= $totalOrders ?></h3>
        <i class="fa-solid fa-cart-shopping fa-2x"></i>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card" style="background:#2ecc71;">
        <p>Total Users</p>
        <h3><?= $totalUsers ?></h3>
        <i class="fa-solid fa-users fa-2x"></i>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card" style="background:#f39c12;">
        <p>Categories</p>
        <h3><?= $totalCategories ?></h3>
        <i class="fa-solid fa-tags fa-2x"></i>
      </div>
    </div>
  </div>

  <!-- Recent Orders Table -->
  <div class="card mt-2">
    <div class="card-header"><b>Recent Orders</b></div>
    <div class="card-body p-0">
      <table class="table table-hover mb-0">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Product</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(empty($recentOrders)): ?>
            <tr><td colspan="8" class="text-center py-3">No orders yet</td></tr>
          <?php else: ?>
          <?php foreach($recentOrders as $order): ?>
          <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['product_name'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($order['Name']) ?></td>
            <td><?= htmlspecialchars($order['Phone']) ?></td>
            <td><?= htmlspecialchars($order['Address']) ?></td>
            <td>
              <span class="badge bg-<?= $order['status'] == 'completed' ? 'success' : ($order['status'] == 'cancelled' ? 'danger' : 'warning') ?>">
                <?= $order['status'] ?>
              </span>
            </td>
            <td><?= date('d M Y', strtotime($order['created_at'])) ?></td>
            <td>
              <a href="/electro-Template/php/admin/orders.php" class="btn btn-sm btn-primary">Manage</a>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>