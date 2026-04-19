<?php 

session_start(); // ✅ Fix 1: session_start() sabse upar hona chahiye

error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = "127.0.0.1";
$db   = "ecommerce";
$user = "root";
$pass = "";
$port = 3307;

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}

if (!isset($_SESSION['user_id'])) {
    header("Location: log.php");
    exit;
}



// include '/php/admin/db.php';

//  $q = "SELECT * FROM products ORDER BY id DESC"; 
$q = "SELECT products.*, categories.name AS category_name
FROM products
JOIN categories ON products.category_id = categories.id";

$stmt = $pdo->prepare($q); 
$stmt->execute();
$products = $stmt->fetchAll();


?>


<?php

include 'php/admin/category.php';

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Electoo - Header</title>
  <!-- 🧩 Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <!-- 🎨 Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet"
  />

  <!-- 💅 Custom CSS -->
     <link rel="stylesheet" href="/electro-Template/css/style.css" />

</head>

<style>
  
.add-to-cart {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0;
}

.qty-btn {
  width: 15px;
  height: 30px;
  cursor: pointer;
  font-size: 12px;
}

.qty-count {
  min-width: 10px;
  text-align: center;
  font-weight: bold;
}

</style>
    
<body>

  <!-- 🟥 Top Info Bar -->
  <div class="top-info-bar">
    <div class="container d-flex justify-content-between flex-wrap">
      <div class="d-flex flex-wrap align-items-center">
        <p><i class="fa-solid fa-phone me-1"></i> 0318-0977904</p>
        <p><i class="fa-solid fa-envelope me-1"></i> asjad17habib@gmail.com</p>
        <p><i class="fa-solid fa-location-dot me-1"></i> Chairmain Colony, Wah Cantt</p>
      </div>
      <div class="d-flex flex-wrap align-items-center">
        <p><i class="fa-solid fa-dollar-sign me-1"></i> USD</p>
        <p><i class="fa-solid fa-user me-1"></i> My Account</p>
      </div>
    </div>
  </div>

  <!-- 🟩 Bottom Header -->
  <header class="bottom-header py-3">
    <div class="container">
      <div class="row align-items-center">
        
        <!-- 🟡 Logo -->
        <div class="col-md-3 col-12 text-center text-md-start mb-2 mb-md-0">
          <img src="/electro-Template/images/logo.png" alt="Electro Logo" width="150" />
        </div>

        <!-- 🟢 Search Bar -->
        <div class="col-md-6 col-12 d-flex justify-content-center mb-2 mb-md-0">
          <div class="search d-flex w-100 justify-content-center">
              <select class="category-select">
                <option value="">All Categories</option>
                 <?php foreach($categories as $c): ?>
                  <option value="<?= $c['id']; ?>"><?= $c['name']; ?></option>
                <?php endforeach; ?>
              </select>

            <input type="text" class="input" id="searchBar" placeholder="Search products...">
            <button class="search-btn">Search</button>
            
          </div>
        </div>

        <!-- 🔵 Icons + Navbar Toggle -->
        <div class="col-md-3 col-12 d-flex justify-content-center justify-content-md-end mt-2 mt-md-0 icon-wrapper">
          <div class="icon-box">
            <i class="fa-regular fa-heart"></i>
            <p>Your Wishlist</p>
          </div>
        <div class="cart-icon" id="cartIcon">
            <i class="fa fa-shopping-cart"></i>
        <span id="cartCount">2</span>

        <div class="mini-cart" id="miniCart">

        </div>

    </div>

</div>

          <!-- 🟣 Navbar Toggle (visible only on mobile) -->
          <button
            class="navbar-toggler d-lg-none border-0 ms-2"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarElectro"
            aria-controls="navbarElectro"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fa fa-bars text-white"></i>
          </button>
        </div>
      </div>
    </div>
  </header>

  <!-- 🟦 Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-electro py-2">
    <div class="container-fluid px-4">
      <div class="collapse navbar-collapse justify-content-center" id="navbarElectro">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/electro-Template/hotDeals.html">Hot Deals</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
          <li class="nav-item"><a class="nav-link" href="/electro-Template/laptops.html">Laptops</a></li>
          <li class="nav-item"><a class="nav-link" href="/electro-Templates/martphone.html">Smartphones</a></li>
          <li class="nav-item"><a class="nav-link" href="/electro-Template/camera.html">Cameras</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Accessories</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 🖼️ Shop Section -->
