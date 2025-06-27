<?php
/**
 * itsulu-custom Theme Customizer
 *
 * @package itsulu-custom
 */

// Include section links helper
require get_template_directory() . '/inc/section-links.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function itsulu_custom_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'itsulu_custom_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'itsulu_custom_customize_partial_blogdescription',
			)
		);
	}

	// New Section for Quick Actions Panel
	$wp_customize->add_section('quick_actions_panel_section', array(
		'title'    => __('Quick Actions Panel', 'itsulu-custom'),
		'priority' => 35,
		'description' => __('Configure the quick actions panel colors and appearance', 'itsulu-custom'),
	));

	// Newsletter settings moved to the site identity section for better organization
	$wp_customize->add_setting('newsletter_recipient_email', array(
		'default'           => get_option('admin_email'),
		'sanitize_callback' => 'sanitize_email',
	));
	$wp_customize->add_control('newsletter_recipient_email', array(
		'label'       => __('Newsletter Recipient Email', 'itsulu-custom'),
		'description' => __('Email address where newsletter signups will be sent.', 'itsulu-custom'),
		'section'     => 'title_tagline',
		'type'        => 'email',
		'priority'    => 80,
	));

	// ==== Hero Slider Section ====
	$wp_customize->add_section('hero_slider_section', array(
		'title'    => __('Hero Slider', 'itsulu-custom'),
		'priority' => 30, // Higher priority than the right column section
		'description' => __('Configure the hero slider on the front page.', 'itsulu-custom'),
	));

	// Global Slider Settings
	$wp_customize->add_setting('hero_slider_autoplay', array(
		'default'           => true,
		'sanitize_callback' => 'rest_sanitize_boolean',
	));
	$wp_customize->add_control('hero_slider_autoplay', array(
		'label'    => __('Enable Autoplay', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('hero_slider_interval', array(
		'default'           => 5000,
		'sanitize_callback' => 'absint',
	));
	$wp_customize->add_control('hero_slider_interval', array(
		'label'    => __('Autoplay Interval (ms)', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'number',
		'input_attrs' => array(
			'min'  => 2000,
			'max'  => 10000,
			'step' => 500,
		),
	));

	// ==== Slide 1 Settings ====
	$wp_customize->add_setting('hero_slide_1_image', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	));
	$wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_slide_1_image', array(
		'label'     => __('Slide 1 - Background Image', 'itsulu-custom'),
		'section'   => 'hero_slider_section',
		'mime_type' => 'image',
	)));

	$wp_customize->add_setting('hero_slide_1_title', array(
		'default'           => __('Advanced IT Solutions for Modern Business', 'itsulu-custom'),
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('hero_slide_1_title', array(
		'label'    => __('Slide 1 - Title', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'text',
	));

	$wp_customize->add_setting('hero_slide_1_description', array(
		'default'           => __('Experience enterprise-grade technology services tailored to your business needs, powered by our expert team.', 'itsulu-custom'),
		'sanitize_callback' => 'wp_kses_post',
	));
	$wp_customize->add_control('hero_slide_1_description', array(
		'label'    => __('Slide 1 - Description', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'textarea',
	));

	$wp_customize->add_setting('hero_slide_1_button_text', array(
		'default'           => __('Get Started', 'itsulu-custom'),
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('hero_slide_1_button_text', array(
		'label'    => __('Slide 1 - Button Text', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'text',
	));

	// Section link selector for Slide 1 button
	$wp_customize->add_setting('hero_slide_1_button_section', array(
		'default'           => '#consultation',
		'sanitize_callback' => 'itsulu_sanitize_section_link',
	));
	$wp_customize->add_control('hero_slide_1_button_section', array(
		'label'    => __('Slide 1 - Button Link To Section', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'select',
		'choices'  => itsulu_get_page_sections(),
		'priority' => 10,
	));
	
	// Custom URL for when "Custom URL" is selected
	$wp_customize->add_setting('hero_slide_1_button_custom_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('hero_slide_1_button_custom_url', array(
		'label'           => __('Slide 1 - Custom Button URL', 'itsulu-custom'),
		'section'         => 'hero_slider_section',
		'type'            => 'url',
		'active_callback' => function() {
			return get_theme_mod('hero_slide_1_button_section') === 'custom';
		},
		'priority'        => 11,
	));

	// ==== Slide 2 Settings ====
	$wp_customize->add_setting('hero_slide_2_image', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	));
	$wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_slide_2_image', array(
		'label'     => __('Slide 2 - Background Image', 'itsulu-custom'),
		'section'   => 'hero_slider_section',
		'mime_type' => 'image',
	)));

	$wp_customize->add_setting('hero_slide_2_title', array(
		'default'           => __('Cybersecurity That Never Sleeps', 'itsulu-custom'),
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('hero_slide_2_title', array(
		'label'    => __('Slide 2 - Title', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'text',
	));

	$wp_customize->add_setting('hero_slide_2_description', array(
		'default'           => __('Protect your business with our comprehensive security solutions, featuring 24/7 monitoring and rapid incident response.', 'itsulu-custom'),
		'sanitize_callback' => 'wp_kses_post',
	));
	$wp_customize->add_control('hero_slide_2_description', array(
		'label'    => __('Slide 2 - Description', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'textarea',
	));

	$wp_customize->add_setting('hero_slide_2_button_text', array(
		'default'           => __('Learn More', 'itsulu-custom'),
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('hero_slide_2_button_text', array(
		'label'    => __('Slide 2 - Button Text', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'text',
	));

	// Section link selector for Slide 2 button
	$wp_customize->add_setting('hero_slide_2_button_section', array(
		'default'           => '#services',
		'sanitize_callback' => 'itsulu_sanitize_section_link',
	));
	$wp_customize->add_control('hero_slide_2_button_section', array(
		'label'    => __('Slide 2 - Button Link To Section', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'select',
		'choices'  => itsulu_get_page_sections(),
		'priority' => 10,
	));
	
	// Custom URL for when "Custom URL" is selected
	$wp_customize->add_setting('hero_slide_2_button_custom_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('hero_slide_2_button_custom_url', array(
		'label'           => __('Slide 2 - Custom Button URL', 'itsulu-custom'),
		'section'         => 'hero_slider_section',
		'type'            => 'url',
		'active_callback' => function() {
			return get_theme_mod('hero_slide_2_button_section') === 'custom';
		},
		'priority'        => 11,
	));

	// ==== Slide 3 Settings ====
	$wp_customize->add_setting('hero_slide_3_image', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	));
	$wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_slide_3_image', array(
		'label'     => __('Slide 3 - Background Image', 'itsulu-custom'),
		'section'   => 'hero_slider_section',
		'mime_type' => 'image',
	)));

	$wp_customize->add_setting('hero_slide_3_title', array(
		'default'           => __('Cloud Solutions for Every Scale', 'itsulu-custom'),
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('hero_slide_3_title', array(
		'label'    => __('Slide 3 - Title', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'text',
	));

	$wp_customize->add_setting('hero_slide_3_description', array(
		'default'           => __('From startups to enterprises, our flexible cloud infrastructure adapts to your growth with seamless scalability.', 'itsulu-custom'),
		'sanitize_callback' => 'wp_kses_post',
	));
	$wp_customize->add_control('hero_slide_3_description', array(
		'label'    => __('Slide 3 - Description', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'textarea',
	));

	$wp_customize->add_setting('hero_slide_3_button_text', array(
		'default'           => __('Explore Options', 'itsulu-custom'),
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('hero_slide_3_button_text', array(
		'label'    => __('Slide 3 - Button Text', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'text',
	));

	// Section link selector for Slide 3 button
	$wp_customize->add_setting('hero_slide_3_button_section', array(
		'default'           => '#solutions',
		'sanitize_callback' => 'itsulu_sanitize_section_link',
	));
	$wp_customize->add_control('hero_slide_3_button_section', array(
		'label'    => __('Slide 3 - Button Link To Section', 'itsulu-custom'),
		'section'  => 'hero_slider_section',
		'type'     => 'select',
		'choices'  => itsulu_get_page_sections(),
		'priority' => 10,
	));
	
	// Custom URL for when "Custom URL" is selected
	$wp_customize->add_setting('hero_slide_3_button_custom_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('hero_slide_3_button_custom_url', array(
		'label'           => __('Slide 3 - Custom Button URL', 'itsulu-custom'),
		'section'         => 'hero_slider_section',
		'type'            => 'url',
		'active_callback' => function() {
			return get_theme_mod('hero_slide_3_button_section') === 'custom';
		},
		'priority'        => 11,
	));

	// Add some colors for the quick actions panel
	$wp_customize->add_setting('quick_actions_bg_color', array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'quick_actions_bg_color', array(
		'label' => __('Panel Background Color', 'itsulu-custom'), 
		'section' => 'quick_actions_panel_section',
		'priority' => 10
	)));
	
	$wp_customize->add_setting('quick_actions_text_color', array('default' => '#333333', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'quick_actions_text_color', array(
		'label' => __('Panel Text Color', 'itsulu-custom'), 
		'section' => 'quick_actions_panel_section',
		'priority' => 20
	)));
	
	$wp_customize->add_setting('quick_actions_icon_color', array('default' => '#007bff', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'quick_actions_icon_color', array(
		'label' => __('Icon Color', 'itsulu-custom'), 
		'section' => 'quick_actions_panel_section',
		'priority' => 30
	)));
}
add_action( 'customize_register', 'itsulu_custom_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function itsulu_custom_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function itsulu_custom_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function itsulu_custom_customize_preview_js() {
	wp_enqueue_script( 'itsulu-custom-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'itsulu_custom_customize_preview_js' );
