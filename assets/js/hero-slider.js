document.addEventListener('DOMContentLoaded', function() {
    // Only log in development environments
    const isDev = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';
    
    if (isDev) console.log('Bare Bones Hero slider initializing...');
    
    const heroSliderElement = document.getElementById('heroSlider');
    if (!heroSliderElement) {
        // Hero slider not present on this page, exit silently
        return;
    }
    // Select new bare-bones slide class
    const slides = heroSliderElement.querySelectorAll('.hero-slide-bb'); 
    if (isDev) console.log('Number of Bare Bones slides found:', slides.length);
    
    if (slides.length === 0) {
        // No hero slides found, exit silently
        return;
    }
    
    let currentSlideBb = 0;

    function showSlideBb(indexToShow) {
        slides.forEach((slide, i) => {
            if (i === indexToShow) {
                slide.classList.add('hero-slide-bb-active'); // Add active class for CSS rules
                slide.classList.add('hero-slide-content-active'); // For content animation
            } else {
                slide.classList.remove('hero-slide-bb-active');
                slide.classList.remove('hero-slide-content-active'); // Remove for content animation
            }
        });
        currentSlideBb = indexToShow;
        if (isDev) console.log(`Showing Bare Bones slide ${currentSlideBb + 1}`);
    }

    function nextSlideLogicBb() {
        const newIndex = (currentSlideBb + 1) % slides.length;
        showSlideBb(newIndex);
    }

    if (slides.length > 0) {
        // Initialize first slide (it's already display:flex via inline style in HTML)
        // We just need to ensure others are hidden and the class is set for the first one.
        slides.forEach((slide, i) => {
            if (i === 0) {
                slide.classList.add('hero-slide-bb-active');
                slide.classList.add('hero-slide-content-active'); // Also for first slide's content
            } else {
                slide.classList.remove('hero-slide-bb-active');
                slide.classList.remove('hero-slide-content-active');
            }
        });
        currentSlideBb = 0; // Explicitly set for clarity
        if (isDev) console.log(`Initial Bare Bones slide ${currentSlideBb + 1} should be visible.`);

        const autoplayInterval = parseInt(heroSliderElement.dataset.autoplayInterval, 10) || 3000; // Faster for testing
        setInterval(nextSlideLogicBb, autoplayInterval);
    }
    
    // Scroll indicator logic can be ignored for this bare bones test
});