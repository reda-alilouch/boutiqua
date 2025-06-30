<?php
session_start();
require_once __DIR__ . '/../config/database.php';
if (!isset($_SESSION['user']['id'])) {
    header('Location: pages/login.php');
    exit;
}
$pdo = getDBConnection();
$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare('SELECT * FROM addresses WHERE user_id = ? ORDER BY is_default DESC, created_at DESC');
$stmt->execute([$user_id]);
$addresses = $stmt->fetchAll();
?>
<?php include '../includes/head.php'; ?>
<body class="font-poppins">
<?php include '../includes/header.php'; ?>

<main class="py-20">
  <div class="container mx-auto px-4">
    <!-- Header -->
    <div class="max-w-2xl mx-auto mb-12 text-center">
      <h1 class="mb-4 text-3xl font-semibold text-primary">Mes Adresses</h1>
      <p class="text-gray-600">
        Gérez vos adresses de livraison et de facturation.
      </p>
    </div>

    <!-- Messages de succès et d'erreur -->
    <?php if (isset($_SESSION['success'])): ?>
      <div class="max-w-4xl mx-auto mb-6">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
          <div class="flex items-center">
            <i class="fa fa-check-circle mr-2"></i>
            <?php echo htmlspecialchars($_SESSION['success']); ?>
          </div>
        </div>
      </div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="max-w-4xl mx-auto mb-6">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
          <div class="flex items-center">
            <i class="fa fa-exclamation-circle mr-2"></i>
            <?php echo htmlspecialchars($_SESSION['error']); ?>
          </div>
        </div>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Add New Address Button -->
    <div class="max-w-4xl mx-auto mb-8">
      <button onclick="toggleAddressForm()" class="inline-flex items-center px-6 py-3 border text-black font-semibold rounded-lg hover:bg-black hover:text-white transition-colors">
        <i class="fa fa-plus mr-2"></i>
        Ajouter une nouvelle adresse
      </button>
    </div>

    <!-- Add Address Form (Hidden by default) -->
    <div id="addressForm" class="max-w-2xl mx-auto mb-12 hidden">
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-xl font-semibold mb-6">Nouvelle adresse</h3>
        <form method="post" action="add_address.php" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
              <input type="text" name="first_name" required class="w-full form-addresses border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
              <input type="text" name="last_name" required class="w-full form-addresses border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Société</label>
            <input type="text" name="company" class="w-full form-addresses border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Adresse *</label>
            <input type="text" name="street" required class="w-full form-addresses border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Complément d'adresse</label>
            <input type="text" name="street2" class="w-full form-addresses border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Ville *</label>
              <input type="text" name="city" required class="w-full form-addresses border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Code postal *</label>
              <input type="text" name="zip" required class="w-full form-addresses border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Pays *</label>
              <select name="country" required class="w-full form-addresses border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                <option value="France" selected>France</option>
                <option value="Belgique">Belgique</option>
                <option value="Suisse">Suisse</option>
                <option value="Canada">Canada</option>
                <option value="Luxembourg">Luxembourg</option>
              </select>
            </div>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
            <input type="tel" name="phone" class="w-full form-addresses border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
          </div>
          
          <div class="flex items-center">
            <input type="checkbox" name="is_default" id="is_default" class="mr-2">
            <label for="is_default" class="text-sm text-gray-700">Définir comme adresse par défaut</label>
          </div>
          
          <div class="flex gap-4 pt-4">
            <button type="submit" class="flex-1 px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-colors">
              Enregistrer l'adresse
            </button>
            <button type="button" onclick="toggleAddressForm()" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
              Annuler
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Addresses List -->
    <?php if (empty($addresses)): ?>
      <!-- Empty State -->
      <div class="max-w-md mx-auto text-center py-12">
        <div class="mb-6">
          <i class="fa fa-map-marker text-6xl text-gray-300"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune adresse enregistrée</h3>
        <p class="text-gray-500 mb-6">Ajoutez votre première adresse pour faciliter vos commandes.</p>
        <button onclick="toggleAddressForm()" class="inline-flex items-center px-6 py-3 border text-black font-semibold rounded-lg hover:bg-black hover:text-white transition-colors">
          <i class="fa fa-plus mr-2"></i>
          Ajouter une adresse
        </button>
      </div>
    <?php else: ?>
      <!-- Addresses Grid -->
      <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <?php foreach ($addresses as $address): ?>
            <div class="bg-white rounded-2xl shadow-lg p-6 relative">
              <?php if ($address['is_default']): ?>
                <div class="absolute top-4 right-4">
                  <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                    <i class="fa fa-star mr-1"></i>
                    Par défaut
                  </span>
                </div>
              <?php endif; ?>
              
              <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900">
                  <?php echo htmlspecialchars($address['first_name'] . ' ' . $address['last_name']); ?>
                </h3>
                <?php if ($address['company']): ?>
                  <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($address['company']); ?></p>
                <?php endif; ?>
              </div>
              
              <div class="space-y-1 text-gray-700 mb-4">
                <p><?php echo htmlspecialchars($address['street']); ?></p>
                <?php if ($address['street2']): ?>
                  <p><?php echo htmlspecialchars($address['street2']); ?></p>
                <?php endif; ?>
                <p><?php echo htmlspecialchars($address['zip'] . ' ' . $address['city']); ?></p>
                <p><?php echo htmlspecialchars($address['country']); ?></p>
                <?php if ($address['phone']): ?>
                  <p class="text-sm text-gray-600">
                    <i class="fa fa-phone mr-1"></i>
                    <?php echo htmlspecialchars($address['phone']); ?>
                  </p>
                <?php endif; ?>
              </div>
              
              <div class="flex gap-2 pt-4 border-t border-gray-100">
                <button onclick="editAddress(<?php echo $address['id']; ?>)" class="flex-1 border border-primary text-primary font-medium rounded-lg hover:bg-primary hover:text-white transition-colors">
                  Modifier
                </button>
                <form method="post" action="delete_address.php" class="flex-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette adresse ?')">
                  <input type="hidden" name="address_id" value="<?php echo $address['id']; ?>">
                  <button type="submit" class="w-full border border-red-500 text-red-500 font-medium rounded-lg hover:bg-red-500 hover:text-white transition-colors">
                    Supprimer
                  </button>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</main>

<script>
function toggleAddressForm() {
  const form = document.getElementById('addressForm');
  form.classList.toggle('hidden');
}

function editAddress(addressId) {
  // TODO: Implémenter l'édition d'adresse
  alert('Fonctionnalité d\'édition à implémenter pour l\'adresse ID: ' + addressId);
}
</script>

<?php include '../includes/footer.php'; ?>

<!-- Scripts -->
<?php include '../includes/scripts.php'; ?>
</body> 
