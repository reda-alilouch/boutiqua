<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';
$pdo = getDBConnection();

if (isset($_SESSION['user']['id'])) {
    $user_id = $_SESSION['user']['id'];
    
    // Récupérer les commandes de l'utilisateur
    $stmt = $pdo->prepare('
        SELECT o.*, 
               COUNT(oi.id) as total_items,
               SUM(oi.quantity * oi.price) as total_amount
        FROM orders o
        LEFT JOIN order_items oi ON o.id = oi.order_id
        WHERE o.user_id = ?
        GROUP BY o.id
        ORDER BY o.created_at DESC
    ');
    $stmt->execute([$user_id]);
    $orders = $stmt->fetchAll();
    
    // Récupérer les détails des produits pour chaque commande
    foreach ($orders as &$order) {
        $stmt = $pdo->prepare('
            SELECT oi.*, p.name, p.image
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
        ');
        $stmt->execute([$order['id']]);
        $order['items'] = $stmt->fetchAll();
    }
} else {
    $orders = [];
}
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
<body>
<?php include '../includes/header.php'; ?>
<main class="mx-auto py-20 px-8">
  <h1 class="text-2xl font-bold mb-6">Mes commandes</h1>
  
  <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
      <div class="flex items-center">
        <i class="fa-solid fa-check-circle mr-2"></i>
        <span>Votre commande a été passée avec succès !</span>
      </div>
    </div>
  <?php endif; ?>
  
  <?php if (empty($orders)): ?>
    <div class="text-center py-8">
      <p class="text-gray-600 mb-4">Vous n'avez pas encore passé de commande.</p>
      <a href="products.php" class="border text-black px-2 py-1 rounded-lg hover:text-white hover:bg-black transition duration-200">
        Découvrir nos produits
      </a>
    </div>
  <?php else: ?>
    <div class="space-y-6">
      <?php foreach ($orders as $order): ?>
        <div class="bg-white rounded-lg shadow-md p-6">
          <div class="flex justify-between items-center mb-4">
            <div>
              <h3 class="text-lg font-semibold">Commande #<?php echo $order['id']; ?></h3>
              <p class="text-gray-600"><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
            </div>
            <div class="text-right">
              <p class="text-lg font-bold text-green-600"><?php echo number_format($order['total_amount'], 2); ?> €</p>
              <span class="inline-block px-3 py-1 text-sm rounded-full 
                <?php echo $order['status'] === 'En cours' ? 'bg-yellow-100 text-yellow-800' : 
                       ($order['status'] === 'Livrée' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                <?php echo htmlspecialchars($order['status']); ?>
              </span>
            </div>
          </div>
          
          <div class="border-t pt-4">
            <h4 class="font-medium mb-3">Produits commandés :</h4>
            <div class="space-y-3">
              <?php foreach ($order['items'] as $item): ?>
                <div class="flex items-center space-x-4">
                  <img src="/boutiqua/src/images/<?php echo htmlspecialchars($item['image']); ?>" 
                       alt="<?php echo htmlspecialchars($item['name']); ?>" 
                       class="w-16 h-16 object-cover rounded">
                  <div class="flex-1">
                    <h5 class="font-medium"><?php echo htmlspecialchars($item['name']); ?></h5>
                    <p class="text-gray-600">Quantité: <?php echo $item['quantity']; ?></p>
                  </div>
                  <div class="text-right">
                    <p class="font-medium"><?php echo number_format($item['price'], 2); ?> €</p>
                    <p class="text-sm text-gray-600">Total: <?php echo number_format($item['quantity'] * $item['price'], 2); ?> €</p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          
          <?php if (!empty($order['shipping_address'])): ?>
            <div class="border-t pt-4 mt-4">
              <h4 class="font-medium mb-2">Adresse de livraison :</h4>
              <p class="text-gray-600"><?php echo nl2br(htmlspecialchars($order['shipping_address'])); ?></p>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>
<?php include '../includes/footer.php'; ?>

<!-- Scripts -->
<?php include '../includes/scripts.php'; ?>
</body> 
</html>