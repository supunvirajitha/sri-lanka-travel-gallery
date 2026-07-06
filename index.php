<?php
require_once "includes/data.php";
require_once "includes/gallery-functions.php";

$pageTitle = "Home | Travel Sri Lanka";
$coverImages = get_uploaded_cover_images(8);
$coverImagesJson = json_encode($coverImages);

require_once "includes/header.php";
?>

<section class="hero admin-cover-hero" id="adminCoverHero" data-cover-images='<?php echo e($coverImagesJson); ?>'>
    <div class="hero-content reveal">
        <p class="hero-subtitle">Welcome to Sri Lanka</p>
        <h1>Explore Beautiful Places Around Sri Lanka</h1>
        <p>Discover beaches, mountains, waterfalls, ancient cities, wildlife parks, and hidden travel destinations in Sri Lanka.</p>
        <div class="hero-buttons">
            <a href="places.php" class="btn">Explore Places</a>
            <a href="gallery.php" class="btn btn-light">View Gallery</a>
        </div>
    </div>
    <div class="floating-card reveal">
        <i class="fa-solid fa-images"></i>
        <div>
            <h3>Admin Gallery</h3>
            <p>Auto changing cover</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-heading reveal">
        <p class="section-subtitle">Popular destinations</p>
        <h2>Top Places to Visit</h2>
        <p>Start your Sri Lanka journey with these beautiful places.</p>
    </div>
    <div class="cards-grid">
        <?php $count = 0; foreach ($places as $id => $place): if ($count == 3) { break; } $count++; $adminImage = get_latest_uploaded_image_by_place($id); $cardImage = $adminImage !== "" ? $adminImage : $place["image"]; ?>
            <div class="place-card reveal">
                <div class="place-img">
                    <img src="<?php echo e($cardImage); ?>" alt="<?php echo e($place['name']); ?>">
                    <span><?php echo e($place['category']); ?></span>
                </div>
                <div class="place-body">
                    <h3><?php echo e($place['name']); ?></h3>
                    <p class="location"><i class="fa-solid fa-location-dot"></i> <?php echo e($place['location']); ?></p>
                    <p><?php echo e($place['short']); ?></p>
                    <a href="place-details.php?id=<?php echo e($id); ?>" class="read-more">View More</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="center-btn reveal"><a href="places.php" class="btn">View All Places</a></div>
</section>

<section class="dark-section">
    <div class="section-heading reveal">
        <p class="section-subtitle">Why choose Sri Lanka?</p>
        <h2>A Small Island With Big Adventures</h2>
    </div>
    <div class="features-grid">
        <div class="feature-box reveal"><i class="fa-solid fa-mountain-sun"></i><h3>Beautiful Nature</h3><p>Enjoy mountains, waterfalls, forests, tea estates, and scenic viewpoints.</p></div>
        <div class="feature-box reveal"><i class="fa-solid fa-umbrella-beach"></i><h3>Golden Beaches</h3><p>Relax on beautiful beaches like Mirissa, Unawatuna, Bentota, and Arugam Bay.</p></div>
        <div class="feature-box reveal"><i class="fa-solid fa-landmark"></i><h3>Rich Culture</h3><p>Explore temples, ancient kingdoms, festivals, and traditional Sri Lankan food.</p></div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-content reveal">
        <h2>Explore Admin Travel Gallery</h2>
        <p>All public gallery images are added by the admin.</p>
        <a href="gallery.php" class="btn">View Gallery</a>
    </div>
</section>

<?php require_once "includes/footer.php"; ?>
