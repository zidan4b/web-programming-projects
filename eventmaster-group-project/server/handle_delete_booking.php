<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/pages/my_book_list.php');
    exit;
}

$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    header('Location: ' . BASE_URL . '/pages/my_book_list.php?deleted=0');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM bookings WHERE id = :id AND user_id = :uid');
$stmt->execute([
    'id'  => $id,
    'uid' => $_SESSION['user_id'],
]);

header('Location: ' . BASE_URL . '/pages/my_book_list.php?deleted=1');
exit;

