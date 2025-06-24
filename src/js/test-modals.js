/**
 * Script de test pour les modales
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log('Test Modals Script Loaded');
    
    // Test 1: Vérifier si les modales existent
    const authModal = document.getElementById('authModal');
    const searchModal = document.getElementById('searchModal');
    
    console.log('✅ Auth Modal:', authModal ? 'Trouvé' : 'Non trouvé');
    console.log('✅ Search Modal:', searchModal ? 'Trouvé' : 'Non trouvé');
    
    // Test 2: Vérifier les boutons d'ouverture
    const authButtons = document.querySelectorAll('[data-modal-toggle="authModal"]');
    const searchButtons = document.querySelectorAll('[data-modal-toggle="searchModal"]');
    
    console.log('✅ Auth buttons:', authButtons.length);
    console.log('✅ Search buttons:', searchButtons.length);
    
    // Test 3: Vérifier le gestionnaire de modales
    setTimeout(() => {
        console.log('✅ Modal Manager:', window.modalManager ? 'Initialisé' : 'Non initialisé');
        
        if (window.modalManager) {
            console.log('✅ Modal Manager activeModals:', window.modalManager.activeModals.size);
        }
    }, 100);
    
    // Test 4: Ajouter un test manuel
    if (authButtons.length > 0) {
        authButtons[0].addEventListener('click', () => {
            console.log('🔘 Auth button clicked - Modal should open');
        });
    }
    
    if (searchButtons.length > 0) {
        searchButtons[0].addEventListener('click', () => {
            console.log('🔘 Search button clicked - Modal should open');
        });
    }
    
    // Test 5: Vérifier les classes CSS
    const testElement = document.createElement('div');
    testElement.className = 'opacity-100 scale-100';
    const computedStyle = window.getComputedStyle(testElement);
    
    console.log('✅ CSS Classes Test:');
    console.log('  - opacity-100:', computedStyle.opacity !== 'initial' ? 'OK' : 'Manquant');
    console.log('  - scale-100:', computedStyle.transform !== 'none' ? 'OK' : 'Manquant');
}); 