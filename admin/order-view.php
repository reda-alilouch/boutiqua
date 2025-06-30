<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Sécurité : accès uniquement admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$pdo = getDBConnection();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: orders.php');
    exit;
}

// Récupérer la commande
$stmt = $pdo->prepare('SELECT o.*, u.email FROM orders o LEFT JOIN users u ON o.user_id = u.id WHERE o.id = ?');
$stmt->execute([$id]);
$order = $stmt->fetch();
if (!$order) {
    header('Location: orders.php');
    exit;
}

// Récupérer les items de la commande
$items = $pdo->prepare('SELECT oi.*, p.name, p.image FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?');
$items->execute([$id]);
$orderItems = $items->fetchAll();

// Récupérer l'adresse de livraison si possible
$address = null;
if (!empty($order['shipping_address_id'])) {
    $stmt = $pdo->prepare('SELECT * FROM addresses WHERE id = ?');
    $stmt->execute([$order['shipping_address_id']]);
    $address = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail commande #<?php echo $order['id']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
    <style>
        body { background: #f4f6fa; }
        .admin-container { max-width: 800px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 16px #0001; padding: 32px; }
        .admin-title { font-size: 1.5rem; font-weight: bold; color: #222; margin-bottom: 24px; }
        .back-link { display: inline-block; margin-bottom: 18px; color: #2b6cb0; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
        .order-info, .address-info { margin-bottom: 24px; }
        .order-info span, .address-info span { display: inline-block; min-width: 120px; color: #555; font-weight: 500; }
        table { width: 100%; border-collapse: collapse; margin-top: 24px; background: #fff; }
        th, td { padding: 12px 8px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f9fafb; color: #444; font-weight: 600; }
        tr:hover { background: #f4f6fa; }
        img { width: 48px; height: 48px; object-fit: cover; border-radius: 8px; }
        @media (max-width: 700px) { .admin-container { padding: 10px; } table, thead, tbody, th, td, tr { display: block; } th, td { padding: 10px 4px; } }
    </style>
</head>
<body>
    <div class="admin-container">
        <a href="orders.php" class="back-link"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
        <div class="admin-title">Commande #<?php echo $order['id']; ?></div>
        <div class="order-info">
            <div><span>Utilisateur :</span> <?php echo htmlspecialchars($order['email'] ?? ''); ?></div>
            <div><span>Date :</span> <?php echo htmlspecialchars($order['created_at']); ?></div>
            <div><span>Statut :</span> <?php echo htmlspecialchars($order['status'] ?? ''); ?></div>
            <div><span>Total :</span> <?php echo number_format($order['total'], 2); ?> €</div>
        </div>
        <?php if ($address): ?>
        <div class="address-info">
            <strong>Adresse de livraison :</strong><br>
            <?php echo htmlspecialchars($address['prenom'] ?? ''); ?> <?php echo htmlspecialchars($address['nom'] ?? ''); ?><br>
            <?php echo htmlspecialchars($address['adresse'] ?? ''); ?><br>
            <?php echo htmlspecialchars($address['ville'] ?? ''); ?>, <?php echo htmlspecialchars($address['code_postal'] ?? ''); ?><br>
            <?php echo htmlspecialchars($address['pays'] ?? ''); ?><br>
            <?php echo htmlspecialchars($address['telephone'] ?? ''); ?>
        </div>
        <?php endif; ?>
        <h3 style="margin-top:32px;">Produits commandés</h3>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $item): ?>
                <tr>
                    <td><?php if ($item['image']): ?><img src="../src/images/<?php echo htmlspecialchars($item['image']); ?>" alt=""><?php endif; ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo number_format($item['price'], 2); ?> €</td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 