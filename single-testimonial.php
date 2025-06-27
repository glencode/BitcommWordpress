<?php
/**
 * The template for displaying single testimonials
 *
 * @package itsulu-custom
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); 
        // Get testimonial meta data
        $client_name = get_post_meta(get_the_ID(), 'client_name', true) ?: get_the_title();
        $client_position = get_post_meta(get_the_ID(), 'client_position', true) ?: '';
        $client_company = get_post_meta(get_the_ID(), 'client_company', true) ?: '';
        $testimonial_content = get_post_meta(get_the_ID(), 'testimonial_content', true) ?: get_the_content();
        $client_rating = intval(get_post_meta(get_the_ID(), 'client_rating', true)) ?: 5;
        $client_rating = max(1, min(5, $client_rating));
    ?>
        <section class="testimonial-hero py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="entry-title mb-4">Testimonial from <?php echo esc_html($client_name); ?></h1>
                        <div class="testimonial-rating mb-4">
                            <?php for($i = 0; $i < 5; $i++) : ?>
                                <i class="fas fa-star fa-2x <?php echo ($i < $client_rating) ? 'text-warning' : 'text-muted'; ?>"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm p-4 mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="me-4">
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'rounded-circle', 'style' => 'width: 100px; height: 100px; object-fit: cover;')); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="me-4">
                                        <div class="placeholder-avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 2.5rem;">
                                            <?php echo esc_html(substr($client_name, 0, 1)); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <h2 class="h4 mb-1"><?php echo esc_html($client_name); ?></h2>
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
                                <i class="fas fa-quote-left text-primary fa-2x mb-3"></i>
                                <div class="testimonial-content">
                                    <?php 
                                    // First try to use testimonial_content if it exists and isn't empty
                                    if (!empty($testimonial_content)) {
                                        echo wpautop($testimonial_content);
                                    } else {
                                        the_content(); // Otherwise use the post content
                                    }
                                    ?>
                                </div>
                                <i class="fas fa-quote-right text-primary fa-2x mt-3 d-block text-end"></i>
                            </blockquote>
                        </div>
                        
                        <div class="text-center">
                            <a href="<?php echo esc_url(get_post_type_archive_link('testimonial')); ?>" class="btn btn-outline-primary rounded-pill me-3">
                                <i class="fas fa-chevron-left me-2"></i> Back to Testimonials
                            </a>
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary rounded-pill">
                                <i class="fas fa-envelope me-2"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Get more testimonials
        $more_testimonials = new WP_Query([
            'post_type' => 'testimonial',
            'posts_per_page' => 3,
            'orderby' => 'rand',
            'post__not_in' => array(get_the_ID())
        ]);

        if ($more_testimonials->have_posts()) : 
        ?>
        <section class="more-testimonials py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-4">More Testimonials</h2>
                <div class="row">
                    <?php while ($more_testimonials->have_posts()) : $more_testimonials->the_post();
                        $t_client_name = get_post_meta(get_the_ID(), 'client_name', true) ?: get_the_title();
                        $t_client_position = get_post_meta(get_the_ID(), 'client_position', true) ?: '';
                        $t_client_company = get_post_meta(get_the_ID(), 'client_company', true) ?: '';
                        $t_testimonial_content = get_post_meta(get_the_ID(), 'testimonial_content', true) ?: get_the_content();
                        $t_client_rating = intval(get_post_meta(get_the_ID(), 'client_rating', true)) ?: 5;
                    ?>
                    <div class="col-md-4 mb-4">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body p-4">
                                    <div class="testimonial-rating mb-3">
                                        <?php for($i = 0; $i < 5; $i++) : ?>
                                            <i class="fas fa-star <?php echo ($i < $t_client_rating) ? 'text-warning' : 'text-muted'; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <blockquote class="mb-4">
                                        <p class="testimonial-text text-dark">"<?php echo wp_trim_words($t_testimonial_content, 20, '...'); ?>"</p>
                                    </blockquote>
                                    <div class="d-flex align-items-center">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('thumbnail', array('class' => 'rounded-circle me-3', 'style' => 'width: 50px; height: 50px; object-fit: cover;')); ?>
                                        <?php else : ?>
                                            <div class="placeholder-avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                                <?php echo esc_html(substr($t_client_name, 0, 1)); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <h6 class="mb-0"><?php echo esc_html($t_client_name); ?></h6>
                                            <?php if ($t_client_company) : ?>
                                                <small class="text-muted"><?php echo esc_html($t_client_company); ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php
        endif;
        wp_reset_postdata();
        ?>

    <?php endwhile; ?>
</main><!-- #main -->

<style>
.testimonial-hero {
    position: relative;
    padding: 60px 0;
}

.testimonial-hero:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(ellipse at center, rgba(44, 29, 109, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
    z-index: 0;
}

.testimonial-hero .container {
    position: relative;
    z-index: 1;
}

.testimonial-rating {
    color: #ffc107;
}

.testimonial-content {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #555;
}

.blockquote {
    border-left: none;
    padding: 0;
}

.placeholder-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
}

.more-testimonials .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.more-testimonials .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
</style>

<?php
get_footer(); 