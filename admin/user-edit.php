<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Sécurité : accès uniquement admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$pdo = getDBConnection();

// Initialisation des variables
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$editMode = $id > 0;
$errors = [];
$prenom = $nom = $email = $role = '';
$password = '';

// Récupérer les infos de l'utilisateur si édition
if ($editMode) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    if (!$user) {
        header('Location: users.php');
        exit;
    }
    $prenom = $user['prenom'] ?? '';
    $nom = $user['nom'] ?? '';
    $email = $user['email'];
    $role = $user['role'];
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = trim($_POST['prenom'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = ($_POST['role'] ?? 'user') === 'admin' ? 'admin' : 'user';
    $password = $_POST['password'] ?? '';

    if ($prenom === '') $errors[] = 'Le prénom est requis.';
    if ($nom === '') $errors[] = 'Le nom est requis.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email invalide.';
    if (!$editMode && strlen($password) < 6) $errors[] = 'Le mot de passe doit faire au moins 6 caractères.';

    // Vérifier unicité de l'email
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?' . ($editMode ? ' AND id != ?' : ''));
    $params = $editMode ? [$email, $id] : [$email];
    $stmt->execute($params);
    if ($stmt->fetch()) $errors[] = 'Cet email est déjà utilisé.';

    if (empty($errors)) {
        if ($editMode) {
            if ($password) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('UPDATE users SET prenom=?, nom=?, email=?, role=?, password=? WHERE id=?');
                $stmt->execute([$prenom, $nom, $email, $role, $hash, $id]);
            } else {
                $stmt = $pdo->prepare('UPDATE users SET prenom=?, nom=?, email=?, role=? WHERE id=?');
                $stmt->execute([$prenom, $nom, $email, $role, $id]);
            }
            header('Location: users.php?updated=1');
            exit;
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (prenom, nom, email, role, password) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$prenom, $nom, $email, $role, $hash]);
            header('Location: users.php?added=1');
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $editMode ? 'Éditer' : 'Ajouter'; ?> un utilisateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
    <style>
        body { background: #f4f6fa; }
        .admin-container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 16px #0001; padding: 32px; }
        .admin-title { font-size: 1.5rem; font-weight: bold; color: #222; margin-bottom: 24px; }
        form { display: flex; flex-direction: column; gap: 18px; }
        label { font-weight: 500; color: #333; }
        input, select { padding: 10px; border-radius: 8px; border: 1px solid #ddd; font-size: 1rem; }
        .btn { padding: 10px 24px; border-radius: 8px; background: #2b6cb0; color: #fff; font-weight: 600; border: none; cursor: pointer; font-size: 1rem; }
        .btn:hover { background: #1e40af; }
        .back-link { display: inline-block; margin-bottom: 18px; color: #2b6cb0; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
        .error { background: #fee2e2; color: #b91c1c; padding: 10px 18px; border-radius: 8px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <a href="users.php" class="back-link"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
        <div class="admin-title"><?php echo $editMode ? 'Éditer' : 'Ajouter'; ?> un utilisateur</div>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $err) echo htmlspecialchars($err) . '<br>'; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <label>Prénom *</label>
            <input type="text" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>" required>

            <label>Nom *</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required>

            <label>Email *</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label>Rôle *</label>
            <select name="role">
                <option value="user" <?php if ($role === 'user') echo 'selected'; ?>>Utilisateur</option>
                <option value="admin" <?php if ($role === 'admin') echo 'selected'; ?>>Admin</option>
            </select>

            <label><?php echo $editMode ? 'Nouveau mot de passe' : 'Mot de passe *'; ?></label>
            <input type="password" name="password" <?php if (!$editMode) echo 'required'; ?> autocomplete="new-password">

            <button class="btn" type="submit"><?php echo $editMode ? 'Enregistrer' : 'Ajouter'; ?></button>
        </form>
    </div>
</body>
</html> 