<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/pages/book.php');
    exit;
}

$client_name = trim($_POST['client_name'] ?? '');
$address     = trim($_POST['address'] ?? '');
$event_date  = $_POST['event_date'] ?? '';
$event_type  = $_POST['event_type'] ?? '';
$phone       = trim($_POST['phone'] ?? '');
$notes       = trim($_POST['notes'] ?? '');

$error = "";

/*  VALIDATION */

// Name
if (!preg_match("/^[a-zA-Z ]+$/", $client_name)) {
    $error = "Name must contain letters only.";
}

// Address
else if (strlen($address) < 5) {
    $error = "Address is too short.";
}

// Date 
else {
    $today = date("Y-m-d");
    if ($event_date < $today) {
        $error = "Event date cannot be in the past.";
    }
}

// Phone
if ($error === "" && !preg_match("/^[0-9]{7,15}$/", $phone)) {
    $error = "Invalid phone number. Digits only (7–15 digits).";
}

// Event type required
if ($error === "" && empty($event_type)) {
    $error = "Please select an event type.";
}

/* ERROR */
if ($error !== "") {
    header('Location: ' . BASE_URL . '/pages/book.php?error=' . urlencode($error));
    exit;
}

/* INSERT INTO DB */
$stmt = $pdo->prepare(
    'INSERT INTO bookings (user_id, client_name, address, event_date, event_type, phone, notes)
     VALUES (:uid, :name, :address, :date, :type, :phone, :notes)'
);

$stmt->execute([
    'uid'     => $_SESSION['user_id'],
    'name'    => $client_name,
    'address' => $address,
    'date'    => $event_date,
    'type'    => $event_type,
    'phone'   => $phone,
    'notes'   => $notes,
]);

header('Location: ' . BASE_URL . '/pages/my_book_list.php');
exit;
