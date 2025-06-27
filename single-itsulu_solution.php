<?php
/**
 * Template for displaying single solution posts
 */

get_header(); ?>

<section class="solution-single-hero py-5" style="background-color: #2C1D6D;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 text-white">
                <h1 class="display-4 mb-3"><?php the_title(); ?></h1>
                <p class="lead"><?php echo get_the_excerpt(); ?></p>
            </div>
            <?php if (has_post_thumbnail()) : ?>
                <div class="col-lg-4">
                    <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded shadow-lg']); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="solution-content py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="solution-details">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="solution-sidebar bg-light p-4 rounded shadow-sm">
                    <?php if (have_rows('solution_features')) : ?>
                        <ul class="list-unstyled">
                            <?php while (have_rows('solution_features')) : the_row(); ?>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <?php the_sub_field('feature'); ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                    
                    <div class="mt-4">
                        <a href="<?php echo esc_url(add_query_arg(array(
                            'solution_title' => urlencode(get_the_title()),
                            'solution_id' => get_the_ID(),
                            'solution_excerpt' => urlencode(get_the_excerpt())
                        ), home_url('/get-your-solution'))); ?>" class="btn btn-primary w-100">
                            Request This Solution
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?> 