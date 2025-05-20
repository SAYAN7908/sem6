<div class="admin-sidebar">
    <div class="admin-logo">
        <h2>Portfolio Admin</h2>
    </div>
    <nav class="admin-nav">
        <ul>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
            </li>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'active' : ''; ?>">
                <a href="projects.php"><i class="fas fa-project-diagram"></i> <span>Projects</span></a>
            </li>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'skills.php' ? 'active' : ''; ?>">
                <a href="skills.php"><i class="fas fa-code"></i> <span>Skills</span></a>
            </li>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'messages.php' ? 'active' : ''; ?>">
                <a href="messages.php"><i class="fas fa-envelope"></i> <span>Messages</span>
                <?php if (getUnreadMessagesCount() > 0): ?>
                    <span class="badge"><?php echo getUnreadMessagesCount(); ?></span>
                <?php endif; ?>
                </a>
            </li>
            <li>
                <a href="<?php echo BASE_URL; ?>" target="_blank"><i class="fas fa-eye"></i> <span>View Site</span></a>
            </li>
            <li>
                <a href="auth/logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
            </li>
        </ul>
    </nav>
</div>