<?php
session_start();

// Inclure le contrôleur d'authentification
require_once __DIR__ . '/../src/Controllers/AuthController.php';
use boutiqua\Controllers\AuthController;

// Rediriger si déjà connecté
if (isset($_SESSION['user'])) {
  header('Location: /boutiqua/index.php');
  exit();
}

$error = '';

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $authController = new AuthController();
  $result = $authController->login($_POST);
  
  if ($result['success']) {
    // Redirection après connexion réussie
    // Rediriger vers la page précédente ou la page d'accueil
    $redirect = $_SESSION['redirect_after_login'] ?? '/boutiqua/index.php';
    unset($_SESSION['redirect_after_login']);
    $_SESSION['user'] = $result['user']; // $result['user'] doit contenir le champ 'role'
    header('Location: ' . $redirect);
    exit();
  } else {
    $error = $result['message'];
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
                    Connectez-vous à votre compte
                </h2>
            </div>
            
            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars(
                      $error,
                    ); ?></span>
                </div>
            <?php endif; ?>
            
            <form class="mt-8 space-y-6" action="login.php" method="POST">
                <div class="shadow-sm space-y-4">
                    <div >
                        <label for="email" class="sr-only">Adresse email</label>
                        <input id="email" name="email" type="email" required 
                               class="appearance-none rounded-md relative block w-full px-1 py-1 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-black focus:border-black focus:z-10 sm:text-sm" 
                               placeholder="Adresse email" value="<?php echo isset(
                                 $_POST['email'],
                               )
                                 ? htmlspecialchars($_POST['email'])
                                 : ''; ?>">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Mot de passe</label>
                        <input id="password" name="password" type="password" required 
                               class="appearance-none rounded-md relative block w-full px-1 py-1 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-black focus:border-black focus:z-10 sm:text-sm" 
                               placeholder="Mot de passe">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" 
                               class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Se souvenir de moi
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-black hover:text-gray-900">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center px-1 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                        Se connecter
                    </button>
                </div>
            </form>
            
            <div class="text-sm text-center">
                <div class="mt-2 text-center text-sm text-gray-600">
                    Pas encore de compte ? <a href="/boutiqua/pages/register.php" class="font-medium text-black hover:text-gray-900">S'inscrire</a>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    
    <!-- Scripts -->
    <?php include '../includes/scripts.php'; ?>
</body>
</html>
