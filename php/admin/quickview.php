<?php
// session_start();

include 'Cart_summary.php';

// require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/db.php';

// GET id
$id = $_GET['id'] ?? null;

if (!$id) {
    die('Invalid product');
}

// fetch product
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die('Product not found');
}

?>








<style>
.buy-btn {
  display: inline-block;
  padding: 12px 20px;
  background: #ff6a00;
  color: #fff;
  text-decoration: none;
  border-radius: 6px;
  font-weight: bold;
  transition: 0.3s;
}

.buy-btn:hover {
  background: #e55d00;
}

.hidden{
  display: none;

}
</style>

<h2>Product Name<?= htmlspecialchars($product['name']) ?></h2>
<img src="/electro-Template/images/<?= htmlspecialchars($product['image']) ?>" width="200">

<p>Price: $<?= $product['price'] ?></p>
<h1>description</h1>
<p><?= htmlspecialchars($product['description'] ?? '') ?></p>

<div class="quickview-cart" data-id="<?= $product['id'] ?>">

  <button class="minus">−</button>

  <span id="qty-<?= $product['id'] ?>">
    <?= $_SESSION['cart'][$product['id']] ?? 0 ?>
  </span>

  <button class="plus">+</button>

<!-- <button class="buy-btn" data-id="82" data-type="buy">Buy Now</button> -->
 <button class="buy-btn" data-id="<?= $product['id'] ?>" data-type="buy">Buy Now</button>



</div>

<p>Total items: <?= $totalItems ?></p>
<p>Subtotal: $<?= $subtotal ?></p>
<p>Grand Total: $<?= $grandTotal ?></p>



<script>
document.addEventListener("click", function (e) {

  // check + button
  if (e.target.classList.contains("plus") || e.target.classList.contains("minus")) {

    console.log("✅ Plus/Minus clicked");

  
    const wrapper = e.target.closest(".quickview-cart");
    console.log("📦 wrapper:", wrapper);

    if (!wrapper) {
      console.log("❌ .quickview-cart not found");
      return;
    }

    const id = wrapper.dataset.id;
    console.log("🆔 product id:", id);

    const type = e.target.classList.contains("plus") ? "plus" : "minus";
    console.log("⚙️ type:", type);

    fetch("/electro-Template/php/admin/qty2.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: `id=${encodeURIComponent(id)}&type=${type}`
    })
    .then(res => res.json())
    .then(data => {
      console.log("📥 response:", data);

      if (data.success) {
        const qtyEl = document.getElementById("qty-" + id);

        if (qtyEl) {
          qtyEl.textContent = data.qty;
        }
      }
    })
    .catch(err => console.log("🔥 error:", err));
  }
    
});

</script>

<form action="" class="hidden" method="POST">
  
    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">

    <input type="text" name="Name" placeholder="Full Name" required>
    <input type="text" name="Phone" placeholder="Phone" required>
    <input type="text" name="Address" placeholder="Address" required>

    <button type="submit" class="submit">Place Order</button>

</form>


<script>
const btn = document.querySelector(".buy-btn");
const form = document.querySelector(".hidden");
const submit =  document.querySelector(".submit");
const product_id = btn.dataset.id;
// const id = btn.dataset.product_id;    
const type = btn.dataset.type;


console.log(product_id);
console.log(type);


btn.addEventListener('click', function () {

    form.style.display = "block";
    

    fetch("/electro-Template/php/admin/checkout.php", {

        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },

        body: `id=${encodeURIComponent(product_id)}&type=${encodeURIComponent(type)}`
    })

    .then(res => res.json())
    .then(data => {
        console.log("Response", data);
    });

});



form.addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(form);

    // DEBUG
    for (let pair of formData.entries()) {
        console.log(pair[0] + ": " + pair[1]);
    }

    fetch("/electro-Template/php/admin/checkout.php", {
        method: "POST",
        body: new URLSearchParams(formData)
    })
    .then(res => res.json())
    .then(data => {
        console.log("Order placed:", data);

        if(data.success) {
            alert("Order placed successfully!");
            form.style.display = "none";
            form.reset();
        } else {
            alert("Error: " + data.message);
        }
    });
});

</script>