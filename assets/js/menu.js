document.addEventListener("DOMContentLoaded", function () {
  // Menu elements
  const menuButton = document.getElementById("menuButton");
  const mainMenu = document.getElementById("mainMenu");
  const menuOpenIcon = menuButton.querySelector(".menu-open-icon");
  const menuCloseIcon = menuButton.querySelector(".menu-close-icon");
  const pagesDropdownButton = document.getElementById("pagesDropdownButton");
  const pagesDropdownMenu = document.getElementById("pagesDropdownMenu");

  // Toggle mobile menu
  menuButton.addEventListener("click", function () {
    const isOpen = !mainMenu.classList.contains("translate-x-full");

    if (isOpen) {
      // Close menu
      mainMenu.classList.add("translate-x-full");
      menuOpenIcon.classList.remove("hidden");
      menuCloseIcon.classList.add("hidden");
    } else {
      // Open menu
      mainMenu.classList.remove("translate-x-full");
      menuOpenIcon.classList.add("hidden");
      menuCloseIcon.classList.remove("hidden");
    }
  });

  // Toggle pages dropdown
  pagesDropdownButton.addEventListener("click", function (e) {
    e.stopPropagation();
    pagesDropdownMenu.classList.toggle("hidden");

    // Rotate arrow icon
    const arrow = this.querySelector("svg");
    arrow.style.transform = pagesDropdownMenu.classList.contains("hidden")
      ? ""
      : "rotate(180deg)";
  });

  // Close dropdown when clicking outside
  document.addEventListener("click", function (e) {
    if (!pagesDropdownButton.contains(e.target)) {
      pagesDropdownMenu.classList.add("hidden");
      pagesDropdownButton.querySelector("svg").style.transform = "";
    }
  });

  // Close menu when clicking outside on mobile
  document.addEventListener("click", function (e) {
    if (window.innerWidth < 1024) {
      // lg breakpoint
      if (!mainMenu.contains(e.target) && !menuButton.contains(e.target)) {
        mainMenu.classList.add("translate-x-full");
        menuOpenIcon.classList.remove("hidden");
        menuCloseIcon.classList.add("hidden");
      }
    }
  });
});
