<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/pages/register.php');
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$password  = $_POST['password'] ?? '';
$confirm   = $_POST['confirm_password'] ?? '';

if ($full_name === '' || $email === '' || $password === '' || $confirm === '') {
    header('Location: ' . BASE_URL . '/pages/register.php?error=' . urlencode('All fields are required.'));
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ' . BASE_URL . '/pages/register.php?error=' . urlencode('Invalid email format.'));
    exit;
}

if ($password !== $confirm) {
    header('Location: ' . BASE_URL . '/pages/register.php?error=' . urlencode('Passwords do not match.'));
    exit;
}

if (strlen($password) < 6) {
    header('Location: ' . BASE_URL . '/pages/register.php?error=' . urlencode('Password must be at least 6 characters.'));
    exit;
}

// Check email not used
$stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
$stmt->execute(['email' => $email]);
if ($stmt->fetch()) {
    header('Location: ' . BASE_URL . '/pages/register.php?error=' . urlencode('Email is already registered.'));
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$ins = $pdo->prepare('INSERT INTO users (full_name, email, password_hash) VALUES (:name, :email, :hash)');
$ins->execute([
    'name'  => $full_name,
    'email' => $email,
    'hash'  => $hash,
]);

$_SESSION['user_id']   = $pdo->lastInsertId();
$_SESSION['full_name'] = $full_name;

header('Location: ' . BASE_URL . '/pages/index.php');
exit;
