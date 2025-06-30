<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Sécurité : accès uniquement admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$pdo = getDBConnection();

// Statistiques
$countProducts = $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$countUsers = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$countOrders = $pdo->query('SELECT COUNT(*) FROM orders')->fetchColumn();

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
        .stats { display: flex; gap: 32px; margin-bottom: 32px; }
        .stat-box { flex: 1; background: #f9fafb; border-radius: 12px; padding: 24px; text-align: center; box-shadow: 0 1px 4px #0001; }
        .stat-title { color: #888; font-size: 1rem; margin-bottom: 8px; }
        .stat-value { font-size: 2.2rem; font-weight: bold; color: #2b6cb0; }
        @media (max-width: 700px) { .stats { flex-direction: column; gap: 16px; } .admin-header { flex-direction: column; gap: 16px; } }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <div class="admin-title"><i class="fa fa-gauge"></i> Dashboard Admin</div>
            <div class="admin-links">
                <a href="dashboard.php"><i class="fa fa-home"></i> Accueil</a>
                <a href="products.php"><i class="fa fa-box"></i> Produits</a>
                <a href="users.php"><i class="fa fa-users"></i> Utilisateurs</a>
                <a href="orders.php"><i class="fa fa-shopping-cart"></i> Commandes</a>
                <a href="../index.php"><i class="fa fa-arrow-left"></i> Retour site</a>
            </div>
        </div>
        <div class="stats">
            <div class="stat-box">
                <div class="stat-title">Produits</div>
                <div class="stat-value"><?php echo $countProducts; ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-title">Utilisateurs</div>
                <div class="stat-value"><?php echo $countUsers; ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-title">Commandes</div>
                <div class="stat-value"><?php echo $countOrders; ?></div>
            </div>
        </div>
        <h2 style="font-size:1.3rem; color:#333; margin-bottom:16px;">Gestion rapide</h2>
        <div class="admin-links" style="gap:32px;">
            <a href="products.php"><i class="fa fa-box"></i> Gérer les produits</a>
            <a href="users.php"><i class="fa fa-users"></i> Gérer les utilisateurs</a>
            <a href="orders.php"><i class="fa fa-shopping-cart"></i> Gérer les commandes</a>
        </div>
    </div>
</body>
</html> 