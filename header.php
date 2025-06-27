<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header class="site-header fixed-top">
        <!-- Top Bar -->
        <div class="top-bar bg-dark text-white py-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 d-none d-md-flex">
                        <div class="top-contact-info d-flex align-items-center">
                            <div class="contact-item me-4">
                                <a href="tel:+254738788010" class="text-white">
                                    <i class="fas fa-phone-alt me-1"></i> +254 738 788010
                                </a>
                            </div>
                            <div class="contact-item me-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#contactModal" class="text-white">
                                    <i class="fas fa-envelope me-1"></i> <?php echo esc_html( get_theme_mod( 'footer_email', 'kennedychongwobitcomm@gmail.com' ) ); ?>
                                </a>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-clock me-1"></i> Mon-Fri: 8am - 5pm
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 text-center text-md-end">
                        <div class="top-social-links">
                            <a href="#" class="text-white me-2" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-white me-2" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white me-2" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-white" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    
                    if (has_custom_logo()) {
                        echo '<a class="navbar-brand py-2" href="' . esc_url(home_url('/')) . '">
                        <img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" height="50">
                        </a>';
                    } else {
                        echo '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
                    }
                ?>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-1',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav ms-auto',
                        'fallback_cb'    => '__return_false',
                        'depth'          => 2,
                        'walker'         => new WP_Bootstrap_Navwalker(),
                    ));
                    ?>
                    <div class="header-button ms-lg-3">
                        <a href="/get-your-solution" class="btn btn-primary btn-sm rounded-pill px-3">Get Your Solution</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div id="content" class="site-content">

<style>
/* Header Styles */
.top-bar {
    font-size: 0.85rem;
}

.top-bar a {
    text-decoration: none;
    transition: color 0.3s ease;
}

.top-bar a:hover {
    color: rgba(255, 255, 255, 0.8) !important;
}

.top-social-links a {
    font-size: 0.9rem;
    transition: transform 0.3s ease;
    display: inline-block;
}

.top-social-links a:hover {
    transform: translateY(-2px);
}

.navbar {
    background-color: #2C1D6D !important; 
    background: linear-gradient(to right, #2C1D6D, #3D2E8F);
    padding: 0.5rem 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    padding-left: 0;
}

.navbar-nav .nav-link {
    color: var(--text-light) !important;
    margin-right: 0.5rem;
    padding: 1rem 0.8rem;
    font-weight: 500;
    position: relative;
    transition: all 0.3s ease;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
    color: rgba(255, 255, 255, 0.8) !important;
}

.navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    background: #fff;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    transition: width 0.3s ease;
}

.navbar-nav .nav-link:hover::after,
.navbar-nav .nav-link.active::after {
    width: 30px;
}

/* Enable dropdown on hover */
@media (min-width: 992px) {
    .navbar-nav .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
}

.dropdown-menu {
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 0.5rem;
}

.dropdown-item {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.dropdown-item:hover,
.dropdown-item:focus {
    background-color: rgba(44, 29, 109, 0.1);
    color: #2C1D6D;
}

.header-button .btn-primary {
    background-color: #fff;
    border-color: #fff;
    color: #2C1D6D;
    font-weight: 600;
    padding: 0.6rem 1.2rem;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.header-button .btn-primary:hover {
    background-color: rgba(255, 255, 255, 0.9);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