<section class="shop-section">
  <div class="container">
    <div class="rows">
      <div class="shop">
        <div class="shop-img">
          <img src="/electro-Template/images/shop01.png.webp" alt="Laptop Collection" />
        </div>
        <div class="shop-body">
          <h3>Laptop Collection</h3>
          <a href="#" class="cta-btn">Shop Now →</a>
        </div>
      </div>

      <div class="shop">
        <div class="shop-img">
          <img src="/electro-Template/images/shop02.png.webp" alt="Accessories Collection" />
        </div>
        <div class="shop-body">
          <h3>Accessories Collection</h3>
          <a href="#" class="cta-btn">Shop Now →</a>
        </div>
      </div>

      <div class="shop">
        <div class="shop-img">
          <img src="/electro-Template/images/shop03.png.webp" alt="Cameras Collection" />
        </div>
        <div class="shop-body">
          <h3>Cameras Collection</h3>
          <a href="#" class="cta-btn">Shop Now →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- product -->
<!-- Add Swiper CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<section class="new-products">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">NEW PRODUCTS</h2>
      <ul class="product-tabs">
        <li class="active">Laptops</li>
        <li>Smartphones</li>
        <li>Cameras</li>
        <li>Accessories</li>
      </ul>
    </div>

<div class="swiper product-slider filter-slider">

  <div class="swiper-wrapper">

    <?php foreach ($products as $product): ?>
      
      <div class="swiper-slide">
        <div class="product-card" data-category-id="<?= $product['category_id'] ?>">


          <div class="product-img">
            <img src="/electro-Template/images/<?= htmlspecialchars($product['image']); ?>" alt="">
          </div>

          <div class="product-body">
                
              <p class="category"><?= htmlspecialchars($product['category_name']); ?></p>
                    
            <h3><?= $product['name']; ?></h3>

            <div class="price">
              <span class="new-price">$<?= $product['price']; ?></span>

              <?php if (!empty($product['old_price'])): ?>
                <span class="old-price">$<?= $product['old_price']; ?></span>
              <?php endif; ?>
            </div>

            <div class="rating">★★★★★</div>
          </div>

          <div class="product-actions">
            <a href="#" class="wishlist-btn" data-id="<?= $product['id'] ?>">
               <i class="fa-regular fa-heart"></i>
            </a>

            <a href="#" class="compare-btn" data-id="<?= $product['id'] ?>">
              <i class="fa-solid fa-right-left"></i>
            </a>

              <a href="/electro-Template/php/admin/quickview.php?id=<?= $product['id'] ?>"class="quick-view">
                    <i class="fa-regular fa-eye"></i>
              </a>
            
        </div>


          <div class="add-to-cart"  data-id="<?= $product['id'] ?>">
                <button class="add-to-cart-btn" data-id="<?= $product['id'] ?>">
                      <i class="fa-solid fa-cart-shopping"></i>
                      Add to Cart
                </button>
          </div>

      </div>
      </div>

    <?php endforeach; ?>

  </div>


    <!-- Buttons -->
    <div class="product-slider-buttons">
      <button class="slick-prev slick-arrow" aria-label="Previous" type="button">&#10094;</button>
      <button class="slick-next slick-arrow" aria-label="Next" type="button">&#10095;</button>
    </div>
</div>
</section>

<section class="hot-deal-section">
  <div class="hot-deal-container">

    <div class="deal-img left-img">
      <img src="/electro-Template/images/shop01.png.webp" alt="">
    </div>

    <div class="deal-center">
      <div class="deal-timer">
        <div class="circle"><span>02</span>Days</div>
        <div class="circle"><span>10</span>Hours</div>
        <div class="circle"><span>34</span>Mins</div>
        <div class="circle"><span>60</span>Secs</div>
      </div>

      <h2 class="deal-title">HOT DEAL THIS WEEK</h2>
      <p class="deal-text">NEW COLLECTION UP TO 50% OFF</p>

      <button class="shop-btn">Shop Now</button>
    </div>

    <div class="deal-img right-img">
      <img src="/electro-Template/images/shop02.png.webp" alt="">
    </div>

  </div>
</section>

</section>


<section class="new-products">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Top selling</h2>
      <ul class="product-tabs">
        <li class="active">Laptops</li>
        <li>Smartphones</li>
        <li>Cameras</li>
        <li>Accessories</li>
      </ul>
    </div>

<div class="swiper product-slider">
  <div class="swiper-wrapper">

    <div class="swiper-slide">
      <div class="product-card">
        <div class="product-img">
          <img src="https://preview.colorlib.com/theme/electro/img/product01.png.webp" alt="Product">
        </div>
        <div class="product-body">
          <p class="category">LAPTOP</p>
          <h3>Power Laptop X1</h3>
          <div class="price">
            <span class="new-price">$980.00</span>
            <span class="old-price">$990.00</span>
          </div>
          <div class="rating">★★★★★</div>
        </div>     
       <div class="product-actions">
            <a href="#" class="wishlist-btn" title="Add to Wishlist">
            <i class="fa-regular fa-heart"></i></a>
            <div class="toast">Added to Compare</div>
            <a href="#" title="Compare"><i class="fa-solid fa-right-left"></i></a>
            <a href="#" title="Quick View"><i class="fa-regular fa-eye"></i></a>
      </div>
        <div class="add-to-cart">
          <button>
                  <div class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                    <span class="cartCount">0</span>
                  </div>
          </button>
        </div>
      </div>
    </div>

  </div>
