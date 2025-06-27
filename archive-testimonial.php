<?php
/**
 * The template for displaying testimonial archives
 *
 * @package itsulu-custom
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="testimonials-archive-hero py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="page-title mb-3">Client Testimonials</h1>
                    <p class="lead text-muted">See what our clients have to say about working with us and the impact of our IT solutions on their businesses.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials-archive-content py-5">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="row g-4">
                    <?php
                    $modal_counter = 0;
                    while (have_posts()) : the_post();
                        $client_name = get_post_meta(get_the_ID(), 'client_name', true) ?: get_the_title();
                        $client_position = get_post_meta(get_the_ID(), 'client_position', true) ?: '';
                        $client_company = get_post_meta(get_the_ID(), 'client_company', true) ?: '';
                        $testimonial_content = get_post_meta(get_the_ID(), 'testimonial_content', true) ?: get_the_content();
                        $full_testimonial = get_the_content();
                        $client_image = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                        $client_rating = intval(get_post_meta(get_the_ID(), 'client_rating', true)) ?: 5;
                        // Ensure rating is between 1-5
                        $client_rating = max(1, min(5, $client_rating));
                        $modal_id = 'archiveTestimonialModal' . $modal_counter;
                        $modal_counter++;
                    ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4 testimonial-card">
                                    <div class="testimonial-rating mb-3">
                                        <?php for($i = 0; $i < 5; $i++) : ?>
                                            <i class="fas fa-star <?php echo ($i < $client_rating) ? 'text-warning' : 'text-muted'; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <blockquote class="mb-4">
                                        <p class="testimonial-text">"<?php echo wp_trim_words($testimonial_content, 25, '...'); ?>"</p>
                                    </blockquote>
                                    
                                    <div class="testimonial-author d-flex align-items-center">
                                        <?php if ($client_image) : ?>
                                        <div class="author-image me-3">
                                            <img src="<?php echo esc_url($client_image); ?>" alt="<?php echo esc_attr($client_name); ?>" class="rounded-circle" width="60" height="60">
                                        </div>
                                        <?php else : ?>
                                        <div class="author-image me-3">
                                            <div class="placeholder-avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                <?php echo esc_html(substr($client_name, 0, 1)); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <div class="author-info">
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
                                </div>
                                
                                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#<?php echo $modal_id; ?>">
                                        Read Full Testimonial
                                    </button>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-link">
                                        View Page <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
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
                                                <?php if ($client_image) : ?>
                                                <img src="<?php echo esc_url($client_image); ?>" alt="<?php echo esc_attr($client_name); ?>" class="rounded-circle me-3" width="60" height="60">
                                                <?php else : ?>
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
                                                <p><?php echo wpautop($full_testimonial); ?></p>
                                            </blockquote>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">View Full Testimonial</a>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <?php if (get_the_posts_pagination()) : ?>
                <div class="testimonial-pagination mt-5">
                    <nav class="d-flex justify-content-center" aria-label="Testimonials navigation">
                        <?php
                        $pagination = paginate_links(array(
                            'prev_text' => '<i class="fas fa-chevron-left me-2"></i> Previous',
                            'next_text' => 'Next <i class="fas fa-chevron-right ms-2"></i>',
                            'type' => 'array'
                        ));
                        
                        if (!empty($pagination)) {
                            echo '<ul class="pagination">';
                            foreach ($pagination as $key => $page_link) {
                                $active_class = (strpos($page_link, 'current') !== false) ? ' active" aria-current="page' : '';
                                echo '<li class="page-item' . $active_class . '">';
                                echo str_replace('page-numbers', 'page-link', $page_link);
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                    </nav>
                </div>
                <?php endif; ?>
                
            <?php else : ?>
                <div class="alert alert-info">
                    <p class="mb-0">No testimonials have been added yet. Check back soon!</p>
                </div>
            <?php endif; ?>
            
            <div class="mt-5 text-center">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-lg btn-primary rounded-pill px-5 py-2">Work With Us</a>
            </div>
        </div>
    </section>
</main><!-- #main -->

<style>
.testimonial-card {
    cursor: pointer;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.testimonial-rating {
    font-size: 1rem;
    color: #ffc107;
}

.testimonial-rating .fa-star {
    margin-right: 3px;
}

.testimonial-text {
    font-style: italic;
}

.placeholder-avatar {
    font-size: 1.5rem;
}

.pagination .page-link {
    color: #2C1D6D;
    border-radius: 25px;
    margin: 0 3px;
    width: 40px;
    height: 40px;
    line-height: 24px;
    text-align: center;
}

.pagination .page-item.active .page-link {
    background-color: #2C1D6D;
    border-color: #2C1D6D;
}

.pagination .page-item:first-child .page-link,
.pagination .page-item:last-child .page-link {
    width: auto;
    padding-left: 15px;
    padding-right: 15px;
}
</style>

<?php get_footer(); ?> 