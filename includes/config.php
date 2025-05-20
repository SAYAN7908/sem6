<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session start
session_start();

// Base URL
define('BASE_URL', 'http://localhost/portfolio/');
define('ADMIN_URL', BASE_URL . 'admin/');

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio_db');

// File upload settings
define('UPLOAD_DIR', 'assets/uploads/');
define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024); // 2MB
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);

// Admin credentials (for first-time setup)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'password123'); // Change this before production
?>