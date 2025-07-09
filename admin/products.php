<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Sécurité : accès uniquement admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$pdo = getDBConnection();

// Suppression d'un produit
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: products.php?deleted=1');
    exit;
}

// Récupérer tous les produits
$products = $pdo->query('SELECT * FROM products ORDER BY id DESC')->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Produits</title>
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
        .btn-edit { background: #e0e7ef; color: #2b6cb0; }
        .btn-edit:hover { background: #cbd5e1; }
        .btn-delete { background: #fee2e2; color: #b91c1c; }
        .btn-delete:hover { background: #fecaca; }
        .btn-add { background: #2b6cb0; color: #fff; margin-bottom: 18px; display: inline-block; }
        .btn-add:hover { background: #1e40af; }
        @media (max-width: 700px) { .admin-header { flex-direction: column; gap: 16px; } table, thead, tbody, th, td, tr { display: block; } th, td { padding: 10px 4px; } }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <div class="admin-title"><i class="fa fa-box"></i> Gestion des produits</div>
            <div class="admin-links">
                <a href="dashboard.php"><i class="fa fa-gauge"></i> Dashboard</a>
                <a href="users.php"><i class="fa fa-users"></i> Utilisateurs</a>
                <a href="orders.php"><i class="fa fa-shopping-cart"></i> Commandes</a>
                <a href="../index.php"><i class="fa fa-arrow-left"></i> Retour site</a>
            </div>
        </div>
        <a href="product-edit.php" class="btn btn-add"><i class="fa fa-plus"></i> Ajouter un produit</a>
        <?php if (isset($_GET['deleted'])): ?>
            <div style="color:#fff; background:#ef4444; padding:10px 18px; border-radius:8px; margin-bottom:18px;">Produit supprimé avec succès.</div>
        <?php endif; ?>
        <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Gendre</th>
                    <th>Type de produits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo number_format($product['price'], 2); ?> €</td>
                    <td><?php echo $product['stock']; ?></td>
                    <td><?php echo htmlspecialchars($product['gender']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_type']); ?></td>
                    <td class="actions">
                        <a href="product-edit.php?id=<?php echo $product['id']; ?>" class="btn btn-edit"><i class="fa fa-pen"></i> Éditer</a>
                        <a href="products.php?delete=<?php echo $product['id']; ?>" class="btn btn-delete" onclick="return confirm('Supprimer ce produit ?');"><i class="fa fa-trash"></i> Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html> 