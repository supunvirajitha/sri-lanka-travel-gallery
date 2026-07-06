<?php
require_once "includes/data.php";
require_once "includes/auth.php";

if (is_admin_logged_in()) {
    header("Location: admin-dashboard.php");
    exit;
}

$pageTitle = "Admin Login | Travel Sri Lanka";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_username"] = $username;

        header("Location: admin-dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}

require_once "includes/header.php";
?>

<section class="page-hero admin-login-hero">
    <div class="page-hero-content reveal">
        <h1>Admin Login</h1>
        <p>Only admin can upload and manage travel images.</p>
    </div>
</section>

<section class="section admin-login-section">
    <form method="POST" class="contact-form admin-login-form reveal">

        <?php if ($error): ?>
            <div class="alert error"><?php echo e($error); ?></div>
        <?php endif; ?>

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter admin username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter admin password" required>
        </div>

        <button type="submit" class="btn form-btn">Login</button>

        <div class="admin-demo-box">
            <p><strong>Default Admin:</strong></p>
            <p>Username: <code>admin</code></p>
            <p>Password: <code>admin123</code></p>
        </div>

    </form>
</section>

<?php require_once "includes/footer.php"; ?>
