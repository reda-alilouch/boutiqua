<!-- Auth Modal -->
<div x-show="$store.modal.auth" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
     @click.self="$store.modal.closeAll()">
     
    <div class="w-full max-w-md"
         x-show="$store.modal.auth"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4">
        
        <!-- Modal Content -->
        <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Close Button -->
            <button @click="$store.modal.closeAll()" 
                    class="absolute top-4 right-4 p-1 text-gray-400 hover:text-gray-500 transition-colors"
                    aria-label="Fermer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Tabs -->
            <div class="flex border-b border-gray-200">
                <button @click="$store.modal.setAuthTab('login')"
                        :class="{
                            'text-primary border-b-2 border-primary': $store.modal.authTab === 'login',
                            'text-gray-500 hover:text-gray-700': $store.modal.authTab !== 'login'
                        }"
                        class="flex-1 py-4 px-6 text-center font-medium focus:outline-none transition-colors">
                    Connexion
                </button>
                <button @click="$store.modal.setAuthTab('register')"
                        :class="{
                            'text-primary border-b-2 border-primary': $store.modal.authTab === 'register',
                            'text-gray-500 hover:text-gray-700': $store.modal.authTab !== 'register'
                        }"
                        class="flex-1 py-4 px-6 text-center font-medium focus:outline-none transition-colors">
                    Inscription
                </button>
            </div>

            <!-- Login Form -->
            <div x-show="$store.modal.authTab === 'login'" class="p-6">
                <h2 class="mb-6 text-2xl font-bold text-gray-900">Connexion</h2>
                <form @submit.prevent="$store.modal.login()" class="space-y-4">
                    <div>
                        <label for="login-email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="login-email" x-model="$store.modal.loginForm.email"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               required>
                    </div>
                    <div>
                        <label for="login-password" class="block mb-2 text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" id="login-password" x-model="$store.modal.loginForm.password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               required>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" type="checkbox"
                                   class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                            <label for="remember-me" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                        </div>
                        <a href="#" class="text-sm text-primary hover:underline">Mot de passe oublié ?</a>
                    </div>
                    <button type="submit"
                            class="w-full py-3 px-4 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Se connecter
                    </button>
                </form>
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Ou continuez avec</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mt-6">
                        <button type="button"
                                class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.666,14.861,2,12,2C6.477,2,2,6.477,2,12s4.477,10,10,10c8.396,0,10-7.71,10-10c0-0.61-0.043-1.229-0.129-1.839C21.563,10.922,21,11.518,21,12.228v0.01H12.545z" />
                            </svg>
                            Google
                        </button>
                        <button type="button"
                                class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                            Facebook
                        </button>
                    </div>
                </div>
            </div>

            <!-- Register Form -->
            <div x-show="$store.modal.authTab === 'register'" class="p-6">
                <h2 class="mb-6 text-2xl font-bold text-gray-900">Créer un compte</h2>
                <form @submit.prevent="$store.modal.register()" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="register-firstname" class="block mb-2 text-sm font-medium text-gray-700">Prénom</label>
                            <input type="text" id="register-firstname" x-model="$store.modal.registerForm.firstname"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   required>
                        </div>
                        <div>
                            <label for="register-lastname" class="block mb-2 text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="register-lastname" x-model="$store.modal.registerForm.lastname"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   required>
                        </div>
                    </div>
                    <div>
                        <label for="register-email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="register-email" x-model="$store.modal.registerForm.email"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               required>
                    </div>
                    <div>
                        <label for="register-password" class="block mb-2 text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" id="register-password" x-model="$store.modal.registerForm.password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               required>
                    </div>
                    <div>
                        <label for="register-password-confirm" class="block mb-2 text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" id="register-password-confirm" x-model="$store.modal.registerForm.password_confirmation"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               required>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" type="checkbox" x-model="$store.modal.registerForm.terms"
                                   class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary"
                                   required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700">J'accepte les <a href="#" class="text-primary hover:underline">conditions d'utilisation</a></label>
                        </div>
                    </div>
                    <button type="submit"
                            class="w-full py-3 px-4 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        S'inscrire
                    </button>
                </form>
                <p class="mt-4 text-sm text-center text-gray-600">
                    Vous avez déjà un compte ?
                    <button @click="$store.modal.setAuthTab('login')" class="font-medium text-primary hover:underline">
                        Connectez-vous
                    </button>
                </p>
            </div>
        </div>
    </div>
</div>
