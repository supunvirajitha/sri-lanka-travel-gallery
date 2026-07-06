<?php
require_once "includes/data.php";
$pageTitle = "About | Travel Sri Lanka";
require_once "includes/header.php";
?>

<section class="page-hero about-hero">
    <div class="page-hero-content reveal">
        <h1>About TravelLK</h1>
        <p>Your modern Sri Lanka travel guide website.</p>
    </div>
</section>

<section class="section about-section">
    <div class="about-grid">
        <div class="about-text reveal">
            <p class="section-subtitle">Who we are</p>
            <h2>We Help Travelers Discover Sri Lanka</h2>

            <p>
                TravelLK is a modern travel website created to showcase beautiful places
                around Sri Lanka. This project helps visitors explore beaches, mountains,
                waterfalls, cultural locations, wildlife parks, and historical places.
            </p>

            <p>
                You can use this website as a personal travel blog, tourism guide,
                university project, or travel agency website.
            </p>

            <a href="places.php" class="btn">Explore Places</a>
        </div>

        <div class="about-image reveal">
            <img src="assets/images/ella.jpeg" alt="Sri Lanka Travel">
        </div>
    </div>
</section>

<section class="dark-section">
    <div class="section-heading reveal">
        <p class="section-subtitle">Our mission</p>
        <h2>Make Sri Lanka Travel Simple and Beautiful</h2>
    </div>

    <div class="features-grid">
        <div class="feature-box reveal">
            <i class="fa-solid fa-map-location-dot"></i>
            <h3>Travel Guide</h3>
            <p>Help users discover the best places to visit in Sri Lanka.</p>
        </div>

        <div class="feature-box reveal">
            <i class="fa-solid fa-camera-retro"></i>
            <h3>Photo Gallery</h3>
            <p>Show beautiful travel photos with a modern gallery layout.</p>
        </div>

        <div class="feature-box reveal">
            <i class="fa-solid fa-route"></i>
            <h3>Trip Planning</h3>
            <p>Give users useful destination details before they travel.</p>
        </div>
    </div>
</section>

<?php require_once "includes/footer.php"; ?>
