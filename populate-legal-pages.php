<?php
/**
 * Populate Legal Pages CPTs with Professional Content
 * 
 * This script creates comprehensive legal content for:
 * - Privacy Policy sections
 * - Terms of Service sections
 * - Cookie Policy sections
 * - Reusable legal clauses
 */

// Security check
if (!defined('ABSPATH')) {
    // Load WordPress if accessed directly
    require_once('../../../wp-load.php');
}

// Check if user is admin
if (!current_user_can('manage_options')) {
    wp_die('You do not have permission to access this page.');
}

/**
 * Create a legal section post
 */
function create_legal_section($title, $content, $page_type, $order = 1, $is_required = false) {
    // Check if post already exists
    $existing_post = get_page_by_title($title, OBJECT, 'legal_sections');
    if ($existing_post) {
        return $existing_post->ID;
    }
    
    $post_data = array(
        'post_title'    => $title,
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'legal_sections',
        'post_author'   => 1,
        'meta_input'    => array(
            '_legal_page_type' => $page_type,
            '_section_order'   => $order,
            '_is_required'     => $is_required ? '1' : '0'
        )
    );
    
    return wp_insert_post($post_data);
}

/**
 * Create a legal clause post
 */
function create_legal_clause($title, $content, $clause_type, $applicable_pages = '', $last_review = '') {
    // Check if post already exists
    $existing_post = get_page_by_title($title, OBJECT, 'legal_clauses');
    if ($existing_post) {
        return $existing_post->ID;
    }
    
    $post_data = array(
        'post_title'    => $title,
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'legal_clauses',
        'post_author'   => 1,
        'meta_input'    => array(
            '_clause_type'        => $clause_type,
            '_applicable_pages'   => $applicable_pages,
            '_last_legal_review'  => $last_review ?: date('Y-m-d')
        )
    );
    
    return wp_insert_post($post_data);
}

// Privacy Policy Sections
echo "<h2>Creating Privacy Policy Sections...</h2>";

create_legal_section(
    'Privacy Policy Introduction',
    '<p>At Bitcomm Technologies, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p><p>We understand that privacy is important to you, and we want to be transparent about our practices. This policy applies to all information collected through our website, mobile applications, and any related services.</p>',
    'privacy-policy',
    1,
    true
);

create_legal_section(
    'Information We Collect',
    '<h3>Personal Information</h3><p>We may collect personal information that you voluntarily provide to us, including:</p><ul><li>Name and contact information (email address, phone number, mailing address)</li><li>Professional information (company name, job title, industry)</li><li>Account credentials and preferences</li><li>Communication preferences and marketing consents</li></ul><h3>Automatically Collected Information</h3><p>We automatically collect certain information when you visit our website:</p><ul><li>IP address and device information</li><li>Browser type and version</li><li>Pages visited and time spent on our site</li><li>Referring website information</li><li>Cookies and similar tracking technologies</li></ul>',
    'privacy-policy',
    2,
    true
);

create_legal_section(
    'How We Use Your Information',
    '<p>We use the information we collect for various purposes, including:</p><ul><li><strong>Service Provision:</strong> To provide, maintain, and improve our IT services and solutions</li><li><strong>Communication:</strong> To respond to your inquiries, provide customer support, and send important updates</li><li><strong>Marketing:</strong> To send you promotional materials and information about our services (with your consent)</li><li><strong>Analytics:</strong> To understand how our website is used and improve user experience</li><li><strong>Legal Compliance:</strong> To comply with applicable laws, regulations, and legal processes</li><li><strong>Security:</strong> To protect against fraud, unauthorized access, and other security threats</li></ul>',
    'privacy-policy',
    3,
    true
);

create_legal_section(
    'Information Sharing and Disclosure',
    '<p>We do not sell, trade, or rent your personal information to third parties. We may share your information in the following circumstances:</p><ul><li><strong>Service Providers:</strong> With trusted third-party vendors who assist us in operating our website and providing services</li><li><strong>Business Transfers:</strong> In connection with mergers, acquisitions, or asset sales</li><li><strong>Legal Requirements:</strong> When required by law or to protect our rights and safety</li><li><strong>Consent:</strong> With your explicit consent for specific purposes</li></ul><p>All third-party service providers are contractually obligated to maintain the confidentiality and security of your information.</p>',
    'privacy-policy',
    4,
    true
);

