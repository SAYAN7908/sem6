<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = "Home - My Portfolio";
$pageCSS = "home.css";
$pageJS = "home.js";

require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
                <h1>Hi, I'm <span class="typed-text"></span></h1>
                <p class="subtitle">Web Developer & Designer</p>
                <p>I create beautiful, functional websites and applications with a focus on user experience and clean code.</p>
                <div class="hero-buttons">
                    <a href="#projects" class="btn btn-primary">View My Work</a>
                    <a href="#contact" class="btn btn-secondary">Contact Me</a>
                </div>
            </div>
            <div class="hero-image" data-aos="fade-left">
                <img src="<?php echo BASE_URL; ?>assets/images/hero-image.png" alt="Developer Illustration">
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" id="about">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">About Me</h2>
        <div class="about-content">
            <div class="about-image" data-aos="fade-right">
                <img src="<?php echo BASE_URL; ?>assets/images/profile.jpg" alt="Profile Picture">
            </div>
            <div class="about-text" data-aos="fade-left">
                <h3>Who am I?</h3>
                <p>I'm a passionate web developer with over 1 years of experience in creating modern, responsive websites and web applications. I specialize in front-end development but also have strong back-end skills.</p>
                
                <div class="about-info">
                    <div class="info-item">
                        <span>Name:</span>
                        <p>SAYAN ROY</p>
                    </div>
                    <div class="info-item">
                        <span>Email:</span>
                        <p>example@example.com</p>
                    </div>
                    <div class="info-item">
                        <span>Experience:</span>
                        <p>1+ Years</p>
                    </div>
                    <div class="info-item">
                        <span>Location:</span>
                        <p>KOLKATA,WEST BENGAL</p>
                    </div>
                </div>
                
                <a href="about.php" class="btn btn-primary">More About Me</a>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="skills-section" id="skills">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">My Skills</h2>
        
        <div class="skills-container">
            <?php
            $skills = getAllSkills();
            $categories = array_unique(array_column($skills, 'category'));
            
            foreach ($categories as $category):
                $categorySkills = array_filter($skills, function($skill) use ($category) {
                    return $skill['category'] == $category;
                });
            ?>
                <div class="skill-category" data-aos="fade-up">
                    <h3><?php echo htmlspecialchars($category); ?></h3>
                    <div class="skills-list">
                        <?php foreach ($categorySkills as $skill): ?>
                            <div class="skill-item">
                                <div class="skill-info">
                                    <span class="skill-name"><?php echo htmlspecialchars($skill['name']); ?></span>
                                    <span class="skill-percent"><?php echo $skill['percentage']; ?>%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-progress" style="width: <?php echo $skill['percentage']; ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="projects-section" id="projects">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Featured Projects</h2>
        
        <div class="projects-grid">
            <?php
            $projects = getRecentProjects(6);
            foreach ($projects as $project):
            ?>
                <div class="project-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-image">
                        <img src="<?php echo BASE_URL . UPLOAD_DIR . htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                        <div class="project-overlay">
                            <div class="project-links">
                                <?php if ($project['link']): ?>
                                    <a href="<?php echo htmlspecialchars($project['link']); ?>" target="_blank" class="project-link"><i class="fas fa-external-link-alt"></i></a>
                                <?php endif; ?>
                                <?php if ($project['github']): ?>
                                    <a href="<?php echo htmlspecialchars($project['github']); ?>" target="_blank" class="project-link"><i class="fab fa-github"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="project-info">
                        <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                        <p><?php echo htmlspecialchars(substr($project['description'], 0, 100) . '...'); ?></p>
                        <a href="projects.php#project-<?php echo $project['id']; ?>" class="btn btn-small">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="section-cta" data-aos="fade-up">
            <a href="projects.php" class="btn btn-primary">View All Projects</a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section" id="contact">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Get In Touch</h2>
        
        <div class="contact-content">
            <div class="contact-info" data-aos="fade-right">
                <h3>Contact Information</h3>
                <p>Feel free to reach out to me for any questions or opportunities. I'll get back to you as soon as possible.</p>
                
                <div class="info-items">
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p>example@example.com</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p>+1 (123) 456-7890</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Location</h4>
                            <p>KOLKATA , WEST BENGAL</p>
                        </div>
                    </div>
                </div>
                
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <div class="contact-form" data-aos="fade-left">
                <form action="contact.php" method="POST" id="contactForm">
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" id="message" placeholder="Your Message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
<script src="js/main.js"></script>