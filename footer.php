<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package itsulu-custom
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer pt-5">
		<div class="container">
			<div class="row gy-4">
				<!-- Footer Widget 1: About -->
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="footer-widget">
						<div class="footer-logo mb-3">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-decoration-none" title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' - Home' ); ?>">
								<h2 class="company-name text-white mb-3"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h2>
							</a>
						</div>
						<p class="text-white-50 mb-4"><?php echo esc_html( get_theme_mod( 'footer_description', 'Leading IT consultancy firm providing cutting-edge technology solutions to transform businesses and drive digital innovation across Kenya and beyond.' ) ); ?></p>
						<div class="footer-social d-flex mb-4">
							<a href="<?php echo esc_url( get_theme_mod( 'footer_facebook_url', '#' ) ); ?>" aria-label="Facebook" class="social-icon"><i class="fab fa-facebook-f"></i></a>
							<a href="<?php echo esc_url( get_theme_mod( 'footer_twitter_url', '#' ) ); ?>" aria-label="Twitter" class="social-icon"><i class="fab fa-twitter"></i></a>
							<a href="<?php echo esc_url( get_theme_mod( 'footer_linkedin_url', '#' ) ); ?>" aria-label="LinkedIn" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
							<a href="<?php echo esc_url( get_theme_mod( 'footer_instagram_url', '#' ) ); ?>" aria-label="Instagram" class="social-icon"><i class="fab fa-instagram"></i></a>
						</div>
					</div>
				</div>

				<!-- Footer Widget 2: Quick Links -->
				<div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
					<div class="footer-widget">
						<h4 class="footer-widget-title text-white mb-4">Quick Links</h4>
						<ul class="footer-links list-unstyled">
							<li class="mb-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
							<li class="mb-2"><a href="<?php echo esc_url( home_url( '/about' ) ); ?>">About Us</a></li>
							<li class="mb-2"><a href="<?php echo esc_url( home_url( '/services-2' ) ); ?>">Our Services</a></li>
							<li class="mb-2"><a href="<?php echo esc_url( home_url( '/our-solutions' ) ); ?>">Our Solutions</a></li>
							<li class="mb-2"><a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>">Portfolio</a></li>
							<li class="mb-2"><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a></li>
							<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact Us</a></li>
						</ul>
					</div>
				</div>

				<!-- Footer Widget 3: Our Services -->
				<div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
					<div class="footer-widget">
						<h4 class="footer-widget-title text-white mb-4">Our Services</h4>
						<ul class="footer-links list-unstyled">
							<?php
							$services = new WP_Query([
								'post_type' => 'itsulu_service',
								'posts_per_page' => 5,
								'orderby' => 'menu_order',
								'order' => 'ASC'
							]);

							if ($services->have_posts()) :
								while ($services->have_posts()) : $services->the_post();
							?>
								<li class="mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php
								endwhile;
								wp_reset_postdata();
							endif;
							?>
							<li><a href="<?php echo esc_url( home_url( '/services-2' ) ); ?>">All Services</a></li>
						</ul>
					</div>
				</div>

				<!-- Footer Widget 4: Contact Info & Newsletter -->
				<div class="col-lg-4 col-md-6">
					<div class="footer-widget">
						<h4 class="footer-widget-title text-white mb-4">Contact Info</h4>
						<div class="footer-contact-info">
							<p class="text-white-50 mb-2"><i class="fas fa-map-marker-alt me-2"></i> <?php echo esc_html( get_theme_mod( 'footer_address', 'Nairobi, Kenya' ) ); ?></p>
							<p class="text-white-50 mb-2"><i class="fas fa-phone-alt me-2"></i> <a href="tel:<?php echo esc_attr( get_theme_mod( 'footer_phone', '+254 738 788010' ) ); ?>" class="text-white-50"><?php echo esc_html( get_theme_mod( 'footer_phone', '+254 738 788010' ) ); ?></a></p>
							<p class="text-white-50 mb-4"><i class="fas fa-envelope me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#contactModal" class="text-white-50"><?php echo esc_html( get_theme_mod( 'footer_email', 'kennedychongwobitcomm@gmail.com' ) ); ?></a></p>
						</div>

						<h4 class="footer-widget-title text-white mb-3">Newsletter</h4>
						<p class="text-white-50 mb-3">Subscribe to our newsletter for updates on our services, latest tech news, and industry insights.</p>

						<!-- Newsletter Form -->
						<script type="text/javascript">
						    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
						</script>
						<form id="footer-newsletter-form" class="footer-newsletter" method="post">
						    <!-- <input type="hidden" name="action" value="subscribe_newsletter"> -->
						    <?php wp_nonce_field('subscribe_newsletter_nonce', 'subscribe_nonce'); ?>
						    <div class="input-group">
						        <input type="email" name="subscriber_email" class="form-control newsletter-email" 
						               placeholder="Your email address" aria-label="Your email address" required>
						        <button class="btn btn-primary newsletter-submit" type="submit">
						            <span class="btn-text">Subscribe</span>
						            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
						        </button>
						    </div>
						    <div id="newsletter-message" class="mt-2" style="display: none;"></div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom mt-5 py-3">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 text-center text-md-start">
						<p class="mb-0 text-white-50">
							&copy; <?php echo date_i18n( 'Y' ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. All Rights Reserved.
						</p>
					</div>
					<div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
						<ul class="footer-bottom-links list-inline mb-0">
							<li class="list-inline-item"><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a></li>
							<li class="list-inline-item"><a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">Terms of Service</a></li>
							<li class="list-inline-item"><a href="<?php echo esc_url(home_url('/cookie-policy')); ?>">Cookie Policy</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<!-- Back to top button -->
<a href="#" class="back-to-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></a>

<style>
.site-footer {
	background-color: #1a1a1a;
	color: #fff;
}

.footer-widget-title {
	font-size: 1.25rem;
	font-weight: 600;
	margin-bottom: 1.5rem;
	position: relative;
}

.footer-widget-title:after {
	content: '';
	display: block;
	width: 40px;
	height: 3px;
	background: #3D2E8F;
	margin-top: 15px;
}

.footer-links a {
	color: #b3b3b3;
	text-decoration: none;
	transition: all 0.3s ease;
	display: inline-block;
}

.footer-links a:hover {
	color: #fff;
	transform: translateX(3px);
}

.footer-contact-info p {
	margin-bottom: 0.5rem;
}

.footer-contact-info a {
	text-decoration: none;
	transition: color 0.3s ease;
}

.footer-contact-info a:hover {
	color: #fff !important;
}

.footer-social {
	gap: 10px;
}

.social-icon {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 36px;
	height: 36px;
	border-radius: 50%;
	background-color: #2C1D6D;
	color: #fff;
	text-decoration: none;
	transition: all 0.3s ease;
}

.social-icon:hover {
	background-color: #3D2E8F;
	color: #fff;
	transform: translateY(-3px);
}

.footer-bottom {
	background-color: #111;
	border-top: 1px solid #333;
}

.footer-bottom-links a {
	color: #b3b3b3;
	text-decoration: none;
	padding: 0 10px;
	transition: color 0.3s ease;
}

.footer-bottom-links a:hover {
	color: #fff;
}

.footer-newsletter .form-control {
	background-color: #2a2a2a;
	border: none;
	color: #fff;
	padding: 0.75rem 1rem;
}

.footer-newsletter .form-control::placeholder {
	color: #999;
	opacity: 1;
}

.footer-newsletter .form-control:focus {
	box-shadow: none;
	background-color: #2a2a2a;
	color: #fff;
}

.footer-newsletter .btn {
	padding: 0.75rem 1rem;
	background-color: #2C1D6D;
	border-color: #2C1D6D;
	z-index: 1;
	position: relative;
	cursor: pointer;
}

.footer-newsletter .btn:hover {
	background-color: #3D2E8F;
	border-color: #3D2E8F;
}

.newsletter-submit {
	min-width: 100px;
	font-weight: 500;
}

.back-to-top {
	position: fixed;
	right: 20px;
	bottom: 20px;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	background-color:rgb(109, 71, 170);
	color: #fff;
	text-align: center;
	line-height: 40px;
	z-index: 1000;
	opacity: 0;
	pointer-events: none;
	transition: opacity 0.3s ease, pointer-events 0.3s ease;
	display: flex;
	align-items: center;
	justify-content: center;
	box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.back-to-top.show {
	opacity: 1;
	pointer-events: auto;
}

.back-to-top:hover {
	background-color:rgb(58, 4, 113);
	color: #fff;
	transform: translateY(-3px);
}

.newsletter-message .alert {
	padding: 8px 12px;
	border-radius: 4px;
	font-size: 0.9rem;
	margin-top: 8px;
}

.newsletter-message .alert-success {
	background-color: rgba(40, 167, 69, 0.15);
	border: 1px solid rgba(40, 167, 69, 0.3);
	color: #fff;
}

.newsletter-message .alert-danger {
	background-color: rgba(220, 53, 69, 0.15);
	border: 1px solid rgba(220, 53, 69, 0.3);
	color: #fff;
}

@media (max-width: 991px) {
	.footer-widget {
		margin-bottom: 2rem;
	}
}

.newsletter-message small.text-success {
    color: #4caf50 !important;
    font-weight: 500;
    background-color: rgba(76, 175, 80, 0.1);
    padding: 5px 10px;
    border-radius: 4px;
    display: inline-block;
}

.newsletter-message small.text-danger {
    color: #f44336 !important;
    font-weight: 500;
    background-color: rgba(244, 67, 54, 0.1);
    padding: 5px 10px;
    border-radius: 4px;
    display: inline-block;
}

.newsletter-message small.text-white {
    background-color: rgba(255, 255, 255, 0.1);
    padding: 5px 10px;
    border-radius: 4px;
    display: inline-block;
}
</style>

<script>
jQuery(document).ready(function($) {
	// Back to top button
	$(window).scroll(function() {
		if ($(this).scrollTop() > 300) {
			$('.back-to-top').addClass('show');
		} else {
			$('.back-to-top').removeClass('show');
		}
	});

	$('.back-to-top').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop: 0}, 500);
		return false;
	});
});
</script>

