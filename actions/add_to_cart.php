<?php
session_start();
require_once __DIR__ . '/config/database.php';
$pdo = getDBConnection();

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
    header('Location: ../pages/login.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

// Vérifie que le produit existe
$stmt = $pdo->prepare('SELECT id FROM products WHERE id = ?');
$stmt->execute([$product_id]);
if (!$stmt->fetch()) {
    header('Location: products.php?error=produit');
    exit;
}

// Vérifie si le produit est déjà dans le panier
$stmt = $pdo->prepare('SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?');
$stmt->execute([$user_id, $product_id]);
$item = $stmt->fetch();

if ($item) {
    // Met à jour la quantité
    $stmt = $pdo->prepare('UPDATE cart SET quantity = quantity + ? WHERE id = ?');
    $stmt->execute([$quantity, $item['id']]);
} else {
    // Ajoute une nouvelle ligne
    $stmt = $pdo->prepare('INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)');
    $stmt->execute([$user_id, $product_id, $quantity]);
}

// Redirige vers la page produits (ou tu peux afficher le modal via JS)
header('Location: products.php?added=1');
exit; 
