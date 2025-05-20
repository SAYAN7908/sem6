<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'My Portfolio'; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/images/favicon.ico">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    
    <!-- Page-specific CSS -->
    <?php if (isset($pageCSS)): ?>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/<?php echo $pageCSS; ?>">
    <?php endif; ?>
</head>
<body>
    <!-- Navigation -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="<?php echo BASE_URL; ?>" class="logo">
                    <span>Portfolio</span>
                </a>
                
                <div class="nav-links">
                    <a href="<?php echo BASE_URL; ?>" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a>
                    <a href="<?php echo BASE_URL; ?>about.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About</a>
                    <a href="<?php echo BASE_URL; ?>projects.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'active' : ''; ?>">Projects</a>
                    <a href="<?php echo BASE_URL; ?>contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a>
                    
                    <?php if (isLoggedIn()): ?>
                        <a href="<?php echo ADMIN_URL; ?>" class="admin-link">Admin</a>
                    <?php endif; ?>
                </div>
                
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>
    
    <main>