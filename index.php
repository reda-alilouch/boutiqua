<?php include 'includes/head.php'; ?>
<body class="font-poppins" x-data="{ isSearchOpen: false, isAuthOpen: false }">
  <!-- ***** Preloader Start ***** -->
  <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
    <div class="flex space-x-2 jumper">
      <div class="w-3 h-3 rounded-full bg-accent animate-bounce"></div>
      <div class="w-3 h-3 delay-75 rounded-full bg-accent animate-bounce"></div>
      <div class="w-3 h-3 delay-150 rounded-full bg-accent animate-bounce"></div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <?php include 'includes/header.php'; ?>
  
  <!-- ***** Hero Carousel Start ***** -->
  <section class="relative w-full bg-black">
    <div class="swiper hero-swiper">
      <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide relative">
          <div class="relative h-[400px] md:h-[500px] lg:h-[600px] overflow-hidden">
            <img src="src/images/baner-right-image-01.jpg" 
                 alt="Nouvelle Collection Femme" 
                 class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
              <div class="container mx-auto px-4">
                <div class="max-w-2xl text-white">
                  <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                    Nouvelle Collection
                    <span class="block text-gray-300">Femme 2024</span>
                  </h1>
                  <p class="text-lg md:text-xl mb-8 text-gray-200 leading-relaxed">
                    Découvrez notre collection exclusive en noir et blanc, 
                    où l'élégance rencontre le style contemporain.
                  </p>
                  <div class="flex flex-col sm:flex-row gap-4">
                    <a href="products.php?category=women" 
                       class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                      Découvrir
                      <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg>
                    </a>
                    <a href="products.php" 
                       class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-300">
                      Voir tout
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="swiper-slide relative">
          <div class="relative h-[400px] md:h-[500px] lg:h-[600px] overflow-hidden">
            <img src="src/images/baner-right-image-02.jpg" 
                 alt="Collection Homme" 
                 class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
              <div class="container mx-auto px-4">
                <div class="max-w-2xl text-white">
                  <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                    Style Masculin
                    <span class="block text-gray-300">Élégance Moderne</span>
                  </h1>
                  <p class="text-lg md:text-xl mb-8 text-gray-200 leading-relaxed">
                    Une collection masculine qui allie sophistication et confort, 
                    pour l'homme moderne qui aime se démarquer.
                  </p>
                  <div class="flex flex-col sm:flex-row gap-4">
                    <a href="products.php?category=men" 
                       class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                      Explorer
                      <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg>
                    </a>
                    <a href="products.php" 
                       class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-300">
                      Collection
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="swiper-slide relative">
          <div class="relative h-[400px] md:h-[500px] lg:h-[600px] overflow-hidden">
            <img src="src/images/baner-right-image-03.jpg" 
                 alt="Accessoires & Kids" 
                 class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
              <div class="container mx-auto px-4">
                <div class="max-w-2xl text-white">
                  <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                    Accessoires & Kids
                    <span class="block text-gray-300">Pour Toute la Famille</span>
                  </h1>
                  <p class="text-lg md:text-xl mb-8 text-gray-200 leading-relaxed">
                    Des accessoires tendance et des vêtements pour enfants, 
                    pour compléter le style de toute la famille.
                  </p>
                  <div class="flex flex-col sm:flex-row gap-4">
                    <a href="products.php?category=accessories" 
                       class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                      Accessoires
                      <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg>
                    </a>
                    <a href="products.php?category=kids" 
                       class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-300">
                      Kids
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 4 -->
        <div class="swiper-slide relative">
          <div class="relative h-[400px] md:h-[500px] lg:h-[600px] overflow-hidden">
            <img src="src/images/left-banner-image.jpg" 
                 alt="Nouveautés" 
                 class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
              <div class="container mx-auto px-4">
                <div class="max-w-2xl text-white">
                  <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                    <span class="text-sm font-semibold text-white">NOUVEAUTÉS</span>
                    <div class="ml-2 w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                  </div>
                  <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                    Nouveautés
                    <span class="block text-gray-300">Édition Limitée</span>
                  </h1>
                  <p class="text-lg md:text-xl mb-8 text-gray-200 leading-relaxed">
                    Découvrez en avant-première nos pièces exclusives 
                    et nos collaborations d'artistes.
                  </p>
                  <div class="flex flex-col sm:flex-row gap-4">
                    <a href="products.php?new=1" 
                       class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                      Voir les nouveautés
                      <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg>
                    </a>
                    <a href="products.php" 
                       class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-300">
                      Toute la collection
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Navigation Arrows -->
      <div class="swiper-button-next hero-swiper-button-next"></div>
      <div class="swiper-button-prev hero-swiper-button-prev"></div>

      <!-- Pagination -->
      <div class="swiper-pagination hero-swiper-pagination"></div>
    </div>
  </section>
  <!-- ***** Hero Carousel End ***** -->

    
