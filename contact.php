<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $message = sanitizeInput($_POST['message']);
    
    $data = [
        'name' => $name,
        'email' => $email,
        'message' => $message
    ];
    
    $result = saveMessage($data);
    
    if (isset($result['success'])) {
        $successMessage = "Your message has been sent successfully! I'll get back to you soon.";
    } else {
        $errorMessage = "There was an error sending your message. Please try again.";
    }
}

$pageTitle = "Contact Me - Portfolio";
$pageCSS = "contact.css";
$pageJS = "contact.js";

require_once 'includes/header.php';
?>

<!-- Contact Hero Section -->
<section class="contact-hero">
    <div class="container">
        <h1 data-aos="fade-up">Contact <span>Me</span></h1>
        <p class="subtitle" data-aos="fade-up" data-aos-delay="100">Let's work together</p>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container">
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success" data-aos="fade-up">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-error" data-aos="fade-up">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        
        <div class="contact-form-container" data-aos="fade-up">
            <h2>Send Me a Message</h2>
            <form action="contact.php" method="POST" id="contactForm">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject">
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea name="message" id="message" rows="6" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <div class="map-container" data-aos="fade-up">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.538962143584!2d-122.4194155846826!3d37.77492997975938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan%20Francisco%2C%20CA%2C%20USA!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>