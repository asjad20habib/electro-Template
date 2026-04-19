

//   document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
//   btn.addEventListener('click', function(e){
//     e.preventDefault();
//     const productId = this.dataset.id;

//     fetch('cart.php', {
//       method: 'POST',
//       body: new URLSearchParams({ id: productId })
//     })
//     .then(res => res.json())
//     .then(data => {
//       alert(data.message); // shows "Product added to cart"
//       console.log(data.cart); // current cart contents
//     });
//   });
// });

