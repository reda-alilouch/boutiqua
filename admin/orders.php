<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Sécurité : accès uniquement admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$pdo = getDBConnection();

// Récupérer toutes les commandes
$orders = $pdo->query('SELECT o.*, u.email FROM orders o LEFT JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC')->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Commandes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
    <style>
        body { background: #f4f6fa; }
        .admin-container { max-width: 1100px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 16px #0001; padding: 32px; }
        .admin-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; }
        .admin-title { font-size: 2rem; font-weight: bold; color: #222; }
        .admin-links { display: flex; gap: 24px; }
        .admin-links a { color: #333; font-weight: 500; text-decoration: none; padding: 8px 18px; border-radius: 8px; background: #f4f6fa; transition: background 0.2s; }
        .admin-links a:hover { background: #e0e7ef; }
        table { width: 100%; border-collapse: collapse; margin-top: 24px; background: #fff; }
        th, td { padding: 12px 8px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f9fafb; color: #444; font-weight: 600; }
        tr:hover { background: #f4f6fa; }
        .actions { display: flex; gap: 10px; }
        .btn { padding: 6px 14px; border-radius: 6px; text-decoration: none; font-size: 0.95rem; }
        .btn-view { background: #e0e7ef; color: #2b6cb0; }
        .btn-view:hover { background: #cbd5e1; }
        @media (max-width: 700px) { .admin-header { flex-direction: column; gap: 16px; } table, thead, tbody, th, td, tr { display: block; } th, td { padding: 10px 4px; } }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <div class="admin-title"><i class="fa fa-shopping-cart"></i> Gestion des commandes</div>
            <div class="admin-links">
                <a href="dashboard.php"><i class="fa fa-gauge"></i> Dashboard</a>
                <a href="products.php"><i class="fa fa-box"></i> Produits</a>
                <a href="users.php"><i class="fa fa-users"></i> Utilisateurs</a>
                <a href="../index.php"><i class="fa fa-arrow-left"></i> Retour site</a>
            </div>
        </div>
        <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo htmlspecialchars($order['email'] ?? ''); ?></td>
                    <td><?php echo number_format($order['total'], 2); ?> €</td>
                    <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($order['status'] ?? ''); ?></td>
                    <td class="actions">
                        <a href="order-view.php?id=<?php echo $order['id']; ?>" class="btn btn-view"><i class="fa fa-eye"></i> Voir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html> 