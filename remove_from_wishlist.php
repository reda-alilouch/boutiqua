<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
    $_SESSION['error'] = 'Vous devez être connecté pour gérer votre liste de souhaits.';
    header('Location: login.php');
    exit;
}

// Vérifier si la requête est en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: wishlist.php');
    exit;
}

// Vérifier si product_id est fourni
if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
    $_SESSION['error'] = 'Produit invalide.';
    header('Location: wishlist.php');
    exit;
}

$pdo = getDBConnection();
$user_id = $_SESSION['user']['id'];
$product_id = (int)$_POST['product_id'];

try {
    // Supprimer le produit de la wishlist
    $stmt = $pdo->prepare('DELETE FROM wishlist WHERE user_id = ? AND product_id = ?');
    $result = $stmt->execute([$user_id, $product_id]);
    
    if ($stmt->rowCount() > 0) {
        $_SESSION['success'] = 'Produit retiré de votre liste de souhaits.';
    } else {
        $_SESSION['error'] = 'Produit introuvable dans votre liste de souhaits.';
    }
    
} catch (PDOException $e) {
    $_SESSION['error'] = 'Une erreur est survenue lors de la suppression du produit.';
    error_log('Remove from wishlist error: ' . $e->getMessage());
}

// Rediriger vers la page précédente ou wishlist.php
$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'wishlist.php';
header('Location: ' . $redirect_url);
exit;
?> 