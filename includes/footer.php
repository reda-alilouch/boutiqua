<footer class="py-16 text-white bg-primary" id="footer">
      <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
          <!-- Logo and Contact -->
          <div>
            <div class="mb-6">
              <img
                src="assets/images/white-logo.png"
                alt="hexashop ecommerce templatemo"
                class="h-12"
              />
            </div>
            <ul class="space-y-4">
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  16501 Collins Ave, Sunny Isles Beach, FL 33160, United States
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  hexashop@company.com
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  010-020-0340
                </a>
              </li>
            </ul>
          </div>

          <!-- Shopping Categories -->
          <div>
            <h4 class="mb-6 text-lg font-semibold">
              Shopping &amp; Categories
            </h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  Men's Shopping
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  Women's Shopping
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  Kid's Shopping
                </a>
              </li>
            </ul>
          </div>

          <!-- Useful Links -->
          <div>
            <h4 class="mb-6 text-lg font-semibold">Useful Links</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  Homepage
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  About Us
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  Help
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  Contact Us
                </a>
              </li>
            </ul>
          </div>

          <!-- Help & Information -->
          <div>
            <h4 class="mb-6 text-lg font-semibold">Help &amp; Information</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  Help
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  FAQ's
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  Shipping
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 transition-colors hover:text-white"
                >
                  Tracking ID
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    
    <!-- Scripts JS -->
    <script src="assets/js/main.js"></script>
    
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