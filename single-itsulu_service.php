<?php
/**
 * The template for displaying single service pages
 *
 * @package itsulu-custom
 */

get_header();
?>

<main id="primary" class="site-main service-single-page">
    <?php while (have_posts()) : the_post(); 
        // Get service meta if available, trying both ACF and custom meta
        $service_icon = function_exists('get_field') ? get_field('service_icon') : get_post_meta(get_the_ID(), 'service_icon', true);
        $service_icon = $service_icon ?: 'fa-laptop-code'; // Fallback icon
        
        $service_short_description = function_exists('get_field') ? get_field('service_short_description') : get_post_meta(get_the_ID(), 'service_short_description', true);
        $service_short_description = $service_short_description ?: ''; // Empty fallback
    ?>
        <article id="service-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Service Header -->
            <header class="service-header py-5" style="background: linear-gradient(rgba(44, 29, 109, 0.9), rgba(44, 29, 109, 0.9)), url('<?php echo get_template_directory_uri(); ?>/images/cta-bg.jpeg') center/cover no-repeat;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center text-white">
                            <div class="service-icon mb-3">
                                <i class="fas <?php echo esc_attr($service_icon); ?> fa-3x"></i>
                            </div>
                            <?php the_title('<h1 class="entry-title mb-4">', '</h1>'); ?>
                            
                            <?php if (!empty($service_short_description)) : ?>
                                <div class="service-subtitle lead mb-4">
                                    <?php echo wp_kses_post($service_short_description); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="service-actions">
                                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-lg rounded-pill me-2">
                                    <i class="fas fa-envelope me-2"></i> Request This Service
                                </a>
                                <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-outline-light btn-lg rounded-pill">
                                    <i class="fas fa-th-list me-2"></i> All Services
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Service Overview -->
            <section class="service-overview py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="service-featured-image mb-4">
                                    <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded shadow')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="service-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Key Benefits -->
            <section class="service-benefits py-5 bg-light">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h2 class="section-title mb-5">Key Benefits</h2>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="row g-4">
                                <?php
                                // Try to get benefits from custom fields first
                                $benefits_field = function_exists('get_field') ? get_field('service_benefits') : false;
                                $has_custom_benefits = !empty($benefits_field) && is_array($benefits_field);
                                
                                // Fallback to hardcoded benefits if none are set
                                $benefits = $has_custom_benefits ? $benefits_field : array(
                                    array(
                                        'icon' => 'fa-chart-line',
                                        'title' => 'Increased Efficiency',
                                        'description' => 'Optimize your business processes and improve operational efficiency.'
                                    ),
                                    array(
                                        'icon' => 'fa-tachometer-alt',
                                        'title' => 'Enhanced Performance',
                                        'description' => 'Boost system performance and responsiveness with our optimized solutions.'
                                    ),
                                    array(
                                        'icon' => 'fa-shield-alt',
                                        'title' => 'Improved Security',
                                        'description' => 'Protect your valuable data and systems with robust security measures.'
                                    ),
                                    array(
                                        'icon' => 'fa-money-bill-wave',
                                        'title' => 'Cost Reduction',
                                        'description' => 'Lower operational costs through efficient IT systems and processes.'
                                    )
                                );
                                
                                foreach ($benefits as $benefit) :
                                    // Handle different formats - ACF repeater vs. hardcoded array
                                    $icon = isset($benefit['icon']) ? $benefit['icon'] : ($benefit['benefit_icon'] ?? 'fa-check');
                                    $title = isset($benefit['title']) ? $benefit['title'] : ($benefit['benefit_title'] ?? 'Benefit');
                                    $description = isset($benefit['description']) ? $benefit['description'] : ($benefit['benefit_description'] ?? '');
                                ?>
                                <div class="col-md-6 col-lg-3">
                                    <div class="benefit-card text-center p-4 h-100 bg-white rounded shadow-sm">
                                        <div class="benefit-icon mb-3">
                                            <i class="fas <?php echo esc_attr($icon); ?> fa-2x text-primary"></i>
                                        </div>
                                        <h3 class="benefit-title h5 mb-3"><?php echo esc_html($title); ?></h3>
                                        <p class="benefit-description mb-0"><?php echo esc_html($description); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    <?php endwhile; ?>

    <!-- Related Services -->
    <section class="related-services py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title">Related Services</h2>
                    <p class="section-subtitle">Explore our other IT solutions that complement this service</p>
                </div>
            </div>
            
            <div class="row">
                <?php
                // Get related services
                $current_id = get_the_ID();
                $related_services = new WP_Query(array(
                    'post_type' => 'itsulu_service',
                    'post__not_in' => array($current_id),
                    'posts_per_page' => 3,
                    'orderby' => 'rand'
                ));
                
                if ($related_services->have_posts()) :
                    while ($related_services->have_posts()) : $related_services->the_post();
                        // Get meta with support for both ACF and custom meta
                        $icon = function_exists('get_field') ? get_field('service_icon') : get_post_meta(get_the_ID(), 'service_icon', true);
                        $icon = $icon ?: 'fa-cogs'; // Fallback icon
                        
                        $short_desc = function_exists('get_field') ? get_field('service_short_description') : get_post_meta(get_the_ID(), 'service_short_description', true);
                        $short_desc = $short_desc ?: get_the_excerpt(); // Fallback to excerpt
                        $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_template_directory_uri() . '/assets/images/placeholder.jpg';
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="<?php echo esc_url($featured_image); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                        <div class="card-body text-center">
                            <div class="service-icon mb-3">
                                <i class="fas <?php echo esc_attr($icon); ?> fa-2x text-primary"></i>
                            </div>
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark"><?php the_title(); ?></a>
                            </h5>
                            <div class="card-text"><?php echo wp_trim_words($short_desc, 15); ?></div>
                        </div>
                        <div class="card-footer bg-white border-0 text-center">
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary rounded-pill">Learn More</a>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <div class="col-12 text-center">
                    <p>No related services found.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="service-cta py-5 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="service-cta-title">Ready to Transform Your Business?</h2>
                    <p class="lead mb-4">Get in touch with our experts to discuss how our <?php the_title(); ?> service can benefit your organization.</p>
                    <div class="cta-buttons">
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-light btn-lg rounded-pill me-2 mb-2 mb-md-0">
                            <i class="fas fa-envelope me-2"></i> Contact Us
                        </a>
                        <a href="<?php echo esc_url(home_url('/get-your-solution')); ?>" class="btn btn-outline-light btn-lg rounded-pill">
                            <i class="fas fa-lightbulb me-2"></i> Request Custom Solution
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Service Single Page Styles */
.service-header {
    padding: 80px 0;
}

