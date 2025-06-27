<?php
/**
 * Populate Custom Post Types with Sample Data
 * 
 * This script populates all custom post types with realistic content and Unsplash images
 * Run this file once to populate your site with sample data
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

// Function to download and set featured image from Unsplash
function set_unsplash_featured_image($post_id, $unsplash_url, $image_name) {
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

// Services Data
function populate_services() {
    $services = array(
        array(
            'title' => 'Web Development',
            'content' => 'We create modern, responsive websites that drive business growth. Our expert developers use the latest technologies to build fast, secure, and scalable web solutions tailored to your specific needs.',
            'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Mobile App Development',
            'content' => 'Transform your ideas into powerful mobile applications. We develop native and cross-platform apps for iOS and Android that provide exceptional user experiences and drive engagement.',
            'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Cloud Solutions',
            'content' => 'Migrate to the cloud with confidence. Our cloud experts help you leverage AWS, Azure, and Google Cloud to improve scalability, reduce costs, and enhance security for your business operations.',
            'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Digital Marketing',
            'content' => 'Boost your online presence with our comprehensive digital marketing strategies. From SEO and PPC to social media marketing, we help you reach your target audience and grow your business.',
            'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Cybersecurity',
            'content' => 'Protect your business from cyber threats with our advanced security solutions. We provide comprehensive security assessments, implementation, and ongoing monitoring to keep your data safe.',
            'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Data Analytics',
            'content' => 'Turn your data into actionable insights. Our analytics experts help you collect, analyze, and visualize data to make informed business decisions and drive growth.',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop'
        )
    );
    
    foreach ($services as $service) {
        $post_id = wp_insert_post(array(
            'post_type' => 'itsulu_service',
            'post_title' => $service['title'],
            'post_content' => $service['content'],
            'post_status' => 'publish'
        ));
        
        if ($post_id && !is_wp_error($post_id)) {
            set_unsplash_featured_image($post_id, $service['image'], sanitize_title($service['title']));
        }
    }
    
    echo "Services populated successfully!\n";
}

// Why Choose Us Data
function populate_why_choose_us() {
    $reasons = array(
        array(
            'title' => 'Expert Team',
            'content' => 'Our team consists of highly skilled professionals with years of experience in cutting-edge technologies.',
            'icon' => 'fa-users'
        ),
        array(
            'title' => '24/7 Support',
            'content' => 'We provide round-the-clock support to ensure your business operations run smoothly without interruption.',
            'icon' => 'fa-headset'
        ),
        array(
            'title' => 'Proven Track Record',
            'content' => 'With over 500 successful projects delivered, we have a proven track record of excellence and client satisfaction.',
            'icon' => 'fa-trophy'
        ),
        array(
            'title' => 'Cost-Effective Solutions',
            'content' => 'We deliver high-quality solutions that provide excellent value for money and strong return on investment.',
            'icon' => 'fa-wallet'
        ),
        array(
            'title' => 'Agile Methodology',
            'content' => 'Our agile development approach ensures faster delivery, better quality, and greater flexibility throughout the project.',
            'icon' => 'fa-sync'
        ),
        array(
            'title' => 'Security First',
            'content' => 'We prioritize security in everything we do, implementing best practices to protect your data and systems.',
            'icon' => 'fa-user-shield'
        )
    );
    
    foreach ($reasons as $index => $reason) {
        $post_id = wp_insert_post(array(
            'post_type' => 'why_choose_us',
            'post_title' => $reason['title'],
            'post_content' => $reason['content'],
            'post_status' => 'publish',
            'menu_order' => $index + 1
        ));
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, 'reason_icon', $reason['icon']);
        }
    }
    
    echo "Why Choose Us items populated successfully!\n";
}

// Testimonials Data
function populate_testimonials() {
    $testimonials = array(
        array(
            'client_name' => 'Sarah Johnson',
            'client_position' => 'CEO',
            'client_company' => 'TechStart Inc.',
            'content' => 'Working with this team was an absolute pleasure. They delivered our project on time and exceeded our expectations in every way.',
            'rating' => 5,
            'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=400&h=400&fit=crop&crop=face'
        ),
        array(
            'client_name' => 'Michael Chen',
            'client_position' => 'CTO',
            'client_company' => 'InnovateLab',
            'content' => 'The technical expertise and professionalism of this team is outstanding. Our new platform has transformed our business operations.',
            'rating' => 5,
            'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face'
        ),
        array(
            'client_name' => 'Emily Rodriguez',
            'client_position' => 'Marketing Director',
            'client_company' => 'GrowthCorp',
            'content' => 'Their digital marketing strategies helped us increase our online presence by 300%. Highly recommended!',
            'rating' => 5,
            'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop&crop=face'
        ),
        array(
            'client_name' => 'David Thompson',
            'client_position' => 'Founder',
            'client_company' => 'StartupVenture',
            'content' => 'From concept to launch, they guided us through every step. Our mobile app now has over 100K downloads!',
            'rating' => 5,
            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face'
        ),
        array(
            'client_name' => 'Lisa Wang',
            'client_position' => 'Operations Manager',
            'client_company' => 'EfficiencyPro',
            'content' => 'The cloud migration they handled for us reduced our operational costs by 40% while improving performance.',
            'rating' => 5,
            'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&h=400&fit=crop&crop=face'
        ),
        array(
            'client_name' => 'Robert Kim',
            'client_position' => 'IT Director',
            'client_company' => 'SecureData Ltd',
            'content' => 'Their cybersecurity solutions gave us peace of mind. We have not had a single security incident since implementation.',
            'rating' => 5,
            'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&h=400&fit=crop&crop=face'
        )
    );
    
    foreach ($testimonials as $testimonial) {
        $post_id = wp_insert_post(array(
            'post_type' => 'testimonial',
            'post_title' => $testimonial['client_name'] . ' - ' . $testimonial['client_company'],
            'post_content' => $testimonial['content'],
            'post_status' => 'publish'
        ));
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, 'client_name', $testimonial['client_name']);
            update_post_meta($post_id, 'client_position', $testimonial['client_position']);
            update_post_meta($post_id, 'client_company', $testimonial['client_company']);
            update_post_meta($post_id, 'testimonial_content', $testimonial['content']);
            update_post_meta($post_id, 'client_rating', $testimonial['rating']);
            
            set_unsplash_featured_image($post_id, $testimonial['image'], sanitize_title($testimonial['client_name']));
        }
    }
    
    echo "Testimonials populated successfully!\n";
}

// Awards Data
function populate_awards() {
    $awards = array(
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
        ),
        array(
            'title' => 'Top Employer 2023',
            'content' => 'Certified as a Top Employer for creating an excellent workplace culture and providing outstanding career development opportunities.',
            'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop'
        )
    );
    
    foreach ($awards as $award) {
        $post_id = wp_insert_post(array(
            'post_type' => 'award',
            'post_title' => $award['title'],
            'post_content' => $award['content'],
            'post_status' => 'publish'
        ));
        
        if ($post_id && !is_wp_error($post_id)) {
            set_unsplash_featured_image($post_id, $award['image'], sanitize_title($award['title']));
        }
    }
    
    echo "Awards populated successfully!\n";
}

// Team Members Data
function populate_team_members() {
    $team_members = array(
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
        ),
        array(
            'name' => 'Emily Chen',
            'position' => 'UX/UI Design Lead',
            'bio' => 'Emily creates beautiful and intuitive user experiences. Her design philosophy focuses on user-centered design that combines aesthetics with functionality.',
            'excerpt' => 'User-centered design expert creating intuitive experiences',
            'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop&crop=face'
        ),
        array(
            'name' => 'David Kim',
            'position' => 'Cybersecurity Specialist',
            'bio' => 'David ensures our clients\' data and systems are secure. He holds multiple security certifications and specializes in threat assessment and prevention.',
            'excerpt' => 'Certified security expert protecting client data',
            'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&h=400&fit=crop&crop=face'
        ),
        array(
            'name' => 'Lisa Thompson',
            'position' => 'Project Manager',
            'bio' => 'Lisa coordinates all project activities and ensures timely delivery. Her excellent communication skills and attention to detail keep projects on track.',
            'excerpt' => 'Experienced PM ensuring timely project delivery',
            'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&h=400&fit=crop&crop=face'
        )
    );
    
    foreach ($team_members as $member) {
        $post_id = wp_insert_post(array(
            'post_type' => 'team_member',
            'post_title' => $member['name'],
            'post_content' => $member['bio'],
            'post_excerpt' => $member['excerpt'],
            'post_status' => 'publish'
        ));
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, 'position', $member['position']);
            set_unsplash_featured_image($post_id, $member['image'], sanitize_title($member['name']));
        }
    }
    
    echo "Team members populated successfully!\n";
}

// Solutions Data
function populate_solutions() {
    $solutions = array(
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
            'title' => 'E-commerce Platform',
            'content' => 'Launch your online store with our robust e-commerce solutions. Features include inventory management, payment processing, order tracking, and analytics.',
            'excerpt' => 'Complete online store solution with advanced features',
            'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Business Intelligence Dashboard',
            'content' => 'Make data-driven decisions with our interactive business intelligence dashboards. Visualize key metrics, track performance, and identify trends in real-time.',
            'excerpt' => 'Real-time data visualization and analytics platform',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Cloud Migration Services',
            'content' => 'Migrate your infrastructure to the cloud safely and efficiently. Our experts handle the entire migration process, ensuring minimal downtime and maximum security.',
            'excerpt' => 'Safe and efficient cloud infrastructure migration',
            'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Mobile Workforce Management',
            'content' => 'Empower your mobile workforce with our comprehensive management solutions. Track productivity, manage schedules, and facilitate communication across your team.',
            'excerpt' => 'Complete mobile team management solution',
            'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&h=600&fit=crop'
        )
    );
    
    foreach ($solutions as $solution) {
        $post_id = wp_insert_post(array(
            'post_type' => 'itsulu_solution',
            'post_title' => $solution['title'],
            'post_content' => $solution['content'],
            'post_excerpt' => $solution['excerpt'],
            'post_status' => 'publish'
        ));
        
        if ($post_id && !is_wp_error($post_id)) {
            set_unsplash_featured_image($post_id, $solution['image'], sanitize_title($solution['title']));
        }
    }
    
    echo "Solutions populated successfully!\n";
}

// Portfolio Data
function populate_portfolio() {
    $portfolio_items = array(
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
        ),
        array(
            'title' => 'Real Estate Platform',
            'content' => 'Created a modern real estate platform with property listings, virtual tours, mortgage calculators, and agent management. Increased client leads by 250%.',
            'excerpt' => 'Modern real estate platform with virtual tours',
            'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Educational Learning Platform',
            'content' => 'Developed an online learning platform with video streaming, interactive quizzes, progress tracking, and certification management. Supports over 50,000 students.',
            'excerpt' => 'Online learning platform for 50K+ students',
            'image' => 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=800&h=600&fit=crop'
        ),
        array(
            'title' => 'Supply Chain Management',
            'content' => 'Built an enterprise supply chain management system with inventory tracking, supplier management, and logistics optimization. Reduced operational costs by 30%.',
            'excerpt' => 'Enterprise supply chain optimization system',
            'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&h=600&fit=crop'
        )
    );
    
    foreach ($portfolio_items as $item) {
        $post_id = wp_insert_post(array(
            'post_type' => 'portfolio',
            'post_title' => $item['title'],
            'post_content' => $item['content'],
            'post_excerpt' => $item['excerpt'],
            'post_status' => 'publish'
        ));
        
        if ($post_id && !is_wp_error($post_id)) {
            set_unsplash_featured_image($post_id, $item['image'], sanitize_title($item['title']));
        }
    }
    
    echo "Portfolio items populated successfully!\n";
}

// Approach Items Data
function populate_approach_items() {
    $approach_items = array(
        array(
            'title' => 'Discovery & Planning',
            'content' => 'We start by understanding your business needs, goals, and challenges. Our team conducts thorough research and creates a detailed project plan.',
            'icon' => 'fa-lightbulb',
            'order' => 1
        ),
        array(
            'title' => 'Design & Prototyping',
            'content' => 'Our designers create intuitive user experiences and develop interactive prototypes to visualize the final solution before development begins.',
            'icon' => 'fa-code',
            'order' => 2
        ),
        array(
            'title' => 'Development & Testing',
            'content' => 'Our experienced developers build your solution using best practices and conduct rigorous testing to ensure quality and performance.',
            'icon' => 'fa-cogs',
            'order' => 3
        ),
        array(
            'title' => 'Deployment & Launch',
            'content' => 'We handle the deployment process and ensure a smooth launch. Our team provides training and documentation for your team.',
            'icon' => 'fa-rocket',
            'order' => 4
        ),
        array(
            'title' => 'Support & Maintenance',
            'content' => 'Post-launch, we provide ongoing support, maintenance, and updates to ensure your solution continues to perform optimally.',
            'icon' => 'fa-tools',
            'order' => 5
        )
    );
    
    foreach ($approach_items as $item) {
        $post_id = wp_insert_post(array(
            'post_type' => 'approach_item',
            'post_title' => $item['title'],
            'post_content' => $item['content'],
            'post_status' => 'publish',
            'menu_order' => $item['order']
        ));
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, 'approach_icon', $item['icon']);
        }
    }
    
    echo "Approach items populated successfully!\n";
}

// Main execution function
function populate_all_cpts() {
    echo "Starting to populate Custom Post Types...\n\n";
    
    populate_services();
    populate_why_choose_us();
    populate_testimonials();
    populate_awards();
    populate_team_members();
    populate_solutions();
    populate_portfolio();
    populate_approach_items();
    
    echo "\nAll Custom Post Types have been populated successfully!\n";
    echo "You can now view your content in the WordPress admin dashboard.\n";
}

// Run the population script
if (isset($_GET['populate']) && $_GET['populate'] === 'true') {
    populate_all_cpts();
} else {
    echo "To populate all Custom Post Types, add ?populate=true to the URL\n";
    echo "Example: http://yoursite.com/wp-content/themes/your-theme/populate-cpts.php?populate=true\n";
}

?>