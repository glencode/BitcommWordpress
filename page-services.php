<?php
/**
 * Template Name: Services Page
 */

get_header(); ?>

<?php itsulu_breadcrumbs(); ?>

<!-- Hero Section -->
<section class="services-hero-section py-6 position-relative overflow-hidden">
    <div class="hero-bg-gradient"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-9 text-center mx-auto">
                <p class="lead text-white-50 mb-0">
                    We offer a comprehensive range of IT solutions to transform your business and drive digital innovation. Our expert team delivers cutting-edge technology services tailored to your specific needs.
                </p>
            </div>
            <div class="col-lg-3 d-none d-lg-block px-0">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/hero2.jpg'); ?>" 
                     alt="IT Services" 
                     class="img-fluid rounded-lg shadow-lg w-100"
                     style="max-height: 220px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<style>
.services-hero-section {
    background: linear-gradient(135deg, #2C1D6D 0%, #3D2E8F 100%);
    min-height: 35vh;
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

.services-hero-section .container {
    z-index: 2;
}

.breadcrumb-nav {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.breadcrumb-item a {
    color: #2C1D6D;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #3D2E8F;
}

.breadcrumb-item.active {
    color: #6c757d;
}
</style>

<section class="py-12 bg-white">
  <div class="container mx-auto px-4">
    <div class="row g-4">
      <?php
      $services = new WP_Query([
        'post_type' => 'itsulu_service',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
      ]);

      if ($services->have_posts()) :
        $index = 0;
        while ($services->have_posts()) : $services->the_post();
          $modal_id = 'serviceModal' . $index;
          $icon = get_field('service_icon') ?: 'fa-laptop-code';
          $short_desc = get_field('service_short_description') ?: get_the_excerpt();
          $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_template_directory_uri() . '/assets/images/placeholder.jpg';
      ?>
        <div class="col-md-4">
          <a href="#<?php echo $modal_id; ?>" data-bs-toggle="modal" class="d-block text-decoration-none group">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100 service-card">
              <div class="card-img-container">
                <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid object-fit-cover" style="height: 200px; width: 100%;">
                <div class="card-img-overlay d-flex align-items-center justify-content-center">
                  <span class="btn btn-light">View Details</span>
                </div>
              </div>
              <div class="p-4 text-center">
                <div class="text-[#7b4c2f] text-3xl mb-2 service-icon">
                  <i class="fas <?php echo esc_attr($icon); ?>"></i>
                </div>
                <h3 class="text-xl font-bold text-[#3e2b23] mb-2"><?php the_title(); ?></h3>
                <p class="text-[#6a4d3b] text-sm"><?php echo wp_trim_words($short_desc, 15, '...'); ?></p>
              </div>
            </div>
          </a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" aria-labelledby="<?php echo $modal_id; ?>Label" aria-hidden="true" inert>
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="<?php echo $modal_id; ?>Label"><?php the_title(); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-4">
                <div class="row">
                  <div class="col-md-4 mb-3 mb-md-0">
                    <img src="<?php echo esc_url($featured_image); ?>" 
                         class="img-fluid rounded w-100" 
                         alt="<?php the_title_attribute(); ?>"
                         style="max-height: 200px; object-fit: cover;">
                  </div>
                  <div class="col-md-8">
                    <div class="text-[#3e2b23]">
                      <?php the_content(); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary rounded-pill me-2">View Full Service</a>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary rounded-pill">Get a Quote</a>
              </div>
            </div>
          </div>
        </div>

      <?php 
        $index++;
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>
</section>

<style>
.service-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover {
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

.service-card:hover .card-img-overlay {
    opacity: 1;
}

.service-card img {
    transition: transform 0.3s ease;
}

.service-card:hover img {
    transform: scale(1.05);
}

.service-icon {
    transition: transform 0.3s ease, color 0.3s ease;
}

.service-card:hover .service-icon {
    transform: scale(1.15);
    color: #2C1D6D !important;
}
</style>

<?php get_footer(); ?>
