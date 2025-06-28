<?php
/**
 * Modèle User pour gérer les opérations liées aux utilisateurs
 *
 * @package Astrodia
 * @version 1.0.0
 */

namespace Astrodia\Models;

require_once __DIR__ . '/../../config/database.php';

class User {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $avatar;
    private $created_at;
    private $updated_at;

    /**
     * Récupère un utilisateur par son ID
     *
     * @param int $id ID de l'utilisateur
     * @return User|null L'utilisateur trouvé ou null
     */
    public static function findById($id) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare('SELECT * FROM user2 WHERE id = :id');
            $stmt->execute(['id' => $id]);
            $userData = $stmt->fetch();

            if ($userData) {
                $user = new self();
                $user->hydrate($userData);
                return $user;
            }

            return null;
        } catch (\Exception $e) {
            error_log('Erreur lors de la récupération de l\'utilisateur : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Récupère un utilisateur par son email
     *
     * @param string $email Email de l'utilisateur
     * @return User|null L'utilisateur trouvé ou null
     */
    public static function findByEmail($email) {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare('SELECT * FROM user2 WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $userData = $stmt->fetch();

            if ($userData) {
                $user = new self();
                $user->hydrate($userData);
                return $user;
            }

            return null;
        } catch (\Exception $e) {
            error_log('Erreur lors de la récupération de l\'utilisateur : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Authentifie un utilisateur
     *
     * @param string $email Email de l'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * @return User|null L'utilisateur authentifié ou null
     */
    public static function authenticate($email, $password) {
        $user = self::findByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }

    /**
     * Crée un nouvel utilisateur
     *
     * @param array $data Données de l'utilisateur
     * @return User|null L'utilisateur créé ou null
     */
    public static function create($data) {
        try {
            $pdo = getDBConnection();

            // Vérifier si l'email existe déjà
            $stmt = $pdo->prepare('SELECT id FROM user2 WHERE email = :email');
            $stmt->execute(['email' => $data['email']]);

            if ($stmt->fetch()) {
                throw new \Exception('Cet email est déjà utilisé');
            }

            // Hacher le mot de passe
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

            // Insérer le nouvel utilisateur
            $sql = 'INSERT INTO user2 (nom, prenom, email, password, avatar) VALUES (:nom, :prenom, :email, :password, :avatar)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => $data['email'],
                'password' => $hashedPassword,
                'avatar' => $data['avatar'] ?? null
            ]);

            // Récupérer l'utilisateur créé
            return self::findById($pdo->lastInsertId());
        } catch (\Exception $e) {
            error_log('Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Met à jour un utilisateur
     *
     * @param array $data Données à mettre à jour
     * @return bool Succès de la mise à jour
     */
    public function update($data) {
        try {
            $pdo = getDBConnection();
            $fields = [];
            $params = [];

            // Construire la requête dynamiquement
            foreach ($data as $key => $value) {
                if (property_exists($this, $key) && $key !== 'id') {
                    $fields[] = "{$key} = :{$key}";
                    $params[$key] = $value;
                }
            }

            if (empty($fields)) {
                return false;
            }

            $params['id'] = $this->id;
            $sql = 'UPDATE user2 SET ' . implode(', ', $fields) . ' WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute($params);

            if ($result) {
                // Mettre à jour l'objet courant
                foreach ($data as $key => $value) {
                    if (property_exists($this, $key)) {
                        $this->$key = $value;
                    }
                }
            }

            return $result;
        } catch (\Exception $e) {
            error_log('Erreur lors de la mise à jour de l\'utilisateur : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Hydrate l'objet avec les données de la base
     *
     * @param array $data Données de l'utilisateur
     */
    private function hydrate($data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Convertit l'objet en tableau pour la session
     *
     * @return array Données de session
     */
    public function toSessionArray() {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'last_login' => time()
        ];
    }

    // Getters et Setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; }

    public function getPrenom() { return $this->prenom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getAvatar() { return $this->avatar; }
    public function setAvatar($avatar) { $this->avatar = $avatar; }

    public function getCreatedAt() { return $this->created_at; }
    public function setCreated_at($created_at) { $this->created_at = $created_at; }

    public function getUpdatedAt() { return $this->updated_at; }
    public function setUpdated_at($updated_at) { $this->updated_at = $updated_at; }
}