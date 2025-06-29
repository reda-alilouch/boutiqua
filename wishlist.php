<?php
session_start();
require_once 'config/database.php';
if (!isset($_SESSION['user']['id'])) {
    header('Location: login.php');
    exit;
}
$pdo = getDBConnection();
$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare('SELECT w.*, p.name, p.image, p.price FROM wishlist w JOIN products p ON w.product_id = p.id WHERE w.user_id = ?');
$stmt->execute([$user_id]);
$wishlist = $stmt->fetchAll();
?>
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main class="container mx-auto py-8">
  <h1 class="text-2xl font-bold mb-6">Ma liste de souhaits</h1>
  <?php if (empty($wishlist)): ?>
    <p>Votre liste de souhaits est vide.</p>
  <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($wishlist as $item): ?>
        <div class="bg-white rounded shadow p-4 flex flex-col items-center">
          <img src="src/images/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-24 h-24 object-cover mb-2">
          <h3 class="font-semibold"><?php echo htmlspecialchars($item['name']); ?></h3>
          <span class="text-primary font-bold"><?php echo number_format($item['price'], 2); ?> €</span>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>
<?php include 'includes/footer.php'; ?>
</body> 