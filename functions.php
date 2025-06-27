<?php
/**
 * itsulu-custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package itsulu-custom
 */

// Add custom CSS for the newsletter form
function itsulu_newsletter_styles() {
    ?>
    <style>
        /* Newsletter Form Styles */
        .newsletter-submit {
            position: relative;
            min-width: 100px;
        }

        .newsletter-submit .spinner-border {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .newsletter-submit .btn-text {
            opacity: 1;
            transition: opacity 0.2s;
        }

        .newsletter-submit.loading .btn-text {
            opacity: 0;
        }

        #newsletter-message {
            transition: all 0.3s ease;
        }

        #newsletter-message.alert {
            margin-top: 1rem;
            padding: 0.75rem 1.25rem;
            border-radius: 0.25rem;
            font-size: 0.9rem;
        }

        #newsletter-message.alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        #newsletter-message.alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
    <?php
}
add_action('wp_head', 'itsulu_newsletter_styles');

// Simple, reliable newsletter subscription handler that works every time
if (isset($_POST['newsletter_form']) && isset($_POST['subscriber_email'])) {
    $email = sanitize_email($_POST['subscriber_email']);
    $message = '';
    
    // Basic validation
    if (!$email || !is_email($email)) {
        $message = '<div class="alert alert-danger mb-3"><strong>Error:</strong> Please enter a valid email address.</div>';
    } else {
        // Check if email already exists
        $subscribers = get_option('newsletter_subscribers', array());
        
        if (in_array($email, $subscribers)) {
            $message = '<div class="alert alert-warning mb-3"><strong>Note:</strong> This email is already subscribed to our newsletter.</div>';
        } else {
            // Add the email to our subscribers list
            $subscribers[] = $email;
            update_option('newsletter_subscribers', $subscribers);
            
            // Try to send notification emails, but don't let failure affect the user experience
            $admin_email = get_option('admin_email');
            @wp_mail($admin_email, 'New Newsletter Subscriber', "Email: $email\nDate: " . date('Y-m-d H:i:s'));
            
            $message = '<div class="alert alert-success mb-3"><strong>Success!</strong> Thank you for subscribing to our newsletter!</div>';
        }
    }
    
    // Store the message in a transient with a unique key based on session or IP
    $message_key = 'newsletter_message_' . md5($_SERVER['REMOTE_ADDR'] . time());
    set_transient($message_key, $message, 60); // Store for 1 minute
    setcookie('newsletter_message_key', $message_key, time() + 60, '/');
}

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Include custom post types and other theme functionalities.
 */
require_once get_template_directory() . '/inc/legal-pages-cpts.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function itsulu_custom_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on itsulu-custom, use a find and replace
		* to change 'itsulu-custom' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'itsulu-custom', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'itsulu-custom' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'itsulu_custom_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'itsulu_custom_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function itsulu_custom_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'itsulu_custom_content_width', 640 );
}
add_action( 'after_setup_theme', 'itsulu_custom_content_width', 0 );

/**
 * Disable footer customization options
 */
function itsulu_disable_footer_customization($wp_customize) {
    // Remove footer customization sections
    $wp_customize->remove_section('footer');
    $wp_customize->remove_section('footer-widgets');
    $wp_customize->remove_section('footer-options');
}
add_action('customize_register', 'itsulu_disable_footer_customization', 20);

/**
 * Remove footer widget areas from admin
 */
function itsulu_remove_footer_widgets() {
    unregister_sidebar('footer-1');
    unregister_sidebar('footer-2');
    unregister_sidebar('footer-3');
    unregister_sidebar('footer-header');
}
add_action('widgets_init', 'itsulu_remove_footer_widgets', 11);

/**
 * Enqueue scripts and styles.
 */
function itsulu_custom_scripts() {
	wp_enqueue_style( 'itsulu-custom-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'itsulu-custom-style', 'rtl', 'replace' );

	wp_enqueue_script( 'itsulu-custom-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'itsulu_custom_scripts' );

/**
 * Newsletter subscription functionality
 * 
 * Completely rewritten for maximum reliability across all environments
 */
function itsulu_handle_newsletter_submission() {
    global $itsulu_newsletter_message;
    
    // If this is a POST request with our newsletter form
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['itsulu_newsletter_submit'])) {
        // Debug log
        if (WP_DEBUG) {
            error_log('Newsletter form submitted');
            error_log('POST data: ' . print_r($_POST, true));
        }
        
        // Verify nonce
        if (!isset($_POST['subscribe_nonce']) || !wp_verify_nonce($_POST['subscribe_nonce'], 'subscribe_newsletter_nonce')) {
            $itsulu_newsletter_message = array(
                'type' => 'error',
                'text' => 'Security verification failed. Please try again.'
            );
            return;
        }
        
        // Get and validate email
        $email = isset($_POST['subscriber_email']) ? sanitize_email($_POST['subscriber_email']) : '';
        
        if (!$email || !is_email($email)) {
            $itsulu_newsletter_message = array(
                'type' => 'error',
                'text' => 'Please enter a valid email address.'
            );
            return;
        }
        
        // Check if email already exists
        $existing_subscribers = get_option('itsulu_newsletter_subscribers', array());
        
        if (in_array($email, $existing_subscribers)) {
            $itsulu_newsletter_message = array(
                'type' => 'warning',
                'text' => 'This email is already subscribed to our newsletter.'
            );
            return;
        }
        
        // Add the new subscriber
        $existing_subscribers[] = $email;
        $success = update_option('itsulu_newsletter_subscribers', $existing_subscribers);
        
        // Store additional data
        $subscribers_data = get_option('itsulu_subscribers_data', array());
        $subscribers_data[$email] = array(
            'date_subscribed' => current_time('mysql'),
            'ip_address' => sanitize_text_field($_SERVER['REMOTE_ADDR']),
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field($_SERVER['HTTP_USER_AGENT']) : ''
        );
        update_option('itsulu_subscribers_data', $subscribers_data);
        
        // Set success message
        if ($success) {
            $itsulu_newsletter_message = array(
                'type' => 'success',
                'text' => 'Thank you for subscribing to our newsletter!'
            );
            
            // Handle emails - but don't let email failures affect the user experience
            itsulu_send_newsletter_emails($email);
        } else {
            $itsulu_newsletter_message = array(
                'type' => 'error',
                'text' => 'There was a problem saving your subscription. Please try again.'
            );
        }
    }
}

/**
 * Handle sending newsletter-related emails
 */
function itsulu_send_newsletter_emails($subscriber_email) {
    // Only proceed if we have a valid email
    if (!is_email($subscriber_email)) {
        return false;
    }
    
    // For local development, just log instead of attempting to send
    $is_local = defined('WP_DEBUG') && WP_DEBUG && in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'));
    
    // Get admin email
    $admin_email = get_theme_mod('newsletter_recipient_email', get_option('admin_email'));
    $site_name = get_bloginfo('name');
    
    // Admin notification
    $admin_subject = 'New Newsletter Subscriber: ' . $site_name;
    $admin_message = "A new user has subscribed to your newsletter.\n\n";
    $admin_message .= "Email: $subscriber_email\n";
    $admin_message .= "Date: " . current_time('mysql') . "\n";
    $admin_message .= "Site: " . home_url() . "\n";
    
    // Subscriber confirmation
    $subscriber_subject = 'Welcome to the ' . $site_name . ' Newsletter';
    $subscriber_message = "Thank you for subscribing to our newsletter!\n\n";
    $subscriber_message .= "You'll receive updates on our services, latest tech news, and industry insights.\n\n";
    $subscriber_message .= "If you didn't subscribe to this newsletter, please ignore this email.\n\n";
    $subscriber_message .= "Regards,\n";
    $subscriber_message .= $site_name . " Team";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>'
    );
    
    // Send emails or log if in local environment
    if ($is_local) {
        error_log("Would send admin email to: $admin_email");
        error_log("Admin email subject: $admin_subject");
        error_log("Would send subscriber confirmation to: $subscriber_email");
        return true; // Return success in local environment
    } else {
        $admin_sent = wp_mail($admin_email, $admin_subject, $admin_message, $headers);
        $subscriber_sent = wp_mail($subscriber_email, $subscriber_subject, $subscriber_message, $headers);
        return $admin_sent && $subscriber_sent;
    }
}

// Initialize the newsletter handling on each page load
add_action('template_redirect', 'itsulu_handle_newsletter_submission');


/**
 * Contact form submission handler
 */
function itsulu_handle_contact_form_submission() {
    // Debug log for local development
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
        error_log('Contact form processing started');
        error_log('POST data: ' . print_r($_POST, true));
    }
    
    // Verify nonce
    if (!isset($_POST['modal_contact_nonce']) || !wp_verify_nonce($_POST['modal_contact_nonce'], 'modal_contact_nonce')) {
        error_log('Contact form nonce verification failed');
        wp_redirect(add_query_arg('contact_status', 'error', home_url('/')));
        exit;
    }
    
    // Get form data
    $name = isset($_POST['modal_name']) ? sanitize_text_field($_POST['modal_name']) : '';
    $email = isset($_POST['modal_email']) ? sanitize_email($_POST['modal_email']) : '';
    $subject = isset($_POST['modal_subject']) ? sanitize_text_field($_POST['modal_subject']) : '';
    $message = isset($_POST['modal_message']) ? sanitize_textarea_field($_POST['modal_message']) : '';
    
    // Log the collected data
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
        error_log('Form data collected: ' . print_r(array(
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message_length' => strlen($message)
        ), true));
    }
    
    // Validate data
    if (empty($name) || empty($subject) || empty($message) || !is_email($email)) {
        error_log('Form validation failed: ' . json_encode(array(
            'name_empty' => empty($name),
            'subject_empty' => empty($subject),
            'message_empty' => empty($message),
            'email_invalid' => !is_email($email)
        )));
        wp_redirect(add_query_arg('contact_status', 'error', home_url('/')));
        exit;
    }
    
    // Get the recipient email from theme mod or fallback to admin email
    $recipient = get_theme_mod('footer_email', get_option('admin_email'));
    
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
        error_log('Recipient email: ' . $recipient);
    }
    
    // Prepare email content with better formatting
    $email_subject = 'Website Contact: ' . $subject;
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n\n";
    $email_content .= "Sent from: " . home_url() . "\n";
    $email_content .= "Date: " . current_time('mysql') . "\n";
    $email_content .= "IP: " . sanitize_text_field($_SERVER['REMOTE_ADDR']) . "\n";
    
    // Use a more compatible headers format
    $site_name = get_bloginfo('name');
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $recipient . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );
    
    // Send email
    $mail_sent = wp_mail($recipient, $email_subject, $email_content, $headers);
    
    // Log the email sending result
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
        error_log('Contact form email ' . ($mail_sent ? 'sent successfully' : 'failed to send') . ' to ' . $recipient);
        error_log('Email content: ' . $email_content);
        error_log('Headers: ' . print_r($headers, true));
    }
    
    // Send auto-reply to the user
    $autoreply_subject = 'Thank you for contacting us - ' . $site_name;
    $autoreply_message = "Dear $name,\n\n";
    $autoreply_message .= "Thank you for contacting us. We have received your message and will respond to your inquiry as soon as possible.\n\n";
    $autoreply_message .= "For your records, here is a copy of your message:\n\n";
    $autoreply_message .= "Subject: $subject\n";
    $autoreply_message .= "Message:\n$message\n\n";
    $autoreply_message .= "Regards,\n";
    $autoreply_message .= $site_name . " Team";
    
    $autoreply_headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $recipient . '>'
    );
    
    $autoreply_sent = wp_mail($email, $autoreply_subject, $autoreply_message, $autoreply_headers);
    
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
        error_log('Autoreply email ' . ($autoreply_sent ? 'sent successfully' : 'failed to send') . ' to ' . $email);
    }
    
    if ($mail_sent) {
        // Success
        wp_redirect(add_query_arg('contact_status', 'success', home_url('/')));
    } else {
        // Error
        wp_redirect(add_query_arg('contact_status', 'error', home_url('/')));
    }
    exit;
}

