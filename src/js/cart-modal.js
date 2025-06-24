/**
 * CartModal.js - Gestion du modal du panier
 */

document.addEventListener('DOMContentLoaded', function() {
    class CartModal {
        constructor() {
            this.modal = document.getElementById('cartModal');
            this.cartItems = [];
            this.init();
        }

        init() {
            // Initialiser les événements
            this.initEvents();
            this.loadCartItems();
        }

        initEvents() {
            // Ouvrir le modal
            const openButtons = document.querySelectorAll('[data-modal-toggle="cartModal"]');
            openButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.openModal();
                });
            });

            // Fermer le modal
            const closeButtons = document.querySelectorAll('[data-modal-hide="cartModal"]');
            closeButtons.forEach(button => {
                button.addEventListener('click', () => this.closeModal());
            });

            // Fermer en cliquant en dehors
            this.modal.addEventListener('click', (e) => {
                if (e.target === this.modal) {
                    this.closeModal();
                }
            });

            // Gérer les quantités
            const quantityInputs = this.modal.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('change', (e) => {
                    const itemId = e.target.dataset.itemId;
                    const quantity = parseInt(e.target.value);
                    this.updateQuantity(itemId, quantity);
                });
            });

            // Supprimer des articles
            const removeButtons = this.modal.querySelectorAll('.remove-item');
            removeButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const itemId = e.target.dataset.itemId;
                    this.removeItem(itemId);
                });
            });
        }

        openModal() {
            document.body.style.overflow = 'hidden';
            this.modal.classList.remove('hidden');
            setTimeout(() => {
                this.modal.classList.add('opacity-100');
                this.modal.querySelector('.modal-content').classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        closeModal() {
            this.modal.classList.remove('opacity-100');
            this.modal.querySelector('.modal-content').classList.remove('opacity-100', 'scale-100');
            setTimeout(() => {
                this.modal.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        loadCartItems() {
            // Charger les articles du panier (à implémenter selon votre logique)
            this.updateCartDisplay();
        }

        updateQuantity(itemId, quantity) {
            // Mettre à jour la quantité d'un article (à implémenter)
            this.updateCartDisplay();
        }

        removeItem(itemId) {
            // Supprimer un article du panier (à implémenter)
            this.updateCartDisplay();
        }

        updateCartDisplay() {
            // Mettre à jour l'affichage du panier (à implémenter)
            const cartContent = this.modal.querySelector('.cart-content');
            if (this.cartItems.length === 0) {
                cartContent.innerHTML = '<p class="text-center py-4">Votre panier est vide</p>';
            } else {
                // Afficher les articles du panier
            }
        }
    }

    // Initialiser le modal du panier
    const cartModal = new CartModal();
});