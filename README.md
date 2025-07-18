# e-commerce

# boutiqua

## Installation rapide de la base de données

1. Créez la base de données :
```sql
CREATE DATABASE boutiqua;
USE boutiqua;
```
2. Créez la table produits :
```sql
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  image VARCHAR(255) NOT NULL,
  category VARCHAR(100)
);
```
3. Ajoutez quelques produits de test :
```sql
INSERT INTO products (title, description, price, image, category) VALUES
('T-shirt Femme', 'T-shirt en coton bio, coupe moderne.', 29.99, 'women-01.jpg', 'women'),
('Jean Homme', 'Jean slim fit, denim stretch.', 49.99, 'men-01.jpg', 'men'),
('Robe d''été', 'Robe légère, imprimé floral.', 39.99, 'women-02.jpg', 'women'),
('Veste Enfant', 'Veste chaude pour enfant, imperméable.', 34.99, 'kid-01.jpg', 'kids');
```

4. Vérifiez que le fichier `config/database.php` pointe bien sur la base `boutiqua`.