// Register handlers for form submissions
add_action('admin_post_send_modal_contact_form', 'itsulu_handle_contact_form_submission');
add_action('admin_post_nopriv_send_modal_contact_form', 'itsulu_handle_contact_form_submission');


function itsulu_custom_enqueue_styles() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_style('style.css', get_stylesheet_uri()); 
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    wp_enqueue_style('hero-css', get_template_directory_uri() . '/assets/css/hero.css', array(), _S_VERSION);
    wp_enqueue_style('footer-css', get_template_directory_uri() . '/assets/css/footer.css', array(), _S_VERSION);
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
}
add_action('wp_enqueue_scripts', 'itsulu_custom_enqueue_styles');

function itsulu_custom_enqueue_scripts() {
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('hero-slider', get_template_directory_uri() . '/assets/js/hero-slider.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('footer-js', get_template_directory_uri() . '/assets/js/footer.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('navbar-js', get_template_directory_uri() . '/assets/js/navbar.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
    wp_enqueue_script('newsletter-js', get_template_directory_uri() . '/assets/js/newsletter.js', array('jquery'), _S_VERSION, true);

    // Pass AJAX URL to script
    wp_localize_script('newsletter-js', 'newsletterAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('subscribe_newsletter_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'itsulu_custom_enqueue_scripts');


function itsulu_custom_dynamic_styles() {
    $background_color = get_theme_mod('background_color_setting', '#f8f9fa'); 
    ?>
    <style>
        body {
            background-color: <?php echo esc_attr($background_color); ?>;
        }
    </style>
    
    <!-- Prevent any lingering AJAX calls to admin-ajax.php to stop 400 errors -->
    <!--<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intercept any AJAX requests to admin-ajax.php and prevent them
        (function(open) {
            XMLHttpRequest.prototype.open = function(method, url) {
                if (url.indexOf('admin-ajax.php') > -1) {
                    // Only log in development
                    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
                        console.log('⚠️ Prevented AJAX call to admin-ajax.php - Forms now use admin-post.php');
                    }
                    // Call with modified URL that won't cause 400 errors
                    url = window.location.href;
                }
                open.apply(this, arguments);
            };
        })(XMLHttpRequest.prototype.open);
    });
    </script>-->
    <?php
}
add_action('wp_head', 'itsulu_custom_dynamic_styles');

/**
 * Fix for email delivery in Local environment
 * 
 * Local development environments often have problems with email delivery.
 * This function helps debug that by showing messages and ensuring status is visible.
 */
function itsulu_check_email_delivery() {
    // Only run in local development environment
    if (!in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
        return;
    }
    
    // Check if we're in the admin section
    if (!is_admin()) {
        return;
    }
    
    // Add admin notice for local email configuration
    add_action('admin_notices', function() {
        echo '<div class="notice notice-warning is-dismissible">';
        echo '<p><strong>Local Development Environment:</strong> Email delivery might not work properly without a mail server. Emails are being logged to the error log.</p>';
        echo '<p>If you need to test email functionality, consider using a plugin like <a href="https://wordpress.org/plugins/wp-mail-logging/" target="_blank">WP Mail Logging</a> or <a href="https://wordpress.org/plugins/check-email/" target="_blank">Check Email</a>.</p>';
        echo '</div>';
    });
}
add_action('init', 'itsulu_check_email_delivery');

// Intercept wp_mail in local environment to ensure status messages work correctly
if (in_array($_SERVER['REMOTE_ADDR'] ?? '', array('127.0.0.1', '::1'))) {
    add_filter('wp_mail_from', function($email) {
        error_log("Email from address: $email");
        return $email;
    });
    
    // Make sure emails appear to be sent successfully in local environment
    add_filter('wp_mail', function($args) {
        error_log('Email would be sent with the following arguments:');
        error_log('To: ' . json_encode($args['to']));
        error_log('Subject: ' . $args['subject']);
        error_log('Message: ' . $args['message']);
        error_log('Headers: ' . json_encode($args['headers']));
        return $args;
    });
}


function itsulu_register_services_cpt() {
    $labels = array(
        'name' => 'Services',
        'singular_name' => 'Service',
        'menu_name' => 'Services',
        'name_admin_bar' => 'Service',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Service',
        'new_item' => 'New Service',
        'edit_item' => 'Edit Service',
        'view_item' => 'View Service',
        'all_items' => 'All Services',
        'search_items' => 'Search Services',
        'not_found' => 'No services found.',
        'not_found_in_trash' => 'No services found in Trash.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'services'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-portfolio',
        'show_in_rest' => true, // Enables Gutenberg / Elementor support
    );

    register_post_type('itsulu_service', $args);
}
add_action('init', 'itsulu_register_services_cpt');


add_action('after_setup_theme', function() {
    add_theme_support('elementor');
});

add_action('elementor/theme/register_locations', function($elementor_theme_manager) {
    $elementor_theme_manager->register_all_core_location();
});


// Register 'Why Choose Us' custom post type
function register_why_choose_us_post_type() {
    $args = array(
        'public' => true,
        'label'  => 'Why Choose Us',
        'supports' => array( 'title', 'editor', 'page-attributes' ),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-awards',
    );
    register_post_type( 'why_choose_us', $args );
}
add_action( 'init', 'register_why_choose_us_post_type' );

// Add icon meta box for 'Why Choose Us' items
function why_choose_us_icon_meta_box() {
    add_meta_box(
        'reason_icon_meta_box',
        'Icon Settings',
        'reason_icon_meta_box_callback',
        'why_choose_us',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'why_choose_us_icon_meta_box');

// Meta box callback for 'Why Choose Us' icons
function reason_icon_meta_box_callback($post) {
    // Add a nonce field for security
    wp_nonce_field('reason_icon_meta_box_nonce', 'reason_icon_meta_box_nonce');
    
    // Get the saved icon value
    $icon = get_post_meta($post->ID, 'reason_icon', true);
    
    // Icon options
    $icon_options = array(
        'fa-check-circle' => 'Check Circle',
        'fa-award' => 'Award',
        'fa-headset' => 'Headset/Support',
        'fa-wallet' => 'Wallet/Finance',
        'fa-project-diagram' => 'Project Diagram',
        'fa-user-shield' => 'Security',
        'fa-chart-bar' => 'Chart Bar',
        'fa-clock' => 'Clock/Time',
        'fa-comments' => 'Comments',
        'fa-thumbs-up' => 'Thumbs Up',
        'fa-trophy' => 'Trophy',
        'fa-handshake' => 'Handshake',
        'fa-sync' => 'Sync/Update',
        'fa-graduation-cap' => 'Expertise',
        'fa-certificate' => 'Certificate'
    );
    
    // Output the icon selector
    echo '<label for="reason_icon">Select an icon:</label>';
    echo '<select id="reason_icon" name="reason_icon" class="widefat">';
    
    foreach ($icon_options as $value => $label) {
        echo '<option value="' . esc_attr($value) . '" ' . selected($icon, $value, false) . '>' . esc_html($label) . '</option>';
    }
    
    echo '</select>';
    echo '<p class="description">Choose an icon for this reason.</p>';
}

// Save meta box data for 'Why Choose Us' icons
function save_reason_icon_meta_box($post_id) {
    // Check if our nonce is set and verify it
    if (!isset($_POST['reason_icon_meta_box_nonce']) || !wp_verify_nonce($_POST['reason_icon_meta_box_nonce'], 'reason_icon_meta_box_nonce')) {
        return;
    }
    
    // If doing autosave, don't save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save the icon value
    if (isset($_POST['reason_icon'])) {
        update_post_meta($post_id, 'reason_icon', sanitize_text_field($_POST['reason_icon']));
    }
}
add_action('save_post_why_choose_us', 'save_reason_icon_meta_box');

// Register 'Testimonial' custom post type
function register_testimonial_post_type() {
    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonials',
        'name_admin_bar'     => 'Testimonial',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Testimonial',
        'new_item'           => 'New Testimonial',
        'edit_item'          => 'Edit Testimonial',
        'view_item'          => 'View Testimonial',
        'all_items'          => 'All Testimonials',
        'search_items'       => 'Search Testimonials',
        'not_found'          => 'No testimonials found.',
        'not_found_in_trash' => 'No testimonials found in Trash.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonials'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-format-quote',
    );
    register_post_type('testimonial', $args);
}
add_action('init', 'register_testimonial_post_type');

// Add meta boxes for testimonials
function testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details_meta',
        'Testimonial Details',
        'testimonial_details_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'testimonial_meta_boxes');

// Testimonial details meta box callback
function testimonial_details_callback($post) {
    // Add nonce for security
    wp_nonce_field('testimonial_meta_nonce', 'testimonial_meta_nonce');
    
    // Get saved values
    $client_name = get_post_meta($post->ID, 'client_name', true) ?: '';
    $client_position = get_post_meta($post->ID, 'client_position', true) ?: '';
    $client_company = get_post_meta($post->ID, 'client_company', true) ?: '';
    $testimonial_content = get_post_meta($post->ID, 'testimonial_content', true) ?: '';
    $client_rating = get_post_meta($post->ID, 'client_rating', true) ?: '5';
    
    // Client Name field
    echo '<div class="testimonial-meta-field">';
    echo '<label for="client_name"><strong>Client Name:</strong></label><br>';
    echo '<input type="text" id="client_name" name="client_name" value="' . esc_attr($client_name) . '" class="widefat">';
    echo '<p class="description">Name of the client providing testimonial. If left empty, post title will be used.</p>';
    echo '</div>';
    
    // Client Position field
    echo '<div class="testimonial-meta-field" style="margin-top: 15px;">';
    echo '<label for="client_position"><strong>Client Position:</strong></label><br>';
    echo '<input type="text" id="client_position" name="client_position" value="' . esc_attr($client_position) . '" class="widefat">';
    echo '<p class="description">Job title or position of the client</p>';
    echo '</div>';
    
    // Client Company field
    echo '<div class="testimonial-meta-field" style="margin-top: 15px;">';
    echo '<label for="client_company"><strong>Client Company:</strong></label><br>';
    echo '<input type="text" id="client_company" name="client_company" value="' . esc_attr($client_company) . '" class="widefat">';
    echo '<p class="description">Company name of the client</p>';
    echo '</div>';
    
    // Testimonial Content field
    echo '<div class="testimonial-meta-field" style="margin-top: 15px;">';
    echo '<label for="testimonial_content"><strong>Testimonial Quote:</strong></label><br>';
    echo '<textarea id="testimonial_content" name="testimonial_content" class="widefat" rows="5">' . esc_textarea($testimonial_content) . '</textarea>';
    echo '<p class="description">Short quote from the testimonial. If left empty, the post content will be used.</p>';
    echo '</div>';
    
    // Client Rating field - MOVED HERE FROM OUTSIDE META BOX
    echo '<div class="testimonial-meta-field" style="margin-top: 15px;">';
    echo '<label for="client_rating"><strong>Rating (1-5 Stars):</strong></label><br>';
    echo '<select id="client_rating" name="client_rating" class="widefat">';
    for ($i = 1; $i <= 5; $i++) {
        echo '<option value="' . $i . '" ' . selected($client_rating, $i, false) . '>' . $i . ' ' . _n('Star', 'Stars', $i) . '</option>';
    }
    echo '</select>';
    echo '<p class="description">Client satisfaction rating</p>';
    echo '</div>';
    
    // Hint for featured image
    echo '<div class="testimonial-meta-field" style="margin-top: 15px;">';
    echo '<hr>';
    echo '<p class="description"><strong>Note:</strong> Set a featured image to display the client\'s photo.</p>';
    echo '</div>';
}

