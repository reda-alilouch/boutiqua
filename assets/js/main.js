// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function () {
  const menuTrigger = document.querySelector('.menu-trigger');
  const mobileMenu = document.querySelector('#mobile-menu');
  const header = document.querySelector('header');

  // Mobile menu toggle
  if (menuTrigger && mobileMenu) {
    menuTrigger.addEventListener('click', (e) => {
      e.stopPropagation();
      mobileMenu.classList.toggle('hidden');
      menuTrigger.classList.toggle('bg-gray-100');
    });
  }

  // Close mobile menu when clicking outside
  document.addEventListener('click', (e) => {
    if (mobileMenu && !header.contains(e.target)) {
      mobileMenu.classList.add('hidden');
      if (menuTrigger) {
        menuTrigger.classList.remove('bg-gray-100');
      }
    }
  });

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

    let current = '';

    sections.forEach((section) => {
      const sectionTop = section.offsetTop - header.offsetHeight - 100;
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

  // Header scroll effect
  let lastScroll = 0;

  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll <= 0) {
      header.classList.remove('scroll-up');
      return;
    }

    if (
      currentScroll > lastScroll &&
      !header.classList.contains('scroll-down')
    ) {
      header.classList.remove('scroll-up');
      header.classList.add('scroll-down');
    } else if (
      currentScroll < lastScroll &&
      header.classList.contains('scroll-down')
    ) {
      header.classList.remove('scroll-down');
      header.classList.add('scroll-up');
    }

    lastScroll = currentScroll;
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
