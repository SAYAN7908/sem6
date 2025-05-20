document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    
    hamburger.addEventListener('click', function() {
        this.classList.toggle('active');
        navLinks.classList.toggle('active');
    });
    
    // Close mobile menu when clicking a link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            navLinks.classList.remove('active');
        });
    });
    
    // Sticky header on scroll
    const header = document.querySelector('.header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // Back to top button
    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTop.classList.add('active');
        } else {
            backToTop.classList.remove('active');
        }
    });
    
    backToTop.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Typed.js animation for hero section
    if (document.querySelector('.typed-text')) {
        const typed = new Typed('.typed-text', {
            strings: ['SAYAN ROY', 'laxmikanta', 'meheboob', 'piu'],
            typeSpeed: 100,
            backSpeed: 60,
            loop: true
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Filter projects
    if (document.querySelector('.filter-buttons')) {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const projectItems = document.querySelectorAll('.project-masonry-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const filterValue = this.getAttribute('data-filter');
                
                // Filter projects
                projectItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }
    
    // Project modal
    if (document.querySelector('.project-modal')) {
        const modal = document.querySelector('.project-modal');
        const projectItems = document.querySelectorAll('.project-masonry-item');
        const closeModal = document.querySelector('.close-modal');
        
        projectItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                const projectId = this.getAttribute('id').replace('project-', '');
                
                // Load project details via AJAX
                fetch(`api/get_project.php?id=${projectId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const project = data.project;
                            const modalBody = document.querySelector('.modal-body');
                            
                            modalBody.innerHTML = `
                                <div class="project-detail">
                                    <div class="project-image">
                                        <img src="${BASE_URL}${UPLOAD_DIR}${project.image}" alt="${project.title}">
                                    </div>
                                    <div class="project-info">
                                        <h3>${project.title}</h3>
                                        <p>${project.description}</p>
                                        <div class="project-meta">
                                            ${project.link ? `<a href="${project.link}" target="_blank" class="btn btn-primary">View Project</a>` : ''}
                                            ${project.github ? `<a href="${project.github}" target="_blank" class="btn btn-secondary">GitHub</a>` : ''}
                                        </div>
                                    </div>
                                </div>
                            `;
                            
                            modal.style.display = 'block';
                            document.body.style.overflow = 'hidden';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
        
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
        
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }
    
    // Animate skill bars on scroll
    if (document.querySelector('.skill-progress')) {
        const skillBars = document.querySelectorAll('.skill-progress');
        
        function animateSkills() {
            skillBars.forEach(bar => {
                const percent = bar.style.width;
                bar.style.width = '0';
                
                setTimeout(() => {
                    bar.style.width = percent;
                }, 100);
            });
        }
        
        // Intersection Observer for skill bars
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateSkills();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        document.querySelectorAll('.skill-item').forEach(item => {
            observer.observe(item);
        });
    }
});
// Testimonials Slider
function initTestimonialSlider() {
    const slider = document.querySelector('.testimonials-slider');
    if (!slider) return;

    const testimonials = slider.querySelectorAll('.testimonial-item');
    const dotsContainer = document.createElement('div');
    dotsContainer.className = 'slider-nav';
    
    // Create navigation dots
    testimonials.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.className = 'slider-dot';
        dot.dataset.index = index;
        dotsContainer.appendChild(dot);
    });
    
    slider.appendChild(dotsContainer);
    const dots = dotsContainer.querySelectorAll('.slider-dot');

    let currentIndex = 0;
    
    // Show initial testimonial
    showTestimonial(currentIndex);

    // Auto-rotate testimonials
    let interval = setInterval(() => {
        currentIndex = (currentIndex + 1) % testimonials.length;
        showTestimonial(currentIndex);
    }, 5000); // Change every 5 seconds

    // Dot click event
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            clearInterval(interval);
            currentIndex = parseInt(dot.dataset.index);
            showTestimonial(currentIndex);
            
            // Restart auto-rotation
            interval = setInterval(() => {
                currentIndex = (currentIndex + 1) % testimonials.length;
                showTestimonial(currentIndex);
            }, 5000);
        });
    });

    function showTestimonial(index) {
        testimonials.forEach(testimonial => testimonial.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        testimonials[index].classList.add('active');
        dots[index].classList.add('active');
    }
}

// Initialize slider when DOM is loaded
document.addEventListener('DOMContentLoaded', initTestimonialSlider);