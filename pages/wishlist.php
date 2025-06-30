<?php
session_start();
require_once __DIR__ . '/../config/database.php';
if (!isset($_SESSION['user']['id'])) {
    header('Location: pages/login.php');
    exit;
}
$pdo = getDBConnection();
$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare('SELECT w.*, p.name, p.image, p.price FROM wishlist w JOIN products p ON w.product_id = p.id WHERE w.user_id = ?');
$stmt->execute([$user_id]);
$wishlist = $stmt->fetchAll();
?>
<?php include '../includes/head.php'; ?>
<body class="font-poppins">
<?php include '../includes/header.php'; ?>

<main class="py-20">
  <div class="container mx-auto px-4">
    <!-- Header -->
    <div class="max-w-2xl mx-auto mb-12 text-center">
      <h1 class="mb-4 text-3xl font-semibold text-primary">Ma Liste de Souhaits</h1>
      <p class="text-gray-600">
        Retrouvez tous vos produits favoris dans un seul endroit.
      </p>
    </div>

    <?php if (empty($wishlist)): ?>
      <!-- Empty State -->
      <div class="max-w-md mx-auto text-center py-12">
        <div class="mb-6">
          <i class="fa fa-heart text-6xl text-gray-300"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Votre liste de souhaits est vide</h3>
        <p class="text-gray-500 mb-6">Ajoutez des produits à votre liste de souhaits pour les retrouver facilement.</p>
        <a href="products.php" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-colors">
          Découvrir nos produits
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
          </svg>
        </a>
      </div>
    <?php else: ?>
      <!-- Wishlist Items -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach ($wishlist as $item): ?>
          <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-2xl">
            <!-- Product Image -->
            <div class="relative">
              <img src="src/images/<?php echo htmlspecialchars($item['image']); ?>" 
                   alt="<?php echo htmlspecialchars($item['name']); ?>" 
                   class="w-full h-48 object-cover">
              
              <!-- Remove from wishlist button -->
              <form method="post" action="remove_from_wishlist.php" class="absolute top-3 right-3">
                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                <button type="submit" class="bg-white bg-opacity-90 rounded-full p-2 text-red-500 hover:bg-red-500 hover:text-white transition-colors" 
                        title="Retirer de la liste de souhaits">
                  <i class="fa fa-times"></i>
                </button>
              </form>
            </div>
            
            <!-- Product Info -->
            <div class="p-5">
              <h3 class="text-lg font-semibold text-gray-900 mb-2"><?php echo htmlspecialchars($item['name']); ?></h3>
              <div class="flex items-center justify-between mb-4">
                <span class="text-xl font-bold text-primary"><?php echo number_format($item['price'], 2); ?> €</span>
                <span class="text-sm text-gray-500">Ajouté le <?php echo date('d/m/Y', strtotime($item['created_at'])); ?></span>
              </div>
              
              <!-- Action Buttons -->
              <div class="flex gap-2">
                <a href="single-product.php?id=<?php echo $item['product_id']; ?>" 
                   class="flex-1 text-center border border-primary text-primary font-medium rounded-lg hover:bg-primary hover:text-white transition-colors">
                  Voir détails
                </a>
                <form method="post" action="add_to_cart.php" class="flex-1">
                  <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="w-full bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    Ajouter au panier
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      
      <!-- Summary -->
      <div class="mt-12 max-w-md mx-auto bg-gray-50 rounded-lg p-6 text-center">
        <p class="text-gray-600 mb-2">Vous avez <strong><?php echo count($wishlist); ?></strong> produit<?php echo count($wishlist) > 1 ? 's' : ''; ?> dans votre liste</p>
        <a href="products.php" class="text-primary hover:text-primary-dark font-medium">
          Continuer mes achats →
        </a>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php include '../includes/footer.php'; ?>

<!-- Scripts -->
<?php include '../includes/scripts.php'; ?>
</body> 
