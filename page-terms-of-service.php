<?php
/**
 * Template Name: Terms of Service Page
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
                        // Get Terms of Service sections from CPT
                        $terms_sections = new WP_Query(array(
                            'post_type' => 'legal_sections',
                            'meta_query' => array(
                                array(
                                    'key' => '_legal_page_type',
                                    'value' => 'terms-of-service',
                                    'compare' => '='
                                )
                            ),
                            'meta_key' => '_section_order',
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        ));
                        
                        if ($terms_sections->have_posts()) {
                            while ($terms_sections->have_posts()) {
                                $terms_sections->the_post();
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
                                $introduction = get_post_meta($post_id, '_terms_introduction', true);
                                if (!empty($introduction)) :
                                    echo wp_kses_post($introduction);
                                else :
                                ?>
                                <p>Welcome to Bitcomm Technologies ("Company", "we", "our", "us")! These Terms of Service ("Terms") govern your use of our website at bitcomm.co.ke (the "Service") and any related services offered by Bitcomm Technologies.</p>
                                <p>By accessing or using our Service, you agree to be bound by these Terms. If you disagree with any part of the Terms, then you do not have permission to access the Service.</p>
                                <?php endif; ?>
                            </section>

                        <section class="mb-5">
                            <h2>Communications</h2>
                            <?php 
                            $communications = get_post_meta($post_id, '_terms_communications', true);
                            if (!empty($communications)) :
                                echo wp_kses_post($communications);
                            else :
                            ?>
                            <p>By creating an account or contacting us through our website, you agree to receive communications from us, including via email, text message, or phone calls. You can opt out of certain communications by following the unsubscribe instructions in the communication received or by contacting us directly.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Content</h2>
                            <?php 
                            $content = get_post_meta($post_id, '_terms_content', true);
                            if (!empty($content)) :
                                echo wp_kses_post($content);
                            else :
                            ?>
                            <p>Our Service allows you to view and access certain content that belongs to Bitcomm Technologies or other third parties. Content on the Service, including but not limited to text, graphics, software, photographs, images, videos, audio, and other material, is protected by copyright, trademark, patent, and other intellectual property laws.</p>
                            <p>You agree not to download, copy, modify, distribute, transmit, display, perform, reproduce, publish, license, create derivative works from, transfer, or sell any information or content obtained from our Service without our prior written consent.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Prohibited Uses</h2>
                            <?php 
                            $prohibited = get_post_meta($post_id, '_terms_prohibited', true);
                            if (!empty($prohibited)) :
                                echo wp_kses_post($prohibited);
                            else :
                            ?>
                            <p>You agree not to use the Service:</p>
                            <ul>
                                <li>In any way that violates any applicable national, federal, state, local or international law or regulation.</li>
                                <li>To engage in any conduct that restricts or inhibits anyone's use or enjoyment of the Service.</li>
                                <li>To impersonate or attempt to impersonate the Company, a Company employee, another user, or any other person or entity.</li>
                                <li>To engage in any other conduct that restricts or inhibits anyone's use or enjoyment of the Service, or which may harm the Company or users of the Service or expose them to liability.</li>
                            </ul>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Products and Services</h2>
                            <?php 
                            $products = get_post_meta($post_id, '_terms_products', true);
                            if (!empty($products)) :
                                echo wp_kses_post($products);
                            else :
                            ?>
                            <p>Bitcomm Technologies offers various IT solutions and services. All descriptions of products and services are subject to change at any time without notice, at our sole discretion.</p>
                            <p>We reserve the right to limit the sales of our products or services to any person, geographic region, or jurisdiction. We may exercise this right on a case-by-case basis.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Accuracy of Information</h2>
                            <?php 
                            $accuracy = get_post_meta($post_id, '_terms_accuracy', true);
                            if (!empty($accuracy)) :
                                echo wp_kses_post($accuracy);
                            else :
                            ?>
                            <p>We make every effort to ensure that the information provided on our website is accurate and up to date. However, we do not warrant that product descriptions or other content on the Service is accurate, complete, reliable, current, or error-free.</p>
                            <p>If a product or service offered by us is not as described, your sole remedy is to contact us and seek resolution.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Third-Party Links</h2>
                            <?php 
                            $third_party = get_post_meta($post_id, '_terms_third_party', true);
                            if (!empty($third_party)) :
                                echo wp_kses_post($third_party);
                            else :
                            ?>
                            <p>Our Service may contain links to third-party websites or services that are not owned or controlled by Bitcomm Technologies.</p>
                            <p>Bitcomm Technologies has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third-party websites or services. We do not warrant the offerings of any of these entities/individuals or their websites.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Termination</h2>
                            <?php 
                            $termination = get_post_meta($post_id, '_terms_termination', true);
                            if (!empty($termination)) :
                                echo wp_kses_post($termination);
                            else :
                            ?>
                            <p>We may terminate or suspend your access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach these Terms.</p>
                            <p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity, and limitations of liability.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Limitation of Liability</h2>
                            <?php 
                            $liability = get_post_meta($post_id, '_terms_liability', true);
                            if (!empty($liability)) :
                                echo wp_kses_post($liability);
                            else :
                            ?>
                            <p>In no event shall Bitcomm Technologies, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from:</p>
                            <ul>
                                <li>Your access to or use of or inability to access or use the Service;</li>
                                <li>Any content obtained from the Service; or</li>
                                <li>Unauthorized access, use, or alteration of your transmissions or content.</li>
                            </ul>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Disclaimer</h2>
                            <?php 
                            $disclaimer = get_post_meta($post_id, '_terms_disclaimer', true);
                            if (!empty($disclaimer)) :
                                echo wp_kses_post($disclaimer);
                            else :
                            ?>
                            <p>Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement, or course of performance.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Governing Law</h2>
                            <?php 
                            $governing_law = get_post_meta($post_id, '_terms_governing_law', true);
                            if (!empty($governing_law)) :
                                echo wp_kses_post($governing_law);
                            else :
                            ?>
                            <p>These Terms shall be governed and construed in accordance with the laws of Kenya, without regard to its conflict of law provisions.</p>
                            <p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect.</p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Changes to Terms</h2>
                            <?php 
                            $changes = get_post_meta($post_id, '_terms_changes', true);
                            if (!empty($changes)) :
                                echo wp_kses_post($changes);
                            else :
                            ?>
                            <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
                            <p>By continuing to access or use our Service after any revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, you are no longer authorized to use the Service.</p>
                            <p>Last updated: <?php echo date('F j, Y'); ?></p>
                            <?php endif; ?>
                        </section>

                        <section class="mb-5">
                            <h2>Contact Us</h2>
                            <?php 
                            $contact = get_post_meta($post_id, '_terms_contact', true);
                            if (!empty($contact)) :
                                echo wp_kses_post($contact);
                            else :
                            ?>
                            <p>If you have any questions about these Terms, please contact us:</p>
                            <p>Bitcomm Technologies<br>
                            Nairobi, Kenya<br>
                            Email: <?php echo esc_html(get_theme_mod('footer_email', 'kennedychongwobitcomm@gmail.com')); ?><br>
                            Phone: <?php echo esc_html(get_theme_mod('footer_phone', '+254 738 788010')); ?></p>
                            <?php endif; ?>
                            </section>
                            <?php 
                            endif;
                        }
                        
                        // Add reusable legal clauses
                        $legal_clauses = new WP_Query(array(
                            'post_type' => 'legal_clauses',
                            'meta_query' => array(
                                array(
                                    'key' => '_applicable_pages',
                                    'value' => 'terms-of-service',
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
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="legal-sidebar p-4 bg-light rounded">
                        <h3>Legal Pages</h3>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a></li>
                            <li><a href="<?php echo esc_url(home_url('/terms-of-service')); ?>" class="active">Terms of Service</a></li>
                            <li><a href="<?php echo esc_url(home_url('/cookie-policy')); ?>">Cookie Policy</a></li>
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