// Save testimonial meta box data
function save_testimonial_meta_data($post_id) {
    // Check if our nonce is set and verify it
    if (!isset($_POST['testimonial_meta_nonce']) || !wp_verify_nonce($_POST['testimonial_meta_nonce'], 'testimonial_meta_nonce')) {
        return;
    }
    
    // If doing autosave, don't save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Update meta fields
    if (isset($_POST['client_name'])) {
        update_post_meta($post_id, 'client_name', sanitize_text_field($_POST['client_name']));
    }
    
    if (isset($_POST['client_position'])) {
        update_post_meta($post_id, 'client_position', sanitize_text_field($_POST['client_position']));
    }
    
    if (isset($_POST['client_company'])) {
        update_post_meta($post_id, 'client_company', sanitize_text_field($_POST['client_company']));
    }
    
    if (isset($_POST['testimonial_content'])) {
        update_post_meta($post_id, 'testimonial_content', sanitize_textarea_field($_POST['testimonial_content']));
    }
    
    if (isset($_POST['client_rating'])) {
        $rating = min(5, max(1, intval($_POST['client_rating'])));
        update_post_meta($post_id, 'client_rating', $rating);
    }
}
add_action('save_post_testimonial', 'save_testimonial_meta_data');

function enqueue_about_us_styles() {
    // Only enqueue on the About Us page
    if (is_page_template('page-about-us.php') || is_page('about-us')) {
        // Enqueue Font Awesome for social media icons if needed
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_about_us_styles');

/**
 * Register Custom Post Types for About Us page
 */
function register_about_us_post_types() {
    // Register Award Custom Post Type
    register_post_type('award', array(
        'labels' => array(
            'name' => 'Awards',
            'singular_name' => 'Award',
            'add_new' => 'Add New Award',
            'add_new_item' => 'Add New Award',
            'edit_item' => 'Edit Award',
            'new_item' => 'New Award',
            'view_item' => 'View Award',
            'search_items' => 'Search Awards',
            'not_found' => 'No awards found',
            'not_found_in_trash' => 'No awards found in Trash',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-awards',
        'menu_position' => 20,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));

    // Register Team Member Custom Post Type
    register_post_type('team_member', array(
        'labels' => array(
            'name' => 'Team Members',
            'singular_name' => 'Team Member',
            'add_new' => 'Add New Team Member',
            'add_new_item' => 'Add New Team Member',
            'edit_item' => 'Edit Team Member',
            'new_item' => 'New Team Member',
            'view_item' => 'View Team Member',
            'search_items' => 'Search Team Members',
            'not_found' => 'No team members found',
            'not_found_in_trash' => 'No team members found in Trash',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-groups',
        'menu_position' => 20,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'register_about_us_post_types');

/**
 * Register ACF Fields for About Us page if ACF is active
 */
function register_about_us_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        // ACF Fields for About Us page
        acf_add_local_field_group(array(
            'key' => 'group_about_us_sections',
            'title' => 'About Us Sections',
            'fields' => array(
                // Timeline Section
                array(
                    'key' => 'field_show_timeline',
                    'label' => 'Show Timeline Section',
                    'name' => 'show_timeline',
                    'type' => 'true_false',
                    'default_value' => 1,
                    'ui' => 1,
                ),
                array(
                    'key' => 'field_timeline_title',
                    'label' => 'Timeline Title',
                    'name' => 'timeline_title',
                    'type' => 'text',
                    'default_value' => 'Through The Years',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_show_timeline',
                                'operator' => '==',
                                'value' => 1,
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_timeline_items',
                    'label' => 'Timeline Items',
                    'name' => 'timeline_items',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => 'Add Timeline Item',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_show_timeline',
                                'operator' => '==',
                                'value' => 1,
                            ),
                        ),
                    ),
                    'sub_fields' => array(
                        array(
                            'key' => 'field_year',
                            'label' => 'Year',
                            'name' => 'year',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'textarea',
                            'rows' => 3,
                        ),
                    ),
                ),

                // Mission Section
                array(
                    'key' => 'field_mission_title',
                    'label' => 'Mission Title',
                    'name' => 'mission_title',
                    'type' => 'text',
                    'default_value' => 'Our Mission',
                ),
                array(
                    'key' => 'field_mission_content',
                    'label' => 'Mission Content',
                    'name' => 'mission_content',
                    'type' => 'wysiwyg',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                ),

                // Vision Section
                array(
                    'key' => 'field_vision_title',
                    'label' => 'Vision Title',
                    'name' => 'vision_title',
                    'type' => 'text',
                    'default_value' => 'Our Vision',
                ),
                array(
                    'key' => 'field_vision_content',
                    'label' => 'Vision Content',
                    'name' => 'vision_content',
                    'type' => 'wysiwyg',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                ),

                // Certification Section
                array(
                    'key' => 'field_certification_title',
                    'label' => 'Certification Title',
                    'name' => 'certification_title',
                    'type' => 'text',
                    'default_value' => 'Certified Excellence',
                ),
                array(
                    'key' => 'field_certification_content',
                    'label' => 'Certification Content',
                    'name' => 'certification_content',
                    'type' => 'wysiwyg',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                ),
                array(
                    'key' => 'field_certification_logos',
                    'label' => 'Certification Logos',
                    'name' => 'certification_logos',
                    'type' => 'repeater',
                    'layout' => 'table',
                    'button_label' => 'Add Logo',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_logo',
                            'label' => 'Logo',
                            'name' => 'logo',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ),
                    ),
                ),

                // Awards Section
                array(
                    'key' => 'field_show_awards',
                    'label' => 'Show Awards Section',
                    'name' => 'show_awards',
                    'type' => 'true_false',
                    'default_value' => 1,
                    'ui' => 1,
                ),
                array(
                    'key' => 'field_awards_title',
                    'label' => 'Awards Title',
                    'name' => 'awards_title',
                    'type' => 'text',
                    'default_value' => 'Awards & Recognitions',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_show_awards',
                                'operator' => '==',
                                'value' => 1,
                            ),
                        ),
                    ),
                ),

                // Facilities Section
                array(
                    'key' => 'field_show_facilities',
                    'label' => 'Show Facilities Section',
                    'name' => 'show_facilities',
                    'type' => 'true_false',
                    'default_value' => 1,
                    'ui' => 1,
                ),
                array(
                    'key' => 'field_facilities_title',
                    'label' => 'Facilities Title',
                    'name' => 'facilities_title',
                    'type' => 'text',
                    'default_value' => 'Our Facilities',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_show_facilities',
                                'operator' => '==',
                                'value' => 1,
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_facilities_column_1',
                    'label' => 'Facilities Column 1',
                    'name' => 'facilities_column_1',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => 'Add Facility Item',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_show_facilities',
                                'operator' => '==',
                                'value' => 1,
                            ),
                        ),
                    ),
                    'sub_fields' => array(
                        array(
                            'key' => 'field_facility_item_1',
                            'label' => 'Facility Item',
                            'name' => 'facility_item',
                            'type' => 'text',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_facilities_column_2',
                    'label' => 'Facilities Column 2',
                    'name' => 'facilities_column_2',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => 'Add Facility Item',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_show_facilities',
                                'operator' => '==',
                                'value' => 1,
                            ),
                        ),
                    ),
                    'sub_fields' => array(
                        array(
                            'key' => 'field_facility_item_2',
                            'label' => 'Facility Item',
                            'name' => 'facility_item',
                            'type' => 'text',
                        ),
                    ),
                ),

                // Team Section
                array(
                    'key' => 'field_show_team',
                    'label' => 'Show Team Section',
                    'name' => 'show_team',
                    'type' => 'true_false',
                    'default_value' => 0,
                    'ui' => 1,
                ),
                array(
                    'key' => 'field_team_title',
                    'label' => 'Team Title',
                    'name' => 'team_title',
                    'type' => 'text',
                    'default_value' => 'Our Team',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_show_team',
                                'operator' => '==',
                                'value' => 1,
                            ),
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-about-us.php',
                    ),
                ),
                array(
                    array(
                        'param' => 'page',
                        'operator' => '==',
                        'value' => '{{about_us_page_id}}', // Replace with your About Us page ID
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));

        // ACF Fields for Award Custom Post Type
        acf_add_local_field_group(array(
            'key' => 'group_award_details',
            'title' => 'Award Details',
            'fields' => array(
                array(
                    'key' => 'field_award_icon',
                    'label' => 'Award Icon',
                    'name' => 'award_icon',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                ),
                array(
                    'key' => 'field_award_description',
                    'label' => 'Award Description',
                    'name' => 'award_description',
                    'type' => 'textarea',
                    'rows' => 4,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'award',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));

        // ACF Fields for Team Member Custom Post Type
        acf_add_local_field_group(array(
            'key' => 'group_team_member_details',
            'title' => 'Team Member Details',
            'fields' => array(
                array(
                    'key' => 'field_position',
                    'label' => 'Position',
                    'name' => 'position',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_linkedin_profile',
                    'label' => 'LinkedIn Profile URL',
                    'name' => 'linkedin_profile',
                    'type' => 'url',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'team_member',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));
    }
}
add_action('acf/init', 'register_about_us_acf_fields');



function create_itsulu_solutions_cpt() {
    $labels = array(
        'name' => 'Solutions',
        'singular_name' => 'Solution',
        'menu_name' => 'Solutions',
        'add_new_item' => 'Add New Solution',
        'edit_item' => 'Edit Solution',
    );

    $args = array(
        'label' => 'Solutions',
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-lightbulb',
        'has_archive' => true,
        'rewrite' => array('slug' => 'solutions'),
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
    );

    register_post_type('itsulu_solution', $args);
}
add_action('init', 'create_itsulu_solutions_cpt');


function register_solution_request_cpt() {
    register_post_type('solution_request', array(
        'labels' => array(
            'name' => 'Solution Requests',
            'singular_name' => 'Solution Request'
        ),
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-email-alt',
        'supports' => array('title', 'editor'),
        'capability_type' => 'post',
    ));
}
add_action('init', 'register_solution_request_cpt');

// function handle_solution_request_submission() {
//     if (
//         isset($_POST['solution_nonce']) &&
//         wp_verify_nonce($_POST['solution_nonce'], 'submit_solution_form')
//     ) {
//         $name = sanitize_text_field($_POST['name']);
//         $email = sanitize_email($_POST['email']);
//         $company = sanitize_text_field($_POST['company']);
//         $message = sanitize_textarea_field($_POST['message']);

//         $post_id = wp_insert_post(array(
//             'post_type' => 'solution_request',
//             'post_title' => $name . ' - ' . current_time('mysql'),
//             'post_content' => "Email: $email\nCompany: $company\n\nMessage:\n$message",
//             'post_status' => 'publish',
//         ));

//         wp_redirect(home_url('/thank-you'));
//         exit;
//     }
// }
// add_action('init', 'handle_solution_request_submission');

add_action('admin_post_nopriv_submit_solution_request', 'handle_solution_form_submission');
add_action('admin_post_submit_solution_request', 'handle_solution_form_submission');

function handle_solution_form_submission() {
    if (!isset($_POST['solution_nonce']) || !wp_verify_nonce($_POST['solution_nonce'], 'submit_solution_form')) {
        wp_die('Invalid form submission');
    }

    // Sanitize form fields
    $name    = sanitize_text_field($_POST['name']);
    $email   = sanitize_email($_POST['email']);
    $company = sanitize_text_field($_POST['company']);
    $phone   = sanitize_text_field($_POST['phone']);
    $message = sanitize_textarea_field($_POST['message']);

    // ✅ 1. Create a post in 'solution_request' post type

    $post_id = wp_insert_post(array(
            'post_type' => 'solution_request',
            'post_title' => $name . ' - ' . current_time('mysql'),
            'post_content' => "Email: $email\nCompany: $company\n\nMessage:\n$message",
            'post_status' => 'publish',
        ));

    if ($post_id && !is_wp_error($post_id)) {
        // Save meta fields
        update_post_meta($post_id, 'email', $email);
        update_post_meta($post_id, 'company', $company);
        update_post_meta($post_id, 'phone', $phone);
    }

    // ✅ 2. Admin notification email
    $to = 'kennedychongwobitcomm@gmail.com';
    $subject = 'New Solution Request from ' . $name;
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $email,
    ];
    $body = "
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Company:</strong> {$company}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";
    wp_mail($to, $subject, $body, $headers);

    // ✅ 3. Confirmation email to user
    $user_subject = 'Thanks for contacting Bitcomm Technologies!';
    $user_body = "
        <p>Hi {$name},</p>
        <p>Thanks for reaching out to <strong>Bitcomm Technologies</strong>! We've received your request and will get back to you shortly.</p>
        <p><strong>Your message:</strong><br>{$message}</p>
        <p>– The Bitcomm Team</p>
    ";
    wp_mail($email, $user_subject, $user_body, [
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: kennedychongwobitcomm@gmail.com',
    ]);

    // ✅ 4. Redirect
    wp_redirect(home_url('/thank-you'));
    exit;
}



add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('itsulu-debug-style', get_stylesheet_uri(), [], time());
});


