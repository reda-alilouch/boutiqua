<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
      rel="stylesheet"
    />

    <title>Hexashop Ecommerce HTML CSS Template</title>

    <!-- Menu JS -->
    <script defer src="assets/js/menu.js"></script>

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="assets/css/tailwind.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/owl-carousel.css" />
    <link rel="stylesheet" href="assets/css/lightbox.css" />

    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.store('modal', {
          search: false,
          auth: false,
          authTab: 'login',
          toggleSearch() {
            this.search = !this.search;
            if (this.search) this.auth = false;
          },
          toggleAuth() {
            this.auth = !this.auth;
            if (this.auth) this.search = false;
          },
          setAuthTab(tab) {
            this.authTab = tab;
          }
        });
      });
    </script>
  </head>

  <body class="font-poppins" x-data="{ isSearchOpen: false, isAuthOpen: false }">
    <!-- ***** Preloader Start ***** -->
    <div
      id="preloader"
      class="fixed inset-0 z-50 bg-white flex items-center justify-center"
    >
      <div class="jumper flex space-x-2">
        <div class="w-3 h-3 bg-accent rounded-full animate-bounce"></div>
        <div
          class="w-3 h-3 bg-accent rounded-full animate-bounce delay-75"
        ></div>
        <div
          class="w-3 h-3 bg-accent rounded-full animate-bounce delay-150"
        ></div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="fixed w-full top-0 left-0 z-50 bg-white shadow-sm">
      <div class="container mx-auto px-4">
        <nav class="flex items-center h-20">
          <!-- Mobile Menu Button -->
          <button
            id="menuButton"
            class="lg:hidden p-2 rounded-md text-gray-600 hover:text-black"
          >
            <svg class="menu-open-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg class="menu-close-icon hidden w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>

          <!-- Logo -->
          <a href="index.php" class="flex-shrink-0">
            <img src="assets/images/logo.png" class="h-12 w-auto" alt="Hexashop Logo" />
          </a>

          <!-- Main Menu -->
          <div class="flex-1 flex items-center justify-center">
            <nav id="mainMenu" class="fixed inset-0 bg-white transform translate-x-full transition-transform duration-300 ease-in-out lg:relative lg:inset-auto lg:transform-none lg:translate-x-0 lg:flex lg:items-center">
              <div class="h-full py-5 px-6 lg:p-0">
                <div class="flex flex-col lg:flex-row lg:items-center">
                  <a href="index.php" class="text-gray-700 hover:text-black px-5">Home</a>
                  <a href="#men" class="text-gray-700 hover:text-black px-5">Men's</a>
                  <a href="#women" class="text-gray-700 hover:text-black px-5">Women's</a>
                  <a href="#kids" class="text-gray-700 hover:text-black px-5">Kid's</a>
                  <div class="relative group px-5">
                    <button 
                      id="pagesDropdownButton"
                      class="flex items-center text-gray-700 hover:text-black"
                    >
                      <span>Pages</span>
                      <svg class="w-4 h-4 ml-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </button>
                    <div id="pagesDropdownMenu" class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-2">
                      <a href="about.html" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">About Us</a>
                      <a href="products.html" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Products</a>
                      <a href="single-product.html" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Single Product</a>
                      <a href="contact.html" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Contact Us</a>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
          </div>

          <!-- Icons -->
          <div class="flex items-center space-x-4">
            <!-- Search Icon -->
            <button class="p-2 text-gray-600 hover:text-black">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
            
            <!-- User Account Icon -->
            <button class="p-2 text-gray-600 hover:text-black">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </button>
            
            <!-- Shopping Cart Icon -->
            <button class="p-2 text-gray-600 hover:text-black relative">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
              </svg>
              <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
            </button>
          </div>
        </nav>
      </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- Search Modal -->
    <div x-show="$store.modal.search" 
         x-trap.noscroll="$store.modal.search"
         @keydown.window.escape="$store.modal.toggleSearch()"
         @keydown.window.slash.prevent="$store.modal.toggleSearch()"
         class="fixed inset-0 z-50" 
         style="display: none;">
      <!-- Overlay -->
      <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"
           x-transition:enter="transition-opacity ease-out duration-300"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100"
           x-transition:leave="transition-opacity ease-in duration-200"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           @click="$store.modal.toggleSearch()"></div>
      
      <!-- Search Container -->
      <div class="relative w-full max-w-3xl mx-auto mt-8 px-6">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100"
             x-transition:enter="transition ease-out delay-100 duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4">
          <div class="p-8">
            <!-- Search Input -->
            <div class="relative mb-8 transform transition-all duration-300 hover:scale-[1.01] group">
              <i class="fa fa-search absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 text-lg transition-all duration-300 group-focus-within:text-gray-900"></i>
              <input type="text" 
                     x-model="$store.search.query"
                     @input.debounce.300ms="$store.search.performSearch()"
                     @keydown.down.prevent="$store.search.highlightNext()"
                     @keydown.up.prevent="$store.search.highlightPrev()"
                     @keydown.enter.prevent="$store.search.selectHighlighted()"
                     class="w-full pl-14 pr-14 py-4 text-lg bg-gray-50 border-0 rounded-xl focus:ring-0 focus:outline-none transition-all duration-300 focus:bg-gray-100"
                     placeholder="Search for products... (Press '/' to focus)"
                     x-ref="searchInput">
              <div class="absolute right-6 top-1/2 -translate-y-1/2 flex items-center space-x-2">
                <span x-show="$store.search.isLoading" 
                      class="animate-spin">
                  <i class="fa fa-circle-o-notch text-gray-400"></i>
                </span>
                <button x-show="$store.search.query" 
                        @click="$store.search.clear()"
                        class="text-gray-400 hover:text-gray-900 transition-all duration-300">
                  <i class="fa fa-times text-xl"></i>
                </button>
                <button @click="$store.modal.toggleSearch()" 
                        class="text-gray-400 hover:text-gray-900 transition-all duration-300 hover:rotate-90">
                  <i class="fa fa-times text-xl"></i>
                </button>
              </div>
            </div>

            <!-- Search Results -->
            <div x-show="$store.search.query" 
                 x-transition:enter="transition ease-out delay-100 duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="mb-8">
              <template x-if="$store.search.results.length > 0">
                <div>
                  <h3 class="text-sm font-medium text-gray-900 mb-4 uppercase tracking-wider">Search Results</h3>
                  <div class="space-y-3">
                    <template x-for="(result, index) in $store.search.results" :key="index">
                      <a :href="result.url" 
                         @mousemove="$store.search.highlightIndex = index"
                         :class="{'bg-gray-100': $store.search.highlightIndex === index}"
                         class="group flex items-center justify-between px-5 py-3 bg-gray-50 text-gray-600 rounded-xl transition-all duration-300 hover:bg-gray-100 hover:text-gray-900">
                        <span class="flex items-center space-x-3">
                          <img :src="result.image" class="w-10 h-10 object-cover rounded-lg" :alt="result.title">
                          <div>
                            <h4 class="font-medium" x-text="result.title"></h4>
                            <p class="text-sm text-gray-500" x-text="result.category"></p>
                          </div>
                        </span>
                        <span class="text-lg font-medium text-gray-900" x-text="'$' + result.price"></span>
                      </a>
                    </template>
                  </div>
                </div>
              </template>
              <template x-if="$store.search.results.length === 0 && !$store.search.isLoading">
                <div class="text-center py-12">
                  <div class="text-gray-400 mb-4">
                    <i class="fa fa-search fa-3x"></i>
                  </div>
                  <h3 class="text-lg font-medium text-gray-900 mb-2">No results found</h3>
                  <p class="text-gray-600">Try adjusting your search or filter to find what you're looking for.</p>
                </div>
              </template>
            </div>
            
            <!-- Popular and Recent Searches -->
            <div x-show="!$store.search.query">
                     placeholder="Search for products..."
                     @keydown.escape="$store.modal.toggleSearch()">
              <button @click="$store.modal.toggleSearch()" 
                      class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-900 transition-all duration-300 hover:rotate-90">
                <i class="fa fa-times text-xl"></i>
              </button>
            </div>
            
            <!-- Popular Searches -->
            <div x-show="true" 
                 x-transition:enter="transition ease-out delay-200 duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0">
              <h3 class="text-sm font-medium text-gray-900 mb-4 uppercase tracking-wider">Popular Searches</h3>
              <div class="flex flex-wrap gap-3">
                <a href="#" class="group inline-flex items-center px-5 py-2.5 bg-gray-50 text-gray-600 rounded-xl transition-all duration-300 hover:bg-gray-100 hover:text-gray-900">
                  <i class="fa fa-search text-gray-400 mr-2 transition-all duration-300 group-hover:text-gray-900"></i>
                  <span class="font-medium">T-shirts</span>
                </a>
                <a href="#" class="group inline-flex items-center px-5 py-2.5 bg-gray-50 text-gray-600 rounded-xl transition-all duration-300 hover:bg-gray-100 hover:text-gray-900">
                  <i class="fa fa-search text-gray-400 mr-2 transition-all duration-300 group-hover:text-gray-900"></i>
                  <span class="font-medium">Dresses</span>
                </a>
                <a href="#" class="group inline-flex items-center px-5 py-2.5 bg-gray-50 text-gray-600 rounded-xl transition-all duration-300 hover:bg-gray-100 hover:text-gray-900">
                  <i class="fa fa-search text-gray-400 mr-2 transition-all duration-300 group-hover:text-gray-900"></i>
                  <span class="font-medium">Shoes</span>
                </a>
                <a href="#" class="group inline-flex items-center px-5 py-2.5 bg-gray-50 text-gray-600 rounded-xl transition-all duration-300 hover:bg-gray-100 hover:text-gray-900">
                  <i class="fa fa-search text-gray-400 mr-2 transition-all duration-300 group-hover:text-gray-900"></i>
                  <span class="font-medium">Accessories</span>
                </a>
              </div>

              <!-- Recent Searches -->
              <h3 class="text-sm font-medium text-gray-900 mb-4 mt-8 uppercase tracking-wider">Recent Searches</h3>
              <div class="space-y-3">
                <a href="#" class="group flex items-center justify-between px-5 py-3 bg-gray-50 text-gray-600 rounded-xl transition-all duration-300 hover:bg-gray-100 hover:text-gray-900">
                  <span class="flex items-center">
                    <i class="fa fa-history text-gray-400 mr-3 transition-all duration-300 group-hover:text-gray-900"></i>
                    <span class="font-medium">Summer Collection 2024</span>
                  </span>
                  <i class="fa fa-times text-gray-400 opacity-0 group-hover:opacity-100 transition-all duration-300"></i>
                </a>
                <a href="#" class="group flex items-center justify-between px-5 py-3 bg-gray-50 text-gray-600 rounded-xl transition-all duration-300 hover:bg-gray-100 hover:text-gray-900">
                  <span class="flex items-center">
                    <i class="fa fa-history text-gray-400 mr-3 transition-all duration-300 group-hover:text-gray-900"></i>
                    <span class="font-medium">Nike Air Max</span>
                  </span>
                  <i class="fa fa-times text-gray-400 opacity-0 group-hover:opacity-100 transition-all duration-300"></i>
                </a>
                <a href="#" class="group flex items-center justify-between px-5 py-3 bg-gray-50 text-gray-600 rounded-xl transition-all duration-300 hover:bg-gray-100 hover:text-gray-900">
                  <span class="flex items-center">
                    <i class="fa fa-history text-gray-400 mr-3 transition-all duration-300 group-hover:text-gray-900"></i>
                    <span class="font-medium">Designer Bags</span>
                  </span>
                  <i class="fa fa-times text-gray-400 opacity-0 group-hover:opacity-100 transition-all duration-300"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Auth Modal -->
    <div x-show="$store.modal.auth" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="fixed inset-0 z-50" 
         style="display: none;">
      <!-- Overlay -->
      <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"
           x-transition:enter="transition-opacity ease-out duration-300"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100"
           x-transition:leave="transition-opacity ease-in duration-200"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           @click="$store.modal.toggleAuth()"></div>
      
      <!-- Modal Container -->
      <div class="relative w-full max-w-md mx-auto mt-8 px-6">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100"
             x-transition:enter="transition ease-out delay-100 duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95">
          <!-- Close Button -->
          <button @click="$store.modal.toggleAuth()" 
                  class="absolute top-6 right-6 text-gray-400 hover:text-gray-900 transition-all duration-300 hover:rotate-90 z-10">
            <i class="fa fa-times text-xl"></i>
          </button>

          <!-- Auth Content -->
          <div class="p-8">
            <!-- Logo -->
            <div class="text-center mb-8"
                 x-show="true"
                 x-transition:enter="transition ease-out delay-200 duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0">
              <div class="relative w-20 h-20 mx-auto mb-6">
                <div class="absolute inset-0 bg-gray-900/5 rounded-2xl rotate-6 transform transition-transform duration-300 group-hover:rotate-12"></div>
                <div class="absolute inset-0 bg-gray-900/10 rounded-2xl -rotate-6 transform transition-transform duration-300 group-hover:-rotate-12"></div>
                <div class="relative bg-white rounded-2xl shadow-sm p-2">
                  <img src="assets/images/logo.png" alt="Logo" class="w-16 h-16 mx-auto transition-transform duration-300 hover:scale-110">
                </div>
              </div>
              <h2 class="text-2xl font-semibold text-gray-900 mb-2" x-text="$store.modal.authTab === 'login' ? 'Welcome Back' : 'Create Account'"></h2>
              <p class="text-gray-500" x-text="$store.modal.authTab === 'login' ? 'Sign in to your account to continue' : 'Create a new account to get started'"></p>
            </div>

            <!-- Tabs -->
            <div class="flex border-b border-gray-200 mb-8">
              <button @click="$store.modal.setAuthTab('login')"
                      :class="{'text-gray-900 border-gray-900': $store.modal.authTab === 'login'}"
                      class="flex-1 py-3 text-center font-medium text-gray-500 border-b-2 border-transparent transition-all duration-300 hover:text-gray-900">
                <span class="relative inline-flex items-center">
                  <i class="fa fa-sign-in mr-2 opacity-75"></i>
                  Sign In
                </span>
              </button>
              <button @click="$store.modal.setAuthTab('register')"
                      :class="{'text-gray-900 border-gray-900': $store.modal.authTab === 'register'}"
                      class="flex-1 py-3 text-center font-medium text-gray-500 border-b-2 border-transparent transition-all duration-300 hover:text-gray-900">
                <span class="relative inline-flex items-center">
                  <i class="fa fa-user-plus mr-2 opacity-75"></i>
                  Sign Up
                </span>
              </button>
            </div>

            <!-- Login Form -->
            <div x-show="$store.modal.authTab === 'login'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform -translate-x-4"
                 class="space-y-6">
              <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                <label class="block text-sm font-medium text-gray-900 mb-2">Email address</label>
                <div class="relative group">
                  <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-all duration-300 group-focus-within:text-gray-900"></i>
                  <input type="email" 
                         class="w-full pl-11 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-0 focus:outline-none transition-all duration-300 focus:bg-gray-100"
                         placeholder="name@example.com">
                </div>
              </div>
              <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                <label class="block text-sm font-medium text-gray-900 mb-2">Password</label>
                <div class="relative group">
                  <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-all duration-300 group-focus-within:text-gray-900"></i>
                  <input type="password" 
                         class="w-full pl-11 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-0 focus:outline-none transition-all duration-300 focus:bg-gray-100"
                         placeholder="Enter your password">
                </div>
              </div>
              <div class="flex items-center justify-between">
                <label class="flex items-center group cursor-pointer">
                  <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900/20 transition-all duration-300 group-hover:border-gray-900">
                  <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900 transition-colors duration-300">Remember me</span>
                </label>
                <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-all duration-300 hover:underline">Forgot password?</a>
              </div>
              <button class="w-full py-3 px-4 bg-gray-900 text-white rounded-xl transition-all duration-300 hover:bg-gray-800 hover:shadow-lg transform hover:scale-[1.01] focus:outline-none focus:ring-2 focus:ring-gray-900/20">
                <span class="relative inline-flex items-center justify-center">
                  <i class="fa fa-sign-in mr-2"></i>
                  Sign In
                </span>
              </button>

              <!-- Social Login -->
              <div class="relative text-center mt-8">
                <span class="bg-white px-2 text-sm text-gray-500 relative z-10">Or continue with</span>
                <div class="absolute top-1/2 left-0 w-full h-px bg-gray-200 -z-1"></div>
              </div>
              <div class="grid grid-cols-2 gap-4 mt-4">
                <button class="flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl transition-all duration-300 hover:bg-gray-50 hover:border-gray-300 transform hover:scale-[1.01] group">
                  <img src="assets/images/google.png" alt="Google" class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:scale-110">
                  <span class="text-sm font-medium text-gray-600 group-hover:text-gray-900 transition-colors duration-300">Google</span>
                </button>
                <button class="flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl transition-all duration-300 hover:bg-gray-50 hover:border-gray-300 transform hover:scale-[1.01] group">
                  <img src="assets/images/facebook.png" alt="Facebook" class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:scale-110">
                  <span class="text-sm font-medium text-gray-600 group-hover:text-gray-900 transition-colors duration-300">Facebook</span>
                </button>
              </div>
            </div>

            <!-- Register Form -->
            <div x-show="$store.modal.authTab === 'register'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform translate-x-4"
                 class="space-y-6">
              <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                <label class="block text-sm font-medium text-gray-900 mb-2">Full Name</label>
                <div class="relative group">
                  <i class="fa fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-all duration-300 group-focus-within:text-gray-900"></i>
                  <input type="text" 
                         class="w-full pl-11 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-0 focus:outline-none transition-all duration-300 focus:bg-gray-100"
                         placeholder="John Doe">
                </div>
              </div>
              <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                <label class="block text-sm font-medium text-gray-900 mb-2">Email address</label>
                <div class="relative group">
                  <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-all duration-300 group-focus-within:text-gray-900"></i>
                  <input type="email" 
                         class="w-full pl-11 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-0 focus:outline-none transition-all duration-300 focus:bg-gray-100"
                         placeholder="name@example.com">
                </div>
              </div>
              <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                <label class="block text-sm font-medium text-gray-900 mb-2">Password</label>
                <div class="relative group">
                  <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-all duration-300 group-focus-within:text-gray-900"></i>
                  <input type="password" 
                         class="w-full pl-11 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-0 focus:outline-none transition-all duration-300 focus:bg-gray-100"
                         placeholder="Create a password">
                </div>
              </div>
              <div class="transform transition-all duration-300 hover:scale-[1.01] group">
                <label class="block text-sm font-medium text-gray-900 mb-2">Confirm Password</label>
                <div class="relative group">
                  <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-all duration-300 group-focus-within:text-gray-900"></i>
                  <input type="password" 
                         class="w-full pl-11 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-0 focus:outline-none transition-all duration-300 focus:bg-gray-100"
                         placeholder="Confirm your password">
                </div>
              </div>
              <div class="flex items-start space-x-3 group cursor-pointer">
                <input type="checkbox" class="mt-1 w-4 h-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900/20 transition-all duration-300 group-hover:border-gray-900">
                <label class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors duration-300">
                  I agree to the <a href="#" class="text-gray-900 hover:underline">Terms of Service</a> and <a href="#" class="text-gray-900 hover:underline">Privacy Policy</a>
                </label>
              </div>
              <button class="w-full py-3 px-4 bg-gray-900 text-white rounded-xl transition-all duration-300 hover:bg-gray-800 hover:shadow-lg transform hover:scale-[1.01] focus:outline-none focus:ring-2 focus:ring-gray-900/20">
                <span class="relative inline-flex items-center justify-center">
                  <i class="fa fa-user-plus mr-2"></i>
                  Create Account
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ***** Main Banner Area Start ***** -->
    <div class="relative py-16 bg-gray-50 overflow-hidden" id="top">
      <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-8">
          <!-- Left Content -->
          <div class="relative overflow-hidden rounded-2xl shadow-xl group transform transition-all duration-500 hover:scale-[1.02]">
            <div class="relative">
              <div class="absolute inset-0 flex items-center justify-center bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                <div class="text-center text-white p-8 transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                  <h4 class="text-3xl font-semibold mb-2">We Are Hexashop</h4>
                  <p class="text-lg mb-6 opacity-90">Awesome, clean &amp; creative HTML5 Template</p>
                  <a href="#" class="inline-flex items-center px-6 py-3 border-2 border-white text-white rounded-full hover:bg-white hover:text-primary transition-all duration-300 transform hover:scale-105">
                    Purchase Now!
                  </a>
                </div>
              </div>
              <img src="assets/images/left-banner-image.jpg" 
                   class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110" 
                   alt="Banner" />
            </div>
          </div>

          <!-- Right Content -->
          <div class="grid grid-cols-2 gap-4">
            <!-- Women Section -->
            <div class="relative overflow-hidden rounded-xl shadow-lg group">
              <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent p-6 flex flex-col justify-end transform transition-transform duration-500">
                  <h4 class="text-white text-xl font-semibold transform transition-all duration-500 translate-y-0 group-hover:-translate-y-2">Women</h4>
                  <span class="text-white/90 transform transition-all duration-500 translate-y-0 group-hover:-translate-y-2">Best Clothes For Women</span>
                </div>
                <div class="absolute inset-0 bg-black/70 p-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                  <div class="text-center text-white transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                    <h4 class="text-2xl font-semibold mb-2">Women</h4>
                    <p class="mb-4 opacity-90">Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                    <a href="#" class="inline-flex items-center px-6 py-2 border-2 border-white text-white rounded-full hover:bg-white hover:text-primary transition-all duration-300 transform hover:scale-105">
                      Discover More
                    </a>
                  </div>
                </div>
                <img src="assets/images/baner-right-image-01.jpg" 
                     class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110" 
                     alt="Women's Collection" />
              </div>
            </div>

            <!-- Men Section -->
            <div class="relative overflow-hidden rounded-xl shadow-lg group">
              <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent p-6 flex flex-col justify-end transform transition-transform duration-500">
                  <h4 class="text-white text-xl font-semibold transform transition-all duration-500 translate-y-0 group-hover:-translate-y-2">Men</h4>
                  <span class="text-white/90 transform transition-all duration-500 translate-y-0 group-hover:-translate-y-2">Best Clothes For Men</span>
                </div>
                <div class="absolute inset-0 bg-black/70 p-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                  <div class="text-center text-white transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                    <h4 class="text-2xl font-semibold mb-2">Men</h4>
                    <p class="mb-4 opacity-90">Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                    <a href="#" class="inline-flex items-center px-6 py-2 border-2 border-white text-white rounded-full hover:bg-white hover:text-primary transition-all duration-300 transform hover:scale-105">
                      Discover More
                    </a>
                  </div>
                </div>
                <img src="assets/images/baner-right-image-02.jpg" 
                     class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110" 
                     alt="Men's Collection" />
              </div>
            </div>

            <!-- Kids Section -->
            <div class="relative overflow-hidden rounded-xl shadow-lg group">
              <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent p-6 flex flex-col justify-end transform transition-transform duration-500">
                  <h4 class="text-white text-xl font-semibold transform transition-all duration-500 translate-y-0 group-hover:-translate-y-2">Kids</h4>
                  <span class="text-white/90 transform transition-all duration-500 translate-y-0 group-hover:-translate-y-2">Best Clothes For Kids</span>
                </div>
                <div class="absolute inset-0 bg-black/70 p-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                  <div class="text-center text-white transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                    <h4 class="text-2xl font-semibold mb-2">Kids</h4>
                    <p class="mb-4 opacity-90">Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                    <a href="#" class="inline-flex items-center px-6 py-2 border-2 border-white text-white rounded-full hover:bg-white hover:text-primary transition-all duration-300 transform hover:scale-105">
                      Discover More
                    </a>
                  </div>
                </div>
                <img src="assets/images/baner-right-image-03.jpg" 
                     class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110" 
                     alt="Kids Collection" />
              </div>
            </div>

            <!-- Accessories Section -->
            <div class="relative overflow-hidden rounded-xl shadow-lg group">
              <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent p-6 flex flex-col justify-end transform transition-transform duration-500">
                  <h4 class="text-white text-xl font-semibold transform transition-all duration-500 translate-y-0 group-hover:-translate-y-2">Accessories</h4>
                  <span class="text-white/90 transform transition-all duration-500 translate-y-0 group-hover:-translate-y-2">Best Trend Accessories</span>
                </div>
                <div class="absolute inset-0 bg-black/70 p-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                  <div class="text-center text-white transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                    <h4 class="text-2xl font-semibold mb-2">Accessories</h4>
                    <p class="mb-4 opacity-90">Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                    <a href="#" class="inline-flex items-center px-6 py-2 border-2 border-white text-white rounded-full hover:bg-white hover:text-primary transition-all duration-300 transform hover:scale-105">
                      Discover More
                    </a>
                  </div>
                </div>
                <img src="assets/images/baner-right-image-04.jpg" 
                     class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110" 
                     alt="Accessories Collection" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Men Area Starts ***** -->
    <section class="py-16 bg-white" id="men">
      <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto text-center mb-12">
          <h2 class="text-3xl font-semibold text-primary mb-4">Men's Latest</h2>
          <p class="text-gray-600">
            Details to details is what makes Hexashop different from the other
            themes.
          </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Product 1 -->
          <div class="group relative overflow-hidden rounded-lg shadow-lg">
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/men-01.jpg"
                alt="Classic Spring"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Classic Spring</h4>
              <span class="text-accent text-lg font-medium">$120.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product 2 -->
          <div class="group relative overflow-hidden rounded-lg shadow-lg">
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/men-02.jpg"
                alt="Air Force 1 X"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Air Force 1 X</h4>
              <span class="text-accent text-lg font-medium">$90.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product 3 -->
          <div class="group relative overflow-hidden rounded-lg shadow-lg">
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/men-03.jpg"
                alt="Love Nana '20"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Love Nana '20</h4>
              <span class="text-accent text-lg font-medium">$150.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product 4 -->
          <div class="group relative overflow-hidden rounded-lg shadow-lg">
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/men-01.jpg"
                alt="Classic Spring"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Classic Spring</h4>
              <span class="text-accent text-lg font-medium">$120.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Men Area Ends ***** -->

    <!-- ***** Women Area Starts ***** -->
    <section class="py-16 bg-gray-50" id="women">
      <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto text-center mb-12">
          <h2 class="text-3xl font-semibold text-primary mb-4">
            Women's Latest
          </h2>
          <p class="text-gray-600">
            Details to details is what makes Hexashop different from the other
            themes.
          </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Product 1 -->
          <div
            class="group relative overflow-hidden rounded-lg shadow-lg bg-white"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/women-01.jpg"
                alt="New Green Jacket"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">New Green Jacket</h4>
              <span class="text-accent text-lg font-medium">$75.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product 2 -->
          <div
            class="group relative overflow-hidden rounded-lg shadow-lg bg-white"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/women-02.jpg"
                alt="Classic Dress"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Classic Dress</h4>
              <span class="text-accent text-lg font-medium">$45.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product 3 -->
          <div
            class="group relative overflow-hidden rounded-lg shadow-lg bg-white"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/women-03.jpg"
                alt="Spring Collection"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Spring Collection</h4>
              <span class="text-accent text-lg font-medium">$130.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product 4 -->
          <div
            class="group relative overflow-hidden rounded-lg shadow-lg bg-white"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/women-01.jpg"
                alt="Classic Spring"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Classic Spring</h4>
              <span class="text-accent text-lg font-medium">$120.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Women Area Ends ***** -->

    <!-- ***** Kids Area Starts ***** -->
    <section class="py-16" id="kids">
      <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto text-center mb-12">
          <h2 class="text-3xl font-semibold text-primary mb-4">Kid's Latest</h2>
          <p class="text-gray-600">
            Details to details is what makes Hexashop different from the other
            themes.
          </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Product 1 -->
          <div
            class="group relative overflow-hidden rounded-lg shadow-lg bg-white"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/kid-01.jpg"
                alt="School Collection"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">School Collection</h4>
              <span class="text-accent text-lg font-medium">$80.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product 2 -->
          <div
            class="group relative overflow-hidden rounded-lg shadow-lg bg-white"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/kid-02.jpg"
                alt="Summer Cap"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Summer Cap</h4>
              <span class="text-accent text-lg font-medium">$12.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product 3 -->
          <div
            class="group relative overflow-hidden rounded-lg shadow-lg bg-white"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/kid-03.jpg"
                alt="Classic Kid"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Classic Kid</h4>
              <span class="text-accent text-lg font-medium">$30.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>

          <!-- Product 4 -->
          <div
            class="group relative overflow-hidden rounded-lg shadow-lg bg-white"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/kid-01.jpg"
                alt="Classic Spring"
                class="w-full h-full object-cover"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 bg-white rounded-full hover:bg-accent hover:text-white transition-colors"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="text-lg font-semibold mb-2">Classic Spring</h4>
              <span class="text-accent text-lg font-medium">$120.00</span>
              <div class="flex items-center mt-2 text-yellow-400">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Kids Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    <section class="py-16" id="social">
      <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto text-center mb-12">
          <h2 class="text-3xl font-semibold text-primary mb-4">Social Media</h2>
          <p class="text-gray-600">
            Details to details is what makes Hexashop different from the other
            themes.
          </p>
        </div>

        <!-- Instagram Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
          <!-- Instagram Item 1 -->
          <div class="group relative overflow-hidden rounded-lg">
            <img
              src="assets/images/instagram-01.jpg"
              alt="Fashion Collection"
              class="w-full h-full object-cover aspect-square"
            />
            <div
              class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="text-lg font-semibold mb-2">Fashion</h6>
                <i class="fa fa-instagram text-2xl"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 2 -->
          <div class="group relative overflow-hidden rounded-lg">
            <img
              src="assets/images/instagram-02.jpg"
              alt="New Collection"
              class="w-full h-full object-cover aspect-square"
            />
            <div
              class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="text-lg font-semibold mb-2">New</h6>
                <i class="fa fa-instagram text-2xl"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 3 -->
          <div class="group relative overflow-hidden rounded-lg">
            <img
              src="assets/images/instagram-03.jpg"
              alt="Brand Collection"
              class="w-full h-full object-cover aspect-square"
            />
            <div
              class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="text-lg font-semibold mb-2">Brand</h6>
                <i class="fa fa-instagram text-2xl"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 4 -->
          <div class="group relative overflow-hidden rounded-lg">
            <img
              src="assets/images/instagram-04.jpg"
              alt="Makeup Collection"
              class="w-full h-full object-cover aspect-square"
            />
            <div
              class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="text-lg font-semibold mb-2">Makeup</h6>
                <i class="fa fa-instagram text-2xl"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 5 -->
          <div class="group relative overflow-hidden rounded-lg">
            <img
              src="assets/images/instagram-05.jpg"
              alt="Leather Collection"
              class="w-full h-full object-cover aspect-square"
            />
            <div
              class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="text-lg font-semibold mb-2">Leather</h6>
                <i class="fa fa-instagram text-2xl"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 6 -->
          <div class="group relative overflow-hidden rounded-lg">
            <img
              src="assets/images/instagram-06.jpg"
              alt="Bag Collection"
              class="w-full h-full object-cover aspect-square"
            />
            <div
              class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="text-lg font-semibold mb-2">Bag</h6>
                <i class="fa fa-instagram text-2xl"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Social Area Ends ***** -->

    <!-- ***** Subscribe Area Starts ***** -->
    <section class="py-16 bg-gray-50" id="subscribe">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
          <!-- Newsletter Form -->
          <div class="lg:col-span-8">
            <div class="max-w-2xl">
              <h2 class="text-3xl font-semibold text-primary mb-4">
                By Subscribing To Our Newsletter You Can Get 30% Off
              </h2>
              <p class="text-gray-600 mb-8">
                Details to details is what makes Hexashop different from the
                other themes.
              </p>

              <form
                id="subscribe"
                action=""
                method="get"
                class="flex flex-col md:flex-row gap-4"
              >
                <div class="flex-1">
                  <input
                    name="name"
                    type="text"
                    id="name"
                    placeholder="Your Name"
                    required=""
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent"
                  />
                </div>
                <div class="flex-1">
                  <input
                    name="email"
                    type="email"
                    id="email"
                    pattern="[^ @]*@[^ @]*"
                    placeholder="Your Email Address"
                    required=""
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent"
                  />
                </div>
                <div>
                  <button
                    type="submit"
                    id="form-submit"
                    class="w-full md:w-auto px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors duration-300"
                  >
                    <i class="fa fa-paper-plane"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="lg:col-span-4">
            <div class="grid grid-cols-2 gap-8">
              <div class="space-y-6">
                <div>
                  <h6 class="text-sm font-semibold text-gray-600 mb-1">
                    Store Location:
                  </h6>
                  <p class="text-gray-800">
                    Sunny Isles Beach, FL 33160, United States
                  </p>
                </div>
                <div>
                  <h6 class="text-sm font-semibold text-gray-600 mb-1">
                    Phone:
                  </h6>
                  <p class="text-gray-800">010-020-0340</p>
                </div>
                <div>
                  <h6 class="text-sm font-semibold text-gray-600 mb-1">
                    Office Location:
                  </h6>
                  <p class="text-gray-800">North Miami Beach</p>
                </div>
              </div>
              <div class="space-y-6">
                <div>
                  <h6 class="text-sm font-semibold text-gray-600 mb-1">
                    Work Hours:
                  </h6>
                  <p class="text-gray-800">07:30 AM - 9:30 PM Daily</p>
                </div>
                <div>
                  <h6 class="text-sm font-semibold text-gray-600 mb-1">
                    Email:
                  </h6>
                  <p class="text-gray-800">info@company.com</p>
                </div>
                <div>
                  <h6 class="text-sm font-semibold text-gray-600 mb-1">
                    Social Media:
                  </h6>
                  <p class="text-gray-800">
                    <a href="#" class="text-accent hover:text-accent-dark"
                      >Facebook</a
                    >,
                    <a href="#" class="text-accent hover:text-accent-dark"
                      >Instagram</a
                    >,
                    <a href="#" class="text-accent hover:text-accent-dark"
                      >Behance</a
                    >,
                    <a href="#" class="text-accent hover:text-accent-dark"
                      >Linkedin</a
                    >
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Subscribe Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
    <footer class="bg-primary text-white py-16">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
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
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  16501 Collins Ave, Sunny Isles Beach, FL 33160, United States
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  hexashop@company.com
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  010-020-0340
                </a>
              </li>
            </ul>
          </div>

          <!-- Shopping Categories -->
          <div>
            <h4 class="text-lg font-semibold mb-6">
              Shopping &amp; Categories
            </h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  Men's Shopping
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  Women's Shopping
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  Kid's Shopping
                </a>
              </li>
            </ul>
          </div>

          <!-- Useful Links -->
          <div>
            <h4 class="text-lg font-semibold mb-6">Useful Links</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  Homepage
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  About Us
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  Help
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  Contact Us
                </a>
              </li>
            </ul>
          </div>

          <!-- Help & Information -->
          <div>
            <h4 class="text-lg font-semibold mb-6">Help &amp; Information</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  Help
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  FAQ's
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  Shipping
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white transition-colors"
                >
                  Tracking ID
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Under Footer -->
        <div class="border-t border-gray-700 mt-12 pt-8">
          <div
            class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0"
          >
            <div class="text-center md:text-left text-sm text-gray-300">
              <p>
                Copyright © 2022 HexaShop Co., Ltd. All Rights Reserved.
                <br />
                Design:
                <a
                  href="https://templatemo.com"
                  target="_parent"
                  title="free css templates"
                  class="text-accent hover:text-accent/80"
                >
                  TemplateMo
                </a>
                <br />
                Distributed By:
                <a
                  href="https://themewagon.com"
                  target="_blank"
                  title="free & premium responsive templates"
                  class="text-accent hover:text-accent/80"
                >
                  ThemeWagon
                </a>
              </p>
            </div>
            <div class="flex space-x-4">
              <a
                href="#"
                class="text-gray-300 hover:text-white transition-colors"
              >
                <i class="fa fa-facebook text-xl"></i>
              </a>
              <a
                href="#"
                class="text-gray-300 hover:text-white transition-colors"
              >
                <i class="fa fa-twitter text-xl"></i>
              </a>
              <a
                href="#"
                class="text-gray-300 hover:text-white transition-colors"
              >
                <i class="fa fa-linkedin text-xl"></i>
              </a>
              <a
                href="#"
                class="text-gray-300 hover:text-white transition-colors"
              >
                <i class="fa fa-behance text-xl"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
      $(function () {
        var selectedClass = "";
        $("p").click(function () {
          selectedClass = $(this).attr("data-rel");
          $("#portfolio").fadeTo(50, 0.1);
          $("#portfolio div")
            .not("." + selectedClass)
            .fadeOut();
          setTimeout(function () {
            $("." + selectedClass).fadeIn();
            $("#portfolio").fadeTo(50, 1);
          }, 500);
        });
      });
    </script>
  </body>
</html>
<?php
// Project Structure
/*
project/
├── cards/
│   ├── product-card.php 
│   ├── team-card.php
│   └── service-card.php
├── sections/
│   ├── header.php
│   ├── hero.php 
│   ├── about.php
│   ├── services.php
│   ├── portfolio.php
│   └── footer.php
├── components/
│   ├── navbar.php
│   ├── button.php
│   ├── form.php
│   └── modal.php
├── features/
│   ├── authentication/
│   │   ├── login.php
│   │   └── register.php
│   ├── cart/
│   │   ├── cart.php
│   │   └── checkout.php
│   └── search/
│       └── search.php
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── includes/
│   ├── config.php
│   ├── functions.php
│   └── database.php
└── index.php
*/
?>
