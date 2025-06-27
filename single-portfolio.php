<?php
/**
 * The template for displaying single portfolio items
 */

get_header(); ?>

<section class="portfolio-single py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header mb-4">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            <?php
                            $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                            if (!empty($categories) && !is_wp_error($categories)) :
                            ?>
                                <div class="portfolio-categories mt-2">
                                    <?php foreach ($categories as $category) : ?>
                                        <span class="badge bg-primary me-1"><?php echo esc_html($category->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="portfolio-featured-image mb-4">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-sidebar">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Project Details</h3>
                            <?php
                            $client = get_field('client');
                            $date = get_field('project_date');
                            $technologies = get_field('technologies_used');
                            ?>
                            
                            <?php if ($client) : ?>
                                <p><strong>Client:</strong> <?php echo esc_html($client); ?></p>
                            <?php endif; ?>

                            <?php if ($date) : ?>
                                <p><strong>Date:</strong> <?php echo esc_html($date); ?></p>
                            <?php endif; ?>

                            <?php if ($technologies) : ?>
                                <div class="technologies mt-3">
                                    <h4>Technologies Used</h4>
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach ($technologies as $tech) : ?>
                                            <span class="badge bg-secondary"><?php echo esc_html($tech); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="mt-4">
                                <a href="<?php echo esc_url(home_url('/portfolio')); ?>" class="btn btn-primary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Portfolio
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?> 