<?php
/**
 * Template Name: Privacy Policy Page
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
                        // Get Privacy Policy sections from CPT
                        $privacy_sections = new WP_Query(array(
                            'post_type' => 'legal_sections',
                            'meta_query' => array(
                                array(
                                    'key' => '_legal_page_type',
                                    'value' => 'privacy-policy',
                                    'compare' => '='
                                )
                            ),
                            'meta_key' => '_section_order',
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        ));
                        
                        if ($privacy_sections->have_posts()) {
                            while ($privacy_sections->have_posts()) {
                                $privacy_sections->the_post();
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
                            $introduction = get_post_meta($post_id, '_privacy_introduction', true);
                            if (!empty($introduction)) :
                                echo wp_kses_post($introduction);
                            else :
                            ?>
                            <p>Bitcomm Technologies ("we," "our," or "us") respects your privacy and is committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights and how the law protects you.</p>
                            <p>This privacy policy applies to personal data we collect from you when you use our website, contact us, or engage with our services.</p>
                            <?php 
                            endif;
                            ?>
                        </section>
                        <?php
                        endif; // End of !$use_main_editor check
                        
                        // Add reusable legal clauses
                        $legal_clauses = new WP_Query(array(
                            'post_type' => 'legal_clauses',
                            'meta_query' => array(
                                array(
                                    'key' => '_applicable_pages',
                                    'value' => 'privacy-policy',
                                    'compare' => 'LIKE'
                                )
                            ),
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        ));
                        
                        if ($legal_clauses->have_posts()) {
                            echo '<div class="legal-clauses-section">';
                            while ($legal_clauses->have_posts()) {
                                $legal_clauses->the_post();
                                $clause_type = get_post_meta(get_the_ID(), '_clause_type', true);
                                
                                echo '<div class="legal-clause clause-' . esc_attr($clause_type) . '">';
                                echo '<h3 class="clause-title">' . get_the_title() . '</h3>';
                                echo '<div class="clause-content">' . get_the_content() . '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                            wp_reset_postdata();
                        }
                         ?>
                         </section>
                         
                         <style>
                         .legal-section {
                             margin-bottom: 2.5rem;
                             padding: 1.5rem;
                             background: #f8f9fa;
                             border-left: 4px solid #007bff;
                             border-radius: 0.375rem;
                         }
                         
                         .legal-section .section-title {
                             color: #2c3e50;
                             font-size: 1.5rem;
                             font-weight: 600;
                             margin-bottom: 1rem;
                             padding-bottom: 0.5rem;
                             border-bottom: 2px solid #e9ecef;
                         }
                         
                         .legal-section .section-content {
                             line-height: 1.7;
                             color: #495057;
                         }
                         
                         .legal-section .section-content h3 {
                             color: #495057;
                             font-size: 1.2rem;
                             font-weight: 600;
                             margin-top: 1.5rem;
                             margin-bottom: 0.75rem;
                         }
                         
                         .legal-section .section-content ul {
                             margin: 1rem 0;
                             padding-left: 1.5rem;
                         }
                         
                         .legal-section .section-content li {
                             margin-bottom: 0.5rem;
                         }
                         
                         .legal-clauses-section {
                             margin-top: 3rem;
                             padding-top: 2rem;
                             border-top: 3px solid #dee2e6;
                         }
                         
                         .legal-clause {
                             margin-bottom: 2rem;
                             padding: 1.25rem;
                             background: #ffffff;
                             border: 1px solid #dee2e6;
                             border-radius: 0.375rem;
                             box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                         }
                         
                         .legal-clause .clause-title {
                             color: #6c757d;
                             font-size: 1.1rem;
                             font-weight: 600;
                             margin-bottom: 0.75rem;
                         }
                         
                         .legal-clause .clause-content {
                             color: #6c757d;
                             font-size: 0.95rem;
                             line-height: 1.6;
                         }
                         
                         .legal-clause.clause-contact-info {
                             border-left: 4px solid #28a745;
                         }
                         
                         .legal-clause.clause-updates {
                             border-left: 4px solid #ffc107;
                         }
                         
                         .legal-clause.clause-data-collection {
                             border-left: 4px solid #dc3545;
                         }
                         
                         .legal-clause.clause-disclaimer {
                             border-left: 4px solid #6f42c1;
                         }
                         </style>

                        <section class="mb-5">
                            <h2>The Data We Collect About You</h2>
                            <?php 
                            $data_collect = get_post_meta($post_id, '_privacy_data_collect', true);
                            if (!empty($data_collect)) :
                                echo wp_kses_post($data_collect);
                            else :
                            ?>
                            <p>Personal data means any information about an individual from which that person can be identified. We may collect, use, store and transfer different kinds of personal data about you, including:</p>
                            <ul>
                                <li><strong>Identity Data</strong> - includes first name, last name, username or similar identifier, title.</li>
                                <li><strong>Contact Data</strong> - includes billing address, delivery address, email address and telephone numbers.</li>
                                <li><strong>Technical Data</strong> - includes internet protocol (IP) address, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform, and other technology on the devices you use to access this website.</li>
                                <li><strong>Usage Data</strong> - includes information about how you use our website and services.</li>
                                <li><strong>Marketing and Communications Data</strong> - includes your preferences in receiving marketing from us and our third parties and your communication preferences.</li>
                            </ul>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>How We Collect Your Personal Data</h2>
                            <?php 
                            $how_collect = get_post_meta($post_id, '_privacy_how_collect', true);
                            if (!empty($how_collect)) :
                                echo wp_kses_post($how_collect);
                            else :
                            ?>
                            <p>We use different methods to collect data from and about you including through:</p>
                            <ul>
                                <li><strong>Direct interactions</strong> - You may give us your Identity and Contact Data by filling in forms or by corresponding with us by post, phone, email or otherwise.</li>
                                <li><strong>Automated technologies or interactions</strong> - As you interact with our website, we may automatically collect Technical Data about your equipment, browsing actions and patterns.</li>
                                <li><strong>Third parties</strong> - We may receive personal data about you from various third parties such as analytics providers or advertising networks.</li>
                            </ul>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>How We Use Your Personal Data</h2>
                            <?php 
                            $how_use = get_post_meta($post_id, '_privacy_how_use', true);
                            if (!empty($how_use)) :
                                echo wp_kses_post($how_use);
                            else :
                            ?>
                            <p>We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in the following circumstances:</p>
                            <ul>
                                <li>Where we need to perform the contract we are about to enter into or have entered into with you.</li>
                                <li>Where it is necessary for our legitimate interests (or those of a third party) and your interests and fundamental rights do not override those interests.</li>
                                <li>Where we need to comply with a legal obligation.</li>
                                <li>Where you have provided consent for us to process your data for a specific purpose.</li>
                            </ul>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Data Security</h2>
                            <?php 
                            $data_security = get_post_meta($post_id, '_privacy_data_security', true);
                            if (!empty($data_security)) :
                                echo wp_kses_post($data_security);
                            else :
                            ?>
                            <p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used or accessed in an unauthorized way, altered or disclosed. In addition, we limit access to your personal data to those employees, agents, contractors and other third parties who have a business need to know.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Data Retention</h2>
                            <?php 
                            $data_retention = get_post_meta($post_id, '_privacy_data_retention', true);
                            if (!empty($data_retention)) :
                                echo wp_kses_post($data_retention);
                            else :
                            ?>
                            <p>We will only retain your personal data for as long as reasonably necessary to fulfill the purposes we collected it for, including for the purposes of satisfying any legal, regulatory, tax, accounting or reporting requirements.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Your Legal Rights</h2>
                            <?php 
                            $legal_rights = get_post_meta($post_id, '_privacy_legal_rights', true);
                            if (!empty($legal_rights)) :
                                echo wp_kses_post($legal_rights);
                            else :
                            ?>
                            <p>Under certain circumstances, you have rights under data protection laws in relation to your personal data, including:</p>
                            <ul>
                                <li>Request access to your personal data.</li>
                                <li>Request correction of your personal data.</li>
                                <li>Request erasure of your personal data.</li>
                                <li>Object to processing of your personal data.</li>
                                <li>Request restriction of processing your personal data.</li>
                                <li>Request transfer of your personal data.</li>
                                <li>Right to withdraw consent.</li>
                            </ul>
                            <p>If you wish to exercise any of these rights, please contact us.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Changes to This Privacy Policy</h2>
                            <?php 
                            $changes = get_post_meta($post_id, '_privacy_changes', true);
                            if (!empty($changes)) :
                                echo wp_kses_post($changes);
                            else :
                            ?>
                            <p>We reserve the right to update this privacy policy at any time. We will notify you of any changes by posting the new privacy policy on this page and updating the "last updated" date.</p>
                            <p>Last updated: <?php echo date('F j, Y'); ?></p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Contact Us</h2>
                            <?php 
                            $contact = get_post_meta($post_id, '_privacy_contact', true);
                            if (!empty($contact)) :
                                echo wp_kses_post($contact);
                            else :
                            ?>
                            <p>If you have any questions about this privacy policy or our privacy practices, please contact us:</p>
                            <p>Bitcomm Technologies<br>
                            Nairobi, Kenya<br>
                            Email: <?php echo esc_html(get_theme_mod('footer_email', 'kennedychongwobitcomm@gmail.com')); ?><br>
                            Phone: <?php echo esc_html(get_theme_mod('footer_phone', '+254 738 788010')); ?></p>
                            <?php endif; ?>
                        </section>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="legal-sidebar p-4 bg-light rounded">
                        <h3>Legal Pages</h3>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="active">Privacy Policy</a></li>
                            <li><a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">Terms of Service</a></li>
                            <li><a href="<?php echo esc_url(home_url('/cookie-policy')); ?>">Cookie Policy</a></li>
                        </ul>
                        
                        <hr>
                        
                        <h4>Need Help?</h4>
                        <p>If you have any questions about our policies or your data, please don't hesitate to contact us.</p>
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