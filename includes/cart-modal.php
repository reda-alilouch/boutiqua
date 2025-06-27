
<div id="CartModal" style="display:none; position:fixed; inset:0; z-index:1000; align-items:center; justify-content:center; background:rgba(0,0,0,0.3); backdrop-filter: blur(2px);">
  <div id="cartModalBox" class="bg-white p-8 rounded-lg min-w-[250px] min-h-[100px] relative shadow-2xl transition-all duration-300 ease-in-out opacity-0 scale-95">
    <button id="closeCartModalBtn" class="absolute top-4 right-4 text-2xl text-gray-400 hover:text-red-500 transition-colors">&times;</button>
    <h2 class="text-xl font-bold mb-4 flex items-center gap-2 text-green-700">
      <i class="fa-solid fa-cart-shopping"></i> Mon Panier
    </h2>
    <div>
      <p><i class="fa-solid fa-basket-shopping"></i> Votre panier est vide.</p>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const openBtn = document.getElementById('openCartModalBtn');
  const closeBtn = document.getElementById('closeCartModalBtn');
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
  modal.addEventListener('click', function(e) {
    if (e.target === modal) closeModal();
  });
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
  });
});
</script> 