<?php
/**
 * Script to populate Company Timeline CPT with professional content
 * Run this script once to populate the timeline with realistic company milestones
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
 * Function to create timeline posts
 */
function create_timeline_post($title, $content, $year, $milestone_type, $is_highlight = false) {
    // Check if post already exists
    $existing_post = get_page_by_title($title, OBJECT, 'company_timeline');
    if ($existing_post) {
        echo "Timeline post '{$title}' already exists. Skipping...\n";
        return $existing_post->ID;
    }

    // Create the post
    $post_data = [
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => 'company_timeline',
        'post_author' => 1
    ];

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        // Add meta fields
        update_post_meta($post_id, '_timeline_year', $year);
        update_post_meta($post_id, '_timeline_milestone_type', $milestone_type);
        update_post_meta($post_id, '_timeline_highlight', $is_highlight ? '1' : '0');
        
        echo "Created timeline post: {$title} ({$year})\n";
        return $post_id;
    } else {
        echo "Failed to create timeline post: {$title}\n";
        return false;
    }
}

// Timeline data
$timeline_data = [
    [
        'title' => 'Company Founded',
        'content' => 'Bitcomm Technologies was established with a vision to provide cutting-edge technology solutions to businesses across various industries. Starting with a small team of passionate developers and IT professionals.',
        'year' => '2015',
        'milestone_type' => 'Company Founding',
        'highlight' => true
    ],
    [
        'title' => 'First Major Client',
        'content' => 'Secured our first enterprise client, delivering a comprehensive ERP solution that streamlined their business operations and increased efficiency by 40%.',
        'year' => '2016',
        'milestone_type' => 'Business Milestone',
        'highlight' => false
    ],
    [
        'title' => 'Team Expansion',
        'content' => 'Expanded our team to 15 professionals, including specialized developers, project managers, and quality assurance experts to better serve our growing client base.',
        'year' => '2017',
        'milestone_type' => 'Team Growth',
        'highlight' => false
    ],
    [
        'title' => 'Cloud Services Launch',
        'content' => 'Launched our cloud infrastructure services, helping businesses migrate to secure, scalable cloud environments with 99.9% uptime guarantee.',
        'year' => '2018',
        'milestone_type' => 'Service Launch',
        'highlight' => true
    ],
    [
        'title' => 'ISO 27001 Certification',
        'content' => 'Achieved ISO 27001 certification for information security management, demonstrating our commitment to maintaining the highest security standards for client data.',
        'year' => '2019',
        'milestone_type' => 'Certification',
        'highlight' => false
    ],
    [
        'title' => '100+ Projects Milestone',
        'content' => 'Successfully completed over 100 projects across various industries including healthcare, finance, education, and manufacturing, establishing ourselves as a trusted technology partner.',
        'year' => '2020',
        'milestone_type' => 'Business Milestone',
        'highlight' => true
    ],
    [
        'title' => 'AI & Machine Learning Division',
        'content' => 'Established our AI and Machine Learning division, offering advanced analytics, predictive modeling, and intelligent automation solutions to forward-thinking businesses.',
        'year' => '2021',
        'milestone_type' => 'Service Launch',
        'highlight' => false
    ],
    [
        'title' => 'Regional Expansion',
        'content' => 'Opened our second office to serve clients across the region, doubling our capacity and establishing strategic partnerships with leading technology vendors.',
        'year' => '2022',
        'milestone_type' => 'Business Expansion',
        'highlight' => true
    ],
    [
        'title' => 'Cybersecurity Excellence Award',
        'content' => 'Received the Regional Cybersecurity Excellence Award for our innovative approach to protecting client infrastructure and our zero-breach track record.',
        'year' => '2023',
        'milestone_type' => 'Award',
        'highlight' => false
    ],
    [
        'title' => 'Sustainable Technology Initiative',
        'content' => 'Launched our green technology initiative, helping clients reduce their carbon footprint through energy-efficient IT solutions and sustainable cloud practices.',
        'year' => '2024',
        'milestone_type' => 'Initiative Launch',
        'highlight' => true
    ]
];

echo "<h2>Populating Company Timeline Data...</h2>\n";
echo "<pre>\n";

// Create timeline posts
foreach ($timeline_data as $timeline_item) {
    create_timeline_post(
        $timeline_item['title'],
        $timeline_item['content'],
        $timeline_item['year'],
        $timeline_item['milestone_type'],
        $timeline_item['highlight']
    );
}

echo "\nTimeline data population completed!\n";
echo "</pre>\n";

echo "<p><strong>Next Steps:</strong></p>";
echo "<ul>";
echo "<li>Visit the <a href='" . admin_url('edit.php?post_type=company_timeline') . "'>Company Timeline admin page</a> to manage timeline entries</li>";
echo "<li>You can edit, reorder, or add new timeline entries as needed</li>";
echo "<li>The timeline will appear on your About Us page in chronological order</li>";
echo "</ul>";
?>