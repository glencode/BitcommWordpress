<?php
/**
 * Template Name: Cookie Policy Page
 *
 * @package itsulu-custom
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container py-5">
            <header class="page-header mb-5">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header>

            <div class="row">
                <div class="col-lg-8">
                    <div class="page-content legal-content">
                        <?php
                        // Get Cookie Policy sections from CPT
                        $cookie_sections = new WP_Query(array(
                            'post_type' => 'legal_sections',
                            'meta_query' => array(
                                array(
                                    'key' => '_legal_page_type',
                                    'value' => 'cookie-policy',
                                    'compare' => '='
                                )
                            ),
                            'meta_key' => '_section_order',
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        ));
                        
                        if ($cookie_sections->have_posts()) {
                            while ($cookie_sections->have_posts()) {
                                $cookie_sections->the_post();
                                $section_order = get_post_meta(get_the_ID(), '_section_order', true);
                                $is_required = get_post_meta(get_the_ID(), '_is_required', true);
                                
                                echo '<div class="legal-section" data-order="' . esc_attr($section_order) . '">';
                                echo '<h2 class="section-title">' . get_the_title() . '</h2>';
                                echo '<div class="section-content">' . get_the_content() . '</div>';
                                echo '</div>';
                            }
                            wp_reset_postdata();
                        } else {
                            // Fallback to original content if no CPT sections found
                            // Check if we should use the main content editor content
                            $use_main_editor = false;
                            if (have_posts()) :
                                while (have_posts()) : the_post();
                                    if (!empty(get_the_content())) :
                                        $use_main_editor = true;
                                        the_content();
                                    endif;
                                endwhile;
                            endif;
                            
                            // If not using main editor content, use the custom fields or fallback to static content
                            if (!$use_main_editor) :
                                // Get the post ID
                                $post_id = get_the_ID();
                            ?>
                            <section class="mb-5">
                                <h2>Introduction</h2>
                                <?php 
                                $introduction = get_post_meta($post_id, '_cookie_introduction', true);
                                if (!empty($introduction)) :
                                    echo wp_kses_post($introduction);
                                else :
                                ?>
                                <p>Bitcomm Technologies ("we," "our," or "us") uses cookies and similar technologies on our website at bitcomm.co.ke. This Cookie Policy explains how we use cookies, what types of cookies we use, and how you can control them.</p>
                                <p>By using our website, you agree to our use of cookies as described in this policy.</p>
                                <?php endif; ?>
                            </section>

                        <section class="mb-5">
                            <h2>What Are Cookies?</h2>
                            <?php 
                            $what_are = get_post_meta($post_id, '_cookie_what_are', true);
                            if (!empty($what_are)) :
                                echo wp_kses_post($what_are);
                            else :
                            ?>
                            <p>Cookies are small text files that are stored on your computer or mobile device when you visit a website. They allow the website to recognize your device and remember if you have been to the website before. Cookies are a common technology used by virtually all websites.</p>
                            <p>Cookies serve many functions, including allowing websites to work more efficiently, enabling website owners to learn about user behavior, and providing a more personalized browsing experience.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>How We Use Cookies</h2>
                            <?php 
                            $how_we_use = get_post_meta($post_id, '_cookie_how_we_use', true);
                            if (!empty($how_we_use)) :
                                echo wp_kses_post($how_we_use);
                            else :
                            ?>
                            <p>We use cookies for a variety of reasons, including:</p>
                            <ul>
                                <li><strong>Essential cookies:</strong> These cookies are necessary for our website to function properly. They enable basic functions like page navigation and access to secure areas of the website. The website cannot function properly without these cookies.</li>
                                <li><strong>Performance cookies:</strong> These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously. They help us improve the functionality of our website.</li>
                                <li><strong>Functionality cookies:</strong> These cookies allow our website to remember choices you make (such as your language preference or region) and provide enhanced, more personal features.</li>
                                <li><strong>Targeting cookies:</strong> These cookies are used to deliver advertisements more relevant to you and your interests. They are also used to limit the number of times you see an advertisement as well as help measure the effectiveness of advertising campaigns.</li>
                            </ul>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Types of Cookies We Use</h2>
                            <?php 
                            $types = get_post_meta($post_id, '_cookie_types', true);
                            if (!empty($types)) :
                                echo wp_kses_post($types);
                            else :
                            ?>
                            <p>Our website uses the following types of cookies:</p>
                            
                            <h3>First-Party Cookies</h3>
                            <p>These cookies are set by us and are used to enhance your experience on our website.</p>
                            
                            <h3>Third-Party Cookies</h3>
                            <p>These cookies are set by third parties and may be used for various purposes, including analytics and advertising. We have limited control over these cookies.</p>
                            
                            <h3>Session Cookies</h3>
                            <p>These cookies are temporary and are deleted when you close your browser.</p>
                            
                            <h3>Persistent Cookies</h3>
                            <p>These cookies remain on your device for a set period or until you delete them manually.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Specific Cookies We Use</h2>
                            <?php 
                            $specific = get_post_meta($post_id, '_cookie_specific', true);
                            if (!empty($specific)) :
                                echo wp_kses_post($specific);
                            else :
                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cookie Name</th>
                                        <th>Type</th>
                                        <th>Purpose</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>wordpress_*</td>
                                        <td>Essential</td>
                                        <td>WordPress cookies for authentication</td>
                                        <td>Session</td>
                                    </tr>
                                    <tr>
                                        <td>_ga</td>
                                        <td>Performance</td>
                                        <td>Used by Google Analytics to distinguish users</td>
                                        <td>2 years</td>
                                    </tr>
                                    <tr>
                                        <td>_gid</td>
                                        <td>Performance</td>
                                        <td>Used by Google Analytics to distinguish users</td>
                                        <td>24 hours</td>
                                    </tr>
                                    <tr>
                                        <td>_gat</td>
                                        <td>Performance</td>
                                        <td>Used by Google Analytics to throttle request rate</td>
                                        <td>1 minute</td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Managing Cookies</h2>
                            <?php 
                            $managing = get_post_meta($post_id, '_cookie_managing', true);
                            if (!empty($managing)) :
                                echo wp_kses_post($managing);
                            else :
                            ?>
                            <p>Most web browsers allow you to control cookies through their settings. You can usually find these settings in the "Options" or "Preferences" menu of your browser. You can also consult the "Help" section of your browser to learn more about managing cookies.</p>
                            <p>You can delete cookies that are already on your computer, and you can set your browser to prevent them from being placed. However, please note that disabling cookies may limit your use of certain features or functions on our website.</p>
                            <p>To find out more about cookies, including how to see what cookies have been set and how to manage and delete them, visit <a href="https://www.allaboutcookies.org" target="_blank">www.allaboutcookies.org</a>.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Analytics</h2>
                            <?php 
                            $analytics = get_post_meta($post_id, '_cookie_analytics', true);
                            if (!empty($analytics)) :
                                echo wp_kses_post($analytics);
                            else :
                            ?>
                            <p>We use Google Analytics to help us understand how our users interact with our website. Google Analytics uses cookies to collect information and generate reports about the use of the website. The information generated is used to create reports about the use of our website.</p>
                            <p>Google may also transfer this information to third parties where required to do so by law, or where such third parties process the information on Google's behalf.</p>
                            <p>You can opt out of Google Analytics without affecting how you visit our site. For more information on how to opt out of being tracked by Google Analytics across all websites you use, visit <a href="https://tools.google.com/dlpage/gaoptout" target="_blank">https://tools.google.com/dlpage/gaoptout</a>.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Changes to This Cookie Policy</h2>
                            <?php 
                            $changes = get_post_meta($post_id, '_cookie_changes', true);
                            if (!empty($changes)) :
                                echo wp_kses_post($changes);
                            else :
                            ?>
                            <p>We may update our Cookie Policy from time to time. We will notify you of any changes by posting the new Cookie Policy on this page.</p>
                            <p>We advise you to review this Cookie Policy periodically for any changes. Changes to this Cookie Policy are effective when they are posted on this page.</p>
                            <p>Last updated: <?php echo date('F j, Y'); ?></p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Contact Us</h2>
                            <?php 
                            $contact = get_post_meta($post_id, '_cookie_contact', true);
                            if (!empty($contact)) :
                                echo wp_kses_post($contact);
                            else :
                            ?>
                            <p>If you have any questions about our Cookie Policy, please contact us:</p>
                            <p>Bitcomm Technologies<br>
                            Nairobi, Kenya<br>
                            Email: <?php echo esc_html(get_theme_mod('footer_email', 'kennedychongwobitcomm@gmail.com')); ?><br>
                            Phone: <?php echo esc_html(get_theme_mod('footer_phone', '+254 738 788010')); ?></p>
                            <?php endif; ?>
                        </section>
                        <?php endif; // End of if (!$use_main_editor) ?>
                    <?php } // Closing brace for the main 'else' block (fallback for if CPTs not found) ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="legal-sidebar p-4 bg-light rounded">
                        <h3>Legal Pages</h3>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a></li>
                            <li><a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">Terms of Service</a></li>
                            <li><a href="<?php echo esc_url(home_url('/cookie-policy')); ?>" class="active">Cookie Policy</a></li>
                        </ul>
                        
                        <hr>
                        
                        <h4>Need Help?</h4>
                        <p>If you have any questions about our policies or your rights, please don't hesitate to contact us.</p>
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
.legal-content h2 {
    color: #2C1D6D;
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-size: 1.75rem;
}

.legal-content h3 {
    color: #2C1D6D;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    font-size: 1.4rem;
}

.legal-content p, .legal-content li {
    font-size: 16px;
    line-height: 1.6;
    color: #333;
}

.legal-content ul {
    margin-bottom: 1.5rem;
}

.legal-content section {
    border-bottom: 1px solid #eee;
    padding-bottom: 1.5rem;
}

.legal-content section:last-child {
    border-bottom: none;
}

.legal-content table {
    margin-bottom: 1.5rem;
    font-size: 14px;
}

.legal-content table th {
    background-color: #f8f9fa;
}

.legal-sidebar {
    position: sticky;
    top: 2rem;
    border-left: 4px solid #2C1D6D;
}

.legal-sidebar h3 {
    color: #2C1D6D;
    margin-bottom: 1rem;
}

.legal-sidebar ul {
    margin-bottom: 1.5rem;
}

.legal-sidebar li {
    margin-bottom: 0.5rem;
}

.legal-sidebar a {
    color: #555;
    text-decoration: none;
    display: block;
    padding: 0.5rem 0;
    transition: all 0.3s ease;
}

.legal-sidebar a:hover, .legal-sidebar a.active {
    color: #2C1D6D;
    font-weight: 500;
}

@media (max-width: 991px) {
    .legal-sidebar {
        position: static;
        margin-top: 2rem;
    }
}
</style>

<?php get_footer(); ?>