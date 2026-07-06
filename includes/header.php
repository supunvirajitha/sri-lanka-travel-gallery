<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = isset($pageTitle) ? $pageTitle : "Travel Sri Lanka";
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

<header class="navbar">
    <a href="index.php" class="logo">Travel<span>LK</span></a>

    <button class="menu-btn" id="menuBtn" type="button" aria-label="Open menu">
        <i class="fa-solid fa-bars"></i>
    </button>

    <nav class="nav-links" id="navLinks">
        <a href="index.php" class="<?php echo $currentPage == 'index.php' ? 'active' : ''; ?>">Home</a>
        <a href="places.php" class="<?php echo $currentPage == 'places.php' ? 'active' : ''; ?>">Places</a>
        <a href="gallery.php" class="<?php echo $currentPage == 'gallery.php' ? 'active' : ''; ?>">Gallery</a>
        <a href="about.php" class="<?php echo $currentPage == 'about.php' ? 'active' : ''; ?>">About</a>
        <a href="contact.php" class="<?php echo $currentPage == 'contact.php' ? 'active' : ''; ?>">Contact</a>
        <a href="admin-login.php" class="<?php echo $currentPage == 'admin-login.php' ? 'active' : ''; ?>">Admin</a>
    </nav>
</header>
