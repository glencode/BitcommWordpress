<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package itsulu-custom
 */

get_header();
?>

	<main id="primary" class="site-main">
		<!-- Blog Hero Section -->
		<section class="blog-hero-section py-5 position-relative overflow-hidden">
			<div class="hero-bg-gradient"></div>
			<div class="container position-relative">
				<div class="row justify-content-center">
					<div class="col-lg-8 text-center">
						<h1 class="text-white mb-3">Bitcomm Insights</h1>
						<p class="lead text-white-50">
							Expert insights on IT solutions, digital transformation trends, and technology best practices for Kenyan businesses.
						</p>
					</div>
				</div>
			</div>
		</section>

		<style>
			.blog-hero-section {
				background: linear-gradient(135deg, #2C1D6D 0%, #3D2E8F 100%);
				padding: 60px 0;
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

			.blog-hero-section .container {
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

			.blog-card {
				transition: all 0.3s ease;
				height: 100%;
			}

			.blog-card:hover {
				transform: translateY(-5px);
				box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
			}

			.blog-img-container {
				overflow: hidden;
				position: relative;
			}

			.blog-img-container img {
				transition: transform 0.3s ease;
			}

			.blog-card:hover .blog-img-container img {
				transform: scale(1.05);
			}

			.category-badge {
				position: absolute;
				top: 15px;
				right: 15px;
				background-color: rgba(44, 29, 109, 0.9);
				color: white;
				padding: 5px 10px;
				border-radius: 3px;
				font-size: 0.8rem;
				z-index: 2;
			}

			.post-meta {
				font-size: 0.85rem;
				color: #6c757d;
			}

			.post-meta i {
				color: #3D2E8F;
				margin-right: 5px;
			}

			.featured-post-card {
				border-radius: 5px;
				overflow: hidden;
			}

			.featured-post-image {
				height: 350px;
				background-size: cover;
				background-position: center;
				position: relative;
			}

			.featured-content-overlay {
				position: absolute;
				bottom: 0;
				left: 0;
				right: 0;
				padding: 2rem;
				background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
				color: white;
			}
		</style>

		<section class="blog-content py-5">
			<div class="container">
				<?php
				$featured_args = array(
					'posts_per_page' => 1,
					'meta_key' => 'featured_post',
					'meta_value' => '1',
					'ignore_sticky_posts' => 1
				);
				$featured_query = new WP_Query($featured_args);

				// If we have a featured post
				if ($featured_query->have_posts()) :
				?>
				<!-- Featured Post Section -->
				<div class="row mb-5">
					<div class="col-12 text-center mb-4">
						<h2 class="section-title">Featured Article</h2>
					</div>
					<?php while ($featured_query->have_posts()) : $featured_query->the_post(); ?>
					<div class="col-12">
						<div class="featured-post-card shadow-sm">
							<div class="featured-post-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_template_directory_uri() . '/images/blog-placeholder.jpg'; ?>');">
								<div class="featured-content-overlay">
									<h2 class="mb-3"><a href="<?php the_permalink(); ?>" class="text-white text-decoration-none"><?php the_title(); ?></a></h2>
									<div class="post-meta text-white-50 mb-2">
										<span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
										<span class="ms-3"><i class="far fa-user"></i> <?php the_author(); ?></span>
										<?php if (has_category()) : ?>
										<span class="ms-3">
											<i class="far fa-folder"></i> 
											<?php 
											$categories = get_the_category();
											echo esc_html($categories[0]->name);
											?>
										</span>
										<?php endif; ?>
									</div>
									<div class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></div>
									<a href="<?php the_permalink(); ?>" class="btn btn-primary mt-3">Read More</a>
								</div>
							</div>
						</div>
					</div>
					<?php 
					endwhile;
					wp_reset_postdata(); 
					?>
				</div>
				<?php endif; ?>

				<!-- Latest Articles -->
				<div class="row mb-4">
					<div class="col-12 text-center">
						<h2 class="section-title">Latest Insights</h2>
					</div>
				</div>

				<div class="row g-4">
					<?php
					// If we had a featured post, exclude it from the main query
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$main_post_args = array(
						'paged' => $paged,
						'ignore_sticky_posts' => 1
					);

					// If we had a featured post, exclude it
					if ($featured_query->have_posts()) {
						$main_post_args['post__not_in'] = array($featured_query->posts[0]->ID);
					}

					// Use the modified main query
					$main_query = new WP_Query($main_post_args);

					if ($main_query->have_posts()) :
						while ($main_query->have_posts()) :
							$main_query->the_post();
							$categories = get_the_category();
							?>
							<div class="col-md-6 col-lg-4">
								<article class="blog-card card border-0 shadow-sm h-100">
									<div class="blog-img-container">
										<?php if (has_post_thumbnail()) : ?>
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('medium_large', array('class' => 'card-img-top')); ?>
											</a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>">
												<img src="<?php echo get_template_directory_uri(); ?>/images/blog-placeholder.jpg" class="card-img-top" alt="<?php the_title_attribute(); ?>">
											</a>
										<?php endif; ?>

										<?php if (!empty($categories)) : ?>
											<span class="category-badge"><?php echo esc_html($categories[0]->name); ?></span>
										<?php endif; ?>
									</div>

									<div class="card-body">
										<div class="post-meta mb-3">
											<span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
										</div>
										<h3 class="card-title h5">
											<a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark"><?php the_title(); ?></a>
										</h3>
										<div class="card-text mb-3"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
										<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">Read More</a>
									</div>
								</article>
							</div>
							<?php
						endwhile;
					else :
						?>
						<div class="col-12 text-center">
							<p>No posts found. Check back soon for updates!</p>
						</div>
						<?php
					endif;
					?>
				</div>

				<!-- Pagination -->
				<div class="row mt-5">
					<div class="col-12">
						<nav class="d-flex justify-content-center" aria-label="Page navigation">
							<?php
							// Custom pagination
							$pagination = paginate_links(array(
								'total' => $main_query->max_num_pages,
								'current' => max(1, get_query_var('paged')),
								'prev_text' => '&laquo; Previous',
								'next_text' => 'Next &raquo;',
								'type' => 'array'
							));

							if (!empty($pagination)) :
							?>
							<ul class="pagination">
								<?php foreach ($pagination as $page_link) : ?>
									<li class="page-item <?php echo strpos($page_link, 'current') !== false ? 'active' : ''; ?>">
										<?php echo str_replace('page-numbers', 'page-link', $page_link); ?>
									</li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</nav>
					</div>
				</div>

				<?php wp_reset_postdata(); ?>

				<!-- Call to Action -->
				<div class="row mt-5">
					<div class="col-12">
						<div class="cta-box bg-light p-4 p-md-5 rounded shadow-sm text-center">
							<h3>Need Expert IT Consultation?</h3>
							<p class="lead mb-4">Let our team help you navigate the digital transformation journey for your business.</p>
							<a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-lg rounded-pill px-4">Contact Us Today</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
