<?php
session_start();

// Rediriger si déjà connecté
if (isset($_SESSION['user'])) {
  header('Location: /hexashop-1.0.0/index.php');
  exit();
}

$errors = [];
$success = false;

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
  $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'] ?? '';
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
  if (strlen($password) < 8) {
    $errors[] = 'Le mot de passe doit contenir au moins 8 caractères';
  }
  if ($password !== $confirm_password) {
    $errors[] = 'Les mots de passe ne correspondent pas';
  }

  // Traitement de l'avatar
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
      $uploadDir = __DIR__ . '/assets/uploads/avatars/';

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
  }

  // Si pas d'erreurs, enregistrer l'utilisateur
  if (empty($errors)) {
    try {
      $pdo = new PDO(
        'mysql:host=localhost;dbname=ecole;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
      );

      // Vérifier si l'email existe déjà
      $stmt = $pdo->prepare('SELECT id FROM user2 WHERE email = ?');
      $stmt->execute([$email]);

      if ($stmt->fetch()) {
        $errors[] = 'Cet email est déjà utilisé';
      } else {
        // Insérer le nouvel utilisateur
        $stmt = $pdo->prepare(
          'INSERT INTO user2 (nom, prenom, email, password, avatar) VALUES (?, ?, ?, ?, ?)',
        );
        $stmt->execute([$nom, $prenom, $email, $password, $avatarPath]);

        // Connecter automatiquement l'utilisateur
        $userId = $pdo->lastInsertId();
        $_SESSION['user'] = [
          'id' => $userId,
          'nom' => $nom,
          'prenom' => $prenom,
          'email' => $email,
          'avatar' => $avatarPath,
        ];

        $success = true;

        // Rediriger après inscription réussie
        header('Refresh: 3; URL=index.php');
      }
    } catch (PDOException $e) {
      error_log('Erreur d\'inscription : ' . $e->getMessage());
      $errors[] = 'Une erreur est survenue lors de l\'inscription';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<body class="bg-gray-100">
    <?php include 'includes/header.php'; ?>
    
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
                <form class="mt-8 space-y-6" action="/hexashop-1.0.0/register.php" method="POST" enctype="multipart/form-data">
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="prenom" class="sr-only">Prénom</label>
                                <input id="prenom" name="prenom" type="text" required 
                                       class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-tl-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                       placeholder="Prénom" value="<?php echo isset(
                                         $_POST['prenom'],
                                       )
                                         ? htmlspecialchars($_POST['prenom'])
                                         : ''; ?>">
                            </div>
                            <div>
                                <label for="nom" class="sr-only">Nom</label>
                                <input id="nom" name="nom" type="text" required 
                                       class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-tr-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                       placeholder="Nom" value="<?php echo isset(
                                         $_POST['nom'],
                                       )
                                         ? htmlspecialchars($_POST['nom'])
                                         : ''; ?>">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="sr-only">Adresse email</label>
                            <input id="email" name="email" type="email" required 
                                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Adresse email" value="<?php echo isset(
                                     $_POST['email'],
                                   )
                                     ? htmlspecialchars($_POST['email'])
                                     : ''; ?>">
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
                        <a href="/hexashop-1.0.0/login.php" class="font-medium text-blue-600 hover:text-blue-500">
                            Se connecter
                        </a>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
