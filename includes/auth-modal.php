<!-- Auth Modal -->
<div id="authModal" class="fixed inset-0 z-50 hidden items-start justify-center bg-black/50 w-full h-full overflow-y-auto py-8 modal ">
    <div class="bg-white max-w-md rounded-lg shadow-xl my-8 overflow-hidden modal-content m-auto">
        <!-- Bouton de fermeture -->
        <button data-modal-hide="authModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- onglets -->
        <div class="flex border-b">
            <button data-modal-tab="login" class="flex-1 py-3 font-medium transition-colors border-b-2 ">
                Connexion
            </button>
            <button data-modal-tab="register" class="flex-1 py-3 font-medium text-gray-600 transition-colors">
                Inscription
            </button>
        </div>

        <!-- Formulaire de connexion -->
        <div data-tab-content="login" class="p-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Se connecter</h3>
            <form id="loginForm" action="/hexashop-1.0.0/login.php" method="POST" class="space-y-4">
                <div>
                    <label for="loginEmail" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input id="loginEmail" name="email" type="email" required
                           class="w-full px-1 py-1 border border-gray-300 rounded-md focus:ring-2 focus:border-transparent">
                </div>
                <div>
                    <label for="loginPassword" class="block mb-1 text-sm font-medium text-gray-700">Mot de passe</label>
                    <input id="loginPassword" name="password" type="password" required
                           class="w-full px-1 py-1 border border-gray-300 rounded-md focus:ring-2 focus:border-transparent">
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class=" border-gray-300 rounded ">
                        <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                    <a href="#" class="text-sm ">Mot de passe oublié?</a>
                </div>
                <div class="flex justify-center">
                <button type="submit" 
                        class="px-2 py-1 text-black transition-colors rounded-md border border-gray-300 hover:bg-gray-100 hover:text-black">
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
                               class="w-full px-1 py-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-transparent">
                    </div>
                    <div>
                        <label for="registerNom" class="block mb-1 text-sm font-medium text-gray-700">Nom</label>
                        <input id="registerNom" name="nom" type="text" required
                               class="w-full px-1 py-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label for="registerEmail" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input id="registerEmail" name="email" type="email" required
                           class="w-full px-1 py-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
                <div>
                    <label for="registerPassword" class="block mb-1 text-sm font-medium text-gray-700">Mot de passe</label>
                    <input id="registerPassword" name="password" type="password" required
                           class="w-full px-1 py-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
                <div>
                    <label for="registerPasswordConfirm" class="block mb-1 text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input id="registerPasswordConfirm" name="password_confirm" type="password" required
                           class="w-full px-1 py-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
                <div>
                    <label for="registerAvatar" class="block mb-1 text-sm font-medium text-gray-700">Photo de profil (optionnel)</label>
                    <input id="registerAvatar" name="avatar" type="file"
                           class="w-full px-1 py-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
                <div>
                    <label class="flex items-start">
                        <input type="checkbox" required class="mt-1 text-black border-gray-300 rounded focus:ring-black">
                        <span class="ml-2 text-sm text-gray-600">J'accepte les <a href="#" class="text-black hover:text-black">conditions d'utilisation</a></span>
                    </label>
                </div>
                <div class="flex justify-center">
                <button type="submit" 
                        class="px-2 py-1 text-black transition-colors rounded-md border border-gray-300 hover:bg-gray-100 hover:text-black">
                    Créer mon compte
                </button>
                </div>
            </form>
        </div>
    </div>
</div>