function register_portfolio_cpt() {
    $labels = array(
        'name'                  => _x('Portfolio', 'Post Type General Name', 'itsulu-custom'),
        'singular_name'         => _x('Portfolio Item', 'Post Type Singular Name', 'itsulu-custom'),
        'menu_name'            => __('Portfolio', 'itsulu-custom'),
        'name_admin_bar'       => __('Portfolio Item', 'itsulu-custom'),
        'archives'             => __('Portfolio Archives', 'itsulu-custom'),
        'attributes'           => __('Portfolio Attributes', 'itsulu-custom'),
        'parent_item_colon'    => __('Parent Portfolio Item:', 'itsulu-custom'),
        'all_items'            => __('All Portfolio Items', 'itsulu-custom'),
        'add_new_item'         => __('Add New Portfolio Item', 'itsulu-custom'),
        'add_new'              => __('Add New', 'itsulu-custom'),
        'new_item'             => __('New Portfolio Item', 'itsulu-custom'),
        'edit_item'            => __('Edit Portfolio Item', 'itsulu-custom'),
        'update_item'          => __('Update Portfolio Item', 'itsulu-custom'),
        'view_item'            => __('View Portfolio Item', 'itsulu-custom'),
        'view_items'           => __('View Portfolio Items', 'itsulu-custom'),
        'search_items'         => __('Search Portfolio Item', 'itsulu-custom'),
        'not_found'            => __('Not found', 'itsulu-custom'),
        'not_found_in_trash'   => __('Not found in Trash', 'itsulu-custom'),
        'featured_image'       => __('Featured Image', 'itsulu-custom'),
        'set_featured_image'   => __('Set featured image', 'itsulu-custom'),
        'remove_featured_image' => __('Remove featured image', 'itsulu-custom'),
        'use_featured_image'   => __('Use as featured image', 'itsulu-custom'),
        'insert_into_item'     => __('Insert into portfolio item', 'itsulu-custom'),
        'uploaded_to_this_item' => __('Uploaded to this portfolio item', 'itsulu-custom'),
        'items_list'           => __('Portfolio items list', 'itsulu-custom'),
        'items_list_navigation' => __('Portfolio items list navigation', 'itsulu-custom'),
        'filter_items_list'    => __('Filter portfolio items list', 'itsulu-custom'),
    );
    $args = array(
        'label'                 => __('Portfolio Item', 'itsulu-custom'),
        'description'           => __('Portfolio items for your website', 'itsulu-custom'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'            => array('portfolio_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array(
            'slug'              => 'portfolio',
            'with_front'        => true,
            'pages'             => true,
            'feeds'             => true,
        ),
    );
    register_post_type('portfolio', $args);
}
add_action('init', 'register_portfolio_cpt', 0);


function register_testimonial_cpt() {
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor'),
        'has_archive' => false,
    ));
}
add_action('init', 'register_testimonial_cpt');


