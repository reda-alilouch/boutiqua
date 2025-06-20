document.addEventListener('DOMContentLoaded', function() {
        // Gestion de la modale
        const authModal = document.getElementById('authModal');
        const openModalButtons = document.querySelectorAll('[data-modal-toggle="authModal"]');
        const closeModalButtons = document.querySelectorAll('[data-modal-hide="authModal"]');
        const modalTabs = document.querySelectorAll('[data-modal-tab]');
        const tabContents = document.querySelectorAll('[data-tab-content]');
        let isModalOpen = false;

        // Fonctions utilitaires
        function toggleModal() {
            isModalOpen = !isModalOpen;
            if (isModalOpen) {
                document.body.style.overflow = 'hidden';
                authModal.classList.remove('hidden');
                setTimeout(() => {
                    authModal.classList.add('opacity-100');
                    authModal.querySelector('.modal-content').classList.add('opacity-100', 'scale-100');
                }, 10);
            } else {
                authModal.classList.remove('opacity-100');
                authModal.querySelector('.modal-content').classList.remove('opacity-100', 'scale-100');
                setTimeout(() => {
                    authModal.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        function switchTab(tabName) {
            // Mettre à jour les onglets
            modalTabs.forEach(tab => {
        if (tab.dataset.modalTab === tabName) {
            tab.classList.add('bg-black', 'text-white');
            tab.classList.remove('text-gray-600', 'border', 'border-black', 'text-black');
        } else {
            tab.classList.remove('bg-black', 'text-white');
            tab.classList.add('text-gray-600', 'border', 'border-black', 'text-black');
        }
    });

            // Afficher le contenu correspondant
            tabContents.forEach(content => {
                if (content.dataset.tabContent === tabName) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        }


        // Événements
        openModalButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                toggleModal();
            });
        });

        closeModalButtons.forEach(button => {
            button.addEventListener('click', toggleModal);
        });

        modalTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                switchTab(tab.dataset.modalTab);
            });
        });

        // Fermer en cliquant en dehors
        authModal.addEventListener('click', (e) => {
            if (e.target === authModal) {
                toggleModal();
            }
        });

        // Fermer avec la touche Échap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isModalOpen) {
                toggleModal();
            }
        });

        // Initialisation
        switchTab('login');
    });



