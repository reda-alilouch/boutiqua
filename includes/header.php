<?php
/**
 * En-tête principal du site avec navigation et modaux d'authentification
 * 
 * @package HexaShop
 * @version 1.0.0
 */
?>
<?php // Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée
// Démarrer la session si elle n'est pas déjà démarrée

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// Gestion de la déconnexion
if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: index.php');
  exit();
}
// Gestion de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'] ?? '';
  try {
    $pdo = new PDO(
      'mysql:host=localhost;dbname=ecole;charset=utf8mb4',
      'root',
      '',
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM user2 WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && $user['password'] === $password) {
      // À remplacer par password_verify() plus tard
      $_SESSION['user'] = [
        'id' => $user['id'],
        'nom' => $user['nom'],
        'prenom' => $user['prenom'],
        'email' => $user['email'],
        'avatar' => $user['avatar'],
      ]; // Rafraîchir pour éviter de renvoyer le formulaire
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit();
    } else {
      $_SESSION['error'] = 'Email ou mot de passe incorrect';
    }
  } catch (PDOException $e) {
    error_log('Erreur de connexion : ' . $e->getMessage());
    $_SESSION['error'] = 'Une erreur est survenue lors de la connexion';
  }
}
// Gestion de l'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription'])) {
  $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
  $prenom = filter_input(INPUT_POST, 'Prenom', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'] ?? ''; // Validation des données
  $errors = [];
  if (empty($nom)) {
    $errors[] = 'Le nom est requis';
  }
  if (empty($prenom)) {
    $errors[] = 'Le prénom est requis';
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email invalide';
  }
  if (strlen($password) < 8) {
    $errors[] = 'Le mot de passe doit contenir au moins 8 caractères';
  }
  // Vérification du fichier uploadé
  $avatarPath = null;
  if (
    isset($_FILES['avatar']) &&
    $_FILES['avatar']['error'] === UPLOAD_ERR_OK
  ) {
    $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
    $fileType = $_FILES['avatar']['type'];
    if (array_key_exists($fileType, $allowedTypes)) {
      $extension = $allowedTypes[$fileType];
      $avatarName = uniqid('avatar_', true) . '.' . $extension;
      $uploadDir = __DIR__ . '/../avatars/'; // Créer le dossier s'il n'existe pas
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
      }
      $targetPath = $uploadDir . $avatarName;
      if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
        $avatarPath = 'avatars/' . $avatarName;
      } else {
        $errors[] = 'Erreur lors du téléchargement de l\'image';
      }
    } else {
      $errors[] = 'Type de fichier non autorisé. Formats acceptés : JPG, PNG';
    }
  } else {
    $errors[] = 'Veuillez sélectionner une image de profil';
  }
  if (empty($errors)) {
    try {
      $pdo = new PDO(
        'mysql:host=localhost;dbname=ecole;charset=utf8mb4',
        'root',
        '',
      );
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Vérifier si l'email existe déjà
      $stmt = $pdo->prepare('SELECT id FROM user2 WHERE email = ?');
      $stmt->execute([$email]);
      if ($stmt->fetch()) {
        $errors[] = 'Cet email est déjà utilisé';
      } else {
        // Insérer le nouvel utilisateur
        $sql =
          'INSERT INTO user2 (nom, prenom, email, password, avatar) VALUES (?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql); // Note: Le mot de passe devrait être haché en production
        $stmt->execute([$nom, $prenom, $email, $password, $avatarPath]);
        $_SESSION['user'] = [
          'id' => $pdo->lastInsertId(),
          'nom' => $nom,
          'prenom' => $prenom,
          'email' => $email,
          'avatar' => $avatarPath,
        ]; // Rediriger pour éviter le renvoi du formulaire
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
      }
    } catch (PDOException $e) {
      error_log('Erreur d\'inscription : ' . $e->getMessage());
      $errors[] = 'Une erreur est survenue lors de l\'inscription';
    }
  }
  if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <style>
    /* Styles pour les modales */
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5);
      z-index: 9999;
      justify-content: center;
      align-items: flex-start;
      padding-top: 4rem;
      padding-bottom: 2.5rem;
      overflow-y: auto;
    }

    /* Styles pour les onglets */
    .tab-button {
      background: none;
      border: none;
      padding: 1rem;
      cursor: pointer;
      font-weight: 500;
      color: #6b7280;
      border-bottom: 2px solid transparent;
      transition: all 0.2s ease;
    }

    .tab-button:hover {
      color: #1f2937;
    }

    .tab-button.active {
      color: #3b82f6;
      border-bottom-color: #3b82f6;
    }

    /* Animation pour l'apparition des onglets */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .tab-content {
      animation: fadeIn 0.3s ease-out;
    }
  </style>
