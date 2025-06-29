<?php
session_start();
require_once __DIR__ . '/config/database.php';
$pdo = getDBConnection();

if (!isset($_SESSION['user']['id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$cart_id = isset($_POST['cart_id']) ? (int)$_POST['cart_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $cart_id > 0) {
    $stmt = $pdo->prepare('DELETE FROM cart WHERE id = ? AND user_id = ?');
    $stmt->execute([$cart_id, $user_id]);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit; 