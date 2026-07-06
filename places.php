<?php
require_once "includes/data.php";
require_once "includes/gallery-functions.php";
$pageTitle = "Places | Travel Sri Lanka";
require_once "includes/header.php";
?>
<section class="page-hero places-hero"><div class="page-hero-content reveal"><h1>Travel Places</h1><p>Explore beautiful travel destinations around Sri Lanka.</p></div></section>
<section class="section">
    <div class="section-heading reveal"><p class="section-subtitle">Choose your destination</p><h2>All Travel Places</h2><p>Search and explore places by category.</p></div>
    <div class="filter-box reveal"><input type="text" id="searchInput" placeholder="Search places..."><select id="categoryFilter"><option value="all">All Categories</option><option value="Heritage">Heritage</option><option value="Mountain">Mountain</option><option value="Coastal">Coastal</option><option value="Culture">Culture</option><option value="Beach">Beach</option><option value="Wildlife">Wildlife</option></select></div>
    <div class="cards-grid" id="placesGrid">
        <?php foreach ($places as $id => $place): $adminImage = get_latest_uploaded_image_by_place($id); $cardImage = $adminImage !== "" ? $adminImage : $place["image"]; ?>
            <div class="place-card reveal place-item" data-category="<?php echo e($place['category']); ?>">
                <div class="place-img"><img src="<?php echo e($cardImage); ?>" alt="<?php echo e($place['name']); ?>"><span><?php echo e($place['category']); ?></span></div>
                <div class="place-body"><h3><?php echo e($place['name']); ?></h3><p class="location"><i class="fa-solid fa-location-dot"></i> <?php echo e($place['location']); ?></p><p><?php echo e($place['short']); ?></p><a href="place-details.php?id=<?php echo e($id); ?>" class="read-more">View Details</a></div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php require_once "includes/footer.php"; ?>
