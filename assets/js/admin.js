document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle for admin
    const mobileToggle = document.createElement('div');
    mobileToggle.className = 'mobile-menu-toggle';
    mobileToggle.innerHTML = '<i class="fas fa-bars"></i>';
    document.body.appendChild(mobileToggle);
    
    const adminSidebar = document.querySelector('.admin-sidebar');
    
    mobileToggle.addEventListener('click', function() {
        adminSidebar.classList.toggle('active');
    });
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768 && !e.target.closest('.admin-sidebar') && !e.target.closest('.mobile-menu-toggle')) {
            adminSidebar.classList.remove('active');
        }
    });
    
    // Prevent closing when clicking inside sidebar
    adminSidebar.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Table row actions
    document.querySelectorAll('.admin-table tr').forEach(row => {
        row.addEventListener('click', function(e) {
            if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON') return;
            
            const link = this.querySelector('a');
            if (link) {
                window.location.href = link.href;
            }
        });
    });
    
    // Confirm before delete
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });
    
    // Toggle unread messages
    document.querySelectorAll('.message-item.unread').forEach(item => {
        item.addEventListener('click', function() {
            const messageId = this.getAttribute('data-id');
            if (messageId) {
                fetch(`api/mark_as_read.php?id=${messageId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.remove('unread');
                        }
                    });
            }
        });
    });
    
    // Form validation
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            let valid = true;
            
            this.querySelectorAll('[required]').forEach(input => {
                if (!input.value.trim()) {
                    input.style.borderColor = 'var(--danger-color)';
                    valid = false;
                } else {
                    input.style.borderColor = '';
                }
            });
            
            if (!valid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    });
    
    // Image preview for file inputs
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = input.closest('.form-group').querySelector('.image-preview');
                    if (!preview) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'image-preview';
                        previewDiv.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 200px; margin-top: 10px;">`;
                        input.closest('.form-group').appendChild(previewDiv);
                    } else {
                        preview.querySelector('img').src = e.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    });
});