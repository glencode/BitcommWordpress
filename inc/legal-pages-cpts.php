<?php
/**
 * Legal Pages Custom Post Types
 * 
 * This file defines CPTs for legal pages:
 * - Legal Sections (for Privacy Policy, Terms of Service, Cookie Policy)
 * - Legal Clauses (reusable legal text blocks)
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Legal Sections CPT
 */
function register_legal_sections_cpt() {
    $labels = array(
        'name'                  => _x('Legal Sections', 'Post Type General Name', 'itsulu'),
        'singular_name'         => _x('Legal Section', 'Post Type Singular Name', 'itsulu'),
        'menu_name'             => __('Legal Sections', 'itsulu'),
        'name_admin_bar'        => __('Legal Section', 'itsulu'),
        'archives'              => __('Legal Section Archives', 'itsulu'),
        'attributes'            => __('Legal Section Attributes', 'itsulu'),
        'parent_item_colon'     => __('Parent Legal Section:', 'itsulu'),
        'all_items'             => __('All Legal Sections', 'itsulu'),
        'add_new_item'          => __('Add New Legal Section', 'itsulu'),
        'add_new'               => __('Add New', 'itsulu'),
        'new_item'              => __('New Legal Section', 'itsulu'),
        'edit_item'             => __('Edit Legal Section', 'itsulu'),
        'update_item'           => __('Update Legal Section', 'itsulu'),
        'view_item'             => __('View Legal Section', 'itsulu'),
        'view_items'            => __('View Legal Sections', 'itsulu'),
        'search_items'          => __('Search Legal Sections', 'itsulu'),
        'not_found'             => __('Not found', 'itsulu'),
        'not_found_in_trash'    => __('Not found in Trash', 'itsulu'),
        'featured_image'        => __('Featured Image', 'itsulu'),
        'set_featured_image'    => __('Set featured image', 'itsulu'),
        'remove_featured_image' => __('Remove featured image', 'itsulu'),
        'use_featured_image'    => __('Use as featured image', 'itsulu'),
        'insert_into_item'      => __('Insert into Legal Section', 'itsulu'),
        'uploaded_to_this_item' => __('Uploaded to this Legal Section', 'itsulu'),
        'items_list'            => __('Legal Sections list', 'itsulu'),
        'items_list_navigation' => __('Legal Sections list navigation', 'itsulu'),
        'filter_items_list'     => __('Filter Legal Sections list', 'itsulu'),
    );
    
    $args = array(
        'label'                 => __('Legal Section', 'itsulu'),
        'description'           => __('Legal page sections and content', 'itsulu'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'excerpt', 'revisions', 'page-attributes'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 25,
        'menu_icon'             => 'dashicons-privacy',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('legal_sections', $args);
}
add_action('init', 'register_legal_sections_cpt', 0);

/**
 * Register Legal Clauses CPT
 */
function register_legal_clauses_cpt() {
    $labels = array(
        'name'                  => _x('Legal Clauses', 'Post Type General Name', 'itsulu'),
        'singular_name'         => _x('Legal Clause', 'Post Type Singular Name', 'itsulu'),
        'menu_name'             => __('Legal Clauses', 'itsulu'),
        'name_admin_bar'        => __('Legal Clause', 'itsulu'),
        'archives'              => __('Legal Clause Archives', 'itsulu'),
        'attributes'            => __('Legal Clause Attributes', 'itsulu'),
        'parent_item_colon'     => __('Parent Legal Clause:', 'itsulu'),
        'all_items'             => __('All Legal Clauses', 'itsulu'),
        'add_new_item'          => __('Add New Legal Clause', 'itsulu'),
        'add_new'               => __('Add New', 'itsulu'),
        'new_item'              => __('New Legal Clause', 'itsulu'),
        'edit_item'             => __('Edit Legal Clause', 'itsulu'),
        'update_item'           => __('Update Legal Clause', 'itsulu'),
        'view_item'             => __('View Legal Clause', 'itsulu'),
        'view_items'            => __('View Legal Clauses', 'itsulu'),
        'search_items'          => __('Search Legal Clauses', 'itsulu'),
        'not_found'             => __('Not found', 'itsulu'),
        'not_found_in_trash'    => __('Not found in Trash', 'itsulu'),
        'featured_image'        => __('Featured Image', 'itsulu'),
        'set_featured_image'    => __('Set featured image', 'itsulu'),
        'remove_featured_image' => __('Remove featured image', 'itsulu'),
        'use_featured_image'    => __('Use as featured image', 'itsulu'),
        'insert_into_item'      => __('Insert into Legal Clause', 'itsulu'),
        'uploaded_to_this_item' => __('Uploaded to this Legal Clause', 'itsulu'),
        'items_list'            => __('Legal Clauses list', 'itsulu'),
        'items_list_navigation' => __('Legal Clauses list navigation', 'itsulu'),
        'filter_items_list'     => __('Filter Legal Clauses list', 'itsulu'),
    );
    
    $args = array(
        'label'                 => __('Legal Clause', 'itsulu'),
        'description'           => __('Reusable legal text blocks and clauses', 'itsulu'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'excerpt', 'revisions'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=legal_sections',
        'menu_position'         => 26,
        'menu_icon'             => 'dashicons-text-page',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('legal_clauses', $args);
}
add_action('init', 'register_legal_clauses_cpt', 0);

/**
 * Add meta boxes for legal pages
 */
function add_legal_meta_boxes() {
    // Legal Sections meta fields
    add_meta_box(
        'legal_section_details',
        'Section Details',
        'legal_section_details_callback',
        'legal_sections',
        'side',
        'high'
    );
    
    // Legal Clauses meta fields
    add_meta_box(
        'legal_clause_details',
        'Clause Details',
        'legal_clause_details_callback',
        'legal_clauses',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'add_legal_meta_boxes');

/**
 * Legal Section Details meta box callback
 */
function legal_section_details_callback($post) {
    wp_nonce_field('save_legal_section_details', 'legal_section_details_nonce');
    $page_type = get_post_meta($post->ID, '_legal_page_type', true);
    $section_order = get_post_meta($post->ID, '_section_order', true);
    $is_required = get_post_meta($post->ID, '_is_required', true);
    
    echo '<table class="form-table">';
    echo '<tr><th scope="row"><label for="legal_page_type">Page Type:</label></th>';
    echo '<td><select id="legal_page_type" name="legal_page_type" style="width: 100%;">';
    
    $page_types = [
        'privacy-policy' => 'Privacy Policy',
        'terms-of-service' => 'Terms of Service',
        'cookie-policy' => 'Cookie Policy',
        'general' => 'General Legal'
    ];
    
    echo '<option value="">Select Page Type</option>';
    foreach ($page_types as $value => $label) {
        $selected = ($page_type === $value) ? 'selected' : '';
        echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
    }
    echo '</select></td></tr>';
    
    echo '<tr><th scope="row"><label for="section_order">Section Order:</label></th>';
    echo '<td><input type="number" id="section_order" name="section_order" value="' . esc_attr($section_order) . '" min="1" style="width: 80px;" /></td></tr>';
    
    echo '<tr><th scope="row"><label for="is_required">Required Section:</label></th>';
    echo '<td><input type="checkbox" id="is_required" name="is_required" value="1" ' . checked($is_required, '1', false) . ' /> This section is legally required</td></tr>';
    echo '</table>';
}

/**
 * Legal Clause Details meta box callback
 */
function legal_clause_details_callback($post) {
    wp_nonce_field('save_legal_clause_details', 'legal_clause_details_nonce');
    $clause_type = get_post_meta($post->ID, '_clause_type', true);
    $applicable_pages = get_post_meta($post->ID, '_applicable_pages', true);
    $last_updated = get_post_meta($post->ID, '_last_legal_review', true);
    
    echo '<table class="form-table">';
    echo '<tr><th scope="row"><label for="clause_type">Clause Type:</label></th>';
    echo '<td><select id="clause_type" name="clause_type" style="width: 100%;">';
    
    $clause_types = [
        'disclaimer' => 'Disclaimer',
        'limitation-liability' => 'Limitation of Liability',
        'data-collection' => 'Data Collection',
        'cookies' => 'Cookies',
        'contact-info' => 'Contact Information',
        'updates' => 'Policy Updates',
        'general' => 'General Clause'
    ];
    
    echo '<option value="">Select Clause Type</option>';
    foreach ($clause_types as $value => $label) {
        $selected = ($clause_type === $value) ? 'selected' : '';
        echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
    }
    echo '</select></td></tr>';
    
    echo '<tr><th scope="row"><label for="applicable_pages">Applicable Pages:</label></th>';
    echo '<td><input type="text" id="applicable_pages" name="applicable_pages" value="' . esc_attr($applicable_pages) . '" style="width: 100%;" placeholder="e.g., privacy-policy, terms-of-service" /></td></tr>';
    
    echo '<tr><th scope="row"><label for="last_legal_review">Last Legal Review:</label></th>';
    echo '<td><input type="date" id="last_legal_review" name="last_legal_review" value="' . esc_attr($last_updated) . '" style="width: 100%;" /></td></tr>';
    echo '</table>';
}

/**
 * Save meta box data
 */
function save_legal_meta_boxes($post_id) {
    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Legal Sections meta
    if (isset($_POST['legal_section_details_nonce']) && wp_verify_nonce($_POST['legal_section_details_nonce'], 'save_legal_section_details')) {
        if (isset($_POST['legal_page_type'])) {
            update_post_meta($post_id, '_legal_page_type', sanitize_text_field($_POST['legal_page_type']));
        }
        if (isset($_POST['section_order'])) {
            update_post_meta($post_id, '_section_order', intval($_POST['section_order']));
        }
        $is_required = isset($_POST['is_required']) ? '1' : '0';
        update_post_meta($post_id, '_is_required', $is_required);
    }
    
    // Legal Clauses meta
    if (isset($_POST['legal_clause_details_nonce']) && wp_verify_nonce($_POST['legal_clause_details_nonce'], 'save_legal_clause_details')) {
        if (isset($_POST['clause_type'])) {
            update_post_meta($post_id, '_clause_type', sanitize_text_field($_POST['clause_type']));
        }
        if (isset($_POST['applicable_pages'])) {
            update_post_meta($post_id, '_applicable_pages', sanitize_text_field($_POST['applicable_pages']));
        }
        if (isset($_POST['last_legal_review'])) {
            update_post_meta($post_id, '_last_legal_review', sanitize_text_field($_POST['last_legal_review']));
        }
    }
}
add_action('save_post', 'save_legal_meta_boxes');

/**
 * Add custom admin columns
 */
function add_legal_admin_columns($columns) {
    $new_columns = [];
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['page_type'] = 'Page Type';
            $new_columns['section_order'] = 'Order';
            $new_columns['required'] = 'Required';
        }
    }
    return $new_columns;
}
add_filter('manage_legal_sections_posts_columns', 'add_legal_admin_columns');

function add_legal_clauses_admin_columns($columns) {
    $new_columns = [];
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['clause_type'] = 'Type';
            $new_columns['applicable_pages'] = 'Applicable Pages';
            $new_columns['last_review'] = 'Last Review';
        }
    }
    return $new_columns;
}
add_filter('manage_legal_clauses_posts_columns', 'add_legal_clauses_admin_columns');

/**
 * Populate custom admin columns
 */
function populate_legal_admin_columns($column, $post_id) {
    switch ($column) {
        case 'page_type':
            $page_type = get_post_meta($post_id, '_legal_page_type', true);
            echo esc_html(ucwords(str_replace('-', ' ', $page_type)));
            break;
        case 'section_order':
            $order = get_post_meta($post_id, '_section_order', true);
            echo esc_html($order ?: '-');
            break;
        case 'required':
            $required = get_post_meta($post_id, '_is_required', true);
            echo $required === '1' ? '<span style="color: #d63384;">✓ Required</span>' : '-';
            break;
        case 'clause_type':
            $type = get_post_meta($post_id, '_clause_type', true);
            echo esc_html(ucwords(str_replace('-', ' ', $type)));
            break;
        case 'applicable_pages':
            $pages = get_post_meta($post_id, '_applicable_pages', true);
            echo esc_html($pages ?: 'All');
            break;
        case 'last_review':
            $date = get_post_meta($post_id, '_last_legal_review', true);
            if ($date) {
                echo esc_html(date('M j, Y', strtotime($date)));
            } else {
                echo '-';
            }
            break;
    }
}
add_action('manage_legal_sections_posts_custom_column', 'populate_legal_admin_columns', 10, 2);
add_action('manage_legal_clauses_posts_custom_column', 'populate_legal_admin_columns', 10, 2);

/**
 * Make admin columns sortable
 */
function make_legal_columns_sortable($columns) {
    $columns['page_type'] = 'page_type';
    $columns['section_order'] = 'section_order';
    $columns['clause_type'] = 'clause_type';
    return $columns;
}
add_filter('manage_edit-legal_sections_sortable_columns', 'make_legal_columns_sortable');
add_filter('manage_edit-legal_clauses_sortable_columns', 'make_legal_columns_sortable');

/**
 * Handle sorting by custom fields
 */
function legal_columns_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ('page_type' === $orderby) {
        $query->set('meta_key', '_legal_page_type');
        $query->set('orderby', 'meta_value');
    } elseif ('section_order' === $orderby) {
        $query->set('meta_key', '_section_order');
        $query->set('orderby', 'meta_value_num');
    } elseif ('clause_type' === $orderby) {
        $query->set('meta_key', '_clause_type');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'legal_columns_orderby');
?>