create_legal_section(
    'Data Security and Retention',
    '<p>We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These measures include:</p><ul><li>Encryption of data in transit and at rest</li><li>Regular security assessments and updates</li><li>Access controls and authentication procedures</li><li>Employee training on data protection practices</li></ul><p><strong>Data Retention:</strong> We retain your personal information only as long as necessary to fulfill the purposes outlined in this policy, comply with legal obligations, resolve disputes, and enforce our agreements.</p>',
    'privacy-policy',
    5,
    true
);

create_legal_section(
    'Your Privacy Rights',
    '<p>You have certain rights regarding your personal information, subject to applicable laws:</p><ul><li><strong>Access:</strong> Request access to the personal information we hold about you</li><li><strong>Correction:</strong> Request correction of inaccurate or incomplete information</li><li><strong>Deletion:</strong> Request deletion of your personal information ("right to be forgotten")</li><li><strong>Portability:</strong> Request transfer of your information in a structured, machine-readable format</li><li><strong>Objection:</strong> Object to processing of your information for certain purposes</li><li><strong>Restriction:</strong> Request restriction of processing under certain circumstances</li><li><strong>Withdraw Consent:</strong> Withdraw consent for processing where consent is the legal basis</li></ul><p>To exercise these rights, please contact us using the information provided in this policy. We will respond to your request within 30 days.</p>',
    'privacy-policy',
    6,
    true
);

create_legal_section(
    'International Data Transfers',
    '<p>Your personal information may be transferred to and processed in countries other than your country of residence. These countries may have different data protection laws than your country.</p><p>When we transfer your information internationally, we ensure appropriate safeguards are in place:</p><ul><li>Adequacy decisions by relevant authorities</li><li>Standard contractual clauses approved by regulatory bodies</li><li>Binding corporate rules for intra-group transfers</li><li>Certification schemes and codes of conduct</li></ul><p>We will only transfer your personal information to countries or organizations that provide an adequate level of protection.</p>',
    'privacy-policy',
    7,
    true
);

create_legal_section(
    'Children\'s Privacy',
    '<p>Our services are not intended for children under the age of 16, and we do not knowingly collect personal information from children under 16. If we become aware that we have collected personal information from a child under 16, we will take steps to delete such information promptly.</p><p>If you are a parent or guardian and believe that your child has provided us with personal information, please contact us immediately so we can take appropriate action.</p>',
    'privacy-policy',
    8,
    true
);

// Terms of Service Sections
echo "<h2>Creating Terms of Service Sections...</h2>";

create_legal_section(
    'Terms of Service Introduction',
    '<p>Welcome to Bitcomm Technologies. These Terms of Service ("Terms") govern your use of our website, services, and products. By accessing or using our services, you agree to be bound by these Terms.</p><p>Please read these Terms carefully before using our services. If you do not agree with any part of these Terms, you may not access or use our services.</p>',
    'terms-of-service',
    1,
    true
);

create_legal_section(
    'Service Description',
    '<p>Bitcomm Technologies provides comprehensive IT solutions and services, including but not limited to:</p><ul><li>IT consulting and strategy development</li><li>Software development and implementation</li><li>System integration and migration services</li><li>Cybersecurity solutions and monitoring</li><li>Cloud services and infrastructure management</li><li>Technical support and maintenance</li></ul><p>Our services are provided to businesses and organizations seeking professional IT solutions. Specific service details are outlined in individual service agreements.</p>',
    'terms-of-service',
    2,
    true
);

create_legal_section(
    'User Responsibilities',
    '<p>When using our services, you agree to:</p><ul><li>Provide accurate and complete information</li><li>Maintain the confidentiality of your account credentials</li><li>Use our services only for lawful purposes</li><li>Comply with all applicable laws and regulations</li><li>Respect intellectual property rights</li><li>Not interfere with or disrupt our services</li></ul><p>You are responsible for all activities that occur under your account and for maintaining the security of your login credentials.</p>',
    'terms-of-service',
    3,
    true
);

