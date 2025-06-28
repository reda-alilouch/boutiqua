<?php
// Démarrer la session
session_start();

// Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user'])) {
  $_SESSION['redirect_after_login'] = '/astrodia/profile.php';
  header('Location: /astrodia/login.php');
  exit();
}

$user = $_SESSION['user'];
$success = '';
$errors = [];

// Traitement du formulaire de mise à jour du profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
  $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $current_password = $_POST['current_password'] ?? '';
  $new_password = $_POST['new_password'] ?? '';
  $confirm_password = $_POST['confirm_password'] ?? '';

  // Validation des données
  if (empty($nom)) {
    $errors[] = 'Le nom est requis';
  }
  if (empty($prenom)) {
    $errors[] = 'Le prénom est requis';
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email invalide';
  }

  // Vérifier si l'utilisateur veut changer de mot de passe
  $update_password =
    !empty($current_password) ||
    !empty($new_password) ||
    !empty($confirm_password);

  if ($update_password) {
    if (strlen($new_password) < 8) {
      $errors[] = 'Le nouveau mot de passe doit contenir au moins 8 caractères';
    }
    if ($new_password !== $confirm_password) {
      $errors[] = 'Les nouveaux mots de passe ne correspondent pas';
    }
  }

  // Traitement de l'avatar
  $avatarPath = $user['avatar'];
  if (
    isset($_FILES['avatar']) &&
    $_FILES['avatar']['error'] === UPLOAD_ERR_OK
  ) {
    $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
    $fileType = $_FILES['avatar']['type'];

    if (array_key_exists($fileType, $allowedTypes)) {
      $extension = $allowedTypes[$fileType];
      $avatarName = uniqid('avatar_', true) . '.' . $extension;
      $uploadDir = __DIR__ . '/avatars/';

      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
      }

      // Supprimer l'ancien avatar s'il existe
      if ($avatarPath && file_exists($avatarPath)) {
        unlink($avatarPath);
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
  }

  // Si pas d'erreurs, mettre à jour le profil
  if (empty($errors)) {
    try {
      $pdo = new PDO(
        'mysql:host=localhost;dbname=ecole;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
      );

      // Vérifier si l'email est déjà utilisé par un autre utilisateur
      $stmt = $pdo->prepare('SELECT id FROM user2 WHERE email = ? AND id != ?');
      $stmt->execute([$email, $user['id']]);

      if ($stmt->fetch()) {
        $errors[] = 'Cet email est déjà utilisé par un autre compte';
      } else {
        // Vérifier le mot de passe actuel si changement de mot de passe
        if ($update_password) {
          $stmt = $pdo->prepare('SELECT password FROM user2 WHERE id = ?');
          $stmt->execute([$user['id']]);
          $dbUser = $stmt->fetch(PDO::FETCH_ASSOC);

          if ($dbUser && $dbUser['password'] === $current_password) {
            // Mettre à jour avec le nouveau mot de passe
            $stmt = $pdo->prepare(
              'UPDATE user2 SET nom = ?, prenom = ?, email = ?, password = ?, avatar = ? WHERE id = ?',
            );
            $stmt->execute([
              $nom,
              $prenom,
              $email,
              $new_password,
              $avatarPath,
              $user['id'],
            ]);
          } else {
            $errors[] = 'Mot de passe actuel incorrect';
            goto render_page; // Aller directement au rendu de la page
          }
        } else {
          // Mettre à jour sans changer le mot de passe
          $stmt = $pdo->prepare(
            'UPDATE user2 SET nom = ?, prenom = ?, email = ?, avatar = ? WHERE id = ?',
          );
          $stmt->execute([$nom, $prenom, $email, $avatarPath, $user['id']]);
        }

        // Mettre à jour les données de session
        $_SESSION['user'] = [
          'id' => $user['id'],
          'nom' => $nom,
          'prenom' => $prenom,
          'email' => $email,
          'avatar' => $avatarPath,
        ];

        $user = $_SESSION['user'];
        $success = 'Profil mis à jour avec succès';
      }
    } catch (PDOException $e) {
      error_log('Erreur de mise à jour du profil : ' . $e->getMessage());
      $errors[] = 'Une erreur est survenue lors de la mise à jour du profil';
    }
  }
}

