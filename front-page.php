<?php
/**
 * The template for displaying the front page
 */

get_header();
?>

<?php
// Enqueue our custom scroll effects script and styles
wp_enqueue_script('scroll-effects', get_template_directory_uri() . '/assets/js/scroll-effects.js', array('jquery'), '1.0.0', true);
wp_enqueue_script('logo-position-fix', get_template_directory_uri() . '/assets/js/logo-position-fix.js', array('jquery'), '1.0.0', true);
wp_enqueue_style('scroll-effects', get_template_directory_uri() . '/assets/css/scroll-effects.css', array(), '1.0.0');
wp_enqueue_style('services-styles', get_template_directory_uri() . '/assets/css/services.css', array(), '1.0.0');
wp_enqueue_style('layout-fixes', get_template_directory_uri() . '/assets/css/layout-fixes.css', array(), '1.0.0');
wp_enqueue_style('header-fixes', get_template_directory_uri() . '/assets/css/header-fixes.css', array(), '1.0.0');
?>

<main id="primary" class="site-main">
    <!-- Hero Section with Slideshow - New Implementation -->
    <section id="hero-section" class="hero-section-container gradient-bg">
        <div class="geometric-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <!-- New hero slider implementation -->
        <?php
        // Get autoplay settings from customizer
        $autoplay = get_theme_mod('hero_slider_autoplay', true);
        $interval = get_theme_mod('hero_slider_interval', 5000);
        ?>
        <div class="hero-slider" id="heroSlider" data-autoplay-interval="<?php echo esc_attr($interval); ?>" <?php echo !$autoplay ? 'data-autoplay="false"' : ''; ?>>
            <!-- Slide 1 with Dynamic Content from Customizer -->
            <?php
            // Get slide 1 content from customizer
            $slide1_img_id = get_theme_mod('hero_slide_1_image');
            $slide1_title = get_theme_mod('hero_slide_1_title', 'Advanced IT Solutions for Modern Business');
            $slide1_desc = get_theme_mod('hero_slide_1_description', 'Experience enterprise-grade technology services tailored to your business needs, powered by our expert team.');
            $slide1_btn_text = get_theme_mod('hero_slide_1_button_text', 'Get Started');
            
            // Get section link from dropdown or custom URL
            $slide1_section = get_theme_mod('hero_slide_1_button_section', '#consultation');
            if ($slide1_section === 'custom') {
                $slide1_btn_link = get_theme_mod('hero_slide_1_button_custom_url', '');
            } else {
                $slide1_btn_link = home_url('/') . $slide1_section;
            }
            
            // Process the background image
            if ($slide1_img_id) {
                $slide1_bg_url = wp_get_attachment_image_url($slide1_img_id, 'full');
            } else {
                // Fallback to placeholder if no image is set
                $slide1_bg_url = 'https://picsum.photos/id/1/1600/900';
            }
            
            $slide1_style = "background-image: url('" . esc_url($slide1_bg_url) . "'); background-color: #001233;"; // Dark blue fallback
            ?>
            <div class="hero-slide-bb" id="slide1-bb" style="<?php echo $slide1_style; ?>">
                <div class="hero-content-container slide-in-left" style="background: rgba(0,18,51,0.75); -webkit-backdrop-filter: blur(8px); backdrop-filter: blur(8px); padding: 35px; border-radius: 12px; max-width: 550px; width: 90%; margin-left: 8%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border-left: 4px solid #680bea;">
                    <h1 style="color: white; font-size: 2.5em; margin-bottom: 0.5em;"><?php echo esc_html($slide1_title); ?></h1>
                    <p style="color: white; font-size: 1.2em; margin-bottom: 1.5em;"><?php echo esc_html($slide1_desc); ?></p>
                    <a href="<?php echo esc_url($slide1_btn_link); ?>" class="hero-button" title="<?php echo esc_attr($slide1_btn_text); ?>" style="background-color: #ff595e; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;"><?php echo esc_html($slide1_btn_text); ?></a>
                </div>
            </div>
            
            <!-- Slide 2 with Dynamic Content from Customizer -->
            <?php
            // Get slide 2 content from customizer
            $slide2_img_id = get_theme_mod('hero_slide_2_image');
            $slide2_title = get_theme_mod('hero_slide_2_title', 'Cybersecurity That Never Sleeps');
            $slide2_desc = get_theme_mod('hero_slide_2_description', 'Protect your business with our comprehensive security solutions, featuring 24/7 monitoring and rapid incident response.');
            $slide2_btn_text = get_theme_mod('hero_slide_2_button_text', 'Learn More');
            
            // Get section link from dropdown or custom URL
            $slide2_section = get_theme_mod('hero_slide_2_button_section', '#services');
            if ($slide2_section === 'custom') {
                $slide2_btn_link = get_theme_mod('hero_slide_2_button_custom_url', '');
            } else {
                $slide2_btn_link = home_url('/') . $slide2_section;
            }
            
            // Process the background image
            if ($slide2_img_id) {
                $slide2_bg_url = wp_get_attachment_image_url($slide2_img_id, 'full');
            } else {
                // Fallback to placeholder if no image is set
                $slide2_bg_url = 'https://picsum.photos/id/2/1600/900';
            }
            
            $slide2_style = "background-image: url('" . esc_url($slide2_bg_url) . "'); background-color: #023e8a;"; // Different blue fallback
            ?>
            <div class="hero-slide-bb" id="slide2-bb" style="<?php echo $slide2_style; ?>">
                <div class="hero-content-container slide-in-left" style="background: rgba(0,18,51,0.75); -webkit-backdrop-filter: blur(8px); backdrop-filter: blur(8px); padding: 35px; border-radius: 12px; max-width: 550px; width: 90%; margin-left: 8%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border-left: 4px solid #680bea;">
                    <h1 style="color: white; font-size: 2.5em; margin-bottom: 0.5em;"><?php echo esc_html($slide2_title); ?></h1>
                    <p style="color: white; font-size: 1.2em; margin-bottom: 1.5em;"><?php echo esc_html($slide2_desc); ?></p>
                    <a href="<?php echo esc_url($slide2_btn_link); ?>" class="hero-button" title="<?php echo esc_attr($slide2_btn_text); ?>" style="background-color: #ff595e; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;"><?php echo esc_html($slide2_btn_text); ?></a>
                </div>
            </div>
            
            <!-- Slide 3 with Dynamic Content from Customizer -->
            <?php
            // Get slide 3 content from customizer
            $slide3_img_id = get_theme_mod('hero_slide_3_image');
            $slide3_title = get_theme_mod('hero_slide_3_title', 'Cloud Solutions for Every Scale');
            $slide3_desc = get_theme_mod('hero_slide_3_description', 'From startups to enterprises, our flexible cloud infrastructure adapts to your growth with seamless scalability.');
            $slide3_btn_text = get_theme_mod('hero_slide_3_button_text', 'Explore Options');
            
            // Get section link from dropdown or custom URL
            $slide3_section = get_theme_mod('hero_slide_3_button_section', '#solutions');
            if ($slide3_section === 'custom') {
                $slide3_btn_link = get_theme_mod('hero_slide_3_button_custom_url', '');
            } else {
                $slide3_btn_link = home_url('/') . $slide3_section;
            }
            
            // Process the background image
            if ($slide3_img_id) {
                $slide3_bg_url = wp_get_attachment_image_url($slide3_img_id, 'full');
            } else {
                // Fallback to placeholder if no image is set
                $slide3_bg_url = 'https://picsum.photos/id/3/1600/900';
            }
            
            $slide3_style = "background-image: url('" . esc_url($slide3_bg_url) . "'); background-color: #0077b6;"; // Another blue variant
            ?>
            <div class="hero-slide-bb" id="slide3-bb" style="<?php echo $slide3_style; ?>">
                <div class="hero-content-container slide-in-left" style="background: rgba(0,18,51,0.75); -webkit-backdrop-filter: blur(8px); backdrop-filter: blur(8px); padding: 35px; border-radius: 12px; max-width: 550px; width: 90%; margin-left: 8%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border-left: 4px solid #680bea;">
                    <h1 style="color: white; font-size: 2.5em; margin-bottom: 0.5em;"><?php echo esc_html($slide3_title); ?></h1>
                    <p style="color: white; font-size: 1.2em; margin-bottom: 1.5em;"><?php echo esc_html($slide3_desc); ?></p>
                    <a href="<?php echo esc_url($slide3_btn_link); ?>" class="hero-button" title="<?php echo esc_attr($slide3_btn_text); ?>" style="background-color: #ff595e; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;"><?php echo esc_html($slide3_btn_text); ?></a>
                </div>
            </div>
        </div>
        <div class="quick-actions-panel stagger-in">
            <div class="quick-action-card floating" onclick="location.href='<?php echo esc_url( home_url( '/get-your-solution' ) ); ?>';">
                <div class="quick-action-title">
                    <i class="fas fa-rocket"></i>
                    <span class="title-text">Get Started</span>
                </div>
                <p class="quick-action-description">
                    Schedule a free consultation to discuss your IT needs and solutions.
                </p>
            </div>
            <div class="quick-action-card floating" style="animation-delay: 0.2s" onclick="location.href='<?php echo esc_url( home_url( '/our-solutions' ) ); ?>';">
                <div class="quick-action-title">
                    <i class="fas fa-lightbulb"></i>
                    <span class="title-text">Quick Solutions</span>
                </div>
                <p class="quick-action-description">
                    Explore our pre-built solutions designed for common business challenges.
                </p>
            </div>
            <div class="quick-action-card floating" style="animation-delay: 0.4s" onclick="location.href='<?php echo esc_url( home_url( '/contact' ) ); ?>';">
                <div class="quick-action-title">
                    <i class="fas fa-headset"></i>
                    <span class="title-text">24/7 Support</span>
                </div>
                <p class="quick-action-description">
                    Get immediate assistance from our expert support team.
                </p>
            </div>
            <div class="quick-stats scale-in-scroll">
                <div class="stat-item">
                    <div class="stat-number">200+</div>
                    <div class="stat-label">CLIENTS</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">SUCCESS RATE</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">SUPPORT</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Value Proposition Section -->
    <section id="approach" class="value-proposition py-5 bg-light parallax-bg" data-speed="0.3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5 fade-in-scroll">
                    <h2 class="section-title mb-3"><?php echo get_theme_mod('approach_section_title', 'Our Approach'); ?></h2>
                    <p class="lead"><?php echo get_theme_mod('approach_section_subtitle', 'We combine local market knowledge with global IT expertise to deliver solutions that address the unique challenges Kenyan businesses face.'); ?></p>
                </div>
            </div>
            <div class="row g-4 stagger-in">
                <?php
                // Check if we have custom approach items in the database
                $approach_items = new WP_Query(array(
                    'post_type' => 'approach_item',
                    'posts_per_page' => 3,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                if ($approach_items->have_posts()) :
                    $delay = 0;
                    // Display dynamic approach items
                    while ($approach_items->have_posts()) : $approach_items->the_post();
                        $icon = get_post_meta(get_the_ID(), 'approach_icon', true) ?: 'fa-handshake';
                        ?>
                        <div class="col-md-4" style="animation-delay: <?php echo $delay; ?>s;">
                            <div class="value-card h-100 p-4 bg-white rounded shadow-sm text-center scale-in-scroll floating">
                                <div class="value-icon mb-3">
                        <?php $delay += 0.2; ?>
                                    <i class="fas <?php echo esc_attr($icon); ?> fa-2x text-primary"></i>
                                </div>
                                <h3 class="h4 mb-3"><?php the_title(); ?></h3>
                                <p><?php the_content(); ?></p>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Static fallback content
                    $fallback_items = array(
                        array(
                            'icon' => 'fa-handshake',
                            'title' => 'Collaborative Process',
                            'content' => 'We work closely with your team to understand your business needs and develop solutions that align with your goals.'
                        ),
                        array(
                            'icon' => 'fa-cogs',
                            'title' => 'End-to-End Solutions',
                            'content' => 'From consultation to implementation and ongoing support, we provide comprehensive IT services tailored to your specific needs.'
                        ),
                        array(
                            'icon' => 'fa-chart-line',
                            'title' => 'Results-Driven Approach',
                            'content' => 'Our solutions are designed to deliver measurable business outcomes, helping you increase efficiency, reduce costs, and grow your business.'
                        )
                    );
                    
                    $delay = 0;
                    foreach ($fallback_items as $item) :
                        ?>
                        <div class="col-md-4" style="animation-delay: <?php echo $delay; ?>s;">
                            <div class="value-card h-100 p-4 bg-white rounded shadow-sm text-center scale-in-scroll floating">
                                <div class="value-icon mb-3">
                                    <i class="fas <?php echo esc_attr($item['icon']); ?> fa-2x text-primary"></i>
                                </div>
                                <h3 class="h4 mb-3"><?php echo esc_html($item['title']); ?></h3>
                                <p><?php echo esc_html($item['content']); ?></p>
                            </div>
                        </div>
                        <?php
                        $delay += 0.2;
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-12 bg-gradient-light parallax-bg" data-speed="0.1">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 fade-in-scroll">
                <h2 class="section-title">Our Services</h2>
                <p class="section-description">
                    We offer a comprehensive range of IT solutions to transform your business and drive digital innovation.
                </p>
            </div>
            <div class="row g-4 stagger-in">
                <?php
                $services = new WP_Query([
                    'post_type' => 'itsulu_service',
                    'posts_per_page' => 6,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ]);

                if ($services->have_posts()) :
                    $index = 0;
                    $delay = 0;
                    while ($services->have_posts()) : $services->the_post();
                        $modal_id = 'serviceModal' . $index;
                        $icon = get_field('service_icon') ?: 'fa-laptop-code';
                        $short_desc = get_field('service_short_description') ?: get_the_excerpt();
                        $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_template_directory_uri() . '/assets/images/placeholder.jpg';
                ?>
                    <div class="col-md-4" style="animation-delay: <?php echo $delay; ?>s;">
                        <a href="#<?php echo $modal_id; ?>" data-bs-toggle="modal" class="d-block text-decoration-none group">
                            <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100 scale-in-scroll">
                                <div class="card-img-container overflow-hidden">
                                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid object-fit-cover" style="height: 200px; width: 100%; transition: transform 0.5s ease;">
                                </div>
                                <div class="p-4 text-center">
                                    <div class="service-icon mb-3">
                                        <i class="fas <?php echo esc_attr($icon); ?>"></i>
                                    </div>
                                    <h3 class="service-title mb-3"><?php the_title(); ?></h3>
                                    <p class="service-desc"><?php echo wp_trim_words($short_desc, 20, '...'); ?></p>
                                </div>
                        <?php $delay += 0.15; ?>
                            </div>
                        </a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" aria-labelledby="<?php echo $modal_id; ?>Label" aria-hidden="true" inert>
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="<?php echo $modal_id; ?>Label"><?php the_title(); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row">
                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <img src="<?php echo esc_url($featured_image); ?>" 
                                                 class="img-fluid rounded w-100" 
                                                 alt="<?php the_title_attribute(); ?>"
                                                 style="max-height: 200px; object-fit: cover;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="text-[#3e2b23]">
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary me-2">View Full Service</a>
                                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $index++;
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div class="text-center mt-8">
                <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-primary rounded-pill">View All Services</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials-section py-5 mb-4">
        <div class="container">
            <?php
            // Get customizer settings
            $section_title = get_theme_mod('testimonials_section_title', 'What Our Clients Say');
            $section_subtitle = get_theme_mod('testimonials_section_subtitle', 'Don\'t just take our word for it. See what our clients throughout Kenya have to say about our IT solutions and service.');
            $section_bg = get_theme_mod('testimonials_section_bg', '');
            $bg_style = $section_bg ? 'style="background-image: url(' . esc_url($section_bg) . '); background-size: cover; background-position: center;"' : '';
            ?>

            <div class="row mb-4 justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
                    <div class="section-subtitle"><?php echo esc_html($section_subtitle); ?></div>
                </div>
            </div>

            <?php
            // Get testimonials
            $testimonials = new WP_Query([
                'post_type' => 'testimonial',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC',
            ]);

            if ($testimonials->have_posts()) : ?>
                <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-inner">
                        <?php 
                        $count = 0;
                        $modal_counter = 0; 
                        while ($testimonials->have_posts()) : $testimonials->the_post();
                            $client_name = get_post_meta(get_the_ID(), 'client_name', true) ?: get_the_title();
                            $client_position = get_post_meta(get_the_ID(), 'client_position', true) ?: '';
                            $client_company = get_post_meta(get_the_ID(), 'client_company', true) ?: '';
                            $testimonial_content = get_post_meta(get_the_ID(), 'testimonial_content', true) ?: get_the_content();
                            $full_testimonial = get_the_content();
                            $client_rating = intval(get_post_meta(get_the_ID(), 'client_rating', true)) ?: 5;
                            $client_rating = max(1, min(5, $client_rating)); // Ensure rating is between 1-5
                            $modal_id = 'testimonialModal' . $modal_counter;
                            $modal_counter++;
                        ?>
                        <div class="carousel-item <?php echo ($count === 0) ? 'active' : ''; ?>">
                            <div class="card border-0 shadow p-4 testimonial-card">
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        <div class="text-center mb-4">
                                            <div class="testimonial-rating mb-3">
                                                <?php for($i = 0; $i < 5; $i++) : ?>
                                                    <i class="fas fa-star <?php echo ($i < $client_rating) ? 'text-warning' : 'text-muted'; ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <blockquote>
                                                <p class="lead mb-4">"<?php echo wp_trim_words($testimonial_content, 30, '...'); ?>"</p>
                                            </blockquote>
                                            <div class="d-flex align-items-center justify-content-center testimonial-author">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('thumbnail', array('class' => 'rounded-circle me-3', 'style' => 'width: 60px; height: 60px; object-fit: cover;')); ?>
                                                <?php else : ?>
                                                    <div class="placeholder-avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                        <?php echo esc_html(substr($client_name, 0, 1)); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="text-start">
                                                    <h5 class="mb-1"><?php echo esc_html($client_name); ?></h5>
                                                    <?php if ($client_position && $client_company) : ?>
                                                        <p class="mb-0 text-muted"><?php echo esc_html($client_position); ?>, <?php echo esc_html($client_company); ?></p>
                                                    <?php elseif ($client_company) : ?>
                                                        <p class="mb-0 text-muted"><?php echo esc_html($client_company); ?></p>
                                                    <?php elseif ($client_position) : ?>
                                                        <p class="mb-0 text-muted"><?php echo esc_html($client_position); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#<?php echo $modal_id; ?>">
                                                    Read Full Testimonial
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial Modal -->
                        <div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" aria-labelledby="<?php echo $modal_id; ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="<?php echo $modal_id; ?>Label">Testimonial from <?php echo esc_html($client_name); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="testimonial-rating mb-3 text-center">
                                            <?php for($i = 0; $i < 5; $i++) : ?>
                                                <i class="fas fa-star <?php echo ($i < $client_rating) ? 'text-warning' : 'text-muted'; ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        
                                        <div class="d-flex mb-4">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('thumbnail', array('class' => 'rounded-circle me-3', 'style' => 'width: 60px; height: 60px; object-fit: cover;')); ?>
                                            <?php else: ?>
                                                <div class="placeholder-avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                    <?php echo esc_html(substr($client_name, 0, 1)); ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div>
                                                <h5 class="mb-1"><?php echo esc_html($client_name); ?></h5>
                                                <?php if ($client_position && $client_company) : ?>
                                                    <p class="mb-0 text-muted"><?php echo esc_html($client_position); ?>, <?php echo esc_html($client_company); ?></p>
                                                <?php elseif ($client_company) : ?>
                                                    <p class="mb-0 text-muted"><?php echo esc_html($client_company); ?></p>
                                                <?php elseif ($client_position) : ?>
                                                    <p class="mb-0 text-muted"><?php echo esc_html($client_position); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <blockquote class="blockquote">
                                            <div class="testimonial-content">
                                                <?php echo wpautop($full_testimonial); ?>
                                            </div>
                                        </blockquote>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">View Full Testimonial Page</a>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $count++;
                        endwhile; 
                        wp_reset_postdata(); 
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="text-center mt-4">
                    <a href="<?php echo esc_url(get_post_type_archive_link('testimonial')); ?>" class="btn btn-primary rounded-pill">View All Testimonials</a>
                </div>
                
                <style>
                    #testimonialsCarousel .carousel-control-prev,
                    #testimonialsCarousel .carousel-control-next {
                        width: 40px;
                        height: 40px;
                        top: 50%;
                        transform: translateY(-50%);
                        background-color: rgba(44, 29, 109, 0.5);
                        border-radius: 50%;
                        opacity: 0.7;
                    }
                    
                    #testimonialsCarousel .carousel-control-prev {
                        left: 10px;
                    }
                    
                    #testimonialsCarousel .carousel-control-next {
                        right: 10px;
                    }
                    
                    #testimonialsCarousel .carousel-control-prev:hover,
                    #testimonialsCarousel .carousel-control-next:hover {
                        opacity: 1;
                        background-color: rgba(44, 29, 109, 0.8);
                    }
                    
                    .testimonial-card {
                        transition: all 0.3s ease;
                        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
                    }
                    
                    .testimonial-card:hover {
                        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                    }
                    
                    .carousel-item {
                        transition: transform 0.8s ease-in-out, opacity 0.6s ease-in-out;
                        padding: 10px 40px;
                    }
                    
                    /* Smooth fade effect for carousel */
                    .carousel-item {
                        opacity: 0.4;
                    }
                    
                    .carousel-item.active {
                        opacity: 1;
                    }
                    
                    #testimonialsCarousel {
                        padding-bottom: 30px;
                    }
                </style>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Initialize the testimonials carousel with custom settings
                    var testimonialsCarousel = new bootstrap.Carousel(document.getElementById('testimonialsCarousel'), {
                        interval: 5000,
                        wrap: true,
                        touch: true
                    });
                    
                    // Add fade effect to carousel transitions
                    document.getElementById('testimonialsCarousel').addEventListener('slide.bs.carousel', function(e) {
                        let nextItem = e.relatedTarget;
                        let items = document.querySelectorAll('.carousel-item');
                        items.forEach(function(item) {
                            item.style.opacity = '0.4';
                        });
                        setTimeout(function() {
                            nextItem.style.opacity = '1';
                        }, 100);
                    });
                });
                </script>
            <?php else : ?>
                <div class="alert alert-info">
                    No testimonials found. Please add some testimonials from the WordPress admin.
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section id="portfolio" class="py-5">
        <div class="container text-center">
            <h2 class="section-title"><?php echo get_theme_mod('portfolio_section_title', 'Our Work'); ?></h2>
            <p class="section-description"><?php echo get_theme_mod('portfolio_section_subtitle', 'Explore our latest projects and see how we\'ve helped businesses transform.'); ?></p>
            <div class="row">
                <?php
                $portfolio = new WP_Query([
                    'post_type' => 'portfolio',
                    'posts_per_page' => get_theme_mod('homepage_portfolio_count', 3),
                    'orderby' => 'date',
                    'order' => 'DESC'
                ]);

                if ($portfolio->have_posts()) :
                    while ($portfolio->have_posts()) : $portfolio->the_post(); 
                    $portfolio_excerpt = get_the_excerpt() ?: strip_tags(get_the_content());
                    ?>
                        <div class="col-md-4 mb-4">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                <div class="card border-0 portfolio-card">
                                    <div class="card-img-container">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                                            <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                                <span class="btn btn-light"><?php echo get_theme_mod('portfolio_view_btn_text', 'View Project'); ?></span>
                                            </div>
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/portfolio-placeholder.jpg" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                                            <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                                <span class="btn btn-light"><?php echo get_theme_mod('portfolio_view_btn_text', 'View Project'); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-dark"><?php the_title(); ?></h5>
                                        <p class="card-text text-muted"><?php echo wp_trim_words($portfolio_excerpt, 15, '...'); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else : 
                    // Static fallback
                    $fallback_portfolio = array(
                        array(
                            'title' => 'E-commerce Platform',
                            'description' => 'Developed a scalable online store for a leading Kenyan retailer with integrated payment solutions.',
                            'image' => '/images/project1.jpg'
                        ),
                        array(
                            'title' => 'Cloud Migration',
                            'description' => 'Seamless migration of enterprise data to the cloud for a financial services company in Nairobi.',
                            'image' => '/images/project2.jpg'
                        ),
                        array(
                            'title' => 'Cybersecurity Implementation',
                            'description' => 'Enhanced security infrastructure for a network of banks across East Africa with compliance solutions.',
                            'image' => '/images/project3.jpg'
                        )
                    );
                    
                    foreach($fallback_portfolio as $project) :
                    ?>
                    <div class="col-md-4">
                        <div class="card border-0 portfolio-card">
                            <div class="card-img-container">
                                <img src="<?php echo get_template_directory_uri() . esc_url($project['image']); ?>" class="card-img-top" alt="<?php echo esc_attr($project['title']); ?>">
                                <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                    <span class="btn btn-light"><?php echo get_theme_mod('portfolio_view_btn_text', 'View Project'); ?></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?php echo esc_html($project['title']); ?></h5>
                                <p class="card-text text-muted"><?php echo esc_html($project['description']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="text-center mt-5">
                <a href="<?php echo esc_url(home_url('/portfolio')); ?>" class="btn btn-primary rounded-pill px-4 py-2" style="background-color: #2C1D6D; border: none;">
                    <?php echo get_theme_mod('portfolio_all_btn_text', 'View All Projects'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="why-choose-us" class="why-choose-us py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title"><?php echo get_theme_mod('why_choose_us_title', 'Why Choose Us'); ?></h2>
                <p class="section-description"><?php echo get_theme_mod('why_choose_us_subtitle', 'Discover what sets us apart in delivering exceptional IT solutions'); ?></p>
            </div>

            <div class="row g-4">
                <?php
                $why_choose_us = new WP_Query(array(
                    'post_type' => 'why_choose_us',
                    'posts_per_page' => 6,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));

                if ($why_choose_us->have_posts()) :
                    while ($why_choose_us->have_posts()) : $why_choose_us->the_post();
                        $reason_icon = get_post_meta(get_the_ID(), 'reason_icon', true) ?: 'fa-check-circle';
                ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="why-choose-item p-4 rounded-3 shadow-sm h-100" style="background-color: #fff;">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas <?php echo esc_attr($reason_icon); ?> text-primary me-2"></i>
                                <h3 class="h5 mb-0"><?php the_title(); ?></h3>
                            </div>
                            <div class="why-choose-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback content if no custom reasons are added
                    $fallback_reasons = array(
                        array(
                            'icon' => 'fa-check-circle',
                            'title' => 'Industry Expertise',
                            'content' => 'With years of experience in the Kenyan IT sector, our team brings deep industry knowledge to every project.'
                        ),
                        array(
                            'icon' => 'fa-award',
                            'title' => 'Quality Assurance',
                            'content' => 'We implement rigorous testing and quality control processes to deliver reliable, high-performance solutions.'
                        ),
                        array(
                            'icon' => 'fa-headset',
                            'title' => 'Dedicated Support',
                            'content' => 'Our local support team is available to quickly respond to your needs and ensure your systems run smoothly.'
                        ),
                        array(
                            'icon' => 'fa-wallet',
                            'title' => 'Cost-Effective Solutions',
                            'content' => 'We offer competitive pricing without compromising on quality, delivering excellent value for your investment.'
                        ),
                        array(
                            'icon' => 'fa-project-diagram',
                            'title' => 'Custom Solutions',
                            'content' => 'Every business is unique. We tailor our solutions to address your specific challenges and objectives.'
                        ),
                        array(
                            'icon' => 'fa-user-shield',
                            'title' => 'Data Security',
                            'content' => 'We prioritize the security of your sensitive information with robust protection measures and compliance with regulations.'
                        )
                    );
                    
                    foreach ($fallback_reasons as $reason) :
                ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="why-choose-item p-4 rounded-3 shadow-sm h-100" style="background-color: #fff;">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas <?php echo esc_attr($reason['icon']); ?> text-primary me-2"></i>
                                <h3 class="h5 mb-0"><?php echo esc_html($reason['title']); ?></h3>
                            </div>
                            <div class="why-choose-content">
                                <p><?php echo esc_html($reason['content']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="call-to-action" class="cta-section" style="background: linear-gradient(rgba(44, 29, 109, 0.9), rgba(26, 18, 66, 0.9)), url('<?php echo get_theme_mod('cta_background_image', get_template_directory_uri() . '/images/cta-bg.jpeg'); ?>') center/cover no-repeat;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                    <h2 class="text-white display-5 fw-bold mb-3">
                        <?php echo get_theme_mod('cta_heading', 'Ready to Transform Your Business?'); ?>
                    </h2>
                    <p class="text-white-50 lead mb-0">
                        <?php echo get_theme_mod('cta_text', 'Let\'s build your custom solution together. Get in touch with our experts today.'); ?>
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="<?php echo esc_url(get_theme_mod('cta_button_url', home_url('/get-your-solution'))); ?>" class="btn btn-light btn-lg px-4 py-3 rounded-pill fw-bold">
                        <?php echo get_theme_mod('cta_button_text', 'Get Your Solution'); ?>
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
    /* Sticky Header */
    .site-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    /* Testimonial Rating Stars */
    .testimonial-rating {
        font-size: 1.2rem;
        color: #ffc107;
    }

    .testimonial-rating .fa-star {
        margin: 0 2px;
    }

    .testimonial-rating .text-muted {
        color: #e9ecef !important;
    }

    /* Card Hover Effect */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* Hide Page Titles */
    .page-title {
        display: none;
    }

    /* Section Title Styles */
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2C1D6D;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #2C1D6D, rgb(159, 150, 207));
        border-radius: 2px;
    }

    .section-description {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 2rem;
    }

    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }

    .scroll-link {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .scroll-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    /* Portfolio Card Styles */
    .portfolio-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .portfolio-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .card-img-container {
        position: relative;
        overflow: hidden;
    }

    .card-img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(44, 29, 109, 0.8);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .portfolio-card:hover .card-img-overlay {
        opacity: 1;
    }

    .portfolio-card img {
        transition: transform 0.3s ease;
    }

    .portfolio-card:hover img {
        transform: scale(1.05);
    }

    /* Service Card Animation */
    .card .animate-on-hover {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .card:hover .animate-on-hover {
        transform: scale(1.15);
        color: #2C1D6D !important;
    }

    /* CTA Section Styles */
    .cta-section {
        position: relative;
        padding: 80px 0;
        margin-bottom: 0;
    }

    .cta-section .btn-light {
        background-color: #fff;
        color: #2C1D6D;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .cta-section .btn-light:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        background-color: #f8f9fa;
    }

    .cta-section .btn-light i {
        transition: transform 0.3s ease;
    }

    .cta-section .btn-light:hover i {
        transform: translateX(5px);
    }

    /* Remove space between CTA and footer */
    .cta-section + footer {
        margin-top: 0 !important;
    }

    /* Testimonial Styles */
    .testimonials-section {
        background-color: #f8f9fa;
        position: relative;
        overflow: hidden;
    }
    
    .testimonials-section:before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background-color: rgba(61, 46, 143, 0.05);
        z-index: 0;
    }
    
    .testimonial-item {
        padding: 0 15px;
    }
    
    .testimonial-text {
        font-size: 1rem;
        font-style: italic;
        color: #555;
        line-height: 1.6;
    }
    
    .placeholder-avatar {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .testimonial-card {
        cursor: pointer;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll functionality
        const scrollLinks = document.querySelectorAll('.scroll-link');
        
        scrollLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1); // Remove the # from href
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    const headerOffset = 80;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
    </script>

    <script>
    jQuery(document).ready(function($){
        $('.testimonial-carousel').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
    </script>

    <?php
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post();
            the_content(); 
        endwhile;
    endif;
    ?>
</main>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    const newsletterMessage = document.querySelector('.newsletter-message');
    if (newsletterMessage) {
        // Remove message after 5 seconds
        setTimeout(function() {
            newsletterMessage.style.transition = 'opacity 0.5s ease-out';
            newsletterMessage.style.opacity = '0';
            setTimeout(function() {
                newsletterMessage.remove();
            }, 500); // Wait for fade out animation
        }, 5000); // 5 seconds

        // Clean the URL
        if (window.history.replaceState) {
            const url = new URL(window.location.href);
            if (url.searchParams.has('newsletter_status')) {
                url.searchParams.delete('newsletter_status');
                window.history.replaceState({path:url.href}, '', url.href);
            }
        }
    }
});
</script>

<?php
get_footer();
?>