<script>
// Newsletter AJAX Form Handling
// jQuery(document).ready(function($) {
//     // Get the AJAX URL from WordPress
//     var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
    
//     $('#footer-newsletter-form').on('submit', function(e) {
//         e.preventDefault();
        
//         var $form = $(this);
//         var $submitBtn = $form.find('.newsletter-submit');
//         var $spinner = $submitBtn.find('.spinner-border');
//         var $btnText = $submitBtn.find('.btn-text');
//         var $message = $('#newsletter-message');
        
//         // Show loading state
//         $submitBtn.prop('disabled', true);
//         $btnText.text('Sending...');
//         $spinner.removeClass('d-none');
//         $message.hide().removeClass('alert-success alert-danger').empty();
        
//         // Prepare form data
//         // var formData = {
//         //     action: $form.find('input[name="action"]').val(),
//         //     subscribe_nonce: $form.find('input[name="subscribe_nonce"]').val(),
//         //     subscriber_email: $form.find('input[name="subscriber_email"]').val()
//         // };
//         var formData = {
//             action: 'bitcomm_newsletter_subscribe', // Use the new, unique action name
//             subscribe_nonce: $form.find('input[name="subscribe_nonce"]').val(),
//             subscriber_email: $form.find('input[name="subscriber_email"]').val()
//         };
//         // console.log('Sending AJAX request to:', ajaxurl);
//         // console.log('Form data:', formData);
        
