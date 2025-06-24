/**
 * AuthModal.js - Gestion du modal d'authentification
 * Étend la classe Modal de base avec des fonctionnalités d'authentification
 */

class AuthModal {
    constructor() {
        this.modal = document.getElementById('authModal');
        
        if (!this.modal) {
            console.error('Modal authModal not found');
            return;
        }
        
        // Éléments du modal
        this.tabButtons = this.modal.querySelectorAll('[data-modal-tab]');
        this.tabContents = this.modal.querySelectorAll('[data-tab-content]');
        this.loginForm = this.modal.querySelector('#loginForm');
        this.registerForm = this.modal.querySelector('#registerForm');
        this.errorContainer = this.modal.querySelector('.error-container');
        
        // Initialiser les onglets et les formulaires
        this.initTabs();
        this.initForms();
    }
    
    /**
     * Initialise les onglets
     */
    initTabs() {
        this.tabButtons.forEach(tab => {
            tab.addEventListener('click', () => {
                this.switchTab(tab.dataset.modalTab);
            });
        });
        
        // Activer l'onglet de connexion par défaut
        this.switchTab('login');
    }
    
    /**
     * Change d'onglet
     */
    switchTab(tabName) {
        // Mettre à jour les onglets
        this.tabButtons.forEach(tab => {
            if (tab.dataset.modalTab === tabName) {
                tab.classList.add('bg-black', 'text-white');
                tab.classList.remove('text-gray-600', 'border', 'border-black');
            } else {
                tab.classList.remove('bg-black', 'text-white');
                tab.classList.add('text-gray-600', 'border', 'border-black');
            }
        });
        
        // Afficher le contenu correspondant
        this.tabContents.forEach(content => {
            if (content.dataset.tabContent === tabName) {
                content.classList.remove('hidden');
            } else {
                content.classList.add('hidden');
            }
        });
        
        // Effacer les erreurs lors du changement d'onglet
        this.clearError();
    }
    
    /**
     * Initialise les formulaires
     */
    initForms() {
        if (this.loginForm) {
            this.loginForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleLogin();
            });
        }
        
        if (this.registerForm) {
            this.registerForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleRegister();
            });
        }
    }
    
    /**
     * Gère la soumission du formulaire de connexion
     */
    async handleLogin() {
        const formData = new FormData(this.loginForm);
        
        try {
            const response = await fetch('/hexashop-1.0.0/login.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                window.location.reload();
            } else {
                this.showError(data.message || 'Erreur de connexion');
            }
        } catch (error) {
            this.showError('Une erreur est survenue');
            console.error('Erreur de connexion:', error);
        }
    }
    
    /**
     * Gère la soumission du formulaire d'inscription
     */
    async handleRegister() {
        const formData = new FormData(this.registerForm);
        
        try {
            const response = await fetch('/hexashop-1.0.0/register.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                window.location.reload();
            } else {
                this.showError(data.message || 'Erreur d\'inscription');
            }
        } catch (error) {
            this.showError('Une erreur est survenue');
            console.error('Erreur d\'inscription:', error);
        }
    }
    
    /**
     * Affiche un message d'erreur
     */
    showError(message) {
        if (this.errorContainer) {
            this.errorContainer.textContent = message;
            this.errorContainer.classList.remove('hidden');
        }
    }
    
    /**
     * Efface le message d'erreur
     */
    clearError() {
        if (this.errorContainer) {
            this.errorContainer.textContent = '';
            this.errorContainer.classList.add('hidden');
        }
    }
}

// Initialiser le modal d'authentification au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    new AuthModal();
});



