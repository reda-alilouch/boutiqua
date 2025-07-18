<!-- Scripts principaux -->
<script src="/boutiqua/src/js/main.js" defer></script>
<script src="/boutiqua/src/js/menu.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

<script>
const openModalBtn = document.getElementById('openSearchModalBtn');
const searchModal = document.getElementById('searchModal');
const closeModalBtn = document.getElementById('closeSearchModalBtn');
const searchInput = document.getElementById('searchbar');
const resultsBox = document.getElementById('search-results');

if (openModalBtn && searchModal) {
  openModalBtn.addEventListener('click', function() {
    searchModal.style.display = 'flex';
    setTimeout(() => searchInput.focus(), 100);
  });
}
if (closeModalBtn && searchModal) {
  closeModalBtn.addEventListener('click', function() {
    searchModal.style.display = 'none';
    resultsBox.innerHTML = '';
    searchInput.value = '';
  });
}
// Fermer le modal si on clique en dehors du contenu
searchModal.addEventListener('click', function(e) {
  if (e.target === searchModal) {
    searchModal.style.display = 'none';
    resultsBox.innerHTML = '';
    searchInput.value = '';
  }
});

// Recherche AJAX (reprend le code précédent)
if (searchInput && resultsBox) {
  searchInput.addEventListener('input', function() {
    const q = this.value.trim();
    if (q.length < 2) {
      resultsBox.style.display = 'none';
      resultsBox.innerHTML = '';
      return;
    }
    fetch('/boutiqua/actions/search-ajax.php?q=' + encodeURIComponent(q))
      .then(res => res.text())
      .then(html => {
        resultsBox.innerHTML = html;
        resultsBox.style.display = 'block';
      });
  });
}
</script>
