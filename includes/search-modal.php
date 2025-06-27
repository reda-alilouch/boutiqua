<!-- Bouton d'ouverture -->


<!-- Modale -->
<div id="SearchModal" style="display:none; position:fixed; inset:0; z-index:1000; align-items:center; justify-content:center; background:rgba(0,0,0,0.3); backdrop-filter: blur(2px);">
  <div id="searchModalBox" class="bg-white p-8 rounded-lg min-w-[250px] min-h-[100px] relative shadow-2xl transition-all duration-300 ease-in-out opacity-0 scale-95">
    <button id="closeSearchModalBtn" class="absolute top-4 right-4 text-2xl text-gray-400 hover:text-red-500 transition-colors">&times;</button>
    <h2 class="text-xl font-bold mb-4 flex items-center gap-2 text-gray-700">
      <i class="fa-solid fa-magnifying-glass"></i> Recherche
    </h2>
    <input type="text" placeholder="Rechercher..." class="w-full px-2 py-1 border rounded focus:ring-2 focus:ring-gray-500 focus:border-transparent">
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const openBtn = document.getElementById('openSearchModalBtn');
  const closeBtn = document.getElementById('closeSearchModalBtn');
  const modal = document.getElementById('SearchModal');
  const modalBox = document.getElementById('searchModalBox');
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
