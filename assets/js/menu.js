document.addEventListener("DOMContentLoaded", function () {
  // Menu elements
  const menuButton = document.getElementById("menuButton");
  const mobileMenu = document.getElementById("mobileMenu");
  const mobileDropdownButton = document.getElementById("mobileDropdownButton");
  const mobileDropdownMenu = document.getElementById("mobileDropdownMenu");
  const menuOpenIcon = menuButton.querySelector(".menu-open-icon");
  const menuCloseIcon = menuButton.querySelector(".menu-close-icon");

  // Toggle mobile menu
  menuButton.addEventListener("click", function () {
    const isOpen = mobileMenu.classList.contains("translate-x-0");

    if (isOpen) {
      mobileMenu.classList.remove("translate-x-0");
      mobileMenu.classList.add("translate-x-full");
      menuOpenIcon.classList.remove("hidden");
      menuCloseIcon.classList.add("hidden");
    } else {
      mobileMenu.classList.remove("translate-x-full");
      mobileMenu.classList.add("translate-x-0");
      menuOpenIcon.classList.add("hidden");
      menuCloseIcon.classList.remove("hidden");
    }
  });

  // Toggle mobile dropdown
  mobileDropdownButton.addEventListener("click", function () {
    const isOpen = mobileDropdownMenu.classList.contains("hidden");

    // Rotate arrow icon
    this.querySelector("svg").style.transform = isOpen ? "rotate(180deg)" : "";

    // Toggle dropdown
    mobileDropdownMenu.classList.toggle("hidden");
  });

  // Close menu when clicking outside
  document.addEventListener("click", function (e) {
    if (!mobileMenu.contains(e.target) && !menuButton.contains(e.target)) {
      mobileMenu.classList.remove("translate-x-0");
      mobileMenu.classList.add("translate-x-full");
      menuOpenIcon.classList.remove("hidden");
      menuCloseIcon.classList.add("hidden");
    }
  });

  // Handle window resize
  window.addEventListener("resize", function () {
    if (window.innerWidth >= 1024) {
      // Reset mobile menu state
      mobileMenu.classList.remove("translate-x-0");
      mobileMenu.classList.add("translate-x-full");
      menuOpenIcon.classList.remove("hidden");
      menuCloseIcon.classList.add("hidden");

      // Reset mobile dropdown
      mobileDropdownMenu.classList.add("hidden");
      mobileDropdownButton.querySelector("svg").style.transform = "";
    }
  });
});
