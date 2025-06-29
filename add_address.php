<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
    $_SESSION['error'] = 'Vous devez être connecté pour gérer vos adresses.';
    header('Location: login.php');
    exit;
}

// Vérifier si la requête est en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: addresses.php');
    exit;
}

// Récupérer et valider les données
$user_id = $_SESSION['user']['id'];
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$company = trim($_POST['company'] ?? '');
$street = trim($_POST['street'] ?? '');
$street2 = trim($_POST['street2'] ?? '');
$city = trim($_POST['city'] ?? '');
$zip = trim($_POST['zip'] ?? '');
$country = trim($_POST['country'] ?? 'France');
$phone = trim($_POST['phone'] ?? '');
$is_default = isset($_POST['is_default']) ? 1 : 0;

// Validation des champs obligatoires
$errors = [];
if (empty($first_name)) $errors[] = 'Le prénom est obligatoire.';
if (empty($last_name)) $errors[] = 'Le nom est obligatoire.';
if (empty($street)) $errors[] = 'L\'adresse est obligatoire.';
if (empty($city)) $errors[] = 'La ville est obligatoire.';
if (empty($zip)) $errors[] = 'Le code postal est obligatoire.';

if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);
    header('Location: addresses.php');
    exit;
}

$pdo = getDBConnection();

try {
    // Si cette adresse doit être par défaut, retirer le statut par défaut des autres adresses
    if ($is_default) {
        $stmt = $pdo->prepare('UPDATE addresses SET is_default = 0 WHERE user_id = ?');
        $stmt->execute([$user_id]);
    }
    
    // Insérer la nouvelle adresse
    $stmt = $pdo->prepare('
        INSERT INTO addresses (
            user_id, first_name, last_name, company, street, street2, 
            city, zip, country, phone, is_default
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ');
    
    $stmt->execute([
        $user_id, $first_name, $last_name, $company, $street, $street2,
        $city, $zip, $country, $phone, $is_default
    ]);
    
    $_SESSION['success'] = 'Adresse ajoutée avec succès !';
    
} catch (PDOException $e) {
    $_SESSION['error'] = 'Une erreur est survenue lors de l\'ajout de l\'adresse.';
    error_log('Add address error: ' . $e->getMessage());
}

header('Location: addresses.php');
exit;
?> 