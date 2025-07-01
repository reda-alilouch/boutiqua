<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

try {
    $pdo = getDBConnection();
    
    // Récupérer le terme de recherche
    $search = trim($_GET['q'] ?? '');
    
    if (empty($search)) {
        echo json_encode(['success' => false, 'message' => 'Terme de recherche requis']);
        exit;
    }
    
    // Recherche dans les produits (insensible à la casse et aux accents)
    $sql = 'SELECT id, name, price, image, description 
            FROM products 
            WHERE name LIKE :search 
               OR description LIKE :search 
            ORDER BY name ASC 
            LIMIT 10';
    $stmt = $pdo->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->execute(['search' => $searchTerm]);
    $products = $stmt->fetchAll();
    
    // Formater les résultats
    $results = [];
    foreach ($products as $product) {
        $results[] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => number_format($product['price'], 2),
            'image' => $product['image'],
            'description' => substr($product['description'], 0, 100) . '...',
            'url' => 'single-product.php?id=' . $product['id']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'results' => $results,
        'count' => count($results)
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de la recherche',
        'error' => $e->getMessage()
    ]);
}
?> 
