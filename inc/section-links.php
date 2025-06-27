<?php
/**
 * Section Links Helper for Theme Customizer
 * 
 * This file provides functions to manage section links in the customizer
 */

/**
 * Get all available page sections for dropdown options
 * 
 * @return array Array of section IDs and labels
 */
function itsulu_get_page_sections() {
    // Define all available sections on the page that can be linked to
    // IMPORTANT: These match the actual section IDs used in front-page.php
    return array(
        ''                  => __('-- Select a Section --', 'itsulu-custom'),
        '#hero-section'     => __('Hero Section', 'itsulu-custom'),
        '#approach'         => __('Our Approach', 'itsulu-custom'),
        '#services'         => __('Our Services', 'itsulu-custom'),
        '#consultation'     => __('Book Consultation', 'itsulu-custom'),
        '#solutions'        => __('Solutions', 'itsulu-custom'),
        '#support'          => __('Support & Resources', 'itsulu-custom'),
        '#testimonials'     => __('Testimonials', 'itsulu-custom'),
        '#about'            => __('About Us', 'itsulu-custom'),
        '#team'             => __('Our Team', 'itsulu-custom'),
        '#why-choose-us'    => __('Why Choose Us', 'itsulu-custom'),
        '#call-to-action'   => __('Call to Action', 'itsulu-custom'),
        '#contact'          => __('Contact Us', 'itsulu-custom'),
        'custom'            => __('Custom URL', 'itsulu-custom'),
    );
}

/**
 * Sanitize section link selection
 * 
 * @param string $input The selected section link
 * @return string Sanitized section link
 */
function itsulu_sanitize_section_link($input) {
    $valid_sections = array_keys(itsulu_get_page_sections());
    
    if (in_array($input, $valid_sections)) {
        return $input;
    }
    
    // If it's not a valid section, it might be a custom URL
    if (filter_var($input, FILTER_VALIDATE_URL)) {
        return esc_url_raw($input);
    }
    
    // If it starts with # it's likely a custom section ID
    if (substr($input, 0, 1) === '#') {
        return sanitize_text_field($input);
    }
    
    // Default to empty if none of the above
    return '';
}

/**
 * Process section link before output
 * 
 * @param string $section_link The section link from customizer
 * @param string $custom_url The custom URL if provided
 * @return string Processed URL for output
 */
function itsulu_process_section_link($section_link, $custom_url = '') {
    if ($section_link === 'custom' && !empty($custom_url)) {
        return esc_url($custom_url);
    }
    
    if (substr($section_link, 0, 1) === '#') {
        return esc_url(home_url('/') . $section_link);
    }
    
    return esc_url($section_link);
}
