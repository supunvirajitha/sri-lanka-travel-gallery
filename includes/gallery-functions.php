<?php

function gallery_json_path() {
    return __DIR__ . "/../storage/gallery.json";
}

function gallery_upload_dir() {
    return __DIR__ . "/../uploads/travel/";
}

function gallery_upload_public_path($filename) {
    return "uploads/travel/" . $filename;
}

function ensure_gallery_storage() {
    $storageDir = __DIR__ . "/../storage";
    $uploadDir = gallery_upload_dir();
    $jsonFile = gallery_json_path();

    if (!is_dir($storageDir)) {
        mkdir($storageDir, 0777, true);
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!file_exists($jsonFile)) {
        file_put_contents($jsonFile, "[]");
    }
}

function load_gallery_items() {
    ensure_gallery_storage();

    $file = gallery_json_path();
    $json = file_get_contents($file);
    $items = json_decode($json, true);

    if (!is_array($items)) {
        return array();
    }

    return $items;
}

function save_gallery_items($items) {
    ensure_gallery_storage();

    $file = gallery_json_path();
    file_put_contents($file, json_encode($items, JSON_PRETTY_PRINT));
}

function clean_gallery_text($value) {
    return trim(strip_tags((string)$value));
}

function upload_gallery_image($file, $placeId, $title, $description) {
    $allowedExtensions = array("jpg", "jpeg", "png", "webp", "gif");
    $maxSize = 5 * 1024 * 1024;

    if (!isset($file) || !isset($file["error"]) || $file["error"] !== UPLOAD_ERR_OK) {
        return array(
            "success" => false,
            "message" => "Image upload failed."
        );
    }

    if ($file["size"] > $maxSize) {
        return array(
            "success" => false,
            "message" => "Image is too large. Maximum size is 5MB."
        );
    }

    $originalName = $file["name"];
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($extension, $allowedExtensions)) {
        return array(
            "success" => false,
            "message" => "Only JPG, JPEG, PNG, WEBP, and GIF images are allowed."
        );
    }

    $uploadDir = gallery_upload_dir();

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $newFileName = "travel_" . time() . "_" . mt_rand(1000, 9999) . "." . $extension;
    $targetPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($file["tmp_name"], $targetPath)) {
        return array(
            "success" => false,
            "message" => "Could not save uploaded image. Check folder permission for uploads/travel."
        );
    }

    $items = load_gallery_items();

    $items[] = array(
        "id" => uniqid("img_"),
        "place_id" => clean_gallery_text($placeId),
        "title" => clean_gallery_text($title),
        "description" => clean_gallery_text($description),
        "image" => gallery_upload_public_path($newFileName),
        "uploaded_at" => date("Y-m-d H:i:s")
    );

    save_gallery_items($items);

    return array(
        "success" => true,
        "message" => "Image uploaded successfully."
    );
}

function get_uploaded_images_by_place($placeId, $limit) {
    $items = load_gallery_items();
    $filtered = array();

    foreach ($items as $item) {
        if (isset($item["place_id"]) && $item["place_id"] === $placeId) {
            $filtered[] = $item;
        }
    }

    usort($filtered, function($a, $b) {
        return strtotime($b["uploaded_at"]) - strtotime($a["uploaded_at"]);
    });

    if ($limit > 0) {
        return array_slice($filtered, 0, $limit);
    }

    return $filtered;
}

function get_all_uploaded_images() {
    $items = load_gallery_items();

    usort($items, function($a, $b) {
        return strtotime($b["uploaded_at"]) - strtotime($a["uploaded_at"]);
    });

    return $items;
}


function delete_gallery_image_by_id($imageId) {
    $items = load_gallery_items();
    $newItems = array();
    $found = false;
    $imagePathToDelete = "";

    foreach ($items as $item) {
        if (isset($item["id"]) && $item["id"] === $imageId) {
            $found = true;
            $imagePathToDelete = isset($item["image"]) ? $item["image"] : "";
            continue;
        }

        $newItems[] = $item;
    }

    if (!$found) {
        return array(
            "success" => false,
            "message" => "Image not found."
        );
    }

    save_gallery_items($newItems);

    if ($imagePathToDelete !== "") {
        $fullPath = __DIR__ . "/../" . $imagePathToDelete;

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    return array(
        "success" => true,
        "message" => "Image deleted successfully."
    );
}


function get_latest_uploaded_image_by_place($placeId) {
    $items = get_uploaded_images_by_place($placeId, 1);
    if (!empty($items) && isset($items[0]["image"])) {
        return $items[0]["image"];
    }
    return "";
}

function get_uploaded_cover_images($limit) {
    $items = get_all_uploaded_images();
    $images = array();
    foreach ($items as $item) {
        if (isset($item["image"]) && $item["image"] !== "") {
            $images[] = $item["image"];
        }
    }
    if ($limit > 0) {
        return array_slice($images, 0, $limit);
    }
    return $images;
}

?>
