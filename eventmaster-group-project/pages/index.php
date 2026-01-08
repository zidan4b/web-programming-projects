<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero">
    <h1>All-in-One Event Planning Platform for Every Celebration</h1>
    <p>From intimate gatherings to grand celebrations, EventMaster makes planning effortless.</p>
    <a href="<?= BASE_URL ?>/pages/book.php" class="btn btn-primary">Book Now</a>
</section>

<section class="section">
    <h2>Our Events</h2>
    <p>Discover our most popular event experiences.</p>

    <div class="events-grid" id="eventsGrid">
        <article class="event-card" data-event-type="Wedding" class="uniform-img">
    <img src="<?= BASE_URL ?>/wedding.jpg" alt="Wedding">
            <h3>Wedding</h3>
            <p>Elegant, romantic, and perfectly coordinated wedding celebrations.</p>
        </article>

        <article class="event-card" data-event-type="Birthday">
            <img src="<?= BASE_URL ?>/birthday.jpg" alt="Birthday Party" class="uniform-img">
            <h3>Birthday Party</h3>
            <p>Fun, vibrant, and personalized birthday experiences for all ages.</p>
        </article>

        <article class="event-card" data-event-type="Holiday Party">
            <img src="<?= BASE_URL ?>/HolidayParty.jpg" alt="Holiday Party" class="uniform-img">
            <h3>Holiday Party</h3>
            <p>Festive and unforgettable celebrations for every holiday season.</p>
        </article>

        <article class="event-card" data-event-type="Baby Shower">
            <img src="<?= BASE_URL ?>/babyshower.jpg" alt="Baby Shower" class="uniform-img">
            <h3>Baby Shower</h3>
            <p>Warm, joyful gatherings to celebrate parents-to-be.</p>
        </article>
    </div>
</section>

<section class="section section-alt">
    <h2>Our Team</h2>
    <p>Meet the people who make your events extraordinary.</p>

    <div class="team-grid">
        <article class="team-card">
            <img src="<?= BASE_URL ?>/aymen1.jpg" alt="Team Member 1" class="uniform-img"
>             <h3> Ayman Galoul</h3>
            <p>Professional full-stack developer and designer</p>
        </article>
        <article class="team-card">
            <img src="<?= BASE_URL ?>/nadine.jpg" alt="Team Member 2" class="uniform-img">
            <h3>Nadine</h3>
            <p>Creative front-end specialist and UI designer</p>
        </article>
        <article class="team-card">
            <img src="<?= BASE_URL ?>/zidan2.jpg" alt="Team Member 3" class="uniform-img">
            <h3>Zidan Bakari</h3>
            <p>Skilled backend engineer with advanced expertise</p>
        </article>
    </div>
</section>

<section class="section">
    <h2>What We Offer</h2>
    <div class="offers-grid">

        <div class="offer-card">
            <img src="<?= BASE_URL ?>/wedding5.jpg" alt="Wedding Service" class="uniform-img">
            <h3>Wedding</h3>
            <p>Full-service planning, decor, vendors, and on-site coordination.</p>
        </div>

        <div class="offer-card">
            <img src="<?= BASE_URL ?>/birthday2.jpg" alt="Birthday Service" class="uniform-img">
            <h3>Birthday Party</h3>
            <p>Custom themes, entertainment, and catering for all ages.</p>
        </div>

        <div class="offer-card">
            <img src="<?= BASE_URL ?>/HolidayParty2.jpg" alt="Holiday Party Service" class="uniform-img">
            <h3>Holiday Party</h3>
            <p>Corporate and private holiday events with festive designs.</p>
        </div>

        <div class="offer-card">
            <img src="<?= BASE_URL ?>/babyshower2.jpg" alt="Baby Shower Service" class="uniform-img">
            <h3>Baby Shower</h3>
            <p>Special Baby and Daddy Showers with games, décor, and more.</p>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
