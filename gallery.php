<?php
require_once "includes/data.php";
require_once "includes/gallery-functions.php";
require_once "includes/auth.php";

$pageTitle = "Gallery | Travel Sri Lanka";
$selectedPlace = isset($_GET["place"]) ? $_GET["place"] : "";
if ($selectedPlace !== "" && !isset($places[$selectedPlace])) { $selectedPlace = ""; }
$message = ""; $error = "";
if (isset($_GET["delete"]) && is_admin_logged_in()) {
    $result = delete_gallery_image_by_id(trim($_GET["delete"]));
    if ($result["success"]) { $message = $result["message"]; } else { $error = $result["message"]; }
}
$uploadedImages = $selectedPlace !== "" ? get_uploaded_images_by_place($selectedPlace, 0) : get_all_uploaded_images();
$sliderItems = array();
foreach ($uploadedImages as $item) {
    $placeId = isset($item["place_id"]) ? $item["place_id"] : "";
    $placeName = isset($places[$placeId]) ? $places[$placeId]["name"] : "Sri Lanka";
    $sliderItems[] = array(
        "id" => isset($item["id"]) ? $item["id"] : "",
        "type" => "uploaded",
        "image" => isset($item["image"]) ? $item["image"] : "",
        "title" => isset($item["title"]) ? $item["title"] : "Travel Image",
        "place" => $placeName,
        "description" => isset($item["description"]) ? $item["description"] : "",
        "uploaded_at" => isset($item["uploaded_at"]) ? $item["uploaded_at"] : ""
    );
}
require_once "includes/header.php";
?>
<section class="page-hero gallery-hero"><div class="page-hero-content reveal"><h1>Travel Gallery</h1><p>Only admin-uploaded travel images are displayed here.</p></div></section>
<section class="section fixed-full-gallery-section">
    <div class="section-heading reveal">
        <p class="section-subtitle">Admin gallery</p>
        <?php if ($selectedPlace !== "" && isset($places[$selectedPlace])): ?><h2><?php echo e($places[$selectedPlace]["name"]); ?> Admin Images</h2><p>Images uploaded by admin for this destination.</p><?php else: ?><h2>Admin Uploaded Images</h2><p>All gallery images are added from the admin panel.</p><?php endif; ?>
    </div>
    <?php if ($message !== ""): ?><div class="alert success admin-alert"><?php echo e($message); ?></div><?php endif; ?>
    <?php if ($error !== ""): ?><div class="alert error admin-alert"><?php echo e($error); ?></div><?php endif; ?>
    <?php if (is_admin_logged_in()): ?><div class="gallery-admin-top reveal"><a href="admin-dashboard.php" class="btn-outline-dark">Admin Dashboard</a><a href="admin-upload.php" class="btn">Upload Images</a></div><?php endif; ?>
    <div class="gallery-filter-bar reveal"><a href="gallery.php" class="<?php echo $selectedPlace === "" ? 'active' : ''; ?>">All Admin Images</a><?php foreach ($places as $placeId => $place): ?><a href="gallery.php?place=<?php echo e($placeId); ?>" class="<?php echo $selectedPlace === $placeId ? 'active' : ''; ?>"><?php echo e($place["name"]); ?></a><?php endforeach; ?></div>
    <?php if (empty($sliderItems)): ?>
        <div class="empty-gallery reveal"><h3>No admin images available yet</h3><?php if ($selectedPlace !== "" && isset($places[$selectedPlace])): ?><p>No admin images have been uploaded for <?php echo e($places[$selectedPlace]["name"]); ?> yet.</p><?php else: ?><p>No admin images have been uploaded yet.</p><?php endif; ?><?php if (is_admin_logged_in()): ?><a href="admin-upload.php" class="btn">Upload Images</a><?php endif; ?></div>
    <?php else: ?>
        <div class="fixed-gallery-wrapper reveal">
            <div class="fixed-gallery-frame cover-auto-frame" id="autoNaturalFrame">
                <img src="<?php echo e($sliderItems[0]["image"]); ?>" alt="<?php echo e($sliderItems[0]["title"]); ?>" id="fixedGalleryImage">
                <button type="button" class="fixed-gallery-btn fixed-gallery-prev" id="fixedGalleryPrevBtn"><i class="fa-solid fa-chevron-left"></i></button>
                <button type="button" class="fixed-gallery-btn fixed-gallery-next" id="fixedGalleryNextBtn"><i class="fa-solid fa-chevron-right"></i></button>
                <div class="fixed-gallery-counter"><span id="fixedGalleryCurrentNumber">1</span> / <span><?php echo count($sliderItems); ?></span></div>
            </div>
            <div class="fixed-gallery-details full-gallery-details">
                <p class="section-subtitle" id="fixedGalleryPlace"><?php echo e($sliderItems[0]["place"]); ?></p>
                <h3 id="fixedGalleryTitle"><?php echo e($sliderItems[0]["title"]); ?></h3>
                <p id="fixedGalleryDescription"><?php echo e($sliderItems[0]["description"]); ?></p>
                <small id="fixedGalleryDate"><?php echo e($sliderItems[0]["uploaded_at"]); ?></small>
                <div class="gallery-current-actions"><a href="<?php echo e($sliderItems[0]["image"]); ?>" target="_blank" class="btn-outline-dark small-btn" id="fixedGalleryFullImageLink">View Full Image</a><?php if (is_admin_logged_in()): ?><a href="#" class="delete-btn" id="fixedGalleryDeleteLink" onclick="return confirm('Are you sure you want to delete this uploaded image?');">Delete Image</a><?php endif; ?></div>
            </div>
            <div class="fixed-gallery-thumbs" id="fixedGalleryThumbs"><?php foreach ($sliderItems as $index => $item): ?><button type="button" class="fixed-gallery-thumb <?php echo $index == 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"><img src="<?php echo e($item["image"]); ?>" alt="<?php echo e($item["title"]); ?>"></button><?php endforeach; ?></div>
        </div>
    <?php endif; ?>
