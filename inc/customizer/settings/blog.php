<?php
/**
 * Blog Customizer Options
 *
 * @package Havoc WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'HavocWP_Blog_Customizer' ) ) :

	/**
	 * Settings for blog
	 */
	class HavocWP_Blog_Customizer {

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
			$panel = 'havoc_blog';
			$wp_customize->add_panel(
				$panel,
				array(
					'title'    => esc_html__( 'Blog', 'havocwp' ),
					'priority' => 210,
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_blog_entries',
				array(
					'title'    => esc_html__( 'Blog Entries', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Archives & Entries Layout
			 */
			$wp_customize->add_setting(
				'havoc_blog_archives_layout',
				array(
					'default'           => 'right-sidebar',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Radio_Image_Control(
					$wp_customize,
					'havoc_blog_archives_layout',
					array(
						'label'    => esc_html__( 'Archives & Entries Layout', 'havocwp' ),
						'section'  => 'havoc_blog_entries',
						'settings' => 'havoc_blog_archives_layout',
						'priority' => 10,
						'choices'  => havocwp_customizer_layout(),
					)
				)
			);

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting(
				'havoc_blog_archives_both_sidebars_style',
				array(
					'default'           => 'scs-style',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_archives_both_sidebars_style',
					array(
						'label'           => esc_html__( 'Both Sidebars: Style', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_archives_both_sidebars_style',
						'priority'        => 10,
						'choices'         => array(
							'ssc-style' => esc_html__( 'Sidebar / Sidebar / Content', 'havocwp' ),
							'scs-style' => esc_html__( 'Sidebar / Content / Sidebar', 'havocwp' ),
							'css-style' => esc_html__( 'Content / Sidebar / Sidebar', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_blog_entries_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting(
				'havoc_blog_archives_both_sidebars_content_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_archives_both_sidebars_content_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Content Width (%)', 'havocwp' ),
						'type'            => 'number',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_archives_both_sidebars_content_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_blog_entries_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting(
				'havoc_blog_archives_both_sidebars_sidebars_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_archives_both_sidebars_sidebars_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Sidebars Width (%)', 'havocwp' ),
						'type'            => 'number',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_archives_both_sidebars_sidebars_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_blog_entries_bs_layout',
					)
				)
			);

			/**
			 * Mobile Sidebar Order
			 */
			$wp_customize->add_setting(
				'havoc_blog_archives_sidebar_order',
				array(
					'default'           => 'content-sidebar',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_archives_sidebar_order',
					array(
						'label'           => esc_html__( 'Mobile Sidebar Order', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_archives_sidebar_order',
						'priority'        => 10,
						'choices'         => array(
							'content-sidebar' => esc_html__( 'Content / Sidebar', 'havocwp' ),
							'sidebar-content' => esc_html__( 'Sidebar / Content', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_blog_entries_rl_layout',
					)
				)
			);

			/**
			 * Blog Title Heading Tag
			 */
			$wp_customize->add_setting(
				'havoc_blog_entries_heading_tag',
				array(
					'default'           => 'h2',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_entries_heading_tag',
					array(
						'label'    => esc_html__( 'Heading Tag', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_blog_entries',
						'settings' => 'havoc_blog_entries_heading_tag',
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
			 * Blog Image Overlay
			 */
			$wp_customize->add_setting(
				'havoc_blog_image_overlay',
				array(
					'transport'         => 'postMessage',
					'default'           => true,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_image_overlay',
					array(
						'label'    => esc_html__( 'Add Overlay On image Hover', 'havocwp' ),
						'type'     => 'checkbox',
						'section'  => 'havoc_blog_entries',
						'settings' => 'havoc_blog_image_overlay',
						'priority' => 10,
					)
				)
			);

			/**
			 * Blog Style
			 */
			$wp_customize->add_setting(
				'havoc_blog_style',
				array(
					'default'           => 'large-entry',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_style',
					array(
						'label'    => esc_html__( 'Blog Style', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_blog_entries',
						'settings' => 'havoc_blog_style',
						'priority' => 10,
						'choices'  => array(
							'large-entry'     => esc_html__( 'Large Image', 'havocwp' ),
							'grid-entry'      => esc_html__( 'Grid', 'havocwp' ),
							'thumbnail-entry' => esc_html__( 'Thumbnail', 'havocwp' )
						),
					)
				)
			);

			/**
			 * Blog Grid Images Size
			 */
			$wp_customize->add_setting(
				'havoc_blog_grid_images_size',
				array(
					'default'           => 'medium',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_grid_images_size',
					array(
						'label'           => esc_html__( 'Images Size', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_grid_images_size',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_grid_blog_style',
						'choices'         => apply_filters(
							'havoc_blog_grid_images_size',
							array(
								'thumbnail'    => esc_html__( 'Thumbnail', 'havocwp' ),
								'medium'       => esc_html__( 'Medium', 'havocwp' ),
								'medium_large' => esc_html__( 'Medium Large', 'havocwp' ),
								'large'        => esc_html__( 'Large', 'havocwp' ),
							)
						),
					)
				)
			);

			/**
			 * Blog Grid Columns
			 */
			$wp_customize->add_setting(
				'havoc_blog_grid_columns',
				array(
					'default'           => '2',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_grid_columns',
					array(
						'label'           => esc_html__( 'Grid Columns', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_grid_columns',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_grid_blog_style',
						'choices'         => array(
							'2' => '2',
							'3' => '3',
							'4' => '4',
							'5' => '5',
							'6' => '6',
						),
					)
				)
			);

			/**
			 * Blog Grid Style
			 */
			$wp_customize->add_setting(
				'havoc_blog_grid_style',
				array(
					'default'           => 'fit-rows',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_grid_style',
					array(
						'label'           => esc_html__( 'Grid Style', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_grid_style',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_grid_blog_style',
						'choices'         => array(
							'fit-rows' => esc_html__( 'Fit Rows', 'havocwp' ),
							'masonry'  => esc_html__( 'Masonry', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Blog Grid Equal Heights
			 */
			$wp_customize->add_setting(
				'havoc_blog_grid_equal_heights',
				array(
					'default'           => false,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_grid_equal_heights',
					array(
						'label'           => esc_html__( 'Equal Heights', 'havocwp' ),
						'type'            => 'checkbox',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_grid_equal_heights',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_blog_supports_equal_heights',
					)
				)
			);

			/**
			 * Blog Thumbnail Image Position
			 */
			$wp_customize->add_setting(
				'havoc_blog_thumbnail_image_position',
				array(
					'default'           => 'left',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_blog_thumbnail_image_position',
					array(
						'label'           => esc_html__( 'Image Position', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_thumbnail_image_position',
						'priority'        => 10,
						'choices'         => array(
							'left'  => esc_html__( 'Left', 'havocwp' ),
							'right' => esc_html__( 'Right', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_thumbnail_blog_style',
					)
				)
			);

			/**
			 * Blog Thumbnail Vertical Position
			 */
			$wp_customize->add_setting(
				'havoc_blog_thumbnail_vertical_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'center',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_blog_thumbnail_vertical_position',
					array(
						'label'           => esc_html__( 'Vertical Position', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_thumbnail_vertical_position',
						'priority'        => 10,
						'choices'         => array(
							'top'    => esc_html__( 'Top', 'havocwp' ),
							'center' => esc_html__( 'Center', 'havocwp' ),
							'bottom' => esc_html__( 'Bottom', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_thumbnail_blog_style',
					)
				)
			);

			/**
			 * Image Width
			 */
			$wp_customize->add_setting(
				'havoc_blog_entry_image_width',
				array(
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_entry_image_width',
					array(
						'label'       => esc_html__( 'Custom Image Width (px)', 'havocwp' ),
						'type'        => 'number',
						'section'     => 'havoc_blog_entries',
						'settings'    => 'havoc_blog_entry_image_width',
						'priority'    => 10,
						'input_attrs' => array(
							'min' => 0,
						),
					)
				)
			);

			/**
			 * Image Height
			 */
			$wp_customize->add_setting(
				'havoc_blog_entry_image_height',
				array(
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_entry_image_height',
					array(
						'label'       => esc_html__( 'Custom Image Height (px)', 'havocwp' ),
						'type'        => 'number',
						'section'     => 'havoc_blog_entries',
						'settings'    => 'havoc_blog_entry_image_height',
						'priority'    => 10,
						'input_attrs' => array(
							'min' => 0,
						),
					)
				)
			);

			/**
			 * Blog Thumbnail Category Color
			 */
			$wp_customize->add_setting(
				'havoc_blog_thumbnail_category_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_blog_thumbnail_category_color',
					array(
						'label'           => esc_html__( 'Category Color', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_thumbnail_category_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_thumbnail_blog_style',
					)
				)
			);

			/**
			 * Blog Thumbnail Category Hover Color
			 */
			$wp_customize->add_setting(
				'havoc_blog_thumbnail_category_hover_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#333333',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_blog_thumbnail_category_hover_color',
					array(
						'label'           => esc_html__( 'Category Hover Color', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_thumbnail_category_hover_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_thumbnail_blog_style',
					)
				)
			);

			/**
			 * Blog Thumbnail Comments Color
			 */
			$wp_customize->add_setting(
				'havoc_blog_thumbnail_comments_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ababab',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_blog_thumbnail_comments_color',
					array(
						'label'           => esc_html__( 'Comments Color', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_thumbnail_comments_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_thumbnail_blog_style',
					)
				)
			);

			/**
			 * Blog Thumbnail Comments Hover Color
			 */
			$wp_customize->add_setting(
				'havoc_blog_thumbnail_comments_hover_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#13aff0',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_blog_thumbnail_comments_hover_color',
					array(
						'label'           => esc_html__( 'Comments Hover Color', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_thumbnail_comments_hover_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_thumbnail_blog_style',
					)
				)
			);

			/**
			 * Blog Thumbnail Date Color
			 */
			$wp_customize->add_setting(
				'havoc_blog_thumbnail_date_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#ababab',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_blog_thumbnail_date_color',
					array(
						'label'           => esc_html__( 'Date Color', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_thumbnail_date_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_thumbnail_blog_style',
					)
				)
			);

			/**
			 * Blog Excerpt Length
			 */
			$wp_customize->add_setting(
				'havoc_blog_entry_excerpt_length',
				array(
					'default'           => '30',
					'sanitize_callback' => false,
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_blog_entry_excerpt_length',
					array(
						'label'       => esc_html__( 'Excerpt Length', 'havocwp' ),
						'description' => esc_html__( 'Add 500 to display full content', 'havocwp' ),
						'section'     => 'havoc_blog_entries',
						'settings'    => 'havoc_blog_entry_excerpt_length',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 500,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Blog Pagination Style
			 */
			$wp_customize->add_setting(
				'havoc_blog_pagination_style',
				array(
					'default'           => 'standard',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_pagination_style',
					array(
						'label'    => esc_html__( 'Blog Pagination Style', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_blog_entries',
						'settings' => 'havoc_blog_pagination_style',
						'priority' => 10,
						'choices'  => array(
							'standard'        => esc_html__( 'Standard', 'havocwp' ),
							'infinite_scroll' => esc_html__( 'Infinite Scroll', 'havocwp' ),
							'next_prev'       => esc_html__( 'Next/Prev', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Infinite Scroll: Spinners Color
			 */
			$wp_customize->add_setting(
				'havoc_blog_infinite_scroll_spinners_color',
				array(
					'default'           => '#333333',
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_blog_infinite_scroll_spinners_color',
					array(
						'label'           => esc_html__( 'Infinite Scroll: Spinners Color', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_infinite_scroll_spinners_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_blog_infinite_scroll',
					)
				)
			);

			/**
			 * Infinite Scroll: Last Text
			 */
			$wp_customize->add_setting(
				'havoc_blog_infinite_scroll_last_text',
				array(
					'default'           => esc_html__( 'End of content', 'havocwp' ),
					'transport'         => 'postMessage',
					'sanitize_callback' => 'wp_kses_post',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_infinite_scroll_last_text',
					array(
						'label'           => esc_html__( 'Infinite Scroll: Last Text', 'havocwp' ),
						'type'            => 'text',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_infinite_scroll_last_text',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_blog_infinite_scroll',
					)
				)
			);

			/**
			 * Infinite Scroll: Error Text
			 */
			$wp_customize->add_setting(
				'havoc_blog_infinite_scroll_error_text',
				array(
					'default'           => esc_html__( 'No more pages to load', 'havocwp' ),
					'transport'         => 'postMessage',
					'sanitize_callback' => 'wp_kses_post',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_infinite_scroll_error_text',
					array(
						'label'           => esc_html__( 'Infinite Scroll: Error Text', 'havocwp' ),
						'type'            => 'text',
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_infinite_scroll_error_text',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_blog_infinite_scroll',
					)
				)
			);

			/**
			 * Blog Entries Elements Positioning
			 */
			$wp_customize->add_setting(
				'havoc_blog_entry_elements_positioning',
				array(
					'default'           => array( 'featured_image', 'title', 'meta', 'content', 'read_more' ),
					'sanitize_callback' => 'havocwp_sanitize_multi_choices',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Sortable_Control(
					$wp_customize,
					'havoc_blog_entry_elements_positioning',
					array(
						'label'           => esc_html__( 'Elements Positioning', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_entry_elements_positioning',
						'priority'        => 10,
						'choices'         => havocwp_blog_entry_elements(),
						'active_callback' => 'havocwp_cac_hasnt_thumbnail_blog_style',
					)
				)
			);

			/**
			 * Blog Entries Meta
			 */
			$wp_customize->add_setting(
				'havoc_blog_entry_meta',
				array(
					'default'           => apply_filters( 'havoc_blog_meta_default', array( 'author', 'date', 'categories', 'comments' ) ),
					'sanitize_callback' => 'havocwp_sanitize_multi_choices',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Sortable_Control(
					$wp_customize,
					'havoc_blog_entry_meta',
					array(
						'label'           => esc_html__( 'Meta', 'havocwp' ),
						'section'         => 'havoc_blog_entries',
						'settings'        => 'havoc_blog_entry_meta',
						'priority'        => 10,
						'choices'         => apply_filters(
							'havoc_blog_meta_choices',
							array(
								'author'       => esc_html__( 'Author', 'havocwp' ),
								'date'         => esc_html__( 'Date', 'havocwp' ),
								'categories'   => esc_html__( 'Categories', 'havocwp' ),
								'comments'     => esc_html__( 'Comments', 'havocwp' ),
								'mod-date'     => esc_html__( 'Modified Date', 'havocwp' ),
								'reading-time' => esc_html__( 'Reading Time', 'havocwp' ),
							)
						),
						'active_callback' => 'havocwp_cac_hasnt_thumbnail_blog_style',
					)
				)
			);

			/**
			 * Blog Entries Meta Separator
			 *
			 * @since 2.0
			 */
			$wp_customize->add_setting(
				'havoc_blog_meta_separator',
				array(
					'transport'         => 'postMessage',
					'default'           => 'default',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_meta_separator',
					array(
						'label'    => esc_html__( 'Meta Separator', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_blog_entries',
						'settings' => 'havoc_blog_meta_separator',
						'priority' => 10,
						'choices'  => array(
							'default' => esc_html__( 'Default', 'havocwp' ),
							'modern'  => esc_html__( 'Modern', 'havocwp' ),
							'stylish' => esc_html__( 'Stylish', 'havocwp' ),
							'none'    => esc_html__( 'None', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Section
			 */
			$wp_customize->add_section(
				'havoc_single_post',
				array(
					'title'    => esc_html__( 'Single Post', 'havocwp' ),
					'priority' => 10,
					'panel'    => $panel,
				)
			);

			/**
			 * Single Layout
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_layout',
				array(
					'default'           => 'right-sidebar',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Radio_Image_Control(
					$wp_customize,
					'havoc_blog_single_layout',
					array(
						'label'    => esc_html__( 'Layout', 'havocwp' ),
						'section'  => 'havoc_single_post',
						'settings' => 'havoc_blog_single_layout',
						'priority' => 10,
						'choices'  => havocwp_customizer_layout(),
					)
				)
			);

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_both_sidebars_style',
				array(
					'default'           => 'scs-style',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_both_sidebars_style',
					array(
						'label'           => esc_html__( 'Both Sidebars: Style', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_both_sidebars_style',
						'priority'        => 10,
						'choices'         => array(
							'ssc-style' => esc_html__( 'Sidebar / Sidebar / Content', 'havocwp' ),
							'scs-style' => esc_html__( 'Sidebar / Content / Sidebar', 'havocwp' ),
							'css-style' => esc_html__( 'Content / Sidebar / Sidebar', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_single_post_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_both_sidebars_content_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_both_sidebars_content_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Content Width (%)', 'havocwp' ),
						'type'            => 'number',
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_both_sidebars_content_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_single_post_bs_layout',
					)
				)
			);

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_both_sidebars_sidebars_width',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_both_sidebars_sidebars_width',
					array(
						'label'           => esc_html__( 'Both Sidebars: Sidebars Width (%)', 'havocwp' ),
						'type'            => 'number',
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_both_sidebars_sidebars_width',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_single_post_bs_layout',
					)
				)
			);

			/**
			 * Mobile Sidebar Order
			 */
			$wp_customize->add_setting(
				'havoc_single_post_sidebar_order',
				array(
					'default'           => 'content-sidebar',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_single_post_sidebar_order',
					array(
						'label'           => esc_html__( 'Mobile Sidebar Order', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_single_post_sidebar_order',
						'priority'        => 10,
						'choices'         => array(
							'content-sidebar' => esc_html__( 'Content / Sidebar', 'havocwp' ),
							'sidebar-content' => esc_html__( 'Sidebar / Content', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_single_post_rl_layout',
					)
				)
			);

			/**
			 * Single Post Header Style
			 *
			 * 			 */
			$wp_customize->add_setting(
				'havocwp_single_post_header_style',
				array(
					'default'           => 'default',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havocwp_single_post_header_style',
					array(
						'label'           => esc_html__( 'Post Title Style', 'havocwp' ),
						'description'     => esc_html__( 'Post Page Title styles will not function properly with all Header styles. Please choose a Header for a Blog Post that will function best with your selected Post Page Title style.', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_single_post',
						'settings'        => 'havocwp_single_post_header_style',
						'priority'        => 10,
						'choices'         => array(
							'default'      => esc_html__( 'Default', 'havocwp' ),
							'sph_style_2'  => esc_html__( 'Intro', 'havocwp' ),
							'sph_style_3'  => esc_html__( 'Cover', 'havocwp' ),
							'sph_style_4'  => esc_html__( 'Card', 'havocwp' ),
							'sph_style_5'  => esc_html__( 'Card Invert', 'havocwp' ),
							'sph_style_6'  => esc_html__( 'Screen', 'havocwp' ),
							'sph_style_7'  => esc_html__( 'Screen Invert', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Single post header Background Color
			 */
			$wp_customize->add_setting(
				'havocwp_single_post_header_background',
				array(
					'transport'         => 'postMessage',
					'default'           => '#e5e5e5',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havocwp_single_post_header_background',
					array(
						'label'           => esc_html__( 'Post Title Background Color', 'havocwp' ),
						'section'         => 'havoc_single_post',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_not_cover_default_style',
					)
				)
			);

			$wp_customize->add_setting(
				'havocwp_single_post_header_background_cover',
				array(
					'transport'         => 'postMessage',
					'default'           => '#000000b3',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havocwp_single_post_header_background_cover',
					array(
						'label'           => esc_html__( 'Post Title Overlay Color', 'havocwp' ),
						'section'         => 'havoc_single_post',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_post_header_cover_style',
					)
				)
			);

			/**
			 * Single Post Header Meta Style
			 *
			 * 			 */
			$wp_customize->add_setting(
				'havocwp_single_post_header_meta_style',
				array(
					'default'           => 'spm_style_2',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havocwp_single_post_header_meta_style',
					array(
						'label'           => esc_html__( 'Post Title Meta Style', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_single_post',
						'settings'        => 'havocwp_single_post_header_meta_style',
						'priority'        => 10,
						'choices'         => array(
							'spm_style_2'  => esc_html__( 'Minimal', 'havocwp' ),
							'spm_style_3'  => esc_html__( 'Stylish', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_hasnt_default_post_header_style',
					)
				)
			);

			/**
			 * Single Post Header Meta Style Separator
			 *
			 * 			 */
			$wp_customize->add_setting(
				'havocwp_single_post_header_meta_separator',
				array(
					'default'           => 'stylish',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havocwp_single_post_header_meta_separator',
					array(
						'label'           => esc_html__( 'Post Title Meta Separator', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_single_post',
						'settings'        => 'havocwp_single_post_header_meta_separator',
						'priority'        => 10,
						'choices'         => array(
							'none'     => esc_html__( 'None', 'havocwp' ),
							'classic'  => esc_html__( 'Classic', 'havocwp' ),
							'stylish'  => esc_html__( 'Stylish', 'havocwp' ),
							'modern'   => esc_html__( 'Modern', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_hasnt_default_post_header_style',
					)
				)
			);

			$wp_customize->add_setting(
				'havocwp_single_post_meta_icon_clr',
				array(
					'transport'         => 'postMessage',
					'default'           => '#000',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havocwp_single_post_meta_icon_clr',
					array(
						'label'           => esc_html__( 'Meta Icon Color', 'havocwp' ),
						'section'         => 'havoc_single_post',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_post_meta_stylish',
					)
				)
			);

			/**
			 * Blog Single Header Meta
			 */
			$wp_customize->add_setting(
				'havocwp_blog_single_header_meta',
				array(
					'default'           => array( 'author', 'date', 'categories', 'comments', 'mod-date', 'reading-time', 'tags' ),
					'sanitize_callback' => 'havocwp_sanitize_multi_choices',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Sortable_Control(
					$wp_customize,
					'havocwp_blog_single_header_meta',
					array(
						'label'    => esc_html__( 'Post Title Meta', 'havocwp' ),
						'section'  => 'havoc_single_post',
						'settings' => 'havocwp_blog_single_header_meta',
						'priority' => 10,
						'choices'  => apply_filters(
							'havoc_blog_header_meta_choices',
							array(
								'author'        => esc_html__( 'Author', 'havocwp' ),
								'date'          => esc_html__( 'Date', 'havocwp' ),
								'categories'    => esc_html__( 'Categories', 'havocwp' ),
								'comments'      => esc_html__( 'Comments', 'havocwp' ),
								'mod-date'      => esc_html__( 'Modified Date', 'havocwp' ),
								'reading-time'  => esc_html__( 'Reading Time', 'havocwp' ),
								'tags'          => esc_html__( 'Tags', 'havocwp' ),
							)
						),
						'active_callback' => 'havocwp_cac_hasnt_default_post_header_style',
					)
				)
			);

			/**
			 * Blog Single Title Heading Tag
			 */
			$wp_customize->add_setting(
				'havoc_single_post_heading_tag',
				array(
					'default'           => 'h2',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_single_post_heading_tag',
					array(
						'label'    => esc_html__( 'Heading Tag', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_single_post',
						'settings' => 'havoc_single_post_heading_tag',
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
			 * Page Header Title
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_page_header_title',
				array(
					'default'           => 'blog',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_page_header_title',
					array(
						'label'    => esc_html__( 'Page Header Title', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_single_post',
						'settings' => 'havoc_blog_single_page_header_title',
						'priority' => 10,
						'choices'  => array(
							'blog'       => esc_html__( 'Blog', 'havocwp' ),
							'post-title' => esc_html__( 'Post Title', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Add Featured Image In Page Header
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_featured_image_title',
				array(
					'default'           => false,
					'sanitize_callback' => 'havocwp_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_featured_image_title',
					array(
						'label'           => esc_html__( 'Featured Image In Page Header', 'havocwp' ),
						'type'            => 'checkbox',
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_featured_image_title',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_default_post_header_style',
					)
				)
			);

			/**
			 * Blog Single Title/Breadcrumb Position
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_title_breadcrumb_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'center',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_blog_single_title_breadcrumb_position',
					array(
						'label'           => esc_html__( 'Title/Breadcrumb Position', 'havocwp' ),
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_title_breadcrumb_position',
						'priority'        => 10,
						'choices'         => array(
							'left'   => esc_html__( 'Left', 'havocwp' ),
							'center' => esc_html__( 'Center', 'havocwp' ),
							'right'  => esc_html__( 'Right', 'havocwp' ),
						),
						'active_callback' => 'havocwp_cac_has_blog_single_title_bg_image',
					)
				)
			);

			/**
			 * Blog Single Page Header Background Image Position
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_title_bg_image_position',
				array(
					'transport'         => 'postMessage',
					'default'           => 'top center',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_title_bg_image_position',
					array(
						'label'           => esc_html__( 'Position', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_title_bg_image_position',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_blog_single_title_bg_image',
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
			 * Blog Single Page Header Background Image Attachment
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_title_bg_image_attachment',
				array(
					'transport'         => 'postMessage',
					'default'           => 'initial',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_title_bg_image_attachment',
					array(
						'label'           => esc_html__( 'Attachment', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_title_bg_image_attachment',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_blog_single_title_bg_image',
						'choices'         => array(
							'initial' => esc_html__( 'Default', 'havocwp' ),
							'scroll'  => esc_html__( 'Scroll', 'havocwp' ),
							'fixed'   => esc_html__( 'Fixed', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Blog Single Page Header Background Image Repeat
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_title_bg_image_repeat',
				array(
					'transport'         => 'postMessage',
					'default'           => 'no-repeat',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_title_bg_image_repeat',
					array(
						'label'           => esc_html__( 'Repeat', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_title_bg_image_repeat',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_blog_single_title_bg_image',
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
			 * Blog Single Page Header Background Image Size
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_title_bg_image_size',
				array(
					'transport'         => 'postMessage',
					'default'           => 'cover',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_title_bg_image_size',
					array(
						'label'           => esc_html__( 'Size', 'havocwp' ),
						'type'            => 'select',
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_title_bg_image_size',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_blog_single_title_bg_image',
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
			 * Blog Single Page Header Background Image Height
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_title_bg_image_height',
				array(
					'transport'         => 'postMessage',
					'default'           => '400',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_blog_single_title_bg_image_height',
					array(
						'label'           => esc_html__( 'Page Header Height (px)', 'havocwp' ),
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_title_bg_image_height',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 800,
							'step' => 1,
						),
						'active_callback' => 'havocwp_cac_has_blog_single_title_bg_image',
					)
				)
			);

			/**
			 * Blog Single Page Header Background Image Overlay Opacity
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_title_bg_image_overlay_opacity',
				array(
					'transport'         => 'postMessage',
					'default'           => '0.5',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_blog_single_title_bg_image_overlay_opacity',
					array(
						'label'           => esc_html__( 'Overlay Opacity', 'havocwp' ),
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_title_bg_image_overlay_opacity',
						'priority'        => 10,
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 1,
							'step' => 0.1,
						),
						'active_callback' => 'havocwp_cac_has_blog_single_title_bg_image',
					)
				)
			);

			/**
			 * Blog Single Page Header Background Image Overlay Color
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_title_bg_image_overlay_color',
				array(
					'transport'         => 'postMessage',
					'default'           => '#000000',
					'sanitize_callback' => 'havocwp_sanitize_color',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Color_Control(
					$wp_customize,
					'havoc_blog_single_title_bg_image_overlay_color',
					array(
						'label'           => esc_html__( 'Overlay Color', 'havocwp' ),
						'section'         => 'havoc_single_post',
						'settings'        => 'havoc_blog_single_title_bg_image_overlay_color',
						'priority'        => 10,
						'active_callback' => 'havocwp_cac_has_blog_single_title_bg_image',
					)
				)
			);

			/**
			 * Full Width Content Max Width
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_content_width',
				array(
					'transport'         => 'postMessage',
					'default'           => '700',
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_content_width',
					array(
						'label'       => esc_html__( 'Full Width Content', 'havocwp' ),
						'description' => esc_html__( 'Enter the max width your the content with the full width layout. Add 0 to disable the max width.', 'havocwp' ),
						'type'        => 'number',
						'section'     => 'havoc_single_post',
						'settings'    => 'havoc_blog_single_content_width',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 0,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Blog Single Elements Positioning
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_elements_positioning',
				array(
					'default'           => array( 'featured_image', 'title', 'meta', 'content', 'tags', 'social_share', 'next_prev', 'author_box', 'related_posts', 'single_comments' ),
					'sanitize_callback' => 'havocwp_sanitize_multi_choices',
				)
			);
			https://www.download.ir/
			$wp_customize->add_control(
				new HavocWP_Customizer_Sortable_Control(
					$wp_customize,
					'havoc_blog_single_elements_positioning',
					array(
						'label'    => esc_html__( 'Elements Positioning', 'havocwp' ),
						'section'  => 'havoc_single_post',
						'settings' => 'havoc_blog_single_elements_positioning',
						'priority' => 10,
						'choices'  => havocwp_blog_single_elements(),
					)
				)
			);

			/**
			 * Blog Single Meta
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_meta',
				array(
					'default'           => array( 'author', 'date', 'categories', 'comments' ),
					'sanitize_callback' => 'havocwp_sanitize_multi_choices',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Sortable_Control(
					$wp_customize,
					'havoc_blog_single_meta',
					array(
						'label'    => esc_html__( 'Meta', 'havocwp' ),
						'section'  => 'havoc_single_post',
						'settings' => 'havoc_blog_single_meta',
						'priority' => 10,
						'choices'  => apply_filters(
							'havoc_blog_meta_choices',
							array(
								'author'       => esc_html__( 'Author', 'havocwp' ),
								'date'         => esc_html__( 'Date', 'havocwp' ),
								'categories'   => esc_html__( 'Categories', 'havocwp' ),
								'comments'     => esc_html__( 'Comments', 'havocwp' ),
								'mod-date'     => esc_html__( 'Modified Date', 'havocwp' ),
								'reading-time' => esc_html__( 'Reading Time', 'havocwp' ),
							)
						),
					)
				)
			);

			/**
			 * Single Post Meta Separator
			 *
			 * @since 2.0
			 */
			$wp_customize->add_setting(
				'havoc_blog_single_meta_separator',
				array(
					'default'           => 'default',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_single_meta_separator',
					array(
						'label'    => esc_html__( 'Meta Separator', 'havocwp' ),
						'type'     => 'select',
						'section'  => 'havoc_single_post',
						'settings' => 'havoc_blog_single_meta_separator',
						'priority' => 10,
						'choices'  => array(
							'default' => esc_html__( 'Default', 'havocwp' ),
							'modern'  => esc_html__( 'Modern', 'havocwp' ),
							'stylish' => esc_html__( 'Stylish', 'havocwp' ),
							'none'    => esc_html__( 'None', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Next/Prev Taxonomy
			 */
			$wp_customize->add_setting(
				'havoc_single_post_next_prev_taxonomy',
				array(
					'default'           => 'post_tag',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_single_post_next_prev_taxonomy',
					array(
						'label'    => esc_html__( 'Next/Prev Taxonomy', 'havocwp' ),
						'section'  => 'havoc_single_post',
						'settings' => 'havoc_single_post_next_prev_taxonomy',
						'priority' => 10,
						'choices'  => array(
							'category' => esc_html__( 'Category', 'havocwp' ),
							'post_tag' => esc_html__( 'Tag', 'havocwp' ),
							'pub-date' => esc_html__( 'Date', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Related Posts Count
			 */
			$wp_customize->add_setting(
				'havoc_blog_related_count',
				array(
					'default'           => '3',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_blog_related_count',
					array(
						'label'       => esc_html__( 'Related Posts Count', 'havocwp' ),
						'section'     => 'havoc_single_post',
						'settings'    => 'havoc_blog_related_count',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 2,
							'max'  => 50,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Related Posts Columns
			 */
			$wp_customize->add_setting(
				'havoc_blog_related_columns',
				array(
					'default'           => '3',
					'sanitize_callback' => 'havocwp_sanitize_number',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Range_Control(
					$wp_customize,
					'havoc_blog_related_columns',
					array(
						'label'       => esc_html__( 'Related Posts Columns', 'havocwp' ),
						'section'     => 'havoc_single_post',
						'settings'    => 'havoc_blog_related_columns',
						'priority'    => 10,
						'input_attrs' => array(
							'min'  => 1,
							'max'  => 6,
							'step' => 1,
						),
					)
				)
			);

			/**
			 * Related Posts Taxonomy
			 */
			$wp_customize->add_setting(
				'havoc_blog_related_taxonomy',
				array(
					'default'           => 'category',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_blog_related_taxonomy',
					array(
						'label'    => esc_html__( 'Related Posts Taxonomy', 'havocwp' ),
						'section'  => 'havoc_single_post',
						'settings' => 'havoc_blog_related_taxonomy',
						'priority' => 10,
						'choices'  => array(
							'category' => esc_html__( 'Category', 'havocwp' ),
							'post_tag' => esc_html__( 'Tag', 'havocwp' ),
						),
					)
				)
			);

			/**
			 * Related Posts Image Width
			 */
			$wp_customize->add_setting(
				'havoc_blog_related_img_width',
				array(
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_related_img_width',
					array(
						'label'       => esc_html__( 'Related Posts Image Width (px)', 'havocwp' ),
						'type'        => 'number',
						'section'     => 'havoc_single_post',
						'settings'    => 'havoc_blog_related_img_width',
						'priority'    => 10,
						'input_attrs' => array(
							'min' => 0,
							'max' => 800,
						),
					)
				)
			);

			/**
			 * Related Posts Image Height
			 */
			$wp_customize->add_setting(
				'havoc_blog_related_img_height',
				array(
					'sanitize_callback' => 'havocwp_sanitize_number_blank',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'havoc_blog_related_img_height',
					array(
						'label'       => esc_html__( 'Related Posts Image Height (px)', 'havocwp' ),
						'type'        => 'number',
						'section'     => 'havoc_single_post',
						'settings'    => 'havoc_blog_related_img_height',
						'priority'    => 10,
						'input_attrs' => array(
							'min' => 0,
							'max' => 800,
						),
					)
				)
			);

			/**
			 * Comment form position.
			 *
			 * 			 */
			$wp_customize->add_setting(
				'havoc_comment_form_position',
				array(
					'default'           => 'after',
					'sanitize_callback' => 'havocwp_sanitize_select',
				)
			);

			$wp_customize->add_control(
				new HavocWP_Customizer_Buttonset_Control(
					$wp_customize,
					'havoc_comment_form_position',
					array(
						'label'    => esc_html__( 'Comment Form Position', 'havocwp' ),
						'section'  => 'havoc_single_post',
						'settings' => 'havoc_comment_form_position',
						'priority' => 10,
						'choices'  => array(
							'before' => esc_html__( 'Before', 'havocwp' ),
							'after'  => esc_html__( 'After', 'havocwp' ),
						),
					)
				)
			);

		}

		/**
		 * Get CSS
		 *
		 * @param obj $output    css output.
		 * 		 */
		public static function head_css( $output ) {

			// Layout.
			$entries_layout = get_theme_mod( 'havoc_blog_archives_layout', 'right-sidebar' );
			$single_layout  = get_theme_mod( 'havoc_blog_single_layout', 'right-sidebar' );

			// Global vars.
			$bs_archives_content_width      = get_theme_mod( 'havoc_blog_archives_both_sidebars_content_width' );
			$bs_archives_sidebars_width     = get_theme_mod( 'havoc_blog_archives_both_sidebars_sidebars_width' );
			$bs_single_content_width        = get_theme_mod( 'havoc_blog_single_both_sidebars_content_width' );
			$bs_single_sidebars_width       = get_theme_mod( 'havoc_blog_single_both_sidebars_sidebars_width' );
			$thumbnail_category_color       = get_theme_mod( 'havoc_blog_thumbnail_category_color', '#13aff0' );
			$thumbnail_category_hover_color = get_theme_mod( 'havoc_blog_thumbnail_category_hover_color', '#333333' );
			$thumbnail_comments_color       = get_theme_mod( 'havoc_blog_thumbnail_comments_color', '#ababab' );
			$thumbnail_comments_hover_color = get_theme_mod( 'havoc_blog_thumbnail_comments_hover_color', '#13aff0' );
			$thumbnail_date_color           = get_theme_mod( 'havoc_blog_thumbnail_date_color', '#ababab' );
			$infinite_scroll_spinners_color = get_theme_mod( 'havoc_blog_infinite_scroll_spinners_color', '#333333' );
			$title_breadcrumb_position      = get_theme_mod( 'havoc_blog_single_title_breadcrumb_position', 'center' );
			$single_content_width           = get_theme_mod( 'havoc_blog_single_content_width', '700' );
			$single_post_header_bg_color    = get_theme_mod( 'havocwp_single_post_header_background', '#e5e5e5' );
			$single_post_cover_overlay_clr  = get_theme_mod( 'havocwp_single_post_header_background_cover', '#000000b3' );
			$single_post_meta_icon_color    = get_theme_mod( 'havocwp_single_post_meta_icon_clr', '#000' );

			// Define css var.
			$css = '';

			// If blog archives Both Sidebars layout.
			if ( 'both-sidebars' === $entries_layout ) {

				// Both Sidebars layout blog archives content width.
				if ( ! empty( $bs_archives_content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.blog.content-both-sidebars .content-area,
							body.archive.content-both-sidebars .content-area {width: ' . $bs_archives_content_width . '%;}
							body.blog.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.blog.content-both-sidebars.ssc-style .widget-area,
							body.archive.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.archive.content-both-sidebars.ssc-style .widget-area {left: -' . $bs_archives_content_width . '%;}
						}';
				}

				// Both Sidebars layout blog archives sidebars width.
				if ( ! empty( $bs_archives_sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.blog.content-both-sidebars .widget-area,
							body.archive.content-both-sidebars .widget-area{width:' . $bs_archives_sidebars_width . '%;}
							body.blog.content-both-sidebars.scs-style .content-area,
							body.archive.content-both-sidebars.scs-style .content-area{left:' . $bs_archives_sidebars_width . '%;}
							body.blog.content-both-sidebars.ssc-style .content-area,
							body.archive.content-both-sidebars.ssc-style .content-area{left:' . $bs_archives_sidebars_width * 2 . '%;}
						}';
				}
			}

			// If single post Both Sidebars layout.
			if ( 'both-sidebars' === $single_layout ) {

				// Both Sidebars layout single post content width.
				if ( ! empty( $bs_single_content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.single-post.content-both-sidebars .content-area {width: ' . $bs_single_content_width . '%;}
							body.single-post.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.single-post.content-both-sidebars.ssc-style .widget-area {left: -' . $bs_single_content_width . '%;}
						}';
				}

				// Both Sidebars layout blog archives sidebars width.
				if ( ! empty( $bs_single_sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.single-post.content-both-sidebars .widget-area{width:' . $bs_single_sidebars_width . '%;}
							body.single-post.content-both-sidebars.scs-style .content-area{left:' . $bs_single_sidebars_width . '%;}
							body.single-post.content-both-sidebars.ssc-style .content-area{left:' . $bs_single_sidebars_width * 2 . '%;}
						}';
				}
			}

			// Single post header background color.
			if ( ! empty( $single_post_header_bg_color ) && '#e5e5e5' != $single_post_header_bg_color ) {
				$css .= '.single-post-header-wrap, .single-header-havoc-6 .blog-post-title, .single-header-havoc-7 .blog-post-title {background-color:' . $single_post_header_bg_color . ';}';
			}

			// Single post header cover style overlay color.
			if ( ! empty( $single_post_cover_overlay_clr ) && '#000000b3' != $single_post_cover_overlay_clr ) {
				$css .= '.single-post-header-wrap .header-color-overlay {background-color:' . $single_post_cover_overlay_clr . ';}';
			}

			// Single post header meta icon color.
			if ( ! empty( $single_post_meta_icon_color ) && '#000' != $single_post_meta_icon_color ) {
				$css .= '.havoc-single-post-header ul.meta-item li i  {color:' . $single_post_meta_icon_color . ';}';
				$css .= '.havoc-single-post-header ul.meta-item li .hvc-icon use  {stroke:' . $single_post_meta_icon_color . ';}';
			}

			// Blog thumbnail category color.
			if ( ! empty( $thumbnail_category_color ) && '#13aff0' != $thumbnail_category_color ) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-category a{color:' . $thumbnail_category_color . ';}';
			}

			// Blog thumbnail category hover color.
			if ( ! empty( $thumbnail_category_hover_color ) && '#333333' != $thumbnail_category_hover_color ) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-category a:hover{color:' . $thumbnail_category_hover_color . ';}';
			}

			// Blog thumbnail comments color.
			if ( ! empty( $thumbnail_comments_color ) && '#ababab' != $thumbnail_comments_color ) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-comments, .blog-entry.thumbnail-entry .blog-entry-comments a{color:' . $thumbnail_comments_color . ';}';
			}

			// Blog thumbnail comments hover color.
			if ( ! empty( $thumbnail_comments_hover_color ) && '#13aff0' != $thumbnail_comments_hover_color ) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-comments a:hover{color:' . $thumbnail_comments_hover_color . ';}';
			}

			// Blog thumbnail date color.
			if ( ! empty( $thumbnail_date_color ) && '#ababab' != $thumbnail_date_color ) {
				$css .= '.blog-entry.thumbnail-entry .blog-entry-date{color:' . $thumbnail_date_color . ';}';
			}

			// Blog infinite scroll spinners color.
			if ( ! empty( $infinite_scroll_spinners_color ) && '#333333' != $infinite_scroll_spinners_color ) {
				$css .= '.loader-ellips__dot{background-color:' . $infinite_scroll_spinners_color . ';}';
			}

			// Title/breadcrumb position.
			if ( ! empty( $title_breadcrumb_position ) && 'center' != $title_breadcrumb_position ) {
				$css .= '.single-post .background-image-page-header .page-header-inner, .single-post .background-image-page-header .site-breadcrumbs{text-align:' . $title_breadcrumb_position . ';}';
			}

			// Single content width.
			if ( ! empty( $single_content_width ) && '700' != $single_content_width ) {
				$css .= '
					.single-post.content-max-width #wrap .thumbnail,
					.single-post.content-max-width #wrap .wp-block-buttons,
					.single-post.content-max-width #wrap .wp-block-verse,
					.single-post.content-max-width #wrap .entry-header,
					.single-post.content-max-width #wrap ul.meta,
					.single-post.content-max-width #wrap .entry-content p,
					.single-post.content-max-width #wrap .entry-content h1,
					.single-post.content-max-width #wrap .entry-content h2,
					.single-post.content-max-width #wrap .entry-content h3,
					.single-post.content-max-width #wrap .entry-content h4,
					.single-post.content-max-width #wrap .entry-content h5,
					.single-post.content-max-width #wrap .entry-content h6,
					.single-post.content-max-width #wrap .wp-block-image,
					.single-post.content-max-width #wrap .wp-block-gallery,
					.single-post.content-max-width #wrap .wp-block-video,
					.single-post.content-max-width #wrap .wp-block-quote,
					.single-post.content-max-width #wrap .wp-block-text-columns,
					.single-post.content-max-width #wrap .wp-block-code,
					.single-post.content-max-width #wrap .entry-content ul,
					.single-post.content-max-width #wrap .entry-content ol,
					.single-post.content-max-width #wrap .wp-block-cover-text,
					.single-post.content-max-width #wrap .wp-block-cover,
					.single-post.content-max-width #wrap .wp-block-columns,
					.single-post.content-max-width #wrap .post-tags,
					.single-post.content-max-width #wrap .comments-area,
					.single-post.content-max-width #wrap .wp-block-embed,
					#wrap .wp-block-separator.is-style-wide:not(.size-full){max-width:' . $single_content_width . 'px;}
					.single-post.content-max-width #wrap .wp-block-image.alignleft,
					.single-post.content-max-width #wrap .wp-block-image.alignright{max-width:' . $single_content_width / 2 . 'px;}
					.single-post.content-max-width #wrap .wp-block-image.alignleft{margin-left: calc( 50% - ' . $single_content_width / 2 . 'px);}
					.single-post.content-max-width #wrap .wp-block-image.alignright{margin-right: calc( 50% - ' . $single_content_width / 2 . 'px);}
					.single-post.content-max-width #wrap .wp-block-embed,
					.single-post.content-max-width #wrap .wp-block-verse {margin-left: auto; margin-right: auto;}
				';

			}

			// Return CSS.
			if ( ! empty( $css ) ) {
				$output .= '/* Blog CSS */' . $css;
			}

			// Return output css.
			return $output;

		}

	}

endif;

return new HavocWP_Blog_Customizer();
