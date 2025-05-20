<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

if (!isLoggedIn()) {
    redirect('auth/login.php');
}

$pageTitle = "Admin Dashboard";
$unreadCount = getUnreadMessagesCount();
$recentMessages = getMessages(5);
$recentProjects = getRecentProjects(3);

require_once __DIR__ . '/../includes/admin-header.php';
?>

<div class="admin-header">
    <h1>Dashboard</h1>
    <div class="welcome-message">
        Welcome back, <?php echo $_SESSION['username']; ?>!
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card" data-aos="fade-up">
        <div class="stat-icon">
            <i class="fas fa-project-diagram"></i>
        </div>
        <div class="stat-info">
            <h3>Total Projects</h3>
            <p><?php echo count(getAllProjects()); ?></p>
        </div>
    </div>
    
    <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-icon">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="stat-info">
            <h3>Unread Messages</h3>
            <p><?php echo $unreadCount; ?></p>
        </div>
    </div>
    
    <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-icon">
            <i class="fas fa-code"></i>
        </div>
        <div class="stat-info">
            <h3>Skills Listed</h3>
            <p><?php echo count(getAllSkills()); ?></p>
        </div>
    </div>
</div>

<div class="dashboard-sections">
    <div class="dashboard-section" data-aos="fade-up">
        <div class="section-header">
            <h2>Recent Messages</h2>
            <a href="messages.php" class="btn btn-small">View All</a>
        </div>
        <div class="messages-list">
            <?php if (empty($recentMessages)): ?>
                <p>No recent messages</p>
            <?php else: ?>
                <?php foreach ($recentMessages as $message): ?>
                    <div class="message-item <?php echo !$message['is_read'] ? 'unread' : ''; ?>" data-id="<?php echo $message['id']; ?>">
                        <div class="message-header">
                            <h4><?php echo htmlspecialchars($message['name']); ?></h4>
                            <span class="message-date"><?php echo date('M j, Y', strtotime($message['created_at'])); ?></span>
                        </div>
                        <p class="message-preview"><?php echo htmlspecialchars(substr($message['message'], 0, 100) . '...'); ?></p>
                        <a href="messages.php?view=<?php echo $message['id']; ?>" class="btn btn-small">View Message</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="dashboard-section" data-aos="fade-up" data-aos-delay="100">
        <div class="section-header">
            <h2>Recent Projects</h2>
            <a href="projects.php" class="btn btn-small">View All</a>
        </div>
        <div class="projects-list">
            <?php if (empty($recentProjects)): ?>
                <p>No recent projects</p>
            <?php else: ?>
                <?php foreach ($recentProjects as $project): ?>
                    <div class="project-item">
                        <div class="project-image">
                            <img src="<?php echo BASE_URL . UPLOAD_DIR . htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                        </div>
                        <div class="project-info">
                            <h4><?php echo htmlspecialchars($project['title']); ?></h4>
                            <p><?php echo htmlspecialchars(substr($project['description'], 0, 50) . '...'); ?></p>
                            <a href="projects.php?edit=<?php echo $project['id']; ?>" class="btn btn-small">Edit</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/admin-footer.php'; ?>