</section>
<script>
(function(){
    var images = <?php echo json_encode($sliderItems); ?>;
    var isAdmin = <?php echo is_admin_logged_in() ? "true" : "false"; ?>;
    var selectedPlace = "<?php echo e($selectedPlace); ?>";
    if (!images || images.length === 0) return;
    var currentIndex = 0;
    var imageElement = document.getElementById("fixedGalleryImage");
    var titleElement = document.getElementById("fixedGalleryTitle");
    var placeElement = document.getElementById("fixedGalleryPlace");
    var descriptionElement = document.getElementById("fixedGalleryDescription");
    var dateElement = document.getElementById("fixedGalleryDate");
    var counterElement = document.getElementById("fixedGalleryCurrentNumber");
    var previousButton = document.getElementById("fixedGalleryPrevBtn");
    var nextButton = document.getElementById("fixedGalleryNextBtn");
    var thumbnails = document.querySelectorAll(".fixed-gallery-thumb");
    var fullImageLink = document.getElementById("fixedGalleryFullImageLink");
    var deleteLink = document.getElementById("fixedGalleryDeleteLink");
    if (!imageElement) return;
    function buildDeleteUrl(item){ var url = "gallery.php?delete=" + encodeURIComponent(item.id); if (selectedPlace !== "") url += "&place=" + encodeURIComponent(selectedPlace); return url; }
    function showImage(index){
        if(index < 0) index = images.length - 1; if(index >= images.length) index = 0; currentIndex = index; var item = images[currentIndex];
        imageElement.style.opacity = "0";
        setTimeout(function(){
            imageElement.src = item.image; imageElement.alt = item.title;
            if(titleElement) titleElement.textContent = item.title || "";
            if(placeElement) placeElement.textContent = item.place || "";
            if(descriptionElement) descriptionElement.textContent = item.description || "";
            if(dateElement) dateElement.textContent = item.uploaded_at || "";
            if(counterElement) counterElement.textContent = currentIndex + 1;
            if(fullImageLink) fullImageLink.href = item.image;
            if(deleteLink && isAdmin) deleteLink.href = buildDeleteUrl(item);
            for(var i=0;i<thumbnails.length;i++) thumbnails[i].classList.remove("active");
            if(thumbnails[currentIndex]) thumbnails[currentIndex].classList.add("active");
            imageElement.style.opacity = "1";
        },180);
    }
    if(previousButton) previousButton.onclick = function(){ showImage(currentIndex - 1); };
    if(nextButton) nextButton.onclick = function(){ showImage(currentIndex + 1); };
    for(var i=0;i<thumbnails.length;i++){ thumbnails[i].onclick = function(){ var index = parseInt(this.getAttribute("data-index"),10); if(!isNaN(index)) showImage(index); }; }
    if(images.length > 1){ setInterval(function(){ showImage(currentIndex + 1); }, 4000); }
    showImage(0);
})();
</script>
<?php require_once "includes/footer.php"; ?>
