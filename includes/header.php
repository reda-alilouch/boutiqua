<?php
/**
 * En-tête principal du site avec navigation et modaux d'authentification
 *
 * @package HexaShop
 * @version 1.0.0
 */

// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'ecole');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Configuration des uploads
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads/');
define('AVATAR_DIR', UPLOAD_DIR . 'avatars/');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Fonction de connexion à la base de données
function getDBConnection()
{
  try {
    $dsn = sprintf(
      'mysql:host=%s;dbname=%s;charset=%s',
      DB_HOST,
      DB_NAME,
      DB_CHARSET,
    );
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
  } catch (PDOException $e) {
    error_log('Erreur de connexion à la base de données : ' . $e->getMessage());
    throw new Exception(
      'Une erreur est survenue lors de la connexion à la base de données',
    );
  }
}

// Gestion de la déconnexion
if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: /hexashop-1.0.0/index.php');
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

      header('Location: /hexashop-1.0.0/index.php');
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

        header('Location: /hexashop-1.0.0/index.php');
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

    <header class="fixed top-0 left-0 z-50 w-full shadow-sm bg-white/95 backdrop-blur-sm" 
            class="transition-all duration-300" id="mainHeader">
        
        <div class="container px-4 mx-auto">
            <nav class="flex items-center justify-between h-16 md:h-20">
                
                <!-- Mobile Menu Button -->
                <div onclick="toggleMenu()" class="menu-button">
                    <i class="fa-solid fa-bars text-xl lg:hidden" id="menuicon"></i>
                </div>

                <!-- Logo -->
                <a href="/hexashop-1.0.0/index.php" class="flex-shrink-0">
                    <img src="/hexashop-1.0.0/assets/images/logoo.png" 
                         class="w-auto h-8 md:h-10" alt="Hexashop Logo" />
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden space-x-8 lg:flex">
                    <a href="/hexashop-1.0.0/index.php" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        Accueil
                    </a>
                    <a href="/hexashop-1.0.0/products.php" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        Produits
                    </a>
                    <a href="/hexashop-1.0.0/single-product.php" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        Produit Unique
                    </a>
                    <a href="/hexashop-1.0.0/contact.php" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        Contact
                    </a>
                    <a href="/hexashop-1.0.0/about.php" 
                       class="font-medium text-gray-700 transition-colors hover:text-blue-600">
                        À Propos
                    </a>
                </nav>

                <!-- Actions -->
                <div class="flex items-center space-x-2">
                    
                    <!-- Search Button -->
                    <button @click="searchOpen = true"
                            class="p-2 text-gray-600 transition-all rounded-full hover:text-black hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <!-- Cart Button -->
                    <button @click="cartOpen = !cartOpen"
                            class="relative p-2 text-gray-600 transition-all rounded-full hover:text-black hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="cart-badge">3</span>
                    </button>

                    <!-- User Profile / Auth -->
                    <?php if ($isLoggedIn): ?>
                        <div class="relative">
                            <button @click="profileOpen = !profileOpen"
                                    class="flex items-center p-2 text-gray-600 transition-all rounded-full hover:text-black hover:bg-gray-100">
                                <?php if ($user['avatar']): ?>
                                    <img src="/hexashop-1.0.0/assets/uploads/<?php echo htmlspecialchars(
                                      $user['avatar'],
                                    ); ?>" 
                                         alt="Avatar" class="object-cover w-8 h-8 rounded-full">
                                <?php else: ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                <?php endif; ?>
                            </button>
                            
                            <!-- Profile Dropdown -->
                            <div x-show="profileOpen" 
                                 @click.away="profileOpen = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 z-50 w-64 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg">
                                
                                <div class="p-4 border-b border-gray-100">
                                    <p class="font-medium text-gray-900">
                                        <?php echo htmlspecialchars(
                                          $user['prenom'] . ' ' . $user['nom'],
                                        ); ?>
                                    </p>
                                    <p class="text-sm text-gray-500"><?php echo htmlspecialchars(
                                      $user['email'],
                                    ); ?></p>
                                </div>
                                
                                <div class="py-2">
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Mon Profil
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Mes Commandes
                                    </a>
                                    <a href="?logout=1" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Déconnexion
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <button data-modal-toggle="authModal"
                                class="p-2 text-gray-600 transition-all rounded-full hover:text-black hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu -->
                <div id="mobileMenu" class="absolute left-0 right-0 bg-white border-t shadow-lg top-full hidden">
                    <nav class="flex flex-col py-4">
                        <a href="/hexashop-1.0.0/index.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            Accueil
                        </a>
                        <a href="/hexashop-1.0.0/products.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            Produits
                        </a>
                        <a href="/hexashop-1.0.0/single-product.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            Produit Unique
                        </a>
                        <a href="/hexashop-1.0.0/contact.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            Contact
                        </a>
                        <a href="/hexashop-1.0.0/about.php" 
                           class="px-4 py-3 text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600">
                            À Propos
                        </a>
                    </nav>
                </div>
            </nav>
        </div>

        <!-- Cart Dropdown -->
        <div x-show="cartOpen" 
             x-transition
             @click.away="cartOpen = false"
             class="absolute z-50 mt-2 bg-white border border-gray-200 rounded-lg shadow-xl top-full right-4 w-80">
            
            <div class="p-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Mon Panier (3)</h3>
            </div>
            
            <div class="overflow-y-auto max-h-64">
                <!-- Cart Items -->
                <div class="p-4 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <img src="/hexashop-1.0.0/assets/images/product-1.jpg" 
                             alt="Produit" class="object-cover w-12 h-12 rounded">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium">T-shirt Premium</h4>
                            <p class="text-xs text-gray-500">Taille: M, Couleur: Noir</p>
                            <p class="text-sm font-semibold">29,99€</p>
                        </div>
                        <button class="text-red-500 hover:text-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Repeat for more items -->
                <div class="p-4 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <img src="/hexashop-1.0.0/assets/images/product-2.jpg" 
                             alt="Produit" class="object-cover w-12 h-12 rounded">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium">Jean Slim</h4>
                            <p class="text-xs text-gray-500">Taille: 32, Couleur: Bleu</p>
                            <p class="text-sm font-semibold">49,99€</p>
                        </div>
                        <button class="text-red-500 hover:text-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-semibold">Total:</span>
                    <span class="text-lg font-bold">89,97€</span>
                </div>
                <button class="w-full py-2 text-white transition-colors bg-black rounded-lg hover:bg-gray-800">
                    Voir le Panier
                </button>
            </div>
        </div>

        <!-- Search Modal -->
        <div x-show="searchOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click.self="searchOpen = false"
             @keydown.escape.window="searchOpen = false"
             class="fixed inset-0 z-50 flex items-start justify-center pt-20 bg-black bg-opacity-50">
            
            <div class="w-full max-w-2xl mx-4 bg-white rounded-lg shadow-xl">
                <div class="p-6">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Rechercher des produits..." 
                               class="w-full py-3 pl-12 pr-4 text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               x-ref="searchInput">
                        <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <button @click="searchOpen = false" 
                                class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Search Results -->
                    <div class="mt-4">
                        <h3 class="mb-2 text-sm font-semibold text-gray-500 uppercase">Recherches populaires</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 text-sm text-gray-700 bg-gray-100 rounded-full cursor-pointer hover:bg-gray-200">T-shirts</span>
                            <span class="px-3 py-1 text-sm text-gray-700 bg-gray-100 rounded-full cursor-pointer hover:bg-gray-200">Jeans</span>
                            <span class="px-3 py-1 text-sm text-gray-700 bg-gray-100 rounded-full cursor-pointer hover:bg-gray-200">Sneakers</span>
                            <span class="px-3 py-1 text-sm text-gray-700 bg-gray-100 rounded-full cursor-pointer hover:bg-gray-200">Vestes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inclusion de la modale d'authentification -->
        <?php include __DIR__ . '/auth-modal.php'; ?>
                </button>
            </div>
        </div>
    </div>

   
    </header>
    
    <!-- Script pour la gestion de la modale d'authentification -->
   