render_page:
?>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<body class="bg-gray-100">
    <?php include 'includes/header.php'; ?>
    
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="md:flex md:space-x-8">
                <!-- Menu latéral -->
                <div class="md:w-1/4 mb-8 md:mb-0">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6 text-center">
                            <div class="relative inline-block">
                                <img src="<?php echo !empty($user['avatar'])
                                  ? '/astrodia/' .
                                    htmlspecialchars($user['avatar'])
                                  : 'https://ui-avatars.com/api/?name=' .
                                    urlencode(
                                      $user['prenom'] . '+' . $user['nom'],
                                    ) .
                                    '&size=200'; ?>" 
                                     alt="Photo de profil" 
                                     class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md">
                                <label for="avatar-upload" class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2 cursor-pointer hover:bg-blue-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <input type="file" id="avatar-upload" name="avatar" class="hidden" accept="image/png, image/jpeg">
                                </label>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-gray-900">
                                <?php echo htmlspecialchars(
                                  $user['prenom'] . ' ' . $user['nom'],
                                ); ?>
                            </h3>
                            <p class="text-gray-600"><?php echo htmlspecialchars(
                              $user['email'],
                            ); ?></p>
                        </div>
                        <nav class="border-t border-gray-200">
                            <a href="#" class="block px-6 py-4 text-blue-600 font-medium border-l-4 border-blue-500 bg-blue-50">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Mon profil
                                </div>
                            </a>
                            <a href="/astrodia/orders.php" class="block px-6 py-4 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    Mes commandes
                                </div>
                            </a>
                            <a href="/astrodia/wishlist.php" class="block px-6 py-4 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    Ma liste de souhaits
                                </div>
                            </a>
                            <a href="/astrodia/addresses.php" class="block px-6 py-4 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Mes adresses
                                </div>
                            </a>
                            <a href="/astrodia/logout.php" class="block px-6 py-4 text-red-600 hover:bg-gray-50 font-medium">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Se déconnecter
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>
                
                <!-- Contenu principal -->
                <div class="md:w-3/4">
                    <?php if ($success): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline"><?php echo htmlspecialchars(
                              $success,
                            ); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($errors)): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <ul class="list-disc list-inside">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars(
                                      $error,
                                    ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Informations personnelles</h3>
                        </div>
                        <form method="POST" action="/astrodia/profile.php" enctype="multipart/form-data" class="p-6">
                            <input type="file" id="avatar" name="avatar" class="hidden" accept="image/png, image/jpeg">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                                    <input type="text" id="prenom" name="prenom" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           value="<?php echo htmlspecialchars(
                                             $user['prenom'],
                                           ); ?>">
                                </div>
                                <div>
                                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                    <input type="text" id="nom" name="nom" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           value="<?php echo htmlspecialchars(
                                             $user['nom'],
                                           ); ?>">
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                                <input type="email" id="email" name="email" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       value="<?php echo htmlspecialchars(
                                         $user['email'],
                                       ); ?>">
                            </div>
                            
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <h4 class="text-md font-medium text-gray-900 mb-4">Changer de mot de passe</h4>
                                <p class="text-sm text-gray-500 mb-4">Laissez ces champs vides si vous ne souhaitez pas changer de mot de passe.</p>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                                        <input type="password" id="current_password" name="current_password"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                                        <input type="password" id="new_password" name="new_password"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le nouveau mot de passe</label>
                                        <input type="password" id="confirm_password" name="confirm_password"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    
    <script>
    // Gestion du téléchargement d'avatar
    document.getElementById('avatar-upload').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const fileSize = file.size / 1024 / 1024; // en MB
            
            if (fileSize > 2) {
                alert('La taille du fichier ne doit pas dépasser 2MB');
                this.value = '';
                return false;
            }
            
            document.getElementById('avatar').files = this.files;
        }
    });
    </script>
</body>
</html>