<main id="main" class="py-20">

    <!-- AOS Animation JS est maintenant inclus dans scripts.php -->
    
    <!-- Categories Grid Section -->
    <section class="container px-4 py-12 mx-auto">
      <!-- Section Header -->

      <div class="grid grid-cols-2 grid-rows-4 gap-4 md:grid-cols-4 md:grid-rows-2 md:gap-6">
        <!-- Main Category (Women) - Full width on mobile, 2 columns on desktop -->
        <div 
          class="relative overflow-hidden shadow-xl rounded-2xl group col-span-2 row-span-2 min-h-[400px] md:min-h-[600px] transform transition-all duration-700 hover:shadow-2xl hover:-translate-y-1"
          data-aos="fade-right"
          data-aos-duration="800">
          <div class="relative w-full h-full">
            <div class="absolute inset-0 flex flex-col justify-end p-6 transition-transform duration-500 transform bg-gradient-to-t from-black/70 to-transparent z-10">
              <h4 class="text-2xl font-semibold text-white transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2 md:text-3xl">Women</h4>
              <span class="text-lg text-white/90 transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2">Best Clothes For Women</span>
            </div>
            <div class="absolute inset-0 flex items-center justify-center p-6 transition-all duration-500 opacity-0 bg-black/70 group-hover:opacity-100 z-20">
              <div class="text-center text-white transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                <h4 class="mb-3 text-3xl font-semibold md:text-4xl">Women</h4>
                <p class="mb-6 text-lg opacity-90 md:mb-8">Découvrez notre collection féminine tendance pour toutes les occasions.</p>
                <a href="products.php?category=women" class="inline-flex items-center px-8 py-3 text-lg font-medium text-white transition-all duration-300 transform border-2 border-white rounded-full hover:bg-white hover:text-primary hover:scale-105 group-hover:animate-bounce">
                  Découvrir
                  <svg class="w-5 h-5 ml-2 transition-transform duration-300 transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                  </svg>
                </a>
              </div>
            </div>
            <img src="src/images/baner-right-image-01.jpg" 
                 class="object-cover w-full h-full transition-transform duration-700 transform group-hover:scale-110" 
                 alt="Women's Collection" 
                 loading="lazy" />
          </div>
        </div>

        <!-- Men Category -->
        <div 
          class="relative overflow-hidden shadow-xl rounded-2xl group row-start-3 md:col-start-3 md:row-start-1 transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-1"
          data-aos="fade-left"
          data-aos-duration="800"
          data-aos-delay="100">
          <div class="relative w-full h-full min-h-[200px] md:min-h-0">
            <div class="absolute inset-0 flex flex-col justify-end p-4 transition-transform duration-500 transform bg-gradient-to-t from-black/70 to-transparent z-10 md:p-6">
              <h4 class="text-xl font-semibold text-white transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2">Men</h4>
              <span class="text-sm text-white/90 transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2 md:text-base">Best Clothes For Men</span>
            </div>
            <div class="absolute inset-0 flex items-center justify-center p-4 transition-all duration-500 opacity-0 bg-black/70 group-hover:opacity-100 z-20 md:p-6">
              <div class="text-center text-white transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                <h4 class="mb-2 text-xl font-semibold md:text-2xl">Men</h4>
                <p class="mb-3 text-sm opacity-90 md:mb-4 md:text-base">Style et confort pour votre garde-robe.</p>
                <a href="products.php?category=men" class="group relative inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-300 transform border-2 border-white rounded-full hover:bg-white hover:text-primary hover:scale-105 md:px-6 md:py-2 md:text-base">
                  Voir plus
                  <svg class="w-4 h-4 ml-1 transition-transform duration-300 transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                  </svg>
                </a>
              </div>
            </div>
            <img src="src/images/baner-right-image-02.jpg" 
                 class="object-cover w-full h-full transition-transform duration-700 transform group-hover:scale-110" 
                 alt="Men's Collection" 
                 loading="lazy" />
          </div>
        </div>

        <!-- Kids Category -->
        <div 
          class="relative overflow-hidden shadow-xl rounded-2xl group row-start-3 md:col-start-4 md:row-start-1 transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-1"
          data-aos="fade-left"
          data-aos-duration="800"
          data-aos-delay="200">
          <div class="relative w-full h-full min-h-[200px] md:min-h-0">
            <div class="absolute inset-0 flex flex-col justify-end p-4 transition-transform duration-500 transform bg-gradient-to-t from-black/70 to-transparent z-10 md:p-6">
              <h4 class="text-xl font-semibold text-white transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2">Kids</h4>
              <span class="text-sm text-white/90 transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2 md:text-base">Best Clothes For Kids</span>
            </div>
            <div class="absolute inset-0 flex items-center justify-center p-4 transition-all duration-500 opacity-0 bg-black/70 group-hover:opacity-100 z-20 md:p-6">
              <div class="text-center text-white transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                <h4 class="mb-2 text-xl font-semibold md:text-2xl">Kids</h4>
                <p class="mb-3 text-sm opacity-90 md:mb-4 md:text-base">Des vêtements mignons pour les petits.</p>
                <a href="products.php?category=kids" class="group relative inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-300 transform border-2 border-white rounded-full hover:bg-white hover:text-primary hover:scale-105 md:px-6 md:py-2 md:text-base">
                  Découvrir
                  <svg class="w-4 h-4 ml-1 transition-transform duration-300 transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                  </svg>
                </a>
              </div>
            </div>
            <img src="src/images/baner-right-image-03.jpg" 
                 class="object-cover w-full h-full transition-transform duration-700 transform group-hover:scale-110" 
                 alt="Kids Collection" 
                 loading="lazy" />
          </div>
        </div>

        <!-- Accessories Category -->
        <div 
          class="relative overflow-hidden shadow-xl rounded-2xl group row-start-4 col-start-1 md:col-start-3 md:row-start-2 transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-1"
          data-aos="fade-up"
          data-aos-duration="800">
          <div class="relative w-full h-full min-h-[200px] md:min-h-0">
            <div class="absolute inset-0 flex flex-col justify-end p-4 transition-transform duration-500 transform bg-gradient-to-t from-black/70 to-transparent z-10 md:p-6">
              <h4 class="text-xl font-semibold text-white transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2">Accessories</h4>
              <span class="text-sm text-white/90 transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2 md:text-base">Best Trend Accessories</span>
            </div>
            <div class="absolute inset-0 flex items-center justify-center p-4 transition-all duration-500 opacity-0 bg-black/70 group-hover:opacity-100 z-20 md:p-6">
              <div class="text-center text-white transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                <h4 class="mb-2 text-xl font-semibold md:text-2xl">Accessories</h4>
                <p class="mb-3 text-sm opacity-90 md:mb-4 md:text-base">Des accessoires pour compléter votre style.</p>
                <a href="products.php?category=accessories" class="group relative inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-300 transform border-2 border-white rounded-full hover:bg-white hover:text-primary hover:scale-105 md:px-6 md:py-2 md:text-base">
                  Explorer
                  <svg class="w-4 h-4 ml-1 transition-transform duration-300 transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                  </svg>
                </a>
              </div>
            </div>
            <img src="src/images/baner-right-image-04.jpg" 
                 class="object-cover w-full h-full transition-transform duration-700 transform group-hover:scale-110" 
                 alt="Accessories Collection" 
                 loading="lazy" />
          </div>
        </div>

        <!-- New Arrivals -->
        <div 
          class="relative overflow-hidden shadow-xl rounded-2xl group row-start-4 col-start-2 md:col-start-4 md:row-start-2 transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-1"
          data-aos="fade-up"
          data-aos-duration="800"
          data-aos-delay="100">
          <div class="relative w-full h-full min-h-[200px] md:min-h-0">
            <!-- Badge Nouveautés avec animation -->
            <div class="absolute top-4 right-4 z-20">
              <span class="inline-flex items-center px-3 py-1 text-xs font-bold tracking-wider text-white uppercase bg-gradient-to-r from-pink-500 to-purple-500 rounded-full shadow-lg">
                Nouveautés
                <span class="absolute flex w-2 h-2 -top-1 -right-1">
                  <span class="absolute inline-flex w-full h-full bg-pink-400 rounded-full opacity-75 animate-ping"></span>
                  <span class="relative inline-flex w-2 h-2 bg-pink-500 rounded-full"></span>
                </span>
              </span>
            </div>
            <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center transition-all duration-500 transform bg-black/40 group-hover:bg-black/60 z-10 md:p-6">
              <h4 class="text-xl font-semibold text-white transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2 md:text-2xl">Nouvelle Collection</h4>
              <p class="mt-1 text-sm text-white/90 transition-all duration-500 transform translate-y-0 group-hover:-translate-y-2 md:text-base">Découvrez nos dernières tendances</p>
              <a href="products.php?new=1" class="mt-4 group relative inline-flex items-center px-6 py-2 text-sm font-medium text-white transition-all duration-300 transform border-2 border-white rounded-full opacity-0 group-hover:opacity-100 hover:bg-white hover:text-primary hover:scale-105">
                Voir la collection
                <svg class="w-4 h-4 ml-1 transition-transform duration-300 transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
              </a>
            </div>
            <img src="src/images/left-banner-image.jpg" 
                 class="object-cover w-full h-full transition-transform duration-700 transform group-hover:scale-110" 
                 alt="Nouveautés Collection" 
                 loading="lazy" />
          </div>
        </div>
      </div>
    </section>
    <!-- End Categories Grid Section -->
          
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Men Area Starts ***** -->
    <section class="py-12 bg-white sm:py-16" id="men">
      <div class="container px-4 mx-auto">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto mb-8 text-center sm:mb-12">
          <h2 class="mb-3 text-2xl font-semibold text-primary sm:text-3xl md:mb-4">Men's Latest</h2>
          <p class="text-gray-600 text-sm sm:text-base">
            Details to details is what makes Astrodia different from other themes.
          </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:gap-4 md:gap-6">
          <?php
          require_once __DIR__ . '/config/database.php';
          $pdo = new PDO('mysql:host=localhost;dbname=astrodia;charset=utf8mb4', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
          $stmt = $pdo->prepare('SELECT * FROM products WHERE category = ? LIMIT 8');
          $stmt->execute(['men']);
          $products = $stmt->fetchAll();
          foreach ($products as $product): ?>
            <div class="relative overflow-hidden transition-all duration-300 bg-white border border-gray-100 rounded-lg shadow-sm group hover:shadow-md">
              <div class="relative pt-[100%] sm:pt-[120%] md:pt-[100%]">
                <img
                  src="src/images/<?php echo htmlspecialchars($product['image']); ?>"
                  alt="<?php echo htmlspecialchars($product['title']); ?>"
                  class="absolute inset-0 object-cover w-full h-full transition-opacity duration-300 group-hover:opacity-90"
                  loading="lazy"
                />
                <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100">
                  <a href="single-product.php?id=<?php echo $product['id']; ?>" class="p-2 text-white transition-all duration-300 transform bg-primary rounded-full hover:scale-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:p-3" aria-label="Voir le produit">
                    <i class="fa fa-eye"></i>
                  </a>
                </div>
              </div>
              <div class="p-4">
                <div class="h-12 mb-2">
                  <h3 class="font-medium text-gray-900 line-clamp-2"><?php echo htmlspecialchars($product['title']); ?></h3>
                </div>
                <p class="text-sm text-gray-500 mb-2 line-clamp-2"><?php echo htmlspecialchars($product['description']); ?></p>
                <span class="text-lg font-medium text-accent"><?php echo number_format($product['price'], 2, ',', ' '); ?> €</span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <!-- ***** Men Area Ends ***** -->

    <!-- ***** Women Area Starts ***** -->
    <section class="py-16 bg-gray-50" id="women">
      <div class="container px-4 mx-auto">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto mb-12 text-center">
          <h2 class="mb-4 text-3xl font-semibold text-primary">
            Women's Latest
          </h2>
          <p class="text-gray-600">
            Details to details is what makes Astrodia different from the other
            themes.
          </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
          <?php
          $stmt = $pdo->prepare('SELECT * FROM products WHERE category = ? LIMIT 8');
          $stmt->execute(['women']);
          $products = $stmt->fetchAll();
          foreach ($products as $product): ?>
            <div class="relative overflow-hidden bg-white rounded-lg shadow-lg group">
              <div class="relative aspect-w-1 aspect-h-1">
                <img
                  src="src/images/<?php echo htmlspecialchars($product['image']); ?>"
                  alt="<?php echo htmlspecialchars($product['title']); ?>"
                  class="object-cover w-full h-full"
                  loading="lazy"
                />
                <!-- Hover Content -->
                <div
                  class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
                >
                  <a
                    href="single-product.php?id=<?php echo $product['id']; ?>"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                </div>
              </div>
              <div class="p-4">
                <h4 class="mb-2 text-lg font-semibold"><?php echo htmlspecialchars($product['title']); ?></h4>
                <span class="text-lg font-medium text-accent"><?php echo number_format($product['price'], 2, ',', ' '); ?> €</span>
                <p class="text-sm text-gray-500 mt-2 line-clamp-2"><?php echo htmlspecialchars($product['description']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <!-- ***** Women Area Ends ***** -->

    <!-- ***** Kids Area Starts ***** -->
    <section class="py-16" id="kids">
      <div class="container px-4 mx-auto">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto mb-12 text-center">
          <h2 class="mb-4 text-3xl font-semibold text-primary">Kid's Latest</h2>
          <p class="text-gray-600">
            Details to details is what makes Astrodia different from the other
            themes.
          </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
          <!-- Product 1 -->
          <div
            class="relative overflow-hidden bg-white rounded-lg shadow-lg group"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/kid-01.jpg"
                alt="School Collection"
                class="object-cover w-full h-full"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="mb-2 text-lg font-semibold">School Collection</h4>
              <span class="text-lg font-medium text-accent">$80.00</span>
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
            class="relative overflow-hidden bg-white rounded-lg shadow-lg group"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/kid-02.jpg"
                alt="Summer Cap"
                class="object-cover w-full h-full"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="mb-2 text-lg font-semibold">Summer Cap</h4>
              <span class="text-lg font-medium text-accent">$12.00</span>
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
            class="relative overflow-hidden bg-white rounded-lg shadow-lg group"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/kid-03.jpg"
                alt="Classic Kid"
                class="object-cover w-full h-full"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="mb-2 text-lg font-semibold">Classic Kid</h4>
              <span class="text-lg font-medium text-accent">$30.00</span>
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
            class="relative overflow-hidden bg-white rounded-lg shadow-lg group"
          >
            <div class="relative aspect-w-1 aspect-h-1">
              <img
                src="assets/images/kid-01.jpg"
                alt="Classic Spring"
                class="object-cover w-full h-full"
              />
              <!-- Hover Content -->
              <div
                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
              >
                <div class="flex space-x-4">
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-eye"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-star"></i>
                  </a>
                  <a
                    href="single-product.html"
                    class="p-2 transition-colors bg-white rounded-full hover:bg-accent hover:text-white"
                  >
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="p-4">
              <h4 class="mb-2 text-lg font-semibold">Classic Spring</h4>
              <span class="text-lg font-medium text-accent">$120.00</span>
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
      <div class="container px-4 mx-auto">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto mb-12 text-center">
          <h2 class="mb-4 text-3xl font-semibold text-primary">Social Media</h2>
          <p class="text-gray-600">
            Details to details is what makes Astrodia different from the other
            themes.
          </p>
        </div>

        <!-- Instagram Grid -->
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-6">
          <!-- Instagram Item 1 -->
          <div class="relative overflow-hidden rounded-lg group">
            <img
              src="assets/images/instagram-01.jpg"
              alt="Fashion Collection"
              class="object-cover w-full h-full aspect-square"
            />
            <div
              class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="mb-2 text-lg font-semibold">Fashion</h6>
                <i class="text-2xl fa fa-instagram"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 2 -->
          <div class="relative overflow-hidden rounded-lg group">
            <img
              src="assets/images/instagram-02.jpg"
              alt="New Collection"
              class="object-cover w-full h-full aspect-square"
            />
            <div
              class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="mb-2 text-lg font-semibold">New</h6>
                <i class="text-2xl fa fa-instagram"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 3 -->
          <div class="relative overflow-hidden rounded-lg group">
            <img
              src="assets/images/instagram-03.jpg"
              alt="Brand Collection"
              class="object-cover w-full h-full aspect-square"
            />
            <div
              class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="mb-2 text-lg font-semibold">Brand</h6>
                <i class="text-2xl fa fa-instagram"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 4 -->
          <div class="relative overflow-hidden rounded-lg group">
            <img
              src="assets/images/instagram-04.jpg"
              alt="Makeup Collection"
              class="object-cover w-full h-full aspect-square"
            />
            <div
              class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="mb-2 text-lg font-semibold">Makeup</h6>
                <i class="text-2xl fa fa-instagram"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 5 -->
          <div class="relative overflow-hidden rounded-lg group">
            <img
              src="assets/images/instagram-05.jpg"
              alt="Leather Collection"
              class="object-cover w-full h-full aspect-square"
            />
            <div
              class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="mb-2 text-lg font-semibold">Leather</h6>
                <i class="text-2xl fa fa-instagram"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Item 6 -->
          <div class="relative overflow-hidden rounded-lg group">
            <img
              src="assets/images/instagram-06.jpg"
              alt="Bag Collection"
              class="object-cover w-full h-full aspect-square"
            />
            <div
              class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100"
            >
              <a href="http://instagram.com" class="text-center text-white">
                <h6 class="mb-2 text-lg font-semibold">Bag</h6>
                <i class="text-2xl fa fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ***** Social Area Ends ***** -->

    <!-- ***** Subscribe Area Starts ***** -->
    <section class="py-16 bg-gray-50" id="subscribe">
      <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
          <!-- Newsletter Form -->
          <div class="lg:col-span-8">
            <div class="max-w-2xl">
              <h2 class="mb-4 text-3xl font-semibold text-primary">
                By Subscribing To Our Newsletter You Can Get 30% Off
              </h2>
              <p class="mb-8 text-gray-600">
                Details to details is what makes Astrodia different from the
                other themes.
              </p>

              <form
                id="subscribe"
                action=""
                method="get"
                class="flex flex-col gap-4 md:flex-row"
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
                    class="w-full px-6 py-3 text-white transition-colors duration-300 rounded-lg md:w-auto bg-primary hover:bg-primary-dark"
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
                  <h6 class="mb-1 text-sm font-semibold text-gray-600">
                    Store Location:
                  </h6>
                  <p class="text-gray-800">
                    Sunny Isles Beach, FL 33160, United States
                  </p>
                </div>
                <div>
                  <h6 class="mb-1 text-sm font-semibold text-gray-600">
                    Phone:
                  </h6>
                  <p class="text-gray-800">010-020-0340</p>
                </div>
                <div>
                  <h6 class="mb-1 text-sm font-semibold text-gray-600">
                    Office Location:
                  </h6>
                  <p class="text-gray-800">North Miami Beach</p>
                </div>
              </div>
              <div class="space-y-6">
                <div>
                  <h6 class="mb-1 text-sm font-semibold text-gray-600">
                    Work Hours:
                  </h6>
                  <p class="text-gray-800">07:30 AM - 9:30 PM Daily</p>
                </div>
                <div>
                  <h6 class="mb-1 text-sm font-semibold text-gray-600">
                    Email:
                  </h6>
                  <p class="text-gray-800">info@company.com</p>
                </div>
                <div>
                  <h6 class="mb-1 text-sm font-semibold text-gray-600">
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
</main>
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
<script src="assets/js/quantity.js"></script>

<!-- Global Init -->
<script src="assets/js/custom.js"></script>

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

    <?php include 'includes/test-modal.php'; ?>
  </body>
</html>
