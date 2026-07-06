<?php
require_once "includes/data.php";
require_once "includes/auth.php";

$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = isset($pageTitle) ? $pageTitle : "Admin Panel | Travel Sri Lanka";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo e($pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<header class="navbar admin-navbar">
    <a href="admin-dashboard.php" class="logo">Travel<span>LK</span> Admin</a>

    <button class="menu-btn" id="menuBtn" type="button" aria-label="Open menu">
        <i class="fa-solid fa-bars"></i>
    </button>

    <nav class="nav-links" id="navLinks">
        <a href="index.php">View Website</a>
        <a href="admin-dashboard.php" class="<?php echo $currentPage == 'admin-dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
        <a href="admin-upload.php" class="<?php echo $currentPage == 'admin-upload.php' ? 'active' : ''; ?>">Upload Images</a>
        <a href="gallery.php">Public Gallery</a>
        <a href="admin-logout.php">Logout</a>
    </nav>
</header>
