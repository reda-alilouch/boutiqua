/**
 * SearchModal.js - Gestion du modal de recherche
 * Étend la classe Modal de base avec des fonctionnalités de recherche
 */

class SearchModal extends Modal {
    constructor() {
        super('searchModal');
        
        // Éléments spécifiques à la recherche
        this.searchInput = this.modal.querySelector('input[type="search"]');
        this.searchResults = this.modal.querySelector('.search-results');
        
        // Initialiser les événements de recherche
        this.initSearchEvents();
    }
    
    initSearchEvents() {
        // Gérer la saisie de recherche
        this.searchInput.addEventListener('input', () => {
            this.handleSearch();
        });
        
        // Focus sur l'input à l'ouverture
        const openButtons = document.querySelectorAll('[data-modal-toggle="searchModal"]');
        openButtons.forEach(button => {
            button.addEventListener('click', () => {
                setTimeout(() => {
                    this.searchInput.focus();
                }, 100);
            });
        });
        
        // Nettoyer la recherche à la fermeture
        const closeButtons = document.querySelectorAll('[data-modal-hide="searchModal"]');
        closeButtons.forEach(button => {
            button.addEventListener('click', () => {
                this.clearSearch();
            });
        });
    }

    /**
     * Gère la recherche en temps réel
     */
    handleSearch() {
        const query = this.searchInput.value.trim();
        
        if (query.length > 0) {
            // Simuler une recherche (à remplacer par votre logique de recherche)
            this.showResults(`<div class="p-4">
                <p class="text-gray-600">Recherche en cours pour "${query}"...</p>
                <div class="mt-4 space-y-2">
                    <div class="p-2 hover:bg-gray-100 rounded cursor-pointer">Résultat 1</div>
                    <div class="p-2 hover:bg-gray-100 rounded cursor-pointer">Résultat 2</div>
                    <div class="p-2 hover:bg-gray-100 rounded cursor-pointer">Résultat 3</div>
                </div>
            </div>`);
        } else {
            this.clearSearch();
        }
    }
    
    /**
     * Affiche les résultats de recherche
     */
    showResults(results) {
        if (this.searchResults) {
            this.searchResults.innerHTML = results;
            this.searchResults.classList.remove('hidden');
        }
    }
    
    /**
     * Nettoie la recherche
     */
    clearSearch() {
        this.searchInput.value = '';
        if (this.searchResults) {
            this.searchResults.innerHTML = '';
            this.searchResults.classList.add('hidden');
        }
    }
    
    /**
     * Surcharge la méthode close pour nettoyer la recherche
     */
    close() {
        super.close();
        this.clearSearch();
    }
}

// Initialiser le modal de recherche au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    new SearchModal();
});