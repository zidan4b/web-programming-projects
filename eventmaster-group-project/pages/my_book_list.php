<?php

require_once __DIR__ . '/../server/config.php';
require_once __DIR__ . '/../server/db.php';
require_once __DIR__ . '/../server/auth.php';

requireLogin();


require_once __DIR__ . '/../partials/header.php';

$stmt = $pdo->prepare('SELECT * FROM bookings WHERE user_id = :uid ORDER BY event_date ASC');
$stmt->execute(['uid' => $_SESSION['user_id']]);
$bookings = $stmt->fetchAll();
?>

<section class="section">
    <h1>My Booked Events</h1>

    <?php if (!empty($_GET['updated'])): ?>
        <div class="alert success">Booking updated successfully.</div>
    <?php endif; ?>
    <?php if (!empty($_GET['deleted'])): ?>
        <div class="alert success">Booking deleted successfully.</div>
    <?php endif; ?>

    <?php if (empty($bookings)): ?>
        <p>You have no booked events yet. <a href="<?= BASE_URL ?>/pages/book.php">Book your first event.</a></p>
    <?php else: ?>
        <table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Event Type</th>
            <th>Date</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($bookings as $booking): ?>
        <tr>
            <form action="<?= BASE_URL ?>/server/handle_update_booking.php" method="post">

                <!-- NAME -->
                <td>
                    <input type="text" name="client_name"
                           value="<?= htmlspecialchars($booking['client_name']) ?>" required>
                </td>

                <!-- EVENT TYPE -->
                <td>
                    <select name="event_type" required>
                        <?php
                        $types = ['Wedding', 'Birthday', 'Holiday Party', 'Baby Shower'];
                        foreach ($types as $type): ?>
                            <option value="<?= $type ?>"
                                <?= $booking['event_type'] === $type ? 'selected' : '' ?>>
                                <?= $type ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>

                <!-- DATE -->
                <td>
                    <input type="date" name="event_date"
                           value="<?= htmlspecialchars($booking['event_date']) ?>" required>
                </td>

                <!-- ADDRESS -->
                <td>
                    <input type="text" name="address"
                           value="<?= htmlspecialchars($booking['address']) ?>" required>
                </td>

                <!-- PHONE -->
                <td>
                    <input type="text" name="phone"
                           value="<?= htmlspecialchars($booking['phone']) ?>" required>
                </td>

                <!-- NOTES -->
                <td>
                    <textarea name="notes"><?= htmlspecialchars($booking['notes']) ?></textarea>
                </td>

                <!-- ACTIONS -->
                <td class="table-actions">
                    <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                    <button type="submit" class="btn btn-small btn-update">Update</button>
            </form>

            <form action="<?= BASE_URL ?>/server/handle_delete_booking.php" method="post"
                  onsubmit="return confirm('Are you sure you want to delete this booking?');">
                <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                <button type="submit" class="btn btn-small btn-danger">Delete</button>
            </form>
                </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
