<?php
require_once "includes/data.php";
require_once "includes/auth.php";
require_once "includes/gallery-functions.php";

require_admin_login();

$pageTitle = "Admin Dashboard | Travel Sri Lanka";

$deleteSuccess = "";
$deleteError = "";

if (isset($_GET["delete"])) {
    $deleteId = trim($_GET["delete"]);
    $items = load_gallery_items();
    $newItems = array();
    $found = false;
    $imagePathToDelete = "";

    foreach ($items as $item) {
        if (isset($item["id"]) && $item["id"] === $deleteId) {
            $found = true;
            $imagePathToDelete = isset($item["image"]) ? $item["image"] : "";
            continue;
        }

        $newItems[] = $item;
    }

    if ($found) {
        save_gallery_items($newItems);

        if ($imagePathToDelete !== "") {
            $fullPath = __DIR__ . "/" . $imagePathToDelete;

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        $deleteSuccess = "Image deleted successfully.";
    } else {
        $deleteError = "Image not found.";
    }
}

$uploadedImages = get_all_uploaded_images();

require_once "includes/admin-header.php";
?>

<section class="page-hero admin-hero">
    <div class="page-hero-content reveal">
        <h1>Admin Dashboard</h1>
        <p>Upload, view, and manage travel gallery images.</p>
    </div>
</section>

<section class="section admin-dashboard-section">

    <?php if ($deleteSuccess): ?>
        <div class="alert success admin-alert"><?php echo e($deleteSuccess); ?></div>
    <?php endif; ?>

    <?php if ($deleteError): ?>
        <div class="alert error admin-alert"><?php echo e($deleteError); ?></div>
    <?php endif; ?>

    <div class="admin-stats-grid reveal">
        <div class="admin-stat-card">
            <i class="fa-solid fa-location-dot"></i>
            <h3><?php echo count($places); ?></h3>
            <p>Total Places</p>
        </div>

        <div class="admin-stat-card">
            <i class="fa-solid fa-images"></i>
            <h3><?php echo count($uploadedImages); ?></h3>
            <p>Uploaded Images</p>
        </div>

        <div class="admin-stat-card">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <h3>Admin</h3>
            <p>Upload Access</p>
        </div>
    </div>

    <div class="admin-actions reveal">
        <a href="admin-upload.php" class="btn">Upload New Images</a>
        <a href="gallery.php" class="btn-outline-dark">Open Gallery Manage View</a>
    </div>

    <div class="section-heading reveal">
        <p class="section-subtitle">Manage gallery</p>
        <h2>Uploaded Images</h2>
        <p>Only admin can delete or upload images. Users can only view them.</p>
    </div>

    <?php if (empty($uploadedImages)): ?>
        <div class="empty-gallery reveal">
            <h3>No uploaded images yet</h3>
            <p>Start by uploading images from the admin upload page.</p>
            <a href="admin-upload.php" class="btn">Upload Images</a>
        </div>
    <?php else: ?>

        <div class="gallery-grid user-gallery-grid">
            <?php foreach ($uploadedImages as $item): ?>
                <div class="user-gallery-card admin-gallery-card reveal">
                    <a href="<?php echo e($item["image"]); ?>" target="_blank" class="user-gallery-img">
                        <img src="<?php echo e($item["image"]); ?>" alt="<?php echo e($item["title"]); ?>">
                    </a>

                    <div class="user-gallery-body">
                        <h3><?php echo e($item["title"]); ?></h3>

                        <?php if (isset($places[$item["place_id"]])): ?>
                            <p class="location">
                                <i class="fa-solid fa-location-dot"></i>
                                <?php echo e($places[$item["place_id"]]["name"]); ?>
                            </p>
                        <?php endif; ?>

                        <?php if (isset($item["description"]) && $item["description"] !== ""): ?>
                            <p><?php echo e($item["description"]); ?></p>
                        <?php endif; ?>

                        <small>Uploaded: <?php echo e($item["uploaded_at"]); ?></small>

                        <div class="admin-card-actions">
                            <a href="<?php echo e($item["image"]); ?>" target="_blank" class="btn-outline-dark small-btn">View</a>
                            <a href="admin-dashboard.php?delete=<?php echo e($item["id"]); ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</section>

<?php require_once "includes/footer.php"; ?>
