<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include '../includes/head.php'; ?>
  <link rel="stylesheet" href="../src/css/tailwind.css">
  <link rel="stylesheet" href="../src/css/menu.css">
  <link rel="stylesheet" href="../src/css/responsive.css">   
  <link rel="stylesheet" href="../src/css/style.css">
  <link rel="stylesheet" href="../src/css/modals.css">
</head>

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

    // Formulaire de filtre
    ?>
    
    <!-- ***** Products Area Starts ***** -->
    <section class="py-16">
      <!-- Product Categories -->
      <form method="get" class="flex flex-wrap gap-4 justify-center mb-8">
      <select name="gender" class="border rounded px-2">
        <option value="">Genre</option>
        <option value="homme" <?php if(isset($_GET['gender']) && $_GET['gender']=='homme') echo 'selected'; ?>>Homme</option>
        <option value="femme" <?php if(isset($_GET['gender']) && $_GET['gender']=='femme') echo 'selected'; ?>>Femme</option>
      </select>
      <select name="product_type" class="border rounded px-2">
        <option value="">Type</option>
        <option value="hoodies" <?php if(isset($_GET['product_type']) && $_GET['product_type']=='hoodies') echo 'selected'; ?>>Hoodies</option>
        <option value="t-shirt" <?php if(isset($_GET['product_type']) && $_GET['product_type']=='t-shirt') echo 'selected'; ?>>T-shirt</option>
      </select>
      <button type="submit" class="px-2 bg-black text-white rounded">Filtrer</button>
    </form>
    <?php

    // Gestion des filtres
    $where = [];
    $params = [];
    if (!empty($_GET['gender'])) {
        $where[] = 'gender = :gender';
        $params[':gender'] = $_GET['gender'];
    }
    if (!empty($_GET['product_type'])) {
        $where[] = 'product_type = :product_type';
        $params[':product_type'] = $_GET['product_type'];
    }
    $whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

    // Nombre total de produits filtrés
    $totalStmt = $pdo->prepare("SELECT COUNT(*) FROM products $whereSql");
    foreach ($params as $key => $val) {
        $totalStmt->bindValue($key, $val);
    }
    $totalStmt->execute();
    $totalProducts = $totalStmt->fetchColumn();
    $totalPages = ceil($totalProducts / $perPage);

    // Produits de la page courante filtrés
    $stmt = $pdo->prepare("SELECT * FROM products $whereSql LIMIT :start, :perPage");
    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll();
    ?>

      <!-- Products Grid -->
      <div
        class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4"
        id="products"
      >
        <?php foreach ($products as $product): ?>
        <div class="overflow-hidden relative rounded-lg shadow-lg group flex flex-col justify-between product-card <?php echo strtolower(str_replace(' ', '-', $product['category'] ?? 'all')); ?>">
          <form method="post" action="/boutiqua/actions/add_to_wishlist.php" class="absolute top-3 right-3 z-10" data-auth="<?php echo isset($_SESSION['user']['id']) ? '1' : '0'; ?>">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="redirect" value="/boutiqua/pages/products.php">
            <button type="submit" class="text-gray-400 hover:text-red-500 text-xl bg-white bg-opacity-80 rounded-full p-2 shadow transition-colors" title="Ajouter à la liste de souhaits">
              <i class="fa fa-heart"></i>
            </button>
          </form>
          <div class="relative aspect-w-1 aspect-h-1">
            <img src="/boutiqua/src/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="object-cover w-full h-full" />
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
                <input type="hidden" name="redirect" value="/boutiqua/pages/products.php">
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
    <?php include '../includes/scripts.php'; ?>

<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const filter = this.getAttribute('data-filter');
    document.querySelectorAll('.product-card').forEach(card => {
      card.style.removeProperty('display'); // Toujours réinitialiser l'affichage
      if (filter !== 'all' && !card.classList.contains(filter)) {
        card.style.display = 'none';
      }
    });
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('bg-black', 'text-white'));
    this.classList.add('bg-black', 'text-white');
  });
});
window.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.product-card').forEach(card => card.style.removeProperty('display'));
});
</script>
  </body>
</html>
