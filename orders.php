<?php
session_start();
require_once 'config/database.php';
if (!isset($_SESSION['user']['id'])) {
    header('Location: login.php');
    exit;
}
$pdo = getDBConnection();
$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC');
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();
?>
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main class="container mx-auto py-8">
  <h1 class="text-2xl font-bold mb-6">Mes commandes</h1>
  <?php if (empty($orders)): ?>
    <p>Vous n'avez pas encore passé de commande.</p>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white rounded shadow">
        <thead>
          <tr>
            <th class="px-4 py-2">N°</th>
            <th class="px-4 py-2">Date</th>
            <th class="px-4 py-2">Total</th>
            <th class="px-4 py-2">Statut</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orders as $order): ?>
            <tr>
              <td class="border px-4 py-2"><?php echo $order['id']; ?></td>
              <td class="border px-4 py-2"><?php echo htmlspecialchars($order['created_at']); ?></td>
              <td class="border px-4 py-2"><?php echo number_format($order['total'], 2); ?> €</td>
              <td class="border px-4 py-2"><?php echo htmlspecialchars($order['status']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</main>
<?php include 'includes/footer.php'; ?>
</body> 