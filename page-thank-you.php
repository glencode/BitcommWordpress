<?php
/**
 * Template Name: Thank You
 */

get_header();
?>

<div class="thank-you-page py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="thank-you-icon mb-4">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
                <h1 class="display-4 fw-bold mb-4">Thank You!</h1>
                <p class="lead mb-4">We've received your solution request and will get back to you shortly.</p>
                
                <div class="next-steps mt-5">
                    <h3 class="h4 mb-4">What's Next?</h3>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="step-card p-4 rounded-3 shadow-sm h-100" style="background-color: #fff;">
                                <i class="fas fa-envelope text-primary mb-3"></i>
                                <h4 class="h5">Email Confirmation</h4>
                                <p class="mb-0">You'll receive a confirmation email with your request details.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="step-card p-4 rounded-3 shadow-sm h-100" style="background-color: #fff;">
                                <i class="fas fa-phone text-primary mb-3"></i>
                                <h4 class="h5">Initial Contact</h4>
                                <p class="mb-0">Our team will reach out to discuss your requirements in detail.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="step-card p-4 rounded-3 shadow-sm h-100" style="background-color: #fff;">
                                <i class="fas fa-calendar-check text-primary mb-3"></i>
                                <h4 class="h5">Solution Proposal</h4>
                                <p class="mb-0">We'll prepare a customized solution proposal for your review.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cta-buttons mt-5">
                    <a href="/" class="btn btn-primary btn-lg px-4 me-2">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                    <a href="/contact" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.thank-you-page {
    min-height: 80vh;
    display: flex;
    align-items: center;
}

.thank-you-icon {
    font-size: 5rem;
    animation: scaleIn 0.5s ease-out;
}

.step-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.step-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.cta-buttons .btn {
    transition: all 0.3s ease;
}

.cta-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
</style>

<?php
get_footer();
?> 