<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
    // Rediriger vers la page de connexion avec un message
    $_SESSION['error'] = 'Vous devez être connecté pour ajouter des produits à votre liste de souhaits.';
    header('Location: ../pages/login.php');
    exit;
}

// Vérifier si la requête est en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: products.php');
    exit;
}

// Vérifier si product_id est fourni
if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
    $_SESSION['error'] = 'Produit invalide.';
    header('Location: products.php');
    exit;
}

$pdo = getDBConnection();
$user_id = $_SESSION['user']['id'];
$product_id = (int)$_POST['product_id'];

try {
    // Vérifier si le produit existe
    $stmt = $pdo->prepare('SELECT id FROM products WHERE id = ?');
    $stmt->execute([$product_id]);
    
    if (!$stmt->fetch()) {
        $_SESSION['error'] = 'Produit introuvable.';
        header('Location: products.php');
        exit;
    }
    
    // Vérifier si le produit est déjà dans la wishlist
    $stmt = $pdo->prepare('SELECT id FROM wishlist WHERE user_id = ? AND product_id = ?');
    $stmt->execute([$user_id, $product_id]);
    
    if ($stmt->fetch()) {
        $_SESSION['error'] = 'Ce produit est déjà dans votre liste de souhaits.';
    } else {
        // Ajouter le produit à la wishlist
        $stmt = $pdo->prepare('INSERT INTO wishlist (user_id, product_id, created_at) VALUES (?, ?, NOW())');
        $stmt->execute([$user_id, $product_id]);
        
        $_SESSION['success'] = 'Produit ajouté à votre liste de souhaits avec succès !';
    }
    
} catch (PDOException $e) {
    $_SESSION['error'] = 'Une erreur est survenue lors de l\'ajout du produit.';
    error_log('Wishlist error: ' . $e->getMessage());
}

// Rediriger vers la page précédente ou products.php
$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'products.php';
header('Location: ' . $redirect_url);
exit;
?> 