</head>
<!-- Gestion simplifiée des modales -->
<script>
// Fonctions pour gérer les modales
function toggleModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    if (modal.style.display === 'none' || !modal.style.display) {
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    } else {
      modal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
  }
}

// Fermer la modale en cliquant en dehors
document.addEventListener('click', function(event) {
  if (event.target.classList.contains('modal-overlay')) {
    event.target.style.display = 'none';
    document.body.style.overflow = 'auto';
  }
});

// Fermer avec la touche Échap
document.onkeydown = function(event) {
  if (event.key === 'Escape') {
    document.querySelectorAll('.modal-overlay').forEach(modal => {
      if (modal.style.display === 'flex') {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
      }
    });
  }
};

// Changer d'onglet
function switchTab(tabName, tabContainerId) {
  const container = document.getElementById(tabContainerId);
  const tabs = container.getElementsByClassName('tab-content');
  for (let tab of tabs) {
    tab.style.display = 'none';
  }
  document.getElementById(tabName).style.display = 'block';
  
  // Mettre à jour les boutons d'onglet actif
  const buttons = container.getElementsByClassName('tab-button');
  for (let btn of buttons) {
    btn.classList.remove('active');
  }
  event.currentTarget.classList.add('active');
}
</script>
<header class="fixed top-0 left-0 z-50 w-full h-16 md:h-20 bg-white/95 backdrop-blur-sm shadow-sm" 
        x-data="{ 
          mobileMenuOpen: false,
          scrolled: false,
          init() {
            // Détecter le défilement pour l'effet de réduction du header
            window.addEventListener('scroll', () => {
              this.scrolled = window.scrollY > 10;
            });
          }
        }"
        :class="{ 'h-14 md:h-16 transition-all duration-300': scrolled }">
      <div class="container px-4 mx-auto w-full">
        <nav class="flex justify-between items-center w-full h-16 md:h-20">
          <!-- Mobile Menu Button -->
          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            :aria-expanded="mobileMenuOpen"
            class="p-2 mr-2 text-gray-600 rounded-md lg:hidden hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            aria-label="Toggle menu"
            aria-controls="mainMenu"
          >
            <svg class="w-6 h-6 menu-open-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg class="hidden w-6 h-6 menu-close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>

          <!-- Logo -->
          <a href="index.php" class="flex-shrink-0 mx-auto md:mx-0">
            <img src="assets/images/logoo.png" class="w-auto h-10 md:h-12" alt="Hexashop Logo" />
          </a>

          <!-- Main Menu -->
          <div 
            class="absolute left-0 right-0 z-40 w-full px-4 py-6 mt-4 bg-white shadow-lg lg:relative lg:mt-0 lg:shadow-none lg:flex lg:items-center lg:p-0 lg:bg-transparent" 
            :class="{'block': mobileMenuOpen, 'hidden': !mobileMenuOpen}" 
            id="mainMenu"
            @click.away="mobileMenuOpen = false"
          >
            <nav class="flex flex-col lg:flex-row lg:space-x-1 xl:space-x-2" aria-label="Main navigation">
              <a href="index.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname === '/index.php' || window.location.pathname === '/' ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>Home</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname === '/index.php' || window.location.pathname === '/'" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
              
              <a href="single-product.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname.includes('single-product.php') ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>Single Product</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname.includes('single-product.php')" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
              
              <a href="products.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname.includes('products.php') ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>Products</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname.includes('products.php')" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
              
              <a href="contact.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname.includes('contact.php') ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>Contact Us</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname.includes('contact.php')" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
              
              <a href="about.php" 
                 class="relative px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg md:text-base group"
                 :class="window.location.pathname.includes('about.php') ? 'text-primary font-semibold' : 'text-gray-700 hover:text-primary'"
                 @mouseenter="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.remove('opacity-0', 'translate-y-1')"
                 @mouseleave="if (window.innerWidth >= 1024) $el.querySelector('.menu-indicator').classList.add('opacity-0', 'translate-y-1')">
                <span>About Us</span>
                <span class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all duration-300 transform menu-indicator scale-x-0 group-hover:scale-x-100"></span>
                <span x-show="window.location.pathname.includes('about.php')" 
                      class="absolute bottom-0 left-1/2 w-1/2 h-0.5 -translate-x-1/2 bg-primary"></span>
              </a>
            </nav>
          </div>

          <!-- Icons de navigation -->
          <div class="flex items-center space-x-2 sm:space-x-3 md:space-x-4" role="navigation" aria-label="Navigation secondaire">
            <!-- Search Icon -->
            <button 
              class="p-2 text-gray-600 transition-all duration-200 rounded-full hover:bg-gray-100 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:scale-105"
              aria-label="Rechercher sur le site"
              aria-expanded="false"
            >
              <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
            
            <!-- Icône Utilisateur -->
            <div class="relative ml-4">
              <button
                onclick="toggleModal('authModal')"
                class="flex items-center p-2 text-gray-700 hover:text-black transition-colors rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                aria-label="Ouvrir la connexion"
              >
                <div class="relative">
                  <span class="flex items-center justify-center w-8 h-8 rounded-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                  </span>
                </div>
              </button>
            </div>
            
            <!-- Shopping Cart Icon -->
            <button 
              class="relative p-2 text-gray-600 transition-all duration-200 rounded-full hover:bg-gray-100 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:scale-105"
              aria-label="Mon compte"
              aria-expanded="false"
            >
              <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
              </svg>
              <span class="absolute flex items-center justify-center w-5 h-5 text-xs font-medium text-white bg-red-500 rounded-full -top-1 -right-1">3</span>
            </button>
          </div>
        </nav>
      </div>
    </header>

    <!-- Auth Modal -->
    <div id="authModal" 
         class="modal-overlay"
         style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: flex-start; padding-top: 4rem; padding-bottom: 2.5rem; overflow-y: auto;"
         role="dialog"
         aria-modal="true">
         
      <div class="relative px-6 mx-auto mt-8 w-full max-w-md" style="margin: 2rem auto;" onclick="event.stopPropagation()">
        <!-- Modal Content -->
        <div class="relative overflow-hidden bg-white rounded-2xl border border-gray-100 shadow-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4">
             
          <!-- Close Button -->
          <button onclick="toggleModal('authModal')" 
                  class="absolute top-4 right-4 p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 z-10"
                  aria-label="Fermer la fenêtre">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          
          <!-- Tabs Navigation -->
          <div class="flex border-b border-gray-200" role="tablist" aria-label="Navigation d'authentification">
            <button class="tab-button active" onclick="switchTab('login-tab', 'authModal')")"
                    class="flex-1 py-4 font-medium text-center border-b-2 transition-colors duration-200 focus:outline-none"
                    role="tab">
              <span class="inline-flex items-center justify-center">
                <i class="mr-2 fa fa-sign-in"></i>
                Connexion
              </span>
            </button>
            <button class="tab-button" onclick="switchTab('register-tab', 'authModal')")"
                    class="flex-1 py-4 font-medium text-center border-b-2 transition-colors duration-200 focus:outline-none"
                    role="tab">
              <span class="inline-flex items-center justify-center">
                <i class="mr-2 fa fa-user-plus"></i>
                Inscription
              </span>
            </button>
          </div>
          
          <!-- Contenu des onglets -->
          <div class="p-6">
            <!-- Contenu de connexion -->
            <div id="login-tab" class="tab-content space-y-4">
              <h2 class="text-2xl font-bold text-center text-gray-900">Connexion</h2>
              <form class="space-y-4">
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" id="email" class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                </div>
                <div>
                  <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                  <input type="password" id="password" class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                </div>
                <button type="submit" class="w-full px-4 py-2 text-white bg-black rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                  Se connecter
                </button>
              </form>
            </div>
            
            <!-- Contenu d'inscription -->
            <div id="register-tab" class="tab-content space-y-4" style="display: none;">
              <h2 class="text-2xl font-bold text-center text-gray-900">Inscription</h2>
              <form class="space-y-4">
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                  <input type="text" id="name" class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                </div>
                <div>
                  <label for="email-register" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" id="email-register" class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                </div>
                <div>
                  <label for="password-register" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                  <input type="password" id="password-register" class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                </div>
                <button type="submit" class="w-full px-4 py-2 text-white bg-black rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                  S'inscrire
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>