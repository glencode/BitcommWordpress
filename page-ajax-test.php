<?php
/**
 * Template Name: AJAX Test Page
 *
 * A test page to validate AJAX functionality on the site.
 *
 * @package itsulu-custom
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container my-5">
            <h1 class="mb-4">AJAX Testing Page</h1>
            
            <div class="card mb-5">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Test 1: Simple AJAX Test</h2>
                </div>
                <div class="card-body">
                    <p>Click the button below to test basic AJAX functionality:</p>
                    <button id="ajax-test-btn" class="btn btn-primary">Test AJAX</button>
                    <div id="ajax-test-result" class="mt-3"></div>
                </div>
            </div>
            
            <div class="card mb-5">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Test 2: Newsletter Subscription Form</h2>
                </div>
                <div class="card-body">
                    <p>Use the form below to test the newsletter subscription:</p>
                    
                    <form id="test-newsletter-form" class="mb-3">
                        <input type="hidden" name="action" value="subscribe_newsletter">
                        <?php wp_nonce_field('subscribe_newsletter_nonce', 'subscribe_nonce'); ?>
                        
                        <div class="input-group mb-3">
                            <input type="email" name="subscriber_email" class="form-control" placeholder="Your email address" required>
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                    
                    <div id="newsletter-result" class="alert" style="display: none;"></div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2 class="h5 mb-0">AJAX Debug Information</h2>
                </div>
                <div class="card-body">
                    <p><strong>WordPress AJAX URL:</strong> <code id="ajax-url"><?php echo esc_url(admin_url('admin-ajax.php')); ?></code></p>
                    <p><strong>Nonce Value:</strong> <code id="nonce-value"><?php echo wp_create_nonce('subscribe_newsletter_nonce'); ?></code></p>
                    <div id="debug-info" class="mt-3">
                        <p>Debug information will appear here...</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
jQuery(document).ready(function($) {
    // Test 1: Simple AJAX Test
    $('#ajax-test-btn').on('click', function() {
        var $resultContainer = $('#ajax-test-result');
        $resultContainer.html('<div class="alert alert-info">Testing AJAX connection...</div>');
        
        $.ajax({
            type: 'POST',
            url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
            data: {
                action: 'ajax_test'
            },
            success: function(response) {
                console.log('AJAX test response:', response);
                if (response.success) {
                    $resultContainer.html('<div class="alert alert-success">Success! AJAX is working correctly.</div>');
                } else {
                    $resultContainer.html('<div class="alert alert-danger">Error: AJAX call succeeded but returned an error.</div>');
                }
                $('#debug-info').html('<pre>' + JSON.stringify(response, null, 2) + '</pre>');
            },
            error: function(xhr, status, error) {
                console.error('AJAX test error:', {xhr: xhr, status: status, error: error});
                $resultContainer.html('<div class="alert alert-danger">Error: ' + status + '</div>');
                $('#debug-info').html('<p>Status: ' + status + '</p><p>Error: ' + error + '</p>');
            }
        });
    });
    
    // Test 2: Newsletter Subscription Form
    $('#test-newsletter-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $resultContainer = $('#newsletter-result');
        
        $resultContainer.removeClass('alert-success alert-danger alert-info')
                        .addClass('alert-info')
                        .html('Sending subscription request...')
                        .show();
        
        // Log form data for debugging
        var formData = $form.serialize();
        console.log('Newsletter form data:', formData);
        $('#debug-info').html('<p>Form data: ' + formData + '</p>');
        
        $.ajax({
            type: 'POST',
            url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Newsletter test response:', response);
                
                if (response.success) {
                    $resultContainer.removeClass('alert-info alert-danger')
                                    .addClass('alert-success')
                                    .html(response.data.message);
                    $form[0].reset();
                } else {
                    var errorMsg = response.data ? response.data.message : 'Unknown error occurred';
                    $resultContainer.removeClass('alert-info alert-success')
                                    .addClass('alert-danger')
                                    .html('Error: ' + errorMsg);
                }
                
                $('#debug-info').html('<pre>' + JSON.stringify(response, null, 2) + '</pre>');
            },
            error: function(xhr, status, error) {
                console.error('Newsletter test error:', {xhr: xhr, status: status, error: error});
                $resultContainer.removeClass('alert-info alert-success')
                                .addClass('alert-danger')
                                .html('Error: ' + status);
                
                $('#debug-info').html('<p>Status: ' + status + '</p><p>Error: ' + error + '</p>');
                
                // Try to parse response text if available
                if (xhr.responseText) {
                    try {
                        var errorResponse = JSON.parse(xhr.responseText);
                        $('#debug-info').append('<p>Response:</p><pre>' + JSON.stringify(errorResponse, null, 2) + '</pre>');
                    } catch (e) {
                        $('#debug-info').append('<p>Response text:</p><pre>' + xhr.responseText + '</pre>');
                    }
                }
            }
        });
    });
});
</script>

<?php get_footer(); ?> 