function register_homepage_cta_settings($wp_customize) {
    $wp_customize->add_section('cta_section', array(
        'title' => 'Homepage CTA',
        'priority' => 130,
    ));

    $wp_customize->add_setting('cta_heading', array('default' => 'Ready to start your digital transformation?'));
    $wp_customize->add_setting('cta_text', array('default' => 'Contact us today and let\'s build your custom solution.'));
    $wp_customize->add_setting('cta_button_text', array('default' => 'Get Your Solution'));
    $wp_customize->add_setting('cta_button_url', array('default' => '/get-your-solution'));
    $wp_customize->add_setting('cta_background_image', array('default' => get_template_directory_uri() . '/images/cta-bg.jpeg'));

    $wp_customize->add_control('cta_heading', array(
        'label' => 'CTA Heading',
        'section' => 'cta_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('cta_text', array(
        'label' => 'CTA Text',
        'section' => 'cta_section',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_control('cta_button_text', array(
        'label' => 'Button Text',
        'section' => 'cta_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_control('cta_button_url', array(
        'label' => 'Button URL',
        'section' => 'cta_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cta_background_image', array(
        'label' => 'Background Image',
        'section' => 'cta_section',
    )));
    
    // Add customizer section for Why Choose Us section
    $wp_customize->add_section('why_choose_us_section', array(
        'title' => 'Why Choose Us Section',
        'priority' => 132,
    ));

    // Why Choose Us Section Title
    $wp_customize->add_setting('why_choose_us_title', array(
        'default' => 'Why Choose Us',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('why_choose_us_title', array(
        'label' => 'Section Title',
        'section' => 'why_choose_us_section',
        'type' => 'text',
    ));

    // Why Choose Us Section Subtitle
    $wp_customize->add_setting('why_choose_us_subtitle', array(
        'default' => 'Discover what sets us apart in delivering exceptional IT solutions',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('why_choose_us_subtitle', array(
        'label' => 'Section Subtitle',
        'section' => 'why_choose_us_section',
        'type' => 'textarea',
    ));

    // Add customizer section for Our Approach section
    $wp_customize->add_section('approach_section', array(
        'title' => 'Our Approach Section',
        'priority' => 131,
    ));

    // Our Approach Section Title
    $wp_customize->add_setting('approach_section_title', array(
        'default' => 'Our Approach',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('approach_section_title', array(
        'label' => 'Section Title',
        'section' => 'approach_section',
        'type' => 'text',
    ));

    // Our Approach Section Subtitle
    $wp_customize->add_setting('approach_section_subtitle', array(
        'default' => 'We combine local market knowledge with global IT expertise to deliver solutions that address the unique challenges Kenyan businesses face.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('approach_section_subtitle', array(
        'label' => 'Section Subtitle',
        'section' => 'approach_section',
        'type' => 'textarea',
    ));
    
    // Add customizer section for Testimonials section
    $wp_customize->add_section('testimonials_section', array(
        'title' => 'Testimonials Section',
        'priority' => 133,
    ));

    // Testimonials Section Title
    $wp_customize->add_setting('testimonials_section_title', array(
        'default' => 'What Our Clients Say',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('testimonials_section_title', array(
        'label' => 'Section Title',
        'section' => 'testimonials_section',
        'type' => 'text',
    ));

    // Testimonials Section Subtitle
    $wp_customize->add_setting('testimonials_section_subtitle', array(
        'default' => 'Don\'t just take our word for it. See what our clients throughout Kenya have to say about our IT solutions and service.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('testimonials_section_subtitle', array(
        'label' => 'Section Subtitle',
        'section' => 'testimonials_section',
        'type' => 'textarea',
    ));
    
    // Testimonials Count
    $wp_customize->add_setting('testimonials_count', array(
        'default' => 6,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('testimonials_count', array(
        'label' => 'Number of Testimonials',
        'section' => 'testimonials_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 12,
            'step' => 1,
        ),
    ));
    
    // Testimonials CTA Text
    $wp_customize->add_setting('testimonials_cta_text', array(
        'default' => 'Work With Us',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('testimonials_cta_text', array(
        'label' => 'CTA Button Text',
        'section' => 'testimonials_section',
        'type' => 'text',
    ));
    
    // Add customizer section for Portfolio section
    $wp_customize->add_section('portfolio_section', array(
        'title' => 'Portfolio Section',
        'priority' => 134,
    ));

    // Portfolio Section Title
    $wp_customize->add_setting('portfolio_section_title', array(
        'default' => 'Our Work',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('portfolio_section_title', array(
        'label' => 'Section Title',
        'section' => 'portfolio_section',
        'type' => 'text',
    ));

    // Portfolio Section Subtitle
    $wp_customize->add_setting('portfolio_section_subtitle', array(
        'default' => 'Explore our latest projects and see how we\'ve helped businesses transform.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('portfolio_section_subtitle', array(
        'label' => 'Section Subtitle',
        'section' => 'portfolio_section',
        'type' => 'textarea',
    ));
    
    // Portfolio Items Count
    $wp_customize->add_setting('homepage_portfolio_count', array(
        'default' => 3,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('homepage_portfolio_count', array(
        'label' => 'Number of Projects',
        'section' => 'portfolio_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 9,
            'step' => 1,
        ),
    ));
    
    // Portfolio View Button Text
    $wp_customize->add_setting('portfolio_view_btn_text', array(
        'default' => 'View Project',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('portfolio_view_btn_text', array(
        'label' => 'View Button Text',
        'section' => 'portfolio_section',
        'type' => 'text',
    ));
    
    // Portfolio All Projects Button Text
    $wp_customize->add_setting('portfolio_all_btn_text', array(
        'default' => 'View All Projects',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('portfolio_all_btn_text', array(
        'label' => 'All Projects Button Text',
        'section' => 'portfolio_section',
        'type' => 'text',
    ));
}
add_action('customize_register', 'register_homepage_cta_settings');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


require_once get_template_directory() . '/inc/class-bootstrap-navwalker.php';

// Include About Us CPTs
require_once get_template_directory() . '/inc/about-us-cpts.php';

// Include Legal Pages CPTs
// require_once get_template_directory() . '/inc/legal-pages-cpts.php';

// Add this function to debug footer template loading
function debug_footer_template($template) {
    error_log('Footer template being loaded: ' . $template);
    return $template;
}
add_filter('template_include', 'debug_footer_template');

/**
 * Ensure WordPress always uses the main footer.php file
 */
function itsulu_custom_footer_template($template) {
    if (strpos($template, 'footer') !== false && $template !== get_template_directory() . '/footer.php') {
        return get_template_directory() . '/footer.php';
    }
    return $template;
}
add_filter('template_include', 'itsulu_custom_footer_template');

// Include portfolio taxonomy
require get_template_directory() . '/inc/portfolio-taxonomy.php';

// Include custom post types
require get_template_directory() . '/inc/custom-post-types.php';

// Include Bootstrap 5 Nav Walker
require get_template_directory() . '/inc/class-bootstrap-5-nav-walker.php';

// Add Customizer Settings
function itsulu_customize_register($wp_customize) {
    // REMOVED Hero Section Settings (replaced by Hero Slider in inc/customizer.php)

    // Footer Settings
    $wp_customize->add_section('footer_section', array(
        'title' => __('Footer Settings', 'itsulu-custom'),
        'priority' => 40,
    ));

    // Footer Description
    $wp_customize->add_setting('footer_description', array(
        'default' => 'Leading IT consultancy firm providing cutting-edge technology solutions to transform businesses and drive digital innovation across Kenya and beyond.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('footer_description', array(
        'label' => __('Footer Description', 'itsulu-custom'),
        'section' => 'footer_section',
        'type' => 'textarea',
    ));

    // Contact Information
    $wp_customize->add_setting('footer_address', array(
        'default' => 'Nairobi, Kenya',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_address', array(
        'label' => __('Address', 'itsulu-custom'),
        'section' => 'footer_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_phone', array(
        'default' => '+254 738 788010',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_phone', array(
        'label' => __('Phone Number', 'itsulu-custom'),
        'section' => 'footer_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_email', array(
        'default' => 'kennedychongwobitcomm@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('footer_email', array(
        'label' => __('Email Address', 'itsulu-custom'),
        'section' => 'footer_section',
        'type' => 'email',
    ));

    $wp_customize->add_setting('footer_working_hours', array(
        'default' => 'Mon-Fri: 8:00 AM - 5:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_working_hours', array(
        'label' => __('Working Hours', 'itsulu-custom'),
        'section' => 'footer_section',
        'type' => 'text',
    ));

    // Social Media Links
    $social_platforms = array(
        'facebook' => __('Facebook', 'itsulu-custom'),
        'twitter' => __('Twitter', 'itsulu-custom'),
        'linkedin' => __('LinkedIn', 'itsulu-custom'),
        'instagram' => __('Instagram', 'itsulu-custom'),
    );

    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting("footer_{$platform}_url", array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("footer_{$platform}_url", array(
            'label' => sprintf(__('%s URL', 'itsulu-custom'), $label),
            'section' => 'footer_section',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'itsulu_customize_register');

// Handle contact form submission
function handle_contact_form_submission() {
    // Verify nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_send_json_error('Invalid nonce');
    }

    // Sanitize and validate input
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_send_json_error('All fields are required');
    }

    if (!is_email($email)) {
        wp_send_json_error('Please enter a valid email address');
    }

    // Get recipient email from theme mod
    $to = get_theme_mod('footer_email', 'kennedychongwobitcomm@gmail.com');
    
    // Email headers
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );

    // Email content
    $email_content = sprintf(
        '<h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> %s</p>
        <p><strong>Email:</strong> %s</p>
        <p><strong>Subject:</strong> %s</p>
        <p><strong>Message:</strong></p>
        <p>%s</p>',
        $name,
        $email,
        $subject,
        nl2br($message)
    );

    // Send email
    $sent = wp_mail($to, $subject, $email_content, $headers);

    if ($sent) {
        wp_send_json_success('Email sent successfully');
    } else {
        wp_send_json_error('Failed to send email');
    }
}
add_action('wp_ajax_send_contact_email', 'handle_contact_form_submission');
add_action('wp_ajax_nopriv_send_contact_email', 'handle_contact_form_submission');

/**
 * Display breadcrumbs navigation
 */
function itsulu_breadcrumbs() {
    if (!is_front_page()) {
        echo '<nav aria-label="breadcrumb" class="breadcrumb-nav py-3">';
        echo '<div class="container">';
        echo '<ol class="breadcrumb mb-0">';
        echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
        
        if (is_page()) {
            $ancestors = get_post_ancestors(get_the_ID());
            if ($ancestors) {
                $ancestors = array_reverse($ancestors);
                foreach ($ancestors as $ancestor) {
                    echo '<li class="breadcrumb-item"><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                }
            }
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
        } elseif (is_singular('itsulu_solution')) {
            echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/our-solutions')) . '">Our Solutions</a></li>';
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
        } elseif (is_singular('itsulu_service')) {
            echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/services-2')) . '">Our Services</a></li>';
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
        } elseif (is_post_type_archive('portfolio')) {
            echo '<li class="breadcrumb-item active" aria-current="page">Portfolio</li>';
        } elseif (is_singular('portfolio')) {
            echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/portfolio')) . '">Portfolio</a></li>';
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
        }
        
        echo '</ol>';
        echo '</div>';
        echo '</nav>';
    }
}

/**
 * Handle Hero Newsletter Signup.  */
// function itsulu_handle_hero_newsletter_signup() {
//     if (isset($_POST['action']) && $_POST['action'] === 'hero_newsletter_signup') {
//         // Verify nonce
//         if (!isset($_POST['hero_newsletter_nonce']) || !wp_verify_nonce($_POST['hero_newsletter_nonce'], 'hero_newsletter_signup_action')) {
//             wp_redirect(add_query_arg('newsletter_status', 'nonce_error', home_url()));
//             exit;
//         }

//         // Sanitize and validate email
//         $submitted_email = isset($_POST['hero_signup_email']) ? sanitize_email($_POST['hero_signup_email']) : '';
//         if (!is_email($submitted_email)) {
//             wp_redirect(add_query_arg('newsletter_status', 'email_error', home_url() . '#newsletter-form-anchor')); // Added an anchor
//             exit;
//         }

//         // Get recipient email from Customizer
//         $recipient_email = get_theme_mod('hero_newsletter_recipient_email', get_option('admin_email'));
//         if (!is_email($recipient_email)) {
//             // Fallback if recipient email is somehow invalid
//             $recipient_email = get_option('admin_email');
//         }

//         $subject = __('New Newsletter Signup', 'itsulu-custom');
//         $body    = sprintf(__('You have a new newsletter signup from: %s', 'itsulu-custom'), $submitted_email);
//         $headers = array('Content-Type: text/html; charset=UTF-8');

//         // Send notification email to admin
//         $admin_mail_sent = wp_mail($recipient_email, $subject, $body, $headers);

//         // Send confirmation email to user
//         if ($admin_mail_sent) { // Optional: Only send user confirmation if admin email was sent ok
//             $user_subject = __('Subscription Confirmed - Welcome!', 'itsulu-custom');
//             $user_body    = sprintf(
//                 __('<p>Hi there,</p><p>Thanks for subscribing to our newsletter! You\'ll now receive updates directly in your inbox.</p><p>Best regards,<br>%s</p>', 'itsulu-custom'), 
//                 get_bloginfo('name')
//             );
//             $user_headers = array(
//                 'Content-Type: text/html; charset=UTF-8',
//                 'From: ' . get_bloginfo('name') . ' <' . $recipient_email . '>', // Send from the recipient (admin) email, or a dedicated no-reply@yourdomain.com
//                 'Reply-To: ' . $recipient_email // Set reply-to to the admin email
//             );
//             wp_mail($submitted_email, $user_subject, $user_body, $user_headers); 
//             // We don't necessarily need to check the success of this one before redirecting,
//             // but you could add error handling if needed.
//         }

//         // Redirect based on admin mail success
//         if ($admin_mail_sent) {
//             wp_redirect(add_query_arg('newsletter_status', 'success', home_url() . '#newsletter-form-anchor'));
//             exit;
//         } else {
//             wp_redirect(add_query_arg('newsletter_status', 'send_error', home_url() . '#newsletter-form-anchor'));
//             exit;
//         }
//     }
// }
// add_action('template_redirect', 'itsulu_handle_hero_newsletter_signup'); 
// // Using template_redirect as it's a common hook for handling form submissions before headers are sent.
// // init could also be used.

/**
 * Display Hero Newsletter Signup Messages.
 */
function itsulu_display_hero_newsletter_messages() {
    if (isset($_GET['newsletter_status'])) {
        $status = sanitize_text_field($_GET['newsletter_status']);
        $message = '';
        $message_class = 'newsletter-message';

        if ($status === 'success') {
            $message = __('Thank you for subscribing!', 'itsulu-custom');
            $message_class .= ' success';
        } elseif ($status === 'email_error') {
            $message = __('Please enter a valid email address.', 'itsulu-custom');
            $message_class .= ' error';
        } elseif ($status === 'nonce_error') {
            $message = __('Security check failed. Please try again.', 'itsulu-custom');
            $message_class .= ' error';
        } elseif ($status === 'send_error') {
            $message = __('Could not send email. Please try again later.', 'itsulu-custom');
            $message_class .= ' error';
        }

        if (!empty($message)) {
            // Note: We'll add an ID "newsletter-form-anchor" to the form in front-page.php
            // This return will be used in front-page.php
            return '<div class="' . esc_attr($message_class) . '">' . esc_html($message) . '</div>';
        }
    }
    return ''; // Return empty string if no status
}
// No need to hook itsulu_display_hero_newsletter_messages directly,
// we will call it from front-page.php

// Register approach_item custom post type
function register_approach_item_cpt() {
    register_post_type('approach_item', array(
        'labels' => array(
            'name' => 'Approach Items',
            'singular_name' => 'Approach Item',
            'add_new' => 'Add New Item',
            'add_new_item' => 'Add New Approach Item',
            'edit_item' => 'Edit Approach Item',
            'all_items' => 'All Approach Items',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-lightbulb',
        'supports' => array('title', 'editor', 'page-attributes'),
        'has_archive' => false,
        'rewrite' => array('slug' => 'approach'),
        'menu_position' => 20,
        'show_in_rest' => true,
    ));
}
add_action('init', 'register_approach_item_cpt');

// Add icon meta box for approach items
function approach_icon_meta_box() {
    add_meta_box(
        'approach_icon_meta_box',
        'Icon Settings',
        'approach_icon_meta_box_callback',
        'approach_item',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'approach_icon_meta_box');

// Meta box callback
function approach_icon_meta_box_callback($post) {
    // Add a nonce field for security
    wp_nonce_field('approach_icon_meta_box_nonce', 'approach_icon_meta_box_nonce');
    
    // Get the saved icon value
    $icon = get_post_meta($post->ID, 'approach_icon', true);
    
    // Icon options
    $icon_options = array(
        'fa-handshake' => 'Handshake',
        'fa-cogs' => 'Cogs/Gears',
        'fa-chart-line' => 'Chart/Growth',
        'fa-lightbulb' => 'Lightbulb/Idea',
        'fa-users' => 'Team/Users',
        'fa-shield-alt' => 'Shield/Security',
        'fa-code' => 'Code',
        'fa-server' => 'Server',
        'fa-tools' => 'Tools',
        'fa-cloud' => 'Cloud',
        'fa-rocket' => 'Rocket/Launch',
        'fa-laptop-code' => 'Laptop',
        'fa-globe' => 'Globe'
    );
    
    // Output the icon selector
    echo '<label for="approach_icon">Select an icon:</label>';
    echo '<select id="approach_icon" name="approach_icon" class="widefat">';
    
    foreach ($icon_options as $value => $label) {
        echo '<option value="' . esc_attr($value) . '" ' . selected($icon, $value, false) . '>' . esc_html($label) . '</option>';
    }
    
    echo '</select>';
    echo '<p class="description">Choose an icon for this approach item.</p>';
}

// Save meta box data
function save_approach_icon_meta_box($post_id) {
    // Check if our nonce is set and verify it
    if (!isset($_POST['approach_icon_meta_box_nonce']) || !wp_verify_nonce($_POST['approach_icon_meta_box_nonce'], 'approach_icon_meta_box_nonce')) {
        return;
    }
    
    // If doing autosave, don't save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save the icon value
    if (isset($_POST['approach_icon'])) {
        update_post_meta($post_id, 'approach_icon', sanitize_text_field($_POST['approach_icon']));
    }
}
add_action('save_post_approach_item', 'save_approach_icon_meta_box');

// Add this after register_testimonial_post_type function

/**
 * Flush rewrite rules on theme activation or when testimonial rewrite rules change
 */
function flush_testimonial_rewrite_rules() {
    // This will make sure the rewrite rules are flushed on the next page load
    set_transient('testimonial_flush_rewrite_rules', true);
}
register_activation_hook(__FILE__, 'flush_testimonial_rewrite_rules');

function testimonial_check_flush_rewrite_rules() {
    if (get_transient('testimonial_flush_rewrite_rules')) {
        flush_rewrite_rules();
        delete_transient('testimonial_flush_rewrite_rules');
    }
}
add_action('init', 'testimonial_check_flush_rewrite_rules', 20);

// Create a custom menu function to manually flush the rewrite rules
function bitcomm_flush_rewrite_rules_menu() {
    add_management_page(
        'Flush Rewrite Rules',
        'Flush Rewrite Rules',
        'manage_options',
        'flush-rules',
        'bitcomm_flush_rewrite_rules_callback'
    );
}
add_action('admin_menu', 'bitcomm_flush_rewrite_rules_menu');

function bitcomm_flush_rewrite_rules_callback() {
    echo '<div class="wrap">';
    echo '<h1>Flush Rewrite Rules</h1>';
    
    // Flush rewrite rules
    flush_rewrite_rules();
    
    echo '<div class="updated notice is-dismissible"><p>Rewrite rules have been flushed!</p></div>';
    echo '<p>You can now close this page.</p>';
    echo '</div>';
}

/**
 * Add meta boxes for service post type
 */
function itsulu_service_meta_boxes() {
    // Add service icon meta box
    add_meta_box(
        'service_icon_meta_box',
        'Service Icon',
        'service_icon_meta_box_callback',
        'itsulu_service',
        'side',
        'default'
    );

    // Add service short description meta box
    add_meta_box(
        'service_short_description_meta_box',
        'Short Description',
        'service_short_description_meta_box_callback',
        'itsulu_service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'itsulu_service_meta_boxes');

/**
 * Service icon meta box callback
 */
function service_icon_meta_box_callback($post) {
    wp_nonce_field('service_icon_meta_box_nonce', 'service_icon_meta_box_nonce');
    
    // Get the saved icon value
    $icon = get_post_meta($post->ID, 'service_icon', true);
    
    // Icon options
    $icon_options = array(
        'fa-laptop-code' => 'Laptop/Code',
        'fa-server' => 'Server',
        'fa-cloud' => 'Cloud',
        'fa-mobile-alt' => 'Mobile',
        'fa-desktop' => 'Desktop/PC',
        'fa-database' => 'Database',
        'fa-cogs' => 'Gears/Settings',
        'fa-code' => 'Code',
        'fa-shield-alt' => 'Security/Shield',
        'fa-globe' => 'Globe/Web',
        'fa-chart-line' => 'Analytics/Chart',
        'fa-lightbulb' => 'Idea/Lightbulb',
        'fa-robot' => 'AI/Robot',
        'fa-network-wired' => 'Network',
        'fa-sitemap' => 'Sitemap/Structure',
        'fa-brain' => 'AI/Machine Learning',
        'fa-project-diagram' => 'Project/Diagram',
        'fa-headset' => 'Support/Headset'
    );
    
    // Output the icon selector
    echo '<label for="service_icon">Select an icon for this service:</label>';
    echo '<select id="service_icon" name="service_icon" class="widefat">';
    
    foreach ($icon_options as $value => $label) {
        echo '<option value="' . esc_attr($value) . '" ' . selected($icon, $value, false) . '>' . esc_html($label) . '</option>';
    }
    
    echo '</select>';
    echo '<p class="description">This icon will be displayed with the service.</p>';
}

/**
 * Service short description meta box callback
 */
function service_short_description_meta_box_callback($post) {
    wp_nonce_field('service_short_description_meta_box_nonce', 'service_short_description_meta_box_nonce');
    
    // Get the saved short description
    $short_description = get_post_meta($post->ID, 'service_short_description', true);
    
    // Output the editor
    echo '<label for="service_short_description">Enter a brief description of this service:</label>';
    echo '<textarea id="service_short_description" name="service_short_description" class="widefat" rows="3">' . esc_textarea($short_description) . '</textarea>';
    echo '<p class="description">This description will appear in service listings and at the top of the service page.</p>';
}

/**
 * Save service meta data
 */
function save_service_meta_data($post_id) {
    // Check service icon meta box
    if (isset($_POST['service_icon_meta_box_nonce']) && wp_verify_nonce($_POST['service_icon_meta_box_nonce'], 'service_icon_meta_box_nonce')) {
        if (isset($_POST['service_icon'])) {
            update_post_meta($post_id, 'service_icon', sanitize_text_field($_POST['service_icon']));
        }
    }
    
    // Check service short description meta box
    if (isset($_POST['service_short_description_meta_box_nonce']) && wp_verify_nonce($_POST['service_short_description_meta_box_nonce'], 'service_short_description_meta_box_nonce')) {
        if (isset($_POST['service_short_description'])) {
            update_post_meta($post_id, 'service_short_description', sanitize_textarea_field($_POST['service_short_description']));
        }
    }
}
add_action('save_post_itsulu_service', 'save_service_meta_data');

/**
 * Register ACF fields for Services custom post type
 */
function register_service_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_service_details',
            'title' => 'Service Details',
            'fields' => array(
                array(
                    'key' => 'field_service_icon',
                    'label' => 'Service Icon',
                    'name' => 'service_icon',
                    'type' => 'select',
                    'instructions' => 'Select an icon that represents this service',
                    'choices' => array(
                        'fa-laptop-code' => 'Laptop/Code',
                        'fa-server' => 'Server',
                        'fa-cloud' => 'Cloud',
                        'fa-mobile-alt' => 'Mobile',
                        'fa-desktop' => 'Desktop/PC',
                        'fa-database' => 'Database',
                        'fa-cogs' => 'Gears/Settings',
                        'fa-code' => 'Code',
                        'fa-shield-alt' => 'Security/Shield',
                        'fa-globe' => 'Globe/Web',
                        'fa-chart-line' => 'Analytics/Chart',
                        'fa-lightbulb' => 'Idea/Lightbulb',
                        'fa-robot' => 'AI/Robot',
                        'fa-network-wired' => 'Network',
                        'fa-sitemap' => 'Sitemap/Structure',
                        'fa-brain' => 'AI/Machine Learning',
                        'fa-project-diagram' => 'Project/Diagram',
                        'fa-headset' => 'Support/Headset'
                    ),
                    'default_value' => 'fa-laptop-code',
                    'return_format' => 'value',
                    'ui' => 1,
                ),
                array(
                    'key' => 'field_service_short_description',
                    'label' => 'Short Description',
                    'name' => 'service_short_description',
                    'type' => 'textarea',
                    'instructions' => 'Brief description of this service (shown in listings and page header)',
                    'rows' => 3,
                ),
                array(
                    'key' => 'field_service_benefits',
                    'label' => 'Service Benefits',
                    'name' => 'service_benefits',
                    'type' => 'repeater',
                    'instructions' => 'Add benefits of this service',
                    'layout' => 'block',
                    'button_label' => 'Add Benefit',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_benefit_icon',
                            'label' => 'Icon',
                            'name' => 'benefit_icon',
                            'type' => 'select',
                            'instructions' => 'Choose an icon for this benefit',
                            'choices' => array(
                                'fa-chart-line' => 'Growth/Chart',
                                'fa-tachometer-alt' => 'Speed/Performance',
                                'fa-shield-alt' => 'Security/Shield',
                                'fa-money-bill-wave' => 'Cost/Money',
                                'fa-check' => 'Check Mark',
                                'fa-clock' => 'Time/Clock',
                                'fa-users' => 'Team/Users',
                                'fa-cog' => 'Settings/Gear',
                                'fa-search' => 'Search/Magnifying Glass',
                                'fa-bullseye' => 'Target/Bullseye',
                                'fa-lock' => 'Security/Lock',
                                'fa-sync' => 'Sync/Refresh',
                                'fa-tools' => 'Tools',
                                'fa-thumbs-up' => 'Approval/Thumbs Up'
                            ),
                            'default_value' => 'fa-check',
                            'ui' => 1,
                        ),
                        array(
                            'key' => 'field_benefit_title',
                            'label' => 'Title',
                            'name' => 'benefit_title',
                            'type' => 'text',
                            'instructions' => 'Enter the benefit title',
                        ),
                        array(
                            'key' => 'field_benefit_description',
                            'label' => 'Description',
                            'name' => 'benefit_description',
                            'type' => 'textarea',
                            'instructions' => 'Enter a brief description of this benefit',
                            'rows' => 3,
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'itsulu_service',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));
    }
}
add_action('acf/init', 'register_service_acf_fields');

/**
 * Handle modal contact form submission
 */
function handle_modal_contact_form() {
    // Verify nonce
    if (!isset($_POST['modal_contact_nonce']) || !wp_verify_nonce($_POST['modal_contact_nonce'], 'modal_contact_nonce')) {
        wp_send_json_error(array('message' => 'Security check failed. Please try again.'));
    }
    
    // Get form data and ensure consistent naming
    $name = isset($_POST['modal_name']) ? sanitize_text_field($_POST['modal_name']) : '';
    $email = isset($_POST['modal_email']) ? sanitize_email($_POST['modal_email']) : '';
    $subject = isset($_POST['modal_subject']) ? sanitize_text_field($_POST['modal_subject']) : '';
    $message = isset($_POST['modal_message']) ? sanitize_textarea_field($_POST['modal_message']) : '';
    
    // Validate data
    if (empty($name) || empty($subject) || empty($message) || !is_email($email)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields.'));
    }
    
    // Get recipient email from theme mod or fallback to admin email
    $recipient = get_theme_mod('footer_email', get_option('admin_email'));
    
    // Set email headers
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );
    
    // Email content
    $email_content = '<h2>New Contact Form Submission</h2>' .
                     '<p><strong>Name:</strong> ' . $name . '</p>' .
                     '<p><strong>Email:</strong> ' . $email . '</p>' .
                     '<p><strong>Subject:</strong> ' . $subject . '</p>' .
                     '<p><strong>Message:</strong></p>' .
                     '<p>' . nl2br($message) . '</p>';
    
    // Send email
    $mail_sent = wp_mail($recipient, 'Contact Form: ' . $subject, $email_content, $headers);
    
    // Log the attempt
    error_log('Modal contact form submission - Mail sent: ' . ($mail_sent ? 'success' : 'failed'));
    error_log('Modal contact form recipient: ' . $recipient);
    
    if ($mail_sent) {
        // Send confirmation email to the user
        $user_subject = 'Thank you for contacting Bitcomm Technologies';
        $user_message = '<p>Dear ' . $name . ',</p>' .
                        '<p>Thank you for contacting us. We have received your message and will get back to you as soon as possible.</p>' .
                        '<p>Your message:</p>' .
                        '<p>' . nl2br($message) . '</p>' .
                        '<p>Best regards,<br>Bitcomm Technologies Team</p>';
        
        $user_headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: Bitcomm Technologies <' . $recipient . '>',
            'Reply-To: ' . $recipient
        );
        
        wp_mail($email, $user_subject, $user_message, $user_headers);
        
        wp_send_json_success(array('message' => 'Your message has been sent successfully! We will get back to you soon.'));
    } else {
        wp_send_json_error(array('message' => 'Failed to send email. Please try again or contact us directly.'));
    }
}
add_action('wp_ajax_send_modal_email', 'handle_modal_contact_form');
add_action('wp_ajax_nopriv_send_modal_email', 'handle_modal_contact_form');

/**
 * Handle newsletter subscription with unique function name
    */

function handle_itsulu_newsletter_subscription() {
    if (!headers_sent()) {
        // It's good practice to set the content type for JSON responses.
        header('Content-Type: application/json; charset=' . get_option('blog_charset'));
    }

    // Log the beginning of the request for debugging
    error_log('AJAX (handle_itsulu_newsletter_subscription) POST data: ' . print_r($_POST, true));

    // Check if it's a valid AJAX request (WordPress standard check)
    if (!defined('DOING_AJAX') || !DOING_AJAX) {
        error_log('Newsletter Error: Invalid request type. Not an AJAX request from DOING_AJAX.');
        wp_send_json_error(array('message' => 'Invalid request type.'), 400); // Send HTTP status code
        return; // wp_send_json_error includes wp_die()
    }

    // Verify nonce
    // Use check_ajax_referer for better security in AJAX handlers
    if (!check_ajax_referer('subscribe_newsletter_nonce', 'subscribe_nonce', false)) {
        error_log('Newsletter Error: Nonce verification failed.');
        wp_send_json_error(array('message' => 'Security check failed. Please refresh and try again.'), 403);
        return;
    }

    // Get and validate email
    if (!isset($_POST['subscriber_email']) || empty(trim($_POST['subscriber_email']))) {
        error_log('Newsletter Error: Subscriber email not provided or empty.');
        wp_send_json_error(array('message' => 'Email address is required.'), 400);
        return;
    }
    $subscriber_email = sanitize_email(wp_unslash(trim($_POST['subscriber_email']))); // Add trim and wp_unslash

    if (!is_email($subscriber_email)) {
        error_log('Newsletter Error: Invalid email address provided: ' . esc_html($_POST['subscriber_email']));
        wp_send_json_error(array('message' => 'Please enter a valid email address.'), 400);
        return;
    }

    try {
        $subscribers_list_option_name = 'itsulu_newsletter_subscribers';
        $subscribers_details_option_name = 'itsulu_subscribers_data';

        $existing_subscribers = get_option($subscribers_list_option_name, array());
        if (!is_array($existing_subscribers)) { // Ensure it's an array, reset if not
            error_log("Newsletter Warning: Option '$subscribers_list_option_name' was not an array. Resetting to empty array.");
            $existing_subscribers = array();
        }

        // Case-insensitive check for existing email
        $email_already_exists = false;
        foreach ($existing_subscribers as $existing_email) {
            if (strtolower((string)$existing_email) === strtolower($subscriber_email)) {
                $email_already_exists = true;
                break;
            }
        }

        if ($email_already_exists) {
            error_log('Newsletter Info: Email ' . esc_html($subscriber_email) . ' already subscribed.');
            wp_send_json_success(array('message' => 'This email is already subscribed to our newsletter.'));
            return;
        }

        // Email is new, add it to the array.
        $new_subscriber_list = $existing_subscribers; // Copy existing
        $new_subscriber_list[] = $subscriber_email;   // Add new one
        // array_unique is good, especially if there were other ways duplicates could get in.
        // Using array_map with strtolower ensures true case-insensitive uniqueness if needed,
        // but our manual check should handle the current email. For simplicity, array_values(array_unique(...)) is fine.
        $new_subscriber_list = array_values(array_unique($new_subscriber_list));


        // Attempt to update the option
        $subscription_saved = update_option($subscribers_list_option_name, $new_subscriber_list);

        if ($subscription_saved) {
            error_log('Newsletter Success: Email ' . esc_html($subscriber_email) . " added to '$subscribers_list_option_name'.");

            // Save additional subscriber data
            $subscribers_details = get_option($subscribers_details_option_name, array());
            if (!is_array($subscribers_details)) { // Ensure it's an array
                $subscribers_details = array();
            }
            // Use lowercase email as key for consistency, or the exact email if preferred
            $subscribers_details[strtolower($subscriber_email)] = array(
                'date_subscribed' => current_time('mysql', 1), // GMT time
                'ip_address'      => sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'] ?? '')),
                'user_agent'      => isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field(wp_unslash($_SERVER['HTTP_USER_AGENT'])) : ''
            );
            update_option($subscribers_details_option_name, $subscribers_details);
            error_log('Newsletter Success: Details for ' . esc_html($subscriber_email) . " saved to '$subscribers_details_option_name'.");

            // Send notification emails (optional, can be silenced with @)
            $admin_email_address = get_option('admin_email');
            $site_name = get_bloginfo('name');
            $from_email = apply_filters('wp_mail_from', get_option('admin_email')); // Use WP's from email

            // Admin notification
            $admin_subject = 'New Newsletter Subscriber: ' . $subscriber_email;
            $admin_message = "A new user has subscribed to your newsletter.\n\n" .
                             "Email: $subscriber_email\n" .
                             "Date: " . current_time('mysql') . "\n" . // Local time for display
                             "Total subscribers in '$subscribers_list_option_name': " . count($new_subscriber_list) . "\n";
            $admin_headers = array(
                'Content-Type: text/plain; charset=UTF-8',
                'From: ' . $site_name . ' <' . $from_email . '>'
            );
            @wp_mail($admin_email_address, $admin_subject, $admin_message, $admin_headers);

            // Subscriber confirmation
            $subscriber_subject = 'Welcome to the ' . $site_name . ' Newsletter';
            $subscriber_message_body = "<h2>Thank you for subscribing to our newsletter!</h2>" .
                                      "<p>You'll receive updates on our services, latest tech news, and industry insights.</p>" .
                                      "<p>Regards,<br>" . $site_name . " Team</p>";
            $subscriber_headers = array(
                'Content-Type: text/html; charset=UTF-8',
                'From: ' . $site_name . ' <' . $from_email . '>'
            );
            @wp_mail($subscriber_email, $subscriber_subject, $subscriber_message_body, $subscriber_headers);

            wp_send_json_success(array('message' => 'Thank you for subscribing to our newsletter!'));

        } else {
            // update_option returned false. This means the value wasn't changed (already there and identical) or a DB error.
            // Re-check if the email is indeed in the list now.
            $current_list_after_failed_update = get_option($subscribers_list_option_name, array());
            if (!is_array($current_list_after_failed_update)) { $current_list_after_failed_update = array(); }

            $email_is_now_present = false;
            foreach ($current_list_after_failed_update as $email_in_list) {
                if (strtolower((string)$email_in_list) === strtolower($subscriber_email)) {
                    $email_is_now_present = true;
                    break;
                }
            }

            if ($email_is_now_present) {
                // This can happen if update_option found the new value to be identical to the old one.
                error_log('Newsletter Info: Email ' . esc_html($subscriber_email) . " was already present (update_option returned false but email found). Treating as already subscribed.");
                wp_send_json_success(array('message' => 'This email is already subscribed. (Verified)'));
            } else {
                error_log('Newsletter Error: Failed to save email ' . esc_html($subscriber_email) . " to '$subscribers_list_option_name'. update_option returned false and email not found after attempt.");
                wp_send_json_error(array('message' => 'There was an error saving your subscription. Please try again. (Code: UO_SAVE_FAILED)'), 500);
            }
        }

    } catch (Exception $e) {
        $error_details = 'Newsletter Exception: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine();
        error_log($error_details);
        wp_send_json_error(array(
            'message' => 'An unexpected error occurred. Please try again later. (Code: EXC)',
            'debug_info' => (defined('WP_DEBUG') && WP_DEBUG && WP_DEBUG_DISPLAY) ? $error_details : '' // Only show if debug enabled
        ), 500);
    }
}

// Register AJAX actions for newsletter subscription with unique action name

add_action('wp_ajax_bitcomm_newsletter_subscribe', 'handle_itsulu_newsletter_subscription');
add_action('wp_ajax_nopriv_bitcomm_newsletter_subscribe', 'handle_itsulu_newsletter_subscription');

/**
 * Simple AJAX test function
 */
function ajax_test_handler() {
    // Log request for debugging
    error_log('AJAX test request received');
    
    // Return a simple success response
    wp_send_json_success(array('message' => 'AJAX is working!'));
}
add_action('wp_ajax_ajax_test', 'ajax_test_handler');
add_action('wp_ajax_nopriv_ajax_test', 'ajax_test_handler');

/**
 * Test if wp_mail is functioning
 */
function test_wp_mail_functionality() {
    // Only run once
    if (get_option('wp_mail_test_run')) {
        return;
    }
    
    $to = get_option('admin_email');
    $subject = 'Test email from ' . get_bloginfo('name');
    $message = 'This is a test email to verify that the wp_mail function is working correctly.';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    $result = wp_mail($to, $subject, $message, $headers);
    
    // Log the result
    update_option('wp_mail_test_result', $result ? 'success' : 'failed');
    update_option('wp_mail_test_run', true);
    
    error_log('WP Mail Test: ' . ($result ? 'success' : 'failed'));
}
add_action('admin_init', 'test_wp_mail_functionality');

/**
 * Display admin notice if wp_mail test failed
 */
function wp_mail_test_admin_notice() {
    if (get_option('wp_mail_test_result') === 'failed') {
        ?>
        <div class="notice notice-error">
            <p><strong>Email Functionality Issue:</strong> WordPress is unable to send emails using the default mail configuration.</p>
            <p>This affects contact forms, newsletter subscriptions, and other email features on your site.</p>
            <p>To fix this issue, we recommend installing an SMTP plugin like:</p>
            <ul style="list-style-type: disc; padding-left: 20px;">
                <li><a href="https://wordpress.org/plugins/wp-mail-smtp/" target="_blank">WP Mail SMTP</a></li>
                <li><a href="https://wordpress.org/plugins/easy-wp-smtp/" target="_blank">Easy WP SMTP</a></li>
                <li><a href="https://wordpress.org/plugins/post-smtp/" target="_blank">Post SMTP Mailer/Email Log</a></li>
            </ul>
            <p>These plugins will help you configure a proper email sending service (like Gmail, SendGrid, Mailgun, etc.).</p>
            <p><a href="<?php echo wp_nonce_url(admin_url('admin.php?page=wp_mail_test_dismiss'), 'wp_mail_test_dismiss'); ?>" class="button">Dismiss this notice</a></p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'wp_mail_test_admin_notice');

/**
 * Handle dismissal of wp_mail test admin notice
 */
function handle_wp_mail_test_dismiss() {
    if (isset($_GET['page']) && $_GET['page'] === 'wp_mail_test_dismiss' && isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'wp_mail_test_dismiss')) {
        delete_option('wp_mail_test_result');
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'handle_wp_mail_test_dismiss');

/**
 * Include mail configuration helper
 */
if (file_exists(get_template_directory() . '/mail-config.php')) {
    require_once get_template_directory() . '/mail-config.php';
}

/**
 * Add custom meta boxes for legal pages
 */
function bitcomm_register_legal_pages_meta_boxes() {
    // Add meta box for Privacy Policy
    add_meta_box(
        'privacy_policy_sections',
        'Privacy Policy Sections',
        'bitcomm_privacy_policy_meta_box_callback',
        'page',
        'normal',
        'high',
        array('template' => 'page-privacy-policy.php')
    );
    
    // Add meta box for Terms of Service
    add_meta_box(
        'terms_of_service_sections',
        'Terms of Service Sections',
        'bitcomm_terms_service_meta_box_callback',
        'page',
        'normal',
        'high',
        array('template' => 'page-terms-of-service.php')
    );
    
    // Add meta box for Cookie Policy
    add_meta_box(
        'cookie_policy_sections',
        'Cookie Policy Sections',
        'bitcomm_cookie_policy_meta_box_callback',
        'page',
        'normal',
        'high',
        array('template' => 'page-cookie-policy.php')
    );
}
add_action('add_meta_boxes', 'bitcomm_register_legal_pages_meta_boxes');

/**
 * Control meta box display based on page template
 */
function bitcomm_set_legal_page_meta_box_callback_args($args, $box) {
    if (!empty($box['args']['template'])) {
        $screen = get_current_screen();
        
        if ($screen->id === 'page' && isset($_GET['post'])) {
            $post_id = $_GET['post'];
            $template = get_post_meta($post_id, '_wp_page_template', true);
            
            if ($template !== $box['args']['template']) {
                $args['__back_compat_meta_box'] = false;
            }
        }
    }
    return $args;
}
add_filter('postbox_classes', 'bitcomm_set_legal_page_meta_box_callback_args', 10, 2);

/**
 * Privacy Policy meta box callback
 */
function bitcomm_privacy_policy_meta_box_callback($post) {
    wp_nonce_field('bitcomm_privacy_policy_save', 'bitcomm_privacy_policy_nonce');
    
    // Get saved values
    $sections = array(
        'introduction' => get_post_meta($post->ID, '_privacy_introduction', true),
        'data_collect' => get_post_meta($post->ID, '_privacy_data_collect', true),
        'how_collect' => get_post_meta($post->ID, '_privacy_how_collect', true),
        'how_use' => get_post_meta($post->ID, '_privacy_how_use', true),
        'data_security' => get_post_meta($post->ID, '_privacy_data_security', true),
        'data_retention' => get_post_meta($post->ID, '_privacy_data_retention', true),
        'legal_rights' => get_post_meta($post->ID, '_privacy_legal_rights', true),
        'changes' => get_post_meta($post->ID, '_privacy_changes', true),
        'contact' => get_post_meta($post->ID, '_privacy_contact', true)
    );
    
    ?>
    <p>Use these fields to customize your Privacy Policy sections. If left blank, the default content will be used.</p>
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Introduction</h3>
        <?php wp_editor($sections['introduction'], 'privacy_introduction', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>The Data We Collect About You</h3>
        <?php wp_editor($sections['data_collect'], 'privacy_data_collect', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>How We Collect Your Personal Data</h3>
        <?php wp_editor($sections['how_collect'], 'privacy_how_collect', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>How We Use Your Personal Data</h3>
        <?php wp_editor($sections['how_use'], 'privacy_how_use', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Data Security</h3>
        <?php wp_editor($sections['data_security'], 'privacy_data_security', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Data Retention</h3>
        <?php wp_editor($sections['data_retention'], 'privacy_data_retention', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Your Legal Rights</h3>
        <?php wp_editor($sections['legal_rights'], 'privacy_legal_rights', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Changes to This Privacy Policy</h3>
        <?php wp_editor($sections['changes'], 'privacy_changes', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px;">
        <h3>Contact Us</h3>
        <?php wp_editor($sections['contact'], 'privacy_contact', array('textarea_rows' => 5)); ?>
    </div>
    <?php
}

/**
 * Terms of Service meta box callback
 */
function bitcomm_terms_service_meta_box_callback($post) {
    wp_nonce_field('bitcomm_terms_service_save', 'bitcomm_terms_service_nonce');
    
    // Get saved values
    $sections = array(
        'introduction' => get_post_meta($post->ID, '_terms_introduction', true),
        'communications' => get_post_meta($post->ID, '_terms_communications', true),
        'content' => get_post_meta($post->ID, '_terms_content', true),
        'prohibited' => get_post_meta($post->ID, '_terms_prohibited', true),
        'products' => get_post_meta($post->ID, '_terms_products', true),
        'accuracy' => get_post_meta($post->ID, '_terms_accuracy', true),
        'third_party' => get_post_meta($post->ID, '_terms_third_party', true),
        'termination' => get_post_meta($post->ID, '_terms_termination', true),
        'liability' => get_post_meta($post->ID, '_terms_liability', true),
        'disclaimer' => get_post_meta($post->ID, '_terms_disclaimer', true),
        'governing_law' => get_post_meta($post->ID, '_terms_governing_law', true),
        'changes' => get_post_meta($post->ID, '_terms_changes', true),
        'contact' => get_post_meta($post->ID, '_terms_contact', true)
    );
    
    ?>
    <p>Use these fields to customize your Terms of Service sections. If left blank, the default content will be used.</p>
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Introduction</h3>
        <?php wp_editor($sections['introduction'], 'terms_introduction', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Communications</h3>
        <?php wp_editor($sections['communications'], 'terms_communications', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Content</h3>
        <?php wp_editor($sections['content'], 'terms_content', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Prohibited Uses</h3>
        <?php wp_editor($sections['prohibited'], 'terms_prohibited', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Products and Services</h3>
        <?php wp_editor($sections['products'], 'terms_products', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Accuracy of Information</h3>
        <?php wp_editor($sections['accuracy'], 'terms_accuracy', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Third-Party Links</h3>
        <?php wp_editor($sections['third_party'], 'terms_third_party', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Termination</h3>
        <?php wp_editor($sections['termination'], 'terms_termination', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Limitation of Liability</h3>
        <?php wp_editor($sections['liability'], 'terms_liability', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Disclaimer</h3>
        <?php wp_editor($sections['disclaimer'], 'terms_disclaimer', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Governing Law</h3>
        <?php wp_editor($sections['governing_law'], 'terms_governing_law', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Changes to Terms</h3>
        <?php wp_editor($sections['changes'], 'terms_changes', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px;">
        <h3>Contact Us</h3>
        <?php wp_editor($sections['contact'], 'terms_contact', array('textarea_rows' => 5)); ?>
    </div>
    <?php
}

/**
 * Cookie Policy meta box callback
 */
function bitcomm_cookie_policy_meta_box_callback($post) {
    wp_nonce_field('bitcomm_cookie_policy_save', 'bitcomm_cookie_policy_nonce');
    
    // Get saved values
    $sections = array(
        'introduction' => get_post_meta($post->ID, '_cookie_introduction', true),
        'what_are' => get_post_meta($post->ID, '_cookie_what_are', true),
        'how_we_use' => get_post_meta($post->ID, '_cookie_how_we_use', true),
        'types' => get_post_meta($post->ID, '_cookie_types', true),
        'specific' => get_post_meta($post->ID, '_cookie_specific', true),
        'managing' => get_post_meta($post->ID, '_cookie_managing', true),
        'analytics' => get_post_meta($post->ID, '_cookie_analytics', true),
        'changes' => get_post_meta($post->ID, '_cookie_changes', true),
        'contact' => get_post_meta($post->ID, '_cookie_contact', true)
    );
    
    ?>
    <p>Use these fields to customize your Cookie Policy sections. If left blank, the default content will be used.</p>
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Introduction</h3>
        <?php wp_editor($sections['introduction'], 'cookie_introduction', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>What Are Cookies?</h3>
        <?php wp_editor($sections['what_are'], 'cookie_what_are', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>How We Use Cookies</h3>
        <?php wp_editor($sections['how_we_use'], 'cookie_how_we_use', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Types of Cookies We Use</h3>
        <?php wp_editor($sections['types'], 'cookie_types', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Specific Cookies We Use</h3>
        <?php wp_editor($sections['specific'], 'cookie_specific', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Managing Cookies</h3>
        <?php wp_editor($sections['managing'], 'cookie_managing', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Analytics</h3>
        <?php wp_editor($sections['analytics'], 'cookie_analytics', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
        <h3>Changes to This Cookie Policy</h3>
        <?php wp_editor($sections['changes'], 'cookie_changes', array('textarea_rows' => 5)); ?>
    </div>
    
    <div style="margin-bottom: 15px;">
        <h3>Contact Us</h3>
        <?php wp_editor($sections['contact'], 'cookie_contact', array('textarea_rows' => 5)); ?>
    </div>
    <?php
}

/**
 * Save legal pages meta boxes data
 */
function bitcomm_save_legal_pages_meta_data($post_id) {
    // Privacy Policy
    if (isset($_POST['bitcomm_privacy_policy_nonce']) && wp_verify_nonce($_POST['bitcomm_privacy_policy_nonce'], 'bitcomm_privacy_policy_save')) {
        $fields = array(
            'privacy_introduction' => '_privacy_introduction',
            'privacy_data_collect' => '_privacy_data_collect',
            'privacy_how_collect' => '_privacy_how_collect',
            'privacy_how_use' => '_privacy_how_use',
            'privacy_data_security' => '_privacy_data_security',
            'privacy_data_retention' => '_privacy_data_retention',
            'privacy_legal_rights' => '_privacy_legal_rights',
            'privacy_changes' => '_privacy_changes',
            'privacy_contact' => '_privacy_contact'
        );
        
        foreach ($fields as $field => $meta_key) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $meta_key, wp_kses_post($_POST[$field]));
            }
        }
    }
    
    // Terms of Service
    if (isset($_POST['bitcomm_terms_service_nonce']) && wp_verify_nonce($_POST['bitcomm_terms_service_nonce'], 'bitcomm_terms_service_save')) {
        $fields = array(
            'terms_introduction' => '_terms_introduction',
            'terms_communications' => '_terms_communications',
            'terms_content' => '_terms_content',
            'terms_prohibited' => '_terms_prohibited',
            'terms_products' => '_terms_products',
            'terms_accuracy' => '_terms_accuracy',
            'terms_third_party' => '_terms_third_party',
            'terms_termination' => '_terms_termination',
            'terms_liability' => '_terms_liability',
            'terms_disclaimer' => '_terms_disclaimer',
            'terms_governing_law' => '_terms_governing_law',
            'terms_changes' => '_terms_changes',
            'terms_contact' => '_terms_contact'
        );
        
        foreach ($fields as $field => $meta_key) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $meta_key, wp_kses_post($_POST[$field]));
            }
        }
    }
    
    // Cookie Policy
    if (isset($_POST['bitcomm_cookie_policy_nonce']) && wp_verify_nonce($_POST['bitcomm_cookie_policy_nonce'], 'bitcomm_cookie_policy_save')) {
        $fields = array(
            'cookie_introduction' => '_cookie_introduction',
            'cookie_what_are' => '_cookie_what_are',
            'cookie_how_we_use' => '_cookie_how_we_use',
            'cookie_types' => '_cookie_types',
            'cookie_specific' => '_cookie_specific',
            'cookie_managing' => '_cookie_managing',
            'cookie_analytics' => '_cookie_analytics',
            'cookie_changes' => '_cookie_changes',
            'cookie_contact' => '_cookie_contact'
        );
        
        foreach ($fields as $field => $meta_key) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $meta_key, wp_kses_post($_POST[$field]));
            }
        }
    }
}
add_action('save_post', 'bitcomm_save_legal_pages_meta_data');
