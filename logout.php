<?php
session_start();

// Inclure le contrôleur d'authentification
require_once __DIR__ . '/src/Controllers/AuthController.php';
use HexaShop\Controllers\AuthController;

// Déconnexion de l'utilisateur
$authController = new AuthController();
$authController->logout();

// Rediriger vers la page d'accueil
header('Location: /hexashop-1.0.0/index.php');
exit();
