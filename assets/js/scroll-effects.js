/**
 * Scroll Effects & Animations for IT Company Website
 * 
 * This script handles various scroll-based animations including:
 * - Fade in elements on scroll
 * - Slide in from left/right
 * - Scale in elements
 * - Staggered animations for lists
 * - Parallax effects
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize scroll animations
    initScrollAnimations();
    
    // Handle navbar transparency
    handleNavbarTransparency();
    
    // Add parallax effect to sections with .parallax-bg class
    initParallaxEffect();
    
    // Setup smooth scrolling for all anchor links
    setupSmoothScrolling();
});

/**
 * Initialize scroll animations by adding scroll event listeners
 * and triggering initial check
 */
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll(
        '.fade-in-scroll, .scale-in-scroll, .slide-in-right, .slide-in-left, .stagger-in'
    );
    
    if (animatedElements.length === 0) return;
    
    // Check elements visibility on scroll
    const checkVisibility = function() {
        animatedElements.forEach(element => {
            if (isElementInViewport(element)) {
                element.classList.add('visible');
            }
        });
    };
    
    // Check on scroll
    window.addEventListener('scroll', checkVisibility);
    
    // Check on resize
    window.addEventListener('resize', checkVisibility);
    
    // Initial check
    checkVisibility();
}

/**
 * Makes navbar transparent at top and solid on scroll
 */
function handleNavbarTransparency() {
    const navbar = document.querySelector('.site-header');
    if (!navbar) return;
    
    // Add initial classes
    navbar.classList.add('navbar-transparent');
    
    // Update navbar style based on scroll position
    const updateNavbarStyle = function() {
        if (window.scrollY > 50) {
            navbar.classList.remove('navbar-transparent');
            navbar.classList.add('navbar-solid');
        } else {
            navbar.classList.add('navbar-transparent');
            navbar.classList.remove('navbar-solid');
        }
    };
    
    // Listen for scroll
    window.addEventListener('scroll', updateNavbarStyle);
    
    // Initial check
    updateNavbarStyle();
}

/**
 * Initialize parallax effect for elements with .parallax-bg class
 */
function initParallaxEffect() {
    const parallaxElements = document.querySelectorAll('.parallax-bg');
    if (parallaxElements.length === 0) return;
    
    const moveParallax = function() {
        const scrolled = window.scrollY;
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            element.style.backgroundPositionY = -(scrolled * speed) + 'px';
        });
    };
    
    window.addEventListener('scroll', moveParallax);
}

/**
 * Check if element is in viewport
 * @param {HTMLElement} element - Element to check
 * @returns {boolean} - True if element is in viewport
 */
function isElementInViewport(element) {
    const rect = element.getBoundingClientRect();
    const offset = 100; // Start animation slightly before element enters viewport
    
    return (
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) - offset &&
        rect.bottom >= 0 &&
        rect.left <= (window.innerWidth || document.documentElement.clientWidth) &&
        rect.right >= 0
    );
}

/**
 * Set up smooth scrolling for all anchor links
 */
function setupSmoothScrolling() {
    // Get all links with hash (#) in them
    const anchorLinks = document.querySelectorAll('a[href*="#"]');
    
    anchorLinks.forEach(link => {
        // Skip links that don't actually link to anything or are just #
        if (link.getAttribute('href') === '#' || !link.getAttribute('href').includes('#')) return;
        
        link.addEventListener('click', function(e) {
            // Get the target section ID from the href
            const href = this.getAttribute('href');
            let targetId;
            
            // Handle both absolute and relative URLs with hash
            if (href.includes('#')) {
                targetId = href.substring(href.indexOf('#'));
            } else {
                return; // Not a hash link
            }
            
            // If it's just # or empty, don't do anything
            if (targetId === '#' || !targetId) return;
            
            // Find the target element
            const targetElement = document.querySelector(targetId);
            
            // If target element exists, scroll to it
            if (targetElement) {
                e.preventDefault();
                
                // Get header height for offset
                const headerHeight = document.querySelector('.site-header') ? 
                    document.querySelector('.site-header').offsetHeight : 0;
                
                // Calculate position
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerHeight - 20; // Extra 20px buffer
                
                // Smooth scroll
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
                
                // Update URL hash without scrolling
                history.pushState(null, null, targetId);
            }
        });
    });
}

// Removed the setupMobileQAP function as we no longer need the floating toggle button
