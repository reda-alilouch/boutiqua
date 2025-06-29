// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function () {
  


  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        // Close mobile menu
        if (mobileMenu) {
          mobileMenu.classList.add('hidden');
          menuTrigger.classList.remove('bg-gray-100');
        }

        // Smooth scroll
        window.scrollTo({
          top: target.offsetTop - 80,
          behavior: 'smooth',
        });
      }
    });
  });

  // Preloader
  window.addEventListener('load', function () {
    const preloader = document.getElementById('preloader');
    preloader.style.opacity = '0';
    setTimeout(() => {
      preloader.style.display = 'none';
    }, 300);
  });

  // Active link handling
  function setActiveLink() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    const header = document.querySelector('header');
    const headerHeight = header ? header.offsetHeight : 0;

    let current = '';

    sections.forEach((section) => {
      const sectionTop = section.offsetTop - headerHeight - 100;
      const sectionHeight = section.offsetHeight;
      if (
        window.scrollY >= sectionTop &&
        window.scrollY < sectionTop + sectionHeight
      ) {
        current = '#' + section.getAttribute('id');
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove('active');
      if (link.getAttribute('href') === current) {
        link.classList.add('active');
      }
    });
  }

  window.addEventListener('scroll', setActiveLink);
  setActiveLink();

  // Product Filtering
  const filterButtons = document.querySelectorAll('[data-filter]');
  const products = document.querySelectorAll('#products > div');

  if (filterButtons.length && products.length) {
    filterButtons.forEach((button) => {
      button.addEventListener('click', (e) => {
        e.preventDefault();

        // Remove active class from all buttons
        filterButtons.forEach((btn) => {
          btn.classList.remove('bg-black', 'text-white');
          btn.classList.add('border', 'border-black', 'text-black');
        });

        // Add active class to clicked button
        button.classList.remove('border', 'border-black', 'text-black');
        button.classList.add('bg-black', 'text-white');

        const filter = button.getAttribute('data-filter');

        products.forEach((product) => {
          if (filter === '*') {
            product.style.display = 'block';
          } else {
            if (product.classList.contains(filter.replace('.', ''))) {
              product.style.display = 'block';
            } else {
              product.style.display = 'none';
            }
          }
        });
      });
    });
  }

  // Scroll to Top Button
  const scrollToTop = document.createElement('button');
  scrollToTop.innerHTML = '<i class="fa fa-arrow-up"></i>';
  scrollToTop.className = 'scroll-to-top';
  document.body.appendChild(scrollToTop);

  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 200) {
      scrollToTop.classList.add('show');
    } else {
      scrollToTop.classList.remove('show');
    }
  });

  scrollToTop.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });
  });

  // Add styles for scroll to top button
  const style = document.createElement('style');
  style.textContent = `
    .scroll-to-top {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 40px;
      height: 40px;
      background-color: #000000;
      color: #ffffff;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.3s ease;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .scroll-to-top.show {
      opacity: 1;
      transform: translateY(0);
    }

    .scroll-to-top:hover {
      background-color: #333333;
      transform: translateY(-2px);
    }
  `;
  document.head.appendChild(style);

  // Image hover effect
  document.querySelectorAll('.product-card img').forEach((img) => {
    img.addEventListener('mouseenter', function () {
      this.style.transform = 'scale(1.1)';
      this.style.transition = 'transform 0.3s ease';
    });

    img.addEventListener('mouseleave', function () {
      this.style.transform = 'scale(1)';
    });
  });

 

// Modal Animations
document.addEventListener('alpine:init', () => {
  Alpine.store('modal', {
    search: false,
    auth: false,
    authTab: 'login',
    searchQuery: '',
    searchResults: [],
    isLoading: false,

    toggleSearch() {
      this.search = !this.search;
      if (this.search) {
        this.auth = false;
        setTimeout(() => {
          document.querySelector('.search-input').focus();
        }, 100);
      }
    },

    toggleAuth() {
      this.auth = !this.auth;
      if (this.auth) {
        this.search = false;
      }
    },

    setAuthTab(tab) {
      this.authTab = tab;
    },

    async performSearch() {
      if (this.searchQuery.length < 2) {
        this.searchResults = [];
        return;
      }

      this.isLoading = true;

      // Simulate search delay
      await new Promise((resolve) => setTimeout(resolve, 500));

      // Mock search results
      this.searchResults = [
        {
          title: 'Classic Black T-Shirt',
          category: "Men's Fashion",
          price: '29.99',
          image: 'assets/images/men-01.jpg',
        },
        {
          title: 'White Summer Dress',
          category: "Women's Fashion",
          price: '49.99',
          image: 'assets/images/women-01.jpg',
        },
        // Add more mock results as needed
      ];

      this.isLoading = false;
    },

    clear() {
      this.searchQuery = '';
      this.searchResults = [];
    },
  });
});

