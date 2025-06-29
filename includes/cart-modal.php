<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';
$pdo = getDBConnection();
$cart_items = [];
$total = 0;
if (isset($_SESSION['user']['id'])) {
    $user_id = $_SESSION['user']['id'];
    $stmt = $pdo->prepare('
        SELECT c.*, p.name, p.price, p.image
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?
    ');
    $stmt->execute([$user_id]);
    $cart_items = $stmt->fetchAll();
    
    // Calculer le total
    foreach ($cart_items as $item) {
        $total += $item['quantity'] * $item['price'];
    }
}
?>
<div id="CartModal" style="display:none; position:fixed; inset:0; z-index:1000; align-items:center; justify-content:center; background:rgba(0,0,0,0.3); backdrop-filter: blur(2px);">
  <div id="cartModalBox" class="bg-white p-8 rounded-lg min-w-[300px] max-w-[500px] max-h-[80vh] overflow-y-auto relative shadow-2xl transition-all duration-300 ease-in-out opacity-0 scale-95">
    <button id="closeCartModalBtn" class="absolute top-4 right-4 text-2xl text-gray-400 hover:text-red-500 transition-colors">&times;</button>
    <h2 class="text-xl font-bold mb-4 flex items-center gap-2 text-green-700">
      <i class="fa-solid fa-cart-shopping"></i> Mon Panier
    </h2>
    <div>
      <?php if (empty($cart_items)): ?>
        <div class="text-center py-8">
          <p class="text-gray-600 mb-4"><i class="fa-solid fa-basket-shopping"></i> Votre panier est vide.</p>
          <a href="products.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Continuer les achats
          </a>
        </div>
      <?php else: ?>
        <div class="space-y-3 mb-4">
          <?php foreach ($cart_items as $item): ?>
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
              <img src="src/images/<?php echo htmlspecialchars($item['image']); ?>" 
                   alt="<?php echo htmlspecialchars($item['name']); ?>" 
                   class="w-12 h-12 object-cover rounded">
              <div class="flex-1">
                <h4 class="font-medium text-sm"><?php echo htmlspecialchars($item['name']); ?></h4>
                <p class="text-gray-600 text-sm">Quantité: <?php echo $item['quantity']; ?></p>
                <p class="font-medium text-green-600"><?php echo number_format($item['quantity'] * $item['price'], 2); ?> €</p>
              </div>
              <form method="post" action="remove_from_cart.php" style="display:inline;">
                <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>">
                <button type="submit" class="text-red-500 hover:text-red-700 p-1" title="Supprimer du panier">
                  <i class="fa fa-trash"></i>
                </button>
              </form>
            </div>
          <?php endforeach; ?>
        </div>
        
        <div class="border-t pt-4">
          <div class="flex justify-between items-center mb-4">
            <span class="text-lg font-bold">Total:</span>
            <span class="text-xl font-bold text-green-600"><?php echo number_format($total, 2); ?> €</span>
          </div>
          
          <div class="flex gap-2">
            <a href="checkout.php" 
               class="flex-1 bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-4 rounded-lg transition duration-200 text-center">
              <i class="fa-solid fa-credit-card mr-2"></i>Commander
            </a>
            <button id="closeCartModalBtn2" 
                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
              Continuer
            </button>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const openBtn = document.getElementById('openCartModalBtn');
  const closeBtn = document.getElementById('closeCartModalBtn');
  const closeBtn2 = document.getElementById('closeCartModalBtn2');
  const modal = document.getElementById('CartModal');
  const modalBox = document.getElementById('cartModalBox');
  
  if (openBtn) openBtn.addEventListener('click', function() {
    modal.style.display = 'flex';
    setTimeout(() => {
      modalBox.classList.remove('opacity-0', 'scale-95');
      modalBox.classList.add('opacity-100', 'scale-100');
    }, 10);
  });
  
  function closeModal() {
    modalBox.classList.remove('opacity-100', 'scale-100');
    modalBox.classList.add('opacity-0', 'scale-95');
    setTimeout(() => {
      modal.style.display = 'none';
    }, 300);
  }
  
  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (closeBtn2) closeBtn2.addEventListener('click', closeModal);
  
  modal.addEventListener('click', function(e) {
    if (e.target === modal) closeModal();
  });
  
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
  });
});
</script> 