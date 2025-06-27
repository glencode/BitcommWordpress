/**
 * Logo Position Fix - Direct JavaScript approach
 * This script directly modifies the logo positioning to ensure it works
 * regardless of theme structure or CSS specificity issues.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Find the logo element using multiple possible selectors
    const logoElements = document.querySelectorAll('.site-logo, .custom-logo-link, .navbar-brand, a:has(img.custom-logo)');
    
    if (logoElements.length > 0) {
        logoElements.forEach(function(logo) {
            // Apply rounded corners only
            logo.style.borderRadius = '8px';
            logo.style.overflow = 'hidden';
        });
    }
    
    // Handle any images inside the logo container
    const logoImages = document.querySelectorAll('.custom-logo, .site-logo img');
    if (logoImages.length > 0) {
        logoImages.forEach(function(img) {
            img.style.borderRadius = '8px';
        });
    }
});
