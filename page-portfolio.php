<?php
/**
 * Template Name: Portfolio Page
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
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/hero5.jpg'); ?>" 
                     alt="Our Portfolio" 
                     class="img-fluid rounded-lg shadow-lg w-100"
                     style="max-height: 180px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<style>
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

<section class="portfolio-grid py-5">
    <div class="container">
        <?php
        $categories = get_terms([
            'taxonomy' => 'portfolio_category',
            'hide_empty' => true,
        ]);

        if (!empty($categories) && !is_wp_error($categories)) : ?>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="portfolio-filters text-center">
                        <button class="btn btn-outline-primary me-2 mb-2 active" data-filter="all">All Projects</button>
                        <?php foreach ($categories as $category) : ?>
                            <button class="btn btn-outline-primary me-2 mb-2" data-filter="<?php echo esc_attr($category->slug); ?>">
                                <?php echo esc_html($category->name); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row portfolio-items">
            <?php
            $portfolio = new WP_Query([
                'post_type' => 'portfolio',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC'
            ]);

            if ($portfolio->have_posts()) :
                while ($portfolio->have_posts()) : $portfolio->the_post();
                    $post_categories = get_the_terms(get_the_ID(), 'portfolio_category');
                    $category_classes = '';
                    if (!empty($post_categories) && !is_wp_error($post_categories)) {
                        foreach ($post_categories as $category) {
                            $category_classes .= ' ' . esc_attr($category->slug);
                        }
                    }
            ?>
                <div class="col-md-4 mb-4 portfolio-item<?php echo $category_classes; ?>">
                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                        <div class="card border-0 portfolio-card">
                            <div class="card-img-container">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                        <span class="btn btn-light">View Project</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?php the_title(); ?></h5>
                                <p class="card-text text-muted"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                                <?php if (!empty($post_categories) && !is_wp_error($post_categories)) : ?>
                                    <div class="portfolio-categories">
                                        <?php foreach ($post_categories as $category) : ?>
                                            <span class="badge bg-primary me-1"><?php echo esc_html($category->name); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <div class="col-12 text-center">
                    <p>No portfolio items found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
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

.btn-outline-primary {
    color: #2C1D6D;
    border-color: #2C1D6D;
}

.btn-outline-primary:hover,
.btn-outline-primary.active {
    background-color: #2C1D6D;
    color: white;
}

.portfolio-item {
    display: none;
}

.portfolio-item.show {
    display: block;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
jQuery(document).ready(function($) {
    // Show all items initially
    $('.portfolio-item').addClass('show');

    // Filter functionality
    $('.portfolio-filters button').click(function() {
        $('.portfolio-filters button').removeClass('active');
        $(this).addClass('active');

        var filter = $(this).data('filter');
        
        if (filter === 'all') {
            $('.portfolio-item').addClass('show');
        } else {
            $('.portfolio-item').removeClass('show');
            $('.portfolio-item' + '.' + filter).addClass('show');
        }
    });
});
</script>

<?php get_footer(); ?> 