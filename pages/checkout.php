<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';

// Rediriger si pas connecté
if (!isset($_SESSION['user']['id'])) {
    header('Location: pages/login.php');
    exit;
}

$pdo = getDBConnection();
$user_id = $_SESSION['user']['id'];

// Récupérer le panier de l'utilisateur
$stmt = $pdo->prepare('
    SELECT c.*, p.name, p.price, p.image, p.stock
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
');
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

// Calculer le total
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['quantity'] * $item['price'];
}

// Traitement du formulaire de commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($cart_items)) {
    $shipping_address = trim($_POST['shipping_address']);
    $payment_method = $_POST['payment_method'];
    
    if (empty($shipping_address)) {
        $error = "L'adresse de livraison est requise.";
    } else {
        try {
            $pdo->beginTransaction();
            
            // Créer la commande
            $stmt = $pdo->prepare('
                INSERT INTO orders (user_id, total, status, shipping_address, payment_method, created_at)
                VALUES (?, ?, ?, ?, ?, NOW())
            ');
            $stmt->execute([$user_id, $total, 'En cours', $shipping_address, $payment_method]);
            $order_id = $pdo->lastInsertId();
            
            // Ajouter les produits à la commande
            $stmt = $pdo->prepare('
                INSERT INTO order_items (order_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)
            ');
            
            foreach ($cart_items as $item) {
                $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
                
                // Mettre à jour le stock
                $new_stock = $item['stock'] - $item['quantity'];
                $update_stmt = $pdo->prepare('UPDATE products SET stock = ? WHERE id = ?');
                $update_stmt->execute([$new_stock, $item['product_id']]);
            }
            
            // Vider le panier
            $stmt = $pdo->prepare('DELETE FROM cart WHERE user_id = ?');
            $stmt->execute([$user_id]);
            
            $pdo->commit();
            
            // Rediriger vers la page de confirmation
            header('Location: orders.php?success=1');
            exit;
            
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = "Erreur lors de la création de la commande : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include '../includes/head.php'; ?>
  <link rel="stylesheet" href="../src/css/tailwind.css">
  <link rel="stylesheet" href="../src/css/menu.css">
  <link rel="stylesheet" href="../src/css/responsive.css">   
  <link rel="stylesheet" href="../src/css/style.css">
  <link rel="stylesheet" href="../src/css/modals.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
<main class="container mx-auto py-8 px-10">
    <h1 class="text-2xl font-bold mb-6">Finaliser la commande</h1>
    
    <?php if (empty($cart_items)): ?>
        <div class="text-center py-8">
            <p class="text-gray-600 mb-4">Votre panier est vide.</p>
            <a href="products.php" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200">
                Continuer les achats
            </a>
        </div>
    <?php else: ?>
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Résumé de la commande -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Résumé de votre commande</h2>
                <div class="space-y-4">
                    <?php foreach ($cart_items as $item): ?>
                        <div class="flex items-center space-x-4">
                            <img src="/boutiqua/src/images/<?php echo htmlspecialchars($item['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                 class="w-16 h-16 object-cover rounded">
                            <div class="flex-1">
                                <h3 class="font-medium"><?php echo htmlspecialchars($item['name']); ?></h3>
                                <p class="text-gray-600">Quantité: <?php echo $item['quantity']; ?></p>
                            </div>
                            <div class="text-right">
                                <p class="font-medium"><?php echo number_format($item['price'], 2); ?> €</p>
                                <p class="text-sm text-gray-600">Total: <?php echo number_format($item['quantity'] * $item['price'], 2); ?> €</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="border-t pt-4 mt-4">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span><?php echo number_format($total, 2); ?> €</span>
                    </div>
                </div>
            </div>
            
            <!-- Formulaire de commande -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Informations de livraison</h2>
                <form method="POST" class="space-y-4">
                    <div>
                        <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Adresse de livraison *
                        </label>
                        <textarea 
                            id="shipping_address" 
                            name="shipping_address" 
                            rows="4" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Entrez votre adresse complète de livraison"
                            required
                        ><?php echo isset($_POST['shipping_address']) ? htmlspecialchars($_POST['shipping_address']) : ''; ?></textarea>
                    </div>
                    
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">
                            Mode de paiement
                        </label>
                        <select 
                            id="payment_method" 
                            name="payment_method" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="Carte bancaire">Carte bancaire</option>
                            <option value="PayPal">PayPal</option>
                            <option value="Espèces à la livraison">Espèces à la livraison</option>
                        </select>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-4 rounded-lg transition duration-200"
                    >
                        Confirmer la commande - <?php echo number_format($total, 2); ?> €
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</main>
<?php include '../includes/footer.php'; ?>

<!-- Scripts -->
<?php include '../includes/scripts.php'; ?>
</body> 
<html>