<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$pdo = getDBConnection();

// Récupérer le terme de recherche
$search = trim($_GET['q'] ?? '');
$category = $_GET['category'] ?? '';
$sort = $_GET['sort'] ?? 'name';
$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 12;

// Construire la requête de base
$whereConditions = [];
$params = [];

if (!empty($search)) {
    $whereConditions[] = "(name LIKE :search OR description LIKE :search)";
    $params['search'] = '%' . $search . '%';
}

if (!empty($category)) {
    $whereConditions[] = "category = :category";
    $params['category'] = $category;
}

$whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

// Requête pour compter le total
$countQuery = "SELECT COUNT(*) FROM products $whereClause";
$stmt = $pdo->prepare($countQuery);
$stmt->execute($params);
$totalProducts = $stmt->fetchColumn();
$totalPages = ceil($totalProducts / $perPage);

// Requête pour récupérer les produits
$offset = (int) (($page - 1) * $perPage);
$perPage = (int) $perPage;
$orderBy = match($sort) {
    'price_asc' => 'price ASC',
    'price_desc' => 'price DESC',
    'name' => 'name ASC',
    default => 'name ASC'
};

// Construction robuste des paramètres et du WHERE
$executeParams = [];
$where = [];
if (!empty($search)) {
    $where[] = "(name LIKE :search OR description LIKE :search)";
    $executeParams['search'] = '%' . $search . '%';
}
if (!empty($category)) {
    $where[] = "category = :category";
    $executeParams['category'] = $category;
}
$whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$query = "SELECT * FROM products $whereClause ORDER BY $orderBy LIMIT $perPage OFFSET $offset";
$stmt = $pdo->prepare($query);
// Log pour debug
error_log('QUERY: ' . $query);
error_log('PARAMS: ' . print_r($executeParams, true));
if ($executeParams) {
    $stmt->execute($executeParams);
} else {
    $stmt->execute();
}
$products = $stmt->fetchAll();

// Récupérer les catégories pour les filtres
$categories = $pdo->query("SELECT DISTINCT category FROM products WHERE category IS NOT NULL ORDER BY category")->fetchAll();
?>

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
<?php include '../includes/header.php'; ?>

<main class="py-20">
  <div class="container mx-auto px-4">
    <!-- Header de recherche -->
    <div class="mb-8">
      <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-gray-900">
          <?php if (!empty($search)): ?>
            Résultats pour "<?php echo htmlspecialchars($search); ?>"
          <?php else: ?>
            Tous les produits
          <?php endif; ?>
        </h1>
        <p class="text-gray-600">
          <?php echo $totalProducts; ?> produit<?php echo $totalProducts > 1 ? 's' : ''; ?> trouvé<?php echo $totalProducts > 1 ? 's' : ''; ?>
        </p>
      </div>
      
      <!-- Barre de recherche -->
      <form method="GET" class="mb-6">
        <div class="flex gap-4">
          <div class="flex-1">
            <input 
              type="text" 
              name="q" 
              value="<?php echo htmlspecialchars($search); ?>" 
              placeholder="Rechercher un produit..."
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
            >
          </div>
          <div class="w-48">
            <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
              <option value="">Toutes les catégories</option>
              <?php foreach ($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars($cat['category']); ?>" <?php echo $category === $cat['category'] ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($cat['category']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="w-48">
            <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
              <option value="name" <?php echo $sort === 'name' ? 'selected' : ''; ?>>Nom A-Z</option>
              <option value="price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>>Prix croissant</option>
              <option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Prix décroissant</option>
            </select>
          </div>
          <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <i class="fa fa-search mr-2"></i>Rechercher
          </button>
        </div>
      </form>
    </div>

    <?php if (empty($products)): ?>
      <!-- Aucun résultat -->
      <div class="text-center py-12">
        <i class="fa fa-search text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun produit trouvé</h3>
        <p class="text-gray-500 mb-6">
          <?php if (!empty($search)): ?>
            Aucun produit ne correspond à votre recherche "<?php echo htmlspecialchars($search); ?>"
          <?php else: ?>
            Aucun produit disponible dans cette catégorie
          <?php endif; ?>
        </p>
        <a href="products.php" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-colors">
          <i class="fa fa-arrow-left mr-2"></i>
          Voir tous les produits
        </a>
      </div>
    <?php else: ?>
      <!-- Grille de produits -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach ($products as $product): ?>
          <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-2xl">
            <!-- Wishlist Button -->
            <form method="post" action="../actions/add_to_wishlist.php" class="absolute top-3 right-3 z-10" data-auth="<?php echo isset($_SESSION['user']['id']) ? '1' : '0'; ?>">
              <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
              <button type="submit" class="text-gray-400 hover:text-red-500 text-xl bg-white bg-opacity-80 rounded-full p-2 shadow transition-colors" title="Ajouter à la liste de souhaits">
                <i class="fa fa-heart"></i>
              </button>
            </form>
            
            <!-- Product Image -->
            <div class="relative">
              <img src="../src/images/<?php echo htmlspecialchars($product['image']); ?>" 
                   alt="<?php echo htmlspecialchars($product['name']); ?>" 
                   class="w-full h-48 object-cover">
            </div>
            
            <!-- Product Info -->
            <div class="p-5">
              <h3 class="text-lg font-semibold text-gray-900 mb-2"><?php echo htmlspecialchars($product['name']); ?></h3>
              <p class="text-sm text-gray-600 mb-3"><?php echo htmlspecialchars(substr($product['description'], 0, 80)) . '...'; ?></p>
              <div class="flex items-center justify-between mb-4">
                <span class="text-xl font-bold text-primary"><?php echo number_format($product['price'], 2); ?> €</span>
                <?php if (!empty($product['category'])): ?>
                  <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full"><?php echo htmlspecialchars($product['category']); ?></span>
                <?php endif; ?>
              </div>
              
              <!-- Action Buttons -->
              <div class="flex gap-2">
                <a href="single-product.php?id=<?php echo $product['id']; ?>" 
                   class="flex-1 text-center py-2 border border-primary text-primary font-medium rounded-lg hover:bg-primary hover:text-white transition-colors">
                  Voir détails
                </a>
                <form method="post" action="../actions/add_to_cart.php" class="flex-1" data-auth="<?php echo isset($_SESSION['user']['id']) ? '1' : '0'; ?>">
                  <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="w-full py-2 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    Ajouter
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Pagination -->
      <?php if ($totalPages > 1): ?>
        <div class="flex justify-center mt-12">
          <div class="flex space-x-2">
            <?php if ($page > 1): ?>
              <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" 
                 class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fa fa-chevron-left mr-1"></i>Précédent
              </a>
            <?php endif; ?>
            
            <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
              <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" 
                 class="px-4 py-2 border rounded-lg transition-colors <?php echo $i == $page ? 'bg-primary text-white border-primary' : 'border-gray-300 text-gray-700 hover:bg-gray-50'; ?>">
                <?php echo $i; ?>
              </a>
            <?php endfor; ?>
            
            <?php if ($page < $totalPages): ?>
              <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" 
                 class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Suivant<i class="fa fa-chevron-right ml-1"></i>
              </a>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</main>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/scripts.php'; ?>
</body>
</html> 
