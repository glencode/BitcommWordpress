<?php
/**
 * Update Existing Custom Post Types with Better Content
 * 
 * This script finds and updates existing CPT entries that have lorem ipsum or placeholder content
 * Run this file to refresh existing content with better, more realistic data
 * 
 * @package Itsulu
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    // Load WordPress - correct path from theme to WordPress root
    $wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once($wp_load_path);
    } else {
        die('WordPress not found. Please ensure this script is in the correct theme directory.');
    }
}

// Function to check if content contains lorem ipsum or placeholder text
function is_placeholder_content($content) {
    $placeholder_indicators = array(
        'lorem ipsum',
        'lorem',
        'ipsum',
        'placeholder',
        'sample text',
        'dummy text',
        'test content',
        'example content',
        'consectetur adipiscing',
        'sed do eiusmod',
        'tempor incididunt'
    );
    
    $content_lower = strtolower($content);
    
    foreach ($placeholder_indicators as $indicator) {
        if (strpos($content_lower, $indicator) !== false) {
            return true;
        }
    }
    
    return false;
}

// Function to download and set featured image from Unsplash
function set_unsplash_featured_image($post_id, $unsplash_url, $image_name) {
    // Check if post already has a featured image
    if (has_post_thumbnail($post_id)) {
        return false; // Don't replace existing images
    }
    
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($unsplash_url);
    
    if ($image_data !== false) {
        $filename = $image_name . '.jpg';
        $file = $upload_dir['path'] . '/' . $filename;
        
        file_put_contents($file, $image_data);
        
        $wp_filetype = wp_check_filetype($filename, null);
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        
        $attach_id = wp_insert_attachment($attachment, $file, $post_id);
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
        wp_update_attachment_metadata($attach_id, $attach_data);
        set_post_thumbnail($post_id, $attach_id);
        
        return $attach_id;
    }
    return false;
}

// Update Services
function update_existing_services() {
    $services = get_posts(array(
        'post_type' => 'itsulu_service',
        'post_status' => 'publish',
        'numberposts' => -1
    ));
    
    $updated_count = 0;
    
    $service_content = array(
        'Web Development' => array(
            'content' => 'We create modern, responsive websites that drive business growth. Our expert developers use the latest technologies to build fast, secure, and scalable web solutions tailored to your specific needs.',
            'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop'
        ),
        'Mobile App Development' => array(
            'content' => 'Transform your ideas into powerful mobile applications. We develop native and cross-platform apps for iOS and Android that provide exceptional user experiences and drive engagement.',
            'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&h=600&fit=crop'
        ),
        'Cloud Solutions' => array(
            'content' => 'Migrate to the cloud with confidence. Our cloud experts help you leverage AWS, Azure, and Google Cloud to improve scalability, reduce costs, and enhance security for your business operations.',
            'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&h=600&fit=crop'
        ),
        'Digital Marketing' => array(
            'content' => 'Boost your online presence with our comprehensive digital marketing strategies. From SEO and PPC to social media marketing, we help you reach your target audience and grow your business.',
            'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop'
        ),
        'Cybersecurity' => array(
            'content' => 'Protect your business from cyber threats with our advanced security solutions. We provide comprehensive security assessments, implementation, and ongoing monitoring to keep your data safe.',
            'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&h=600&fit=crop'
        ),
        'Data Analytics' => array(
            'content' => 'Turn your data into actionable insights. Our analytics experts help you collect, analyze, and visualize data to make informed business decisions and drive growth.',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop'
        )
    );
    
    foreach ($services as $service) {
        $needs_update = false;
        $title = $service->post_title;
        
        // Check if content needs updating
        if (is_placeholder_content($service->post_content) || empty(trim($service->post_content))) {
            $needs_update = true;
        }
        
        if ($needs_update) {
            // Find matching content or use generic content
            $new_content = '';
            $image_url = '';
            
            foreach ($service_content as $service_name => $data) {
                if (stripos($title, $service_name) !== false || stripos($service_name, $title) !== false) {
                    $new_content = $data['content'];
                    $image_url = $data['image'];
                    break;
                }
            }
            
            // If no specific match found, use generic content
            if (empty($new_content)) {
                $new_content = 'We provide professional ' . strtolower($title) . ' services designed to help your business succeed. Our experienced team delivers high-quality solutions tailored to your specific requirements and business objectives.';
                $image_url = 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop';
            }
            
            // Update the post
            wp_update_post(array(
                'ID' => $service->ID,
                'post_content' => $new_content
            ));
            
            // Set featured image if none exists
            if (!empty($image_url)) {
                set_unsplash_featured_image($service->ID, $image_url, sanitize_title($title));
            }
            
            $updated_count++;
        }
    }
    
    echo "Updated {$updated_count} service(s)\n";
}

// Update Testimonials
function update_existing_testimonials() {
    $testimonials = get_posts(array(
        'post_type' => 'testimonial',
        'post_status' => 'publish',
        'numberposts' => -1
    ));
    
    $updated_count = 0;
    
    $sample_testimonials = array(
        array(
            'content' => 'Working with this team was an absolute pleasure. They delivered our project on time and exceeded our expectations in every way.',
            'client_name' => 'Sarah Johnson',
            'client_position' => 'CEO',
            'client_company' => 'TechStart Inc.',
            'rating' => 5
        ),
        array(
            'content' => 'The technical expertise and professionalism of this team is outstanding. Our new platform has transformed our business operations.',
            'client_name' => 'Michael Chen',
            'client_position' => 'CTO',
            'client_company' => 'InnovateLab',
            'rating' => 5
        ),
        array(
            'content' => 'Their digital marketing strategies helped us increase our online presence by 300%. Highly recommended!',
            'client_name' => 'Emily Rodriguez',
            'client_position' => 'Marketing Director',
            'client_company' => 'GrowthCorp',
            'rating' => 5
        )
    );
    
    foreach ($testimonials as $index => $testimonial) {
        $needs_update = false;
        
        // Check if content needs updating
        if (is_placeholder_content($testimonial->post_content) || empty(trim($testimonial->post_content))) {
            $needs_update = true;
        }
        
        // Check meta fields
        $client_name = get_post_meta($testimonial->ID, 'client_name', true);
        $testimonial_content = get_post_meta($testimonial->ID, 'testimonial_content', true);
        
        if (empty($client_name) || is_placeholder_content($testimonial_content)) {
            $needs_update = true;
        }
        
        if ($needs_update) {
            $sample_index = $index % count($sample_testimonials);
            $sample = $sample_testimonials[$sample_index];
            
            // Update post content
            wp_update_post(array(
                'ID' => $testimonial->ID,
                'post_content' => $sample['content'],
                'post_title' => $sample['client_name'] . ' - ' . $sample['client_company']
            ));
            
            // Update meta fields
            update_post_meta($testimonial->ID, 'client_name', $sample['client_name']);
            update_post_meta($testimonial->ID, 'client_position', $sample['client_position']);
            update_post_meta($testimonial->ID, 'client_company', $sample['client_company']);
            update_post_meta($testimonial->ID, 'testimonial_content', $sample['content']);
            update_post_meta($testimonial->ID, 'client_rating', $sample['rating']);
            
            $updated_count++;
        }
    }
    
    echo "Updated {$updated_count} testimonial(s)\n";
}

// Update Portfolio Items
function update_existing_portfolio() {
    $portfolio_items = get_posts(array(
        'post_type' => 'portfolio',
        'post_status' => 'publish',
        'numberposts' => -1
    ));
    
    $updated_count = 0;
    
    $sample_portfolio = array(
        array(
            'title' => 'FinTech Mobile App',
            'content' => 'Developed a comprehensive mobile banking application with advanced security features, real-time transactions, and intuitive user interface. The app serves over 100,000 active users.',
            'excerpt' => 'Mobile banking app with 100K+ active users',
            'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'E-commerce Marketplace',
            'content' => 'Built a scalable e-commerce marketplace connecting buyers and sellers. Features include multi-vendor support, advanced search, payment integration, and analytics dashboard.',
            'excerpt' => 'Scalable multi-vendor marketplace platform',
            'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Healthcare Management System',
            'content' => 'Designed and developed a comprehensive healthcare management system for hospitals. Includes patient records, appointment scheduling, billing, and reporting modules.',
            'excerpt' => 'Complete hospital management solution',
            'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800&h=600&fit=crop'
        )
    );
    
    foreach ($portfolio_items as $index => $item) {
        $needs_update = false;
        
        // Check if content needs updating
        if (is_placeholder_content($item->post_content) || empty(trim($item->post_content))) {
            $needs_update = true;
        }
        
        if ($needs_update) {
            $sample_index = $index % count($sample_portfolio);
            $sample = $sample_portfolio[$sample_index];
            
            // Update the post
            wp_update_post(array(
                'ID' => $item->ID,
                'post_content' => $sample['content'],
                'post_excerpt' => $sample['excerpt']
            ));
            
            // Set featured image if none exists
            set_unsplash_featured_image($item->ID, $sample['image'], sanitize_title($item->post_title));
            
            $updated_count++;
        }
    }
    
    echo "Updated {$updated_count} portfolio item(s)\n";
}

// Update Solutions
function update_existing_solutions() {
    $solutions = get_posts(array(
        'post_type' => 'itsulu_solution',
        'post_status' => 'publish',
        'numberposts' => -1
    ));
    
    $updated_count = 0;
    
    $sample_solutions = array(
        array(
            'title' => 'Enterprise Resource Planning (ERP)',
            'content' => 'Streamline your business operations with our comprehensive ERP solutions. Integrate all your business processes into a single, unified system for improved efficiency and decision-making.',
            'excerpt' => 'Unified business process management system',
            'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Customer Relationship Management (CRM)',
            'content' => 'Enhance customer relationships and boost sales with our advanced CRM solutions. Track leads, manage customer interactions, and analyze sales performance all in one platform.',
            'excerpt' => 'Advanced customer relationship management platform',
            'image' => 'https://images.unsplash.com/photo-1553484771-371a605b060b?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Business Intelligence Dashboard',
            'content' => 'Make data-driven decisions with our interactive business intelligence dashboards. Visualize key metrics, track performance, and identify trends in real-time.',
            'excerpt' => 'Real-time data visualization and analytics platform',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop'
        )
    );
    
    foreach ($solutions as $index => $solution) {
        $needs_update = false;
        
        // Check if content needs updating
        if (is_placeholder_content($solution->post_content) || empty(trim($solution->post_content))) {
            $needs_update = true;
        }
        
        if ($needs_update) {
            $sample_index = $index % count($sample_solutions);
            $sample = $sample_solutions[$sample_index];
            
            // Update the post
            wp_update_post(array(
                'ID' => $solution->ID,
                'post_content' => $sample['content'],
                'post_excerpt' => $sample['excerpt']
            ));
            
            // Set featured image if none exists
            set_unsplash_featured_image($solution->ID, $sample['image'], sanitize_title($solution->post_title));
            
            $updated_count++;
        }
    }
    
    echo "Updated {$updated_count} solution(s)\n";
}

// Update Team Members
function update_existing_team_members() {
    $team_members = get_posts(array(
        'post_type' => 'team_member',
        'post_status' => 'publish',
        'numberposts' => -1
    ));
    
    $updated_count = 0;
    
    $sample_members = array(
        array(
            'name' => 'John Anderson',
            'position' => 'Chief Executive Officer',
            'bio' => 'John brings over 15 years of experience in technology leadership and business strategy. He founded the company with a vision to deliver innovative solutions that drive business growth.',
            'excerpt' => 'Visionary leader with 15+ years in tech industry',
            'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face'
        ),
        array(
            'name' => 'Sarah Mitchell',
            'position' => 'Chief Technology Officer',
            'bio' => 'Sarah is a technology expert with deep expertise in cloud computing, AI, and software architecture. She leads our technical team in delivering cutting-edge solutions.',
            'excerpt' => 'Tech expert specializing in cloud and AI solutions',
            'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=400&h=400&fit=crop&crop=face'
        ),
        array(
            'name' => 'Michael Rodriguez',
            'position' => 'Head of Development',
            'bio' => 'Michael oversees all development projects and ensures quality delivery. With 12 years of experience, he specializes in full-stack development and agile methodologies.',
            'excerpt' => 'Full-stack development expert with agile expertise',
            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face'
        )
    );
    
    foreach ($team_members as $index => $member) {
        $needs_update = false;
        
        // Check if content needs updating
        if (is_placeholder_content($member->post_content) || empty(trim($member->post_content))) {
            $needs_update = true;
        }
        
        if ($needs_update) {
            $sample_index = $index % count($sample_members);
            $sample = $sample_members[$sample_index];
            
            // Update the post
            wp_update_post(array(
                'ID' => $member->ID,
                'post_content' => $sample['bio'],
                'post_excerpt' => $sample['excerpt']
            ));
            
            // Update position meta
            update_post_meta($member->ID, 'position', $sample['position']);
            
            // Set featured image if none exists
            set_unsplash_featured_image($member->ID, $sample['image'], sanitize_title($member->post_title));
            
            $updated_count++;
        }
    }
    
    echo "Updated {$updated_count} team member(s)\n";
}

// Update Awards
function update_existing_awards() {
    $awards = get_posts(array(
        'post_type' => 'award',
        'post_status' => 'publish',
        'numberposts' => -1
    ));
    
    $updated_count = 0;
    
    $sample_awards = array(
        array(
            'title' => 'Best IT Company 2023',
            'content' => 'Recognized as the Best IT Company of 2023 by Tech Excellence Awards for outstanding innovation and client satisfaction.',
            'image' => 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Innovation Award 2023',
            'content' => 'Received the Innovation Award for developing cutting-edge AI solutions that transformed business operations for our clients.',
            'image' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Customer Choice Award',
            'content' => 'Voted as Customer Choice Award winner based on exceptional service quality and client satisfaction ratings.',
            'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
        )
    );
    
    foreach ($awards as $index => $award) {
        $needs_update = false;
        
        // Check if content needs updating
        if (is_placeholder_content($award->post_content) || empty(trim($award->post_content))) {
            $needs_update = true;
        }
        
        if ($needs_update) {
            $sample_index = $index % count($sample_awards);
            $sample = $sample_awards[$sample_index];
            
            // Update the post
            wp_update_post(array(
                'ID' => $award->ID,
                'post_content' => $sample['content']
            ));
            
            // Set featured image if none exists
            set_unsplash_featured_image($award->ID, $sample['image'], sanitize_title($award->post_title));
            
            $updated_count++;
        }
    }
    
    echo "Updated {$updated_count} award(s)\n";
}

// Main execution function
function update_all_existing_cpts() {
    echo "Starting to update existing Custom Post Types with better content...\n\n";
    
    update_existing_services();
    update_existing_testimonials();
    update_existing_portfolio();
    update_existing_solutions();
    update_existing_team_members();
    update_existing_awards();
    
    echo "\nAll existing Custom Post Types have been updated successfully!\n";
    echo "Placeholder content has been replaced with realistic, professional content.\n";
}

// Run the update script
if (isset($_GET['update']) && $_GET['update'] === 'true') {
    update_all_existing_cpts();
} else {
    echo "To update existing Custom Post Types, add ?update=true to the URL\n";
    echo "Example: http://yoursite.com/wp-content/themes/your-theme/update-existing-cpts.php?update=true\n";
    echo "\nThis script will:\n";
    echo "- Find posts with lorem ipsum or placeholder content\n";
    echo "- Replace with professional, realistic content\n";
    echo "- Add featured images from Unsplash (if none exist)\n";
    echo "- Update meta fields with proper data\n";
}

?>