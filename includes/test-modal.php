<!-- Bouton d'ouverture de la modale de test -->
<button id="openTestModalBtn">Ouvrir la modale de test</button>
<div id="TestModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
  <div style="background:#fff; padding:2rem; border-radius:1rem; min-width:200px; min-height:100px; position:relative;">
    <button id="closeTestModalBtn" style="position:absolute; top:1rem; right:1rem;">&times;</button>
    <h2>Modale de test</h2>
    <p>Si tu vois ceci, la modale fonctionne !</p>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const openBtn = document.getElementById('openTestModalBtn');
  const closeBtn = document.getElementById('closeTestModalBtn');
  const modal = document.getElementById('TestModal');

  if (openBtn) {
    openBtn.addEventListener('click', function() {
      console.log('Bouton ouverture cliqué');
      modal.style.display = 'flex';
      console.log('Modale devrait être visible');
    });
  } else {
    console.log('openTestModalBtn introuvable');
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      console.log('Bouton fermeture cliqué');
      modal.style.display = 'none';
      console.log('Modale cachée');
    });
  } else {
    console.log('closeTestModalBtn introuvable');
  }
});
</script> 