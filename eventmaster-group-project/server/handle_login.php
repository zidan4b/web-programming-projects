<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/pages/login.php');
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    header('Location: ' . BASE_URL . '/pages/login.php?error=' . urlencode('Email and password are required.'));
    exit;
}

$stmt = $pdo->prepare('SELECT id, full_name, password_hash FROM users WHERE email = :email');
$stmt->execute(['email' => $email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password_hash'])) {
    header('Location: ' . BASE_URL . '/pages/login.php?error=' . urlencode('Invalid email or password.'));
    exit;
}

$_SESSION['user_id']   = $user['id'];
$_SESSION['full_name'] = $user['full_name'];

header('Location: ' . BASE_URL . '/pages/index.php');
exit;