//         // Send AJAX request without specifying dataType to allow auto-detection
//         $.ajax({
//             url: ajaxurl,
//             type: 'POST',
//             data: formData,
//             traditional: true,
//             success: function(response) {
//                 console.log('AJAX Success:', response);
//                 try {
//                     // Try to parse response as JSON if it's not already an object
//                     var jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;
                    
//                     if (jsonResponse && jsonResponse.success) {
//                         $message.html(jsonResponse.data.message || 'Thank you for subscribing!').addClass('alert alert-success').show();
//                         $form[0].reset();
//                     } else {
//                         var errorMsg = (jsonResponse && jsonResponse.data && jsonResponse.data.message) 
//                             ? jsonResponse.data.message 
//                             : 'An error occurred. Please try again.';
//                         $message.html(errorMsg).addClass('alert alert-danger').show();
//                     }
//                 } catch (e) {
//                     // If response is not JSON, check for HTML error messages
//                     console.log('Response parsing error:', e);
//                     var errorMsg = 'An error occurred. Please try again.';
                    
//                     if (typeof response === 'string') {
//                         // Create a temporary div to parse HTML response
//                         var tempDiv = document.createElement('div');
//                         tempDiv.innerHTML = response;
                        
//                         // Look for common error message elements
//                         var errorElement = tempDiv.querySelector('.wp-die-message, .error-message, .message');
//                         if (errorElement) {
//                             errorMsg = errorElement.textContent.trim();
//                         }
//                     }
                    
//                     $message.html(errorMsg).addClass('alert alert-danger').show();
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.group('AJAX Error Details');
//                 console.log('Status:', status);
//                 console.log('Error:', error);
//                 console.log('Status Code:', xhr.status);
//                 console.log('Response Type:', xhr.getResponseHeader('content-type'));
//                 console.log('Response Text:', xhr.responseText);
//                 console.groupEnd();
                
