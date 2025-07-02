<?php
require_once __DIR__ . '/../config/database.php';
$pdo = getDBConnection();

$q = trim($_GET['q'] ?? '');
if ($q === '') {
    exit; // Ne rien retourner si la recherche est vide
}

$stmt = $pdo->prepare("SELECT id, name, price, image FROM products WHERE name LIKE :q1 OR description LIKE :q2 LIMIT 10");
$stmt->execute(['q1' => '%' . $q . '%', 'q2' => '%' . $q . '%']);
$results = $stmt->fetchAll();

foreach ($results as $product) {
    echo '<div class="search-result-item" style="padding:8px 0;border-bottom:1px solid #eee;">';
    echo '<img src="src/images/' . htmlspecialchars($product['image']) . '" style="width:40px;height:40px;object-fit:cover;border-radius:4px;margin-right:8px;vertical-align:middle;">';
    echo '<a href="pages/single-product.php?id=' . $product['id'] . '" style="font-weight:bold;">' . htmlspecialchars($product['name']) . '</a>';
    echo ' <span style="color:#888;">' . number_format($product['price'], 2) . ' €</span>';
    echo '</div>';
}
if (empty($results)) {
    echo '<div style="color:#888;padding:8px;">Aucun résultat</div>';
} 