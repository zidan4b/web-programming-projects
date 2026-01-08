<?php
require_once __DIR__ . '/../server/config.php';
require_once __DIR__ . '/../server/auth.php';
requireSignup();
require_once __DIR__ . '/../partials/header.php';
?>

<section class="section book-form">
    <h1>Book Your Event</h1>
    <p>Fill out the form below and our team will follow up with you.</p>

    <div class="alert error" id="bookError" style="display:none;"></div>

    <?php if (!empty($_GET['error'])): ?>
        <div class="alert error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form class="form" action="<?= BASE_URL ?>/server/handle_booking.php" method="post">

        <div class="form-row">
            <label for="client_name">Name</label>
            <input type="text" id="client_name" name="client_name">
        </div>

        <div class="form-row">
            <label for="address">Address</label>
            <input type="text" id="address" name="address">
        </div>

        <div class="form-row">
            <label for="event_date">Event Date</label>
            <input type="date" id="event_date" name="event_date">
        </div>

        <div class="form-row">
            <label for="event_type">Event Type</label>
            <select id="event_type" name="event_type">
                <option value="">-- Select Event Type --</option>
                <option value="Wedding">Wedding</option>
                <option value="Birthday">Birthday</option>
                <option value="Holiday Party">Holiday Party</option>
                <option value="Baby Shower">Baby Shower</option>
            </select>
        </div>

        <div class="form-row">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone">
        </div>

        <div class="form-row">
            <label for="notes">Additional Details</label>
            <textarea id="notes" name="notes"
                placeholder="Tell us about any special requests or details."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
