<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = "My Projects - Portfolio";
$pageCSS = "projects.css";

require_once 'includes/header.php';
?>

<!-- Projects Hero Section -->
<section class="projects-hero">
    <div class="container">
        <h1 data-aos="fade-up">My <span>Projects</span></h1>
        <p class="subtitle" data-aos="fade-up" data-aos-delay="100">A showcase of my recent work</p>
    </div>
</section>

<!-- Projects Filter Section -->
<section class="projects-filter">
    <div class="container">
        <div class="filter-buttons" data-aos="fade-up">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="web">Web Development</button>
            <button class="filter-btn" data-filter="app">Mobile Apps</button>
            <button class="filter-btn" data-filter="design">UI/UX Design</button>
        </div>
    </div>
</section>

<!-- Projects Grid Section -->
<section class="projects-grid-section">
    <div class="container">
        <div class="projects-masonry">
            <?php
            $projects = getAllProjects();
            foreach ($projects as $project):
            ?>
                <div class="project-masonry-item" data-category="web" id="project-<?php echo $project['id']; ?>" data-aos="fade-up">
                    <div class="project-masonry-content">
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
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                            <div class="project-tags">
                                <span>HTML</span>
                                <span>CSS</span>
                                <span>JavaScript</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Project Modal -->
<div class="project-modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="modal-body">
            <!-- Content will be loaded via AJAX -->
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>