</div>

  </div>
</section>


<!-- login form -->
<div class="news-letter">
  <div class="container">
    <p class="nl-title">Sign Up for the <b>NEWSLETTER</b></p>

    <div class="newsletter-box">
      <input type="email" placeholder="Enter Your Email" />
      <button class="subscribe-btn"> <i class="fa-solid fa-envelope"></i>Subscribe</button>
    </div>
  </div>
</div>


<footer class="footer-section">
  <div class="container">
    <div class="row">

      <!-- About -->
      <div class="col-md-4 col-sm-6 mb-4">
        <h4 class="footer-title">About Us</h4>
        <p class="footer-text">
          We provide high-quality electronics with unbeatable prices.
          Your satisfaction is our top priority.
        </p>
        <ul class="social-links">
          <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
        </ul>
      </div>

      <!-- Categories -->
      <div class="col-md-2 col-sm-6 mb-4">
        <h4 class="footer-title">Categories</h4>
        <ul class="footer-links">
          <li><a href="#">Laptops</a></li>
          <li><a href="#">Smartphones</a></li>
          <li><a href="#">Headphones</a></li>
          <li><a href="#">Gaming</a></li>
        </ul>
      </div>

      <!-- Information -->
      <div class="col-md-2 col-sm-6 mb-4">
        <h4 class="footer-title">Information</h4>
        <ul class="footer-links">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Return Policy</a></li>
          <li><a href="#">Privacy & Policy</a></li>
          <li><a href="#">Terms & Conditions</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-md-4 col-sm-6 mb-4">
        <h4 class="footer-title">Contact</h4>
        <ul class="footer-contact">
          <li><i class="fa-solid fa-location-dot"></i> Lahore, Pakistan</li>
          <li><i class="fa-solid fa-phone"></i> +92 300 1234567</li>
          <li><i class="fa-solid fa-envelope"></i> support@example.com</li>
        </ul>
      </div>

    </div>
  </div>

  <div class="footer-bottom">
    <p>© 2025 Electro Store — All Rights Reserved.</p>
  </div>
</footer>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



<script>

// FILTERABLE SLIDER

  (function ensureSlidesCount(target = 8){
    const wrapper = document.querySelector('.product-slider .swiper-wrapper');
    if(!wrapper) 
    return;
    const slides = Array.from(wrapper.children);
    let count = slides.length;
    
    if(count >= target) 
    return;
    // clone in sequence until target reached
    let i = 0;
    while(count < target){
      const clone = slides[i % slides.length].cloneNode(true);
      wrapper.appendChild(clone);
      i++; count++;
    }

  })(8);

const filterSwiper = new Swiper('.filter-slider', {
  slidesPerView: 4,
  spaceBetween: 24,
  loop: false,
  speed: 600,
  navigation: {
    nextEl: '.slick-next',
    prevEl: '.slick-prev'
  },
  breakpoints: {
    1400: { slidesPerView: 4 },
    1024: { slidesPerView: 3 },
    768:  { slidesPerView: 2 },
    0:    { slidesPerView: 1 }
  }
});



</script> 


 <script>

document.addEventListener("DOMContentLoaded", () => {

  // ONE listener on document (stable parent)
  document.addEventListener("click", function (e) {

    // Check: click add-to-cart button par hua ya uske andar?
    const btn = e.target.closest(".add-to-cart-btn");
    if (!btn) return; // ignore other clicks

    e.preventDefault();

    const productId = btn.dataset.id;

    fetch("/electro-Template/php/admin/cart.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: "id=" + encodeURIComponent(productId)
    })
    .then(res => res.json())
    .then(data => {
      console.log(data);
      alert(data.message); // ✅ Fix 3: semicolon hata diya — .catch ab kaam karega
    })
    .catch(err => console.error("Fetch error:", err));

  });

});
</script>


<script>

  const originalSlides = [...filterSwiper.slides].map(slide => slide.cloneNode(true));

document.querySelector(".category-select").addEventListener("change", e => {
  const selectedCategory = e.target.value;
  console.log(selectedCategory);

  filterSwiper.removeAllSlides();

  const filtered = originalSlides.filter(slide => {


    const card = slide.querySelector(".product-card");
    if (!card) return false;

        console.log(card);
        console.log(slide);
        console.log(originalSlides);



    return selectedCategory === "" ||
           card.dataset.categoryId === selectedCategory;

  });

  filterSwiper.appendSlide(filtered);
  filterSwiper.update();
  filterSwiper.slideTo(0);
  




});

</script>




<!-- ✅ Fix 2: Duplicate cart listener remove kar diya — upar wala kaam kar raha hai -->




<script>

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

</script>









    <!-- <script src="script.js"></script>
    <script src="cart.js"></script> -->

  <!-- 🧩 Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>