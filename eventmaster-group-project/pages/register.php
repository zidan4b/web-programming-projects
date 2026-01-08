<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="auth-box">
    <h1>Create an Account</h1>

    <?php if (!empty($_GET['error'])): ?>
        <div class="alert error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form class="form" id="registerForm" action="<?= BASE_URL ?>/server/handle_register.php" method="post">

        
        <div class="alert error" id="registerError" style="display:none;"></div>

        <div class="form-row">
            <label for="full_name">Full Name</label>
            <input id="full_name" name="full_name" required>
        </div>

        <div class="form-row">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-row">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-row">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
