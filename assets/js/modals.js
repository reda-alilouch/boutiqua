/**
 * Fonctions utilitaires pour la validation des mots de passe
 */
const passwordStrengthMeter = (password) => {
  if (!password) return null;
  
  // Vérification de la longueur minimale
  if (password.length < 8) return 'weak';
  
  // Vérification de la complexité
  const hasUpperCase = /[A-Z]/.test(password);
  const hasLowerCase = /[a-z]/.test(password);
  const hasNumbers = /\d/.test(password);
  const hasSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);
  
  const strength = [hasUpperCase, hasLowerCase, hasNumbers, hasSpecialChars]
    .filter(Boolean).length;
  
  if (strength <= 2) return 'weak';
  if (strength === 3) return 'medium';
  return 'strong';
};

// Initialisation d'Alpine.js
document.addEventListener('alpine:init', () => {
  // Store global pour la gestion des modaux
  Alpine.store('modal', {
    // États des modaux
    search: false,
    auth: false,
    authTab: 'login',
    
    // États de chargement et messages
    isLoading: false,
    showSuccess: false,
    successMessage: '',
    showError: false,
    errorMessage: '',
    
    // Champs du formulaire
    form: {
      email: '',
      password: '',
      firstName: '',
      lastName: '',
      confirmPassword: '',
      terms: false
    },
    
    // États UI
    showPassword: false,
    showConfirmPassword: false,
    passwordStrength: null,
    passwordMismatch: false,
    
    // Données simulées pour les suggestions de recherche
    searchSuggestions: {
      popular: [
        { id: 1, title: 'Nouveautés', link: '#' },
        { id: 2, title: 'Promotions', link: '#' },
        { id: 3, title: 'Collections', link: '#' },
      ],
      categories: [
        { id: 1, title: 'Hommes', count: 42, link: '#' },
        { id: 2, title: 'Femmes', count: 36, link: '#' },
        { id: 3, title: 'Enfants', count: 28, link: '#' },
      ]
    },
    
    /**
     * Bascule l'affichage du modal de recherche
     */
    toggleSearch() {
      this.clearMessages();
      this.search = !this.search;
      this.toggleBodyOverflow(this.search);
      
      // Si on ouvre la recherche, on ferme l'authentification
      if (this.search) {
        this.auth = false;
      }
      
      // Focus sur le champ de recherche quand il s'ouvre
      if (this.search) {
        this.$nextTick(() => {
          const searchInput = document.querySelector('#search-input');
          if (searchInput) searchInput.focus();
        });
      }
    },
    
    /**
     * Bascule l'affichage du modal d'authentification
     */
    toggleAuth() {
      this.clearMessages();
      this.auth = !this.auth;
      this.toggleBodyOverflow(this.auth);
      
      // Si on ouvre l'authentification, on ferme la recherche
      if (this.auth) {
        this.search = false;
      }
      
      // Reset du formulaire à l'ouverture
      if (this.auth) {
        this.resetForm();
      }
    },
    
    /**
     * Gère le défilement de la page
     * @param {boolean} show - Afficher ou masquer le défilement
     */
    toggleBodyOverflow(show) {
      document.body.style.overflow = show ? 'hidden' : '';
    },
    
    /**
     * Change l'onglet actif (login/register)
     * @param {string} tab - Nom de l'onglet à afficher
     */
    setAuthTab(tab) {
      this.authTab = tab;
      this.clearMessages();
      this.resetForm();
    },
    
    /**
     * Réinitialise le formulaire à son état initial
     */
    resetForm() {
      this.form = {
        email: '',
        password: '',
        firstName: '',
        lastName: '',
        confirmPassword: '',
        terms: false
      };
      this.showPassword = false;
      this.showConfirmPassword = false;
      this.passwordStrength = null;
      this.passwordMismatch = false;
      this.clearMessages();
      
      // Réinitialisation des champs de mot de passe
      const passwordInputs = document.querySelectorAll('input[type="password"]');
      passwordInputs.forEach(input => {
        input.type = 'password';
      });
    },
    
    /**
     * Efface tous les messages d'erreur et de succès
     */
    clearMessages() {
      this.showError = false;
      this.errorMessage = '';
      this.showSuccess = false;
      this.successMessage = '';
    },
    
    /**
     * Valide la force du mot de passe
     * @returns {boolean} - Si le mot de passe est valide
     */
    validatePassword() {
      if (!this.form.password) {
        this.passwordStrength = null;
        return false;
      }
      this.passwordStrength = passwordStrengthMeter(this.form.password);
      return this.passwordStrength === 'strong';
    },
    
    /**
     * Vérifie que les mots de passe correspondent
     * @returns {boolean} - Si les mots de passe correspondent
     */
    validatePasswordMatch() {
      if (!this.form.confirmPassword) {
        this.passwordMismatch = false;
        return true;
      }
      this.passwordMismatch = this.form.password !== this.form.confirmPassword;
      return !this.passwordMismatch;
    },
    
    /**
     * Bascule la visibilité du mot de passe
     * @param {string} fieldId - ID du champ à basculer
     */
    togglePasswordVisibility(fieldId) {
      if (fieldId === 'password') {
        this.showPassword = !this.showPassword;
        const input = document.getElementById('login-password');
        if (input) input.type = this.showPassword ? 'text' : 'password';
      } else if (fieldId === 'confirmPassword') {
        this.showConfirmPassword = !this.showConfirmPassword;
        const input = document.getElementById('register-password-confirm');
        if (input) input.type = this.showConfirmPassword ? 'text' : 'password';
      }
    },
    
    /**
     * Soumet le formulaire de connexion
     */
    async login() {
      this.clearMessages();
      this.isLoading = true;
      
      // Validation simple côté client
      if (!this.form.email || !this.form.password) {
        this.showErrorMessage('Veuillez remplir tous les champs obligatoires');
        this.isLoading = false;
        return;
      }
      
      try {
        // Simulation d'une requête API
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        // Connexion réussie
        this.showSuccessMessage('Connexion réussie ! Redirection en cours...');
        
        // Mise à jour de l'état d'authentification
        Alpine.store('auth').login(this.form.email, this.form.password);
        
        // Fermeture du modal après un délai
        setTimeout(() => {
          this.auth = false;
          this.toggleBodyOverflow(false);
          // Redirection si nécessaire
          // window.location.href = 'account.php';
        }, 1500);
        
      } catch (error) {
        this.showErrorMessage('Identifiants incorrects. Veuillez réessayer.');
        console.error('Login error:', error);
      } finally {
        this.isLoading = false;
      }
    },
    
    /**
     * Valide le formulaire d'inscription
     * @returns {boolean} - Si le formulaire est valide
     */
    validateRegisterForm() {
      this.clearMessages();
      
      // Vérification des champs requis
      const requiredFields = ['firstName', 'lastName', 'email', 'password', 'confirmPassword'];
      const missingFields = requiredFields.filter(field => !this.form[field]?.trim());
      
      if (missingFields.length > 0) {
        this.showErrorMessage('Veuillez remplir tous les champs obligatoires');
        return false;
      }
      
      // Validation de l'email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.form.email)) {
        this.showErrorMessage('Veuillez entrer une adresse email valide');
        return false;
      }
      
      // Validation de la force du mot de passe
      this.passwordStrength = passwordStrengthMeter(this.form.password);
      if (this.passwordStrength !== 'strong') {
        this.showErrorMessage('Le mot de passe doit contenir au moins 8 caractères, dont des majuscules, minuscules, chiffres et caractères spéciaux');
        return false;
      }
      
      // Vérification de la correspondance des mots de passe
      if (this.form.password !== this.form.confirmPassword) {
        this.passwordMismatch = true;
        this.showErrorMessage('Les mots de passe ne correspondent pas');
        return false;
      }
      
      // Vérification des conditions générales
      if (!this.form.terms) {
        this.showErrorMessage('Veuvez accepter les conditions générales d\'utilisation');
        return false;
      }
      
      return true;
    },
    
    /**
     * Soumet le formulaire d'inscription
     */
    async register() {
      // Validation du formulaire
      if (!this.validateRegisterForm()) {
        return;
      }
      
      this.isLoading = true;
      
      try {
        // Simulation d'une requête API avec délai
        await new Promise((resolve, reject) => {
          setTimeout(() => {
            // Simuler une erreur aléatoire pour les tests (à supprimer en production)
            const shouldFail = Math.random() < 0.2; // 20% de chance d'échec pour le test
            if (shouldFail) {
              reject(new Error('Cette adresse email est déjà utilisée'));
            } else {
              resolve({
                id: 'user_' + Math.random().toString(36).substr(2, 9),
                email: this.form.email,
                firstName: this.form.firstName,
                lastName: this.form.lastName,
                token: 'simulated_jwt_token_' + Math.random().toString(36).substr(2)
              });
            }
          }, 1500);
        }).then(userData => {
          // Inscription réussie
          this.showSuccessMessage('Inscription réussie ! Vous allez être redirigé...');
          
          // Simulation de connexion automatique après inscription
          Alpine.store('auth').login(userData);
          
          // Fermeture du modal après un délai
          setTimeout(() => {
            this.auth = false;
            this.resetForm();
            this.isLoading = false;
            
            // Redirection vers la page de profil ou la page d'accueil
            window.location.href = 'profile.php';
          }, 2000);
        });
        
      } catch (error) {
        console.error('Erreur lors de l\'inscription:', error);
        this.showErrorMessage(error.message || "Une erreur inattendue s'est produite. Veuillez réessayer.");
      } finally {
        this.isLoading = false;
      }
    },
    
    /**
     * Affiche un message d'erreur
     * @param {string} message - Message d'erreur à afficher
     */
    showErrorMessage(message) {
      this.showError = true;
      this.errorMessage = message;
      
      // Faire défiler jusqu'au message d'erreur
      this.$nextTick(() => {
        const errorElement = document.querySelector('[x-show="showError"]');
        if (errorElement) {
          errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      });
      
      // Masquer le message après 5 secondes
      setTimeout(() => {
        this.showError = false;
        this.errorMessage = '';
      }, 5000);
    },
    
    /**
     * Affiche un message de succès
     * @param {string} message - Message de succès à afficher
     */
    showSuccessMessage(message) {
      this.showSuccess = true;
      this.successMessage = message;
      
      // Faire défiler jusqu'au message de succès
      this.$nextTick(() => {
        const successElement = document.querySelector('[x-show="showSuccess"]');
        if (successElement) {
          successElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      });
      
      // Masquer le message après 5 secondes
      setTimeout(() => {
        this.showSuccess = false;
        this.successMessage = '';
      }, 5000);
    }
  });
});
