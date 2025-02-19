<?php
/**
 * General Customizer Options
 *
 * @package HavocWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'HavocWP_General_Customizer' ) ) :

	/**
	 * Settings for general options
	 */
	class HavocWP_General_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'customizer_options' ) );
			add_filter( 'havoc_head_css', array( $this, 'head_css' ) );

		}

		/**
		 * Customizer options
		 *
		 * @param WP_Customize_Manager $wp_customize Reference to WP_Customize_Manager.
		 * 		 */
		public function customizer_options( $wp_customize ) {

			/**
			 * Panel
			 */
			$panel = 'havoc_general_panel';
			$wp_customize->add_panel(
				$panel,
				array(
					'title'    => esc_html__( 'General Options', 'havocwp' ),
					'priority' => 210,
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_general_styling',
				array(
					'title'    => esc_html__( 'General Styling', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Styling
			 */
			$wp_customize->add_setting(
				'havoc_customzer_styling',
				array(
					'transport'         => 'postMessage',
					'default'           => 'head',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				'havoc_customzer_styling',
				array(
					'label'       => esc_html__( 'Styling Options Location', 'havocwp' ),
					'description' => esc_html__( 'Both settings apply only to the custom CSS added in the Custom CSS field in the Customizer. If you choose the Custom File location, a dedicated CSS file will be created in your uploads folder of your WordPress installation.', 'havocwp' ),
					'type'        => 'radio',
					'section'     => 'havoc_general_styling',
					'settings'    => 'havoc_customzer_styling',
					'priority'    => 10,
					'choices'     => array(
						'head' => esc_html__( 'WP Head', 'havocwp' ),
						'file' => esc_html__( 'Custom File', 'havocwp' ),
					),
				)
			);

			/**
			 * Primary Color
			 */
			$wp_customize->add_setting(
				'havoc_primary_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_primary_color',
					array(
						'label'    => esc_html__( 'Primary Color', 'havocwp' ),
						'section'  => 'havoc_general_styling',
						'settings' => 'havoc_primary_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Hover Primary Color
			 */
			$wp_customize->add_setting(
				'havoc_hover_primary_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#0b7cac',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_hover_primary_color',
					array(
						'label'    => esc_html__( 'Hover Primary Color', 'havocwp' ),
						'section'  => 'havoc_general_styling',
						'settings' => 'havoc_hover_primary_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Main Border Color
			 */
			$wp_customize->add_setting(
				'havoc_main_border_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#e9e9e9',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_main_border_color',
					array(
						'label'    => esc_html__( 'Main Border Color', 'havocwp' ),
						'section'  => 'havoc_general_styling',
						'settings' => 'havoc_main_border_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Heading Site Background
			 */
			$wp_customize->add_setting(
				'havoc_site_background_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Heading_Control(
					$wp_customize,
					'havoc_site_background_heading',
					array(
						'label'    => esc_html__( 'Site Background', 'havocwp' ),
						'section'  => 'havoc_general_styling',
						'priority' => 10,
					)
				)
			);

			/**
			 * Site Background
			 */
			$wp_customize->add_setting(
				'havoc_background_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_background_color',
					array(
						'label'           => esc_html__( 'Background Color', 'havocwp' ),
						'section'         => 'havoc_general_styling',
						'settings'        => 'havoc_background_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_hasnt_boxed_layout',
					)
				)
			);

			/**
			 * Site Background Image
			 */
			$wp_customize->add_setting(
				'havoc_background_image',
				array(
					'sanitize_callback' => 'havocwp_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'havoc_background_image',
					array(
						'label'    => esc_html__( 'Background Image', 'havocwp' ),
						'section'  => 'havoc_general_styling',
						'settings' => 'havoc_background_image',
						'priority' => 10,
					)
				)
			);

			/**
			 * Site Background Image Position
			 */
			$wp_customize->add_setting(
				'havoc_background_image_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_background_image_position',
					array(
						'label'           => esc_html__( 'Position', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_styling',
						'settings'        => 'havoc_background_image_position',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_background_image',
						'choices'         => array(
							'initial'       => esc_html__( 'Default', 'havocwp' ),
							'top left'      => esc_html__( 'Top Left', 'havocwp' ),
							'top center'    => esc_html__( 'Top Center', 'havocwp' ),
							'top right'     => esc_html__( 'Top Right', 'havocwp' ),
							'center left'   => esc_html__( 'Center Left', 'havocwp' ),
							'center center' => esc_html__( 'Center Center', 'havocwp' ),
							'center right'  => esc_html__( 'Center Right', 'havocwp' ),
							'bottom left'   => esc_html__( 'Bottom Left', 'havocwp' ),
							'bottom center' => esc_html__( 'Bottom Center', 'havocwp' ),
							'bottom right'  => esc_html__( 'Bottom Right', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Site Background Image Attachment
			 */
			$wp_customize->add_setting(
				'havoc_background_image_attachment',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_background_image_attachment',
					array(
						'label'           => esc_html__( 'Attachment', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_styling',
						'settings'        => 'havoc_background_image_attachment',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_background_image',
						'choices'         => array(
							'initial' => esc_html__( 'Default', 'havocwp' ),
							'scroll'  => esc_html__( 'Scroll', 'havocwp' ),
							'fixed'   => esc_html__( 'Fixed', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Site Background Image Repeat
			 */
			$wp_customize->add_setting(
				'havoc_background_image_repeat',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_background_image_repeat',
					array(
						'label'           => esc_html__( 'Repeat', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_styling',
						'settings'        => 'havoc_background_image_repeat',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_background_image',
						'choices'         => array(
							'initial'   => esc_html__( 'Default', 'havocwp' ),
							'no-repeat' => esc_html__( 'No-repeat', 'havocwp' ),
							'repeat'    => esc_html__( 'Repeat', 'havocwp' ),
							'repeat-x'  => esc_html__( 'Repeat-x', 'havocwp' ),
							'repeat-y'  => esc_html__( 'Repeat-y', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Site Background Image Size
			 */
			$wp_customize->add_setting(
				'havoc_background_image_size',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_background_image_size',
					array(
						'label'           => esc_html__( 'Size', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_styling',
						'settings'        => 'havoc_background_image_size',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_background_image',
						'choices'         => array(
							'initial' => esc_html__( 'Default', 'havocwp' ),
							'auto'    => esc_html__( 'Auto', 'havocwp' ),
							'cover'   => esc_html__( 'Cover', 'havocwp' ),
							'contain' => esc_html__( 'Contain', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Heading Links Color
			 */
			$wp_customize->add_setting(
				'havoc_links_color_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Heading_Control(
					$wp_customize,
					'havoc_links_color_heading',
					array(
						'label'    => esc_html__( 'Links Color', 'havocwp' ),
						'section'  => 'havoc_general_styling',
						'priority' => 10,
					)
				)
			);

			/**
			 * Links Color
			 */
			$wp_customize->add_setting(
				'havoc_links_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_links_color',
					array(
						'label'    => esc_html__( 'Color', 'havocwp' ),
						'section'  => 'havoc_general_styling',
						'settings' => 'havoc_links_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Links Color Hover
			 */
			$wp_customize->add_setting(
				'havoc_links_color_hover',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_links_color_hover',
					array(
						'label'    => esc_html__( 'Color: Hover', 'havocwp' ),
						'section'  => 'havoc_general_styling',
						'settings' => 'havoc_links_color_hover',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_general_settings',
				array(
					'title'    => esc_html__( 'General Settings', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Main Layout Style
			 */
			$wp_customize->add_setting(
				'havoc_main_layout_style',
				array(
					'default'           => 'wide',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_main_layout_style',
					array(
						'label'    => esc_html__( 'Layout Style', 'havocwp' ),
						'section'  => 'havoc_general_settings',
						'settings' => 'havoc_main_layout_style',
						'priority' => 10,
						'choices'  => array(
							'wide'     => esc_html__( 'Wide', 'havocwp' ),
							'boxed'    => esc_html__( 'Boxed', 'havocwp' ),
							'separate' => esc_html__( 'Separate', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Boxed Layout Drop-Shadow
			 */
			$wp_customize->add_setting(
				'havoc_boxed_dropdshadow',
				array(
					'transport'         => 'postMessage',
					'default'           => true,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_boxed_dropdshadow',
					array(
						'label'           => esc_html__( 'Boxed Layout Drop-Shadow', 'havocwp' ),
						'type'            => 'checkbox',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_boxed_dropdshadow',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_boxed_layout',
					)
				)
			);

			/**
			 * Boxed Width
			 */
			$wp_customize->add_setting(
				'havoc_boxed_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1280',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_boxed_width',
					array(
						'label'           => esc_html__( 'Boxed Width (px)', 'havocwp' ),
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_boxed_width',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_boxed_layout',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 4000,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Boxed Outside Background
			 */
			$wp_customize->add_setting(
				'havoc_boxed_outside_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#e9e9e9',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_boxed_outside_bg',
					array(
						'label'           => esc_html__( 'Outside Background', 'havocwp' ),
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_boxed_outside_bg',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_boxed_layout',
					)
				)
			);

			/**
			 * Separate Outside Background
			 */
			$wp_customize->add_setting(
				'havoc_separate_outside_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#f1f1f1',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_separate_outside_bg',
					array(
						'label'           => esc_html__( 'Outside Background', 'havocwp' ),
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_separate_outside_bg',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_separate_layout',
					)
				)
			);

			/**
			 * Boxed Inner Background
			 */
			$wp_customize->add_setting(
				'havoc_boxed_inner_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_boxed_inner_bg',
					array(
						'label'           => esc_html__( 'Inner Background', 'havocwp' ),
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_boxed_inner_bg',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_boxed_or_separate_layout',
					)
				)
			);

			/**
			 * Separate Content Padding
			 */
			$wp_customize->add_setting(
				'havoc_separate_content_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '30px',
					'sanitize_callback' => 'wp_kses_post',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_separate_content_padding',
					array(
						'label'           => esc_html__( 'Content Padding', 'havocwp' ),
						'description'     => esc_html__( 'Add a custom content padding. px - em - %.', 'havocwp' ),
						'type'            => 'text',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_separate_content_padding',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_separate_layout',
					)
				)
			);

			/**
			 * Separate Widgets Padding
			 */
			$wp_customize->add_setting(
				'havoc_separate_widgets_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '30px',
					'sanitize_callback' => 'wp_kses_post',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_separate_widgets_padding',
					array(
						'label'           => esc_html__( 'Widgets Padding', 'havocwp' ),
						'description'     => esc_html__( 'Add a custom widgets padding. px - em - %.', 'havocwp' ),
						'type'            => 'text',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_separate_widgets_padding',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_separate_layout',
					)
				)
			);

			/**
			 * Main Container Width
			 */
			$wp_customize->add_setting(
				'havoc_main_container_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1200',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_main_container_width',
					array(
						'label'           => esc_html__( 'Main Container Width (px)', 'havocwp' ),
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_main_container_width',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_hasnt_boxed_layout',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 4096,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Content Width
			 */
			$wp_customize->add_setting(
				'havoc_left_container_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '72',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_left_container_width',
					array(
						'label'       => esc_html__( 'Content Width (%)', 'havocwp' ),
						'section'     => 'havoc_general_settings',
						'settings'    => 'havoc_left_container_width',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Sidebar Width
			 */
			$wp_customize->add_setting(
				'havoc_sidebar_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '28',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_sidebar_width',
					array(
						'label'       => esc_html__( 'Sidebar Width (%)', 'havocwp' ),
						'section'     => 'havoc_general_settings',
						'settings'    => 'havoc_sidebar_width',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Heading Pages
			 */
			$wp_customize->add_setting(
				'havoc_pages_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Heading_Control(
					$wp_customize,
					'havoc_pages_heading',
					array(
						'label'    => esc_html__( 'Pages', 'havocwp' ),
						'section'  => 'havoc_general_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pages
			 */
			$wp_customize->add_setting(
				'havoc_page_single_layout',
				array(
					'default'           => 'right-sidebar',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Radio_Image_Control(
					$wp_customize,
					'havoc_page_single_layout',
					array(
						'label'    => esc_html__( 'Layout', 'havocwp' ),
						'section'  => 'havoc_general_settings',
						'settings' => 'havoc_page_single_layout',
						'priority' => 10,
						'choices'  => havocwp_customizer_layout(),
					)
				)
			);

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting(
				'havoc_page_single_both_sidebars_style',
				array(
					'default'           => 'scs-style',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_single_both_sidebars_style',
					array(
						'label'           => esc_html__( 'Both Sidebars: Style', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_page_single_both_sidebars_style',
						'priority'        => 10,
						'choices'         => array(
							'ssc-style' => esc_html__( 'Sidebar / Sidebar / Content', 'havocwp' ),
							'scs-style' => esc_html__( 'Sidebar / Content / Sidebar', 'havocwp' ),
							'css-style' => esc_html__( 'Content / Sidebar / Sidebar', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_page_single_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting(
				'havoc_page_single_both_sidebars_content_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_single_both_sidebars_content_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Content Width (%)', 'havocwp' ),
						'type'            => 'number',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_page_single_both_sidebars_content_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_page_single_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting(
				'havoc_page_single_both_sidebars_sidebars_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_single_both_sidebars_sidebars_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Sidebars Width (%)', 'havocwp' ),
						'type'            => 'number',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_page_single_both_sidebars_sidebars_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_page_single_bs_layout',
					)
				)
			);

			/**
			 * Mobile Sidebar Order
			 */
			$wp_customize->add_setting(
				'havoc_page_single_sidebar_order',
				array(
					'default'           => 'content-sidebar',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_single_sidebar_order',
					array(
						'label'           => esc_html__( 'Mobile Sidebar Order', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_page_single_sidebar_order',
						'priority'        => 10,
						'choices'         => array(
							'content-sidebar' => esc_html__( 'Content / Sidebar', 'havocwp' ),
							'sidebar-content' => esc_html__( 'Sidebar / Content', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_page_single_rl_layout',
					)
				)
			);

			/**
			 * Content Padding
			 */
			$wp_customize->add_setting(
				'havoc_page_content_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_page_content_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'havoc_page_content_tablet_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_page_content_tablet_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'havoc_page_content_mobile_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_page_content_mobile_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Dimensions_Control(
					$wp_customize,
					'havoc_page_content_padding',
					array(
						'label'       => esc_html__( 'Content Padding (px)', 'havocwp' ),
						'section'     => 'havoc_general_settings',
						'settings'    => array(
							'desktop_top'    => 'havoc_page_content_top_padding',
							'desktop_bottom' => 'havoc_page_content_bottom_padding',
							'tablet_top'     => 'havoc_page_content_tablet_top_padding',
							'tablet_bottom'  => 'havoc_page_content_tablet_bottom_padding',
							'mobile_top'     => 'havoc_page_content_mobile_top_padding',
							'mobile_bottom'  => 'havoc_page_content_mobile_bottom_padding',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Heading Search Result Page
			 */
			$wp_customize->add_setting(
				'havoc_search_result_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Heading_Control(
					$wp_customize,
					'havoc_search_result_heading',
					array(
						'label'    => esc_html__( 'Search Result Page', 'havocwp' ),
						'section'  => 'havoc_general_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Search Source
			 */
			$wp_customize->add_setting(
				'havoc_menu_search_source',
				array(
					'default'           => 'any',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_menu_search_source',
					array(
						'label'    => esc_html__( 'Source', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_general_settings',
						'settings' => 'havoc_menu_search_source',
						'priority' => 10,
						'choices'  => $this->get_post_types(),
					)
				)
			);

			/**
			 * Search Posts Per Page
			 */
			$wp_customize->add_setting(
				'havoc_search_post_per_page',
				array(
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_search_post_per_page',
					array(
						'label'       => esc_html__( 'Search Posts Per Page', 'havocwp' ),
						'type'        => 'number',
						'section'     => 'havoc_general_settings',
						'settings'    => 'havoc_search_post_per_page',
						'priority'    => 10,
						'input_attrs' => array(
							'min' => 0,
						),
					)
				)
			);

			/**
			 * Search Page
			 */
			$wp_customize->add_setting(
				'havoc_search_custom_sidebar',
				array(
					'default'           => true,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_search_custom_sidebar',
					array(
						'label'    => esc_html__( 'Custom Sidebar', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_settings',
						'settings' => 'havoc_search_custom_sidebar',
						'priority' => 10,
					)
				)
			);

			/**
			 * Search Page Layout
			 */
			$wp_customize->add_setting(
				'havoc_search_layout',
				array(
					'default'           => 'right-sidebar',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Radio_Image_Control(
					$wp_customize,
					'havoc_search_layout',
					array(
						'label'    => esc_html__( 'Layout', 'havocwp' ),
						'section'  => 'havoc_general_settings',
						'settings' => 'havoc_search_layout',
						'priority' => 10,
						'choices'  => havocwp_customizer_layout(),
					)
				)
			);

			/**
			 * Page Search Logo
			 */
			$wp_customize->add_setting(
				'havoc_search_logo',
				array(
					'default'           => '',
					'sanitize_callback' => 'havocwp_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'havoc_search_logo',
					array(
						'label'       => esc_html__( 'Search Logo', 'havocwp' ),
						'description' => esc_html__( 'Select a search page logo.', 'havocwp' ),
						'section'     => 'havoc_general_settings',
						'settings'    => 'havoc_search_logo',
						'priority'    => 10,
					)
				)
			);

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting(
				'havoc_search_both_sidebars_style',
				array(
					'default'           => 'scs-style',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_search_both_sidebars_style',
					array(
						'label'           => esc_html__( 'Both Sidebars: Style', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_search_both_sidebars_style',
						'priority'        => 10,
						'choices'         => array(
							'ssc-style' => esc_html__( 'Sidebar / Sidebar / Content', 'havocwp' ),
							'scs-style' => esc_html__( 'Sidebar / Content / Sidebar', 'havocwp' ),
							'css-style' => esc_html__( 'Content / Sidebar / Sidebar', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_search_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting(
				'havoc_search_both_sidebars_content_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_search_both_sidebars_content_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Content Width (%)', 'havocwp' ),
						'type'            => 'number',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_search_both_sidebars_content_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_search_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting(
				'havoc_search_both_sidebars_sidebars_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_search_both_sidebars_sidebars_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Sidebars Width (%)', 'havocwp' ),
						'type'            => 'number',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_search_both_sidebars_sidebars_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_search_bs_layout',
					)
				)
			);

			/**
			 * Mobile Sidebar Order
			 */
			$wp_customize->add_setting(
				'havoc_search_sidebar_order',
				array(
					'default'           => 'content-sidebar',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_search_sidebar_order',
					array(
						'label'           => esc_html__( 'Mobile Sidebar Order', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_settings',
						'settings'        => 'havoc_search_sidebar_order',
						'priority'        => 10,
						'choices'         => array(
							'content-sidebar' => esc_html__( 'Content / Sidebar', 'havocwp' ),
							'sidebar-content' => esc_html__( 'Sidebar / Content', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_search_rl_layout',
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_general_page_header',
				array(
					'title'    => esc_html__( 'Page Title', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Page Title Visibility
			 */
			$wp_customize->add_setting(
				'havoc_page_header_visibility',
				array(
					'default'           => 'all-devices',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_header_visibility',
					array(
						'label'    => esc_html__( 'Visibility', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_page_header_visibility',
						'priority' => 10,
						'choices'  => array(
							'all-devices'        => esc_html__( 'Show On All Devices', 'havocwp' ),
							'hide-tablet'        => esc_html__( 'Hide On Tablet', 'havocwp' ),
							'hide-mobile'        => esc_html__( 'Hide On Mobile', 'havocwp' ),
							'hide-tablet-mobile' => esc_html__( 'Hide On Tablet & Mobile', 'havocwp' ),
							'hide-all-devices'   => esc_html__( 'Hide On All Devices', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Heading Tag
			 */
			$wp_customize->add_setting(
				'havoc_page_header_heading_tag',
				array(
					'default'           => 'h1',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_header_heading_tag',
					array(
						'label'    => esc_html__( 'Heading Tag', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_page_header_heading_tag',
						'priority' => 10,
						'choices'  => array(
							'h1'   => esc_html__( 'H1', 'havocwp' ),
							'h2'   => esc_html__( 'H2', 'havocwp' ),
							'h3'   => esc_html__( 'H3', 'havocwp' ),
							'h4'   => esc_html__( 'H4', 'havocwp' ),
							'h5'   => esc_html__( 'H5', 'havocwp' ),
							'h6'   => esc_html__( 'H6', 'havocwp' ),
							'div'  => esc_html__( 'div', 'havocwp' ),
							'span' => esc_html__( 'span', 'havocwp' ),
							'p'    => esc_html__( 'p', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Style
			 */
			$wp_customize->add_setting(
				'havoc_page_header_style',
				array(
					'default'           => '',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_header_style',
					array(
						'label'    => esc_html__( 'Style', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_page_header_style',
						'priority' => 10,
						'choices'  => array(
							''                 => esc_html__( 'Default', 'havocwp' ),
							'centered'         => esc_html__( 'Centered', 'havocwp' ),
							'centered-minimal' => esc_html__( 'Centered Minimal', 'havocwp' ),
							'background-image' => esc_html__( 'Background Image', 'havocwp' ),
							'hidden'           => esc_html__( 'Hidden', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image
			 */
			$wp_customize->add_setting(
				'havoc_page_header_bg_image',
				array(
					'sanitize_callback' => 'havocwp_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'havoc_page_header_bg_image',
					array(
						'label'           => esc_html__( 'Image', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_bg_image',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Background Image Title/Breadcrumb Position
			 */
			$wp_customize->add_setting(
				'havoc_page_header_bg_title_breadcrumb_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'center',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_page_header_bg_title_breadcrumb_position',
					array(
						'label'           => esc_html__( 'Title/Breadcrumb Position', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_bg_title_breadcrumb_position',
						'priority'        => 10,
						'choices'         => array(
							'left'   => esc_html__( 'Left', 'havocwp' ),
							'center' => esc_html__( 'Center', 'havocwp' ),
							'right'  => esc_html__( 'Right', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Background Image Position
			 */
			$wp_customize->add_setting(
				'havoc_page_header_bg_image_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'top center',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_header_bg_image_position',
					array(
						'label'           => esc_html__( 'Position', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_bg_image_position',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_bg_image_page_header',
						'choices'         => array(
							'initial'       => esc_html__( 'Default', 'havocwp' ),
							'top left'      => esc_html__( 'Top Left', 'havocwp' ),
							'top center'    => esc_html__( 'Top Center', 'havocwp' ),
							'top right'     => esc_html__( 'Top Right', 'havocwp' ),
							'center left'   => esc_html__( 'Center Left', 'havocwp' ),
							'center center' => esc_html__( 'Center Center', 'havocwp' ),
							'center right'  => esc_html__( 'Center Right', 'havocwp' ),
							'bottom left'   => esc_html__( 'Bottom Left', 'havocwp' ),
							'bottom center' => esc_html__( 'Bottom Center', 'havocwp' ),
							'bottom right'  => esc_html__( 'Bottom Right', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image Attachment
			 */
			$wp_customize->add_setting(
				'havoc_page_header_bg_image_attachment',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_header_bg_image_attachment',
					array(
						'label'           => esc_html__( 'Attachment', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_bg_image_attachment',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_bg_image_page_header',
						'choices'         => array(
							'initial' => esc_html__( 'Default', 'havocwp' ),
							'scroll'  => esc_html__( 'Scroll', 'havocwp' ),
							'fixed'   => esc_html__( 'Fixed', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image Repeat
			 */
			$wp_customize->add_setting(
				'havoc_page_header_bg_image_repeat',
				array(
					'transport'         => 'postMessage',
					'default'           => 'no-repeat',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_header_bg_image_repeat',
					array(
						'label'           => esc_html__( 'Repeat', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_bg_image_repeat',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_bg_image_page_header',
						'choices'         => array(
							'initial'   => esc_html__( 'Default', 'havocwp' ),
							'no-repeat' => esc_html__( 'No-repeat', 'havocwp' ),
							'repeat'    => esc_html__( 'Repeat', 'havocwp' ),
							'repeat-x'  => esc_html__( 'Repeat-x', 'havocwp' ),
							'repeat-y'  => esc_html__( 'Repeat-y', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image Size
			 */
			$wp_customize->add_setting(
				'havoc_page_header_bg_image_size',
				array(
					'transport'         => 'postMessage',
					'default'           => 'cover',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_page_header_bg_image_size',
					array(
						'label'           => esc_html__( 'Size', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_bg_image_size',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_bg_image_page_header',
						'choices'         => array(
							'initial' => esc_html__( 'Default', 'havocwp' ),
							'auto'    => esc_html__( 'Auto', 'havocwp' ),
							'cover'   => esc_html__( 'Cover', 'havocwp' ),
							'contain' => esc_html__( 'Contain', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Page Title Background Image Height
			 */
			$wp_customize->add_setting(
				'havoc_page_header_bg_image_height',
				array(
					'transport'         => 'postMessage',
					'default'           => '400',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_page_header_bg_image_height',
					array(
						'label'           => esc_html__( 'Height (px)', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_bg_image_height',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 800,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Background Image Overlay Opacity
			 */
			$wp_customize->add_setting(
				'havoc_page_header_bg_image_overlay_opacity',
				array(
					'transport'         => 'postMessage',
					'default'           => '0.5',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_page_header_bg_image_overlay_opacity',
					array(
						'label'           => esc_html__( 'Overlay Opacity', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_bg_image_overlay_opacity',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 1,
							'step' => 0.1,
						),
						'active_callback' => 'havocwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Background Image Overlay Color
			 */
			$wp_customize->add_setting(
				'havoc_page_header_bg_image_overlay_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#000000',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_page_header_bg_image_overlay_color',
					array(
						'label'           => esc_html__( 'Overlay Color', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_bg_image_overlay_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Padding
			 */
			$wp_customize->add_setting(
				'havoc_page_header_top_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '34',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_page_header_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '34',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'havoc_page_header_tablet_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_page_header_tablet_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'havoc_page_header_mobile_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_page_header_mobile_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Dimensions_Control(
					$wp_customize,
					'havoc_page_header_padding',
					array(
						'label'       => esc_html__( 'Padding (px)', 'havocwp' ),
						'section'     => 'havoc_general_page_header',
						'settings'    => array(
							'desktop_top'    => 'havoc_page_header_top_padding',
							'desktop_bottom' => 'havoc_page_header_bottom_padding',
							'tablet_top'     => 'havoc_page_header_tablet_top_padding',
							'tablet_bottom'  => 'havoc_page_header_tablet_bottom_padding',
							'mobile_top'     => 'havoc_page_header_mobile_top_padding',
							'mobile_bottom'  => 'havoc_page_header_mobile_bottom_padding',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Page Title Background Color
			 */
			$wp_customize->add_setting(
				'havoc_page_header_background',
				array(
					'transport'         => 'postMessage',
					'default'           => '#f5f5f5',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_page_header_background',
					array(
						'label'           => esc_html__( 'Background Color', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_page_header_background',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_hasnt_bg_image_page_header',
					)
				)
			);

			/**
			 * Page Title Color
			 */
			$wp_customize->add_setting(
				'havoc_page_header_title_color',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_page_header_title_color',
					array(
						'label'    => esc_html__( 'Text Color', 'havocwp' ),
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_page_header_title_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Breadcrumbs Heading
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumbs_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Heading_Control(
					$wp_customize,
					'havoc_breadcrumbs_heading',
					array(
						'label'    => esc_html__( 'Breadcrumbs', 'havocwp' ),
						'section'  => 'havoc_general_page_header',
						'priority' => 10,
					)
				)
			);

			/**
			 * Breadcrumbs
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumbs',
				array(
					'default'           => true,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumbs',
					array(
						'label'    => esc_html__( 'Enable Breadcrumbs', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumbs',
						'priority' => 10,
					)
				)
			);

			/**
			 * Breadcrumbs Item Title
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumb_show_title',
				array(
					'default'           => true,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumb_show_title',
					array(
						'label'    => esc_html__( 'Show Item Title', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumb_show_title',
						'priority' => 10,
					)
				)
			);

			/**
			 * Breadcrumbs Schema
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumb_schema',
				array(
					'default'           => true,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumb_schema',
					array(
						'label'    => esc_html__( 'Enable Breadcrumb Schema', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumb_schema',
						'priority' => 10,
					)
				)
			);

			if ( HAVOCWP_WOOCOMMERCE_ACTIVE ) {

				/**
				 * WooCommerce breadcrumbs for Woo Pages
				 */
				$wp_customize->add_setting(
					'havoc_breadcrumb_woocommerce',
					array(
						'default'           => 'no',
						'sanitize_callback' => 'havocwp_sanitize_select',
					)
				);

				$wp_customize->add_control(
					new HavocWP_Customizer_Buttonset_Control(
						$wp_customize,
						'havoc_breadcrumb_woocommerce',
						array(
							'label'       => esc_html__( 'WooCommerce Breadcrumbs', 'havocwp' ),
							'description' => esc_html__( 'Enable this option to show the WooCommerce breadcrumbs for Woo pages.', 'havocwp' ),
							'section'     => 'havoc_general_page_header',
							'settings'    => 'havoc_breadcrumb_woocommerce',
							'priority'    => 10,
							'choices'     => array(
								'yes'  => esc_html__( 'Yes', 'havocwp' ),
								'no' => esc_html__( 'No', 'havocwp' ),
							),
						)
					)
				);
			}

			/**
			 * Breadcrumbs Source
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumbs_source',
				array(
					'default'           => 'default',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumbs_source',
					array(
						'label'           => esc_html__( 'Breadcrumbs Source', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_breadcrumbs_source',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_breadcrumbs',
						'choices'         => havocwp_get_breadcrumbs_source_list(),
					)
				)
			);

			/**
			 * Breadcrumbs Position
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumbs_position',
				array(
					'default'           => '',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumbs_position',
					array(
						'label'           => esc_html__( 'Position', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_breadcrumbs_position',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_breadcrumbs',
						'choices'         => array(
							''            => esc_html__( 'Absolute Right', 'havocwp' ),
							'under-title' => esc_html__( 'Under Title', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Breadcrumb Separator
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumb_separator',
				array(
					'transport'         => 'postMessage',
					'default'           => '>',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumb_separator',
					array(
						'label'    => esc_html__( 'Breadcrumb Separator', 'havocwp' ),
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumb_separator',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Home Item
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumb_home_item',
				array(
					'transport'         => 'postMessage',
					'default'           => 'icon',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_breadcrumb_home_item',
					array(
						'label'    => esc_html__( 'Home Item', 'havocwp' ),
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumb_home_item',
						'priority' => 10,
						'choices'  => array(
							'icon' => esc_html__( 'Icon', 'havocwp' ),
							'text' => esc_html__( 'Text', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Translation for Homepage
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumb_translation_home',
				array(
					'transport'         => 'postMessage',
					'default'           => esc_html__( 'Home', 'havocwp' ),
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumb_translation_home',
					array(
						'label'    => esc_html__( 'Translation for Homepage', 'havocwp' ),
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumb_translation_home',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Translation for "404 Not Found"
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumb_translation_error',
				array(
					'transport'         => 'postMessage',
					'default'           => esc_html__( '404 Not Found', 'havocwp' ),
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumb_translation_error',
					array(
						'label'    => esc_html__( 'Translation for "404 Not Found"', 'havocwp' ),
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumb_translation_error',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Translation for "Search results for"
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumb_translation_search',
				array(
					'transport'         => 'postMessage',
					'default'           => esc_html__( 'Search results for', 'havocwp' ),
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumb_translation_search',
					array(
						'label'    => esc_html__( 'Translation for "Search results for"', 'havocwp' ),
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumb_translation_search',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Posts Taxonomy
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumb_posts_taxonomy',
				array(
					'default'           => 'category',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumb_posts_taxonomy',
					array(
						'label'    => esc_html__( 'Posts Taxonomy', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumb_posts_taxonomy',
						'priority' => 10,
						'choices'  => array(
							'none'     => esc_html__( 'None', 'havocwp' ),
							'category' => esc_html__( 'Category', 'havocwp' ),
							'post_tag' => esc_html__( 'Tag', 'havocwp' ),
							'blog'     => esc_html__( 'Blog Page', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Products Taxonomy
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumb_products_taxonomy',
				array(
					'default'           => 'shop',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_breadcrumb_products_taxonomy',
					array(
						'label'    => esc_html__( 'Products Taxonomy', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_general_page_header',
						'settings' => 'havoc_breadcrumb_products_taxonomy',
						'priority' => 10,
						'choices'  => array(
							'none'        => esc_html__( 'None', 'havocwp' ),
							'product_cat' => esc_html__( 'Category', 'havocwp' ),
							'product_tag' => esc_html__( 'Tag', 'havocwp' ),
							'shop'        => esc_html__( 'Shop Page', 'havocwp' ),
						),
					)
				)
			);

			// If Havoc Portfolio plugin is activated.
			if ( class_exists( 'Havoc_Portfolio' ) ) {

				/**
				 * Portfolio Taxonomy
				 */
				$wp_customize->add_setting(
					'havoc_breadcrumb_portfolio_taxonomy',
					array(
						'default'           => 'havoc_portfolio_category',
						'sanitize_callback' => 'havocwp_sanitize_select',
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'havoc_breadcrumb_portfolio_taxonomy',
						array(
							'label'    => esc_html__( 'Portfolio Taxonomy', 'havocwp' ),
							'type'     => 'select',
							'section'  => 'havoc_general_page_header',
							'settings' => 'havoc_breadcrumb_portfolio_taxonomy',
							'priority' => 10,
							'choices'  => array(
								'none'                     => esc_html__( 'None', 'havocwp' ),
								'havoc_portfolio_category' => esc_html__( 'Category', 'havocwp' ),
								'havoc_portfolio_tag'      => esc_html__( 'Tag', 'havocwp' ),
								'portfolio'                => esc_html__( 'Portfolio Page', 'havocwp' ),
							),
						)
					)
				);

			}

			/**
			 * Breadcrumbs Text Color
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumbs_text_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#c6c6c6',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_breadcrumbs_text_color',
					array(
						'label'           => esc_html__( 'Text Color', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_breadcrumbs_text_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_breadcrumbs',
					)
				)
			);

			/**
			 * Breadcrumbs Separator Color
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumbs_seperator_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#c6c6c6',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_breadcrumbs_seperator_color',
					array(
						'label'           => esc_html__( 'Separator Color', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_breadcrumbs_seperator_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_breadcrumbs',
					)
				)
			);

			/**
			 * Breadcrumbs Link Color
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumbs_link_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_breadcrumbs_link_color',
					array(
						'label'           => esc_html__( 'Link Color', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_breadcrumbs_link_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_breadcrumbs',
					)
				)
			);

			/**
			 * Breadcrumbs Link Color
			 */
			$wp_customize->add_setting(
				'havoc_breadcrumbs_link_color_hover',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_breadcrumbs_link_color_hover',
					array(
						'label'           => esc_html__( 'Link Color: Hover', 'havocwp' ),
						'section'         => 'havoc_general_page_header',
						'settings'        => 'havoc_breadcrumbs_link_color_hover',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_breadcrumbs',
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_general_scroll_top',
				array(
					'title'    => esc_html__( 'Scroll To Top', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Scroll To Top
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top',
				array(
					'default'           => true,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_scroll_top',
					array(
						'label'    => esc_html__( 'Scroll Up Button', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_scroll_top',
						'settings' => 'havoc_scroll_top',
						'priority' => 10,
					)
				)
			);

			/**
			 * Scroll Top Arrow
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_arrow',
				array(
					'default'           => 'angle_up',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Icon_Select_Multi_Control(
					$wp_customize,
					'havoc_scroll_top_arrow',
					array(
						'label'           => esc_html__( 'Arrow Icon', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'type'            => 'select',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
						'choices'         => havocwp_get_scrolltotop_icons( 'up_arrows' ),
					)
				)
			);

			/**
			 * Scroll Top Position
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'right',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_scroll_top_position',
					array(
						'label'           => esc_html__( 'Position', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'settings'        => 'havoc_scroll_top_position',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
						'choices'         => array(
							'left'  => esc_html__( 'Left', 'havocwp' ),
							'right' => esc_html__( 'Right', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Scroll Top Bottom Position
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_bottom_position',
				array(
					'transport'         => 'postMessage',
					'default'           => '20',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_scroll_top_bottom_position',
					array(
						'label'           => esc_html__( 'Bottom Position (px)', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'settings'        => 'havoc_scroll_top_bottom_position',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Scroll Top Size
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_size',
				array(
					'transport'         => 'postMessage',
					'default'           => '40',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_scroll_top_size',
					array(
						'label'           => esc_html__( 'Button Size (px)', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'settings'        => 'havoc_scroll_top_size',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 60,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Scroll Top Icon Size
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_icon_size',
				array(
					'transport'         => 'postMessage',
					'default'           => '18',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_scroll_top_icon_size',
					array(
						'label'           => esc_html__( 'Icon Size (px)', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'settings'        => 'havoc_scroll_top_icon_size',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 60,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Scroll Top Border Radius
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_border_radius',
				array(
					'transport'         => 'postMessage',
					'default'           => '2',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_scroll_top_border_radius',
					array(
						'label'           => esc_html__( 'Border Radius (px)', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'settings'        => 'havoc_scroll_top_border_radius',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Scroll Top Background Color
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => 'rgba(0,0,0,0.4)',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_scroll_top_bg',
					array(
						'label'           => esc_html__( 'Background Color', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'settings'        => 'havoc_scroll_top_bg',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
					)
				)
			);

			/**
			 * Scroll Top Background Hover Color
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_bg_hover',
				array(
					'transport'         => 'postMessage',
					'default'           => 'rgba(0,0,0,0.8)',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_scroll_top_bg_hover',
					array(
						'label'           => esc_html__( 'Background Color: Hover', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'settings'        => 'havoc_scroll_top_bg_hover',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
					)
				)
			);

			/**
			 * Scroll Top Color
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_scroll_top_color',
					array(
						'label'           => esc_html__( 'Color', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'settings'        => 'havoc_scroll_top_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
					)
				)
			);

			/**
			 * Scroll Top Hover Color
			 */
			$wp_customize->add_setting(
				'havoc_scroll_top_color_hover',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_scroll_top_color_hover',
					array(
						'label'           => esc_html__( 'Color: Hover', 'havocwp' ),
						'section'         => 'havoc_general_scroll_top',
						'settings'        => 'havoc_scroll_top_color_hover',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_scrolltop',
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_general_pagination',
				array(
					'title'    => esc_html__( 'Pagination', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Pagination Align
			 */
			$wp_customize->add_setting(
				'havoc_pagination_align',
				array(
					'transport'         => 'postMessage',
					'default'           => 'right',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_pagination_align',
					array(
						'label'    => esc_html__( 'Align', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_general_pagination',
						'settings' => 'havoc_pagination_align',
						'priority' => 10,
						'choices'  => array(
							'right'  => esc_html__( 'Right', 'havocwp' ),
							'center' => esc_html__( 'Center', 'havocwp' ),
							'left'   => esc_html__( 'Left', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Pagination Font Size
			 */
			$wp_customize->add_setting(
				'havoc_pagination_font_size',
				array(
					'transport'         => 'postMessage',
					'default'           => '18',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_pagination_font_size',
					array(
						'label'       => esc_html__( 'Font Size (px)', 'havocwp' ),
						'section'     => 'havoc_general_pagination',
						'settings'    => 'havoc_pagination_font_size',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Pagination Border Width
			 */
			$wp_customize->add_setting(
				'havoc_pagination_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_pagination_border_width',
					array(
						'label'       => esc_html__( 'Border Width (px)', 'havocwp' ),
						'section'     => 'havoc_general_pagination',
						'settings'    => 'havoc_pagination_border_width',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 20,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Pagination Background Color
			 */
			$wp_customize->add_setting(
				'havoc_pagination_bg',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_pagination_bg',
					array(
						'label'    => esc_html__( 'Background Color', 'havocwp' ),
						'section'  => 'havoc_general_pagination',
						'settings' => 'havoc_pagination_bg',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Background Color Hover
			 */
			$wp_customize->add_setting(
				'havoc_pagination_hover_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#f8f8f8',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_pagination_hover_bg',
					array(
						'label'    => esc_html__( 'Background Color: Hover', 'havocwp' ),
						'section'  => 'havoc_general_pagination',
						'settings' => 'havoc_pagination_hover_bg',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Color
			 */
			$wp_customize->add_setting(
				'havoc_pagination_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#555555',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_pagination_color',
					array(
						'label'    => esc_html__( 'Color', 'havocwp' ),
						'section'  => 'havoc_general_pagination',
						'settings' => 'havoc_pagination_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Color Hover
			 */
			$wp_customize->add_setting(
				'havoc_pagination_hover_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_pagination_hover_color',
					array(
						'label'    => esc_html__( 'Color: Hover', 'havocwp' ),
						'section'  => 'havoc_general_pagination',
						'settings' => 'havoc_pagination_hover_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Border Color
			 */
			$wp_customize->add_setting(
				'havoc_pagination_border_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#e9e9e9',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_pagination_border_color',
					array(
						'label'    => esc_html__( 'Border Color', 'havocwp' ),
						'section'  => 'havoc_general_pagination',
						'settings' => 'havoc_pagination_border_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Pagination Border Color Hover
			 */
			$wp_customize->add_setting(
				'havoc_pagination_border_hover_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#e9e9e9',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_pagination_border_hover_color',
					array(
						'label'    => esc_html__( 'Border Color: Hover', 'havocwp' ),
						'section'  => 'havoc_general_pagination',
						'settings' => 'havoc_pagination_border_hover_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_general_forms',
				array(
					'title'    => esc_html__( 'Forms (Input - Textarea)', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Forms Label Color
			 */
			$wp_customize->add_setting(
				'havoc_label_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#929292',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_label_color',
					array(
						'label'    => esc_html__( 'Label Color', 'havocwp' ),
						'section'  => 'havoc_general_forms',
						'settings' => 'havoc_label_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Forms Padding
			 */
			$wp_customize->add_setting(
				'havoc_input_top_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '6',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_right_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '12',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '6',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_left_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '12',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'havoc_input_tablet_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_tablet_right_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_tablet_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_tablet_left_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'havoc_input_mobile_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_mobile_right_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_mobile_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_mobile_left_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Dimensions_Control(
					$wp_customize,
					'havoc_input_padding_dimensions',
					array(
						'label'       => esc_html__( 'Padding (px)', 'havocwp' ),
						'section'     => 'havoc_general_forms',
						'settings'    => array(
							'desktop_top'    => 'havoc_input_top_padding',
							'desktop_right'  => 'havoc_input_right_padding',
							'desktop_bottom' => 'havoc_input_bottom_padding',
							'desktop_left'   => 'havoc_input_left_padding',
							'tablet_top'     => 'havoc_input_tablet_top_padding',
							'tablet_right'   => 'havoc_input_tablet_right_padding',
							'tablet_bottom'  => 'havoc_input_tablet_bottom_padding',
							'tablet_left'    => 'havoc_input_tablet_left_padding',
							'mobile_top'     => 'havoc_input_mobile_top_padding',
							'mobile_right'   => 'havoc_input_mobile_right_padding',
							'mobile_bottom'  => 'havoc_input_mobile_bottom_padding',
							'mobile_left'    => 'havoc_input_mobile_left_padding',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Forms Font Size
			 */
			$wp_customize->add_setting(
				'havoc_input_font_size',
				array(
					'transport'         => 'postMessage',
					'default'           => '14',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_input_font_size',
					array(
						'label'       => esc_html__( 'Font Size (px)', 'havocwp' ),
						'section'     => 'havoc_general_forms',
						'settings'    => 'havoc_input_font_size',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Forms Border Width
			 */
			$wp_customize->add_setting(
				'havoc_input_top_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_right_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_bottom_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_left_border_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '1',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'havoc_input_tablet_top_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_tablet_right_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_tablet_bottom_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_tablet_left_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'havoc_input_mobile_top_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_mobile_right_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_mobile_bottom_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_input_mobile_left_border_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Dimensions_Control(
					$wp_customize,
					'havoc_input_border_width_dimensions',
					array(
						'label'       => esc_html__( 'Border Width (px)', 'havocwp' ),
						'section'     => 'havoc_general_forms',
						'settings'    => array(
							'desktop_top'    => 'havoc_input_top_border_width',
							'desktop_right'  => 'havoc_input_right_border_width',
							'desktop_bottom' => 'havoc_input_bottom_border_width',
							'desktop_left'   => 'havoc_input_left_border_width',
							'tablet_top'     => 'havoc_input_tablet_top_border_width',
							'tablet_right'   => 'havoc_input_tablet_right_border_width',
							'tablet_bottom'  => 'havoc_input_tablet_bottom_border_width',
							'tablet_left'    => 'havoc_input_tablet_left_border_width',
							'mobile_top'     => 'havoc_input_mobile_top_border_width',
							'mobile_right'   => 'havoc_input_mobile_right_border_width',
							'mobile_bottom'  => 'havoc_input_mobile_bottom_border_width',
							'mobile_left'    => 'havoc_input_mobile_left_border_width',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Forms Border Radius
			 */
			$wp_customize->add_setting(
				'havoc_input_border_radius',
				array(
					'transport'         => 'postMessage',
					'default'           => '3',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_input_border_radius',
					array(
						'label'       => esc_html__( 'Border Radius (px)', 'havocwp' ),
						'section'     => 'havoc_general_forms',
						'settings'    => 'havoc_input_border_radius',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Forms Border Color
			 */
			$wp_customize->add_setting(
				'havoc_input_border_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#dddddd',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_input_border_color',
					array(
						'label'    => esc_html__( 'Border Color', 'havocwp' ),
						'section'  => 'havoc_general_forms',
						'settings' => 'havoc_input_border_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Forms Border Color Focus
			 */
			$wp_customize->add_setting(
				'havoc_input_border_color_focus',
				array(
					'transport'         => 'postMessage',
					'default'           => '#bbbbbb',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_input_border_color_focus',
					array(
						'label'    => esc_html__( 'Border Color: Focus', 'havocwp' ),
						'section'  => 'havoc_general_forms',
						'settings' => 'havoc_input_border_color_focus',
						'priority' => 10,
					)
				)
			);

			/**
			 * Forms Background Color
			 */
			$wp_customize->add_setting(
				'havoc_input_background',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_input_background',
					array(
						'label'    => esc_html__( 'Background Color', 'havocwp' ),
						'section'  => 'havoc_general_forms',
						'settings' => 'havoc_input_background',
						'priority' => 10,
					)
				)
			);

			/**
			 * Forms Color
			 */
			$wp_customize->add_setting(
				'havoc_input_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_input_color',
					array(
						'label'    => esc_html__( 'Color', 'havocwp' ),
						'section'  => 'havoc_general_forms',
						'settings' => 'havoc_input_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_general_theme_button',
				array(
					'title'    => esc_html__( 'Theme Buttons', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Theme Buttons Padding
			 */
			$wp_customize->add_setting(
				'havoc_theme_button_top_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '14',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_theme_button_right_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '20',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_theme_button_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '14',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);
			$wp_customize->add_setting(
				'havoc_theme_button_left_padding',
				array(
					'transport'         => 'postMessage',
					'default'           => '20',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_setting(
				'havoc_theme_button_tablet_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_theme_button_tablet_right_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_theme_button_tablet_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_theme_button_tablet_left_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_setting(
				'havoc_theme_button_mobile_top_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_theme_button_mobile_right_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_theme_button_mobile_bottom_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);
			$wp_customize->add_setting(
				'havoc_theme_button_mobile_left_padding',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Dimensions_Control(
					$wp_customize,
					'havoc_theme_button_padding_dimensions',
					array(
						'label'       => esc_html__( 'Padding (px)', 'havocwp' ),
						'section'     => 'havoc_general_theme_button',
						'settings'    => array(
							'desktop_top'    => 'havoc_theme_button_top_padding',
							'desktop_right'  => 'havoc_theme_button_right_padding',
							'desktop_bottom' => 'havoc_theme_button_bottom_padding',
							'desktop_left'   => 'havoc_theme_button_left_padding',
							'tablet_top'     => 'havoc_theme_button_tablet_top_padding',
							'tablet_right'   => 'havoc_theme_button_tablet_right_padding',
							'tablet_bottom'  => 'havoc_theme_button_tablet_bottom_padding',
							'tablet_left'    => 'havoc_theme_button_tablet_left_padding',
							'mobile_top'     => 'havoc_theme_button_mobile_top_padding',
							'mobile_right'   => 'havoc_theme_button_mobile_right_padding',
							'mobile_bottom'  => 'havoc_theme_button_mobile_bottom_padding',
							'mobile_left'    => 'havoc_theme_button_mobile_left_padding',
						),
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Theme Buttons Border Radius
			 */
			$wp_customize->add_setting(
				'havoc_theme_button_border_radius',
				array(
					'transport'         => 'postMessage',
					'default'           => '0',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_theme_button_border_radius',
					array(
						'label'       => esc_html__( 'Border Radius (px)', 'havocwp' ),
						'section'     => 'havoc_general_theme_button',
						'settings'    => 'havoc_theme_button_border_radius',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Theme Buttons Background Color
			 */
			$wp_customize->add_setting(
				'havoc_theme_button_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_theme_button_bg',
					array(
						'label'    => esc_html__( 'Background Color', 'havocwp' ),
						'section'  => 'havoc_general_theme_button',
						'settings' => 'havoc_theme_button_bg',
						'priority' => 10,
					)
				)
			);

			/**
			 * Theme Buttons Background Color Hover
			 */
			$wp_customize->add_setting(
				'havoc_theme_button_hover_bg',
				array(
					'transport'         => 'postMessage',
					'default'           => '#0b7cac',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_theme_button_hover_bg',
					array(
						'label'    => esc_html__( 'Background Color: Hover', 'havocwp' ),
						'section'  => 'havoc_general_theme_button',
						'settings' => 'havoc_theme_button_hover_bg',
						'priority' => 10,
					)
				)
			);

			/**
			 * Theme Buttons Color
			 */
			$wp_customize->add_setting(
				'havoc_theme_button_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_theme_button_color',
					array(
						'label'    => esc_html__( 'Color', 'havocwp' ),
						'section'  => 'havoc_general_theme_button',
						'settings' => 'havoc_theme_button_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Theme Buttons Color Hover
			 */
			$wp_customize->add_setting(
				'havoc_theme_button_hover_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ffffff',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_theme_button_hover_color',
					array(
						'label'    => esc_html__( 'Color: Hover', 'havocwp' ),
						'section'  => 'havoc_general_theme_button',
						'settings' => 'havoc_theme_button_hover_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_general_error_page',
				array(
					'title'    => esc_html__( '404 Error Page', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Blank Page
			 */
			$wp_customize->add_setting(
				'havoc_error_page_blank',
				array(
					'default'           => 'off',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_error_page_blank',
					array(
						'label'       => esc_html__( 'Blank Page', 'havocwp' ),
						'description' => esc_html__( 'Enable this option to remove all the elements and have full control of the 404 error page.', 'havocwp' ),
						'section'     => 'havoc_general_error_page',
						'settings'    => 'havoc_error_page_blank',
						'priority'    => 10,
						'choices'     => array(
							'on'  => esc_html__( 'On', 'havocwp' ),
							'off' => esc_html__( 'Off', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Page 404 Logo
			 */
			$wp_customize->add_setting(
				'havoc_404_logo',
				array(
					'default'           => '',
					'sanitize_callback' => 'havocwp_sanitize_image',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'havoc_404_logo',
					array(
						'label'       => esc_html__( '404 Logo', 'havocwp' ),
						'description' => esc_html__( 'Select a 404 logo.', 'havocwp' ),
						'section'     => 'havoc_general_error_page',
						'settings'    => 'havoc_404_logo',
						'priority'    => 10,
					)
				)
			);

			/**
			 * Layout
			 */
			$wp_customize->add_setting(
				'havoc_error_page_layout',
				array(
					'default'           => 'full-width',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Radio_Image_Control(
					$wp_customize,
					'havoc_error_page_layout',
					array(
						'label'    => esc_html__( 'Layout', 'havocwp' ),
						'section'  => 'havoc_general_error_page',
						'settings' => 'havoc_error_page_layout',
						'priority' => 10,
						'choices'  => array(
							'full-width'  => HAVOCWP_INC_DIR_URI . 'customizer/assets/img/fw.png',
							'full-screen' => HAVOCWP_INC_DIR_URI . 'customizer/assets/img/fs.png',
						),
					)
				)
			);

			/**
			 * Template
			 */
			$wp_customize->add_setting(
				'havoc_error_page_template',
				array(
					'default'           => '0',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_error_page_template',
					array(
						'label'       => esc_html__( 'Select Template', 'havocwp' ),
						'description' => esc_html__( 'Choose a template created in Theme Panel > My Library.', 'havocwp' ),
						'type'        => 'select',
						'section'     => 'havoc_general_error_page',
						'settings'    => 'havoc_error_page_template',
						'priority'    => 10,
						'choices'     => havocwp_customizer_helpers( 'library' ),
					)
				)
			);

			/**
			 * Section Theme Icons
			 *
			 * @since 2.0
			 */
			$wp_customize->add_section(
				'havoc_general_theme_icons',
				array(
					'title'    => esc_html__( 'Theme Icons', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Choose Default Theme Icons
			 */
			$wp_customize->add_setting(
				'havoc_theme_default_icons',
				array(
					'default'           => 'sili',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_theme_default_icons',
					array(
						'label'       => esc_html__( 'Select Icons', 'havocwp' ),
						'description' => esc_html__( 'Choose icons you would like to use in the theme.', 'havocwp' ),
						'type'        => 'select',
						'section'     => 'havoc_general_theme_icons',
						'settings'    => 'havoc_theme_default_icons',
						'priority'    => 10,
						'choices'     => array(
							'svg'  => esc_html__( 'Havoc SVG Icons', 'havocwp' ),
							'sili' => esc_html__( 'Simple Line Icons', 'havocwp' ),
							'fai'  => esc_html__( 'Font Awesome Icons', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Blog Entries Meta Icons Color
			 */
			$wp_customize->add_setting(
				'havoc_theme_blog_posts_icons_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_theme_blog_posts_icons_color',
					array(
						'label'    => esc_html__( 'Blog Entries Icons: Color', 'havocwp' ),
						'section'  => 'havoc_general_theme_icons',
						'settings' => 'havoc_theme_blog_posts_icons_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Single Blog Post Meta Icons Color
			 */
			$wp_customize->add_setting(
				'havoc_theme_single_post_icons_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_theme_single_post_icons_color',
					array(
						'label'    => esc_html__( 'Single Post Icons: Color', 'havocwp' ),
						'section'  => 'havoc_general_theme_icons',
						'settings' => 'havoc_theme_single_post_icons_color',
						'priority' => 10,
					)
				)
			);

			/**
			 * Section SEO
			 *
			 * 			 */
			$wp_customize->add_section(
				'havoc_general_seo_settings',
				array(
					'title'    => esc_html__( 'SEO Settings', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Schema Markup
			 */
			$wp_customize->add_setting(
				'havoc_schema_markup',
				array(
					'default'           => true,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_schema_markup',
					array(
						'label'    => esc_html__( 'Enable Schema Markup', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_seo_settings',
						'settings' => 'havoc_schema_markup',
						'priority' => 10,
					)
				)
			);

			/**
			 * Enable image alt text on blog entry featured images
			 */
			$wp_customize->add_setting(
				'havoc_enable_be_fimage_alt',
				array(
					'default'           => false,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_enable_be_fimage_alt',
					array(
						'label'    => esc_html__( 'Use featured image ALT text on blog entries', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_seo_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Enable image alt text on single post featured images
			 */
			$wp_customize->add_setting(
				'havoc_enable_sp_fimage_alt',
				array(
					'default'           => false,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_enable_sp_fimage_alt',
					array(
						'label'    => esc_html__( 'Use featured image ALT text on single posts', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_seo_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Enable image alt text on single post featured images
			 */
			$wp_customize->add_setting(
				'havoc_enable_srp_fimage_alt',
				array(
					'default'           => false,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_enable_srp_fimage_alt',
					array(
						'label'    => esc_html__( 'Use featured image ALT text on single post related items', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_seo_settings',
						'priority' => 10,
					)
				)
			);

			/**
			 * Site breadcrumb info
			 */
			$wp_customize->add_setting(
				'havoc_configure_breadcrumb_link',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Info_Control(
					$wp_customize,
					'havoc_configure_breadcrumb_link',
					array(
						'label'       => esc_html__( 'Configure Breadcrumb', 'havocwp' ),
						'description' => sprintf( esc_html__( 'Go to the %1$s Breadcrumbs settings page %2$s', 'havocwp' ), '<a href="' . admin_url( 'customize.php?autofocus%5Bcontrol%5D=havoc_page_header_visibility' ) . '">', '</a>' ),
						'section'     => 'havoc_general_seo_settings',
						'priority'    => 10,
					)
				)
			);

			/**
			 * Heading Sitewide Identity
			 */
			$wp_customize->add_setting(
				'havoc_opengraph_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Heading_Control(
					$wp_customize,
					'havoc_opengraph_heading',
					array(
						'label'       => esc_html__( 'OpenGraph', 'havocwp' ),
						'description' => esc_html__( 'This is information taken by social media when a link is shared', 'havocwp' ),
						'section'     => 'havoc_general_seo_settings',
						'priority'    => 10,
					)
				)
			);

			/**
			 * Enable OpenGraph
			 */
			$wp_customize->add_setting(
				'havoc_open_graph',
				array(
					'default'           => false,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_open_graph',
					array(
						'label'    => esc_html__( 'Enable OpenGraph', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_general_seo_settings',
						'settings' => 'havoc_open_graph',
						'priority' => 10,
					)
				)
			);

			/**
			 * Twitter Handle
			 */
			$wp_customize->add_setting(
				'havoc_twitter_handle',
				array(
					'default'           => '',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_twitter_handle',
					array(
						'label'    => esc_html__( 'Twitter Username', 'havocwp' ),
						'section'  => 'havoc_general_seo_settings',
						'settings' => 'havoc_twitter_handle',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Facebook Page URL
			 */
			$wp_customize->add_setting(
				'havoc_facebook_page_url',
				array(
					'default'           => '',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_facebook_page_url',
					array(
						'label'    => esc_html__( 'Facebook Page URL', 'havocwp' ),
						'section'  => 'havoc_general_seo_settings',
						'settings' => 'havoc_facebook_page_url',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Facebook App ID
			 */
			$wp_customize->add_setting(
				'havoc_facebook_appid',
				array(
					'default'           => '',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_facebook_appid',
					array(
						'label'    => esc_html__( 'Facebook App ID', 'havocwp' ),
						'section'  => 'havoc_general_seo_settings',
						'settings' => 'havoc_facebook_appid',
						'type'     => 'text',
						'priority' => 10,
					)
				)
			);

			/**
			 * Call Performance Section
			 *
			 * 			 * @return void
			 */
			$this->performance_section( $wp_customize, $panel );
		}

		/**
		 * Performance Section
		 *
		 * @return void
		 *
		 * 		 */
		private function performance_section( $wp_customize, $panel ) {
			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_general_performance_section',
				array(
					'title'    => esc_html__( 'Performance', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Emoji
			 */
			$wp_customize->add_setting(
				'havoc_performance_emoji',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enable',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_performance_emoji',
					array(
						'label'       => esc_html__( 'Emoji', 'havocwp' ),
						'description' => esc_html__( 'This style is all the css for the WP emoji.', 'havocwp' ),
						'section'     => 'havoc_general_performance_section',
						'settings'    => 'havoc_performance_emoji',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'havocwp' ),
							'enabled'  => esc_html__( 'Enabled', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Font Awesome Icons
			 */
			$wp_customize->add_setting(
				'havoc_performance_fontawesome',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_performance_fontawesome',
					array(
						'label'       => esc_html__( 'Font Awesome Icons', 'havocwp' ),
						'description' => esc_html__( 'This style is all the css for the font awesome icons.', 'havocwp' ),
						'section'     => 'havoc_general_performance_section',
						'settings'    => 'havoc_performance_fontawesome',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'havocwp' ),
							'enabled'  => esc_html__( 'Enabled', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Disable HavocWP SVG Icons
			 */
			$wp_customize->add_setting(
				'havoc_disable_svg_icons',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_disable_svg_icons',
					array(
						'label'       => esc_html__( 'Havoc SVG Icons', 'havocwp' ),
						'description' => esc_html__( 'This file is for all the Havoc SVG icons.', 'havocwp' ),
						'section'     => 'havoc_general_performance_section',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'havocwp' ),
							'enabled'  => esc_html__( 'Enabled', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Simple Line Icons
			 */
			$wp_customize->add_setting(
				'havoc_performance_simple_line_icons',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_performance_simple_line_icons',
					array(
						'label'       => esc_html__( 'Simple Line Icons', 'havocwp' ),
						'description' => esc_html__( 'This style is all the css for the simple line icons.', 'havocwp' ),
						'section'     => 'havoc_general_performance_section',
						'settings'    => 'havoc_performance_simple_line_icons',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'havocwp' ),
							'enabled'  => esc_html__( 'Enabled', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Lightbox
			 */
			$wp_customize->add_setting(
				'havoc_performance_lightbox',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_performance_lightbox',
					array(
						'label'       => esc_html__( 'Lightbox', 'havocwp' ),
						'description' => esc_html__( 'This script enables you to overlay your images on the current page, used for the gallerie, single product and content images.', 'havocwp' ),
						'section'     => 'havoc_general_performance_section',
						'settings'    => 'havoc_performance_lightbox',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'havocwp' ),
							'enabled'  => esc_html__( 'Enabled', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Custom Select
			 */
			$wp_customize->add_setting(
				'havoc_performance_custom_select',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_performance_custom_select',
					array(
						'label'       => esc_html__( 'Custom Select', 'havocwp' ),
						'description' => esc_html__( 'This script uses the native select box and add overlays a stylable <span> element in order to acheive the desired look.', 'havocwp' ),
						'section'     => 'havoc_general_performance_section',
						'settings'    => 'havoc_performance_custom_select',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'havocwp' ),
							'enabled'  => esc_html__( 'Enabled', 'havocwp' ),
						),
					)
				)
			);

			if ( class_exists( 'Havoc_Extra' ) ) {

				/**
				 * Disable widgets.css
				 */
				$wp_customize->add_setting(
					'havoc_load_widgets_stylesheet',
					array(
						'transport'         => 'postMessage',
						'default'           => 'enabled',
						'sanitize_callback' => 'havocwp_sanitize_select',
					)
				);

				$wp_customize->add_control(
					new HavocWP_Customizer_Buttonset_Control(
						$wp_customize,
						'havoc_load_widgets_stylesheet',
						array(
							'label'    => esc_html__( 'Widgets Stylesheet Load', 'havocwp' ),
							'description' => esc_html__( 'You can disable loading widgets.css stylesheet on your site.', 'havocwp' ),
							'section'  => 'havoc_general_performance_section',
							'settings' => 'havoc_load_widgets_stylesheet',
							'priority'    => 11,
							'choices'     => array(
								'disabled' => esc_html__( 'Disabled', 'havocwp' ),
								'enabled'  => esc_html__( 'Enabled', 'havocwp' ),
							),
						)
					)
				);
			}

			/**
			 * Scroll Effect
			 */
			$wp_customize->add_setting(
				'havoc_performance_scroll_effect',
				array(
					'transport'         => 'postMessage',
					'default'           => 'enabled',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_performance_scroll_effect',
					array(
						'label'       => esc_html__( 'Scroll Effect', 'havocwp' ),
						'description' => esc_html__( 'This script is responsible for the scroll effect in theme.', 'havocwp' ),
						'section'     => 'havoc_general_performance_section',
						'settings'    => 'havoc_performance_scroll_effect',
						'priority'    => 10,
						'choices'     => array(
							'disabled' => esc_html__( 'Disabled', 'havocwp' ),
							'enabled'  => esc_html__( 'Enabled', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Scroll offset
			 */
			$wp_customize->add_setting(
				'havoc_scroll_effect_offset_value',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_scroll_effect_offset_value',
					array(
						'label'           => esc_html__( 'Scroll Effect - Custom Offset', 'havocwp' ),
						'type'            => 'number',
						'section'         => 'havoc_general_performance_section',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 600,
							'step' => 1,
						),
					)
				)
			);

		}

		/**
		 * Helpers
		 *
		 * 		 * @param object $return    return template.
		 */
		public static function helpers( $return = null ) {

			// Return elementor templates array.
			if ( 'elementor' === $return ) {
				$templates     = array( esc_html__( 'Default', 'havocwp' ) );
				$get_templates = get_posts(
					array(
						'post_type'   => 'elementor_library',
						'numberposts' => -1,
						'post_status' => 'publish',
					)
				);

				if ( ! empty( $get_templates ) ) {
					foreach ( $get_templates as $template ) {
						$templates[ $template->ID ] = $template->post_title;
					}
				}

				return $templates;
			}

		}

		/**
		 * Get post types
		 *
		 * 		 * @param object $args    post type.
		 */
		private static function get_post_types( $args = array() ) {
			$post_type_args = array(
				'show_in_nav_menus' => true,
			);

			if ( ! empty( $args['post_type'] ) ) {
				$post_type_args['name'] = $args['post_type'];
			}

			$_post_types = get_post_types( $post_type_args, 'objects' );

			$post_types        = array();
			$post_types['any'] = esc_html__( 'All Post Types', 'havocwp' );

			foreach ( $_post_types as $post_type => $object ) {
				$post_types[ $post_type ] = $object->label;
			}

			return $post_types;
		}

		/**
		 * Generates arrays of elements to target
		 *
		 * 		 * @param object $return    return value.
		 */
		private static function primary_color_arrays( $return ) {

			// Texts.
			$texts = apply_filters(
				'havoc_primary_texts',
				array(
					'a:hover',
					'a.light:hover',
					'.theme-heading .text::before',
					'.theme-heading .text::after',
					'#top-bar-content > a:hover',
					'#top-bar-social li.havocwp-email a:hover',
					'#site-navigation-wrap .dropdown-menu > li > a:hover',
					'#site-header.medium-header #medium-searchform button:hover',
					'.havocwp-mobile-menu-icon a:hover',
					'.blog-entry.post .blog-entry-header .entry-title a:hover',
					'.blog-entry.post .blog-entry-readmore a:hover',
					'.blog-entry.thumbnail-entry .blog-entry-category a',
					'ul.meta li a:hover',
					'.dropcap',
					'.single nav.post-navigation .nav-links .title',
					'body .related-post-title a:hover',
					'body #wp-calendar caption',
					'body .contact-info-widget.default i',
					'body .contact-info-widget.big-icons i',
					'body .custom-links-widget .havocwp-custom-links li a:hover',
					'body .custom-links-widget .havocwp-custom-links li a:hover:before',
					'body .posts-thumbnails-widget li a:hover',
					'body .social-widget li.havocwp-email a:hover',
					'.comment-author .comment-meta .comment-reply-link',
					'#respond #cancel-comment-reply-link:hover',
					'#footer-widgets .footer-box a:hover',
					'#footer-bottom a:hover',
					'#footer-bottom #footer-bottom-menu a:hover',
					'.sidr a:hover',
					'.sidr-class-dropdown-toggle:hover',
					'.sidr-class-menu-item-has-children.active > a',
					'.sidr-class-menu-item-has-children.active > a > .sidr-class-dropdown-toggle',
					'input[type=checkbox]:checked:before',
				)
			);

			// SVG Icon color.
			$svg_icons = apply_filters(
				'havoc_primary_svg_icons',
				array(
					'.single nav.post-navigation .nav-links .title .hvc-icon use',
					'.blog-entry.post .blog-entry-readmore a:hover .hvc-icon use',
					'body .contact-info-widget.default .hvc-icon use',
					'body .contact-info-widget.big-icons .hvc-icon use',
				)
			);

			// Backgrounds.
			$backgrounds = apply_filters(
				'havoc_primary_backgrounds',
				array(
					'input[type="button"]',
					'input[type="reset"]',
					'input[type="submit"]',
					'button[type="submit"]',
					'.button',
					'#site-navigation-wrap .dropdown-menu > li.btn > a > span',
					'.thumbnail:hover i',
					'.post-quote-content',
					'.omw-modal .omw-close-modal',
					'body .contact-info-widget.big-icons li:hover i',
					'body div.wpforms-container-full .wpforms-form input[type=submit]',
					'body div.wpforms-container-full .wpforms-form button[type=submit]',
					'body div.wpforms-container-full .wpforms-form .wpforms-page-button',
				)
			);

			// Borders.
			$borders = apply_filters(
				'havoc_primary_borders',
				array(
					'.widget-title',
					'blockquote',
					'#searchform-dropdown',
					'.dropdown-menu .sub-menu',
					'.blog-entry.large-entry .blog-entry-readmore a:hover',
					'.havocwp-newsletter-form-wrap input[type="email"]:focus',
					'.social-widget li.havocwp-email a:hover',
					'#respond #cancel-comment-reply-link:hover',
					'body .contact-info-widget.big-icons li:hover i',
					'#footer-widgets .havocwp-newsletter-form-wrap input[type="email"]:focus',
				)
			);

			// Return array.
			if ( 'texts' === $return ) {
				return $texts;
			} elseif ( 'svg_icons' === $return ) {
				return $svg_icons;
			} elseif ( 'backgrounds' === $return ) {
				return $backgrounds;
			} elseif ( 'borders' === $return ) {
				return $borders;
			}

		}

		/**
		 * Generates array of elements to target
		 *
		 * 		 * @param object $return    return value.
		 */
		private static function hover_primary_color_array( $return ) {

			// Hover backgrounds.
			$hover = apply_filters(
				'havoc_hover_primary_backgrounds',
				array(
					'input[type="button"]:hover',
					'input[type="reset"]:hover',
					'input[type="submit"]:hover',
					'button[type="submit"]:hover',
					'input[type="button"]:focus',
					'input[type="reset"]:focus',
					'input[type="submit"]:focus',
					'button[type="submit"]:focus',
					'.button:hover',
					'.button:focus',
					'#site-navigation-wrap .dropdown-menu > li.btn > a:hover > span',
					'.post-quote-author',
					'.omw-modal .omw-close-modal:hover',
					'body div.wpforms-container-full .wpforms-form input[type=submit]:hover',
					'body div.wpforms-container-full .wpforms-form button[type=submit]:hover',
					'body div.wpforms-container-full .wpforms-form .wpforms-page-button:hover',
				)
			);

			// Return array.
			if ( 'hover' === $return ) {
				return $hover;
			}

		}

		/**
		 * Returns array of elements and border style to apply
		 *
		 * 		 */
		private static function main_border_array() {

			return apply_filters(
				'havoc_border_color_elements',
				array(

					// General.
					'table th',
					'table td',
					'hr',
					'.content-area',
					'body.content-left-sidebar #content-wrap .content-area,
					.content-left-sidebar .content-area',

					// Top bar.
					'#top-bar-wrap',

					// Header.
					'#site-header',

					// Search top header.
					'#site-header.top-header #search-toggle',

					// Dropdown.
					'.dropdown-menu ul li',

					// Page header.
					'.centered-minimal-page-header',

					// Blog.
					'.blog-entry.post',

					'.blog-entry.grid-entry .blog-entry-inner',

					'.blog-entry.thumbnail-entry .blog-entry-bottom',

					'.single-post .entry-title',

					'.single .entry-share-wrap .entry-share',
					'.single .entry-share',
					'.single .entry-share ul li a',

					'.single nav.post-navigation',
					'.single nav.post-navigation .nav-links .nav-previous',

					'#author-bio',
					'#author-bio .author-bio-avatar',
					'#author-bio .author-bio-social li a',

					'#related-posts',

					'#comments',
					'.comment-body',
					'#respond #cancel-comment-reply-link',

					'#blog-entries .type-page',

					// Pagination.
					'.page-numbers a,
					.page-numbers span:not(.elementor-screen-only),
					.page-links span',

					// Widgets.
					'body #wp-calendar caption,
					body #wp-calendar th,
					body #wp-calendar tbody',

					'body .contact-info-widget.default i,
					body .contact-info-widget.big-icons i',

					'body .posts-thumbnails-widget li',

					'body .tagcloud a',

				)
			);

		}

		/**
		 * Get CSS
		 *
		 * @param obj $output    css output.
		 * 		 */
		public function head_css( $output ) {

			// Global vars.
			$primary_color                 = get_theme_mod( 'havoc_primary_color', '#13aff0' );
			$hover_primary_color           = get_theme_mod( 'havoc_hover_primary_color', '#0b7cac' );
			$main_border_color             = get_theme_mod( 'havoc_main_border_color', '#e9e9e9' );
			$background_color              = get_theme_mod( 'havoc_background_color', '#ffffff' );
			$background_image              = get_theme_mod( 'havoc_background_image' );
			$background_image_position     = get_theme_mod( 'havoc_background_image_position' );
			$background_image_attachment   = get_theme_mod( 'havoc_background_image_attachment' );
			$background_image_repeat       = get_theme_mod( 'havoc_background_image_repeat' );
			$background_image_size         = get_theme_mod( 'havoc_background_image_size' );
			$links_color                   = get_theme_mod( 'havoc_links_color', '#333333' );
			$links_color_hover             = get_theme_mod( 'havoc_links_color_hover', '#13aff0' );
			$boxed_width                   = get_theme_mod( 'havoc_boxed_width', '1280' );
			$boxed_outside_bg              = get_theme_mod( 'havoc_boxed_outside_bg', '#e9e9e9' );
			$separate_outside_bg           = get_theme_mod( 'havoc_separate_outside_bg', '#f1f1f1' );
			$boxed_inner_bg                = get_theme_mod( 'havoc_boxed_inner_bg', '#ffffff' );
			$separate_content_padding      = get_theme_mod( 'havoc_separate_content_padding', '30px' );
			$separate_widgets_padding      = get_theme_mod( 'havoc_separate_widgets_padding', '30px' );
			$main_container_width          = get_theme_mod( 'havoc_main_container_width', '1200' );
			$left_container_width          = get_theme_mod( 'havoc_left_container_width', '72' );
			$sidebar_width                 = get_theme_mod( 'havoc_sidebar_width', '28' );
			$content_top_padding           = get_theme_mod( 'havoc_page_content_top_padding' );
			$content_bottom_padding        = get_theme_mod( 'havoc_page_content_bottom_padding' );
			$tablet_content_top_padding    = get_theme_mod( 'havoc_page_content_tablet_top_padding' );
			$tablet_content_bottom_padding = get_theme_mod( 'havoc_page_content_tablet_bottom_padding' );
			$mobile_content_top_padding    = get_theme_mod( 'havoc_page_content_mobile_top_padding' );
			$mobile_content_bottom_padding = get_theme_mod( 'havoc_page_content_mobile_bottom_padding' );
			$title_breadcrumb_position     = get_theme_mod( 'havoc_page_header_bg_title_breadcrumb_position', 'center' );
			$page_header_top_padding       = get_theme_mod( 'havoc_page_header_top_padding', '34' );
			$page_header_bottom_padding    = get_theme_mod( 'havoc_page_header_bottom_padding', '34' );
			$tablet_ph_top_padding         = get_theme_mod( 'havoc_page_header_tablet_top_padding' );
			$tablet_ph_bottom_padding      = get_theme_mod( 'havoc_page_header_tablet_bottom_padding' );
			$mobile_ph_top_padding         = get_theme_mod( 'havoc_page_header_mobile_top_padding' );
			$mobile_ph_bottom_padding      = get_theme_mod( 'havoc_page_header_mobile_bottom_padding' );
			$page_header_title_color       = get_theme_mod( 'havoc_page_header_title_color' );
			$breadcrumbs_text_color        = get_theme_mod( 'havoc_breadcrumbs_text_color', '#c6c6c6' );
			$breadcrumbs_seperator_color   = get_theme_mod( 'havoc_breadcrumbs_seperator_color', '#c6c6c6' );
			$breadcrumbs_link_color        = get_theme_mod( 'havoc_breadcrumbs_link_color', '#333333' );
			$breadcrumbs_link_color_hover  = get_theme_mod( 'havoc_breadcrumbs_link_color_hover', '#13aff0' );
			$scroll_top_bottom_position    = get_theme_mod( 'havoc_scroll_top_bottom_position', '20' );
			$scroll_top_size               = get_theme_mod( 'havoc_scroll_top_size', '40' );
			$scroll_top_icon_size          = get_theme_mod( 'havoc_scroll_top_icon_size', '18' );
			$scroll_top_border_radius      = get_theme_mod( 'havoc_scroll_top_border_radius', '2' );
			$scroll_top_bg                 = get_theme_mod( 'havoc_scroll_top_bg', 'rgba(0,0,0,0.4)' );
			$scroll_top_bg_hover           = get_theme_mod( 'havoc_scroll_top_bg_hover', 'rgba(0,0,0,0.8)' );
			$scroll_top_color              = get_theme_mod( 'havoc_scroll_top_color', '#ffffff' );
			$scroll_top_color_hover        = get_theme_mod( 'havoc_scroll_top_color_hover', '#ffffff' );
			$pagination_font_size          = get_theme_mod( 'havoc_pagination_font_size', '18' );
			$pagination_border_width       = get_theme_mod( 'havoc_pagination_border_width', '1' );
			$pagination_bg                 = get_theme_mod( 'havoc_pagination_bg' );
			$pagination_hover_bg           = get_theme_mod( 'havoc_pagination_hover_bg', '#f8f8f8' );
			$pagination_color              = get_theme_mod( 'havoc_pagination_color', '#555555' );
			$pagination_hover_color        = get_theme_mod( 'havoc_pagination_hover_color', '#333333' );
			$pagination_border_color       = get_theme_mod( 'havoc_pagination_border_color', '#e9e9e9' );
			$pagination_border_hover_color = get_theme_mod( 'havoc_pagination_border_hover_color', '#e9e9e9' );
			$label_color                   = get_theme_mod( 'havoc_label_color', '#929292' );
			$input_top_padding             = get_theme_mod( 'havoc_input_top_padding', '6' );
			$input_right_padding           = get_theme_mod( 'havoc_input_right_padding', '12' );
			$input_bottom_padding          = get_theme_mod( 'havoc_input_bottom_padding', '6' );
			$input_left_padding            = get_theme_mod( 'havoc_input_left_padding', '12' );
			$tablet_input_top_padding      = get_theme_mod( 'havoc_input_tablet_top_padding' );
			$tablet_input_right_padding    = get_theme_mod( 'havoc_input_tablet_right_padding' );
			$tablet_input_bottom_padding   = get_theme_mod( 'havoc_input_tablet_bottom_padding' );
			$tablet_input_left_padding     = get_theme_mod( 'havoc_input_tablet_left_padding' );
			$mobile_input_top_padding      = get_theme_mod( 'havoc_input_mobile_top_padding' );
			$mobile_input_right_padding    = get_theme_mod( 'havoc_input_mobile_right_padding' );
			$mobile_input_bottom_padding   = get_theme_mod( 'havoc_input_mobile_bottom_padding' );
			$mobile_input_left_padding     = get_theme_mod( 'havoc_input_mobile_left_padding' );
			$input_font_size               = get_theme_mod( 'havoc_input_font_size', '14' );
			$input_top_border_width        = get_theme_mod( 'havoc_input_top_border_width', '1' );
			$input_right_border_width      = get_theme_mod( 'havoc_input_right_border_width', '1' );
			$input_bottom_border_width     = get_theme_mod( 'havoc_input_bottom_border_width', '1' );
			$input_left_border_width       = get_theme_mod( 'havoc_input_left_border_width', '1' );
			$tablet_input_top_bw           = get_theme_mod( 'havoc_input_tablet_top_border_width' );
			$tablet_input_right_bw         = get_theme_mod( 'havoc_input_tablet_right_border_width' );
			$tablet_input_bottom_bw        = get_theme_mod( 'havoc_input_tablet_bottom_border_width' );
			$tablet_input_left_bw          = get_theme_mod( 'havoc_input_tablet_left_border_width' );
			$mobile_input_top_bw           = get_theme_mod( 'havoc_input_mobile_top_border_width' );
			$mobile_input_right_bw         = get_theme_mod( 'havoc_input_mobile_right_border_width' );
			$mobile_input_bottom_bw        = get_theme_mod( 'havoc_input_mobile_bottom_border_width' );
			$mobile_input_left_bw          = get_theme_mod( 'havoc_input_mobile_left_border_width' );
			$input_border_radius           = get_theme_mod( 'havoc_input_border_radius', '3' );
			$input_border_color            = get_theme_mod( 'havoc_input_border_color', '#dddddd' );
			$input_border_color_focus      = get_theme_mod( 'havoc_input_border_color_focus', '#bbbbbb' );
			$input_background              = get_theme_mod( 'havoc_input_background' );
			$input_color                   = get_theme_mod( 'havoc_input_color', '#333333' );
			$theme_button_top_padding      = get_theme_mod( 'havoc_theme_button_top_padding', '14' );
			$theme_button_right_padding    = get_theme_mod( 'havoc_theme_button_right_padding', '20' );
			$theme_button_bottom_padding   = get_theme_mod( 'havoc_theme_button_bottom_padding', '14' );
			$theme_button_left_padding     = get_theme_mod( 'havoc_theme_button_left_padding', '20' );
			$tablet_tb_top_padding         = get_theme_mod( 'havoc_theme_button_tablet_top_padding' );
			$tablet_tb_right_padding       = get_theme_mod( 'havoc_theme_button_tablet_right_padding' );
			$tablet_tb_bottom_padding      = get_theme_mod( 'havoc_theme_button_tablet_bottom_padding' );
			$tablet_tb_left_padding        = get_theme_mod( 'havoc_theme_button_tablet_left_padding' );
			$mobile_tb_top_padding         = get_theme_mod( 'havoc_theme_button_mobile_top_padding' );
			$mobile_tb_right_padding       = get_theme_mod( 'havoc_theme_button_mobile_right_padding' );
			$mobile_tb_bottom_padding      = get_theme_mod( 'havoc_theme_button_mobile_bottom_padding' );
			$mobile_tb_left_padding        = get_theme_mod( 'havoc_theme_button_mobile_left_padding' );
			$theme_button_border_radius    = get_theme_mod( 'havoc_theme_button_border_radius', '0' );
			$theme_button_bg               = get_theme_mod( 'havoc_theme_button_bg', '#13aff0' );
			$theme_button_hover_bg         = get_theme_mod( 'havoc_theme_button_hover_bg', '#0b7cac' );
			$theme_button_color            = get_theme_mod( 'havoc_theme_button_color', '#ffffff' );
			$theme_button_hover_color      = get_theme_mod( 'havoc_theme_button_hover_color', '#ffffff' );
			$theme_blog_icons_color        = get_theme_mod( 'havoc_theme_blog_posts_icons_color', '#333333' );
			$theme_post_icons_color        = get_theme_mod( 'havoc_theme_single_post_icons_color', '#333333' );

			// Both sidebars page layout.
			$page_layout            = get_theme_mod( 'havoc_page_single_layout', 'right-sidebar' );
			$bs_page_content_width  = get_theme_mod( 'havoc_page_single_both_sidebars_content_width' );
			$bs_page_sidebars_width = get_theme_mod( 'havoc_page_single_both_sidebars_sidebars_width' );

			// Both sidebars search layout.
			$search_layout            = get_theme_mod( 'havoc_search_layout', 'right-sidebar' );
			$bs_search_content_width  = get_theme_mod( 'havoc_search_both_sidebars_content_width' );
			$bs_search_sidebars_width = get_theme_mod( 'havoc_search_both_sidebars_sidebars_width' );

			// Meta.
			$meta_breadcrumbs_text_color       = get_post_meta( havocwp_post_id(), 'havoc_breadcrumbs_color', true );
			$meta_breadcrumbs_seperator_color  = get_post_meta( havocwp_post_id(), 'havoc_breadcrumbs_separator_color', true );
			$meta_breadcrumbs_link_color       = get_post_meta( havocwp_post_id(), 'havoc_breadcrumbs_links_color', true );
			$meta_breadcrumbs_link_color_hover = get_post_meta( havocwp_post_id(), 'havoc_breadcrumbs_links_hover_color', true );

			// Define css var.
			$css                        = '';
			$content_padding_css        = '';
			$tablet_content_padding_css = '';
			$mobile_content_padding_css = '';

			// Get primary color arrays.
			$texts       = self::primary_color_arrays( 'texts' );
			$svg_icons   = self::primary_color_arrays( 'svg_icons' );
			$backgrounds = self::primary_color_arrays( 'backgrounds' );
			$borders     = self::primary_color_arrays( 'borders' );

			// Get hover primary color arrays.
			$hover_primary = self::hover_primary_color_array( 'hover' );

			// Get hover primary color arrays.
			$main_border = self::main_border_array();

			// Texts.
			if ( ! empty( $texts ) && '#13aff0' != $primary_color ) {
				$css .= implode( ',', $texts ) . '{color:' . $primary_color . ';}';
				$css .= implode( ',', $svg_icons ) . '{stroke:' . $primary_color . ';}';
			}

			// Backgrounds.
			if ( ! empty( $backgrounds ) && '#13aff0' != $primary_color ) {
				$css .= implode( ',', $backgrounds ) . '{background-color:' . $primary_color . ';}';
				$css .= '.thumbnail:hover .link-post-svg-icon{background-color:' . $primary_color . ';}';
				$css .= 'body .contact-info-widget.big-icons li:hover .hvc-icon{background-color:' . $primary_color . ';}';
			}

			// Borders.
			if ( ! empty( $borders ) && '#13aff0' != $primary_color ) {
				foreach ( $borders as $key => $val ) {
					if ( is_array( $val ) ) {
						$css .= $key . '{';
						foreach ( $val as $key => $val ) {
							$css .= 'border-' . $val . '-color:' . $primary_color . ';';
						}
						$css .= '}';
					} else {
						$css .= $val . '{border-color:' . $primary_color . ';}';
					}
				}
			}

			// Blockquotes color.
			if ( ! empty( $primary_color ) && '#13aff0' != $primary_color ) {
				$css .= 'blockquote, .wp-block-quote{border-left-color:' . $primary_color . ';}';
				$css .= 'body .contact-info-widget.big-icons li:hover .hvc-icon{border-color:' . $primary_color . ';}';
			}

			// Hover primary color.
			if ( ! empty( $hover_primary ) && '#0b7cac' != $hover_primary_color ) {
				$css .= implode( ',', $hover_primary ) . '{background-color:' . $hover_primary_color . ';}';
			}

			// Main border color.
			if ( ! empty( $main_border ) && '#e9e9e9' != $main_border_color ) {
				$css .= implode( ',', $main_border ) . '{border-color:' . $main_border_color . ';}';
				$css .= 'body .contact-info-widget.big-icons .hvc-icon, body .contact-info-widget.default .hvc-icon{border-color:' . $main_border_color . ';}';
			}

			// Get site background color.
			if ( ! empty( $background_color ) && '#ffffff' != $background_color ) {
				$css .= 'body, .has-parallax-footer:not(.separate-layout) #main{background-color:' . $background_color . ';}';
			}

			// Get site background image.
			if ( ! empty( $background_image ) ) {
				$css .= 'body{background-image:url(' . $background_image . ');}';
			}

			// Get site background position.
			if ( ! empty( $background_image_position ) && 'initial' != $background_image_position ) {
				$css .= 'body{background-position:' . $background_image_position . ';}';
			}

			// Get site background attachment.
			if ( ! empty( $background_image_attachment ) && 'initial' != $background_image_attachment ) {
				$css .= 'body{background-attachment:' . $background_image_attachment . ';}';
			}

			// Get site background repeat.
			if ( ! empty( $background_image_repeat ) && 'initial' != $background_image_repeat ) {
				$css .= 'body{background-repeat:' . $background_image_repeat . ';}';
			}

			// Get site background size.
			if ( ! empty( $background_image_size ) && 'initial' != $background_image_size ) {
				$css .= 'body{background-size:' . $background_image_size . ';}';
			}

			// Links color.
			if ( ! empty( $links_color ) && '#333333' != $links_color ) {
				$css .= 'a{color:' . $links_color . ';}';
				$css .= 'a .hvc-icon use {stroke:' . $links_color . ';}';
			}

			// Links color hover.
			if ( ! empty( $links_color_hover ) && '#13aff0' != $links_color_hover ) {
				$css .= 'a:hover{color:' . $links_color_hover . ';}';
				$css .= 'a:hover .hvc-icon use {stroke:' . $links_color_hover . ';}';
			}

			// Boxed width.
			if ( ! empty( $boxed_width ) && '1280' != $boxed_width ) {
				$css .= '.boxed-layout #wrap, .boxed-layout .parallax-footer, .boxed-layout .hvc-floating-bar{width:' . $boxed_width . 'px;}';
			}

			// Boxed outside background.
			if ( ! empty( $boxed_outside_bg ) && '#e9e9e9' != $boxed_outside_bg ) {
				$css .= '.boxed-layout{background-color:' . $boxed_outside_bg . ';}';
			}

			// Separate outside background.
			if ( ! empty( $separate_outside_bg ) && '#f1f1f1' != $separate_outside_bg ) {
				$css .= '.separate-layout, .has-parallax-footer.separate-layout #main{background-color:' . $separate_outside_bg . ';}';
			}

			// Boxed inner background.
			if ( ! empty( $boxed_inner_bg ) && '#ffffff' != $boxed_inner_bg ) {
				$css .= '.boxed-layout #wrap, .separate-layout .content-area, .separate-layout .widget-area .sidebar-box, body.separate-blog.separate-layout #blog-entries > *, body.separate-blog.separate-layout .havocwp-pagination, body.separate-blog.separate-layout .blog-entry.grid-entry .blog-entry-inner, .has-parallax-footer:not(.separate-layout) #main{background-color:' . $boxed_inner_bg . ';}';
			}

			// Separate content padding.
			if ( ! empty( $separate_content_padding ) && '30px' != $separate_content_padding ) {
				$css .= '.separate-layout .content-area, .separate-layout.content-left-sidebar .content-area, .content-both-sidebars.scs-style .content-area, .separate-layout.content-both-sidebars.ssc-style .content-area, body.separate-blog.separate-layout #blog-entries > *, body.separate-blog.separate-layout .havocwp-pagination, body.separate-blog.separate-layout .blog-entry.grid-entry .blog-entry-inner{padding:' . $separate_content_padding . ';}.separate-layout.content-full-width .content-area{padding:' . $separate_content_padding . ' !important;}';
			}

			// Separate widgets padding.
			if ( ! empty( $separate_widgets_padding ) && '30px' != $separate_widgets_padding ) {
				$css .= '.separate-layout .widget-area .sidebar-box{padding:' . $separate_widgets_padding . ';}';
			}

			// Content top padding.
			if ( ! empty( $main_container_width ) && '1200' != $main_container_width ) {
				$css .= '.container{width:' . $main_container_width . 'px;}';
			}

			// Content top padding.
			if ( ! empty( $left_container_width ) && '72' != $left_container_width ) {
				$css .= '@media only screen and (min-width: 960px){ .content-area, .content-left-sidebar .content-area{width:' . $left_container_width . '%;} }';
			}

			// Content top padding.
			if ( ! empty( $sidebar_width ) && '28' != $sidebar_width ) {
				$css .= '@media only screen and (min-width: 960px){ .widget-area, .content-left-sidebar .widget-area{width:' . $sidebar_width . '%;} }';
			}

			// Content top padding.
			if ( isset( $content_top_padding ) && '' != $content_top_padding ) {
				$content_padding_css .= 'padding-top:' . $content_top_padding . 'px;';
			}

			// Content bottom padding.
			if ( isset( $content_bottom_padding ) && '' != $content_bottom_padding ) {
				$content_padding_css .= 'padding-bottom:' . $content_bottom_padding . 'px;';
			}

			// Content padding css.
			if ( isset( $content_top_padding ) && '' != $content_top_padding
				|| isset( $content_bottom_padding ) && '' != $content_bottom_padding ) {
				$css .= '#main #content-wrap, .separate-layout #main #content-wrap{' . $content_padding_css . '}';
			}

			// Tablet content top padding.
			if ( isset( $tablet_content_top_padding ) && '' != $tablet_content_top_padding ) {
				$tablet_content_padding_css .= 'padding-top:' . $tablet_content_top_padding . 'px;';
			}

			// Tablet content bottom padding.
			if ( isset( $tablet_content_bottom_padding ) && '' != $tablet_content_bottom_padding ) {
				$tablet_content_padding_css .= 'padding-bottom:' . $tablet_content_bottom_padding . 'px;';
			}

			// Tablet content padding css.
			if ( isset( $tablet_content_top_padding ) && '' != $tablet_content_top_padding
				|| isset( $tablet_content_bottom_padding ) && '' != $tablet_content_bottom_padding ) {
				$css .= '@media (max-width: 768px){#main #content-wrap, .separate-layout #main #content-wrap{' . $tablet_content_padding_css . '}}';
			}

			// Mobile content top padding.
			if ( isset( $mobile_content_top_padding ) && '' != $mobile_content_top_padding ) {
				$mobile_content_padding_css .= 'padding-top:' . $mobile_content_top_padding . 'px;';
			}

			// Mobile content bottom padding.
			if ( isset( $mobile_content_bottom_padding ) && '' != $mobile_content_bottom_padding ) {
				$mobile_content_padding_css .= 'padding-bottom:' . $mobile_content_bottom_padding . 'px;';
			}

			// Mobile content padding css.
			if ( isset( $mobile_content_top_padding ) && '' != $mobile_content_top_padding
				|| isset( $mobile_content_bottom_padding ) && '' != $mobile_content_bottom_padding ) {
				$css .= '@media (max-width: 480px){#main #content-wrap, .separate-layout #main #content-wrap{' . $mobile_content_padding_css . '}}';
			}

			// Title/breadcrumb position.
			if ( ! empty( $title_breadcrumb_position ) && 'center' != $title_breadcrumb_position ) {
				$css .= '.background-image-page-header .page-header-inner, .background-image-page-header .site-breadcrumbs{text-align: ' . $title_breadcrumb_position . '}';
			}

			// Page header padding.
			if ( isset( $page_header_top_padding ) && '34' != $page_header_top_padding && '' != $page_header_top_padding
				|| isset( $page_header_bottom_padding ) && '34' != $page_header_bottom_padding && '' != $page_header_bottom_padding ) {
				$css .= '.page-header, .has-transparent-header .page-header{padding:' . havocwp_spacing_css( $page_header_top_padding, '', $page_header_bottom_padding, '' ) . '}';
			}

			// Tablet page header padding.
			if ( isset( $tablet_ph_top_padding ) && '' != $tablet_ph_top_padding
				|| isset( $tablet_ph_bottom_padding ) && '' != $tablet_ph_bottom_padding ) {
				$css .= '@media (max-width: 768px){.page-header, .has-transparent-header .page-header{padding:' . havocwp_spacing_css( $tablet_ph_top_padding, '', $tablet_ph_bottom_padding, '' ) . '}}';
			}

			// Mobile page header padding.
			if ( isset( $mobile_ph_top_padding ) && '' != $mobile_ph_top_padding
				|| isset( $mobile_ph_bottom_padding ) && '' != $mobile_ph_bottom_padding ) {
				$css .= '@media (max-width: 480px){.page-header, .has-transparent-header .page-header{padding:' . havocwp_spacing_css( $mobile_ph_top_padding, '', $mobile_ph_bottom_padding, '' ) . '}}';
			}

			// Page header color.
			if ( ! empty( $page_header_title_color ) ) {
				$css .= '.page-header .page-header-title, .page-header.background-image-page-header .page-header-title{color:' . $page_header_title_color . ';}';
			}

			// Breadcrumbs text color.
			if ( ! empty( $breadcrumbs_text_color ) && '#c6c6c6' != $breadcrumbs_text_color ) {
				$css .= '.site-breadcrumbs, .background-image-page-header .site-breadcrumbs{color:' . $breadcrumbs_text_color . ';}';
			}

			// Breadcrumbs seperator color.
			if ( ! empty( $breadcrumbs_seperator_color ) && '#c6c6c6' != $breadcrumbs_seperator_color ) {
				$css .= '.site-breadcrumbs ul li .breadcrumb-sep, .site-breadcrumbs ol li .breadcrumb-sep{color:' . $breadcrumbs_seperator_color . ';}';
			}

			// Breadcrumbs link color.
			if ( ! empty( $breadcrumbs_link_color ) && '#333333' != $breadcrumbs_link_color ) {
				$css .= '.site-breadcrumbs a, .background-image-page-header .site-breadcrumbs a{color:' . $breadcrumbs_link_color . ';}';
				$css .= '.site-breadcrumbs a .hvc-icon use, .background-image-page-header .site-breadcrumbs a .hvc-icon use{stroke:' . $breadcrumbs_link_color . ';}';
			}

			// Breadcrumbs link hover color.
			if ( ! empty( $breadcrumbs_link_color_hover ) && '#13aff0' != $breadcrumbs_link_color_hover ) {
				$css .= '.site-breadcrumbs a:hover, .background-image-page-header .site-breadcrumbs a:hover{color:' . $breadcrumbs_link_color_hover . ';}';
				$css .= '.site-breadcrumbs a:hover .hvc-icon use, .background-image-page-header .site-breadcrumbs a:hover .hvc-icon use{stroke:' . $breadcrumbs_link_color_hover . ';}';
			}

			// Meta breadcrumbs text color.
			if ( ! empty( $meta_breadcrumbs_text_color ) ) {
				$css .= '.site-breadcrumbs, .background-image-page-header .site-breadcrumbs{color:' . $meta_breadcrumbs_text_color . ';}';
			}

			// Meta breadcrumbs seperator color.
			if ( ! empty( $meta_breadcrumbs_seperator_color ) ) {
				$css .= '.site-breadcrumbs ul li .breadcrumb-sep{color:' . $meta_breadcrumbs_seperator_color . ';}';
			}

			// Meta breadcrumbs link color.
			if ( ! empty( $meta_breadcrumbs_link_color ) ) {
				$css .= '.site-breadcrumbs a, .background-image-page-header .site-breadcrumbs a{color:' . $meta_breadcrumbs_link_color . ';}';
			}

			// Meta breadcrumbs link hover color.
			if ( ! empty( $meta_breadcrumbs_link_color_hover ) ) {
				$css .= '.site-breadcrumbs a:hover, .background-image-page-header .site-breadcrumbs a:hover{color:' . $meta_breadcrumbs_link_color_hover . ';}';
			}

			// Scroll top button bottom position.
			if ( ! empty( $scroll_top_bottom_position ) && '20' != $scroll_top_bottom_position ) {
				$css .= '#scroll-top{bottom:' . $scroll_top_bottom_position . 'px;}';
			}

			// Scroll top button size.
			if ( ! empty( $scroll_top_size ) && '40' != $scroll_top_size ) {
				$css .= '#scroll-top{width:' . $scroll_top_size . 'px;height:' . $scroll_top_size . 'px;line-height:' . $scroll_top_size . 'px;}';
			}

			// Scroll top button icon size.
			if ( ! empty( $scroll_top_icon_size ) && '18' != $scroll_top_icon_size ) {
				$css .= '#scroll-top{font-size:' . $scroll_top_icon_size . 'px;}';
				$css .= '#scroll-top .hvc-icon{width:' . $scroll_top_icon_size . 'px; height:' . $scroll_top_icon_size . 'px;}';
			}

			// Scroll top button border radius.
			if ( ! empty( $scroll_top_border_radius ) && '2' != $scroll_top_border_radius ) {
				$css .= '#scroll-top{border-radius:' . $scroll_top_border_radius . 'px;}';
			}

			// Scroll top button background color.
			if ( ! empty( $scroll_top_bg ) && 'rgba(0,0,0,0.4)' != $scroll_top_bg ) {
				$css .= '#scroll-top{background-color:' . $scroll_top_bg . ';}';
			}

			// Scroll top button background hover color.
			if ( ! empty( $scroll_top_bg_hover ) && 'rgba(0,0,0,0.8)' != $scroll_top_bg_hover ) {
				$css .= '#scroll-top:hover{background-color:' . $scroll_top_bg_hover . ';}';
			}

			// Scroll top button background color.
			if ( ! empty( $scroll_top_color ) && '#ffffff' != $scroll_top_color ) {
				$css .= '#scroll-top{color:' . $scroll_top_color . ';}';
				$css .= '#scroll-top .hvc-icon use{stroke:' . $scroll_top_color . ';}';
			}

			// Scroll top button background hover color.
			if ( ! empty( $scroll_top_color_hover ) && '#ffffff' != $scroll_top_color_hover ) {
				$css .= '#scroll-top:hover{color:' . $scroll_top_color_hover . ';}';
				$css .= '#scroll-top:hover .hvc-icon use{stroke:' . $scroll_top_color . ';}';
			}

			// Pagination font size.
			if ( ! empty( $pagination_font_size ) && '18' != $pagination_font_size ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{font-size:' . $pagination_font_size . 'px;}';
			}

			// Pagination border width.
			if ( ! empty( $pagination_border_width ) && '1' != $pagination_border_width ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{border-width:' . $pagination_border_width . 'px;}';
			}

			// Pagination background color.
			if ( ! empty( $pagination_bg ) ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{background-color:' . $pagination_bg . ';}';
			}

			// Pagination background color hover.
			if ( ! empty( $pagination_hover_bg ) && '#f8f8f8' != $pagination_hover_bg ) {
				$css .= '.page-numbers a:hover, .page-links a:hover span, .page-numbers.current, .page-numbers.current:hover{background-color:' . $pagination_hover_bg . ';}';
			}

			// Pagination color.
			if ( ! empty( $pagination_color ) && '#555555' != $pagination_color ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{color:' . $pagination_color . ';}';
				$css .= '.page-numbers a .hvc-icon use{stroke:' . $pagination_color . ';}';
			}

			// Pagination color hover.
			if ( ! empty( $pagination_hover_color ) && '#333333' != $pagination_hover_color ) {
				$css .= '.page-numbers a:hover, .page-links a:hover span, .page-numbers.current, .page-numbers.current:hover{color:' . $pagination_hover_color . ';}';
				$css .= '.page-numbers a:hover .hvc-icon use{stroke:' . $pagination_hover_color . ';}';
			}

			// Pagination border color.
			if ( ! empty( $pagination_border_color ) && '#e9e9e9' != $pagination_border_color ) {
				$css .= '.page-numbers a, .page-numbers span:not(.elementor-screen-only), .page-links span{border-color:' . $pagination_border_color . ';}';
			}

			// Pagination border color hover.
			if ( ! empty( $pagination_border_hover_color ) && '#e9e9e9' != $pagination_border_hover_color ) {
				$css .= '.page-numbers a:hover, .page-links a:hover span, .page-numbers.current, .page-numbers.current:hover{border-color:' . $pagination_border_hover_color . ';}';
			}

			// Label color.
			if ( ! empty( $label_color ) && '#929292' != $label_color ) {
				$css .= 'label, body div.wpforms-container-full .wpforms-form .wpforms-field-label{color:' . $label_color . ';}';
			}

			// Input padding.
			if ( isset( $input_top_padding ) && '6' != $input_top_padding && '' != $input_top_padding
				|| isset( $input_right_padding ) && '12' != $input_right_padding && '' != $input_right_padding
				|| isset( $input_bottom_padding ) && '6' != $input_bottom_padding && '' != $input_bottom_padding
				|| isset( $input_left_padding ) && '12' != $input_left_padding && '' != $input_left_padding ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{padding:' . havocwp_spacing_css( $input_top_padding, $input_right_padding, $input_bottom_padding, $input_left_padding ) . '}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{padding:' . havocwp_spacing_css( $input_top_padding, $input_right_padding, $input_bottom_padding, $input_left_padding ) . '; height: auto;}';
			}

			// Tablet input padding.
			if ( isset( $tablet_input_top_padding ) && '' != $tablet_input_top_padding
				|| isset( $tablet_input_right_padding ) && '' != $tablet_input_right_padding
				|| isset( $tablet_input_bottom_padding ) && '' != $tablet_input_bottom_padding
				|| isset( $tablet_input_left_padding ) && '' != $tablet_input_left_padding ) {
				$css .= '@media (max-width: 768px){form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{padding:' . havocwp_spacing_css( $tablet_input_top_padding, $tablet_input_right_padding, $tablet_input_bottom_padding, $tablet_input_left_padding ) . '}}';
				$css .= '@media (max-width: 768px){body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{padding:' . havocwp_spacing_css( $tablet_input_top_padding, $tablet_input_right_padding, $tablet_input_bottom_padding, $tablet_input_left_padding ) . '}}';
			}

			// Mobile input padding.
			if ( isset( $mobile_input_top_padding ) && '' != $mobile_input_top_padding
				|| isset( $mobile_input_right_padding ) && '' != $mobile_input_right_padding
				|| isset( $mobile_input_bottom_padding ) && '' != $mobile_input_bottom_padding
				|| isset( $mobile_input_left_padding ) && '' != $mobile_input_left_padding ) {
				$css .= '@media (max-width: 480px){form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{padding:' . havocwp_spacing_css( $mobile_input_top_padding, $mobile_input_right_padding, $mobile_input_bottom_padding, $mobile_input_left_padding ) . '}}';
				$css .= '@media (max-width: 480px){body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{padding:' . havocwp_spacing_css( $mobile_input_top_padding, $mobile_input_right_padding, $mobile_input_bottom_padding, $mobile_input_left_padding ) . '}}';
			}

			// Input font size.
			if ( ! empty( $input_font_size ) && '14' != $input_font_size ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{font-size:' . $input_font_size . 'px;}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{font-size:' . $input_font_size . 'px;}';
			}

			// Input border width border width.
			if ( isset( $input_top_border_width ) && '1' != $input_top_border_width && '' != $input_top_border_width
				|| isset( $input_right_border_width ) && '1' != $input_right_border_width && '' != $input_right_border_width
				|| isset( $input_bottom_border_width ) && '1' != $input_bottom_border_width && '' != $input_bottom_border_width
				|| isset( $input_left_border_width ) && '1' != $input_left_border_width && '' != $input_left_border_width ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{border-width:' . havocwp_spacing_css( $input_top_border_width, $input_right_border_width, $input_bottom_border_width, $input_left_border_width ) . '}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-width:' . havocwp_spacing_css( $input_top_border_width, $input_right_border_width, $input_bottom_border_width, $input_left_border_width ) . '}';
			}

			// Tablet input border width border width.
			if ( isset( $tablet_input_top_bw ) && '' != $tablet_input_top_bw
				|| isset( $tablet_input_right_bw ) && '' != $tablet_input_right_bw
				|| isset( $tablet_input_bottom_bw ) && '' != $tablet_input_bottom_bw
				|| isset( $tablet_input_left_bw ) && '' != $tablet_input_left_bw ) {
				$css .= '@media (max-width: 768px){form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{border-width:' . havocwp_spacing_css( $tablet_input_top_bw, $tablet_input_right_bw, $tablet_input_bottom_bw, $tablet_input_left_bw ) . '}}';
				$css .= '@media (max-width: 768px){body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-width:' . havocwp_spacing_css( $tablet_input_top_bw, $tablet_input_right_bw, $tablet_input_bottom_bw, $tablet_input_left_bw ) . '}}';
			}

			// Mobile input border width border width.
			if ( isset( $mobile_input_top_bw ) && '' != $mobile_input_top_bw
				|| isset( $mobile_input_right_bw ) && '' != $mobile_input_right_bw
				|| isset( $mobile_input_bottom_bw ) && '' != $mobile_input_bottom_bw
				|| isset( $mobile_input_left_bw ) && '' != $mobile_input_left_bw ) {
				$css .= '@media (max-width: 480px){form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{border-width:' . havocwp_spacing_css( $mobile_input_top_bw, $mobile_input_right_bw, $mobile_input_bottom_bw, $mobile_input_left_bw ) . '}}';
				$css .= '@media (max-width: 480px){body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-width:' . havocwp_spacing_css( $mobile_input_top_bw, $mobile_input_right_bw, $mobile_input_bottom_bw, $mobile_input_left_bw ) . '}}';
			}

			// Input border radius.
			if ( ! empty( $input_border_radius ) && '3' != $input_border_radius ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea, .woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single{border-radius:' . $input_border_radius . 'px;}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-radius:' . $input_border_radius . 'px;}';
			}

			// Input border color.
			if ( ! empty( $input_border_color ) && '#dddddd' != $input_border_color ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea,.select2-container .select2-choice, .woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single{border-color:' . $input_border_color . ';}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{border-color:' . $input_border_color . ';}';
			}

			// Input border color focus.
			if ( ! empty( $input_border_color_focus ) && '#bbbbbb' != $input_border_color_focus ) {
				$css .= 'form input[type="text"]:focus,form input[type="password"]:focus,form input[type="email"]:focus,form input[type="tel"]:focus,form input[type="url"]:focus,form input[type="search"]:focus,form textarea:focus,.select2-drop-active,.select2-dropdown-open.select2-drop-above .select2-choice,.select2-dropdown-open.select2-drop-above .select2-choices,.select2-drop.select2-drop-above.select2-drop-active,.select2-container-active .select2-choice,.select2-container-active .select2-choices{border-color:' . $input_border_color_focus . ';}';
				$css .= 'body div.wpforms-container-full .wpforms-form input:focus, body div.wpforms-container-full .wpforms-form textarea:focus, body div.wpforms-container-full .wpforms-form select:focus{border-color:' . $input_border_color_focus . ';}';
			}

			// Input border background.
			if ( ! empty( $input_background ) ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea, .woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single{background-color:' . $input_background . ';}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{background-color:' . $input_background . ';}';
			}

			// Input border color.
			if ( ! empty( $input_color ) && '#333333' != $input_color ) {
				$css .= 'form input[type="text"], form input[type="password"], form input[type="email"], form input[type="url"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="datetime"], form input[type="datetime-local"], form input[type="week"], form input[type="number"], form input[type="search"], form input[type="tel"], form input[type="color"], form select, form textarea{color:' . $input_color . ';}';
				$css .= 'body div.wpforms-container-full .wpforms-form input[type=date], body div.wpforms-container-full .wpforms-form input[type=datetime], body div.wpforms-container-full .wpforms-form input[type=datetime-local], body div.wpforms-container-full .wpforms-form input[type=email], body div.wpforms-container-full .wpforms-form input[type=month], body div.wpforms-container-full .wpforms-form input[type=number], body div.wpforms-container-full .wpforms-form input[type=password], body div.wpforms-container-full .wpforms-form input[type=range], body div.wpforms-container-full .wpforms-form input[type=search], body div.wpforms-container-full .wpforms-form input[type=tel], body div.wpforms-container-full .wpforms-form input[type=text], body div.wpforms-container-full .wpforms-form input[type=time], body div.wpforms-container-full .wpforms-form input[type=url], body div.wpforms-container-full .wpforms-form input[type=week], body div.wpforms-container-full .wpforms-form select, body div.wpforms-container-full .wpforms-form textarea{color:' . $input_color . ';}';
			}

			// Theme buttons padding.
			if ( isset( $theme_button_top_padding ) && '14' != $theme_button_top_padding && '' != $theme_button_top_padding
				|| isset( $theme_button_right_padding ) && '20' != $theme_button_right_padding && '' != $theme_button_right_padding
				|| isset( $theme_button_bottom_padding ) && '14' != $theme_button_bottom_padding && '' != $theme_button_bottom_padding
				|| isset( $theme_button_left_padding ) && '20' != $theme_button_left_padding && '' != $theme_button_left_padding ) {
				$css .= '.theme-button,input[type="submit"],button[type="submit"],button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{padding:' . havocwp_spacing_css( $theme_button_top_padding, $theme_button_right_padding, $theme_button_bottom_padding, $theme_button_left_padding ) . '}';
			}

			// Tablet theme buttons padding.
			if ( isset( $tablet_tb_top_padding ) && '' != $tablet_tb_top_padding
				|| isset( $tablet_tb_right_padding ) && '' != $tablet_tb_right_padding
				|| isset( $tablet_tb_bottom_padding ) && '' != $tablet_tb_bottom_padding
				|| isset( $tablet_tb_left_padding ) && '' != $tablet_tb_left_padding ) {
				$css .= '@media (max-width: 768px){.theme-button,input[type="submit"],button[type="submit"],button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{padding:' . havocwp_spacing_css( $tablet_tb_top_padding, $tablet_tb_right_padding, $tablet_tb_bottom_padding, $tablet_tb_left_padding ) . '}}';
			}

			// Mobile theme buttons padding.
			if ( isset( $mobile_tb_top_padding ) && '' != $mobile_tb_top_padding
				|| isset( $mobile_tb_right_padding ) && '' != $mobile_tb_right_padding
				|| isset( $mobile_tb_bottom_padding ) && '' != $mobile_tb_bottom_padding
				|| isset( $mobile_tb_left_padding ) && '' != $mobile_tb_left_padding ) {
				$css .= '@media (max-width: 480px){.theme-button,input[type="submit"],button[type="submit"],button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{padding:' . havocwp_spacing_css( $mobile_tb_top_padding, $mobile_tb_right_padding, $mobile_tb_bottom_padding, $mobile_tb_left_padding ) . '}}';
			}

			// Theme buttons border radius.
			if ( ! empty( $theme_button_border_radius ) && '0' != $theme_button_border_radius ) {
				$css .= '.theme-button,input[type="submit"],button[type="submit"],button,.button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{border-radius:' . $theme_button_border_radius . 'px;}';
			}

			// Theme buttons background color.
			if ( ! empty( $theme_button_bg ) && '#13aff0' != $theme_button_bg ) {
				$css .= 'body .theme-button,body input[type="submit"],body button[type="submit"],body button,body .button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{background-color:' . $theme_button_bg . ';}';
			}

			// Theme buttons background color.
			if ( ! empty( $theme_button_hover_bg ) && '#0b7cac' != $theme_button_hover_bg ) {
				$css .= 'body .theme-button:hover,body input[type="submit"]:hover,body button[type="submit"]:hover,body button:hover,body .button:hover, body div.wpforms-container-full .wpforms-form input[type=submit]:hover, body div.wpforms-container-full .wpforms-form input[type=submit]:active, body div.wpforms-container-full .wpforms-form button[type=submit]:hover, body div.wpforms-container-full .wpforms-form button[type=submit]:active, body div.wpforms-container-full .wpforms-form .wpforms-page-button:hover, body div.wpforms-container-full .wpforms-form .wpforms-page-button:active{background-color:' . $theme_button_hover_bg . ';}';
			}

			// Theme buttons background color.
			if ( ! empty( $theme_button_color ) && '#ffffff' != $theme_button_color ) {
				$css .= 'body .theme-button,body input[type="submit"],body button[type="submit"],body button,body .button, body div.wpforms-container-full .wpforms-form input[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form .wpforms-page-button{color:' . $theme_button_color . ';}';
			}

			// Theme buttons hover color.
			if ( ! empty( $theme_button_hover_color ) && '#ffffff' != $theme_button_hover_color ) {
				$css .= 'body .theme-button:hover,body input[type="submit"]:hover,body button[type="submit"]:hover,body button:hover,body .button:hover, body div.wpforms-container-full .wpforms-form input[type=submit]:hover, body div.wpforms-container-full .wpforms-form input[type=submit]:active, body div.wpforms-container-full .wpforms-form button[type=submit]:hover, body div.wpforms-container-full .wpforms-form button[type=submit]:active, body div.wpforms-container-full .wpforms-form .wpforms-page-button:hover, body div.wpforms-container-full .wpforms-form .wpforms-page-button:active{color:' . $theme_button_hover_color . ';}';
			}

			// Blog entries meta icons color.
			if ( ! empty( $theme_blog_icons_color ) && '#333333' != $theme_blog_icons_color ) {
				$css .= '#blog-entries ul.meta li i{color:' . $theme_blog_icons_color . ';}';
				$css .= '#blog-entries ul.meta li .hvc-icon use{stroke:' . $theme_blog_icons_color . ';}';
			}

			// Single post meta icons color.
			if ( ! empty( $theme_post_icons_color ) && '#333333' != $theme_post_icons_color ) {
				$css .= '.single-post ul.meta li i{color:' . $theme_post_icons_color . ';}';
				$css .= '.single-post ul.meta li .hvc-icon use{stroke:' . $theme_post_icons_color . ';}';
			}

			// If page Both Sidebars layout.
			if ( 'both-sidebars' == $page_layout ) {

				// Both Sidebars layout page content width.
				if ( ! empty( $bs_page_content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.page.content-both-sidebars .content-area {width: ' . $bs_page_content_width . '%;}
							body.page.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.page.content-both-sidebars.ssc-style .widget-area {left: -' . $bs_page_content_width . '%;}
						}';
				}

				// Both Sidebars layout page sidebars width.
				if ( ! empty( $bs_page_sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.page.content-both-sidebars .widget-area{width:' . $bs_page_sidebars_width . '%;}
							body.page.content-both-sidebars.scs-style .content-area{left:' . $bs_page_sidebars_width . '%;}
							body.page.content-both-sidebars.ssc-style .content-area{left:' . $bs_page_sidebars_width * 2 . '%;}
						}';
				}
			}

			// If search Both Sidebars layout.
			if ( 'both-sidebars' == $search_layout ) {

				// Both Sidebars layout search content width.
				if ( ! empty( $bs_search_content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.search-results.content-both-sidebars .content-area {width: ' . $bs_search_content_width . '%;}
							body.search-results.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.search-results.content-both-sidebars.ssc-style .widget-area {left: -' . $bs_search_content_width . '%;}
						}';
				}

				// Both Sidebars layout search sidebars width.
				if ( ! empty( $bs_search_sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.search-results.content-both-sidebars .widget-area{width:' . $bs_search_sidebars_width . '%;}
							body.search-results.content-both-sidebars.scs-style .content-area{left:' . $bs_search_sidebars_width . '%;}
							body.search-results.content-both-sidebars.ssc-style .content-area{left:' . $bs_search_sidebars_width * 2 . '%;}
						}';
				}
			}

			// Return CSS.
			if ( ! empty( $css ) ) {
				$output .= '/* General CSS */' . $css;
			}

			// Return output css.
			return $output;

		}

	}

endif;

return new HavocWP_General_Customizer();
