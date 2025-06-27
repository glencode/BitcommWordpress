jQuery(document).ready(function($) {
    $('#footer-newsletter-form').on('submit', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $submitBtn = $form.find('.newsletter-submit');
        var $spinner = $submitBtn.find('.spinner-border');
        var $btnText = $submitBtn.find('.btn-text');
        var $message = $('#newsletter-message');

        // Show loading state
        $submitBtn.prop('disabled', true);
        $btnText.text('Sending...');
        $spinner.removeClass('d-none');
        // Clear previous messages and classes just before the new request
        $message.hide().removeClass('alert-success alert-danger').empty();

        $.ajax({
            url: ajaxurl, // This is defined by WordPress (ensure it's available)
            type: 'POST',
            data: {
                action: 'bitcomm_newsletter_subscribe',
                subscribe_nonce: $form.find('input[name="subscribe_nonce"]').val(),
                subscriber_email: $form.find('input[name="subscriber_email"]').val()
            },
            success: function(response) {
                let messageText = 'An unexpected response was received.'; // Renamed to avoid conflict
                let isSuccess = false;

                if (response && typeof response === 'object') {
                    if (response.success && response.data && response.data.message) {
                        messageText = response.data.message;
                        isSuccess = true;
                    } else if (!response.success && response.data && response.data.message) {
                        messageText = response.data.message;
                    }
                }

                // **Ensure old classes are removed before adding new ones**
                $message.removeClass('alert-success alert-danger'); 
                $message
                    .html(messageText)
                    .addClass('alert ' + (isSuccess ? 'alert-success' : 'alert-danger'))
                    .show();

                if (isSuccess) {
                    $form[0].reset();
                }
            },
            error: function(xhr, status, error) {
                console.error('Newsletter subscription error:', xhr, status, error); // Log more details
                // **Ensure old classes are removed before adding new ones**
                $message.removeClass('alert-success alert-danger');

                let errorMsg = 'An error occurred. Please try again later.';
                if (xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) {
                    errorMsg = xhr.responseJSON.data.message;
                } else if (typeof xhr.responseText === 'string') {
                    try {
                        const errResponse = JSON.parse(xhr.responseText);
                        if (errResponse && errResponse.data && errResponse.data.message) {
                            errorMsg = errResponse.data.message;
                        }
                    } catch (e) {
                        // Not a JSON response, or malformed
                        console.warn('Could not parse error responseText as JSON.');
                    }
                }
                $message.html(errorMsg).addClass('alert alert-danger').show();
            },
            complete: function() {
                // Reset button state
                $submitBtn.prop('disabled', false);
                $btnText.text('Subscribe');
                $spinner.addClass('d-none');

                // Hide message after 5 seconds
                setTimeout(function() {
                    $message.fadeOut(function() {
                        // Optionally, clear classes and text again after fadeOut
                        $(this).removeClass('alert-success alert-danger').empty();
                    });
                }, 5000);
            }
        });
    });
});