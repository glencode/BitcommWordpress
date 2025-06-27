<?php
/**
 * About Us Custom Post Types
 * 
 * This file defines CPTs for the About Us page:
 * - Mission & Vision
 * - Company Values
 * - Certifications
 * - Company Facilities
 * - Company Timeline
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Company Mission & Vision CPT
 */
function register_mission_vision_cpt() {
    $labels = array(
        'name'                  => _x('Mission & Vision', 'Post Type General Name', 'itsulu'),
        'singular_name'         => _x('Mission & Vision', 'Post Type Singular Name', 'itsulu'),
        'menu_name'             => __('Mission & Vision', 'itsulu'),
        'name_admin_bar'        => __('Mission & Vision', 'itsulu'),
        'archives'              => __('Mission & Vision Archives', 'itsulu'),
        'attributes'            => __('Mission & Vision Attributes', 'itsulu'),
        'parent_item_colon'     => __('Parent Mission & Vision:', 'itsulu'),
        'all_items'             => __('All Mission & Vision', 'itsulu'),
        'add_new_item'          => __('Add New Mission & Vision', 'itsulu'),
        'add_new'               => __('Add New', 'itsulu'),
        'new_item'              => __('New Mission & Vision', 'itsulu'),
        'edit_item'             => __('Edit Mission & Vision', 'itsulu'),
        'update_item'           => __('Update Mission & Vision', 'itsulu'),
        'view_item'             => __('View Mission & Vision', 'itsulu'),
        'view_items'            => __('View Mission & Vision', 'itsulu'),
        'search_items'          => __('Search Mission & Vision', 'itsulu'),
        'not_found'             => __('Not found', 'itsulu'),
        'not_found_in_trash'    => __('Not found in Trash', 'itsulu'),
        'featured_image'        => __('Featured Image', 'itsulu'),
        'set_featured_image'    => __('Set featured image', 'itsulu'),
        'remove_featured_image' => __('Remove featured image', 'itsulu'),
        'use_featured_image'    => __('Use as featured image', 'itsulu'),
        'insert_into_item'      => __('Insert into Mission & Vision', 'itsulu'),
        'uploaded_to_this_item' => __('Uploaded to this Mission & Vision', 'itsulu'),
        'items_list'            => __('Mission & Vision list', 'itsulu'),
        'items_list_navigation' => __('Mission & Vision list navigation', 'itsulu'),
        'filter_items_list'     => __('Filter Mission & Vision list', 'itsulu'),
    );
    
    $args = array(
        'label'                 => __('Mission & Vision', 'itsulu'),
        'description'           => __('Company Mission and Vision statements', 'itsulu'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=about_us_content',
        'menu_position'         => 25,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-flag',
    );
    
    register_post_type('mission_vision', $args);
}

/**
 * Register Company Values CPT
 */
function register_company_values_cpt() {
    $labels = array(
        'name'                  => _x('Company Values', 'Post Type General Name', 'itsulu'),
        'singular_name'         => _x('Company Value', 'Post Type Singular Name', 'itsulu'),
        'menu_name'             => __('Company Values', 'itsulu'),
        'name_admin_bar'        => __('Company Value', 'itsulu'),
        'archives'              => __('Company Values Archives', 'itsulu'),
        'attributes'            => __('Company Value Attributes', 'itsulu'),
        'parent_item_colon'     => __('Parent Company Value:', 'itsulu'),
        'all_items'             => __('All Company Values', 'itsulu'),
        'add_new_item'          => __('Add New Company Value', 'itsulu'),
        'add_new'               => __('Add New', 'itsulu'),
        'new_item'              => __('New Company Value', 'itsulu'),
        'edit_item'             => __('Edit Company Value', 'itsulu'),
        'update_item'           => __('Update Company Value', 'itsulu'),
        'view_item'             => __('View Company Value', 'itsulu'),
        'view_items'            => __('View Company Values', 'itsulu'),
        'search_items'          => __('Search Company Values', 'itsulu'),
        'not_found'             => __('Not found', 'itsulu'),
        'not_found_in_trash'    => __('Not found in Trash', 'itsulu'),
        'featured_image'        => __('Featured Image', 'itsulu'),
        'set_featured_image'    => __('Set featured image', 'itsulu'),
        'remove_featured_image' => __('Remove featured image', 'itsulu'),
        'use_featured_image'    => __('Use as featured image', 'itsulu'),
        'insert_into_item'      => __('Insert into Company Value', 'itsulu'),
        'uploaded_to_this_item' => __('Uploaded to this Company Value', 'itsulu'),
        'items_list'            => __('Company Values list', 'itsulu'),
        'items_list_navigation' => __('Company Values list navigation', 'itsulu'),
        'filter_items_list'     => __('Filter Company Values list', 'itsulu'),
    );
    
    $args = array(
        'label'                 => __('Company Values', 'itsulu'),
        'description'           => __('Company core values and principles', 'itsulu'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=about_us_content',
        'menu_position'         => 25,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-heart',
    );
    
    register_post_type('company_values', $args);
}

/**
 * Register Certifications CPT
 */
function register_certifications_cpt() {
    $labels = array(
        'name'                  => _x('Certifications', 'Post Type General Name', 'itsulu'),
        'singular_name'         => _x('Certification', 'Post Type Singular Name', 'itsulu'),
        'menu_name'             => __('Certifications', 'itsulu'),
        'name_admin_bar'        => __('Certification', 'itsulu'),
        'archives'              => __('Certifications Archives', 'itsulu'),
        'attributes'            => __('Certification Attributes', 'itsulu'),
        'parent_item_colon'     => __('Parent Certification:', 'itsulu'),
        'all_items'             => __('All Certifications', 'itsulu'),
        'add_new_item'          => __('Add New Certification', 'itsulu'),
        'add_new'               => __('Add New', 'itsulu'),
        'new_item'              => __('New Certification', 'itsulu'),
        'edit_item'             => __('Edit Certification', 'itsulu'),
        'update_item'           => __('Update Certification', 'itsulu'),
        'view_item'             => __('View Certification', 'itsulu'),
        'view_items'            => __('View Certifications', 'itsulu'),
        'search_items'          => __('Search Certifications', 'itsulu'),
        'not_found'             => __('Not found', 'itsulu'),
        'not_found_in_trash'    => __('Not found in Trash', 'itsulu'),
        'featured_image'        => __('Certification Logo', 'itsulu'),
        'set_featured_image'    => __('Set certification logo', 'itsulu'),
        'remove_featured_image' => __('Remove certification logo', 'itsulu'),
        'use_featured_image'    => __('Use as certification logo', 'itsulu'),
        'insert_into_item'      => __('Insert into Certification', 'itsulu'),
        'uploaded_to_this_item' => __('Uploaded to this Certification', 'itsulu'),
        'items_list'            => __('Certifications list', 'itsulu'),
        'items_list_navigation' => __('Certifications list navigation', 'itsulu'),
        'filter_items_list'     => __('Filter Certifications list', 'itsulu'),
    );
    
    $args = array(
        'label'                 => __('Certifications', 'itsulu'),
        'description'           => __('Company certifications and accreditations', 'itsulu'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=about_us_content',
        'menu_position'         => 25,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-awards',
    );
    
    register_post_type('certifications', $args);
}

/**
 * Register Company Facilities CPT
 */
function register_facilities_cpt() {
    $labels = array(
        'name'                  => _x('Company Facilities', 'Post Type General Name', 'itsulu'),
        'singular_name'         => _x('Company Facility', 'Post Type Singular Name', 'itsulu'),
        'menu_name'             => __('Company Facilities', 'itsulu'),
        'name_admin_bar'        => __('Company Facility', 'itsulu'),
        'archives'              => __('Company Facilities Archives', 'itsulu'),
        'attributes'            => __('Company Facility Attributes', 'itsulu'),
        'parent_item_colon'     => __('Parent Company Facility:', 'itsulu'),
        'all_items'             => __('All Company Facilities', 'itsulu'),
        'add_new_item'          => __('Add New Company Facility', 'itsulu'),
        'add_new'               => __('Add New', 'itsulu'),
        'new_item'              => __('New Company Facility', 'itsulu'),
        'edit_item'             => __('Edit Company Facility', 'itsulu'),
        'update_item'           => __('Update Company Facility', 'itsulu'),
        'view_item'             => __('View Company Facility', 'itsulu'),
        'view_items'            => __('View Company Facilities', 'itsulu'),
        'search_items'          => __('Search Company Facilities', 'itsulu'),
        'not_found'             => __('Not found', 'itsulu'),
        'not_found_in_trash'    => __('Not found in Trash', 'itsulu'),
        'featured_image'        => __('Facility Image', 'itsulu'),
        'set_featured_image'    => __('Set facility image', 'itsulu'),
        'remove_featured_image' => __('Remove facility image', 'itsulu'),
        'use_featured_image'    => __('Use as facility image', 'itsulu'),
        'insert_into_item'      => __('Insert into Company Facility', 'itsulu'),
        'uploaded_to_this_item' => __('Uploaded to this Company Facility', 'itsulu'),
        'items_list'            => __('Company Facilities list', 'itsulu'),
        'items_list_navigation' => __('Company Facilities list navigation', 'itsulu'),
        'filter_items_list'     => __('Filter Company Facilities list', 'itsulu'),
    );
    
    $args = array(
        'label'                 => __('Company Facilities', 'itsulu'),
        'description'           => __('Company facilities and infrastructure', 'itsulu'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=about_us_content',
        'menu_position'         => 25,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-building',
    );
    
    register_post_type('facilities', $args);
}

/**
 * Register About Us Content Parent Menu
 */
function register_about_us_parent_menu() {
    add_menu_page(
        __('About Us Content', 'itsulu'),
        __('About Us Content', 'itsulu'),
        'manage_options',
        'edit.php?post_type=about_us_content',
        '',
        'dashicons-info',
        25
    );
}

/**
 * Register About Us Content CPT (Parent)
 */
function register_about_us_content_cpt() {
    $labels = array(
        'name'                  => _x('About Us Content', 'Post Type General Name', 'itsulu'),
        'singular_name'         => _x('About Us Content', 'Post Type Singular Name', 'itsulu'),
        'menu_name'             => __('About Us Overview', 'itsulu'),
        'name_admin_bar'        => __('About Us Content', 'itsulu'),
        'archives'              => __('About Us Content Archives', 'itsulu'),
        'attributes'            => __('About Us Content Attributes', 'itsulu'),
        'parent_item_colon'     => __('Parent About Us Content:', 'itsulu'),
        'all_items'             => __('About Us Overview', 'itsulu'),
        'add_new_item'          => __('Add New About Us Content', 'itsulu'),
        'add_new'               => __('Add New', 'itsulu'),
        'new_item'              => __('New About Us Content', 'itsulu'),
        'edit_item'             => __('Edit About Us Content', 'itsulu'),
        'update_item'           => __('Update About Us Content', 'itsulu'),
        'view_item'             => __('View About Us Content', 'itsulu'),
        'view_items'            => __('View About Us Content', 'itsulu'),
        'search_items'          => __('Search About Us Content', 'itsulu'),
        'not_found'             => __('Not found', 'itsulu'),
        'not_found_in_trash'    => __('Not found in Trash', 'itsulu'),
        'featured_image'        => __('Featured Image', 'itsulu'),
        'set_featured_image'    => __('Set featured image', 'itsulu'),
        'remove_featured_image' => __('Remove featured image', 'itsulu'),
        'use_featured_image'    => __('Use as featured image', 'itsulu'),
        'insert_into_item'      => __('Insert into About Us Content', 'itsulu'),
        'uploaded_to_this_item' => __('Uploaded to this About Us Content', 'itsulu'),
        'items_list'            => __('About Us Content list', 'itsulu'),
        'items_list_navigation' => __('About Us Content list navigation', 'itsulu'),
        'filter_items_list'     => __('Filter About Us Content list', 'itsulu'),
    );
    
    $args = array(
        'label'                 => __('About Us Content', 'itsulu'),
        'description'           => __('Main About Us page content', 'itsulu'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 25,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-info',
    );
    
    register_post_type('about_us_content', $args);
}

// Hook into the 'init' action
add_action('init', 'register_about_us_content_cpt', 0);
add_action('init', 'register_mission_vision_cpt', 0);
add_action('init', 'register_company_values_cpt', 0);
add_action('init', 'register_certifications_cpt', 0);
add_action('init', 'register_facilities_cpt', 0);
add_action('init', 'register_company_timeline_cpt', 0);

/**
 * Register Company Timeline CPT
 */
function register_company_timeline_cpt() {
    $labels = array(
        'name'                  => _x('Company Timeline', 'Post Type General Name', 'itsulu'),
        'singular_name'         => _x('Timeline Event', 'Post Type Singular Name', 'itsulu'),
        'menu_name'             => __('Company Timeline', 'itsulu'),
        'name_admin_bar'        => __('Timeline Event', 'itsulu'),
        'archives'              => __('Timeline Archives', 'itsulu'),
        'attributes'            => __('Timeline Event Attributes', 'itsulu'),
        'parent_item_colon'     => __('Parent Timeline Event:', 'itsulu'),
        'all_items'             => __('All Timeline Events', 'itsulu'),
        'add_new_item'          => __('Add New Timeline Event', 'itsulu'),
        'add_new'               => __('Add New', 'itsulu'),
        'new_item'              => __('New Timeline Event', 'itsulu'),
        'edit_item'             => __('Edit Timeline Event', 'itsulu'),
        'update_item'           => __('Update Timeline Event', 'itsulu'),
        'view_item'             => __('View Timeline Event', 'itsulu'),
        'view_items'            => __('View Timeline Events', 'itsulu'),
        'search_items'          => __('Search Timeline Events', 'itsulu'),
        'not_found'             => __('Not found', 'itsulu'),
        'not_found_in_trash'    => __('Not found in Trash', 'itsulu'),
        'featured_image'        => __('Event Image', 'itsulu'),
        'set_featured_image'    => __('Set event image', 'itsulu'),
        'remove_featured_image' => __('Remove event image', 'itsulu'),
        'use_featured_image'    => __('Use as event image', 'itsulu'),
        'insert_into_item'      => __('Insert into Timeline Event', 'itsulu'),
        'uploaded_to_this_item' => __('Uploaded to this Timeline Event', 'itsulu'),
        'items_list'            => __('Timeline Events list', 'itsulu'),
        'items_list_navigation' => __('Timeline Events list navigation', 'itsulu'),
        'filter_items_list'     => __('Filter Timeline Events list', 'itsulu'),
    );
    
    $args = array(
        'label'                 => __('Company Timeline', 'itsulu'),
        'description'           => __('Company history and milestones', 'itsulu'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=about_us_content',
        'menu_position'         => 25,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-clock',
    );
    
    register_post_type('company_timeline', $args);
}

/**
 * Add custom meta fields for About Us CPTs
 */
function add_about_us_meta_fields() {
    // Mission & Vision meta fields
    add_meta_box(
        'mission_vision_type',
        'Mission/Vision Type',
        'mission_vision_type_callback',
        'mission_vision',
        'side',
        'high'
    );
    
    // Company Values meta fields
    add_meta_box(
        'company_value_icon',
        'Value Icon',
        'company_value_icon_callback',
        'company_values',
        'side',
        'high'
    );
    
    // Certifications meta fields
    add_meta_box(
        'certification_details',
        'Certification Details',
        'certification_details_callback',
        'certifications',
        'normal',
        'high'
    );
    
    // Facilities meta fields
    add_meta_box(
        'facility_category',
        'Facility Category',
        'facility_category_callback',
        'facilities',
        'side',
        'high'
    );
    
    // Timeline meta fields
    add_meta_box(
        'timeline_details',
        'Timeline Details',
        'timeline_details_callback',
        'company_timeline',
        'normal',
        'high'
    );
    
    // Award meta fields
    add_meta_box(
        'award_details',
        'Award Details',
        'award_details_callback',
        'award',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_about_us_meta_fields');

/**
 * Mission/Vision Type meta box callback
 */
function mission_vision_type_callback($post) {
    wp_nonce_field('mission_vision_meta_nonce', 'mission_vision_meta_nonce');
    $type = get_post_meta($post->ID, '_mission_vision_type', true);
    
    echo '<label for="mission_vision_type">Type:</label>';
    echo '<select id="mission_vision_type" name="mission_vision_type" style="width: 100%;">';
    echo '<option value="mission"' . selected($type, 'mission', false) . '>Mission</option>';
    echo '<option value="vision"' . selected($type, 'vision', false) . '>Vision</option>';
    echo '</select>';
}

/**
 * Company Value Icon meta box callback
 */
function company_value_icon_callback($post) {
    wp_nonce_field('company_value_meta_nonce', 'company_value_meta_nonce');
    $icon = get_post_meta($post->ID, '_company_value_icon', true);
    
    $icon_options = array(
        'fas fa-star' => 'Star (Excellence)',
        'fas fa-handshake' => 'Handshake (Integrity)',
        'fas fa-lightbulb' => 'Lightbulb (Innovation)',
        'fas fa-users' => 'Users (Collaboration)',
        'fas fa-globe-africa' => 'Globe Africa (Local Impact)',
        'fas fa-shield-alt' => 'Shield (Reliability)',
        'fas fa-heart' => 'Heart (Care)',
        'fas fa-cog' => 'Cog (Efficiency)',
        'fas fa-trophy' => 'Trophy (Achievement)',
        'fas fa-rocket' => 'Rocket (Growth)'
    );
    
    echo '<label for="company_value_icon">Icon:</label>';
    echo '<select id="company_value_icon" name="company_value_icon" style="width: 100%;">';
    foreach ($icon_options as $value => $label) {
        echo '<option value="' . esc_attr($value) . '"' . selected($icon, $value, false) . '>' . esc_html($label) . '</option>';
    }
    echo '</select>';
}

/**
 * Certification Details meta box callback
 */
function certification_details_callback($post) {
    wp_nonce_field('certification_meta_nonce', 'certification_meta_nonce');
    $issuer = get_post_meta($post->ID, '_certification_issuer', true);
    $date_issued = get_post_meta($post->ID, '_certification_date_issued', true);
    $expiry_date = get_post_meta($post->ID, '_certification_expiry_date', true);
    $credential_id = get_post_meta($post->ID, '_certification_credential_id', true);
    
    echo '<table style="width: 100%;">';
    echo '<tr><td><label for="certification_issuer">Issuing Organization:</label></td>';
    echo '<td><input type="text" id="certification_issuer" name="certification_issuer" value="' . esc_attr($issuer) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><td><label for="certification_date_issued">Date Issued:</label></td>';
    echo '<td><input type="date" id="certification_date_issued" name="certification_date_issued" value="' . esc_attr($date_issued) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><td><label for="certification_expiry_date">Expiry Date:</label></td>';
    echo '<td><input type="date" id="certification_expiry_date" name="certification_expiry_date" value="' . esc_attr($expiry_date) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><td><label for="certification_credential_id">Credential ID:</label></td>';
    echo '<td><input type="text" id="certification_credential_id" name="certification_credential_id" value="' . esc_attr($credential_id) . '" style="width: 100%;" /></td></tr>';
    echo '</table>';
}

/**
 * Facility Category meta box callback
 */
function facility_category_callback($post) {
    wp_nonce_field('save_facility_category', 'facility_category_nonce');
    $category = get_post_meta($post->ID, '_facility_category', true);
    
    $categories = [
        'office' => 'Office',
        'infrastructure' => 'Infrastructure',
        'operations' => 'Operations',
        'development' => 'Development',
        'training' => 'Training',
        'storage' => 'Storage'
    ];
    
    echo '<select name="facility_category" style="width: 100%;">';
    echo '<option value="">Select Category</option>';
    foreach ($categories as $value => $label) {
        $selected = ($category === $value) ? 'selected' : '';
        echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
    }
    echo '</select>';
}

/**
 * Timeline Details meta box callback
 */
function timeline_details_callback($post) {
    wp_nonce_field('save_timeline_details', 'timeline_details_nonce');
    $year = get_post_meta($post->ID, '_timeline_year', true);
    $milestone_type = get_post_meta($post->ID, '_timeline_milestone_type', true);
    $highlight = get_post_meta($post->ID, '_timeline_highlight', true);
    
    echo '<table class="form-table">';
    
    echo '<tr>';
    echo '<th><label for="timeline_year">Year</label></th>';
    echo '<td><input type="number" id="timeline_year" name="timeline_year" value="' . esc_attr($year) . '" min="1990" max="2030" style="width: 100px;" /></td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<th><label for="timeline_milestone_type">Milestone Type</label></th>';
    echo '<td>';
    $milestone_types = [
        'founding' => 'Company Founding',
        'expansion' => 'Business Expansion',
        'certification' => 'Certification Achievement',
        'partnership' => 'Strategic Partnership',
        'technology' => 'Technology Milestone',
        'award' => 'Award/Recognition',
        'growth' => 'Growth Milestone'
    ];
    echo '<select name="timeline_milestone_type" style="width: 100%;">';
    echo '<option value="">Select Milestone Type</option>';
    foreach ($milestone_types as $value => $label) {
        $selected = ($milestone_type === $value) ? 'selected' : '';
        echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<th><label for="timeline_highlight">Highlight Event</label></th>';
    echo '<td><input type="checkbox" id="timeline_highlight" name="timeline_highlight" value="1" ' . checked($highlight, '1', false) . ' /> <label for="timeline_highlight">Mark as major milestone</label></td>';
    echo '</tr>';
    
    echo '</table>';
}

/**
 * Award Details meta box callback
 */
function award_details_callback($post) {
    wp_nonce_field('save_award_details', 'award_details_nonce');
    $year = get_post_meta($post->ID, '_award_year', true);
    $organization = get_post_meta($post->ID, '_award_organization', true);
    $category = get_post_meta($post->ID, '_award_category', true);
    
    echo '<table class="form-table">';
    echo '<tr><th scope="row"><label for="award_year">Award Year:</label></th>';
    echo '<td><input type="number" id="award_year" name="award_year" value="' . esc_attr($year) . '" min="1900" max="' . date('Y') . '" style="width: 100px;" /></td></tr>';
    
    echo '<tr><th scope="row"><label for="award_organization">Awarding Organization:</label></th>';
    echo '<td><input type="text" id="award_organization" name="award_organization" value="' . esc_attr($organization) . '" style="width: 100%;" placeholder="e.g., Technology Excellence Council" /></td></tr>';
    
    echo '<tr><th scope="row"><label for="award_category">Award Category:</label></th>';
    echo '<td><select id="award_category" name="award_category" style="width: 100%;">';
    
    $categories = [
        'Excellence in Service' => 'Excellence in Service',
        'Innovation Leadership' => 'Innovation Leadership',
        'Technical Excellence' => 'Technical Excellence',
        'Customer Service' => 'Customer Service',
        'Security Innovation' => 'Security Innovation',
        'Technology Innovation' => 'Technology Innovation',
        'Environmental Impact' => 'Environmental Impact',
        'Innovation' => 'Innovation',
        'Other' => 'Other'
    ];
    
    echo '<option value="">Select Category</option>';
    foreach ($categories as $value => $label) {
        $selected = ($category === $value) ? 'selected' : '';
        echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
    }
    echo '</select></td></tr>';
    echo '</table>';
}

/**
 * Save meta box data
 */
function save_about_us_meta_boxes($post_id) {
    // Mission/Vision meta
    if (isset($_POST['mission_vision_meta_nonce']) && wp_verify_nonce($_POST['mission_vision_meta_nonce'], 'mission_vision_meta_nonce')) {
        if (isset($_POST['mission_vision_type'])) {
            update_post_meta($post_id, '_mission_vision_type', sanitize_text_field($_POST['mission_vision_type']));
        }
    }
    
    // Company Values meta
    if (isset($_POST['company_value_meta_nonce']) && wp_verify_nonce($_POST['company_value_meta_nonce'], 'company_value_meta_nonce')) {
        if (isset($_POST['company_value_icon'])) {
            update_post_meta($post_id, '_company_value_icon', sanitize_text_field($_POST['company_value_icon']));
        }
    }
    
    // Certification meta
    if (isset($_POST['certification_meta_nonce']) && wp_verify_nonce($_POST['certification_meta_nonce'], 'certification_meta_nonce')) {
        if (isset($_POST['certification_issuer'])) {
            update_post_meta($post_id, '_certification_issuer', sanitize_text_field($_POST['certification_issuer']));
        }
        if (isset($_POST['certification_date_issued'])) {
            update_post_meta($post_id, '_certification_date_issued', sanitize_text_field($_POST['certification_date_issued']));
        }
        if (isset($_POST['certification_expiry_date'])) {
            update_post_meta($post_id, '_certification_expiry_date', sanitize_text_field($_POST['certification_expiry_date']));
        }
        if (isset($_POST['certification_credential_id'])) {
            update_post_meta($post_id, '_certification_credential_id', sanitize_text_field($_POST['certification_credential_id']));
        }
    }
    
    // Facility meta
    if (isset($_POST['facility_category_nonce']) && wp_verify_nonce($_POST['facility_category_nonce'], 'save_facility_category')) {
        if (isset($_POST['facility_category'])) {
            update_post_meta($post_id, '_facility_category', sanitize_text_field($_POST['facility_category']));
        }
    }
    
    // Timeline meta
    if (isset($_POST['timeline_details_nonce']) && wp_verify_nonce($_POST['timeline_details_nonce'], 'save_timeline_details')) {
        if (isset($_POST['timeline_year'])) {
            update_post_meta($post_id, '_timeline_year', intval($_POST['timeline_year']));
        }
        if (isset($_POST['timeline_milestone_type'])) {
            update_post_meta($post_id, '_timeline_milestone_type', sanitize_text_field($_POST['timeline_milestone_type']));
        }
        $highlight = isset($_POST['timeline_highlight']) ? '1' : '0';
        update_post_meta($post_id, '_timeline_highlight', $highlight);
    }
    
    // Award meta
    if (isset($_POST['award_details_nonce']) && wp_verify_nonce($_POST['award_details_nonce'], 'save_award_details')) {
        if (isset($_POST['award_year'])) {
            update_post_meta($post_id, '_award_year', intval($_POST['award_year']));
        }
        if (isset($_POST['award_organization'])) {
            update_post_meta($post_id, '_award_organization', sanitize_text_field($_POST['award_organization']));
        }
        if (isset($_POST['award_category'])) {
            update_post_meta($post_id, '_award_category', sanitize_text_field($_POST['award_category']));
        }
    }
}
add_action('save_post', 'save_about_us_meta_boxes');

/**
 * Add custom columns to About Us CPT admin lists
 */
function add_about_us_admin_columns($columns) {
    $post_type = get_current_screen()->post_type;
    
    switch ($post_type) {
        case 'mission_vision':
            $columns['type'] = 'Type';
            break;
        case 'company_values':
            $columns['icon'] = 'Icon';
            break;
        case 'certifications':
            $columns['issuer'] = 'Issuer';
            $columns['date_issued'] = 'Date Issued';
            break;
        case 'facilities':
            $columns['category'] = 'Category';
            break;
    }
    
    return $columns;
}
add_filter('manage_mission_vision_posts_columns', 'add_about_us_admin_columns');
add_filter('manage_company_values_posts_columns', 'add_about_us_admin_columns');
add_filter('manage_certifications_posts_columns', 'add_about_us_admin_columns');
add_filter('manage_facilities_posts_columns', 'add_about_us_admin_columns');

/**
 * Populate custom columns in About Us CPT admin lists
 */
function populate_about_us_admin_columns($column, $post_id) {
    switch ($column) {
        case 'type':
            echo esc_html(ucfirst(get_post_meta($post_id, '_mission_vision_type', true)));
            break;
        case 'icon':
            $icon = get_post_meta($post_id, '_company_value_icon', true);
            if ($icon) {
                echo '<i class="' . esc_attr($icon) . '"></i> ' . esc_html($icon);
            }
            break;
        case 'issuer':
            echo esc_html(get_post_meta($post_id, '_certification_issuer', true));
            break;
        case 'date_issued':
            $date = get_post_meta($post_id, '_certification_date_issued', true);
            if ($date) {
                echo esc_html(date('M j, Y', strtotime($date)));
            }
            break;
        case 'category':
            echo esc_html(ucfirst(get_post_meta($post_id, '_facility_category', true)));
            break;
    }
}
add_action('manage_mission_vision_posts_custom_column', 'populate_about_us_admin_columns', 10, 2);
add_action('manage_company_values_posts_custom_column', 'populate_about_us_admin_columns', 10, 2);
add_action('manage_certifications_posts_custom_column', 'populate_about_us_admin_columns', 10, 2);
add_action('manage_facilities_posts_custom_column', 'populate_about_us_admin_columns', 10, 2);