<?php
/**
 * Template Name: Contact Page
 */

get_header(); ?>

<?php itsulu_breadcrumbs(); ?>

<!-- Hero Section -->
<section class="contact-hero-section py-4 position-relative overflow-hidden">
    <div class="hero-bg-gradient"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center mx-auto">
                <h1 class="text-white mb-3">Get In Touch With Our Experts</h1>
                <p class="lead text-white-50 mb-0">
                    We're here to help you with your IT needs and answer any questions about our services and solutions. Reach out today to start your digital transformation journey.
                </p>
            </div>
            <div class="col-lg-4 d-none d-lg-block px-0">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/contact.jpg'); ?>" 
                     alt="Contact Us" 
                     class="img-fluid rounded-lg shadow-lg w-100"
                     style="max-height: 220px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<style>
.contact-hero-section {
    background: linear-gradient(135deg, #2C1D6D 0%, #3D2E8F 100%);
    min-height: 30vh;
    display: flex;
    align-items: center;
    padding: 60px 0;
}

.hero-bg-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at top right, rgba(104, 11, 234, 0.2) 0%, transparent 50%),
                radial-gradient(circle at bottom left, rgba(44, 29, 109, 0.2) 0%, transparent 50%);
    z-index: 1;
}

.contact-hero-section .container {
    z-index: 2;
}
</style>

<section class="contact-form-section py-5">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center">
        <h2 class="section-title">How Can We Help You?</h2>
        <p class="section-subtitle">Fill out the form below and one of our representatives will get back to you within 24 hours.</p>
      </div>
    </div>
    
    <div class="row g-4">
      <!-- Contact Form -->
      <div class="col-lg-7 mb-4 mb-lg-0">
        <div class="card border-0 shadow-sm rounded-3 p-4">
          <div class="card-body">
            <?php echo do_shortcode('[contact-form-7 id="55946b8" title="Contact form 1"]'); ?>
          </div>
        </div>
      </div>
      
      <!-- Contact Info -->
      <div class="col-lg-5">
        <div class="contact-info bg-light p-4 rounded-3 shadow-sm mb-4">
          <h3 class="h4 mb-4">Contact Information</h3>
          
          <div class="info-item d-flex align-items-start mb-4">
            <div class="info-icon me-3">
              <i class="fas fa-phone-alt text-primary"></i>
            </div>
            <div class="info-content">
              <h4 class="h6 mb-1">Phone</h4>
              <p class="mb-0"><a href="tel:+254 738 788010" class="text-dark">+254 738 788010</a></p>
            </div>
          </div>
          
          <div class="info-item d-flex align-items-start mb-4">
            <div class="info-icon me-3">
              <i class="fas fa-envelope text-primary"></i>
            </div>
            <div class="info-content">
              <h4 class="h6 mb-1">Email</h4>
              <p class="mb-0"><a href="mailto:kennedychongwobitcomm@gmail.com" class="text-dark">kennedychongwobitcomm@gmail.com</a></p>
            </div>
          </div>
          
          <div class="info-item d-flex align-items-start mb-4">
            <div class="info-icon me-3">
              <i class="fas fa-map-marker-alt text-primary"></i>
            </div>
            <div class="info-content">
              <h4 class="h6 mb-1">Office Location</h4>
              <p class="mb-0">Nairobi, Kenya</p>
            </div>
          </div>
          
          <div class="info-item d-flex align-items-start">
            <div class="info-icon me-3">
              <i class="fas fa-clock text-primary"></i>
            </div>
            <div class="info-content">
              <h4 class="h6 mb-1">Business Hours</h4>
              <p class="mb-0">Monday - Friday: 8:00 AM - 5:00 PM</p>
              <p class="mb-0">Saturday & Sunday: Closed</p>
            </div>
          </div>
        </div>
        
        <!-- Social Media -->
        <div class="social-connect bg-white p-4 rounded-3 shadow-sm">
          <h3 class="h4 mb-3">Connect With Us</h3>
          <p class="mb-3">Follow us on social media to stay updated with our latest news and solutions.</p>
          <div class="social-links">
            <a href="#" class="btn btn-outline-primary me-2 mb-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-outline-primary me-2 mb-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="btn btn-outline-primary me-2 mb-2"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="btn btn-outline-primary me-2 mb-2"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Map Section -->
<section class="map-section">
  <div class="container-fluid px-0">
    <div class="map-responsive">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255282.35853942854!2d36.68258374671874!3d-1.3028617999999864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1172d84d49a7%3A0xf7cf0254b297924c!2sNairobi%2C%20Kenya!5e0!3m2!1sen!2sus!4v1656832448389!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" title="Google Maps showing Nairobi, Kenya location"></iframe>
    </div>
  </div>
</section>

<style>
/* Contact Form Styles */
.contact-form-section .form-control {
    padding: 12px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.contact-form-section .form-control:focus {
    border-color: #2C1D6D;
    box-shadow: 0 0 0 0.25rem rgba(44, 29, 109, 0.1);
}

.wpcf7-submit {
    background-color: #2C1D6D;
    color: white;
    border: none;
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 500;
    transition: all 0.3s ease;
    width: auto;
}

.wpcf7-submit:hover {
    background-color: #3D2E8F;
    transform: translateY(-2px);
}

/* Info Styles */
.info-icon {
    width: 40px;
    height: 40px;
    background-color: rgba(44, 29, 109, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.info-icon i {
    color: #2C1D6D;
    font-size: 1.2rem;
}

.social-links .btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-links .btn:hover {
    background-color: #2C1D6D;
    color: white;
    transform: translateY(-2px);
}

.section-title {
    position: relative;
    color: #2C1D6D;
    margin-bottom: 1rem;
    font-weight: 600;
}

.section-title:after {
    content: '';
    display: block;
    width: 50px;
    height: 3px;
    background: #3D2E8F;
    margin: 15px auto 0;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
}
</style>

<script>
jQuery(document).ready(function($) {
    // Clear messages when form is reset or new submission starts
    $('.wpcf7-form').on('wpcf7:reset wpcf7:submit', function() {
        $('.wpcf7-response-output').hide();
    });
    
    // Smooth scroll to form from hero CTA
    $('.scroll-to-form').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('.contact-form-section').offset().top - 100
        }, 800);
    });
});
</script>

<?php get_footer(); ?>
