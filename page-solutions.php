<?php
/**
 * Template Name: Solutions Page
 */

get_header(); ?>

<?php itsulu_breadcrumbs(); ?>

<!-- Hero Section -->
<section class="solutions-hero-section py-5 position-relative overflow-hidden">
    <div class="hero-bg-gradient"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center mx-auto">
                <h1 class="text-white mb-3">Innovative IT Solutions for Kenyan Businesses</h1>
                <p class="lead text-white-50 mb-0">
                    We deliver custom technology solutions that address your unique business challenges and drive growth. Our comprehensive approach combines industry expertise with cutting-edge technology to provide you with reliable, scalable, and cost-effective IT solutions.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
.solutions-hero-section {
    background: linear-gradient(135deg, #2C1D6D 0%, #3D2E8F 100%);
    min-height: 30vh;
    display: flex;
    align-items: center;
    padding: 80px 0;
}

.hero-bg-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at top right, rgba(104, 11, 234, 0.2) 0%, transparent 50%),
                radial-gradient(circle at bottom left, rgba(44, 29, 109, 0.2) 0%, transparent 50%);
    z-index: 1;
}

.solutions-hero-section .container {
    z-index: 2;
}

.section-title {
    position: relative;
    margin-bottom: 2rem;
}

.section-title:after {
    content: '';
    display: block;
    width: 50px;
    height: 3px;
    background: #3D2E8F;
    margin: 15px auto 0;
}

.solution-card {
    transition: all 0.3s ease;
    height: 100%;
}

.solution-card:hover {
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
    display: flex;
    align-items: center;
    justify-content: center;
}

.solution-card:hover .card-img-overlay {
    opacity: 1;
}

.card-img-top {
    transition: transform 0.3s ease;
    height: 200px;
    object-fit: cover;
}

.solution-card:hover .card-img-top {
    transform: scale(1.05);
}

