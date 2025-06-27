# Carrousel Hero avec Swiper.js

## 🎯 Vue d'ensemble

Ce carrousel moderne utilise **Swiper.js** pour créer une expérience utilisateur fluide et responsive. Il présente les collections principales du site avec un design noir et blanc élégant.

## ✨ Fonctionnalités

- **Responsive** : S'adapte parfaitement à tous les écrans
- **Animations fluides** : Transitions en fondu avec effets d'entrée
- **Navigation intuitive** : Flèches et pagination
- **Autoplay intelligent** : Pause au survol, arrêt sur mobile
- **Design moderne** : Noir et blanc avec effets de survol
- **Accessibilité** : Navigation clavier et touch

## 🛠️ Structure HTML

```html
<section class="relative w-full bg-black">
  <div class="swiper hero-swiper">
    <div class="swiper-wrapper">
      <!-- Chaque slide -->
      <div class="swiper-slide relative">
        <div class="relative h-[400px] md:h-[500px] lg:h-[600px] overflow-hidden">
          <img src="src/images/image.jpg" alt="Description" 
               class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
          <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
          <div class="absolute inset-0 flex items-center">
            <!-- Contenu du slide -->
          </div>
        </div>
      </div>
    </div>
    
    <!-- Navigation -->
    <div class="swiper-button-next hero-swiper-button-next"></div>
    <div class="swiper-button-prev hero-swiper-button-prev"></div>
    
    <!-- Pagination -->
    <div class="swiper-pagination hero-swiper-pagination"></div>
  </div>
</section>
```

## 🎨 Personnalisation

### Ajouter un nouveau slide

1. **Copiez ce template** dans `index.php` :
```html
<div class="swiper-slide relative">
  <div class="relative h-[400px] md:h-[500px] lg:h-[600px] overflow-hidden">
    <img src="src/images/votre-image.jpg" 
         alt="Votre titre" 
         class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" />
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
    <div class="absolute inset-0 flex items-center">
      <div class="container mx-auto px-4">
        <div class="max-w-2xl text-white">
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
            Votre Titre
            <span class="block text-gray-300">Sous-titre</span>
          </h1>
          <p class="text-lg md:text-xl mb-8 text-gray-200 leading-relaxed">
            Votre description...
          </p>
          <div class="flex flex-col sm:flex-row gap-4">
            <a href="votre-lien.php" 
               class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
              Bouton Principal
            </a>
            <a href="autre-lien.php" 
               class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-300">
              Bouton Secondaire
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

2. **Remplacez** :
   - `votre-image.jpg` par le nom de votre image
   - `Votre titre` par le titre souhaité
   - `votre-lien.php` par l'URL de destination

### Modifier les options du carrousel

Dans `src/js/main.js`, vous pouvez ajuster :

```javascript
const heroSwiper = new Swiper('.hero-swiper', {
  // Vitesse de transition (en ms)
  speed: 1000,
  
  // Délai entre les slides (en ms)
  autoplay: {
    delay: 5000,
  },
  
  // Effet de transition
  effect: 'fade', // ou 'slide', 'cube', 'coverflow', etc.
  
  // Boucle infinie
  loop: true,
});
```

### Personnaliser les styles

Dans `src/css/style.css`, vous pouvez modifier :

```css
/* Couleur des boutons de navigation */
.hero-swiper-button-next,
.hero-swiper-button-prev {
  background-color: rgba(255, 255, 255, 0.9) !important;
  color: #000 !important;
}

/* Couleur de la pagination */
.hero-swiper-pagination .swiper-pagination-bullet {
  background-color: rgba(255, 255, 255, 0.5) !important;
}

/* Hauteur du carrousel */
.hero-swiper .swiper-slide {
  height: 400px; /* Mobile */
}

@media (min-width: 768px) {
  .hero-swiper .swiper-slide {
    height: 500px; /* Desktop */
  }
}
```

## 📱 Responsive

Le carrousel s'adapte automatiquement :

- **Mobile** : Hauteur 400px, boutons plus petits
- **Tablet** : Hauteur 500px
- **Desktop** : Hauteur 600px, toutes les fonctionnalités

## 🎯 Optimisations

### Performance
- **Lazy loading** : Les images se chargent à la demande
- **Autoplay mobile** : Désactivé pour économiser la batterie
- **Preload** : Charge les images suivantes en arrière-plan

### Accessibilité
- **Navigation clavier** : Flèches directionnelles
- **Touch gestures** : Swipe sur mobile
- **ARIA labels** : Support des lecteurs d'écran

## 🔧 Dépannage

### Le carrousel ne s'affiche pas
1. Vérifiez que Swiper.js est bien chargé dans `includes/head.php`
2. Assurez-vous que les images existent dans `src/images/`
3. Vérifiez la console pour les erreurs JavaScript

### Les images ne se chargent pas
1. Vérifiez les chemins d'images dans `index.php`
2. Assurez-vous que les fichiers existent
3. Vérifiez les permissions des fichiers

### Les animations ne fonctionnent pas
1. Vérifiez que le CSS est bien chargé
2. Assurez-vous que les classes Tailwind sont présentes
3. Vérifiez la console pour les erreurs

## 📚 Ressources

- [Documentation Swiper.js](https://swiperjs.com/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Guide des animations CSS](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Animations)

## 🎨 Exemples d'effets

### Effet de parallaxe
```css
.hero-swiper .swiper-slide img {
  transform: scale(1.1);
  transition: transform 0.3s ease;
}

.hero-swiper .swiper-slide-active img {
  transform: scale(1);
}
```

### Effet de zoom au survol
```css
.hero-swiper .swiper-slide:hover img {
  transform: scale(1.05);
}
```

### Effet de texte animé
```css
.hero-swiper .swiper-slide-active h1 {
  animation: slideInUp 0.8s ease-out;
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
``` 