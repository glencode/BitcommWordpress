<?php
/**
 * Template Name: Get Your Solution
 */

get_header();
?>

<div class="get-solution-page py-5">
    <div class="container">
        <div class="row">
            <!-- Main Form Section (3/4) -->
            <div class="col-lg-9">
                <div class="solution-form-section p-4 rounded-3 shadow-sm" style="background-color: #fff;">
                    <h2 class="section-title mb-4">Get Your Custom Solution</h2>
                    <p class="section-description mb-4">Fill out the form below and we'll get back to you with a tailored solution for your business needs.</p>
                    
                    <form id="solution-request-form" class="needs-validation" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" novalidate>
                        <?php wp_nonce_field('submit_solution_form', 'solution_nonce'); ?>
                        <input type="hidden" name="action" value="submit_solution_request">
                        
                        <?php
                        // Get solution details from URL if they exist
                        $solution_title = isset($_GET['solution_title']) ? urldecode($_GET['solution_title']) : '';
                        $solution_id = isset($_GET['solution_id']) ? intval($_GET['solution_id']) : 0;
                        $solution_excerpt = isset($_GET['solution_excerpt']) ? urldecode($_GET['solution_excerpt']) : '';
                        
                        if ($solution_title) {
                            echo '<input type="hidden" name="solution_id" value="' . esc_attr($solution_id) . '">';
                        }
                        ?>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">Please enter your name.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="company" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="company" name="company">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Project Details *</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required><?php 
                                    if ($solution_title) {
                                        echo esc_textarea("I am interested in the following solution:\n\n");
                                        echo esc_textarea("Solution Title: " . $solution_title . "\n\n");
                                        if ($solution_excerpt) {
                                            echo esc_textarea("Description: " . $solution_excerpt . "\n\n");
                                        }
                                        echo esc_textarea("Please provide more information about implementing this solution for my business.");
                                    }
                                ?></textarea>
                                <div class="invalid-feedback">Please provide project details.</div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Submit Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar Section (1/4) -->
            <div class="col-lg-3">
                <div class="contact-details-section p-4 rounded-3 shadow-sm" style="background-color: #f8f9fa;">
                    <h3 class="h5 mb-4">Contact Information</h3>
                    
                    <div class="contact-item mb-4">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                        <div>
                            <h4 class="h6 mb-1">Our Location</h4>
                            <p class="mb-0">Nairobi, Kenya</p>
                        </div>
                    </div>

                    <div class="contact-item mb-4">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <div>
                            <h4 class="h6 mb-1">Call Us</h4>
                            <p class="mb-0">+254 738 788010</p>
                        </div>
                    </div>

                    <div class="contact-item mb-4">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <div>
                            <h4 class="h6 mb-1">Email Us</h4>
                            <p class="mb-0 text-break">kennedychongwobitcomm@gmail.com</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-clock text-primary me-2"></i>
                        <div>
                            <h4 class="h6 mb-1">Working Hours</h4>
                            <p class="mb-0">Mon - Fri: 8:00 AM - 5:00 PM</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="social-links">
                        <h4 class="h6 mb-3">Follow Us</h4>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-primary"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.get-solution-page {
    background-color: #f8f9fa;
}

.section-title {
    color: #2C1D6D;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.section-description {
    color: #6c757d;
    font-size: 1.1rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
}

.contact-item i {
    font-size: 1.2rem;
    margin-top: 0.2rem;
}

.contact-item h4 {
    color: #2C1D6D;
}

.contact-item p {
    word-break: break-word;
    max-width: 100%;
}

.social-links a {
    font-size: 1.2rem;
    transition: color 0.3s ease;
}

.social-links a:hover {
    color: #2C1D6D !important;
}

.form-control:focus,
.form-select:focus {
    border-color: #2C1D6D;
    box-shadow: 0 0 0 0.25rem rgba(44, 29, 109, 0.25);
}

.btn-primary {
    background-color: #2C1D6D;
    border-color: #2C1D6D;
}

.btn-primary:hover {
    background-color: #1a1242;
    border-color: #1a1242;
}
</style>

<?php
get_footer();
?>
