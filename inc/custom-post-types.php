<?php
/**
 * Custom Post Types
 * 
 * @package Itsulu
 */

// Testimonials Custom Post Type
function itsulu_register_testimonials() {
    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'add_new'           => 'Add New',
        'add_new_item'      => 'Add New Testimonial',
        'edit_item'         => 'Edit Testimonial',
        'new_item'          => 'New Testimonial',
        'view_item'         => 'View Testimonial',
        'search_items'      => 'Search Testimonials',
        'not_found'         => 'No testimonials found',
        'not_found_in_trash'=> 'No testimonials found in Trash',
        'menu_name'         => 'Testimonials'
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_menu'      => true,
        'menu_position'     => 5,
        'menu_icon'         => 'dashicons-format-quote',
        'supports'          => array('title', 'editor', 'thumbnail'),
        'has_archive'       => true,
        'rewrite'           => array('slug' => 'testimonials'),
        'show_in_rest'      => true
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'itsulu_register_testimonials');

// Add rating field to testimonials
/* 
// Commented out to prevent duplicate rating fields
function itsulu_add_testimonial_rating_field() {
    if(function_exists('acf_add_local_field_group')):
        acf_add_local_field_group(array(
            'key' => 'group_testimonial_rating',
            'title' => 'Testimonial Details',
            'fields' => array(
                array(
                    'key' => 'field_testimonial_rating',
                    'label' => 'Rating',
                    'name' => 'testimonial_rating',
                    'type' => 'select',
                    'instructions' => 'Select the rating (1-5 stars)',
                    'required' => 1,
                    'choices' => array(
                        '1' => '1 Star',
                        '2' => '2 Stars',
                        '3' => '3 Stars',
                        '4' => '4 Stars',
                        '5' => '5 Stars'
                    ),
                    'default_value' => '5',
                    'return_format' => 'value',
                    'ui' => 1,
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'testimonial',
                    ),
                ),
            ),
        ));
    endif;
}
add_action('acf/init', 'itsulu_add_testimonial_rating_field'); 
*/ 