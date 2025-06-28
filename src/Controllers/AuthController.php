<?php
/**
 * Contrôleur d'authentification
 *
 * @package Astrodia
 * @version 1.0.0
 */

namespace Astrodia\Controllers;

require_once __DIR__ . '/../Models/User.php';

use Astrodia\Models\User;

class AuthController {
    /**
     * Traite la demande de connexion
     *
     * @param array $data Données du formulaire
     * @return array Résultat de l'opération
     */
    public function login($data) {
        $email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $data['password'] ?? '';
        $result = ['success' => false, 'message' => '', 'user' => null];

        if (empty($email) || empty($password)) {
            $result['message'] = 'Veuillez remplir tous les champs';
            return $result;
        }

        try {
            $user = User::authenticate($email, $password);

            if ($user) {
                // Régénérer l'ID de session pour éviter la fixation de session
                session_regenerate_id(true);
                
                // Stocker les informations de l'utilisateur en session
                $_SESSION['user'] = $user->toSessionArray();
                
                $result['success'] = true;
                $result['user'] = $user;
            } else {
                $result['message'] = 'Email ou mot de passe incorrect';
            }
        } catch (\Exception $e) {
            error_log('Erreur de connexion : ' . $e->getMessage());
            $result['message'] = 'Une erreur est survenue lors de la connexion';
        }

        return $result;
    }

    /**
     * Traite la demande d'inscription
     *
     * @param array $data Données du formulaire
     * @param array $files Fichiers uploadés
     * @return array Résultat de l'opération
     */
    public function register($data, $files = []) {
        $result = ['success' => false, 'message' => '', 'errors' => [], 'user' => null];

        // Validation des données
        $nom = trim($data['nom'] ?? '');
        $prenom = trim($data['prenom'] ?? '');
        $email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $data['password'] ?? '';
        $confirmPassword = $data['password_confirm'] ?? '';

        // Vérifications
        if (empty($nom) || strlen($nom) > 50) {
            $result['errors'][] = 'Le nom est requis et ne doit pas dépasser 50 caractères';
        }
        
        if (empty($prenom) || strlen($prenom) > 50) {
            $result['errors'][] = 'Le prénom est requis et ne doit pas dépasser 50 caractères';
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result['errors'][] = 'Email invalide';
        }
        
        if (strlen($password) < 8 || strlen($password) > 72) {
            $result['errors'][] = 'Le mot de passe doit contenir entre 8 et 72 caractères';
        }
        
        if ($password !== $confirmPassword) {
            $result['errors'][] = 'Les mots de passe ne correspondent pas';
        }

        // Traitement de l'avatar
        $avatarPath = null;
        if (isset($files['avatar']) && $files['avatar']['error'] === UPLOAD_ERR_OK) {
            $avatarPath = $this->processAvatarUpload($files['avatar'], $result['errors']);
        }

        // S'il y a des erreurs, on arrête
        if (!empty($result['errors'])) {
            $result['message'] = 'Veuillez corriger les erreurs suivantes';
            return $result;
        }

        // Création de l'utilisateur
        try {
            $userData = [
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'password' => $password,
                'avatar' => $avatarPath
            ];

            $user = User::create($userData);

            if ($user) {
                // Régénérer l'ID de session pour éviter la fixation de session
                session_regenerate_id(true);
                
                // Stocker les informations de l'utilisateur en session
                $_SESSION['user'] = $user->toSessionArray();
                
                $result['success'] = true;
                $result['user'] = $user;
            }
        } catch (\Exception $e) {
            error_log('Erreur d\'inscription : ' . $e->getMessage());
            $result['message'] = $e->getMessage();
        }

        return $result;
    }

    /**
     * Déconnecte l'utilisateur
     *
     * @return bool Succès de l'opération
     */
    public function logout() {
        // Détruire la session
        session_destroy();
        return true;
    }

    /**
     * Traite l'upload d'un avatar
     *
     * @param array $file Fichier uploadé
     * @param array &$errors Tableau d'erreurs à remplir
     * @return string|null Chemin de l'avatar ou null
     */
    private function processAvatarUpload($file, &$errors) {
        if ($file['size'] > MAX_UPLOAD_SIZE) {
            $errors[] = 'Le fichier est trop volumineux (max 5MB)';
            return null;
        }

        $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
        $fileType = $file['type'];

        if (!array_key_exists($fileType, $allowedTypes)) {
            $errors[] = 'Type de fichier non autorisé. Formats acceptés : JPG, PNG';
            return null;
        }

        $extension = $allowedTypes[$fileType];
        $avatarName = uniqid('avatar_', true) . '.' . $extension;

        if (!is_dir(AVATAR_DIR)) {
            mkdir(AVATAR_DIR, 0755, true);
        }

        $targetPath = AVATAR_DIR . $avatarName;
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return 'avatars/' . $avatarName;
        } else {
            $errors[] = 'Erreur lors du téléchargement de l\'image';
            return null;
        }
    }
}