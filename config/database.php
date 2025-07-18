<?php
/**
 * Configuration de la base de données
 *
 * @package boutiqua
 * @version 1.0.0
 */

// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'boutiqua');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Configuration des uploads
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads/');
define('AVATAR_DIR', UPLOAD_DIR . 'avatars/');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB

/**
 * Fonction de connexion à la base de données
 *
 * @return PDO Instance de connexion PDO
 * @throws Exception Si la connexion échoue
 */
function getDBConnection()
{
  try {
    $dsn = sprintf(
      'mysql:host=%s;dbname=%s;charset=%s',
      DB_HOST,
      DB_NAME,
      DB_CHARSET,
    );
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
  } catch (PDOException $e) {
    error_log('Erreur de connexion à la base de données : ' . $e->getMessage());
    throw new Exception(
      'Une erreur est survenue lors de la connexion à la base de données',
    );
  }
}