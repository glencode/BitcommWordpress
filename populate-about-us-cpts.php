<?php
/**
 * Script to populate About Us CPTs with sample data
 * 
 * This script creates sample content for:
 * - Mission & Vision
 * - Company Values
 * - Certifications
 * - Company Facilities
 * 
 * Usage: Access via browser at your-domain.com/wp-content/themes/your-theme/populate-about-us-cpts.php?populate=true
 */

// Security check
if (!isset($_GET['populate']) || $_GET['populate'] !== 'true') {
    die('Access denied. Add ?populate=true to the URL to run this script.');
}

// Load WordPress
$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if (!file_exists($wp_load_path)) {
    die('Error: WordPress not found. Please check the path: ' . $wp_load_path);
}
require_once $wp_load_path;

// Check if user is admin
if (!current_user_can('manage_options')) {
    wp_die('You do not have permission to run this script.');
}

echo '<h1>Populating About Us CPTs...</h1>';

// Enhanced Mission & Vision Data
$mission_vision_data = [
    [
        'title' => 'Our Mission',
        'content' => 'To empower businesses across Kenya with innovative IT solutions that drive growth, efficiency, and digital transformation. We are committed to delivering exceptional technology services that help our clients achieve their strategic objectives while building lasting partnerships based on trust, expertise, and results.',
        'type' => 'mission'
    ],
    [
        'title' => 'Our Vision',
        'content' => 'To be Kenya\'s leading IT solutions provider, recognized for our technical excellence, innovative approach, and unwavering commitment to client success. We envision a future where every business, regardless of size, has access to world-class technology solutions that enable them to compete and thrive in the digital economy.',
        'type' => 'vision'
    ]
];

// Company Values Data
$company_values_data = [
    [
        'title' => 'Excellence',
        'content' => 'We strive for excellence in everything we do, from the quality of our solutions to the level of service we provide. Our commitment to excellence drives us to continuously improve and exceed expectations.',
        'icon' => 'fas fa-star'
    ],
    [
        'title' => 'Integrity',
        'content' => 'We conduct business with the highest ethical standards, maintaining transparency, honesty, and accountability in all our interactions with clients, partners, and team members.',
        'icon' => 'fas fa-shield-alt'
    ],
    [
        'title' => 'Innovation',
        'content' => 'We embrace cutting-edge technologies and creative problem-solving approaches to deliver innovative solutions that give our clients a competitive advantage in their respective markets.',
        'icon' => 'fas fa-lightbulb'
    ],
    [
        'title' => 'Collaboration',
        'content' => 'We believe in the power of teamwork and partnership. We work closely with our clients to understand their unique needs and collaborate to develop tailored solutions that drive success.',
        'icon' => 'fas fa-handshake'
    ],
    [
        'title' => 'Local Impact',
        'content' => 'We are committed to contributing to Kenya\'s economic growth by supporting local businesses with technology solutions that enhance their competitiveness and create employment opportunities.',
        'icon' => 'fas fa-map-marker-alt'
    ],
    [
        'title' => 'Reliability',
        'content' => 'Our clients depend on us for critical IT infrastructure and support. We take this responsibility seriously, ensuring consistent, reliable service delivery and 24/7 support when needed.',
        'icon' => 'fas fa-clock'
    ]
];

// Certifications Data
$certifications_data = [
    [
        'title' => 'ISO 27001:2013 Information Security Management',
        'content' => 'Certified for implementing and maintaining an effective Information Security Management System (ISMS) that ensures the confidentiality, integrity, and availability of client data and systems.',
        'issuer' => 'Kenya Bureau of Standards (KEBS)',
        'date_issued' => '2023-03-15'
    ],
    [
        'title' => 'Microsoft Gold Partner Certification',
        'content' => 'Recognized as a Microsoft Gold Partner with competencies in Cloud Platform, Application Development, and Data Analytics, demonstrating our expertise in Microsoft technologies.',
        'issuer' => 'Microsoft Corporation',
        'date_issued' => '2023-01-10'
    ],
    [
        'title' => 'AWS Advanced Consulting Partner',
        'content' => 'Certified Amazon Web Services Advanced Consulting Partner with proven expertise in cloud migration, infrastructure design, and managed cloud services.',
        'issuer' => 'Amazon Web Services',
        'date_issued' => '2022-11-20'
    ],
    [
        'title' => 'ITIL 4 Foundation Certified Team',
        'content' => 'Our entire technical team is ITIL 4 Foundation certified, ensuring we follow industry best practices for IT service management and delivery.',
        'issuer' => 'AXELOS Global Best Practice',
        'date_issued' => '2022-08-05'
    ]
];

