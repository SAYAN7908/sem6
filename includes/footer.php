</main>
        
        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-about">
                        <h3>About Me</h3>
                        <p>A passionate developer creating modern web applications with clean code and user-friendly interfaces.</p>
                    </div>
                    
                    <div class="footer-links">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                            <li><a href="<?php echo BASE_URL; ?>about.php">About</a></li>
                            <li><a href="<?php echo BASE_URL; ?>projects.php">Projects</a></li>
                            <li><a href="<?php echo BASE_URL; ?>contact.php">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-social">
                        <h3>Connect With Me</h3>
                        <div class="social-icons">
                            <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p>&copy; <?php echo date('Y'); ?> My Portfolio. All rights reserved.</p>
                </div>
            </div>
        </footer>
        
        <!-- Back to Top Button -->
        <a href="#" class="back-to-top" id="backToTop">
            <i class="fas fa-arrow-up"></i>
        </a>
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
        
        <!-- Main JS -->
        <script src="<?php echo BASE_URL; ?>assets/js/main.js"></script>
        
        <!-- Page-specific JS -->
        <?php if (isset($pageJS)): ?>
            <script src="<?php echo BASE_URL; ?>assets/js/<?php echo $pageJS; ?>"></script>
        <?php endif; ?>
        
        <!-- Initialize AOS -->
        <script>
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        </script>
    </body>
</html>