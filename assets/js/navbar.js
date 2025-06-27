document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar-dark');
    const heroSection = document.querySelector('.hero-section');
    
    function updateNavbar() {
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = '#2C1D6D';
            navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        } else {
            navbar.style.backgroundColor = 'transparent';
            navbar.style.boxShadow = 'none';
        }
    }

    window.addEventListener('scroll', updateNavbar);
    updateNavbar(); // Initial call
});
