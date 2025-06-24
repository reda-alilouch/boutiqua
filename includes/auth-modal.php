<!-- Auth Modal -->
<div id="authModal" data-modal class="hidden overflow-y-auto fixed inset-0 z-50 justify-center items-start py-8 w-full h-full bg-black/50 modal">
    <div class="overflow-hidden m-auto my-8 max-w-md bg-white rounded-lg shadow-xl modal-content">
        <!-- Bouton de fermeture -->
        <button data-modal-hide="authModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- onglets -->
        <div class="flex border-b">
            <button data-modal-tab="login" class="flex-1 py-3 font-medium border-b-2 border-black transition-colors">
                Connexion
            </button>
            <button data-modal-tab="register" class="flex-1 py-3 font-medium text-gray-600 transition-colors">
                Inscription
            </button>
        </div>

        <!-- Conteneur d'erreur -->
        <div class="error-container hidden p-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-md mx-6 mt-4"></div>

        <!-- Formulaire de connexion -->
        <div data-tab-content="login" class="p-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Se connecter</h3>
            <form id="loginForm" action="/hexashop-1.0.0/login.php" method="POST" class="space-y-4">
                <div>
                    <label for="loginEmail" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input id="loginEmail" name="email" type="email" required
                           class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:border-transparent">
                </div>
                <div>
                    <label for="loginPassword" class="block mb-1 text-sm font-medium text-gray-700">Mot de passe</label>
                    <input id="loginPassword" name="password" type="password" required
                           class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:border-transparent">
                </div>
                <div class="flex justify-between items-center">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300">
                        <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                    <a href="#" class="text-sm">Mot de passe oublié?</a>
                </div>
                <div class="flex justify-center">
                <button type="submit" 
                        class="px-2 py-1 text-black rounded-md border border-gray-300 transition-colors hover:bg-gray-100 hover:text-black">
                    Se connecter
                </button>
                </div>
            </form>
        </div>

        <!-- Formulaire d'inscription -->
        <div data-tab-content="register" class="hidden p-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Créer un compte</h3>
            <form id="registerForm" action="/hexashop-1.0.0/register.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="registerPrenom" class="block mb-1 text-sm font-medium text-gray-700">Prénom</label>
                        <input id="registerPrenom" name="prenom" type="text" required
                               class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                    </div>
                    <div>
                        <label for="registerNom" class="block mb-1 text-sm font-medium text-gray-700">Nom</label>
                        <input id="registerNom" name="nom" type="text" required
                               class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label for="registerEmail" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input id="registerEmail" name="email" type="email" required
                           class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
                <div>
                    <label for="registerPassword" class="block mb-1 text-sm font-medium text-gray-700">Mot de passe</label>
                    <input id="registerPassword" name="password" type="password" required
                           class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
                <div>
                    <label for="registerPasswordConfirm" class="block mb-1 text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input id="registerPasswordConfirm" name="password_confirm" type="password" required
                           class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
                <div>
                    <label for="registerAvatar" class="block mb-1 text-sm font-medium text-gray-700">Photo de profil (optionnel)</label>
                    <input id="registerAvatar" name="avatar" type="file"
                           class="px-1 py-1 w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
                <div>
                    <label class="flex items-start">
                        <input type="checkbox" required class="mt-1 text-black rounded border-gray-300 focus:ring-black">
                        <span class="ml-2 text-sm text-gray-600">J'accepte les <a href="#" class="text-black hover:text-black">conditions d'utilisation</a></span>
                    </label>
                </div>
                <div class="flex justify-center">
                <button type="submit" 
                        class="px-2 py-1 text-black rounded-md border border-gray-300 transition-colors hover:bg-gray-100 hover:text-black">
                    Créer mon compte
                </button>
                </div>
            </form>
        </div>
    </div>
</div>