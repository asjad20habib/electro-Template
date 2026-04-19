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

    fetch("/electro-Template/php/admin/quickview.php", {
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
    .catch(err => console.error("🔥 error:", err));
  }

});