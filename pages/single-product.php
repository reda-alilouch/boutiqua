<?php
require_once __DIR__ . '/../config/database.php';
$pdo = getDBConnection();

$product = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
 <?php include '../includes/head.php'; ?>

  <body class="font-poppins">
    <!-- ***** Preloader Start ***** -->
    <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
      <div class="flex space-x-2 jumper">
        <div class="w-3 h-3 rounded-full bg-accent animate-bounce"></div>
        <div class="w-3 h-3 delay-75 rounded-full bg-accent animate-bounce"></div>
        <div class="w-3 h-3 delay-150 rounded-full bg-accent animate-bounce"></div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <?php include '../includes/header.php'; ?>
<main id="main" class="py-20">
<?php if ($product): ?>
    <!-- ***** Product Area Starts ***** -->
    <section class="py-16">
      <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
          <!-- Product Images -->
          <div class="space-y-6">
            <!-- Main Image -->
            <div class="relative overflow-hidden rounded-lg aspect-w-4 aspect-h-3">
              <img id="main-image" src="src/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="object-cover w-full h-full" />
</div>
          </div>

          <!-- Product Details -->
          <div class="space-y-8">
            <div>
              <h1 class="mb-4 text-3xl font-bold text-gray-900"><?php echo htmlspecialchars($product['name']); ?></h1>
              <div class="flex items-center mb-4 space-x-4">
                <span class="text-2xl font-semibold text-accent"><?php echo number_format($product['price'], 2); ?> €</span>
              </div>
              <p class="leading-relaxed text-gray-600"><?php echo htmlspecialchars($product['description']); ?></p>
            </div>
            <!-- Size Selection -->
           
            <!-- Quantity and Add to Cart -->
            <div class="flex items-center space-x-6">
              <div class="flex items-center border-2 border-gray-300 rounded-lg">
                <input type="number" id="quantity" class="w-20 p-2 text-center border-0 focus:outline-none" value="1" min="1" />
              </div>
              <form method="post" action="add_to_cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit"
                class="w-24 p-2 text-center rounded-lg border border-primary text-primary font-medium transition hover:bg-primary hover:text-white hover:bg-black">
                Acheter
                </button>
              </form>
            </div>
            <!-- Additional Information -->
            <div class="pt-8 space-y-6 border-t border-gray-200">
              <div>
                <h3 class="mb-2 text-lg font-semibold">Product Details</h3>
                <p class="text-gray-600">
                  <!-- Ajoute ici d'autres infos si besoin -->
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php else: ?>
  <div class="container mx-auto p-8 text-center text-red-600 text-xl font-semibold">
    Produit introuvable.
  </div>
<?php endif; ?>
</main>
    <!-- ***** Footer Start ***** -->
    <?php include '../includes/footer.php'; ?>

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
    
    <!-- Scripts -->
    <?php include '../includes/scripts.php'; ?>
  </body>
</html>
