const cartIcon = document.getElementById("cartIcon");
const miniCart = document.getElementById("miniCart");

let isHoveringCart = false;

// show cart
cartIcon.addEventListener("mouseenter", () => {
  isHoveringCart = true;
  loadMiniCart();
});

// hide cart
cartIcon.addEventListener("mouseleave", () => {
  isHoveringCart = false;
  setTimeout(() => {
    if (!isHoveringCart) {
      miniCart.style.display = "none";
    }
  }, 200);
});

function loadMiniCart() {
  fetch("/electro-Template/php/admin/mini_cart.php")
    .then(res => res.json())
    .then(data => {

      // safety check
      if (!data.items || data.items.length === 0) {
        miniCart.innerHTML = "<p>Your cart is empty</p>";
      } else {
        miniCart.innerHTML = data.items.map(item => `
          <div class="mini-item">
            <img src="/electro-Template/images/${item.image}" width="40">
            <span>${item.name}</span>
            <strong>${item.qty} × $${item.price}</strong>
            <button data-id="${item.id}" class="remove-btn">×</button>
          </div>
        `).join("");

        miniCart.innerHTML += `<hr><strong>Subtotal: $${data.subtotal}</strong>`;
      }

      miniCart.style.display = "block";

      // attach remove events properly
      document.querySelectorAll(".remove-btn").forEach(btn => {
        btn.addEventListener("click", () => {
          removeItem(btn.dataset.id);
        });
      });

    })
    .catch(err => {
      console.error("Mini cart error:", err);
    });
}

function removeItem(id) {
  fetch("/electro-Template/php/admin/CartRemove.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `id=${id}`
  })
  .then(() => loadMiniCart());
}
