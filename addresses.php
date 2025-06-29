<?php
session_start();
require_once 'config/database.php';
if (!isset($_SESSION['user']['id'])) {
    header('Location: login.php');
    exit;
}
$pdo = getDBConnection();
$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare('SELECT * FROM addresses WHERE user_id = ?');
$stmt->execute([$user_id]);
$addresses = $stmt->fetchAll();
?>
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main class="container mx-auto py-8">
  <h1 class="text-2xl font-bold mb-6">Mes adresses</h1>
  <?php if (empty($addresses)): ?>
    <p>Vous n'avez pas encore ajouté d'adresse.</p>
  <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <?php foreach ($addresses as $address): ?>
        <div class="bg-white rounded shadow p-4">
          <div><?php echo htmlspecialchars($address['street']); ?></div>
          <div><?php echo htmlspecialchars($address['city']); ?>, <?php echo htmlspecialchars($address['zip']); ?></div>
          <div><?php echo htmlspecialchars($address['country']); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <!-- Formulaire d'ajout d'adresse à ajouter ici si besoin -->
</main>
<?php include 'includes/footer.php'; ?>
</body> 