<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = "About Me - My Portfolio";
$pageCSS = "about.css";

require_once 'includes/header.php';
?>

<!-- About Hero Section -->
<section class="about-hero">
    <div class="container">
        <h1 data-aos="fade-up">About <span>Me</span></h1>
        <p class="subtitle" data-aos="fade-up" data-aos-delay="100">Get to know me better</p>
    </div>
</section>

<!-- About Details Section -->
<section class="about-details">
    <div class="container">
        <div class="about-row">
            <div class="about-col" data-aos="fade-right">
                <h2>Who am I?</h2>
                <p>I'm a passionate web developer with over 5 years of experience in creating modern, responsive websites and web applications. I specialize in front-end development but also have strong back-end skills.</p>
                <p>My journey in web development started when I was in college, and since then I've worked with various clients and companies to build digital solutions that solve real problems.</p>
                <p>When I'm not coding, you can find me hiking, reading tech blogs, or experimenting with new frameworks and technologies.</p>
            </div>
            <div class="about-col" data-aos="fade-left">
                <img src="<?php echo BASE_URL; ?>assets/images/about-image.jpg" alt="About Me">
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section class="experience-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">My Experience</h2>
        
        <div class="timeline" data-aos="fade-up">
            <div class="timeline-item">
                <div class="timeline-date">2025 - Present</div>
                <div class="timeline-content">
                    <h3>Senior Web Developer</h3>
                    <h4>Tech Solutions Inc.</h4>
                    <p>Lead a team of developers to build enterprise-level web applications. Implemented modern front-end frameworks and optimized performance.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">2023 - 2024</div>
                <div class="timeline-content">
                    <h3>Web Developer</h3>
                    <h4>Digital Agency</h4>
                    <p>Developed and maintained websites for various clients. Collaborated with designers to implement responsive layouts and interactive features.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">2022-2023</div>
                <div class="timeline-content">
                    <h3>Junior Developer</h3>
                    <h4>Startup Company</h4>
                    <p>Assisted in developing web applications and fixing bugs. Learned best practices in coding and version control.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Education Section -->
<section class="education-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Education</h2>
        
        <div class="education-grid">
            <div class="education-card" data-aos="fade-up">
                <div class="education-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>in future Master's in Computer application</h3>
                <h4> University | 2026 - future</h4>
                <p>Specialized in Human-Computer Interaction and Web Technologies.</p>
            </div>
            <div class="education-card" data-aos="fade-up" data-aos-delay="100">
                <div class="education-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Bachelor's in computer application</h3>
                <h4>MUALANA ABUL KALAM AZAD UNIVERCITY AND TECNOLOGY WEST BENGAL | 2010 - 2014</h4>
                <p>Graduated with honors. Focused on software development methodologies.</p>
            </div>
            <div class="education-card" data-aos="fade-up" data-aos-delay="200">
                <div class="education-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3>QA Manual and automation Testing Certifications</h3>
                <h4>Various Institutions | 2025 - Present</h4>
                <p>Completed multiple certifications in modern web technologies and frameworks.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">What People Say</h2>
        
        <div class="testimonials-slider" data-aos="fade-up">
            <div class="testimonial-item active"> <!-- Added active class here -->
                <div class="testimonial-content">
                    <p>"SAYAN is an exceptional developer who always delivers high-quality work on time. His attention to detail and problem-solving skills are outstanding."</p>
                </div>
                <div class="testimonial-author">
                    <img src="<?php echo BASE_URL; ?>assets/images/testimonial1.jpg" alt="Sarah Johnson">
                    <div>
                        <h4>Sarah Johnson</h4>
                        <p>CEO, Tech Solutions Inc.</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-content">
                    <p>"SAYAN is an exceptional developer who always delivers high-quality work on time. His attention to detail and problem-solving skills are outstanding."</p>
                </div>
                <div class="testimonial-author">
                    <img src="<?php echo BASE_URL; ?>assets/images/testimonial1.jpg" alt="Sarah Johnson">
                    <div>
                        <h4>SAYAN Johnson</h4>
                        <p>CEO, Tech Solutions Inc.</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-content">
                    <p>"Working with SAYAN was a pleasure. He understood our requirements perfectly and implemented them with creativity and technical excellence."</p>
                </div>
                <div class="testimonial-author">
                    <img src="<?php echo BASE_URL; ?>assets/images/testimonial2.jpg" alt="Michael Chen">
                    <div>
                        <h4>Michael Chen</h4>
                        <p>CTO, Digital Agency</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-content">
                    <p>"SAYAN's ability to translate complex requirements into elegant solutions is remarkable. He's a true professional and a great team player."</p>
                </div>
                <div class="testimonial-author">
                    <img src="<?php echo BASE_URL; ?>assets/images/testimonial3.jpg" alt="Emily Rodriguez">
                    <div>
                        <h4>Emily Rodriguez</h4>
                        <p>Product Manager, Startup Company</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>