// document.addEventListener("DOMContentLoaded", function () {

  // Wishlist toggle
  document.querySelectorAll(".wishlist-btn i").forEach(icon => {
    icon.addEventListener("click", function (e) {
      e.preventDefault();
      this.classList.toggle("fa-regular");
      this.classList.toggle("fa-solid");
      this.classList.toggle("wishlist-active");
    });
  });

  // Compare toast



let cartCount = 0;

// Select ALL "Add to Cart" buttons
document.querySelectorAll(".add-to-cart button").forEach(btn => {
  btn.addEventListener("click", function () {
    
    // Increase global count
    cartCount++;
    // Update every cartCount span on page
    document.querySelectorAll(".cartCount").forEach(span => {
      span.innerText = cartCount;
    });

  });
});



document.addEventListener("DOMContentLoaded", () => {

  const buttons = document.querySelectorAll(".compare-btn, a[title='Compare']");

  buttons.forEach(btn => {
    btn.addEventListener("click", e => {
      e.preventDefault();

      const card = btn.closest(".product-card");
      if (!card) return;

      // check toast
      let toast = card.querySelector(".toast");

      // create toast if missing
      if (!toast) {
        toast = document.createElement("div");
        toast.className = "toast";
        toast.innerText = "Added to Compare";
        card.appendChild(toast);
      }

      // show toast
      toast.classList.add("show");

      // hide after 1.3 sec
      setTimeout(() => {
        toast.classList.remove("show");
      }, 1300);
    });
  });

});




document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('quickViewModal');
  const qvImg = document.getElementById('qv-img');
  const qvCategory = document.getElementById('qv-category');
  const qvTitle = document.getElementById('qv-title');
  const qvNew = document.getElementById('qv-new');
  const qvOld = document.getElementById('qv-old');
  const qvRating = document.getElementById('qv-rating');
  const qvDesc = document.getElementById('qv-desc');
  const qvSpecs = document.getElementById('qv-specs');
  const closeBtn = modal.querySelector('.quick-view-close');

  const findFirst = (card, selectors=[]) => {
    for (const s of selectors) {
      const el = card.querySelector(s);
      if (el && el.innerHTML.trim()) return el.innerHTML.trim();
    }
    // try data attributes as fallback
    return (card.getAttribute('data-description') || card.getAttribute('data-specs') || '').trim() || '';
  };

  document.body.addEventListener('click', (e) => {
    const trigger = e.target.closest('.quick-view-btn, a[title="Quick View"], .fa-eye');
    if (!trigger) return;
    e.preventDefault();

    const card = trigger.closest('.product-card');
    if (!card) return;

    qvImg.src = card.querySelector('.product-img img')?.src || '';
    qvCategory.textContent = card.querySelector('.category')?.textContent || '';
    qvTitle.textContent = card.querySelector('h3')?.textContent || '';
    qvNew.textContent = card.querySelector('.new-price')?.textContent || '';
    qvOld.textContent = card.querySelector('.old-price')?.textContent || '';
    qvRating.textContent = card.querySelector('.rating')?.textContent || '';

    // pick overview from several possible classes (keeps formatting)
    qvDesc.innerHTML = findFirst(card, [
      '.product-overview',
      '.product-desc',
      '.product-description',  /* sometimes used for overview */
      '.overview'
    ]) || 'No overview available.';

    // pick specs from several possible classes
    qvSpecs.innerHTML = findFirst(card, [
      '.product-specs',
      '.product-description', /* sometimes used for specs */
      '.specs',
      '.product-spec'
    ]) || 'No specifications available.';

    modal.classList.add('show');
    modal.setAttribute('aria-hidden','false');
    document.documentElement.style.overflow = 'hidden';
    document.body.style.overflow = 'hidden';
  });

  const closeModal = () => {
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden','true');
    document.documentElement.style.overflow = '';
    document.body.style.overflow = '';
  };
  closeBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
});




  // helper: clone slides until count >= target (keeps loop smooth)
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

  // init swiper AFTER possible cloning
  const swiper = new Swiper('.product-slider', {
    slidesPerView: 4,
    spaceBetween: 24,
    loop: true,
    speed: 600,
    watchOverflow: true,    // disables navigation if not needed
    grabCursor: true,
    centeredSlides: false,
    autoplay: {
      delay: 2400,
      disableOnInteraction: false,
      pauseOnMouseEnter: true
    },
    navigation: {
      nextEl: '.slick-next',
      prevEl: '.slick-prev'
    },
    keyboard: { enabled: true, onlyInViewport: true },
    breakpoints: {
      1400: { slidesPerView: 4, spaceBetween: 28 },
      1280: { slidesPerView: 4, spaceBetween: 28 }, // keeps 4 on 1280
      1024: { slidesPerView: 3, spaceBetween: 22 },
      768:  { slidesPerView: 2, spaceBetween: 18 },
      0:    { slidesPerView: 1, spaceBetween: 12 }
    },
    on: {
      init() { /* prevents transient jump on some devices */ },
      resize() { /* nothing special, but keeps responsive */ }
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
  const compareButtons = document.querySelectorAll(".compare-btn");

  compareButtons.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault(); // stop page refresh

      const card = btn.closest(".product-card");
      const toast = card.querySelector(".toast");

      // show toast
      toast.classList.add("show");

      // auto hide after 1.5 sec
      setTimeout(() => {
        toast.classList.remove("show");
      }, 1500);
    });
  });
});
