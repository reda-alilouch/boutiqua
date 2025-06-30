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
$name = $description = $price = $stock = $category = $image = '';

// Récupérer les infos du produit si édition
if ($editMode) {
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    if (!$product) {
        header('Location: products.php');
        exit;
    }
    $name = $product['name'];
    $description = $product['description'];
    $price = $product['price'];
    $stock = $product['stock'];
    $category = $product['category'];
    $image = $product['image'];
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $stock = intval($_POST['stock'] ?? 0);
    $category = trim($_POST['category'] ?? '');
    $image = trim($_POST['image'] ?? '');

    if ($name === '') $errors[] = 'Le nom est requis.';
    if ($price <= 0) $errors[] = 'Le prix doit être positif.';
    if ($stock < 0) $errors[] = 'Le stock ne peut pas être négatif.';
    if ($category === '') $errors[] = 'La catégorie est requise.';
    if ($image === '') $errors[] = 'Le nom de l\'image est requis (ex: produit.jpg).';

    if (empty($errors)) {
        if ($editMode) {
            $stmt = $pdo->prepare('UPDATE products SET name=?, description=?, price=?, stock=?, category=?, image=? WHERE id=?');
            $stmt->execute([$name, $description, $price, $stock, $category, $image, $id]);
            header('Location: products.php?updated=1');
            exit;
        } else {
            $stmt = $pdo->prepare('INSERT INTO products (name, description, price, stock, category, image) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$name, $description, $price, $stock, $category, $image]);
            header('Location: products.php?added=1');
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
    <title><?php echo $editMode ? 'Éditer' : 'Ajouter'; ?> un produit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
    <style>
        body { background: #f4f6fa; }
        .admin-container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 16px #0001; padding: 32px; }
        .admin-title { font-size: 1.5rem; font-weight: bold; color: #222; margin-bottom: 24px; }
        form { display: flex; flex-direction: column; gap: 18px; }
        label { font-weight: 500; color: #333; }
        input, textarea, select { padding: 10px; border-radius: 8px; border: 1px solid #ddd; font-size: 1rem; }
        textarea { min-height: 80px; }
        .btn { padding: 10px 24px; border-radius: 8px; background: #2b6cb0; color: #fff; font-weight: 600; border: none; cursor: pointer; font-size: 1rem; }
        .btn:hover { background: #1e40af; }
        .back-link { display: inline-block; margin-bottom: 18px; color: #2b6cb0; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
        .error { background: #fee2e2; color: #b91c1c; padding: 10px 18px; border-radius: 8px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <a href="products.php" class="back-link"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
        <div class="admin-title"><?php echo $editMode ? 'Éditer' : 'Ajouter'; ?> un produit</div>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $err) echo htmlspecialchars($err) . '<br>'; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <label>Nom du produit *</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

            <label>Description</label>
            <textarea name="description"><?php echo htmlspecialchars($description); ?></textarea>

            <label>Prix (€) *</label>
            <input type="number" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($price); ?>" required>

            <label>Stock *</label>
            <input type="number" name="stock" min="0" value="<?php echo htmlspecialchars($stock); ?>" required>

            <label>Catégorie *</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($category); ?>" required>

            <label>Nom de l'image (ex: produit.jpg) *</label>
            <input type="text" name="image" value="<?php echo htmlspecialchars($image); ?>" required>

            <button class="btn" type="submit"><?php echo $editMode ? 'Enregistrer' : 'Ajouter'; ?></button>
        </form>
    </div>
</body>
</html> 