<?php
/**
 * WordPress Mail Configuration Helper
 *
 * This file provides instructions for configuring WordPress mail functionality.
 * Save this as mail-config.php in your theme folder and include it from functions.php
 * to apply these settings.
 */

// Check if the file is being accessed directly
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Configure WordPress to use SMTP for sending emails
 * 
 * HOW TO USE:
 * 1. Fill in your SMTP settings below
 * 2. Rename this file to mail-config.php
 * 3. Save it in your theme folder
 * 4. Add the following line to your functions.php:
 *    require_once get_template_directory() . '/mail-config.php';
 */

/**
 * Option 1: Configure WordPress to use SMTP via wp_mail() function
 */
function configure_smtp_email($phpmailer) {
    // SMTP Settings - EDIT THESE
    $phpmailer->isSMTP();                         // Set mailer to use SMTP
    $phpmailer->Host       = 'smtp.example.com';  // SMTP host
    $phpmailer->SMTPAuth   = true;                // Enable SMTP authentication
    $phpmailer->Username   = 'your-email@example.com'; // SMTP username
    $phpmailer->Password   = 'your-password';     // SMTP password
    $phpmailer->SMTPSecure = 'tls';               // Enable TLS encryption, `ssl` also accepted
    $phpmailer->Port       = 587;                 // TCP port to connect to, use 465 for `ssl`
    $phpmailer->From       = 'your-email@example.com'; // From email address
    $phpmailer->FromName   = 'Your Name';         // From name
    
    // Optional: Set timeout values
    $phpmailer->Timeout    = 30;                  // SMTP connection timeout in seconds
    $phpmailer->SMTPDebug  = 0;                   // Set to 1 or 2 for debugging
}
// Uncomment the next line to activate SMTP
// add_action('phpmailer_init', 'configure_smtp_email');

/**
 * Option 2: Use Gmail SMTP
 */
function configure_gmail_smtp($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = 'your-gmail@gmail.com';
    $phpmailer->Password   = 'your-app-password'; // Use App Password, not your regular Gmail password
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->Port       = 587;
    $phpmailer->From       = 'your-gmail@gmail.com';
    $phpmailer->FromName   = 'Your Name';
}
// Uncomment the next line to activate Gmail SMTP
// add_action('phpmailer_init', 'configure_gmail_smtp');

/**
 * Option 3: Alternative approach - use mail() function instead of SMTP
 */
function use_php_mail_function($phpmailer) {
    $phpmailer->isMail();
}
// Uncomment the next line to use PHP mail() function
// add_action('phpmailer_init', 'use_php_mail_function');

/**
 * Test the email configuration
 */
function test_wp_mail_configuration() {
    $to = get_option('admin_email');
    $subject = 'Test Email from ' . get_bloginfo('name');
    $message = '
        <h2>WordPress Email Test</h2>
        <p>This is a test email to verify that your WordPress email configuration is working correctly.</p>
        <p>If you received this email, your email settings are configured correctly!</p>
        <p>Time sent: ' . current_time('mysql') . '</p>
    ';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    $result = wp_mail($to, $subject, $message, $headers);
    
    return $result;
}

/**
 * Admin page for testing mail
 */
function mail_test_admin_page() {
    add_management_page(
        'Email Test',
        'Email Test',
        'manage_options',
        'email-test',
        'display_mail_test_page'
    );
}
add_action('admin_menu', 'mail_test_admin_page');

/**
 * Display the mail test page
 */
function display_mail_test_page() {
    $message = '';
    $status = '';
    
    if (isset($_POST['test_email']) && isset($_POST['email_test_nonce']) && wp_verify_nonce($_POST['email_test_nonce'], 'run_email_test')) {
        $test_result = test_wp_mail_configuration();
        
        if ($test_result) {
            $status = 'success';
            $message = 'Test email sent successfully! Check ' . get_option('admin_email') . ' for the test email.';
        } else {
            $status = 'error';
            $message = 'Failed to send test email. Check your server error logs for more information.';
        }
    }
    
    ?>
    <div class="wrap">
        <h1>WordPress Email Test</h1>
        
        <?php if ($message): ?>
            <div class="notice notice-<?php echo $status; ?> is-dismissible">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>Test Email Configuration</h2>
            <p>Click the button below to send a test email to the admin email address (<?php echo get_option('admin_email'); ?>).</p>
            
            <form method="post">
                <?php wp_nonce_field('run_email_test', 'email_test_nonce'); ?>
                <input type="submit" name="test_email" class="button button-primary" value="Send Test Email">
            </form>
        </div>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>Email Configuration Tips</h2>
            <ol>
                <li>If you're having email delivery issues, consider using an SMTP plugin like <a href="https://wordpress.org/plugins/wp-mail-smtp/" target="_blank">WP Mail SMTP</a>, <a href="https://wordpress.org/plugins/post-smtp/" target="_blank">Post SMTP</a>, or <a href="https://wordpress.org/plugins/easy-wp-smtp/" target="_blank">Easy WP SMTP</a>.</li>
                <li>Make sure your server allows outgoing email (many shared hosts restrict this).</li>
                <li>If using Gmail, you must use an App Password instead of your regular password.</li>
                <li>Check if your emails are going to the spam folder.</li>
                <li>Verify that your domain has proper SPF and DKIM records to improve email deliverability.</li>
            </ol>
        </div>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>Current Configuration</h2>
            <table class="form-table">
                <tr>
                    <th>WordPress Version:</th>
                    <td><?php echo get_bloginfo('version'); ?></td>
                </tr>
                <tr>
                    <th>PHP Version:</th>
                    <td><?php echo phpversion(); ?></td>
                </tr>
                <tr>
                    <th>Admin Email:</th>
                    <td><?php echo get_option('admin_email'); ?></td>
                </tr>
                <tr>
                    <th>Site Title:</th>
                    <td><?php echo get_bloginfo('name'); ?></td>
                </tr>
                <tr>
                    <th>Active Theme:</th>
                    <td><?php echo wp_get_theme()->get('Name'); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php
}

// Add recommendation for WP Mail SMTP plugin if test fails
function recommend_mail_smtp_plugin() {
    global $pagenow;
    
    if ($pagenow != 'admin.php' || !isset($_GET['page']) || $_GET['page'] != 'email-test') {
        if (get_option('wp_mail_test_result') === 'failed') {
            ?>
            <div class="notice notice-warning is-dismissible">
                <p><strong>Email Delivery Issue Detected:</strong> It seems your WordPress site is having trouble sending emails.</p>
                <p>We recommend installing an SMTP plugin to improve email deliverability.</p>
                <p><a href="<?php echo admin_url('plugin-install.php?s=wp+mail+smtp&tab=search&type=term'); ?>" class="button button-primary">Browse SMTP Plugins</a> or <a href="<?php echo admin_url('tools.php?page=email-test'); ?>" class="button">Run Email Test</a></p>
            </div>
            <?php
        }
    }
}
add_action('admin_notices', 'recommend_mail_smtp_plugin'); 