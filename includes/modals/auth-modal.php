<?php
require_once __DIR__ . '/../../config/database.php';
?>

<div id="AuthModal" style="display:none; position:fixed; inset:0; z-index:1000; align-items:center; justify-content:center; background:rgba(0,0,0,0.3); backdrop-filter: blur(2px);">
  <div id="authModalBox" class="bg-white p-8 rounded-lg min-w-[300px] min-h-[100px] relative shadow-2xl transition-all duration-300 ease-in-out opacity-0 scale-95">
    <button id="closeAuthModalBtn" class="absolute top-4 right-4 text-2xl text-gray-400 hover:text-red-500 transition-colors">&times;</button>
    <!-- Onglets -->
    <div class="flex mb-6 border-b">
      <button id="tabLogin" class="flex-1 py-2 font-semibold border-b-2 border-blue-600 text-blue-700 transition" type="button">
        <i class="fa-solid fa-right-to-bracket"></i> Connexion
      </button>
      <button id="tabRegister" class="flex-1 py-2 font-semibold border-b-2 border-transparent text-gray-500 hover:text-blue-700 transition" type="button">
        <i class="fa-solid fa-user-plus"></i> Inscription
      </button>
    </div>
    <!-- Formulaire Connexion -->
    <form id="loginForm" class="space-y-4" action="/boutiqua/pages/login.php" method="POST">
      <div>
        <label for="loginEmail" class="block mb-1 text-sm font-medium text-gray-700">
          <i class="fa-solid fa-envelope"></i> Email
        </label>
        <input id="loginEmail" name="email" type="email" required class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      </div>
      <div>
        <label for="loginPassword" class="block mb-1 text-sm font-medium text-gray-700">
          <i class="fa-solid fa-lock"></i> Mot de passe
        </label>
        <input id="loginPassword" name="password" type="password" required class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      </div>
      <button type="submit" name="connexion" class="px-2 py-1 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors flex items-center gap-2 w-full justify-center">
        <i class="fa-solid fa-right-to-bracket"></i>
        Se connecter
      </button>
    </form>
    <!-- Formulaire Inscription -->
    <form id="registerForm" class="space-y-4 hidden" action="/boutiqua/pages/register.php" method="POST">
      <div class="grid grid-cols-2 gap-2">
        <div>
          <label for="registerPrenom" class="block mb-1 text-sm font-medium text-gray-700">
            <i class="fa-solid fa-user"></i> Prénom
          </label>
          <input id="registerPrenom" name="prenom" type="text" required class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <div>
          <label for="registerNom" class="block mb-1 text-sm font-medium text-gray-700">
            <i class="fa-solid fa-user"></i> Nom
          </label>
          <input id="registerNom" name="nom" type="text" required class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
      </div>
      <div>
        <label for="registerEmail" class="block mb-1 text-sm font-medium text-gray-700">
          <i class="fa-solid fa-envelope"></i> Email
        </label>
        <input id="registerEmail" name="email" type="email" required class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      </div>
      <div>
        <label for="registerPassword" class="block mb-1 text-sm font-medium text-gray-700">
          <i class="fa-solid fa-lock"></i> Mot de passe
        </label>
        <input id="registerPassword" name="password" type="password" required class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      </div>
      <div>
        <label for="registerConfirmPassword" class="block mb-1 text-sm font-medium text-gray-700">
          <i class="fa-solid fa-lock"></i> Confirmer le mot de passe
        </label>
        <input id="registerConfirmPassword" name="confirm_password" type="password" required class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      </div>
      <button type="submit" class="px-2 py-1 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors flex items-center gap-2 w-full justify-center">
        <i class="fa-solid fa-user-plus"></i>
        S'inscrire
      </button>
    </form>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const openBtn = document.getElementById('openAuthModalBtn');
  const closeBtn = document.getElementById('closeAuthModalBtn');
  const modal = document.getElementById('AuthModal');
  const modalBox = document.getElementById('authModalBox');
  const tabLogin = document.getElementById('tabLogin');
  const tabRegister = document.getElementById('tabRegister');
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');

  // Animation ouverture/fermeture
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

  // Gestion des onglets
  tabLogin.addEventListener('click', function() {
    tabLogin.classList.add('border-blue-600', 'text-blue-700');
    tabLogin.classList.remove('border-transparent', 'text-gray-500');
    tabRegister.classList.remove('border-blue-600', 'text-blue-700');
    tabRegister.classList.add('border-transparent', 'text-gray-500');
    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');
  });
  tabRegister.addEventListener('click', function() {
    tabRegister.classList.add('border-blue-600', 'text-blue-700');
    tabRegister.classList.remove('border-transparent', 'text-gray-500');
    tabLogin.classList.remove('border-blue-600', 'text-blue-700');
    tabLogin.classList.add('border-transparent', 'text-gray-500');
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');
  });
});
</script> 