// Facilities Data
$facilities_data = [
    [
        'title' => 'Modern Office Complex',
        'content' => 'Our headquarters in Nairobi features a state-of-the-art office complex with modern workspaces, collaborative areas, and advanced communication systems to support our team and client meetings.',
        'category' => 'office'
    ],
    [
        'title' => 'Tier III Data Center',
        'content' => 'We operate a Tier III certified data center with 99.982% uptime guarantee, featuring redundant power systems, advanced cooling, and 24/7 monitoring to ensure maximum reliability for hosted services.',
        'category' => 'infrastructure'
    ],
    [
        'title' => 'Network Operations Center (NOC)',
        'content' => 'Our 24/7 Network Operations Center monitors client infrastructure around the clock, providing proactive monitoring, incident response, and performance optimization services.',
        'category' => 'operations'
    ],
    [
        'title' => 'Testing and Development Labs',
        'content' => 'Dedicated testing environments and development labs equipped with the latest hardware and software for solution development, testing, and quality assurance before deployment.',
        'category' => 'development'
    ],
    [
        'title' => 'Training and Conference Facilities',
        'content' => 'Modern training rooms and conference facilities equipped with advanced AV systems for client training, workshops, and technology demonstrations.',
        'category' => 'training'
    ],
    [
        'title' => 'Secure Storage and Backup Facility',
        'content' => 'Climate-controlled secure storage facility for equipment and data backup systems, ensuring business continuity and disaster recovery capabilities.',
        'category' => 'storage'
    ]
];

// Function to create posts
function create_about_us_post($post_type, $title, $content, $meta_data = []) {
    // Check if post already exists
    $existing_post = get_page_by_title($title, OBJECT, $post_type);
    if ($existing_post) {
        echo "<p>✓ {$title} already exists (ID: {$existing_post->ID})</p>";
        return $existing_post->ID;
    }

    $post_data = [
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => $post_type,
        'post_author' => 1
    ];

    $post_id = wp_insert_post($post_data);

    if (is_wp_error($post_id)) {
        echo "<p>✗ Error creating {$title}: " . $post_id->get_error_message() . "</p>";
        return false;
    }

    // Add meta data
    foreach ($meta_data as $key => $value) {
        update_post_meta($post_id, $key, $value);
    }

    echo "<p>✓ Created: {$title} (ID: {$post_id})</p>";
    return $post_id;
}

// Create Mission & Vision posts
echo '<h2>Creating Mission & Vision Posts...</h2>';
foreach ($mission_vision_data as $item) {
    create_about_us_post(
        'mission_vision',
        $item['title'],
        $item['content'],
        ['_mission_vision_type' => $item['type']]
    );
}

// Create Company Values posts
echo '<h2>Creating Company Values Posts...</h2>';
foreach ($company_values_data as $item) {
    create_about_us_post(
        'company_values',
        $item['title'],
        $item['content'],
        ['_company_value_icon' => $item['icon']]
    );
}

// Create Certifications posts
echo '<h2>Creating Certifications Posts...</h2>';
foreach ($certifications_data as $item) {
    $meta_data = [];
    if (isset($item['issuer'])) {
        $meta_data['_certification_issuer'] = $item['issuer'];
    }
    if (isset($item['date_issued'])) {
        $meta_data['_certification_date_issued'] = $item['date_issued'];
    }
    
    create_about_us_post(
        'certifications',
        $item['title'],
        $item['content'],
        $meta_data
    );
}

// Create Facilities posts
echo '<h2>Creating Facilities Posts...</h2>';
foreach ($facilities_data as $item) {
    create_about_us_post(
        'facilities',
        $item['title'],
        $item['content'],
        ['_facility_category' => $item['category']]
    );
}

echo '<h2>✅ About Us CPTs Population Complete!</h2>';
echo '<p><strong>Summary:</strong></p>';
echo '<ul>';
echo '<li>' . count($mission_vision_data) . ' Mission & Vision items created</li>';
echo '<li>' . count($company_values_data) . ' Company Values created</li>';
echo '<li>' . count($certifications_data) . ' Certifications created</li>';
echo '<li>' . count($facilities_data) . ' Facilities created</li>';
echo '</ul>';

echo '<p><strong>Next Steps:</strong></p>';
echo '<ol>';
echo '<li>Visit your WordPress admin dashboard</li>';
echo '<li>Check the new CPT menu items: Mission & Vision, Company Values, Certifications, Facilities</li>';
echo '<li>View your About Us page to see the new content</li>';
echo '<li>Customize the content as needed</li>';
echo '</ol>';

echo '<p><a href="' . admin_url() . '" class="button">Go to WordPress Admin</a></p>';

?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    line-height: 1.6;
}
h1, h2 {
    color: #2C1D6D;
}
p {
    margin: 10px 0;
}
.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #2C1D6D;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
}
.button:hover {
    background-color: #1a1142;
}
ul, ol {
    margin: 10px 0;
    padding-left: 30px;
}
</style>