.service-icon i {
    color: #fff;
}

.section-title {
    position: relative;
    margin-bottom: 1.5rem;
    font-weight: 700;
    color: #2C1D6D;
}

.section-title:after {
    content: '';
    display: block;
    width: 50px;
    height: 3px;
    background: #3D2E8F;
    margin: 15px auto 0;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    max-width: 700px;
    margin: 0 auto 2rem;
}

.service-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #343a40;
}

.service-content p {
    margin-bottom: 1.5rem;
}

.service-content h2, .service-content h3, .service-content h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #2C1D6D;
}

.service-content img {
    max-width: 100%;
    height: auto;
    margin: 2rem 0;
    border-radius: 5px;
}

.service-content blockquote {
    border-left: 4px solid #2C1D6D;
    padding-left: 1.5rem;
    font-style: italic;
    color: #6c757d;
    margin: 2rem 0;
}

.benefit-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.benefit-icon i {
    color: #2C1D6D;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}

.service-cta {
    background: linear-gradient(to right, #2C1D6D, #3D2E8F);
}

.cta-buttons .btn {
    transition: all 0.3s ease;
}

.cta-buttons .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

@media (max-width: 767.98px) {
    .service-header {
        padding: 50px 0;
    }
    
    .benefit-card {
        margin-bottom: 1.5rem;
    }
}
</style>

<?php get_footer(); ?> 