<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . '/pages/login.php');
        exit;
    }
}

function requireSignup(): void
{
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . '/pages/register.php');
        exit;
    }
}

function currentUserName(): ?string
{
    return $_SESSION['full_name'] ?? null;
}