create_legal_section(
    'Payment Terms',
    '<p>Payment terms for our services are as follows:</p><ul><li><strong>Invoicing:</strong> Invoices are issued according to the agreed schedule in your service contract</li><li><strong>Payment Due:</strong> Payment is due within 30 days of invoice date unless otherwise specified</li><li><strong>Late Payments:</strong> Late payments may incur additional charges as specified in your agreement</li><li><strong>Disputes:</strong> Payment disputes must be raised within 10 days of invoice receipt</li></ul><p>All fees are non-refundable unless explicitly stated otherwise in your service agreement.</p>',
    'terms-of-service',
    4,
    true
);

create_legal_section(
    'Limitation of Liability',
    '<p>To the maximum extent permitted by law, Bitcomm Technologies shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to loss of profits, data, or business interruption.</p><p>Our total liability for any claims arising from or related to our services shall not exceed the amount paid by you for the specific service giving rise to the claim during the twelve (12) months preceding the claim.</p><p>Some jurisdictions do not allow the exclusion or limitation of certain damages, so these limitations may not apply to you.</p>',
    'terms-of-service',
    5,
    true
);

create_legal_section(
    'Intellectual Property Rights',
    '<p>All content, features, and functionality of our services, including but not limited to text, graphics, logos, software, and designs, are owned by Bitcomm Technologies or our licensors and are protected by copyright, trademark, and other intellectual property laws.</p><ul><li><strong>Our Rights:</strong> We retain all rights, title, and interest in our proprietary technologies and methodologies</li><li><strong>Your Rights:</strong> You receive a limited, non-exclusive license to use our services as intended</li><li><strong>Restrictions:</strong> You may not copy, modify, distribute, or reverse engineer our proprietary materials</li><li><strong>Client Data:</strong> You retain ownership of your data and grant us necessary rights to provide services</li></ul>',
    'terms-of-service',
    6,
    true
);

create_legal_section(
    'Service Level Agreements',
    '<p>We are committed to providing reliable and high-quality IT services. Our service level commitments include:</p><ul><li><strong>Uptime Guarantee:</strong> 99.9% uptime for critical systems (excluding scheduled maintenance)</li><li><strong>Response Times:</strong> Initial response within 4 hours for critical issues, 24 hours for standard issues</li><li><strong>Resolution Times:</strong> Target resolution based on issue severity and complexity</li><li><strong>Maintenance Windows:</strong> Scheduled maintenance during agreed low-impact periods</li></ul><p>Specific SLA terms are detailed in individual service agreements and may vary based on service tier and requirements.</p>',
    'terms-of-service',
    7,
    true
);

create_legal_section(
    'Termination and Suspension',
    '<p>Either party may terminate services under the following conditions:</p><ul><li><strong>For Convenience:</strong> With 30 days written notice (unless otherwise specified in service agreement)</li><li><strong>For Cause:</strong> Immediate termination for material breach, non-payment, or violation of terms</li><li><strong>Suspension:</strong> We may suspend services for non-payment or security threats</li></ul><p><strong>Effect of Termination:</strong></p><ul><li>All outstanding fees become immediately due</li><li>We will provide reasonable assistance with data migration (fees may apply)</li><li>Confidentiality obligations survive termination</li><li>You must return or destroy any proprietary materials</li></ul>',
    'terms-of-service',
    8,
    true
);

// Cookie Policy Sections
echo "<h2>Creating Cookie Policy Sections...</h2>";

create_legal_section(
    'Cookie Policy Introduction',
    '<p>This Cookie Policy explains how Bitcomm Technologies uses cookies and similar tracking technologies on our website. By continuing to use our website, you consent to our use of cookies as described in this policy.</p><p>We use cookies to enhance your browsing experience, analyze website traffic, and provide personalized content. This policy provides detailed information about the types of cookies we use and how you can manage them.</p>',
    'cookie-policy',
    1,
    true
);

