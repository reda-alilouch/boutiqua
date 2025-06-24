<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo et description -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center mb-4">
                    <img src="src/images/white-logo.png" alt="Hexashop" class="h-8 w-auto">
                </div>
                <p class="text-gray-400 mb-6 max-w-md">
                    Hexashop est votre destination de confiance pour tous vos besoins de mode. 
                    Nous proposons une large gamme de produits de qualité à des prix compétitifs.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Liens rapides -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                <ul class="space-y-2">
                    <li><a href="/hexashop-1.0.0/index.php" class="text-gray-400 hover:text-white transition-colors">Accueil</a></li>
                    <li><a href="/hexashop-1.0.0/products.php" class="text-gray-400 hover:text-white transition-colors">Produits</a></li>
                    <li><a href="/hexashop-1.0.0/about.php" class="text-gray-400 hover:text-white transition-colors">À propos</a></li>
                    <li><a href="/hexashop-1.0.0/contact.php" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Support</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Aide</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Livraison</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Retours</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                </ul>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="mt-12 pt-8 border-t border-gray-800">
            <div class="max-w-md">
                <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                <p class="text-gray-400 mb-4">Inscrivez-vous pour recevoir nos dernières offres et nouveautés.</p>
                <form class="flex">
                    <input type="email" placeholder="Votre email" 
                           class="flex-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700 transition-colors">
                        S'inscrire
                    </button>
                </form>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400">
            <p>&copy; 2024 Hexashop. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="src/js/main.js"></script>

<!-- Initialisation d'Alpine.js -->
<script>
    document.addEventListener('alpine:init', () => {
        // Vérifier si le store modal existe déjà
        if (!Alpine.store('modal')) {
            Alpine.store('modal', {
                auth: false,
                authTab: 'login',
                searchOpen: false,
                loginForm: {
                    email: '',
                    password: '',
                    remember: false
                },
                registerForm: {
                    firstname: '',
                    lastname: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false
                },
                toggleAuth() {
                    this.auth = !this.auth;
                    if (this.auth) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = '';
                    }
                },
                toggleSearch() {
                    this.searchOpen = !this.searchOpen;
                    if (this.searchOpen) {
                        document.body.style.overflow = 'hidden';
                        setTimeout(() => document.querySelector('#search-input')?.focus(), 100);
                    } else {
                        document.body.style.overflow = '';
                    }
                },
                setAuthTab(tab) {
                    this.authTab = tab;
                },
                login() {
                    // Simulation de connexion
                    console.log('Tentative de connexion avec:', this.loginForm);
                    // Ici, vous pourriez ajouter un appel AJAX pour la connexion réelle
                    setTimeout(() => {
                        // Simulation de succès de connexion
                        Alpine.store('auth', {
                            isAuthenticated: true,
                            user: {
                                name: this.loginForm.email.split('@')[0],
                                email: this.loginForm.email
                            }
                        });
                        this.closeAll();
                    }, 1000);
                },
                register() {
                    // Simulation d'inscription
                    console.log('Tentative d\'inscription avec:', this.registerForm);
                    // Ici, vous pourriez ajouter un appel AJAX pour l'inscription réelle
                    setTimeout(() => {
                        // Simulation de succès d'inscription
                        this.authTab = 'login';
                        this.loginForm.email = this.registerForm.email;
                        this.loginForm.password = this.registerForm.password;
                        // Réinitialiser le formulaire
                        this.registerForm = {
                            firstname: '',
                            lastname: '',
                            email: '',
                            password: '',
                            password_confirmation: '',
                            terms: false
                        };
                    }, 1000);
                },
                closeAll() {
                    this.auth = false;
                    this.searchOpen = false;
                    document.body.style.overflow = '';
                }
            });
        }

        // Initialiser l'état d'authentification s'il n'existe pas
        if (!Alpine.store('auth')) {
            Alpine.store('auth', {
                isAuthenticated: false,
                user: null,
                login(userData) {
                    this.isAuthenticated = true;
                    this.user = userData;
                },
                logout() {
                    this.isAuthenticated = false;
                    this.user = null;
                    // Rediriger vers la page d'accueil ou de connexion si nécessaire
                    // window.location.href = 'index.php';
                }
            });
        }
        
        // Initialiser les tooltips
        if (typeof tippy === 'function') {
            tippy('[data-tippy-content]', {
                theme: 'light-border',
                animation: 'scale',
                duration: 200,
                arrow: true,
                arrowType: 'round',
                delay: [100, 0]
            });
        }
    });
    
    // Gestion du chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        // Masquer le preloader
        const preloader = document.getElementById('preloader');
        if (preloader) {
            setTimeout(() => {
                preloader.classList.add('hidden');
            }, 500);
        }
        
        // Initialiser les tooltips
        if (typeof tippy === 'function') {
            tippy('[data-tippy-content]', {
                theme: 'light-border',
                animation: 'scale',
                duration: 200,
                arrow: true,
                arrowType: 'round',
                delay: [100, 0]
            });
        }
    });
</script>
</body>
</html>