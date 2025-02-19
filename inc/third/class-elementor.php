<?php
/**
 * Elementor class
 *
 * @package HavocWP WordPress theme
 */

// If Elementor plugins doesn't exist then return.
if ( ! HAVOCWP_ELEMENTOR_ACTIVE
	&& version_compare( PHP_VERSION, '5.6', '>=' ) ) {
	return;
}

if ( ! class_exists( 'HavocWP_Elementor' ) ) :

	class HavocWP_Elementor {

		/**
		 * Setup class.
		 *
		 * 		 */
		public function __construct() {
			add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		}

		/**
		 * Get the top bar content ID.
		 *
		 * 		 */
		public static function get_topbar_content_id() {

			// Template
			$id = get_theme_mod( 'havoc_top_bar_template' );

			// If template is selected
			if ( ! empty( $id ) ) {

				// Get Polylang Translation of template
				if ( function_exists( 'pll_get_post' )) {
					$id_polylang = pll_get_post( $id, pll_current_language() );
					if ( ! empty( $id_polylang ) ) {
						$id = $id_polylang;
					}
				}

				return $id;
			}

			// Return
			return false;
			
		}

		/**
		 * Get the top bar social alternative ID.
		 *
		 * 		 */
		public static function get_topbar_social_alt_id() {

			// Template
			$id = get_theme_mod( 'havoc_top_bar_social_alt_template' );

			// If template is selected
			if ( ! empty( $id ) ) {

				// Get Polylang Translation of template
				if ( function_exists( 'pll_get_post' )) {
					$id_polylang = pll_get_post( $id, pll_current_language() );
					if ( ! empty( $id_polylang ) ) {
						$id = $id_polylang;
					}
				}
				
				return $id;
			}

			// Return
			return false;
			
		}

		/**
		 * Get the vertical header ID.
		 *
		 * 		 */
		public static function get_vertical_header_id() {

			// Template
			$id = get_theme_mod( 'havoc_vertical_header_template' );

			// If template is selected
			if ( ! empty( $id ) ) {

				// Get Polylang Translation of template
				if ( function_exists( 'pll_get_post' )) {
					$id_polylang = pll_get_post( $id, pll_current_language() );
					if ( ! empty( $id_polylang ) ) {
						$id = $id_polylang;
					}
				}
				
				return $id;
			}

			// Return
			return false;
			
		}

		/**
		 * Get the vertical header bottom ID.
		 *
		 * 		 */
		public static function get_vertical_header_bottom_id() {

			// Template
			$id = get_theme_mod( 'havoc_vertical_header_bottom_template' );

			// If template is selected
			if ( ! empty( $id ) ) {

				// Get Polylang Translation of template
				if ( function_exists( 'pll_get_post' )) {
					$id_polylang = pll_get_post( $id, pll_current_language() );
					if ( ! empty( $id_polylang ) ) {
						$id = $id_polylang;
					}
				}
				
				return $id;
			}

			// Return
			return false;
			
		}

		/**
		 * Get the header ID.
		 *
		 * 		 */
		public static function get_header_id() {

			// Template
			$id = havocwp_custom_header_template();

			// If template is selected
			if ( ! empty( $id ) ) {

				// Get Polylang Translation of template
				if ( function_exists( 'pll_get_post' )) {
					$id_polylang = pll_get_post( $id, pll_current_language() );
					if ( ! empty( $id_polylang ) ) {
						$id = $id_polylang;
					}
				}
				
				return $id;
			}

			// Return
			return false;
			
		}

		/**
		 * Get the nav ID.
		 *
		 * 		 */
		public static function get_nav_id() {

			// Template
			$id = havocwp_custom_nav_template();

			// If template is selected
			if ( ! empty( $id ) ) {

				// Get Polylang Translation of template
				if ( function_exists( 'pll_get_post' )) {
					$id_polylang = pll_get_post( $id, pll_current_language() );
					if ( ! empty( $id_polylang ) ) {
						$id = $id_polylang;
					}
				}
				
				return $id;
			}

			// Return
			return false;
			
		}

		/**
		 * Get the social menu ID.
		 *
		 * 		 */
		public static function get_social_menu_id() {

			// Template
			$id = get_theme_mod( 'havoc_menu_social_template' );

			// If template is selected
			if ( ! empty( $id ) ) {

				// Get Polylang Translation of template
				if ( function_exists( 'pll_get_post' )) {
					$id_polylang = pll_get_post( $id, pll_current_language() );
					if ( ! empty( $id_polylang ) ) {
						$id = $id_polylang;
					}
				}
				
				return $id;
			}

			// Return
			return false;
			
		}

		/**
		 * Get the footer ID.
		 *
		 * 		 */
		public static function get_footer_id() {

			// Template
			$id = havocwp_custom_footer_template();

			// If template is selected
			if ( ! empty( $id ) ) {

				// Get Polylang Translation of template
				if ( function_exists( 'pll_get_post' )) {
					$id_polylang = pll_get_post( $id, pll_current_language() );
					if ( ! empty( $id_polylang ) ) {
						$id = $id_polylang;
					}
				}
				
				return $id;
			}

			// Return
			return false;
			
		}

		/**
		 * Get the 404 error page ID.
		 *
		 * 		 */
		public static function get_error_page_id() {

			// Template
			$id = get_theme_mod( 'havoc_error_page_template' );

			// If template is selected
			if ( ! empty( $id ) ) {

				// Get Polylang Translation of template
				if ( function_exists( 'pll_get_post' )) {
					$id_polylang = pll_get_post( $id, pll_current_language() );
					if ( ! empty( $id_polylang ) ) {
						$id = $id_polylang;
					}
				}
				
				return $id;
			}

			// Return
			return false;
			
		}

		/**
		 * Preview styles
		 *
		 * 		 */
		public static function preview_styles() {
			wp_enqueue_style( 'havocwp-elementor-preview', HAVOCWP_CSS_DIR_URI .'third/elementor-editor.min.css' );
		}

		/**
		 * Enqueue styles
		 *
		 * 		 */
		public static function enqueue_styles() {

			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {

				$topbar_id 					= self::get_topbar_content_id();
				$topbar_social_alt_id 		= self::get_topbar_social_alt_id();
				$vertical_header_id 		= self::get_vertical_header_id();
				$vertical_header_bottom_id 	= self::get_vertical_header_bottom_id();
				$header_id 					= self::get_header_id();
				$nav_id 					= self::get_nav_id();
				$social_menu_id 			= self::get_social_menu_id();
				$footer_id 					= self::get_footer_id();
				$error_id 					= self::get_error_page_id();

				// Enqueue top bar content css file
				if ( false != $topbar_id ) {
					$topbar_css = new \Elementor\Core\Files\CSS\Post( $topbar_id );
					$topbar_css->enqueue();
				}

				// Enqueue top bar social alternative css file
				if ( false != $topbar_social_alt_id ) {
					$topbar_social_alt_css = new \Elementor\Core\Files\CSS\Post( $topbar_social_alt_id );
					$topbar_social_alt_css->enqueue();
				}

				// Enqueue vertical header css file
				if ( false != $vertical_header_id ) {
					$vertical_header_css = new \Elementor\Core\Files\CSS\Post( $vertical_header_id );
					$vertical_header_css->enqueue();
				}

				// Enqueue vertical header bottom css file
				if ( false != $vertical_header_bottom_id ) {
					$vertical_header_bottom_css = new \Elementor\Core\Files\CSS\Post( $vertical_header_bottom_id );
					$vertical_header_bottom_css->enqueue();
				}

				// Enqueue header css file
				if ( false != $header_id ) {
					$header_css = new \Elementor\Core\Files\CSS\Post( $header_id );
					$header_css->enqueue();
				}

				// Enqueue nav css file
				if ( false != $nav_id ) {
					$nav_css = new \Elementor\Core\Files\CSS\Post( $nav_id );
					$nav_css->enqueue();
				}

				// Enqueue social menu css file
				if ( false != $social_menu_id ) {
					$social_menu_css = new \Elementor\Core\Files\CSS\Post( $social_menu_id );
					$social_menu_css->enqueue();
				}

				// Enqueue footer css file
				if ( false != $footer_id ) {
					$footer_css = new \Elementor\Core\Files\CSS\Post( $footer_id );
					$footer_css->enqueue();
				}

				// Enqueue 404 error page css file
				if ( false != $error_id ) {
					$error_css = new \Elementor\Core\Files\CSS\Post( $error_id );
					$error_css->enqueue();
				}

			}

		}

		/**
		 * Prints the top bar content.
		 *
		 * 		 */
		public static function get_topbar_content() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_topbar_content_id() );
		}

		/**
		 * Prints the top bar social alternative content.
		 *
		 * 		 */
		public static function get_topbar_social_alt_content() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_topbar_social_alt_id() );
		}

		/**
		 * Prints the vertical header content.
		 *
		 * 		 */
		public static function get_vertical_header_content() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_vertical_header_id() );
		}

		/**
		 * Prints the vertical header bottom content.
		 *
		 * 		 */
		public static function get_vertical_header_bottom_content() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_vertical_header_bottom_id() );
		}

		/**
		 * Prints the header content.
		 *
		 * 		 */
		public static function get_header_content() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_header_id() );
		}

		/**
		 * Prints the nav content.
		 *
		 * 		 */
		public static function get_nav_content() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_nav_id() );
		}

		/**
		 * Prints the social menu content.
		 *
		 * 		 */
		public static function get_social_menu_content() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_social_menu_id() );
		}

		/**
		 * Prints the footer content.
		 *
		 * 		 */
		public static function get_footer_content() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_footer_id() );
		}

		/**
		 * Prints the 404 error page content.
		 *
		 * 		 */
		public static function get_error_page_content() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_error_page_id() );
		}

	}

endif;

return new HavocWP_Elementor();