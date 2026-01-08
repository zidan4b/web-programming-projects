<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="section auth-box">
    <h1>Sign In</h1>

    <?php if (!empty($_GET['error'])): ?>
        <div class="alert error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

<form class="form" id="loginForm" action="<?= BASE_URL ?>/server/handle_login.php" method="post">
    
    <div class="alert error" id="loginError" style="display:none;"></div>

    <div class="form-row">
        <label for="email">Email</label>
        <input id="email" name="email">
    </div>

    <div class="form-row">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>

    <button type="submit" class="btn btn-primary">Sign In</button>
</form>

</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