.solution-icon {
    height: 60px;
    width: 60px;
    background-color: rgba(44, 29, 109, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.solution-icon i {
    font-size: 1.5rem;
    color: #2C1D6D;
}

.nav-pills .nav-link {
    color: #6c757d;
    padding: 1rem 1.5rem;
    border-radius: 30px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.nav-pills .nav-link.active {
    background-color: #2C1D6D;
    color: white;
}

.nav-pills .nav-link:not(.active):hover {
    background-color: rgba(44, 29, 109, 0.1);
    color: #2C1D6D;
}
</style>

<!-- Solutions Introduction Section -->
<section class="solutions-intro py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="section-title">Tailored IT Solutions for Your Success</h2>
                <p class="lead">We understand the unique challenges faced by businesses in Kenya and provide customized technology solutions to meet your specific needs.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="solution-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="h4">Customized Approach</h3>
                    <p>We don't believe in one-size-fits-all solutions. Our team works closely with you to understand your business requirements and design solutions that address your specific challenges.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="solution-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="h4">Secure & Reliable</h3>
                    <p>Our solutions are built with security in mind. We implement industry best practices to ensure your data is protected and your systems are reliable and available when you need them.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4 text-center">
                    <div class="solution-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="h4">Growth-Focused</h3>
                    <p>We design scalable solutions that grow with your business. Our forward-thinking approach ensures that your technology investments continue to deliver value as your business evolves.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Solutions Listing Section -->
<section class="solutions-listing py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="section-title">Our Solutions</h2>
                <p>Explore our comprehensive range of IT solutions designed to empower your business.</p>
            </div>
        </div>

        <!-- Solutions Categories Navigation -->
        <div class="row">
            <div class="col-12 mb-4">
                <ul class="nav nav-pills justify-content-center mb-4" id="solutions-tab" role="tablist">
                    <li class="nav-item me-2 mb-2" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All Solutions</button>
                    </li>
                    <li class="nav-item me-2 mb-2" role="presentation">
                        <button class="nav-link" id="infrastructure-tab" data-bs-toggle="pill" data-bs-target="#infrastructure" type="button" role="tab" aria-controls="infrastructure" aria-selected="false">Infrastructure</button>
                    </li>
                    <li class="nav-item me-2 mb-2" role="presentation">
                        <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">Security</button>
                    </li>
                    <li class="nav-item me-2 mb-2" role="presentation">
                        <button class="nav-link" id="cloud-tab" data-bs-toggle="pill" data-bs-target="#cloud" type="button" role="tab" aria-controls="cloud" aria-selected="false">Cloud Solutions</button>
                    </li>
                    <li class="nav-item mb-2" role="presentation">
                        <button class="nav-link" id="software-tab" data-bs-toggle="pill" data-bs-target="#software" type="button" role="tab" aria-controls="software" aria-selected="false">Software</button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Solutions Content -->
        <div class="tab-content" id="solutions-tabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="row g-4">
                    <?php
                    $args = array(
                        'post_type' => 'itsulu_solution',
                        'posts_per_page' => -1
                    );
                    $solutions = new WP_Query($args);
                    if ($solutions->have_posts()) :
                        while ($solutions->have_posts()) : $solutions->the_post();
                            $solution_icon = get_field('solution_icon') ?: 'fa-laptop';
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm solution-card">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="card-img-container">
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                <div class="card-img-overlay">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-light">View Details</a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="solution-mini-icon me-3">
                                        <i class="fas <?php echo esc_attr($solution_icon); ?> text-primary"></i>
                                    </div>
                                    <h3 class="card-title h5 mb-0"><?php the_title(); ?></h3>
                                </div>
                                <p class="card-text mb-3"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<div class="col-12 text-center"><p>No solutions found. Please check back soon.</p></div>';
                    endif;
                    ?>
                </div>
            </div>

            <!-- Infrastructure Solutions Tab -->
            <div class="tab-pane fade" id="infrastructure" role="tabpanel" aria-labelledby="infrastructure-tab">
                <div class="row g-4">
                    <?php
                    $args = array(
                        'post_type' => 'itsulu_solution',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'solution_category',
                                'field' => 'slug',
                                'terms' => 'infrastructure',
                            ),
                        ),
                    );
                    $infrastructure = new WP_Query($args);
                    if ($infrastructure->have_posts()) :
                        while ($infrastructure->have_posts()) : $infrastructure->the_post();
                            $solution_icon = get_field('solution_icon') ?: 'fa-server';
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm solution-card">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="card-img-container">
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                <div class="card-img-overlay">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-light">View Details</a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="solution-mini-icon me-3">
                                        <i class="fas <?php echo esc_attr($solution_icon); ?> text-primary"></i>
                                    </div>
                                    <h3 class="card-title h5 mb-0"><?php the_title(); ?></h3>
                                </div>
                                <p class="card-text mb-3"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<div class="col-12 text-center"><p>No infrastructure solutions found. Please check back soon.</p></div>';
                    endif;
                    ?>
                </div>
            </div>

            <!-- Security Solutions Tab -->
            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                <div class="row g-4">
                    <?php
                    $args = array(
                        'post_type' => 'itsulu_solution',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'solution_category',
                                'field' => 'slug',
                                'terms' => 'security',
                            ),
                        ),
                    );
                    $security = new WP_Query($args);
                    if ($security->have_posts()) :
                        while ($security->have_posts()) : $security->the_post();
                            $solution_icon = get_field('solution_icon') ?: 'fa-shield-alt';
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm solution-card">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="card-img-container">
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                <div class="card-img-overlay">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-light">View Details</a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="solution-mini-icon me-3">
                                        <i class="fas <?php echo esc_attr($solution_icon); ?> text-primary"></i>
                                    </div>
                                    <h3 class="card-title h5 mb-0"><?php the_title(); ?></h3>
                                </div>
                                <p class="card-text mb-3"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<div class="col-12 text-center"><p>No security solutions found. Please check back soon.</p></div>';
                    endif;
                    ?>
                </div>
            </div>

            <!-- Cloud Solutions Tab -->
            <div class="tab-pane fade" id="cloud" role="tabpanel" aria-labelledby="cloud-tab">
                <div class="row g-4">
                    <?php
                    $args = array(
                        'post_type' => 'itsulu_solution',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'solution_category',
                                'field' => 'slug',
                                'terms' => 'cloud',
                            ),
                        ),
                    );
                    $cloud = new WP_Query($args);
                    if ($cloud->have_posts()) :
                        while ($cloud->have_posts()) : $cloud->the_post();
                            $solution_icon = get_field('solution_icon') ?: 'fa-cloud';
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm solution-card">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="card-img-container">
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                <div class="card-img-overlay">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-light">View Details</a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="solution-mini-icon me-3">
                                        <i class="fas <?php echo esc_attr($solution_icon); ?> text-primary"></i>
                                    </div>
                                    <h3 class="card-title h5 mb-0"><?php the_title(); ?></h3>
                                </div>
                                <p class="card-text mb-3"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<div class="col-12 text-center"><p>No cloud solutions found. Please check back soon.</p></div>';
                    endif;
                    ?>
                </div>
            </div>

            <!-- Software Solutions Tab -->
            <div class="tab-pane fade" id="software" role="tabpanel" aria-labelledby="software-tab">
                <div class="row g-4">
                    <?php
                    $args = array(
                        'post_type' => 'itsulu_solution',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'solution_category',
                                'field' => 'slug',
                                'terms' => 'software',
                            ),
                        ),
                    );
                    $software = new WP_Query($args);
                    if ($software->have_posts()) :
                        while ($software->have_posts()) : $software->the_post();
                            $solution_icon = get_field('solution_icon') ?: 'fa-code';
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm solution-card">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="card-img-container">
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                <div class="card-img-overlay">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-light">View Details</a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="solution-mini-icon me-3">
                                        <i class="fas <?php echo esc_attr($solution_icon); ?> text-primary"></i>
                                    </div>
                                    <h3 class="card-title h5 mb-0"><?php the_title(); ?></h3>
                                </div>
                                <p class="card-text mb-3"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<div class="col-12 text-center"><p>No software solutions found. Please check back soon.</p></div>';
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 bg-primary text-white shadow">
                    <div class="card-body p-5 text-center">
                        <h2 class="mb-3">Ready to Transform Your Business with Our IT Solutions?</h2>
                        <p class="lead mb-4">Contact us today for a free consultation to discuss how we can help you achieve your business goals.</p>
                        <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-light btn-lg">Request a Consultation</a>
                            <a href="<?php echo esc_url(home_url('/get-your-solution')); ?>" class="btn btn-outline-light btn-lg">Custom Solution Request</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