// Enhanced Modal Transitions
const modalBackdrops = document.querySelectorAll('.modal-backdrop');
modalBackdrops.forEach((backdrop) => {
  backdrop.addEventListener('transitionend', (e) => {
    if (!backdrop.classList.contains('show')) {
      backdrop.style.display = 'none';
    }
  });
});

// Form Validation
const forms = document.querySelectorAll('form');
forms.forEach((form) => {
  form.addEventListener('submit', (e) => {
    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();

      // Add shake animation to invalid fields
      const invalidFields = form.querySelectorAll(':invalid');
      invalidFields.forEach((field) => {
        field.classList.add('shake');
        field.addEventListener('animationend', () => {
          field.classList.remove('shake');
        });
      });
    }

    form.classList.add('was-validated');
  });
});

// Add animation styles
const animationStyles = document.createElement('style');
animationStyles.textContent = `
  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
  }

  .shake {
    animation: shake 0.5s ease-in-out;
  }

  .modal-backdrop {
    transition: opacity 0.3s ease-in-out;
  }

  .modal-content {
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
  }

  .modal.entering .modal-content {
    transform: scale(0.95);
    opacity: 0;
  }

  .modal.entered .modal-content {
    transform: scale(1);
    opacity: 1;
  }

  .modal.exiting .modal-content {
    transform: scale(0.95);
    opacity: 0;
  }
`;
document.head.appendChild(animationStyles);

// Initialize Hero Carousel with Swiper.js
const heroSwiper = new Swiper('.hero-swiper', {
  // Basic settings
  loop: true,
  effect: 'fade',
  speed: 1000,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
  
  // Navigation
  navigation: {
    nextEl: '.hero-swiper-button-next',
    prevEl: '.hero-swiper-button-prev',
  },
  
  // Pagination
  pagination: {
    el: '.hero-swiper-pagination',
    clickable: true,
    dynamicBullets: true,
  },
  
  // Responsive breakpoints
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    768: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    1024: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
  },
  
  // Fade effect
  fadeEffect: {
    crossFade: true
  },
  
  // Keyboard navigation
  keyboard: {
    enabled: true,
    onlyInViewport: true,
  },
  
  // Mouse wheel
  mousewheel: {
    invert: false,
  },
  
  // Touch events
  touchRatio: 1,
  touchAngle: 45,
  grabCursor: true,
  
  // Preload images
  preloadImages: false,
  lazy: {
    loadPrevNext: true,
    loadPrevNextAmount: 1,
  },
  
  // Callbacks
  on: {
    init: function () {
      console.log('Hero carousel initialized');
      // Add loading animation
      document.querySelector('.hero-swiper').classList.add('swiper-initialized');
    },
    slideChange: function () {
      // Reset animations for new slide
      const activeSlide = this.slides[this.activeIndex];
      const elements = activeSlide.querySelectorAll('h1, p, .flex');
      elements.forEach((el, index) => {
        el.style.animation = 'none';
        setTimeout(() => {
          el.style.animation = `slideInUp 0.8s ease-out ${index * 0.2}s`;
        }, 100);
      });
    },
  },
});

// Pause autoplay on mobile to save battery
if (window.innerWidth <= 768) {
  heroSwiper.autoplay.stop();
}

// Resume autoplay on desktop
window.addEventListener('resize', function() {
  if (window.innerWidth > 768) {
    heroSwiper.autoplay.start();
  } else {
    heroSwiper.autoplay.stop();
  }
});

// Add to cart form authentication check
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
      if (form.dataset.auth === '0') {
        e.preventDefault();
        // Ouvre le modal de connexion
        var authModal = document.getElementById('AuthModal');
        var authModalBox = document.getElementById('authModalBox');
        if (authModal && authModalBox) {
          authModal.style.display = 'flex';
          setTimeout(function() {
            authModalBox.classList.remove('opacity-0', 'scale-95');
            authModalBox.classList.add('opacity-100', 'scale-100');
          }, 10);
        }
      }
    });
  });

  // Add to wishlist form authentication check
  document.querySelectorAll('form[action="add_to_wishlist.php"]').forEach(function(form) {
    form.addEventListener('submit', function(e) {
      if (form.dataset.auth === '0') {
        e.preventDefault();
        // Ouvre le modal de connexion
        var authModal = document.getElementById('AuthModal');
        var authModalBox = document.getElementById('authModalBox');
        if (authModal && authModalBox) {
          authModal.style.display = 'flex';
          setTimeout(function() {
            authModalBox.classList.remove('opacity-0', 'scale-95');
            authModalBox.classList.add('opacity-100', 'scale-100');
          }, 10);
        }
      }
    });
  });
}); 
})
