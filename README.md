# 🛍️ Boutiqua

Boutiqua est une application web e-commerce moderne développée en PHP, Tailwind CSS et MariaDB/MySQL. Elle permet la gestion d'une boutique de vêtements et accessoires, avec des fonctionnalités complètes pour les utilisateurs et les administrateurs.

## 🚀 Fonctionnalités principales

- **Catalogue produits** : Affichage dynamique des produits (t-shirts, hoodies, etc.) avec filtres par catégorie, genre, nouveautés.
- **Panier** : Ajout, suppression, modification de la quantité, visualisation du total.
- **Wishlist** : Ajout et gestion d'une liste de souhaits.
- **Recherche AJAX** : Recherche instantanée de produits avec suggestions.
- **Commandes** : Passage de commande, historique, suivi du statut.
- **Gestion des adresses** : Ajout, modification, suppression d'adresses de livraison/facturation.
- **Authentification** : Inscription, connexion, déconnexion, gestion de profil, avatar.
- **Espace admin** : Gestion des utilisateurs, produits, commandes.
- **Responsive** : Interface adaptée à tous les écrans (mobile, tablette, desktop).
- **Sécurité** : Mots de passe hashés, vérification des accès, protection CSRF (à compléter selon besoin).

## 🗂️ Structure du projet

```
boutiqua/
│
├── actions/           # Scripts PHP pour les actions AJAX et formulaires
├── admin/             # Pages d'administration
├── config/            # Configuration (connexion BDD)
├── includes/          # Fragments réutilisables (header, footer, modals, scripts)
├── pages/             # Pages principales (produits, profil, panier, etc.)
├── src/
│   ├── Controllers/   # Contrôleurs PHP (MVC)
│   ├── Models/        # Modèles PHP (utilisateur, produit, etc.)
│   ├── css/           # Feuilles de style (Tailwind, custom)
│   ├── images/        # Images du site
│   └── js/            # Scripts JS (menu, modals, etc.)
├── boutiqua.sql       # Dump de la base de données
├── index.php          # Page d'accueil
└── README.md
```

## ⚙️ Installation

1. **Cloner le dépôt**
   ```bash
   git clone <url-du-repo>
   ```

2. **Configurer la base de données**
   - Importer le fichier `boutiqua.sql` dans votre serveur MySQL/MariaDB via phpMyAdmin ou la ligne de commande.
   - Adapter les identifiants de connexion dans `config/database.php` si besoin.

3. **Lancer le serveur**
   - Utiliser XAMPP, WAMP, Laragon ou tout serveur Apache/PHP compatible.
   - Accéder à `http://localhost/boutiqua` dans votre navigateur.

4. **Dépendances front-end**
   - Le projet utilise Tailwind CSS (précompilé) et FontAwesome via CDN.
   - Pour modifier le CSS, recompiler Tailwind si besoin.

## 👤 Comptes de test

- **Admin**
  - Email : `alilouchreda328@gmail.com`
  - Mot de passe : (voir dans la BDD, hashé)
- **Utilisateur**
  - Email : `sophie.martin@email.com`
  - Mot de passe : `password456`

## 📦 Fonctionnalités techniques

- **PHP** (procédural et MVC partiel)
- **MySQL/MariaDB** (structure relationnelle, clés étrangères)
- **Tailwind CSS** (design moderne, responsive)
- **JavaScript** (modals, carrousel, recherche AJAX)
- **Sécurité** : Préparations SQL, hashage des mots de passe

## 📸 Aperçu

- Carrousel d'accueil dynamique
- Fiches produits élégantes
- Modals pour connexion/inscription/panier/recherche
- Espace admin pour la gestion complète

## 📝 Personnalisation

- Ajoutez vos propres images dans `src/images/`
- Modifiez les styles dans `src/css/`
- Ajoutez des fonctionnalités dans `actions/` ou `pages/`

## 🛠️ À faire / Suggestions

- Paiement en ligne (Stripe, PayPal…)
- Système de notifications/email
- Amélioration de la sécurité (CSRF, validation avancée)
- Tests unitaires

## 📄 Licence

Projet open-source pour usage éducatif ou personnel.  
Contactez-moi pour toute question ou suggestion !

---

**Boutiqua – La mode à portée de clic !**
