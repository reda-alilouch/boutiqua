<!DOCTYPE html>
<html lang="en">
  <?php include '../includes/head.php'; ?>

  <body class="font-poppins">
    <!-- ***** Preloader Start ***** -->
    <div
      id="preloader"
      class="flex fixed inset-0 z-50 justify-center items-center bg-white"
    >
      <div class="flex space-x-2 jumper">
        <div class="w-3 h-3 rounded-full animate-bounce bg-accent"></div>
        <div
          class="w-3 h-3 rounded-full delay-75 animate-bounce bg-accent"
        ></div>
        <div
          class="w-3 h-3 rounded-full delay-150 animate-bounce bg-accent"
        ></div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->

   <?php include '../includes/header.php'; ?>
<main id="main"  class="py-20">
    <?php
    require_once __DIR__ . '/../config/database.php';
    $pdo = getDBConnection();

    $perPage = 8;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $perPage;

    // Nombre total de produits
    $totalStmt = $pdo->query('SELECT COUNT(*) FROM products');
    $totalProducts = $totalStmt->fetchColumn();
    $totalPages = ceil($totalProducts / $perPage);

    // Produits de la page courante
    $stmt = $pdo->prepare('SELECT * FROM products LIMIT :start, :perPage');
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll();
    ?>
    <!-- ***** Products Area Starts ***** -->
    <section class="py-16">
      <!-- Product Categories -->
      <div class="mb-12">
        <ul class="flex flex-wrap gap-4 justify-center">
          <li>
            <a
              href="#"
              data-filter="*"
              class="px-3 py-3 text-white bg-black rounded-full transition-colors"
              >All Products</a
            >
          </li>
          <li>
            <a
              href="#"
              data-filter=".new"
              class="px-3 py-3 text-black rounded-full border border-black transition-colors"
              >New Arrivals</a
            >
          </li>
          <li>
            <a
              href="#"
              data-filter=".special"
              class="px-3 py-3 text-black rounded-full border border-black transition-colors"
              >Special Offers</a
            >
          </li>
          <li>
            <a
              href="#"
              data-filter=".featured"
              class="px-3 py-3 text-black rounded-full border border-black transition-colors"
              >Featured</a
            >
          </li>
        </ul>
      </div>

      <!-- Products Grid -->
      <div
        class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4"
        id="products"
      >
        <?php foreach ($products as $product): ?>
        <div class="overflow-hidden relative rounded-lg shadow-lg group flex flex-col justify-between">
          <form method="post" action="../actions/add_to_wishlist.php" class="absolute top-3 right-3 z-10" data-auth="<?php echo isset($_SESSION['user']['id']) ? '1' : '0'; ?>">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <button type="submit" class="text-gray-400 hover:text-red-500 text-xl bg-white bg-opacity-80 rounded-full p-2 shadow transition-colors" title="Ajouter à la liste de souhaits">
              <i class="fa fa-heart"></i>
            </button>
          </form>
          <div class="relative aspect-w-1 aspect-h-1">
            <img src="/astrodia/src/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="object-cover w-full h-full" />
          </div>
          <div class="flex-1 flex flex-col justify-between p-5">
            <div>
              <h4 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($product['name']); ?></h4>
              <span class="block text-lg font-semibold text-primary mb-4"><?php echo number_format($product['price'], 2); ?> €</span>
            </div>
           
              <a href="single-product.php?id=<?php echo $product['id']; ?>"
                 class="w-full text-center rounded-lg border border-primary text-primary font-medium transition hover:bg-primary hover:text-white hover:bg-black mb-1">
                Voir plus
              </a>
              <form method="post" action="../actions/add_to_cart.php" class="flex-1 add-to-cart-form" data-auth="<?php echo isset($_SESSION['user']['id']) ? '1' : '0'; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="w-full text-center rounded-lg border border-primary text-primary font-medium transition hover:bg-primary hover:text-white hover:bg-black">Acheter</button>
              </form>
          
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Pagination -->
      <div class="flex justify-center mt-12 space-x-2">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <a href="?page=<?php echo $i; ?>"
             class="px-4 py-2 rounded-lg border transition-colors <?php echo $i == $page ? 'bg-primary text-white bg-black' : 'border-primary text-primary hover:bg-primary hover:text-white hover:bg-gray-800'; ?>">
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>
      </div>
    </section>
    <!-- ***** Products Area Ends ***** -->
</main>
    <!-- ***** Footer Start ***** -->
    <?php include '../includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="/astrodia/assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
   

    <!-- Alpine.js -->
    

    <!-- Plugins -->
    <script src="/astrodia/assets/js/owl-carousel.js"></script>
    <script src="/astrodia/assets/js/accordions.js"></script>
    <script src="/astrodia/assets/js/scrollreveal.min.js"></script>
    <script src="/astrodia/assets/js/waypoints.min.js"></script>
    <script src="/astrodia/assets/js/jquery.counterup.min.js"></script>
    <script src="/astrodia/assets/js/imgfix.min.js"></script>
    <script src="/astrodia/assets/js/slick.js"></script>
    <script src="/astrodia/assets/js/lightbox.js"></script>
    <script src="/astrodia/assets/js/isotope.js"></script>

    <!-- Custom JavaScript -->
    <script src="/astrodia/assets/js/custom.js"></script>
    <?php include '../includes/scripts.php'; ?>
  </body>
</html>
