<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package itsulu-custom
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Post Header -->
            <header class="post-header bg-light py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <?php the_title('<h1 class="entry-title mb-3">', '</h1>'); ?>
                            
                            <div class="post-meta mb-4">
                                <span class="post-date me-3"><i class="far fa-calendar me-1"></i> <?php echo get_the_date(); ?></span>
                                <span class="post-author me-3"><i class="far fa-user me-1"></i> <?php the_author_posts_link(); ?></span>
                                <?php if (has_category()) : ?>
                                <span class="post-category me-3"><i class="far fa-folder me-1"></i> <?php the_category(', '); ?></span>
                                <?php endif; ?>
                                <?php if (has_tag()) : ?>
                                <span class="post-tags"><i class="fas fa-tags me-1"></i> <?php the_tags('', ', ', ''); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="featured-image-container">
                                <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded shadow')); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Post Content -->
            <div class="post-content py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                            
                            <div class="post-navigation mt-5 pt-4 border-top">
                                <div class="row">
                                    <div class="col-6">
                                        <?php previous_post_link('<div class="prev-post"><small>Previous Post</small><br>%link</div>', '%title'); ?>
                                    </div>
                                    <div class="col-6 text-end">
                                        <?php next_post_link('<div class="next-post"><small>Next Post</small><br>%link</div>', '%title'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Author Info -->
                            <div class="author-info mt-5 p-4 bg-light rounded">
                                <div class="row">
                                    <div class="col-md-2 mb-3 mb-md-0 text-center">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 100, '', 'Author Avatar', array('class' => 'rounded-circle')); ?>
                                    </div>
                                    <div class="col-md-10">
                                        <h4><?php the_author(); ?></h4>
                                        <?php if (get_the_author_meta('description')) : ?>
                                            <p><?php echo get_the_author_meta('description'); ?></p>
                                        <?php else : ?>
                                            <p>IT solution expert at Bitcomm, providing insights on digital transformation and technology trends in Kenya.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>

    <!-- Related Posts -->
    <section class="related-posts py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h3 class="section-title">Related Articles</h3>
                </div>
            </div>
            
            <div class="row">
                <?php
                $categories = get_the_category();
                $category_ids = array();
                foreach ($categories as $category) {
                    $category_ids[] = $category->term_id;
                }
                
                $related_posts = new WP_Query(array(
                    'category__in' => $category_ids,
                    'post__not_in' => array(get_the_ID()),
                    'posts_per_page' => 3,
                    'orderby' => 'rand'
                ));
                
                if ($related_posts->have_posts()) :
                    while ($related_posts->have_posts()) : $related_posts->the_post();
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="blog-img-container">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', array('class' => 'card-img-top')); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/blog-placeholder.jpg" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-body">
                            <div class="post-meta mb-2">
                                <i class="far fa-calendar me-1"></i> <?php echo get_the_date(); ?>
                            </div>
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark"><?php the_title(); ?></a>
                            </h5>
                            <div class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <div class="col-12 text-center">
                    <p>No related articles found.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="post-cta py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-box bg-primary text-white p-5 rounded text-center">
                        <h3 class="mb-3">Need Expert IT Consultation?</h3>
                        <p class="lead mb-4">Let our team help you navigate the digital transformation journey for your business.</p>
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-light btn-lg">Contact Us Today</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- #main -->

<style>
.post-header {
    padding: 60px 0;
    border-bottom: 1px solid #e9ecef;
}

.post-meta {
    font-size: 0.9rem;
    color: #6c757d;
}

.post-meta i {
    color: #2C1D6D;
}

.featured-image-container {
    margin-top: 30px;
}

.entry-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #343a40;
}

.entry-content p {
    margin-bottom: 1.5rem;
}

.entry-content h2, .entry-content h3, .entry-content h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.entry-content img {
    max-width: 100%;
    height: auto;
    margin: 2rem 0;
    border-radius: 5px;
}

.entry-content blockquote {
    border-left: 4px solid #2C1D6D;
    padding-left: 1.5rem;
    font-style: italic;
    color: #6c757d;
    margin: 2rem 0;
}

.post-navigation a {
    color: #343a40;
    text-decoration: none;
    transition: all 0.3s ease;
}

.post-navigation a:hover {
    color: #2C1D6D;
}

.prev-post, .next-post {
    font-size: 0.95rem;
}

.prev-post small, .next-post small {
    color: #6c757d;
    font-size: 0.8rem;
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

.blog-img-container {
    overflow: hidden;
}

.blog-img-container img {
    transition: transform 0.3s ease;
}

.card:hover .blog-img-container img {
    transform: scale(1.05);
}
</style>

<?php
get_footer();
