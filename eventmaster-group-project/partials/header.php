<?php
require_once dirname(__DIR__) . '/server/config.php';
require_once dirname(__DIR__) . '/server/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EventMaster</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/styles.css?v=3">

<script src="/EventMaster/scripts/main.js?v=1000" defer></script>

</head>
<body>
<header class="site-header">
    <div class="logo">EventMaster</div>

    <nav class="nav-bar">
        <a href="<?= BASE_URL ?>/pages/index.php">Home</a>
        <a href="<?= BASE_URL ?>/pages/about.php">About Us</a>
        <a href="<?= BASE_URL ?>/pages/contact.php">Contact Us</a>
        <a href="<?= BASE_URL ?>/pages/book.php">Book Now</a>
        <a href="<?= BASE_URL ?>/pages/my_book_list.php">My Book List</a>
    </nav>

    <div class="header-actions">
        <input type="text" id="eventSearch" placeholder="Search events...">
        <?php if (isLoggedIn()): ?>
            <span class="welcome-text">Hello, <?= htmlspecialchars(currentUserName()) ?></span>
            <a class="btn btn-outline" href="<?= BASE_URL ?>/server/handle_logout.php">Log Out</a>
        <?php else: ?>
            <a class="btn btn-outline" href="<?= BASE_URL ?>/pages/login.php">Sign In</a>
            <a class="btn btn-primary" href="<?= BASE_URL ?>/pages/register.php">Sign Up</a>
        <?php endif; ?>
    </div>
</header>

<main class="page-content">
