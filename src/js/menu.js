// Fonction pour créer l'overlay du menu si nécessaire
function createMenuOverlay() {
    // Vérifier si l'overlay existe déjà
    let overlay = document.getElementById('menuOverlay');
    
    // Si l'overlay n'existe pas, le créer
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'menuOverlay';
        overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden';
        overlay.addEventListener('click', closeMenu);
        document.body.appendChild(overlay);
    }
    
    return overlay;
}

// Fonction pour fermer le menu mobile
function closeMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const menuButton = document.getElementById('mobileMenuButton');
    const overlay = document.getElementById('menuOverlay');
    
    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('hidden');
        document.body.style.overflow = 'auto';
        
        // Masquer l'overlay
        if (overlay) {
            overlay.classList.add('hidden');
        }
    }
}

// Fonction pour basculer l'affichage du menu mobile
function toggleMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const menuButton = document.getElementById('mobileMenuButton');
    const overlay = createMenuOverlay();
    
    if (!mobileMenu) {
        console.error('Mobile menu not found');
        return;
    }
    
    // Basculer la classe pour afficher/masquer le menu mobile
    mobileMenu.classList.toggle('hidden');
    
    if (mobileMenu.classList.contains('hidden')) {
        // Menu fermé
        document.body.style.overflow = 'auto';
        overlay.classList.add('hidden');
    } else {
        // Menu ouvert
        document.body.style.overflow = 'hidden';
        overlay.classList.remove('hidden');
    }
}

// Initialisation du menu mobile et des événements associés
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter l'événement de clic au bouton du menu mobile
    const menuButton = document.getElementById('mobileMenuButton');
    if (menuButton) {
        menuButton.addEventListener('click', toggleMenu);
    }
    
    // Sélectionner tous les liens dans le menu mobile
    const mobileMenuLinks = document.querySelectorAll('#mobileMenu a');
    
    // Ajouter un écouteur d'événement à chaque lien
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });
    
    // Fermer le menu mobile quand on redimensionne la fenêtre à une taille desktop
    window.addEventListener('resize', function() {
        // Si la fenêtre est plus large que 1024px (lg dans Tailwind)
        if (window.innerWidth >= 1024) {
            closeMenu();
        }
    });
    
    // Fermer le menu avec la touche Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });
    
    // Ajouter une classe active au lien de la page courante
    const currentPath = window.location.pathname;
    mobileMenuLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath || 
            (currentPath.includes(link.getAttribute('href')) && link.getAttribute('href') !== '/boutiqua')) {
            link.classList.add('text-blue-600');
            link.classList.remove('text-gray-700');
        }
    });
    
    console.log('✅ Menu mobile initialisé');
    console.log('✅ Menu button:', menuButton ? 'Trouvé' : 'Non trouvé');
    console.log('✅ Mobile menu:', document.getElementById('mobileMenu') ? 'Trouvé' : 'Non trouvé');
});

