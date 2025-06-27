<?php
/**
 * The template for displaying portfolio archive pages
 */

get_header(); ?>

<?php itsulu_breadcrumbs(); ?>

<!-- Hero Section -->
<section class="portfolio-hero-section py-4 position-relative overflow-hidden">
    <div class="hero-bg-gradient"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-9 text-center mx-auto">
                <p class="lead text-white-50 mb-0">
                    Explore our successful projects and see how we've helped businesses transform through technology.
                </p>
            </div>
            <div class="col-lg-3 d-none d-lg-block px-0">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/portfolio.jpg'); ?>" 
                     alt="Our Portfolio" 
                     class="img-fluid rounded-lg shadow-lg w-100"
                     style="max-height: 180px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<style>
.portfolio-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    overflow: hidden;
}
.portfolio-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.portfolio-card .card-img-top {
    transition: transform 0.3s ease;
}
.portfolio-card:hover .card-img-top {
    transform: scale(1.05);
}
.portfolio-card .card-body {
    position: relative;
    z-index: 1;
}
.portfolio-card .btn {
    transition: all 0.3s ease;
}
.portfolio-card:hover .btn {
    background-color: #0056b3;
    transform: translateY(-2px);
}

.portfolio-hero-section {
    background: linear-gradient(135deg, #2C1D6D 0%, #3D2E8F 100%);
    min-height: 30vh;
    display: flex;
    align-items: center;
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

.portfolio-hero-section .container {
    z-index: 2;
}
</style>

<section class="portfolio-archive py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
            </div>
        </div>

        <div class="row">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="card portfolio-card h-100">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="card-body">
                                <h2 class="card-title h5">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                                if (!empty($categories) && !is_wp_error($categories)) :
                                ?>
                                    <div class="portfolio-categories mb-2">
                                        <?php foreach ($categories as $category) : ?>
                                            <span class="badge bg-primary me-1"><?php echo esc_html($category->name); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="card-text">
                                    <?php 
                                    $excerpt = get_the_excerpt();
                                    $excerpt = wp_trim_words($excerpt, 15, '...');
                                    echo esc_html($excerpt);
                                    ?>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-transparent border-0">
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                    View Project
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="col-12">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('Previous', 'itsulu-custom'),
                        'next_text' => __('Next', 'itsulu-custom'),
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="col-12">
                    <p><?php esc_html_e('No portfolio items found.', 'itsulu-custom'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?> 