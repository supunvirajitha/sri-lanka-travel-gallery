<?php
require_once "includes/data.php";

$pageTitle = "Contact | Travel Sri Lanka";
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $destination = isset($_POST["destination"]) ? trim($_POST["destination"]) : "";
    $message = isset($_POST["message"]) ? trim($_POST["message"]) : "";

    if ($name === "" || $email === "" || $message === "") {
        $error = "Please fill all required fields.";
    } else {
        $success = "Thank you, " . e($name) . "! Your message has been submitted successfully.";
    }
}

require_once "includes/header.php";
?>

<section class="page-hero contact-hero">
    <div class="page-hero-content reveal">
        <h1>Contact Us</h1>
        <p>Send us a message to plan your Sri Lanka journey.</p>
    </div>
</section>

<section class="section contact-section">
    <div class="contact-grid">
        <div class="contact-info reveal">
            <p class="section-subtitle">Get in touch</p>
            <h2>Plan Your Next Trip</h2>

            <p>
                Have a place you want to visit? Send us your details and destination.
                We will help you plan your Sri Lanka travel experience.
            </p>

            <div class="contact-box">
                <i class="fa-solid fa-phone"></i>
                <div>
                    <h3>Phone</h3>
                    <p>+94 76 125 8270</p>
                </div>
            </div>

            <div class="contact-box">
                <i class="fa-solid fa-envelope"></i>
                <div>
                    <h3>Email</h3>
                    <p>supunvirajith21@gmail.com</p>
                </div>
            </div>

            <div class="contact-box">
                <i class="fa-solid fa-location-dot"></i>
                <div>
                    <h3>Location</h3>
                    <p>Colombo, Sri Lanka</p>
                </div>
            </div>
        </div>

        <form method="POST" class="contact-form reveal">
            <?php if ($success): ?>
                <div class="alert success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert error"><?php echo e($error); ?></div>
            <?php endif; ?>

            <div class="input-group">
                <label>Your Name *</label>
                <input type="text" name="name" placeholder="Enter your name">
            </div>

            <div class="input-group">
                <label>Email Address *</label>
                <input type="email" name="email" placeholder="Enter your email">
            </div>

            <div class="input-group">
                <label>Destination</label>
                <select name="destination">
                    <option value="">Select destination</option>
                    <?php foreach ($places as $place): ?>
                        <option value="<?php echo e($place['name']); ?>">
                            <?php echo e($place['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label>Message *</label>
                <textarea name="message" rows="6" placeholder="Write your message"></textarea>
            </div>

            <button type="submit" class="btn form-btn">Send Message</button>
        </form>
    </div>
</section>

<?php require_once "includes/footer.php"; ?>
