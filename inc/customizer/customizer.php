<?php
/**
 * HavocWP Customizer Class
 *
 * @package HavocWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'HavocWP_Customizer' ) ) :

	/**
	 * The HavocWP Customizer class
	 */
	class HavocWP_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'customize_register',					array( $this, 'custom_controls' ) );
			add_action( 'customize_register',					array( $this, 'controls_helpers' ) );
			add_action( 'customize_register',					array( $this, 'customize_register' ), 11 );
			add_action( 'after_setup_theme',					array( $this, 'register_options' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'customize_panel_init' ) );
			add_action( 'customize_preview_init', 				array( $this, 'customize_preview_init' ) );
			add_action( 'customize_controls_enqueue_scripts',   array( $this, 'custom_customize_enqueue' ), 7 );
			add_action( 'customize_controls_print_scripts', 'havoc_get_svg_icon' );
			add_action( 'wp_ajax_havoc_update_search_box_light_mode', array( $this, 'update_search_box_light_Mode' ) );
		}

		/**
		 * Adds custom controls
		 *
		 * 		 */
		public function custom_controls( $wp_customize ) {

			// Path
			$dir = HAVOCWP_INC_DIR . 'customizer/controls/';

			// Load customize control classes
			require_once( $dir . 'dimensions/class-control-dimensions.php' 					);
			require_once( $dir . 'dropdown-pages/class-control-dropdown-pages.php' 			);
			require_once( $dir . 'heading/class-control-heading.php' 						);
			require_once( $dir . 'info/class-control-info.php' 	       					);
			require_once( $dir . 'icon-select/class-control-icon-select.php' 				);
			require_once( $dir . 'icon-select-multi/class-control-icon-select-multi.php' 	);
			require_once( $dir . 'multiple-select/class-control-multiple-select.php' 		);
			require_once( $dir . 'slider/class-control-slider.php' 							);
			require_once( $dir . 'sortable/class-control-sortable.php' 						);
			require_once( $dir . 'text/class-control-text.php' 								);
			require_once( $dir . 'textarea/class-control-textarea.php' 						);
			require_once( $dir . 'typo/class-control-typo.php' 								);
			require_once( $dir . 'typography/class-control-typography.php' 					);

			// Register JS control types
			$wp_customize->register_control_type( 'HavocWP_Customizer_Dimensions_Control' 		);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Dropdown_Pages' 			);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Heading_Control' 			);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Info_Control' 			);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Icon_Select_Control' 		);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Icon_Select_Multi_Control' );
			$wp_customize->register_control_type( 'HavocWP_Customize_Multiple_Select_Control' 	);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Slider_Control' 			);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Sortable_Control' 		);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Text_Control' 			);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Textarea_Control' 		);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Typo_Control' 			);
			$wp_customize->register_control_type( 'HavocWP_Customizer_Typography_Control' 		);

		}

		/**
		 * Updating the search box light Mode via Ajax request
		 *
		 * 		 */
		public function update_search_box_light_Mode() {
			$darkMode = esc_attr( $_REQUEST['darkMode'] );
			update_option( 'havocCustomizerSearchdarkMode', $darkMode );
			wp_send_json_success();
		}

		/**
		 * Adds customizer helpers
		 *
		 * 		 */
		public function controls_helpers() {
			require_once( HAVOCWP_INC_DIR .'customizer/customizer-helpers.php' );
			require_once( HAVOCWP_INC_DIR .'customizer/sanitization-callbacks.php' );
		}

		/**
		 * Core modules
		 *
		 * 		 */
		public static function customize_register( $wp_customize ) {

			// Tweak default controls
			$wp_customize->get_setting( 'custom_logo' )->transport      = 'refresh';
			$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';

			// Move custom logo setting
			$wp_customize->get_control( 'custom_logo' )->section 		= 'havoc_header_logo';

            if ( ! function_exists( 'hvc_fs' ) ) {
                // Add our upsell section
                if ( true != apply_filters( 'havocwp_licence_tab_enable', false ) ) {

                    // Get link
                    $url = 'https://havocwp.org/core-extensions-bundle/';

                    // If affiliate ref
                    $ref_url = '';
                    $aff_ref = apply_filters( 'havoc_affiliate_ref', $ref_url );

                    // Add & is has referal link
                    if ( $aff_ref ) {
                        $if_ref = '&';
                    } else {
                        $if_ref = '?';
                    }

                    // Add source
                    $utm = $if_ref . 'utm_source=customizer&utm_campaign=bundle&utm_medium=wp-dash';

                    $wp_customize->add_section( new HavocWP_Upsell_Section( $wp_customize, 'havocwp_upsell_section', array(
                        'title'    => esc_html__( 'Premium Addons Available', 'havocwp' ),
                        'url'      => $url . $aff_ref . $utm,
                        'priority' => 0,
						'backgroundcolor' => '#5277fe',
						'textcolor' => '#fff',
                    ) ) );

                }
            }

		}

		/**
		 * Adds customizer options
		 *
		 * 		 */
		public function register_options() {
			// Var
			$dir = HAVOCWP_INC_DIR .'customizer/settings/';

			// Customizer files array
			$files = array(
				'typography',
				'general',
				'blog',
				'header',
				'topbar',
				'footer-widgets',
				'footer-bottom',
				'sidebar',
			);

			foreach ( $files as $key ) {

				$setting = str_replace( '-', '_', $key );

				require_once( $dir . $key .'.php' );
			}

			// If WooCommerce is activated.
			if ( HAVOCWP_WOOCOMMERCE_ACTIVE ) {
				require_once( $dir .'woocommerce.php' );
			}

		}


		/**
		 * Loads Css files for customizer Panel
		 *
		 * 		 */
		public function customize_panel_init() {

			$settings = wp_parse_args( get_option( 'oe_panels_settings', [] ) );

			if ( isset( $settings['customizer-search'] ) && (bool) $settings['customizer-search'] === true ) {
				wp_enqueue_script( 'havocwp-customize-search-js', HAVOCWP_INC_DIR_URI . 'customizer/assets/js/customize-search.js', array( 'lodash', 'wp-i18n', 'wp-util' ) );
				wp_enqueue_style( 'havocwp-customize-search', HAVOCWP_INC_DIR_URI . 'customizer/assets/js/customize-search.css' );
				wp_localize_script( 'havocwp-customize-search-js', 'havocCustomizerSearchOptions', [
					'darkMode' => get_option( 'havocCustomizerSearchdarkMode', false )
				] );
			}


			wp_enqueue_script( 'havocwp-customize-js', HAVOCWP_INC_DIR_URI . 'customizer/assets/js/customize.js', array( 'jquery' ) );
			wp_enqueue_style( 'havocwp-customize-preview', HAVOCWP_INC_DIR_URI . 'customizer/assets/css/customize-preview.min.css');
		}

		/**
		 * Loads js files for customizer preview
		 *
		 * 		 */
		public function customize_preview_init() {
			wp_enqueue_script( 'havocwp-customize-preview', HAVOCWP_INC_DIR_URI . 'customizer/assets/js/customize-preview.min.js', array( 'customize-preview' ), HAVOCWP_THEME_VERSION, true );

			// If WooCommerce is activated.
			if ( HAVOCWP_WOOCOMMERCE_ACTIVE ) {
				wp_enqueue_script( 'havocwp-woo-customize-preview', HAVOCWP_INC_DIR_URI . 'customizer/assets/js/woo-customize-preview.min.js', array( 'customize-preview' ), HAVOCWP_THEME_VERSION, true );
			}
		}

		/**
		 * Load scripts for customizer
		 *
		 * 		 */
		public function custom_customize_enqueue() {
			wp_enqueue_style( 'font-awesome', HAVOCWP_THEME_URI .'/assets/fonts/fontawesome/css/all.min.css', false, '5.11.2'  );
			wp_enqueue_style( 'simple-line-icons', HAVOCWP_INC_DIR_URI .'customizer/assets/css/customizer-simple-line-icons.min.css', false, '2.4.0' );
			wp_enqueue_style( 'havocwp-general', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/css/general.min.css' );
			wp_enqueue_script( 'havocwp-general', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/js/general.min.js', array( 'jquery', 'customize-base' ), false, true );


			if ( is_rtl() ) {
				wp_enqueue_style( 'havocwp-controls-rtl', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/css/rtl.min.css' );
			}
		}

	}

endif;

return new HavocWP_Customizer();
