document.addEventListener("DOMContentLoaded", () => {
  const menuButton = document.getElementById("menuButton");
  const mainMenu = document.getElementById("mainMenu");
  const menuOpenIcon = document.querySelector(".menu-open-icon");
  const menuCloseIcon = document.querySelector(".menu-close-icon");
  const body = document.body;
  let isMenuOpen = false;
  let resizeTimer;

  // Fonction pour mettre à jour l'état ARIA et le focus
  function updateAria(expanded) {
    menuButton.setAttribute('aria-expanded', expanded);
    if (expanded) {
      menuButton.setAttribute('aria-label', 'Fermer le menu');
      // Déplacer le focus vers le premier élément du menu
      const firstLink = mainMenu.querySelector('a');
      if (firstLink) {
        setTimeout(() => firstLink.focus(), 100);
      }
    } else {
      menuButton.setAttribute('aria-label', 'Ouvrir le menu');
      // Revenir au bouton du menu lors de la fermeture
      menuButton.focus();
    }
  }

  // Fonction pour basculer le menu
  function toggleMenu() {
    isMenuOpen = !isMenuOpen;
    
    if (isMenuOpen) {
      // Ouverture du menu
      mainMenu.classList.remove('hidden');
      mainMenu.classList.add('active');
      menuOpenIcon.classList.add('hidden');
      menuCloseIcon.classList.remove('hidden');
      body.style.overflow = 'hidden';
      
      // Mise à jour ARIA
      updateAria(true);
      
      // Animation d'entrée
      requestAnimationFrame(() => {
        mainMenu.style.transition = 'opacity 300ms ease, transform 300ms ease';
        mainMenu.style.opacity = '1';
        mainMenu.style.transform = 'translateY(0)';
      });
      
    } else {
      // Fermeture du menu
      mainMenu.style.opacity = '0';
      mainMenu.style.transform = 'translateY(-10px)';
      
      // Retard pour permettre l'animation avant de cacher le menu
      setTimeout(() => {
        mainMenu.classList.remove('active');
        mainMenu.classList.add('hidden');
        menuOpenIcon.classList.remove('hidden');
        menuCloseIcon.classList.add('hidden');
        body.style.overflow = '';
        
        // Réinitialiser les styles d'animation
        mainMenu.style.transition = '';
        mainMenu.style.opacity = '';
        mainMenu.style.transform = '';
        
        // Mise à jour ARIA
        updateAria(false);
      }, 300);
    }
  }

  // Gestionnaire d'événements pour le clic sur le bouton du menu
  function handleMenuButtonClick(e) {
    e.preventDefault();
    e.stopPropagation();
    toggleMenu();
  }

  // Gestionnaire pour la touche Échap
  function handleEscapeKey(e) {
    if (e.key === 'Escape' && isMenuOpen) {
      e.preventDefault();
      toggleMenu();
    }
  }

  // Gestionnaire pour le clic en dehors du menu
  function handleOutsideClick(e) {
    if (isMenuOpen && !mainMenu.contains(e.target) && !menuButton.contains(e.target)) {
      toggleMenu();
    }
  }

  // Gestionnaire pour le redimensionnement de la fenêtre
  function handleResize() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      if (window.innerWidth >= 1024 && isMenuOpen) {
        toggleMenu();
      }
    }, 250);
  }

  // Initialisation
  function init() {
    // Événements
    menuButton.addEventListener('click', handleMenuButtonClick);
    document.addEventListener('keydown', handleEscapeKey);
    document.addEventListener('click', handleOutsideClick);
    window.addEventListener('resize', handleResize, { passive: true });
    
    // Fermer le menu lorsqu'on clique sur un lien
    const menuLinks = mainMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (isMenuOpen) {
          toggleMenu();
        }
      });
      
      // Gestion de la navigation au clavier dans le menu
      link.addEventListener('keydown', (e) => {
        if (e.key === 'Tab' && isMenuOpen) {
          const menuItems = Array.from(menuLinks);
          const firstItem = menuItems[0];
          const lastItem = menuItems[menuItems.length - 1];
          
          if (e.shiftKey && document.activeElement === firstItem) {
            // Shift + Tab sur le premier élément
            e.preventDefault();
            lastItem.focus();
          } else if (!e.shiftKey && document.activeElement === lastItem) {
            // Tab sur le dernier élément
            e.preventDefault();
            firstItem.focus();
          }
        }
      });
    });
    
    // État initial
    updateAria(false);
  }
  
  // Démarrer l'initialisation
  init();
  
  // Nettoyage des événements (bonne pratique)
  return () => {
    menuButton.removeEventListener('click', handleMenuButtonClick);
    document.removeEventListener('keydown', handleEscapeKey);
    document.removeEventListener('click', handleOutsideClick);
    window.removeEventListener('resize', handleResize);
  };
});
