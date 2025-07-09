<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config/database.php';
$pdo = getDBConnection();

// Récupérer tous les produits
$stmt = $pdo->query("SELECT * FROM products WHERE product_type = 't-shirt' LIMIT 0,4");
$products = $stmt->fetchAll();
$stmt = $pdo->query("SELECT * FROM products WHERE product_type = 'hoodies' LIMIT 0,4");
$products2 = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php include 'includes/head.php'; ?>    
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
</head>
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
  <section class="relative w-full py-20">
    <div id="hero-carousel" class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          <!-- Slide 1 -->
          <li class="splide__slide">
            <div class="relative h-[250px] md:h-[350px] lg:h-[400px] overflow-hidden">
              <img src="src/images/baner-right-image-01.jpg" alt="Nouvelle Collection Femme" class="img-carousel w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
              <div class="absolute inset-0 flex items-center">
                <div class="container mx-auto px-4">
                  <div class="max-w-2xl text-white">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                      Nouvelle Collection
                      <span class="block text-gray-300">Femme 2024</span>
                    </h1>
                    <p class="text-lg md:text-xl mb-8 text-gray-200 leading-relaxed">
                      Découvrez notre collection exclusive en noir et blanc, où l'élégance rencontre le style contemporain.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                      <a href="products.php?category=women" class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">Découvrir<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></a>
                      <a href="products.php" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-300">Voir tout</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!-- Slide 2 -->
          <li class="splide__slide">
            <div class="relative h-[250px] md:h-[350px] lg:h-[400px] overflow-hidden">
              <img src="src/images/baner-right-image-02.jpg" alt="Collection Homme" class="img-carousel w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
              <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
              <div class="absolute inset-0 flex items-center">
                <div class="container mx-auto px-4">
                  <div class="max-w-2xl text-white">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                      Style Masculin
                      <span class="block text-gray-300">Élégance Moderne</span>
                    </h1>
                    <p class="text-lg md:text-xl mb-8 text-gray-200 leading-relaxed">
                      Une collection masculine qui allie sophistication et confort, pour l'homme moderne qui aime se démarquer.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                      <a href="products.php?category=men" class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">Explorer<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></a>
                      <a href="products.php" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-300">Collection</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!-- Slide 3 -->
          <li class="splide__slide">
            <div class="relative h-[250px] md:h-[350px] lg:h-[400px] overflow-hidden">
              <img src="src/images/baner-right-image-03.jpg" alt="Accessoires & Kids" class="img-carousel w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
              <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
              <div class="absolute inset-0 flex items-center">
                <div class="container mx-auto px-4">
                  <div class="max-w-2xl text-white">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                      Accessoires & Kids
                      <span class="block text-gray-300">Pour Toute la Famille</span>
                    </h1>
                    <p class="text-lg md:text-xl mb-8 text-gray-200 leading-relaxed">
                      Des accessoires tendance et des vêtements pour enfants, pour compléter le style de toute la famille.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                      <a href="products.php?category=accessories" class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">Accessoires<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></a>
                      <a href="products.php?category=kids" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-300">Kids</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!-- Slide 4 -->
          <li class="splide__slide">
            <div class="relative h-[250px] md:h-[350px] lg:h-[400px] overflow-hidden">
              <img src="src/images/left-banner-image.jpg" alt="Nouveautés" class="img-carousel w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
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
                      Découvrez en avant-première nos pièces exclusives et nos collaborations d'artistes.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                      <a href="products.php?new=1" class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">Voir les nouveautés<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></a>
                      <a href="products.php" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-300">Toute la collection</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- ***** Hero Carousel End ***** --> 
  <main id="main" class="py-20">
    <!-- ***** hoddies Area Starts ***** -->
    <section class="py-12 bg-white sm:py-16" id="men">
      <div class="container px-4 mx-auto">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto mb-8 text-center sm:mb-12">
        <h2 class="mb-4 text-3xl font-semibold text-primary">
            T-shirt Latest
          </h2>
          <p class="text-gray-600">
            Details to details is what makes Astrodia different from the other
            themes.
          </p>
        </div>

        <!-- Products Grid -->
        <div
        class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4"
        id="products"
      >
        <?php foreach ($products ?? [] as $product): ?>
        <div class="bg-white rounded-2xl shadow-lg flex flex-col transition-transform hover:-translate-y-1 hover:shadow-2xl overflow-hidden">
          <div class="relative w-full aspect-w-1 aspect-h-1 bg-gray-100">
            <!-- Wishlist Button -->
            <form method="post" action="/astrodia/actions/add_to_wishlist.php" class="absolute top-3 right-3 z-10" data-auth="<?php echo isset($_SESSION['user']['id']) ? '1' : '0'; ?>">
              <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
              <input type="hidden" name="redirect" value="/astrodia/index.php">
              <button type="submit" class="text-gray-400 hover:text-red-500 text-xl bg-white bg-opacity-80 rounded-full p-2 shadow transition-colors" title="Ajouter à la liste de souhaits">
                <i class="fa fa-heart"></i>
              </button>
            </form>
            <img src="src/images/<?php echo htmlspecialchars($product['image']); ?>"
                 alt="<?php echo htmlspecialchars($product['name']); ?>"
                 class="object-cover w-full h-full rounded-t-2xl transition-transform duration-300 hover:scale-105" />
          </div>
          <div class="flex-1 flex flex-col justify-between p-5">
            <div>
              <h4 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($product['name']); ?></h4>
              <span class="block text-lg font-semibold text-primary mb-4"><?php echo number_format($product['price'], 2); ?> €</span>
            </div>
           
              <a href="pages/single-product.php?id=<?php echo $product['id']; ?>"
                 class="w-full text-center rounded-lg border border-primary text-primary font-medium transition hover:bg-primary hover:text-white hover:bg-black mb-1">
                Voir plus
              </a>
              <form method="post" action="actions/add_to_cart.php" class="flex-1 add-to-cart-form" data-auth="<?php echo isset($_SESSION['user']['id']) ? '1' : '0'; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="redirect" value="/astrodia/index.php">
                <button type="submit" class="w-full text-center rounded-lg border border-primary text-primary font-medium transition hover:bg-primary hover:text-white hover:bg-black">Acheter</button>
              </form>
          
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      </div>
    </section>
    <!-- ***** t-shirt Area Starts ***** -->
    <section class="py-16 bg-gray-50" id="women">
      <div class="container px-4 mx-auto">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto mb-12 text-center">
          <h2 class="mb-4 text-3xl font-semibold text-primary">
            Hoodies Latest
          </h2>
          <p class="text-gray-600">
            Details to details is what makes Astrodia different from the other
            themes.
          </p>
        </div>

        <!-- Products Grid -->
        <div
        class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4"
        id="products"
      >
        <?php foreach ($products2 ?? [] as $product): ?>
        <div class="bg-white rounded-2xl shadow-lg flex flex-col transition-transform hover:-translate-y-1 hover:shadow-2xl overflow-hidden">
          <div class="relative w-full aspect-w-1 aspect-h-1 bg-gray-100">
            <!-- Wishlist Button -->
            <form method="post" action="/astrodia/actions/add_to_wishlist.php" class="absolute top-3 right-3 z-10" data-auth="<?php echo isset($_SESSION['user']['id']) ? '1' : '0'; ?>">
              <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
              <input type="hidden" name="redirect" value="/astrodia/index.php">
              <button type="submit" class="text-gray-400 hover:text-red-500 text-xl bg-white bg-opacity-80 rounded-full p-2 shadow transition-colors" title="Ajouter à la liste de souhaits">
                <i class="fa fa-heart"></i>
              </button>
            </form>
            <img src="src/images/<?php echo htmlspecialchars($product['image']); ?>"
                 alt="<?php echo htmlspecialchars($product['name']); ?>"
                 class="object-cover w-full h-full rounded-t-2xl transition-transform duration-300 hover:scale-105" />
          </div>
          <div class="flex-1 flex flex-col justify-between p-5">
            <div>
              <h4 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($product['name']); ?></h4>
              <span class="block text-lg font-semibold text-primary mb-4"><?php echo number_format($product['price'], 2); ?> €</span>
            </div>
           
              <a href="pages/single-product.php?id=<?php echo $product['id']; ?>"
                 class="w-full text-center rounded-lg border border-primary text-primary font-medium transition hover:bg-primary hover:text-white hover:bg-black mb-1">
                Voir plus
              </a>
              <form method="post" action="actions/add_to_cart.php" class="flex-1 add-to-cart-form" data-auth="<?php echo isset($_SESSION['user']['id']) ? '1' : '0'; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="redirect" value="/astrodia/index.php">
                <button type="submit" class="w-full text-center rounded-lg border border-primary text-primary font-medium transition hover:bg-primary hover:text-white hover:bg-black">Acheter</button>
              </form>
          
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      </div>
    </section>
  </main>
  <?php include 'includes/footer.php'; ?>
<!-- Scripts -->
  <?php include 'includes/scripts.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    new Splide('#hero-carousel', {
      type   : 'loop',
      perPage: 1,
      autoplay: true,
      interval: 4000,
      pauseOnHover: true,
      arrows: true,
      pagination: true,
      speed: 800,
    }).mount();
  });
  </script>
</body>
</html>