create_legal_section(
    'What Are Cookies',
    '<p>Cookies are small text files that are stored on your device when you visit a website. They are widely used to make websites work more efficiently and provide information to website owners.</p><p>Cookies can be "persistent" (remaining on your device until deleted) or "session" (deleted when you close your browser). They can also be "first-party" (set by our website) or "third-party" (set by other websites).</p>',
    'cookie-policy',
    2,
    true
);

create_legal_section(
    'Types of Cookies We Use',
    '<h3>Essential Cookies</h3><p>These cookies are necessary for the website to function properly and cannot be disabled. They include cookies for security, authentication, and basic website functionality.</p><h3>Analytics Cookies</h3><p>We use analytics cookies to understand how visitors interact with our website, helping us improve user experience and website performance.</p><h3>Marketing Cookies</h3><p>These cookies track your browsing habits to provide relevant advertisements and measure the effectiveness of our marketing campaigns.</p><h3>Preference Cookies</h3><p>These cookies remember your preferences and settings to provide a personalized experience on future visits.</p>',
    'cookie-policy',
    3,
    true
);

create_legal_section(
    'Managing Your Cookie Preferences',
    '<p>You have several options for managing cookies:</p><ul><li><strong>Browser Settings:</strong> Most browsers allow you to control cookies through their settings</li><li><strong>Cookie Consent Tool:</strong> Use our cookie consent banner to manage your preferences</li><li><strong>Opt-out Links:</strong> Some third-party services provide direct opt-out options</li></ul><p>Please note that disabling certain cookies may affect the functionality of our website and your user experience.</p><p>For more information about managing cookies, visit your browser\'s help section or visit <a href="https://www.allaboutcookies.org" target="_blank">www.allaboutcookies.org</a>.</p>',
    'cookie-policy',
    4,
    true
);

create_legal_section(
    'Third-Party Cookies and Services',
    '<p>We may use third-party services that place cookies on your device. These services help us provide better functionality and analyze website performance:</p><ul><li><strong>Google Analytics:</strong> For website traffic analysis and user behavior insights</li><li><strong>Social Media Plugins:</strong> For social sharing functionality</li><li><strong>Marketing Platforms:</strong> For targeted advertising and campaign measurement</li><li><strong>Customer Support Tools:</strong> For live chat and support ticket management</li></ul><p>Each third-party service has its own privacy policy and cookie practices. We recommend reviewing their policies to understand how they handle your information.</p>',
    'cookie-policy',
    5,
    true
);

create_legal_section(
    'Cookie Consent and Legal Basis',
    '<p>Our use of cookies is based on the following legal grounds:</p><ul><li><strong>Necessary Cookies:</strong> Legitimate interest in providing website functionality</li><li><strong>Analytics Cookies:</strong> Your consent, which you can withdraw at any time</li><li><strong>Marketing Cookies:</strong> Your explicit consent for personalized advertising</li><li><strong>Preference Cookies:</strong> Your consent to enhance user experience</li></ul><p>You can manage your consent preferences through our cookie banner or by contacting us directly. Withdrawing consent will not affect the lawfulness of processing based on consent before withdrawal.</p>',
    'cookie-policy',
    6,
    true
);

// Reusable Legal Clauses
echo "<h2>Creating Reusable Legal Clauses...</h2>";

create_legal_clause(
    'Contact Information',
    '<p>If you have any questions about this policy or our practices, please contact us:</p><ul><li><strong>Email:</strong> legal@bitcomm.co.ke</li><li><strong>Phone:</strong> +254 (0) 700 123 456</li><li><strong>Address:</strong> Bitcomm Technologies, Nairobi, Kenya</li><li><strong>Business Hours:</strong> Monday - Friday, 8:00 AM - 5:00 PM EAT</li></ul>',
    'contact-info',
    'privacy-policy, terms-of-service, cookie-policy'
);

