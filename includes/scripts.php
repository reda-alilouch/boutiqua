<!-- Alpine.js et scripts personnalisés -->
<script>
// Initialisation d'Alpine.js et des composants
document.addEventListener('alpine:init', () => {
    // Store pour la gestion des modaux
    Alpine.store('modal', {
        search: false,
        auth: false,
        authTab: 'login',
        toggleSearch() {
            this.search = !this.search;
            if (this.search) this.auth = false;
            // Empêcher le défilement du body quand un modal est ouvert
            document.body.style.overflow = this.search ? 'hidden' : '';
        },
        toggleAuth() {
            this.auth = !this.auth;
            if (this.auth) this.search = false;
            // Empêcher le défilement du body quand un modal est ouvert
            document.body.style.overflow = this.auth ? 'hidden' : '';
        },
        setAuthTab(tab) {
            this.authTab = tab;
        },
        closeAll() {
            this.search = false;
            this.auth = false;
            document.body.style.overflow = '';
        }
    });

    // Store pour l'authentification
    Alpine.store('auth', {
        user: null,
        isAuthenticated: false,
        login(email, password) {
            // Simulation de connexion
            return new Promise((resolve) => {
                setTimeout(() => {
                    this.user = { email };
                    this.isAuthenticated = true;
                    Alpine.store('modal').closeAll();
                    resolve(true);
                }, 1000);
            });
        },
        register(userData) {
            // Simulation d'inscription
            return new Promise((resolve) => {
                setTimeout(() => {
                    this.user = userData;
                    this.isAuthenticated = true;
                    Alpine.store('modal').closeAll();
                    resolve(true);
                }, 1000);
            });
        },
        logout() {
            this.user = null;
            this.isAuthenticated = false;
        }
    });
});

// Initialisation des composants au chargement du DOM
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation AOS (Animate On Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-out-cubic',
            offset: 50,
            delay: 0
        });
    }


    // Masquer le preloader une fois la page chargée
    const preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.classList.add('hidden');
            document.body.style.overflow = 'auto';
            
            // Supprimer le preloader du DOM après l'animation
            setTimeout(() => {
                preloader.remove();
            }, 500);
        }, 500);
    }

    // Gestion de la fermeture des modaux avec la touche ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            Alpine.store('modal').closeAll();
        }
    });

    // Fermer les modaux en cliquant à l'extérieur
    document.addEventListener('click', (e) => {
        const modal = document.querySelector('.modal-container');
        if (modal && !modal.contains(e.target) && 
            (Alpine.store('modal').search || Alpine.store('modal').auth)) {
            Alpine.store('modal').closeAll();
        }
    });
});
</script>

<!-- Scripts personnalisés -->
<script src="assets/js/modals.js" defer></script>
