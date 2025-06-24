/**
 * Script de test pour le menu mobile
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log('🍔 Test Menu Mobile Script Loaded');
    
    // Test 1: Vérifier si les éléments existent
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    
    console.log('✅ Mobile Menu Button:', mobileMenuButton ? 'Trouvé' : 'Non trouvé');
    console.log('✅ Mobile Menu:', mobileMenu ? 'Trouvé' : 'Non trouvé');
    
    // Test 2: Vérifier les classes CSS
    if (mobileMenu) {
        console.log('✅ Mobile Menu classes:', mobileMenu.className);
        console.log('✅ Mobile Menu hidden:', mobileMenu.classList.contains('hidden'));
    }
    
    if (mobileMenuButton) {
        console.log('✅ Mobile Menu Button classes:', mobileMenuButton.className);
    }
    
    // Test 3: Ajouter un test manuel
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', () => {
            console.log('🔘 Mobile menu button clicked!');
            
            // Vérifier l'état après le clic
            setTimeout(() => {
                console.log('✅ Menu hidden after click:', mobileMenu.classList.contains('hidden'));
            }, 100);
        });
    }
    
    // Test 4: Vérifier les liens du menu
    const menuLinks = document.querySelectorAll('#mobileMenu a');
    console.log('✅ Menu links count:', menuLinks.length);
    
    menuLinks.forEach((link, index) => {
        console.log(`  - Link ${index + 1}:`, link.textContent.trim(), '->', link.href);
    });
    
    // Test 5: Vérifier la fonction toggleMenu
    if (typeof toggleMenu === 'function') {
        console.log('✅ toggleMenu function exists');
    } else {
        console.log('❌ toggleMenu function not found');
    }
    
    // Test 6: Vérifier la fonction closeMenu
    if (typeof closeMenu === 'function') {
        console.log('✅ closeMenu function exists');
    } else {
        console.log('❌ closeMenu function not found');
    }
}); 