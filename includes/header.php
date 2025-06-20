<?php
/**
 * En-tête principal du site avec navigation et modaux d'authentification
 * 
 * @package HexaShop
 * @version 1.0.0
 */
?>
<header class="fixed top-0 left-0 z-50 w-full h-16 md:h-20 bg-white/95 backdrop-blur-sm shadow-sm" 
        x-data="{ 
          mobileMenuOpen: false,
          scrolled: false,
          init() {
            // Détecter le défilement pour l'effet de réduction du header
            window.addEventListener('scroll', () => {
              this.scrolled = window.scrollY > 10;
            });
          }
        }"
        :class="{ 'h-14 md:h-16 transition-all duration-300': scrolled }">
      <div class="container px-4 mx-auto w-full">
        <nav class="flex justify-between items-center w-full h-16 md:h-20">
          <!-- Mobile Menu Button -->
          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            :aria-expanded="mobileMenuOpen"
            class="p-2 mr-2 text-gray-600 rounded-md lg:hidden hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            aria-label="Toggle menu"
            aria-controls="mainMenu"
          >
            <svg class="w-6 h-6 menu-open-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg class="hidden w-6 h-6 menu-close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>

          <!-- Logo -->
          <a href="index.php" class="flex-shrink-0 mx-auto md:mx-0">
            <img src="assets/images/logoo.png" class="w-auto h-10 md:h-12" alt="Hexashop Logo" />
          </a>

          <!-- Main Menu -->
          <div 
            class="absolute left-0 right-0 z-40 w-full px-4 py-6 mt-4 bg-white shadow-lg lg:relative lg:mt-0 lg:shadow-none lg:flex lg:items-center lg:p-0 lg:bg-transparent" 
            :class="{'block': mobileMenuOpen, 'hidden': !mobileMenuOpen}" 
            id="mainMenu"
            @click.away="mobileMenuOpen = false"
          >
            <nav class="flex flex-col lg:flex-row lg:space-x-1 xl:space-x-2" aria-label="Main navigation">
              <a href="index.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname === '/index.php' || window.location.pathname === '/' ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>Home</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname === '/index.php' || window.location.pathname === '/'" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
              
              <a href="single-product.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname.includes('single-product.php') ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>Single Product</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname.includes('single-product.php')" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
              
              <a href="products.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname.includes('products.php') ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>Products</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname.includes('products.php')" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
              
              <a href="contact.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname.includes('contact.php') ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>Contact Us</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname.includes('contact.php')" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
              
              <a href="about.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname.includes('about.php') ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>About Us</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname.includes('about.php')" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
            </nav>
          </div>

          <!-- Icons de navigation -->
          <div class="flex items-center space-x-2 sm:space-x-3 md:space-x-4" role="navigation" aria-label="Navigation secondaire">
            <!-- Search Icon -->
            <button 
              @click="$store.modal.toggleSearch()" 
              class="p-2 text-gray-600 transition-all duration-200 rounded-full hover:bg-gray-100 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:scale-105"
              aria-label="Rechercher sur le site"
              aria-expanded="false"
              :aria-expanded="$store.modal.search"
            >
              <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
            
            <!-- Menu Utilisateur -->
            <div class="relative ml-4" x-data="{ isUserMenuOpen: false }" @keydown.escape.window="isUserMenuOpen = false">
              <button
                @click="isUserMenuOpen = !isUserMenuOpen"
                @keydown.space.enter.prevent="isUserMenuOpen = !isUserMenuOpen"
                @keydown.escape="isUserMenuOpen = false"
                class="flex items-center p-2 text-gray-700 hover:text-primary transition-colors rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                :aria-expanded="isUserMenuOpen"
                :aria-controls="'user-menu'"
              >
                <span class="sr-only">Ouvrir le menu utilisateur</span>
                <div class="relative">
                  <span class="flex items-center justify-center w-8 h-8 rounded-full" 
                        :class="$store.auth.isAuthenticated ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:text-primary'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                  </span>
                  <span x-show="$store.auth.isAuthenticated" 
                        class="absolute top-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"
                        aria-hidden="true"></span>
                </div>
              </button>
              
              <!-- Menu déroulant -->
              <div x-show="isUserMenuOpen" 
                   x-transition:enter="transition ease-out duration-100"
                   x-transition:enter-start="transform opacity-0 scale-95"
                   x-transition:enter-end="transform opacity-100 scale-100"
                   x-transition:leave="transition ease-in duration-75"
                   x-transition:leave-start="transform opacity-100 scale-100"
                   x-transition:leave-end="transform opacity-0 scale-95"
                   @click.away="isUserMenuOpen = false"
                   x-cloak
                   id="user-menu"
                   class="absolute right-0 z-[9999] mt-2 w-56 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                   role="menu"
                   aria-orientation="vertical"
                   aria-labelledby="user-menu-button"
                   tabindex="-1">
                <!-- État non connecté -->
                <template x-if="!$store.auth.isAuthenticated">
                  <div class="py-1.5" role="none">
                    <button
                      @click="$store.modal.setAuthTab('login'); $store.modal.toggleAuth(); isUserMenuOpen = false"
                      class="flex items-center w-full px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors duration-150"
                      role="menuitem"
                    >
                      <span class="flex items-center justify-center w-8 h-8 mr-3 rounded-full bg-primary/10 text-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                      </span>
                      <span>Se connecter</span>
                    </button>
                    <button
                      @click="$store.modal.setAuthTab('register'); $store.modal.toggleAuth(); isUserMenuOpen = false"
                      class="flex items-center w-full px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors duration-150 border-t border-gray-100"
                      role="menuitem"
                    >
                      <span class="flex items-center justify-center w-8 h-8 mr-3 rounded-full bg-accent/10 text-accent">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                      </span>
                      <span>Créer un compte</span>
                    </button>
                  </div>
                </template>
                
                <!-- État connecté -->
                <template x-if="$store.auth.isAuthenticated">
                  <div class="py-1.5" role="none">
                    <div class="px-4 py-3 border-b border-gray-100">
                      <p class="text-sm font-medium text-gray-900" x-text="$store.auth.user?.name || 'Mon compte'"></p>
                      <p class="text-xs text-gray-500 truncate" x-text="$store.auth.user?.email"></p>
                    </div>
                    <a href="#" class="flex items-center w-full px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary">
                      <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                      </svg>
                      Mon profil
                    </a>
                    <a href="#" class="flex items-center w-full px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary border-t border-gray-100">
                      <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                      Mes commandes
                    </a>
                    <button
                      @click="$store.auth.logout(); isUserMenuOpen = false"
                      class="flex items-center w-full px-4 py-3 mt-1 text-sm text-red-600 hover:bg-gray-50 hover:text-red-700 border-t border-gray-100"
                    >
                      <svg class="w-4 h-4 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                      </svg>
                      Déconnexion
                    </button>
                  </div>
                </template>
              </div>
            </div>
            
            <!-- Shopping Cart Icon -->
            <button 
              class="relative p-2 text-gray-600 transition-all duration-200 rounded-full hover:bg-gray-100 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:scale-105"
              aria-label="Mon compte"
              aria-expanded="false"
              :aria-expanded="$store.modal.auth"
              :aria-controls="$store.modal.auth ? 'auth-modal' : ''"
            >
              <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
              </svg>
              <span class="absolute flex items-center justify-center w-5 h-5 text-xs font-medium text-white bg-red-500 rounded-full -top-1 -right-1">3</span>
            </button>
          </div>
        </nav>
      </div>
    </header>

    <!-- Modale d'authentification -->
    <div x-show="$store.modal.auth" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
         @click.self="$store.modal.closeAll()">
         
        <div class="w-full max-w-md"
             x-show="$store.modal.auth"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4">
            
            <!-- Contenu de la modale -->
            <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden">
                <!-- Bouton de fermeture -->
                <button @click="$store.modal.closeAll()" 
                        class="absolute top-4 right-4 p-1 text-gray-400 hover:text-gray-500 transition-colors"
                        aria-label="Fermer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Onglets -->
                <div class="flex border-b border-gray-200">
                    <button @click="$store.modal.setAuthTab('login')"
                            :class="{
                                'text-primary border-b-2 border-primary': $store.modal.authTab === 'login',
                                'text-gray-500 hover:text-gray-700': $store.modal.authTab !== 'login'
                            }"
                            class="flex-1 py-4 px-6 text-center font-medium focus:outline-none transition-colors">
                        Connexion
                    </button>
                    <button @click="$store.modal.setAuthTab('register')"
                            :class="{
                                'text-primary border-b-2 border-primary': $store.modal.authTab === 'register',
                                'text-gray-500 hover:text-gray-700': $store.modal.authTab !== 'register'
                            }"
                            class="flex-1 py-4 px-6 text-center font-medium focus:outline-none transition-colors">
                        Inscription
                    </button>
                </div>

                <!-- Formulaire de connexion -->
                <div x-show="$store.modal.authTab === 'login'" class="p-6">
                    <h2 class="mb-6 text-2xl font-bold text-gray-900">Connexion</h2>
                    <form @submit.prevent="$store.modal.login()" class="space-y-4">
                        <div>
                            <label for="login-email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="login-email" x-model="$store.modal.loginForm.email"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   required>
                        </div>
                        <div>
                            <label for="login-password" class="block mb-2 text-sm font-medium text-gray-700">Mot de passe</label>
                            <input type="password" id="login-password" x-model="$store.modal.loginForm.password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   required>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" type="checkbox"
                                       class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary"
                                       x-model="$store.modal.loginForm.remember">
                                <label for="remember-me" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                            </div>
                            <a href="#" class="text-sm text-primary hover:underline">Mot de passe oublié ?</a>
                        </div>
                        <button type="submit"
                                class="w-full py-3 px-4 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Se connecter
                        </button>
                    </form>
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Ou continuez avec</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-6">
                            <button type="button"
                                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.666,14.861,2,12,2C6.477,2,2,6.477,2,12s4.477,10,10,10c8.396,0,10-7.71,10-10c0-0.61-0.043-1.229-0.129-1.839C21.563,10.922,21,11.518,21,12.228v0.01H12.545z" />
                                </svg>
                                Google
                            </button>
                            <button type="button"
                                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343,21.128,22,16.991,22,12z" />
                                </svg>
                                Facebook
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Formulaire d'inscription -->
                <div x-show="$store.modal.authTab === 'register'" class="p-6">
                    <h2 class="mb-6 text-2xl font-bold text-gray-900">Créer un compte</h2>
                    <form @submit.prevent="$store.modal.register()" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="register-firstname" class="block mb-2 text-sm font-medium text-gray-700">Prénom</label>
                                <input type="text" id="register-firstname" x-model="$store.modal.registerForm.firstname"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                       required>
                            </div>
                            <div>
                                <label for="register-lastname" class="block mb-2 text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" id="register-lastname" x-model="$store.modal.registerForm.lastname"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                       required>
                            </div>
                        </div>
                        <div>
                            <label for="register-email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="register-email" x-model="$store.modal.registerForm.email"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   required>
                        </div>
                        <div>
                            <label for="register-password" class="block mb-2 text-sm font-medium text-gray-700">Mot de passe</label>
                            <input type="password" id="register-password" x-model="$store.modal.registerForm.password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   required>
                        </div>
                        <div>
                            <label for="register-password-confirm" class="block mb-2 text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                            <input type="password" id="register-password-confirm" x-model="$store.modal.registerForm.password_confirmation"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   required>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" type="checkbox" x-model="$store.modal.registerForm.terms"
                                       class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary"
                                       required>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-700">J'accepte les <a href="#" class="text-primary hover:underline">conditions d'utilisation</a></label>
                            </div>
                        </div>
                        <button type="submit"
                                class="w-full py-3 px-4 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            S'inscrire
                        </button>
                    </form>
                    <p class="mt-4 text-sm text-center text-gray-600">
                        Vous avez déjà un compte ?
                        <button @click="$store.modal.setAuthTab('login')" class="font-medium text-primary hover:underline">
                            Connectez-vous
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de recherche -->
   

    <!-- Auth Modal -->
    <div x-show="$store.modal.auth" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[9999] flex items-start justify-center pt-16 pb-10 overflow-y-auto bg-black/50 backdrop-blur-sm"
         x-cloak
         @click.self="$store.modal.toggleAuth()"
         @keydown.window.escape="$store.modal.toggleAuth()"
         role="dialog"
         aria-modal="true"
         :aria-label="$store.modal.authTab === 'login' ? 'Connexion' : 'Inscription'">
      <div class="relative px-6 mx-auto mt-8 w-full max-w-md" @click.stop>
        <!-- Modal Content -->
        <div class="overflow-hidden bg-white rounded-2xl border border-gray-100 shadow-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4">
             
          <!-- Close Button -->
          <button @click="$store.modal.toggleAuth()" 
                  class="absolute top-4 right-4 p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 z-10"
                  aria-label="Fermer la fenêtre">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          
          <!-- Decorative Elements -->
          <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary to-accent"></div>
          
          <!-- Decorative Elements -->
          <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary to-accent"></div>
          
          <div class="p-8">
            <!-- Tabs Navigation -->
            <div class="flex mb-8 border-b border-gray-200" role="tablist" aria-label="Navigation d'authentification">
              <button @click="$store.modal.setAuthTab('login')"
                      :class="{
                        'text-primary border-primary': $store.modal.authTab === 'login',
                        'text-gray-500 border-transparent hover:text-gray-700': $store.modal.authTab !== 'login'
                      }"
                      class="flex-1 py-4 font-medium text-center border-b-2 transition-all duration-300 focus:outline-none"
                      :aria-selected="$store.modal.authTab === 'login'"
                      role="tab"
                      aria-controls="login-tabpanel"
                      id="login-tab">
                <span class="inline-flex items-center">
                  <i class="mr-2 fa fa-sign-in"></i>
                  Connexion
                </span>
              </button>
              <button @click="$store.modal.setAuthTab('register')"
                      :class="{
                        'text-primary border-primary': $store.modal.authTab === 'register',
                        'text-gray-500 border-transparent hover:text-gray-700': $store.modal.authTab !== 'register'
                      }"
                      class="flex-1 py-4 font-medium text-center border-b-2 transition-all duration-300 focus:outline-none"
                      :aria-selected="$store.modal.authTab === 'register'"
                      role="tab"
                      aria-controls="register-tabpanel"
                      id="register-tab">
                <span class="inline-flex items-center">
                  <i class="mr-2 fa fa-user-plus"></i>
                  Inscription
                </span>
              </button>
            </div>

            <!-- Logo & Header -->
            <div class="mb-8 text-center"
                 x-show="true"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0">
              <div class="relative inline-flex items-center justify-center w-16 h-16 mx-auto mb-4 overflow-hidden bg-primary/5 rounded-2xl">
                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                  <path x-show="$store.modal.authTab === 'login'" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                  <path x-show="$store.modal.authTab === 'register'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
              </div>
              <h2 class="text-2xl font-bold text-gray-900" x-text="$store.modal.authTab === 'login' ? 'Content de vous revoir !' : 'Rejoignez-nous'"></h2>
              <p class="mt-2 text-gray-500" x-text="$store.modal.authTab === 'login' ? 'Connectez-vous pour accéder à votre compte' : 'Créez votre compte en quelques secondes'"></p>
            </div>

            <!-- Social Login -->
            <div class="mb-6"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0">
              <div class="grid grid-cols-2 gap-3">
                <button @click="" 
                        class="flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                        aria-label="Se connecter avec Google">
                  <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                  </svg>
                  <span>Google</span>
                </button>
                <button @click="" 
                        class="flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                        aria-label="Se connecter avec Facebook">
                  <svg class="w-5 h-5 mr-2 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                  </svg>
                  <span>Facebook</span>
                </button>
              </div>
              <div class="relative mt-6">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                  <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                  <span class="px-2 text-gray-500 bg-white">Ou continuez avec</span>
                </div>
              </div>
            </div>    <span class="inline-flex relative items-center">
                  <i class="mr-2 opacity-75 fa fa-sign-in"></i>
                  Sign In
                </span>
              </button>
              <button @click="$store.modal.setAuthTab('register')"
                      class="flex-1 py-3 font-medium text-center text-gray-500 border-b-2 border-transparent transition-all duration-300 hover:text-gray-900">
                <span class="inline-flex relative items-center">
                  <i class="mr-2 opacity-75 fa fa-user-plus"></i>
                  Sign Up
                </span>
              </button>
            </div>

            <!-- Login Form -->
            <div x-show="$store.modal.authTab === 'login'"
                 id="login-tabpanel"
                 role="tabpanel"
                 tabindex="0"
                 aria-labelledby="login-tab"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 class="space-y-6">
              <form @submit.prevent="$store.auth.login()" class="space-y-6">
                <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                  <label for="login-email" class="block mb-2 text-sm font-medium text-gray-900">Adresse email</label>
                  <div class="relative">
                    <i class="absolute left-4 top-1/2 text-gray-400 transition-all duration-300 -translate-y-1/2 fa fa-envelope group-focus-within:text-primary"></i>
                    <input type="email" 
                           id="login-email"
                           name="email"
                           required
                           class="py-3 pr-4 pl-11 w-full bg-gray-50 rounded-xl border-0 transition-all duration-300 focus:ring-2 focus:ring-primary/20 focus:outline-none focus:bg-white"
                           placeholder="votre@email.com"
                           autocomplete="email">
                  </div>
                </div>
                
                <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                  <div class="flex justify-between items-center mb-2">
                    <label for="login-password" class="block text-sm font-medium text-gray-900">Mot de passe</label>
                    <a href="#" class="text-sm text-primary hover:underline focus:outline-none focus:ring-2 focus:ring-primary/20 rounded">Mot de passe oublié ?</a>
                    <i @click="showPassword = !showPassword" :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'" class="absolute right-3 top-1/2 text-gray-400 cursor-pointer -translate-y-1/2"></i>
                  </div>
                  <div class="relative">
                    <i class="absolute left-4 top-1/2 text-gray-400 transition-all duration-300 -translate-y-1/2 fa fa-lock group-focus-within:text-primary"></i>
                    <input type="password" 
                           id="login-password"
                           name="password"
                           required
                           class="py-3 pr-4 pl-11 w-full bg-gray-50 rounded-xl border-0 transition-all duration-300 focus:ring-2 focus:ring-primary/20 focus:outline-none focus:bg-white"
                           placeholder="••••••••"
                           autocomplete="current-password">
                  </div>
                </div>
                
                <div class="flex items-center">
                  <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary/50">
                    <label for="remember-me" class="block ml-2 text-sm text-gray-700 cursor-pointer hover:text-gray-900">
                      Se souvenir de moi
                    </label>
                  </div>
                </div>
                
                <button type="submit" 
                        class="w-full py-3 px-4 bg-primary text-white rounded-xl transition-all duration-300 hover:bg-primary/90 hover:shadow-lg transform hover:scale-[1.01] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50 flex items-center justify-center">
                  <span class="inline-flex items-center">
                    <i class="mr-2 fa fa-sign-in"></i>
                    Se connecter
                  </span>
                </button>
              </form>

              <!-- Social Login -->
              <div class="relative mt-8 text-center">
                <span class="relative z-10 px-2 text-sm text-gray-500 bg-white">Or continue with</span>
                <div class="absolute left-0 top-1/2 w-full h-px bg-gray-200 -z-1"></div>
              </div>
              <div class="grid grid-cols-2 gap-4 mt-4">
                <button class="flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl transition-all duration-300 hover:bg-gray-50 hover:border-gray-300 transform hover:scale-[1.01] group">
                  <img src="assets/images/google.png" alt="Google" class="mr-2 w-5 h-5 transition-transform duration-300 group-hover:scale-110">
                  <span class="text-sm font-medium text-gray-600 transition-colors duration-300 group-hover:text-gray-900">Google</span>
                </button>
                <button class="flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl transition-all duration-300 hover:bg-gray-50 hover:border-gray-300 transform hover:scale-[1.01] group">
                  <img src="assets/images/facebook.png" alt="Facebook" class="mr-2 w-5 h-5 transition-transform duration-300 group-hover:scale-110">
                  <span class="text-sm font-medium text-gray-600 transition-colors duration-300 group-hover:text-gray-900">Facebook</span>
                </button>
              </div>
            </div>

            <!-- Register Form -->
            <div x-show="$store.modal.authTab === 'register'"
                 id="register-tabpanel"
                 role="tabpanel"
                 tabindex="0"
                 aria-labelledby="register-tab"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 class="space-y-6">
              <form @submit.prevent="$store.modal.register()" class="space-y-6" novalidate aria-label="Formulaire d'inscription">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                    <label for="register-firstname" class="block mb-2 text-sm font-medium text-gray-900">Prénom</label>
                    <div class="relative">
                      <i class="absolute left-4 top-1/2 text-gray-400 transition-all duration-300 -translate-y-1/2 fa fa-user group-focus-within:text-primary"></i>
                      <input type="text" 
                             id="register-firstname"
                             name="firstname"
                             required
                             class="py-3 pr-4 pl-11 w-full bg-gray-50 rounded-xl border-0 transition-all duration-300 focus:ring-2 focus:ring-primary/20 focus:outline-none focus:bg-white"
                             placeholder="Votre prénom"
                             autocomplete="given-name">
                    </div>
                  </div>
                  <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                    <label for="register-lastname" class="block mb-2 text-sm font-medium text-gray-900">Nom</label>
                    <div class="relative">
                      <i class="absolute left-4 top-1/2 text-gray-400 transition-all duration-300 -translate-y-1/2 fa fa-user group-focus-within:text-primary"></i>
                      <input type="text" 
                             id="register-lastname"
                             name="lastname"
                             required
                             class="py-3 pr-4 pl-11 w-full bg-gray-50 rounded-xl border-0 transition-all duration-300 focus:ring-2 focus:ring-primary/20 focus:outline-none focus:bg-white"
                             placeholder="Votre nom"
                             autocomplete="family-name">
                    </div>
                  </div>
                </div>

                <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                  <label for="register-email" class="block mb-2 text-sm font-medium text-gray-900">Adresse email</label>
                  <div class="relative">
                    <i class="absolute left-4 top-1/2 text-gray-400 transition-all duration-300 -translate-y-1/2 fa fa-envelope group-focus-within:text-primary"></i>
                    <input type="email" 
                           id="register-email"
                           name="email"
                           required
                           class="py-3 pr-4 pl-11 w-full bg-gray-50 rounded-xl border-0 transition-all duration-300 focus:ring-2 focus:ring-primary/20 focus:outline-none focus:bg-white"
                           placeholder="votre@email.com"
                           autocomplete="email">
                  </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                    <label for="register-password" class="block mb-2 text-sm font-medium text-gray-900">Mot de passe</label>
                    <div class="relative">
                      <i class="absolute left-4 top-1/2 text-gray-400 transition-all duration-300 -translate-y-1/2 fa fa-lock group-focus-within:text-primary"></i>
                      <div class="relative">
                        <i class="absolute left-4 top-1/2 text-gray-400 transition-all duration-300 -translate-y-1/2 fa fa-lock group-focus-within:text-primary"></i>
                        <input type="password" 
                               id="register-password"
                               name="password"
                               required
                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               x-model="password"
                               @input="validatePassword()"
                               class="py-3 pr-11 pl-11 w-full bg-gray-50 rounded-xl border-0 transition-all duration-300 focus:ring-2 focus:ring-primary/20 focus:outline-none focus:bg-white"
                               placeholder="••••••••"
                               autocomplete="new-password"
                               aria-describedby="password-requirements">
                        <button type="button" 
                                @click="togglePasswordVisibility('register-password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                                :aria-label="showPassword ? 'Masquer le mot de passe' : 'Afficher le mot de passe'">
                          <i class="fa" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                      </div>
                      <!-- Password Strength Meter -->
                      <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5">
                        <div class="h-2.5 rounded-full" :class="{
                          'bg-red-500': passwordStrength === 'weak',
                          'bg-yellow-500': passwordStrength === 'medium',
                          'bg-green-500': passwordStrength === 'strong',
                          'w-1/3': passwordStrength === 'weak',
                          'w-2/3': passwordStrength === 'medium',
                          'w-full': passwordStrength === 'strong'
                        }"></div>
                      </div>
                      <p id="password-requirements" class="mt-1 text-xs" :class="{
                        'text-red-500': passwordStrength === 'weak' || passwordStrength === 'medium',
                        'text-green-500': passwordStrength === 'strong',
                        'text-gray-500': !password
                      }">
                        <template x-if="!password">
                          <span>Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre</span>
                        </template>
                        <template x-if="passwordStrength === 'weak' && password">
                          <span>Mot de passe faible</span>
                        </template>
                        <template x-if="passwordStrength === 'medium' && password">
                          <span>Mot de passe moyen</span>
                        </template>
                        <template x-if="passwordStrength === 'strong' && password">
                          <span>Mot de passe fort</span>
                        </template>
                      </p>
                    </div>
                    <p id="password-requirements" class="mt-1 text-xs text-gray-500">
                      Minimum 8 caractères, avec des chiffres et des lettres
                    </p>
                  </div>
                  
                  <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                    <label for="register-password-confirm" class="block mb-2 text-sm font-medium text-gray-900">Confirmer</label>
                    <div class="relative">
                      <i class="absolute left-4 top-1/2 text-gray-400 transition-all duration-300 -translate-y-1/2 fa fa-lock group-focus-within:text-primary"></i>
                      <div class="relative">
                        <i class="absolute left-4 top-1/2 text-gray-400 transition-all duration-300 -translate-y-1/2 fa fa-lock group-focus-within:text-primary"></i>
                        <input type="password" 
                               id="register-password-confirm"
                               name="password_confirmation"
                               required
                               x-model="confirmPassword"
                               @input="validatePasswordMatch()"
                               class="py-3 pr-11 pl-11 w-full bg-gray-50 rounded-xl border-0 transition-all duration-300 focus:ring-2 focus:ring-primary/20 focus:outline-none focus:bg-white"
                               placeholder="••••••••"
                               autocomplete="new-password"
                               :class="{'border-red-500': passwordMismatch && confirmPassword}">
                        <button type="button" 
                                @click="togglePasswordVisibility('register-password-confirm')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                                :aria-label="showConfirmPassword ? 'Masquer le mot de passe' : 'Afficher le mot de passe'">
                          <i class="fa" :class="showConfirmPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                      </div>
                      <p x-show="passwordMismatch && confirmPassword" class="mt-1 text-xs text-red-500">
                        Les mots de passe ne correspondent pas
                      </p>
                    </div>
                  </div>
                </div>

                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input id="terms" 
                           name="terms" 
                           type="checkbox" 
                           required
                           :aria-invalid="!$store.modal.form.terms"
                           class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary/50"
                           aria-describedby="terms-description"
                           x-model="$store.modal.form.terms">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="terms" class="font-medium text-gray-700 cursor-pointer">
                      J'accepte les <a href="#" class="text-primary hover:underline focus:outline-none focus:ring-2 focus:ring-primary/20 rounded">conditions d'utilisation</a> et la <a href="#" class="text-primary hover:underline focus:outline-none focus:ring-2 focus:ring-primary/20 rounded">politique de confidentialité</a>
                    </label>
                    <p id="terms-description" class="text-gray-500">
                      En vous inscrivant, vous acceptez nos conditions d'utilisation et notre politique de confidentialité.
                    </p>
                  </div>
                </div>

                <button type="submit" 
                        class="w-full py-3 px-4 bg-primary text-white rounded-xl transition-all duration-300 hover:bg-primary/90 hover:shadow-lg transform hover:scale-[1.01] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50 flex items-center justify-center disabled:opacity-75 disabled:cursor-not-allowed"
                        :disabled="$store.modal.isLoading">
                  <span class="inline-flex items-center">
                    <i class="mr-2 fa" :class="$store.modal.isLoading ? 'fa-spinner fa-spin' : 'fa-user-plus'"></i>
                    <span x-text="$store.modal.isLoading ? 'Inscription en cours...' : 'Créer mon compte'"></span>
                  </span>
                </button>
              </form>
              
              <!-- Footer -->
              <div class="pt-6 mt-8 border-t border-gray-100">
                <div class="text-center text-sm text-gray-500">
                  <template x-if="$store.modal.authTab === 'login'">
                    <p class="mb-2">
                      Vous n'avez pas de compte ? 
                      <button @click="$store.modal.setAuthTab('register')" 
                              class="font-medium text-primary hover:text-primary/80 focus:outline-none focus:ring-2 focus:ring-primary/20 rounded">
                        Créer un compte
                      </button>
                    </p>
                  </template>
                  <template x-if="$store.modal.authTab === 'register'">
                    <p class="mb-2">
                      Vous avez déjà un compte ? 
                      <button @click="$store.modal.setAuthTab('login')" 
                              class="font-medium text-primary hover:text-primary/80 focus:outline-none focus:ring-2 focus:ring-primary/20 rounded">
                        Se connecter
                      </button>
                    </p>
                  </template>
                  <p class="text-xs text-gray-400">
                    En continuant, vous acceptez nos conditions d'utilisation et notre politique de confidentialité.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>