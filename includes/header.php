<?php
/**
 * En-tête principal du site avec navigation et modaux d'authentification
 *
 * @package Astrodia
 * @version 1.0.0
 */

// Inclure la configuration de la base de données
require_once __DIR__ . '/../config/database.php';

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Gestion de la déconnexion
if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: /astrodia/index.php');
  exit();
}

// Gestion de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'] ?? '';

  try {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare('SELECT * FROM user2 WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      // Protection contre la fixation de session
      session_regenerate_id(true);

      $_SESSION['user'] = [
        'id' => $user['id'],
        'nom' => htmlspecialchars($user['nom']),
        'prenom' => htmlspecialchars($user['prenom']),
        'email' => $user['email'],
        'avatar' => $user['avatar'],
        'last_login' => time(),
      ];

      header('Location: /astrodia/index.php');
      exit();
    } else {
      $_SESSION['error'] = 'Email ou mot de passe incorrect';
    }
  } catch (Exception $e) {
    error_log('Erreur de connexion : ' . $e->getMessage());
    $_SESSION['error'] = 'Une erreur est survenue lors de la connexion';
  }
}

// Gestion de l'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription'])) {
  $nom = trim($_POST['nom'] ?? '');
  $prenom = trim($_POST['prenom'] ?? '');
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'] ?? '';

  $errors = [];

  // Validation des données
  if (empty($nom) || strlen($nom) > 50) {
    $errors[] = 'Le nom est requis et ne doit pas dépasser 50 caractères';
  }
  if (empty($prenom) || strlen($prenom) > 50) {
    $errors[] = 'Le prénom est requis et ne doit pas dépasser 50 caractères';
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email invalide';
  }
  if (strlen($password) < 8 || strlen($password) > 72) {
    $errors[] = 'Le mot de passe doit contenir entre 8 et 72 caractères';
  }

  // Vérification du fichier uploadé
  $avatarPath = null;
  if (
    isset($_FILES['avatar']) &&
    $_FILES['avatar']['error'] === UPLOAD_ERR_OK
  ) {
    if ($_FILES['avatar']['size'] > MAX_UPLOAD_SIZE) {
      $errors[] = 'Le fichier est trop volumineux (max 5MB)';
    } else {
      $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
      $fileType = $_FILES['avatar']['type'];

      if (array_key_exists($fileType, $allowedTypes)) {
        $extension = $allowedTypes[$fileType];
        $avatarName = uniqid('avatar_', true) . '.' . $extension;

        if (!is_dir(AVATAR_DIR)) {
          mkdir(AVATAR_DIR, 0755, true);
        }

        $targetPath = AVATAR_DIR . $avatarName;
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
          $avatarPath = 'avatars/' . $avatarName;
        } else {
          $errors[] = 'Erreur lors du téléchargement de l\'image';
        }
      } else {
        $errors[] = 'Type de fichier non autorisé. Formats acceptés : JPG, PNG';
      }
    }
  }

  if (empty($errors)) {
    try {
      $pdo = getDBConnection();

      // Vérifier si l'email existe déjà
      $stmt = $pdo->prepare('SELECT id FROM user2 WHERE email = ?');
      $stmt->execute([$email]);

      if ($stmt->fetch()) {
        $errors[] = 'Cet email est déjà utilisé';
      } else {
        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer le nouvel utilisateur
        $sql =
          'INSERT INTO user2 (nom, prenom, email, password, avatar) VALUES (?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $hashedPassword, $avatarPath]);

        // Protection contre la fixation de session
        session_regenerate_id(true);

        $_SESSION['user'] = [
          'id' => $pdo->lastInsertId(),
          'nom' => htmlspecialchars($nom),
          'prenom' => htmlspecialchars($prenom),
          'email' => $email,
          'avatar' => $avatarPath,
          'last_login' => time(),
        ];

        header('Location: /astrodia/index.php');
        exit();
      }
    } catch (Exception $e) {
      error_log('Erreur d\'inscription : ' . $e->getMessage());
      $errors[] = 'Une erreur est survenue lors de l\'inscription';
    }
  }

  if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
  }
}

$isLoggedIn = isset($_SESSION['user']);
$user = $isLoggedIn ? $_SESSION['user'] : null;
?>
<body>
    <header class="fixed top-0 left-0 z-50 w-full bg-white shadow-sm backdrop-blur-sm" 
            class="transition-all duration-300" id="mainHeader">
        
        <div class="container px-4 mx-auto">
            <nav class="flex items-center justify-between h-16 md:h-20">
                
                <!-- Mobile Menu Button -->
                <div onclick="toggleMenu()" class="menu-button lg:hidden">
                        <i class="text-xl fa-solid fa-bars menu-icon" id="menuIcon"></i>
                    </div>

                <!-- Logo -->
                <a href="/astrodia/index.php" class="flex-shrink-0">
                    <img src="../astrodia/src/images/logoo.png" 
                         class="w-auto h-8 md:h-10" alt="Astrodia Logo" />
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden space-x-8 lg:flex">
                    <a href="/astrodia" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        Accueil
                    </a>
                    <a href="/astrodia/products.php" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        Produits
                    </a>
                    <a href="/astrodia/single-product.php" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        Produit Unique
                    </a>
                    <a href="/astrodia/contact.php" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        Contact
                    </a>
                    <a href="/astrodia/about.php" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        À Propos
                    </a>
                </nav>

                <!-- Actions -->
                
<div class="flex items-center gap-4">
  <button id="openSearchModalBtn">
    <i class="fa-solid fa-magnifying-glass"></i>
  </button>
  <button id="openCartModalBtn">
    <i class="fa-solid fa-cart-shopping"></i>
  </button>
  
    <button id="openAuthModalBtn">
        <i class="fa-solid fa-user"></i>
    </button>
</div>
                <!-- Mobile Menu -->
                <div id="mobileMenu" class="hidden bg-white border-t border-gray-200 lg:hidden">
                    <nav class="flex flex-col py-4">
                        <a href="/astrodia/index.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            <i class="mr-3 text-gray-400 fas fa-home"></i>
                            Accueil
                        </a>
                        <a href="/astrodia/products.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            <i class="mr-3 text-gray-400 fas fa-shopping-bag"></i>
                            Produits
                        </a>
                        <a href="/astrodia/single-product.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            <i class="mr-3 text-gray-400 fas fa-box"></i>
                            Produit Unique
                        </a>
                        <a href="/astrodia/contact.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            <i class="mr-3 text-gray-400 fas fa-envelope"></i>
                            Contact
                        </a>
                        <a href="/astrodia/about.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            <i class="mr-3 text-gray-400 fas fa-info-circle"></i>
                            À Propos
                        </a>
                    </nav>
            </nav>
        </div>
    </header>
    
    <?php include 'includes/auth-modal.php'; ?>
    <?php include 'includes/cart-modal.php'; ?>
    <?php include 'includes/search-modal.php'; ?>
   
   