//                 var errorMsg = 'An error occurred. Please try again later.';
                
//                 // Try to parse error response if it's JSON
//                 if (xhr.responseText && xhr.responseText.trim().startsWith('{')) {
//                     try {
//                         var jsonResponse = JSON.parse(xhr.responseText);
//                         if (jsonResponse.data && jsonResponse.data.message) {
//                             errorMsg = jsonResponse.data.message;
//                         } else if (jsonResponse.message) {
//                             errorMsg = jsonResponse.message;
//                         }
//                         console.log('Parsed JSON response:', jsonResponse);
//                     } catch (e) {
//                         console.error('Error parsing JSON response:', e);
//                     }
//                 } else if (xhr.responseText && xhr.responseText.trim().startsWith('<!')) {
//                     // If it's HTML, extract the error message if possible
//                     try {
//                         var tempDiv = document.createElement('div');
//                         tempDiv.innerHTML = xhr.responseText;
//                         var errorElement = tempDiv.querySelector('h1, h2, .error, .message, p');
//                         if (errorElement && errorElement.textContent) {
//                             errorMsg = 'Server Error: ' + errorElement.textContent.substring(0, 200);
//                         }
//                     } catch (e) {
//                         console.error('Error parsing HTML response:', e);
//                     }
//                 }
                
//                 $message.html(errorMsg).addClass('alert alert-danger').show();
//             },
//             complete: function() {
//                 // Reset button state
//                 $submitBtn.prop('disabled', false);
//                 $btnText.text('Subscribe');
//                 $spinner.addClass('d-none');
                
//                 // Hide message after 5 seconds
//                 setTimeout(function() {
//                     $message.fadeOut();
//                 }, 5000);
//             }
//         });
//     });
// });
</script>

<?php wp_footer(); ?>

<!-- Contact Form Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contact Us</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalContactForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <input type="hidden" name="action" value="send_modal_contact_form">
                    <?php wp_nonce_field('modal_contact_nonce', 'modal_contact_nonce'); ?>
                    
                    <div class="mb-3">
                        <label for="modalName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="modalName" name="modal_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="modalEmail" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="modalEmail" name="modal_email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="modalSubject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="modalSubject" name="modal_subject" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="modalMessage" class="form-label">Message</label>
                        <textarea class="form-control" id="modalMessage" name="modal_message" rows="4" required></textarea>
                    </div>
                    
                    <?php
                    // Check for contact form status in URL parameter
                    $contact_status = isset($_GET['contact_status']) ? sanitize_text_field($_GET['contact_status']) : '';
                    if ($contact_status == 'success') {
                        echo '<div class="modal-message-static alert alert-success mb-3">Your message has been sent successfully!</div>';
                    } elseif ($contact_status == 'error') {
                        echo '<div class="modal-message-static alert alert-danger mb-3">There was a problem sending your message. Please try again.</div>';
                    }
                    ?>
                    
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Modal notification auto-hide script
jQuery(document).ready(function($) {
    // Auto-hide the contact form message if present (from redirect)
    var contactMessage = $('.modal-message-static');
    if (contactMessage.length) {
        setTimeout(function() {
            contactMessage.fadeOut(function() {
                $(this).remove();
            });
            
            // Clean the URL
            if (window.history.replaceState) {
                var url = new URL(window.location.href);
                if (url.searchParams.has('contact_status')) {
                    url.searchParams.delete('contact_status');
                    window.history.replaceState({path:url.href}, '', url.href);
                }
            }
        }, 5000);
    }
    
    // Show the contact modal if there's a contact status in URL
    if (window.location.href.indexOf('contact_status=') > -1) {
        var contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
        contactModal.show();
    }
});
</script>

<!-- Newsletter notification auto-hide script -->
<script>
jQuery(document).ready(function($) {
    // Auto-hide the newsletter message if present (from redirect)
    var newsletterMessage = $('.newsletter-message-static');
    if (newsletterMessage.length) {
        setTimeout(function() {
            newsletterMessage.fadeOut(function() {
                $(this).remove();
            });
            
            // Clean the URL
            if (window.history.replaceState) {
                var url = new URL(window.location.href);
                if (url.searchParams.has('newsletter_status')) {
                    url.searchParams.delete('newsletter_status');
                    window.history.replaceState({path:url.href}, '', url.href);
                }
            }
        }, 5000);
    }
});
</script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/modal-accessibility.js"></script>

</body>
</html>
