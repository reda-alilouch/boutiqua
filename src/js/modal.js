/**
 * Modal.js - Gestion de base des modals
 * Ce script fournit les fonctionnalités de base pour l'ouverture/fermeture des modals
 */

class ModalManager {
    constructor() {
        this.activeModals = new Set();
    }

    /**
     * Initialise tous les modals de la page
     */
    init() {
        // Sélectionner tous les éléments avec l'attribut data-modal
        const modals = document.querySelectorAll('[data-modal]');
        
        // Initialiser chaque modal
        modals.forEach(modal => {
            // Trouver tous les boutons qui ouvrent ce modal
            const modalId = modal.id;
            const openButtons = document.querySelectorAll(`[data-modal-toggle="${modalId}"]`);
            const closeButtons = document.querySelectorAll(`[data-modal-hide="${modalId}"]`);
            
            // Ajouter les écouteurs d'événements pour ouvrir le modal
            openButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.openModal(modal);
                });
            });
            
            // Ajouter les écouteurs d'événements pour fermer le modal
            closeButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.closeModal(modal);
                });
            });
            
            // Fermer en cliquant en dehors du contenu du modal
            modal.addEventListener('click', (e) => {
                // Vérifier si le clic est sur le fond du modal et non sur son contenu
                if (e.target === modal) {
                    this.closeModal(modal);
                }
            });
        });

        // Initialiser les onglets dans les modals
        this.initTabs();
        
        // Fermer avec Échap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.activeModals.size > 0) {
                const lastModal = Array.from(this.activeModals).pop();
                this.closeModal(lastModal);
            }
        });
    }

    /**
     * Initialise les onglets dans les modals
     */
    initTabs() {
        const tabButtons = document.querySelectorAll('[data-modal-tab]');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabName = button.dataset.modalTab;
                const tabContainer = button.closest('[data-modal]');
                
                if (tabContainer) {
                    this.switchTab(tabContainer, tabName);
                }
            });
        });
    }

    /**
     * Change d'onglet dans un modal
     * @param {HTMLElement} modal - L'élément modal
     * @param {string} tabName - Le nom de l'onglet à afficher
     */
    switchTab(modal, tabName) {
        // Mettre à jour les boutons d'onglets
        const tabButtons = modal.querySelectorAll('[data-modal-tab]');
        tabButtons.forEach(tab => {
            if (tab.dataset.modalTab === tabName) {
                tab.classList.add('bg-black', 'text-white');
                tab.classList.remove('text-gray-600', 'border', 'border-black', 'text-black');
            } else {
                tab.classList.remove('bg-black', 'text-white');
                tab.classList.add('text-gray-600', 'border', 'border-black', 'text-black');
            }
        });
        
        // Afficher le contenu correspondant
        const tabContents = modal.querySelectorAll('[data-tab-content]');
        tabContents.forEach(content => {
            if (content.dataset.tabContent === tabName) {
                content.classList.remove('hidden');
            } else {
                content.classList.add('hidden');
            }
        });
    }

    /**
     * Ouvre un modal avec animation
     * @param {HTMLElement} modal - L'élément modal à ouvrir
     */
    openModal(modal) {
        // Empêcher le défilement de la page
        document.body.style.overflow = 'hidden';
        
        // Afficher le modal
        modal.classList.remove('hidden');
        
        // Ajouter une petite temporisation pour l'animation
        setTimeout(() => {
            modal.classList.add('opacity-100');
            const modalContent = modal.querySelector('.modal-content');
            if (modalContent) {
                modalContent.classList.add('opacity-100', 'scale-100');
            }
        }, 10);
        
        // Ajouter à la liste des modals actifs
        this.activeModals.add(modal);
    }

    /**
     * Ferme un modal avec animation
     * @param {HTMLElement} modal - L'élément modal à fermer
     */
    closeModal(modal) {
        // Retirer les classes d'opacité pour l'animation de fermeture
        modal.classList.remove('opacity-100');
        const modalContent = modal.querySelector('.modal-content');
        if (modalContent) {
            modalContent.classList.remove('opacity-100', 'scale-100');
        }
        
        // Attendre la fin de l'animation avant de cacher complètement
        setTimeout(() => {
            modal.classList.add('hidden');
            
            // Restaurer le défilement si aucun modal n'est actif
            this.activeModals.delete(modal);
            if (this.activeModals.size === 0) {
                document.body.style.overflow = '';
            }
        }, 300);
    }
}

// Initialiser les modaux au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    // Créer et initialiser le gestionnaire de modals
    const modalManager = new ModalManager();
    modalManager.init();

    // Exposer le gestionnaire de modals globalement
    window.modalManager = modalManager;
});