create_legal_clause(
    'Policy Updates',
    '<p>We may update this policy from time to time to reflect changes in our practices, technology, legal requirements, or other factors. When we make changes, we will:</p><ul><li>Update the "Last Modified" date at the top of the policy</li><li>Notify you of significant changes via email or website notice</li><li>Provide a summary of key changes when applicable</li></ul><p>Your continued use of our services after any changes constitutes acceptance of the updated policy.</p>',
    'updates',
    'privacy-policy, terms-of-service, cookie-policy'
);

create_legal_clause(
    'Governing Law',
    '<p>These terms and any disputes arising from or related to our services shall be governed by and construed in accordance with the laws of the Republic of Kenya, without regard to its conflict of law principles.</p><p>Any legal action or proceeding arising under these terms will be brought exclusively in the courts of Nairobi, Kenya, and you hereby consent to personal jurisdiction and venue therein.</p>',
    'general',
    'terms-of-service'
);

create_legal_clause(
    'Data Protection Rights',
    '<p>Depending on your location, you may have certain rights regarding your personal information:</p><ul><li><strong>Access:</strong> Request access to your personal information</li><li><strong>Correction:</strong> Request correction of inaccurate information</li><li><strong>Deletion:</strong> Request deletion of your personal information</li><li><strong>Portability:</strong> Request transfer of your information to another service</li><li><strong>Objection:</strong> Object to certain processing of your information</li></ul><p>To exercise these rights, please contact us using the information provided in this policy.</p>',
    'data-collection',
    'privacy-policy'
);

create_legal_clause(
    'Third-Party Links Disclaimer',
    '<p>Our website may contain links to third-party websites or services. We are not responsible for the privacy practices, content, or security of these external sites. We encourage you to review the privacy policies and terms of service of any third-party sites you visit.</p><p>The inclusion of any link does not imply endorsement by Bitcomm Technologies of the linked site or service.</p>',
     'disclaimer',
    'privacy-policy, terms-of-service'
);

create_legal_clause(
    'Force Majeure',
    '<p>Neither party shall be liable for any failure or delay in performance under these terms due to circumstances beyond their reasonable control, including but not limited to acts of God, natural disasters, war, terrorism, labor disputes, government actions, or technical failures.</p><p>The affected party must promptly notify the other party and use reasonable efforts to mitigate the impact. If the force majeure event continues for more than 90 days, either party may terminate the affected services with written notice.</p>',
    'general',
    'terms-of-service'
);

create_legal_clause(
    'Confidentiality',
    '<p>Both parties acknowledge that they may have access to confidential information. Each party agrees to:</p><ul><li>Maintain the confidentiality of all proprietary information</li><li>Use confidential information only for the purposes of providing or receiving services</li><li>Not disclose confidential information to third parties without written consent</li><li>Return or destroy confidential information upon termination</li></ul><p>This obligation survives termination of our relationship and continues for a period of five (5) years.</p>',
    'general',
    'terms-of-service, privacy-policy'
);

create_legal_clause(
    'Compliance and Regulatory',
    '<p>Bitcomm Technologies is committed to compliance with applicable laws and regulations, including:</p><ul><li><strong>Data Protection:</strong> GDPR, local data protection laws, and industry standards</li><li><strong>Cybersecurity:</strong> ISO 27001, NIST frameworks, and security best practices</li><li><strong>Business Operations:</strong> Local business registration and tax compliance</li><li><strong>Professional Standards:</strong> Industry certifications and professional codes of conduct</li></ul><p>We regularly review and update our compliance practices to meet evolving regulatory requirements.</p>',
    'compliance',
    'privacy-policy, terms-of-service'
);

echo "<h2 style='color: green;'>✅ Legal pages content has been successfully populated!</h2>";
echo "<p><strong>Next steps:</strong></p>";
echo "<ul>";
echo "<li>Visit <a href='/wp-admin/edit.php?post_type=legal_sections'>Legal Sections</a> to manage content</li>";
echo "<li>Visit <a href='/wp-admin/edit.php?post_type=legal_clauses'>Legal Clauses</a> to manage reusable content</li>";
echo "<li>Update your legal page templates to use the new CPT content</li>";
echo "</ul>";
?>