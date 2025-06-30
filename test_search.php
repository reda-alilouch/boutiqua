<?php
// Test de la fonctionnalité de recherche
require_once __DIR__ . '/config/database.php';

echo "<h1>Test de la fonctionnalité de recherche</h1>";

try {
    $pdo = getDBConnection();
    
    // Vérifier que la table products existe
    $stmt = $pdo->query("SHOW TABLES LIKE 'products'");
    if ($stmt->rowCount() == 0) {
        echo "<p style='color: red;'>❌ La table 'products' n'existe pas</p>";
        exit;
    }
    echo "<p style='color: green;'>✅ La table 'products' existe</p>";
    
    // Vérifier la structure de la table
    $stmt = $pdo->query("DESCRIBE products");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $requiredColumns = ['id', 'name', 'price', 'image', 'description'];
    $missingColumns = array_diff($requiredColumns, $columns);
    
    if (!empty($missingColumns)) {
        echo "<p style='color: red;'>❌ Colonnes manquantes: " . implode(', ', $missingColumns) . "</p>";
    } else {
        echo "<p style='color: green;'>✅ Toutes les colonnes requises sont présentes</p>";
    }
    
    // Compter les produits
    $stmt = $pdo->query("SELECT COUNT(*) FROM products");
    $count = $stmt->fetchColumn();
    echo "<p>📊 Nombre total de produits: $count</p>";
    
    // Tester une recherche
    $searchTerm = 'shirt';
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE name LIKE :search OR description LIKE :search");
    $stmt->execute(['search' => '%' . $searchTerm . '%']);
    $searchCount = $stmt->fetchColumn();
    
    echo "<p>🔍 Recherche pour '$searchTerm': $searchCount résultat(s)</p>";
    
    // Afficher quelques exemples de produits
    echo "<h2>Exemples de produits:</h2>";
    $stmt = $pdo->query("SELECT id, name, price, image FROM products LIMIT 5");
    $products = $stmt->fetchAll();
    
    echo "<ul>";
    foreach ($products as $product) {
        echo "<li><strong>{$product['name']}</strong> - {$product['price']}€ (ID: {$product['id']})</li>";
    }
    echo "</ul>";
    
    // Tester l'API de recherche
    echo "<h2>Test de l'API de recherche:</h2>";
    echo "<p>Testez ces URLs:</p>";
    echo "<ul>";
    echo "<li><a href='search.php?q=shirt' target='_blank'>search.php?q=shirt</a></li>";
    echo "<li><a href='search.php?q=dress' target='_blank'>search.php?q=dress</a></li>";
    echo "<li><a href='search-results.php?q=shirt' target='_blank'>search-results.php?q=shirt</a></li>";
    echo "</ul>";
    
    echo "<h2>Instructions de test:</h2>";
    echo "<ol>";
    echo "<li>Cliquez sur l'icône de recherche dans le header</li>";
    echo "<li>Tapez un terme de recherche (ex: 'shirt', 'dress', 'men')</li>";
    echo "<li>Vérifiez que les résultats s'affichent en temps réel</li>";
    echo "<li>Cliquez sur un résultat pour aller à la page produit</li>";
    echo "<li>Cliquez sur 'Voir tous les résultats' pour la page complète</li>";
    echo "<li>Appuyez sur Entrée pour aller directement à la page de résultats</li>";
    echo "</ol>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Erreur de base de données: " . $e->getMessage() . "</p>";
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h1 { color: #333; }
h2 { color: #666; margin-top: 30px; }
p { margin: 10px 0; }
ul { margin: 10px 0; padding-left: 20px; }
li { margin: 5px 0; }
a { color: #007bff; text-decoration: none; }
a:hover { text-decoration: underline; }
</style> 