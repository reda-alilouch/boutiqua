<?php
require_once __DIR__ . '/../../config/database.php';
?>

<div id="SearchModal" style="display:none; position:fixed; inset:0; z-index:1000; align-items:center; justify-content:center; background:rgba(0,0,0,0.3); backdrop-filter: blur(2px);">
  <div id="searchModalBox" class="bg-white p-8 rounded-lg w-full max-w-2xl max-h-[80vh] relative shadow-2xl transition-all duration-300 ease-in-out opacity-0 scale-95 overflow-hidden">
    <button id="closeSearchModalBtn" class="absolute top-4 right-4 text-2xl text-gray-400 hover:text-red-500 transition-colors z-10">&times;</button>
    
    <h2 class="text-xl font-bold mb-6 flex items-center gap-2 text-gray-700">
      <i class="fa-solid fa-magnifying-glass"></i> Rechercher des produits
    </h2>
    
    <!-- Barre de recherche -->
    <div class="relative mb-6">
      <input 
        type="text" 
        id="searchInput" 
        placeholder="Tapez le nom d'un produit..." 
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-lg"
        autocomplete="off"
      >
      <div id="searchSpinner" class="absolute right-3 top-1/2 transform -translate-y-1/2 hidden">
        <i class="fa fa-spinner fa-spin text-gray-400"></i>
      </div>
    </div>
    
    <!-- Résultats de recherche -->
    <div id="searchResults" class="max-h-96 overflow-y-auto">
      <!-- Les résultats s'afficheront ici -->
    </div>
    
    <!-- Lien vers la page de résultats complète -->
    <div id="searchViewAll" class="hidden mt-4 pt-4 border-t border-gray-200">
      <a href="#" id="viewAllLink" class="block text-center py-3 px-4 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-colors">
        <i class="fa fa-external-link-alt mr-2"></i>
        Voir tous les résultats
      </a>
    </div>
    
    <!-- État vide -->
    <div id="searchEmpty" class="text-center py-8 text-gray-500 hidden">
      <i class="fa fa-search text-4xl mb-4"></i>
      <p>Tapez quelque chose pour commencer votre recherche</p>
    </div>
    
    <!-- État de chargement -->
    <div id="searchLoading" class="text-center py-8 text-gray-500 hidden">
      <i class="fa fa-spinner fa-spin text-4xl mb-4"></i>
      <p>Recherche en cours...</p>
    </div>
    
    <!-- État aucun résultat -->
    <div id="searchNoResults" class="text-center py-8 text-gray-500 hidden">
      <i class="fa fa-exclamation-circle text-4xl mb-4"></i>
      <p>Aucun produit trouvé</p>
      <p class="text-sm">Essayez avec d'autres mots-clés</p>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const openBtn = document.getElementById('openSearchModalBtn');
  const closeBtn = document.getElementById('closeSearchModalBtn');
  const modal = document.getElementById('SearchModal');
  const modalBox = document.getElementById('searchModalBox');
  const searchInput = document.getElementById('searchInput');
  const searchResults = document.getElementById('searchResults');
  const searchEmpty = document.getElementById('searchEmpty');
  const searchLoading = document.getElementById('searchLoading');
  const searchNoResults = document.getElementById('searchNoResults');
  const searchSpinner = document.getElementById('searchSpinner');
  const searchViewAll = document.getElementById('searchViewAll');
  const viewAllLink = document.getElementById('viewAllLink');
  
  let searchTimeout;
  let currentQuery = '';
  
  // Ouvrir le modal
  if (openBtn) {
    openBtn.addEventListener('click', function() {
      modal.style.display = 'flex';
      setTimeout(() => {
        modalBox.classList.remove('opacity-0', 'scale-95');
        modalBox.classList.add('opacity-100', 'scale-100');
        searchInput.focus();
      }, 10);
    });
  }
  
  // Fermer le modal
  function closeModal() {
    modalBox.classList.remove('opacity-100', 'scale-100');
    modalBox.classList.add('opacity-0', 'scale-95');
    setTimeout(() => {
      modal.style.display = 'none';
      // Réinitialiser la recherche
      searchInput.value = '';
      currentQuery = '';
      showEmptyState();
    }, 300);
  }
  
  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  
  // Fermer en cliquant à l'extérieur
  modal.addEventListener('click', function(e) {
    if (e.target === modal) closeModal();
  });
  
  // Fermer avec Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
  });
  
  // Recherche avec Entrée
  searchInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && currentQuery.trim()) {
      window.location.href = `/astrodia/pages/search-results.php?q=${encodeURIComponent(currentQuery)}`;
    }
  });
  
  // Fonctions d'affichage des états
  function showEmptyState() {
    searchEmpty.classList.remove('hidden');
    searchLoading.classList.add('hidden');
    searchNoResults.classList.add('hidden');
    searchResults.classList.add('hidden');
    searchViewAll.classList.add('hidden');
    searchSpinner.classList.add('hidden');
  }
  
  function showLoadingState() {
    searchEmpty.classList.add('hidden');
    searchLoading.classList.remove('hidden');
    searchNoResults.classList.add('hidden');
    searchResults.classList.add('hidden');
    searchViewAll.classList.add('hidden');
    searchSpinner.classList.remove('hidden');
  }
  
  function showNoResultsState() {
    searchEmpty.classList.add('hidden');
    searchLoading.classList.add('hidden');
    searchNoResults.classList.remove('hidden');
    searchResults.classList.add('hidden');
    searchViewAll.classList.add('hidden');
    searchSpinner.classList.add('hidden');
  }
  
  function showResults(results) {
    searchEmpty.classList.add('hidden');
    searchLoading.classList.add('hidden');
    searchNoResults.classList.add('hidden');
    searchResults.classList.remove('hidden');
    searchViewAll.classList.remove('hidden');
    searchSpinner.classList.add('hidden');
    
    // Mettre à jour le lien "Voir tous"
    viewAllLink.href = `/astrodia/pages/search-results.php?q=${encodeURIComponent(currentQuery)}`;
    
    // Afficher les résultats
    searchResults.innerHTML = results.map(product => `
      <div class="flex items-center space-x-4 p-4 hover:bg-gray-50 rounded-lg transition-colors cursor-pointer" onclick="window.location.href='${product.url}'">
        <img src="../../src/images/${product.image}" alt="${product.name}" class="w-16 h-16 object-cover rounded-lg">
        <div class="flex-1">
          <h3 class="font-semibold text-gray-900">${product.name}</h3>
          <p class="text-sm text-gray-600">${product.description}</p>
        </div>
        <div class="text-right">
          <p class="font-bold text-primary">${product.price} €</p>
        </div>
      </div>
    `).join('');
  }
  
  // Recherche en temps réel
  searchInput.addEventListener('input', function() {
    const query = this.value.trim();
    currentQuery = query;
    
    // Annuler la recherche précédente
    clearTimeout(searchTimeout);
    
    if (query.length === 0) {
      showEmptyState();
      return;
    }
    
    if (query.length < 2) {
      return;
    }
    
    // Délai pour éviter trop de requêtes
    searchTimeout = setTimeout(() => {
      performSearch(query);
    }, 300);
  });
  
  // Fonction de recherche
  async function performSearch(query) {
    showLoadingState();
    
    try {
      const response = await fetch(`../../actions/search.php?q=${encodeURIComponent(query)}`);
      const data = await response.json();
      
      if (data.success) {
        if (data.count > 0) {
          showResults(data.results);
        } else {
          showNoResultsState();
        }
      } else {
        showNoResultsState();
      }
    } catch (error) {
      console.error('Erreur de recherche:', error);
      showNoResultsState();
    }
  }
  
  // Initialiser l'état vide
  showEmptyState();
});
</script>
