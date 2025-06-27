<?php
/**
 * Template Name: About Us Page
 *
 * The template for displaying the About Us page using CPTs.
 */

get_header();
?>

<div class="about-page">
    <!-- First Section with Services Sidebar -->
    <section class="about-hero py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content (3/4) -->
                <div class="col-lg-9">
                    <div class="about-content pe-lg-4">
                        <div class="content">
                            <?php
                            while (have_posts()) :
                                the_post();
                                the_content();
                            endwhile;
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Services Sidebar (1/4) -->
                <div class="col-lg-3">
                    <div class="services-sidebar p-4 rounded-3 shadow-sm" style="background-color: #f8f9fa;">
                        <h3 class="h5 mb-4">Our Services</h3>
                        <?php
                        $services = new WP_Query([
                            'post_type' => 'itsulu_service',
                            'posts_per_page' => 6,
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                        ]);

                        if ($services->have_posts()) :
                            while ($services->have_posts()) : $services->the_post();
                                $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                                ?>
                                <div class="service-item mb-3">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                        <div class="d-flex align-items-center">
                                            <?php if ($featured_image) : ?>
                                                <img src="<?php echo esc_url($featured_image); ?>" 
                                                     alt="<?php the_title(); ?>" 
                                                     class="rounded-circle me-3"
                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                            <?php endif; ?>
                                            <h4 class="h6 mb-0 text-dark"><?php the_title(); ?></h4>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Company History Timeline Section - Now using CPTs
    $timeline_query = new WP_Query([
        'post_type' => 'company_timeline',
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => '_timeline_year',
        'order' => 'ASC'
    ]);

    if ($timeline_query->have_posts()) :
    ?>
    <section class="timeline-section py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Through The Years</h2>
                    <p class="section-subtitle">Our journey of growth, innovation, and excellence in the Kenyan IT industry</p>
                </div>
            </div>

            <div class="timeline-wrapper">
                <div class="timeline-line"></div>
                <?php
                $item_count = 0;
                while ($timeline_query->have_posts()) : $timeline_query->the_post();
                    $year = get_post_meta(get_the_ID(), '_timeline_year', true);
                    $milestone_type = get_post_meta(get_the_ID(), '_timeline_milestone_type', true);
                    $highlight = get_post_meta(get_the_ID(), '_timeline_highlight', true);
                    $side_class = ($item_count % 2 === 0) ? 'timeline-left' : 'timeline-right';
                    $highlight_class = $highlight ? 'timeline-highlight' : '';
                ?>
                <div class="timeline-item <?php echo esc_attr($side_class . ' ' . $highlight_class); ?>">
                    <div class="timeline-marker">
                        <div class="timeline-icon">
                            <?php if ($milestone_type === 'founding') : ?>
                                <i class="fas fa-rocket"></i>
                            <?php elseif ($milestone_type === 'expansion') : ?>
                                <i class="fas fa-expand-arrows-alt"></i>
                            <?php elseif ($milestone_type === 'certification') : ?>
                                <i class="fas fa-certificate"></i>
                            <?php elseif ($milestone_type === 'partnership') : ?>
                                <i class="fas fa-handshake"></i>
                            <?php elseif ($milestone_type === 'technology') : ?>
                                <i class="fas fa-microchip"></i>
                            <?php elseif ($milestone_type === 'award') : ?>
                                <i class="fas fa-trophy"></i>
                            <?php elseif ($milestone_type === 'growth') : ?>
                                <i class="fas fa-chart-line"></i>
                            <?php else : ?>
                                <i class="fas fa-calendar"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="timeline-content-wrapper">
                        <div class="timeline-year-badge"><?php echo esc_html($year); ?></div>
                        <div class="timeline-content-card">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="timeline-image">
                                <?php the_post_thumbnail('medium', ['class' => 'img-fluid rounded']); ?>
                            </div>
                            <?php endif; ?>
                            <div class="timeline-content">
                                <h3 class="timeline-title"><?php the_title(); ?></h3>
                                <div class="timeline-description">
                                    <?php the_content(); ?>
                                </div>
                                <?php if ($milestone_type) : ?>
                                <span class="timeline-type-badge badge bg-primary">
                                    <?php 
                                    $type_labels = [
                                        'founding' => 'Company Founding',
                                        'expansion' => 'Business Expansion',
                                        'certification' => 'Certification',
                                        'partnership' => 'Partnership',
                                        'technology' => 'Technology',
                                        'award' => 'Award',
                                        'growth' => 'Growth'
                                    ];
                                    echo esc_html($type_labels[$milestone_type] ?? ucfirst($milestone_type));
                                    ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $item_count++;
                endwhile;
                ?>
            </div>
        </div>
    </section>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // Mission and Vision Section - Now using CPTs with images
    $mission_vision_query = new WP_Query([
        'post_type' => 'mission_vision',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);

    if ($mission_vision_query->have_posts()) :
    ?>
    <section class="mission-vision-section py-5">
        <div class="container">
            <div class="row g-4">
                <?php
                while ($mission_vision_query->have_posts()) : $mission_vision_query->the_post();
                    $type = get_post_meta(get_the_ID(), '_mission_vision_type', true);
                    $default_images = [
                        'mission' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'vision' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                    ];
                    $image_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : $default_images[$type];
                    $icon = $type === 'vision' ? 'fas fa-eye' : 'fas fa-bullseye';
                ?>
                <div class="col-lg-6 mb-4">
                    <div class="mission-vision-card h-100 shadow-sm rounded overflow-hidden">
                        <div class="mission-vision-image" style="background-image: url('<?php echo esc_url($image_url); ?>'); height: 250px; background-size: cover; background-position: center; position: relative;">
                            <div class="mission-vision-overlay d-flex align-items-center justify-content-center">
                                <div class="mission-vision-icon">
                                    <i class="<?php echo esc_attr($icon); ?> fa-3x text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mission-vision-content p-4">
                            <h2 class="h3 mb-3 text-primary"><?php the_title(); ?></h2>
                            <div class="mission-vision-text">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // Certifications Section - Now using CPTs
    $certifications_query = new WP_Query([
        'post_type' => 'certifications',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);

    if ($certifications_query->have_posts()) :
    ?>
    <section class="certification-section">
        <div class="container">
            <h2>Certified Excellence</h2>
            <div class="certification-content">
                <?php
                while ($certifications_query->have_posts()) : $certifications_query->the_post();
                ?>
                <div class="certification-item mb-4">
                    <h3><?php the_title(); ?></h3>
                    <div class="certification-details">
                        <?php the_content(); ?>
                        <?php
                        $issuer = get_post_meta(get_the_ID(), '_certification_issuer', true);
                        $date_issued = get_post_meta(get_the_ID(), '_certification_date_issued', true);
                        if ($issuer || $date_issued) :
                        ?>
                        <div class="certification-meta mt-2">
                            <?php if ($issuer) : ?>
                                <span class="issuer"><strong>Issued by:</strong> <?php echo esc_html($issuer); ?></span>
                            <?php endif; ?>
                            <?php if ($date_issued) : ?>
                                <span class="date-issued ms-3"><strong>Date:</strong> <?php echo esc_html(date('M Y', strtotime($date_issued))); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="certification-logos">
                <?php
                // Reset query and show logos
                $certifications_query->rewind_posts();
                while ($certifications_query->have_posts()) : $certifications_query->the_post();
                    if (has_post_thumbnail()) :
                ?>
                <div class="certification-logo">
                    <?php the_post_thumbnail('thumbnail', ['alt' => get_the_title()]); ?>
                </div>
                <?php
                    endif;
                endwhile;
                ?>
            </div>
        </div>
    </section>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // Awards Section - Enhanced with better image support and details
    $awards_query = new WP_Query([
        'post_type' => 'award',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    ]);

    if ($awards_query->have_posts()) :
    ?>
    <section class="awards-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-primary mb-3">Awards and Recognitions</h2>
                <p class="lead text-muted">Celebrating our achievements and industry recognition</p>
            </div>
            <div class="row g-4">
                <?php 
                $award_count = 0;
                while ($awards_query->have_posts()) : $awards_query->the_post(); 
                    $award_year = get_post_meta(get_the_ID(), '_award_year', true) ?: date('Y', strtotime(get_the_date()));
                    $award_organization = get_post_meta(get_the_ID(), '_award_organization', true) ?: 'Industry Recognition';
                    $award_category = get_post_meta(get_the_ID(), '_award_category', true) ?: 'Excellence';
                    
                    // Default award images from Unsplash
                    $default_award_images = [
                        'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                        'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                        'https://images.unsplash.com/photo-1586281010691-3d8c4fdc0b8e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                        'https://images.unsplash.com/photo-1551836022-deb4988cc6c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                    ];
                    $image_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : $default_award_images[$award_count % 4];
                    $award_count++;
                ?>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="award-card h-100 bg-white rounded shadow-sm overflow-hidden hover-lift">
                        <div class="award-image-container position-relative">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="award-image w-100" style="height: 200px; object-fit: cover;">
                            <div class="award-year-badge position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary fs-6"><?php echo esc_html($award_year); ?></span>
                            </div>
                        </div>
                        <div class="award-content p-4">
                            <div class="award-category mb-2">
                                <span class="badge bg-secondary"><?php echo esc_html($award_category); ?></span>
                            </div>
                            <h3 class="award-title h5 mb-3 text-dark"><?php the_title(); ?></h3>
                            <div class="award-organization mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-award me-1"></i>
                                    <?php echo esc_html($award_organization); ?>
                                </small>
                            </div>
                            <div class="award-description text-muted">
                                <?php 
                                $content = get_the_content();
                                echo wp_trim_words($content, 20, '...');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // Facilities Section - Now using CPTs
    $facilities_query = new WP_Query([
        'post_type' => 'facilities',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);

    if ($facilities_query->have_posts()) :
    ?>
    <section class="facilities-section">
        <div class="container">
            <h2>Our Facilities</h2>

            <div class="facilities-content">
                <div class="row">
                    <?php
                    $facility_count = 0;
                    while ($facilities_query->have_posts()) : $facilities_query->the_post();
                        $category = get_post_meta(get_the_ID(), '_facility_category', true);
                        $column_class = ($facility_count % 2 === 0) ? 'col-md-6' : 'col-md-6';
                    ?>
                    <div class="<?php echo esc_attr($column_class); ?>">
                        <div class="facility-item mb-3">
                            <h4><?php the_title(); ?></h4>
                            <?php if ($category) : ?>
                                <span class="facility-category badge bg-secondary mb-2"><?php echo esc_html(ucfirst($category)); ?></span>
                            <?php endif; ?>
                            <div class="facility-description">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $facility_count++;
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // Team Section - Using existing team_member CPT
    $team_query = new WP_Query([
        'post_type' => 'team_member',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);

    if ($team_query->have_posts()) :
    ?>
    <section class="team-section bg-light py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title">Meet Our Expert Team</h2>
                    <p class="section-subtitle mb-5">Our team of professionals brings decades of combined experience in the Kenyan IT industry</p>
                </div>
            </div>

            <div class="team-grid">
                <?php
                while ($team_query->have_posts()) : $team_query->the_post();
                    $position = get_field('position');
                    $bio = get_field('bio');
                    $linkedin = get_field('linkedin_url');
                    $expertise = get_field('expertise_areas') ?: ['IT Consulting', 'Project Management'];
                ?>
                <div class="team-member">
                    <div class="card border-0 shadow-sm h-100">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="team-member-image">
                            <?php the_post_thumbnail('medium', ['class' => 'img-fluid', 'alt' => get_the_title()]); ?>
                        </div>
                        <?php endif; ?>
                        <div class="card-body team-member-info text-center p-4">
                            <h3 class="mb-1"><?php the_title(); ?></h3>
                            <?php if ($position) : ?>
                            <div class="position text-primary mb-3"><?php echo esc_html($position); ?></div>
                            <?php endif; ?>
                            <?php if ($bio) : ?>
                            <p class="mb-3"><?php echo wp_kses_post($bio); ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($expertise)) : ?>
                            <div class="expertise-tags mb-3">
                                <?php foreach ($expertise as $skill) : ?>
                                    <span class="badge bg-light text-primary me-1 mb-1"><?php echo esc_html($skill); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($linkedin) : ?>
                            <a href="<?php echo esc_url($linkedin); ?>" class="linkedin-link" target="_blank" rel="noopener">
                                <i class="fab fa-linkedin"></i> Connect
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <?php
    // Company Values Section - Now using CPTs
    $values_query = new WP_Query([
        'post_type' => 'company_values',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);

    if ($values_query->have_posts()) :
    ?>
    <section class="company-values py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h2 class="section-title">Our Core Values</h2>
                    <p class="section-subtitle">Guiding principles that define how we operate and deliver value to our clients</p>
                </div>
            </div>
            
            <div class="row g-4">
                <?php
                while ($values_query->have_posts()) : $values_query->the_post();
                    $icon = get_post_meta(get_the_ID(), '_company_value_icon', true) ?: 'fas fa-star';
                ?>
                <div class="col-md-4 mb-4">
                    <div class="value-card h-100 bg-white p-4 rounded shadow-sm text-center">
                        <div class="value-icon mb-3">
                            <i class="<?php echo esc_attr($icon); ?> fa-2x text-primary"></i>
                        </div>
                        <h3 class="h4 mb-3"><?php the_title(); ?></h3>
                        <div class="value-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php
    endif;
    wp_reset_postdata();
    ?>

    <style>
    /* Team Section Styles */
    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
    }

    .team-member-image {
        overflow: hidden;
    }

    .team-member-image img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .team-member:hover .team-member-image img {
        transform: scale(1.05);
    }

    .linkedin-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #0072b1;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .linkedin-link:hover {
        color: #005582;
    }

    .expertise-tags {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Values Section Styles */
    .value-card {
        transition: all 0.3s ease;
    }

    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .value-icon {
        height: 70px;
        width: 70px;
        border-radius: 50%;
        background-color: rgba(44, 29, 109, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 800px;
        margin: 0 auto;
    }

    /* Certification Section Styles */
    .certification-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
    }

    .certification-item:last-child {
        border-bottom: none;
    }

    .certification-meta {
        font-size: 0.9rem;
        color: #666;
    }

    .certification-logos {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 2rem;
    }

    .certification-logo img {
        max-height: 80px;
        width: auto;
        object-fit: contain;
    }

    /* Facility Section Styles */
    .facility-item {
        border: 1px solid #eee;
        padding: 1rem;
        border-radius: 8px;
        background: #f9f9f9;
    }

    .facility-category {
        font-size: 0.8rem;
    }
    </style>
</div>

<style>
/* About Page Styles */
.about-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 100px 0;
    text-align: center;
}

.about-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.about-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
}

.services-sidebar {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 10px;
    margin-bottom: 2rem;
    position: sticky;
    top: 100px;
}

.services-sidebar h3 {
    color: #333;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.service-item {
    padding: 1rem;
    margin-bottom: 1rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.service-item:hover {
    transform: translateY(-5px);
}

.service-item h4 {
    color: #667eea;
    margin-bottom: 0.5rem;
}

.service-item p {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}

.service-item a:hover h4 {
    color: #2C1D6D !important;
}

.service-item img {
    transition: transform 0.3s ease;
}

.service-item:hover img {
    transform: scale(1.1);
}

/* Mission & Vision Cards */
.mission-vision-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
}

.mission-vision-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}

.mission-vision-overlay {
    background: rgba(0,0,0,0.4);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.mission-vision-card:hover .mission-vision-overlay {
    opacity: 1;
}

.mission-vision-icon {
    transform: scale(0.8);
    transition: transform 0.3s ease;
}

.mission-vision-card:hover .mission-vision-icon {
    transform: scale(1);
}

/* Enhanced Awards Styles */
.award-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
}

.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important;
}

.award-year-badge .badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.8rem;
}

.award-category .badge {
    font-size: 0.75rem;
    padding: 0.4rem 0.6rem;
}

.award-title {
    line-height: 1.3;
    font-weight: 600;
}

.award-organization {
    border-left: 3px solid #667eea;
    padding-left: 0.8rem;
}

.award-description {
    font-size: 0.9rem;
    line-height: 1.5;
}
</style>

<?php
get_footer();
