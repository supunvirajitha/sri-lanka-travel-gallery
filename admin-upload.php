<?php
require_once "includes/data.php";
require_once "includes/auth.php";
require_once "includes/gallery-functions.php";

require_admin_login();

$pageTitle = "Admin Upload Images | Travel Sri Lanka";

$successMessages = array();
$errorMessages = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $placeId = isset($_POST["place_id"]) ? trim($_POST["place_id"]) : "";
    $title = isset($_POST["title"]) ? trim($_POST["title"]) : "";
    $description = isset($_POST["description"]) ? trim($_POST["description"]) : "";

    if ($placeId === "" || !isset($places[$placeId])) {
        $errorMessages[] = "Please select a valid place.";
    }

    if ($title === "") {
        $errorMessages[] = "Please enter image title.";
    }

    if (!isset($_FILES["travel_images"])) {
        $errorMessages[] = "Please select at least one image.";
    }

    if (empty($errorMessages)) {
        $fileCount = count($_FILES["travel_images"]["name"]);

        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES["travel_images"]["name"][$i] === "") {
                continue;
            }

            $singleFile = array(
                "name" => $_FILES["travel_images"]["name"][$i],
                "type" => $_FILES["travel_images"]["type"][$i],
                "tmp_name" => $_FILES["travel_images"]["tmp_name"][$i],
                "error" => $_FILES["travel_images"]["error"][$i],
                "size" => $_FILES["travel_images"]["size"][$i]
            );

            $imageTitle = $title;

            if ($fileCount > 1) {
                $imageTitle = $title . " " . ($i + 1);
            }

            $result = upload_gallery_image($singleFile, $placeId, $imageTitle, $description);

            if ($result["success"]) {
                $successMessages[] = $result["message"];
            } else {
                $errorMessages[] = $result["message"];
            }
        }

        if (empty($successMessages) && empty($errorMessages)) {
            $errorMessages[] = "Please select at least one image.";
        }
    }
}

require_once "includes/admin-header.php";
?>

<section class="page-hero admin-upload-hero">
    <div class="page-hero-content reveal">
        <h1>Admin Image Upload</h1>
        <p>Upload travel images for public users to view.</p>
    </div>
</section>

<section class="section upload-section">
    <div class="upload-wrapper">

        <div class="upload-info reveal">
            <p class="section-subtitle">Admin only</p>
            <h2>Add Travel Images</h2>
            <p>
                Upload travel photos, select the related place, and add a small description.
                These images will appear in the public gallery and place details page.
            </p>

            <div class="upload-note">
                <h3>Upload Rules</h3>
                <p>Allowed image types: JPG, JPEG, PNG, WEBP, GIF</p>
                <p>Maximum image size: 5MB</p>
                <p>Only logged-in admin can upload images.</p>
            </div>
        </div>

        <form method="POST" enctype="multipart/form-data" class="upload-form reveal">

            <?php if (!empty($successMessages)): ?>
                <?php foreach ($successMessages as $message): ?>
                    <div class="alert success"><?php echo e($message); ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($errorMessages)): ?>
                <?php foreach ($errorMessages as $message): ?>
                    <div class="alert error"><?php echo e($message); ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="input-group">
                <label>Select Place *</label>
                <select name="place_id" required>
                    <option value="">Choose place</option>
                    <?php foreach ($places as $id => $place): ?>
                        <option value="<?php echo e($id); ?>">
                            <?php echo e($place["name"]); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label>Image Title *</label>
                <input type="text" name="title" placeholder="Example: Sunset at Mirissa" required>
            </div>

            <div class="input-group">
                <label>Description</label>
                <textarea name="description" rows="5" placeholder="Write something about this image"></textarea>
            </div>

            <div class="input-group">
                <label>Upload Images *</label>
                <input type="file" name="travel_images[]" accept="image/*" multiple required>
            </div>

            <button type="submit" class="btn form-btn">Upload Images</button>

            <div class="admin-upload-actions">
                <a href="admin-dashboard.php" class="btn-outline-dark">Back to Dashboard</a>
            </div>

        </form>

    </div>
</section>

<?php require_once "includes/footer.php"; ?>
