<?php
/**
 * Script to populate Award CPT with enhanced professional content
 * Run this script to populate awards with realistic data including meta fields
 */

// Security check
if (!defined('ABSPATH')) {
    // Load WordPress
    require_once('../../../wp-load.php');
}

// Check if user is admin
if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
}

/**
 * Function to create award posts with enhanced meta data
 */
function create_enhanced_award($title, $content, $year, $organization, $category) {
    // Check if post already exists
    $existing_post = get_page_by_title($title, OBJECT, 'award');
    if ($existing_post) {
        // Update existing post with new meta data
        update_post_meta($existing_post->ID, '_award_year', $year);
        update_post_meta($existing_post->ID, '_award_organization', $organization);
        update_post_meta($existing_post->ID, '_award_category', $category);
        echo "Updated existing award: {$title} with new meta data\n";
        return $existing_post->ID;
    }

    // Create the post
    $post_data = [
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => 'award',
        'post_author' => 1
    ];

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        // Add meta fields
        update_post_meta($post_id, '_award_year', $year);
        update_post_meta($post_id, '_award_organization', $organization);
        update_post_meta($post_id, '_award_category', $category);
        
        echo "Created award: {$title} ({$year})\n";
        return $post_id;
    } else {
        echo "Failed to create award: {$title}\n";
        return false;
    }
}

// Enhanced awards data
$awards_data = [
    [
        'title' => 'Best IT Solutions Provider 2023',
        'content' => 'Recognized for delivering exceptional IT solutions that drive business transformation and innovation. This award acknowledges our commitment to excellence in technology consulting, implementation, and support services across multiple industry sectors.',
        'year' => '2023',
        'organization' => 'Regional Technology Council',
        'category' => 'Excellence in Service'
    ],
    [
        'title' => 'Cybersecurity Excellence Award',
        'content' => 'Honored for our outstanding cybersecurity practices and zero-breach track record. This recognition highlights our advanced security protocols, proactive threat detection, and comprehensive data protection strategies that keep our clients safe.',
        'year' => '2023',
        'organization' => 'Cybersecurity Institute',
        'category' => 'Security Innovation'
    ],
    [
        'title' => 'Digital Transformation Leader',
        'content' => 'Awarded for successfully leading digital transformation initiatives that have helped businesses modernize their operations, improve efficiency, and achieve sustainable growth in the digital age.',
        'year' => '2022',
        'organization' => 'Digital Business Association',
        'category' => 'Innovation Leadership'
    ],
    [
        'title' => 'Cloud Solutions Excellence',
        'content' => 'Recognized for our expertise in cloud migration, infrastructure optimization, and delivering scalable cloud solutions that provide 99.9% uptime and significant cost savings for our clients.',
        'year' => '2022',
        'organization' => 'Cloud Computing Consortium',
        'category' => 'Technical Excellence'
    ],
    [
        'title' => 'Customer Satisfaction Award',
        'content' => 'Achieved the highest customer satisfaction rating in our category, with 98% client retention rate and outstanding feedback for our responsive support, technical expertise, and project delivery excellence.',
        'year' => '2021',
        'organization' => 'Business Excellence Institute',
        'category' => 'Customer Service'
    ],
    [
        'title' => 'Innovation in AI Solutions',
        'content' => 'Honored for developing cutting-edge artificial intelligence and machine learning solutions that have revolutionized business processes and delivered measurable ROI for our clients across various industries.',
        'year' => '2021',
        'organization' => 'AI Innovation Council',
        'category' => 'Technology Innovation'
    ],
    [
        'title' => 'Sustainable Technology Initiative',
        'content' => 'Recognized for our commitment to environmental sustainability through green technology solutions, energy-efficient IT infrastructure, and helping clients reduce their carbon footprint by an average of 30%.',
        'year' => '2024',
        'organization' => 'Green Technology Alliance',
        'category' => 'Environmental Impact'
    ],
    [
        'title' => 'Emerging Technology Pioneer',
        'content' => 'Awarded for our early adoption and successful implementation of emerging technologies including IoT, blockchain, and edge computing solutions that have given our clients competitive advantages.',
        'year' => '2020',
        'organization' => 'Technology Pioneers Association',
        'category' => 'Innovation'
    ]
];

echo "<h2>Populating Enhanced Awards Data...</h2>\n";
echo "<pre>\n";

// Create or update award posts
foreach ($awards_data as $award) {
    create_enhanced_award(
        $award['title'],
        $award['content'],
        $award['year'],
        $award['organization'],
        $award['category']
    );
}

echo "\nEnhanced awards data population completed!\n";
echo "</pre>\n";

echo "<p><strong>Next Steps:</strong></p>";
echo "<ul>";
echo "<li>Visit the <a href='" . admin_url('edit.php?post_type=award') . "'>Awards admin page</a> to manage award entries</li>";
echo "<li>You can add custom images to each award for better visual presentation</li>";
echo "<li>The awards will appear on your About Us page with enhanced styling and meta information</li>";
echo "<li>Each award now includes year, organization, and category information</li>";
echo "</ul>";
?>