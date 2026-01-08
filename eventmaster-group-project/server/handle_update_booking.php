<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/pages/my_book_list.php');
    exit;
}

$id           = (int)($_POST['id'] ?? 0);
$client_name  = trim($_POST['client_name'] ?? '');
$event_type   = trim($_POST['event_type'] ?? '');
$event_date   = $_POST['event_date'] ?? '';
$address      = trim($_POST['address'] ?? '');
$phone        = trim($_POST['phone'] ?? '');
$notes        = trim($_POST['notes'] ?? '');

# ---- VALIDATION ----
if (
    $id <= 0 ||
    $client_name === '' ||
    $event_type === '' ||
    $event_date === '' ||
    $address === '' ||
    $phone === ''
) {
    header('Location: ' . BASE_URL . '/pages/my_book_list.php?updated=0');
    exit;
}

$stmt = $pdo->prepare(
    'UPDATE bookings
     SET client_name = :name,
         event_type  = :type,
         event_date  = :date,
         address     = :address,
         phone       = :phone,
         notes       = :notes
     WHERE id = :id AND user_id = :uid'
);

$stmt->execute([
    'name'    => $client_name,
    'type'    => $event_type,
    'date'    => $event_date,
    'address' => $address,
    'phone'   => $phone,
    'notes'   => $notes,
    'id'      => $id,
    'uid'     => $_SESSION['user_id'],
]);

header('Location: ' . BASE_URL . '/pages/my_book_list.php?updated=1');
exit;
