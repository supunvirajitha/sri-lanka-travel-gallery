<?php
require_once "includes/data.php";
require_once "includes/gallery-functions.php";
$id = isset($_GET["id"]) ? $_GET["id"] : "";
if (!isset($places[$id])) { $pageTitle = "Place Not Found | Travel Sri Lanka"; require_once "includes/header.php"; ?><section class="section not-found"><h1>Place Not Found</h1><p>The place you are looking for does not exist.</p><a href="places.php" class="btn">Back to Places</a></section><?php require_once "includes/footer.php"; exit; }
$place = $places[$id];
$uploadedPlaceImages = get_uploaded_images_by_place($id, 0);
$sliderImages = array();
foreach ($uploadedPlaceImages as $item) { if (isset($item["image"]) && $item["image"] !== "") { $sliderImages[] = $item["image"]; } }
$heroImage = !empty($sliderImages) ? $sliderImages[0] : $place["image"];
$pageTitle = $place["name"] . " | Travel Sri Lanka";
require_once "includes/header.php";
?>
<section class="details-hero" id="detailsHero" style="background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.65)), url('<?php echo e($heroImage); ?>');"><div class="details-content reveal"><span><?php echo e($place["category"]); ?></span><h1><?php echo e($place["name"]); ?></h1><p><i class="fa-solid fa-location-dot"></i> <?php echo e($place["location"]); ?></p></div></section>
<section class="section details-section"><div class="details-grid"><div class="details-main reveal">
<?php if (empty($sliderImages)): ?><div class="empty-gallery small-empty"><h3>No admin images uploaded yet</h3><p>Images for this place will appear here after admin uploads them.</p></div><?php else: ?>
<div class="auto-slider-frame admin-only-place-slider" id="autoSliderFrame" data-images='<?php echo e(json_encode($sliderImages)); ?>'><img src="<?php echo e($sliderImages[0]); ?>" alt="<?php echo e($place["name"]); ?>" id="autoSliderImage"><div class="slider-dark-overlay"></div><div class="slider-caption"><h3><?php echo e($place["name"]); ?></h3><p><?php echo e($place["location"]); ?></p></div><div class="slider-dots" id="sliderDots"><?php foreach ($sliderImages as $index => $image): ?><span class="<?php echo $index == 0 ? 'active' : ''; ?>"></span><?php endforeach; ?></div></div>
<?php endif; ?>
<h2>About <?php echo e($place["name"]); ?></h2><p><?php echo e($place["description"]); ?></p><h2>Things To Do</h2><div class="activity-list"><?php foreach ($place["activities"] as $activity): ?><span><i class="fa-solid fa-check"></i> <?php echo e($activity); ?></span><?php endforeach; ?></div>
<div class="more-place-images"><div class="more-title"><h2>Admin Uploaded Images</h2><a href="gallery.php?place=<?php echo e($id); ?>" class="read-more">View Gallery</a></div><?php if (empty($uploadedPlaceImages)): ?><div class="empty-gallery small-empty"><h3>No admin images available</h3><p>More images will be added by the admin soon.</p></div><?php else: ?><div class="small-image-grid"><?php foreach ($uploadedPlaceImages as $item): ?><a href="<?php echo e($item["image"]); ?>" target="_blank"><img src="<?php echo e($item["image"]); ?>" alt="<?php echo e($item["title"]); ?>"></a><?php endforeach; ?></div><?php endif; ?></div>
</div><aside class="details-sidebar reveal"><h3>Travel Info</h3><div class="info-row"><strong>Location</strong><p><?php echo e($place["location"]); ?></p></div><div class="info-row"><strong>Category</strong><p><?php echo e($place["category"]); ?></p></div><div class="info-row"><strong>Best Time</strong><p><?php echo e($place["best_time"]); ?></p></div><a href="gallery.php?place=<?php echo e($id); ?>" class="btn full-btn">View Admin Gallery</a><a href="places.php" class="btn-outline-dark full-btn">Back to Places</a></aside></div></section>
<?php require_once "includes/footer.php"; ?>
