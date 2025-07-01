<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
    $_SESSION['error'] = 'Vous devez être connecté pour gérer vos adresses.';
    header('Location: ../pages/login.php');
    exit;
}

// Vérifier si la requête est en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/addresses.php');
    exit;
}

// Vérifier si address_id est fourni
if (!isset($_POST['address_id']) || !is_numeric($_POST['address_id'])) {
    $_SESSION['error'] = 'Adresse invalide.';
    header('Location: ../pages/addresses.php');
    exit;
}

$pdo = getDBConnection();
$user_id = $_SESSION['user']['id'];
$address_id = (int)$_POST['address_id'];

try {
    // Vérifier que l'adresse appartient bien à l'utilisateur
    $stmt = $pdo->prepare('SELECT id, is_default FROM addresses WHERE id = ? AND user_id = ?');
    $stmt->execute([$address_id, $user_id]);
    $address = $stmt->fetch();
    
    if (!$address) {
        $_SESSION['error'] = 'Adresse introuvable ou vous n\'avez pas les droits pour la supprimer.';
        header('Location: ../pages/addresses.php');
        exit;
    }
    
    // Supprimer l'adresse
    $stmt = $pdo->prepare('DELETE FROM addresses WHERE id = ? AND user_id = ?');
    $result = $stmt->execute([$address_id, $user_id]);
    
    if ($stmt->rowCount() > 0) {
        $_SESSION['success'] = 'Adresse supprimée avec succès.';
        
        // Si l'adresse supprimée était par défaut, définir la plus récente comme par défaut
        if ($address['is_default']) {
            $stmt = $pdo->prepare('SELECT id FROM addresses WHERE user_id = ? ORDER BY created_at DESC LIMIT 1');
            $stmt->execute([$user_id]);
            $newDefault = $stmt->fetch();
            
            if ($newDefault) {
                $stmt = $pdo->prepare('UPDATE addresses SET is_default = 1 WHERE id = ?');
                $stmt->execute([$newDefault['id']]);
            }
        }
    } else {
        $_SESSION['error'] = 'Erreur lors de la suppression de l\'adresse.';
    }
    
} catch (PDOException $e) {
    $_SESSION['error'] = 'Une erreur est survenue lors de la suppression de l\'adresse.';
    error_log('Delete address error: ' . $e->getMessage());
}

header('Location: ../pages/addresses.php');
exit;
?> 
