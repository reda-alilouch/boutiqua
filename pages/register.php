<?php
session_start();

// Inclure le contrôleur d'authentification
require_once __DIR__ . '/../src/Controllers/AuthController.php';
use Astrodia\Controllers\AuthController;

// Rediriger si déjà connecté
if (isset($_SESSION['user'])) {
  header('Location: /astrodia/index.php');
  exit();
}

$errors = [];
$success = false;

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $authController = new AuthController();
  $result = $authController->register($_POST, $_FILES);
  
  if ($result['success']) {
    // Redirection après inscription réussie
    header('Location: /astrodia/index.php');
    exit();
  } else {
    $errors = $result['errors'];
    if (!empty($result['message'])) {
      $errors[] = $result['message'];
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
<body class="bg-gray-100">
    <?php include '../includes/header.php'; ?>
    
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Créer un compte
                </h2>
            </div>
            
            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc list-inside">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    Inscription réussie ! Vous allez être redirigé vers la page d'accueil...
                </div>
            <?php else: ?>
                <form class="mt-8 space-y-6" action="register.php" method="POST" enctype="multipart/form-data">
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="prenom" class="sr-only">Prénom</label>
                                <input id="prenom" name="prenom" type="text" required 
                                       class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-tl-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                       placeholder="Prénom" value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>">
                            </div>
                            <div>
                                <label for="nom" class="sr-only">Nom</label>
                                <input id="nom" name="nom" type="text" required 
                                       class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-tr-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                       placeholder="Nom" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="sr-only">Adresse email</label>
                            <input id="email" name="email" type="email" required 
                                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Adresse email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                        <div>
                            <label for="password" class="sr-only">Mot de passe</label>
                            <input id="password" name="password" type="password" required 
                                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Mot de passe (min. 8 caractères)">
                        </div>
                        <div>
                            <label for="confirm_password" class="sr-only">Confirmer le mot de passe</label>
                            <input id="confirm_password" name="confirm_password" type="password" required 
                                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Confirmer le mot de passe">
                        </div>
                        <div class="pt-2">
                            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Photo de profil (optionnel)</label>
                            <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100">
                            <p class="mt-1 text-xs text-gray-500">PNG ou JPG (max. 2MB)</p>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            S'inscrire
                        </button>
                    </div>
                </form>
                
                <div class="text-sm text-center">
                    <p class="text-gray-600">
                        Déjà inscrit ? 
                        <a href="/astrodia/pages/login.php" class="font-medium text-blue-600 hover:text-blue-500">
                            Se connecter
                        </a>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    
    <!-- Scripts -->
    <?php include '../includes/scripts.php'; ?>
</body>
</html>
