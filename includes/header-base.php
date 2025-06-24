<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hexashop - Votre boutique en ligne préférée</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="src/images/favicon.png">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="src/css/menu.css">
    <link rel="stylesheet" href="src/css/responsive.css">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/modals.css">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <!-- Navigation -->
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/hexashop-1.0.0/index.php" class="text-2xl font-bold text-gray-900">
                        Hexashop
                    </a>
                </div>

                <!-- Navigation Desktop -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/hexashop-1.0.0/index.php" class="text-gray-700 hover:text-black transition-colors">
                        Accueil
                    </a>
                    <a href="/hexashop-1.0.0/products.php" class="text-gray-700 hover:text-black transition-colors">
                        Produits
                    </a>
                    <a href="/hexashop-1.0.0/single-product.php" class="text-gray-700 hover:text-black transition-colors">
                        Produit Unique
                    </a>
                    <a href="/hexashop-1.0.0/contact.php" class="text-gray-700 hover:text-black transition-colors">
                        Contact
                    </a>
                    <a href="/hexashop-1.0.0/about.php" class="text-gray-700 hover:text-black transition-colors">
                        À Propos
                    </a>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <button data-modal-toggle="searchModal"
                            class="p-2 text-gray-600 transition-all rounded-full hover:text-black hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <!-- Cart -->
                    <button data-modal-toggle="cartModal"
                            class="relative p-2 text-gray-600 transition-all rounded-full hover:text-black hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                        </svg>
                        <span class="cart-badge">3</span>
                    </button>

                    <!-- User -->
                    <button data-modal-toggle="authModal"
                            class="p-2 text-gray-600 transition-all rounded-full hover:text-black hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </button>

                    <!-- Mobile menu button -->
                    <button id="mobileMenuButton" class="lg:hidden p-2 text-gray-600 hover:text-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden bg-white border-t border-gray-200 lg:hidden">
                <nav class="flex flex-col py-4">
                    <a href="/hexashop-1.0.0/index.php" 
                       class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                        <i class="mr-3 text-gray-400 fas fa-home"></i>
                        Accueil
                    </a>
                    <a href="/hexashop-1.0.0/products.php" 
                       class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                        <i class="mr-3 text-gray-400 fas fa-shopping-bag"></i>
                        Produits
                    </a>
                    <a href="/hexashop-1.0.0/single-product.php" 
                       class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                        <i class="mr-3 text-gray-400 fas fa-box"></i>
                        Produit Unique
                    </a>
                    <a href="/hexashop-1.0.0/contact.php" 
                       class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                        <i class="mr-3 text-gray-400 fas fa-envelope"></i>
                        Contact
                    </a>
                    <a href="/hexashop-1.0.0/about.php" 
                       class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                        <i class="mr-3 text-gray-400 fas fa-info-circle"></i>
                        À Propos
                    </a>
                </nav>
            </div>
        </nav>
    </header>
</body>
</html>
