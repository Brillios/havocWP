<?php
/**
 * Header menu template part.
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

static $havoc_nav_plugin = false;

// Retunr if disabled.
if ( ! havocwp_display_navigation() ) {
	return;
}

// Header style.
$header_style = havocwp_header_style();

// Get ID.
$template = havocwp_custom_nav_template();

// Check if page is Elementor page.
$elementor = get_post_meta( $template, '_elementor_edit_mode', true );

// Get content.
$get_content = havocwp_nav_template_content();

// Get classes for the header menu.
$wrap_classes  = havocwp_header_menu_classes( 'wrapper' );
$inner_classes = havocwp_header_menu_classes( 'inner' );

// Nav attributes.
$hvc_nav_attrs = apply_filters( 'havocwp_attrs_main_nav', '' );

if ( ! empty( $template ) && ! defined( 'HAVOCWP_NAV_SHORTCODE_DONE' ) ) {
	do_action( 'havoc_before_nav' );

	if ( preg_match( '(havocwp_nav|havoc_wp)', $get_content ) === 1 ) {
		define( 'HAVOCWP_NAV_SHORTCODE_DONE', true );
	}

	// If is not full screen header style.
	if ( 'full_screen' !== $header_style ) { ?>
		<div id="site-navigation-wrap" class="<?php echo esc_attr( $wrap_classes ); ?>">
	<?php } ?>

		<?php do_action( 'havoc_before_nav_inner' ); ?>

		<?php
		if ( HAVOCWP_ELEMENTOR_ACTIVE && $elementor ) {

			// If Elementor.
			HavocWP_Elementor::get_nav_content();

		} elseif ( HAVOCWP_BEAVER_BUILDER_ACTIVE && ! empty( $template ) ) {

			// If Beaver Builder.
			echo do_shortcode( '[fl_builder_insert_layout id="' . $template . '"]' );

		}  else if ( class_exists( 'SiteOrigin_Panels' ) && get_post_meta( $template, 'panels_data', true ) ) {

			echo SiteOrigin_Panels::renderer()->render( $template );

		} else {

			// If Gutenberg.
			if ( havoc_is_block_template( $template ) ) {
				$get_content = apply_filters( 'havocwp_nav_template_content', do_blocks( $get_content ) );
			}

			// Display template content.
			echo do_shortcode( $get_content );

		}
		?>

		<?php do_action( 'havoc_after_nav_inner' ); ?>

	<?php
	// If is not full screen header style.
	if ( 'full_screen' !== $header_style ) {
		?>
		</div><!-- #site-navigation-wrap -->
		<?php
	}
	?>

	<?php do_action( 'havoc_after_nav' ); ?>

	<?php

} else {

	// Menu Location.
	$menu_location = apply_filters( 'havoc_main_menu_location', 'main_menu' );

	// Multisite global menu.
	$ms_global_menu = apply_filters( 'havoc_ms_global_menu', false );

	// Display menu if defined.
	if ( has_nav_menu( $menu_location ) || $ms_global_menu ) :

		// Get menu classes.
		$menu_classes = array( 'main-menu' );

		// If full screen header style.
		if ( 'full_screen' === $header_style ) {
			$menu_classes[] = 'fs-dropdown-menu';
		} else {
			$menu_classes[] = 'dropdown-menu';
		}

		// If is not full screen or vertical header style.
		if ( 'full_screen' !== $header_style
			&& 'vertical' !== $header_style ) {
			$menu_classes[] = 'sf-menu';
		}

		// Turn menu classes into space seperated string.
		$menu_classes = implode( ' ', $menu_classes );

		// Menu arguments.
		$menu_args = array(
			'theme_location' => $menu_location,
			'menu_class'     => $menu_classes,
			'container'      => false,
			'fallback_cb'    => false,
			'link_before'    => '<span class="text-wrap">',
			'link_after'     => '</span>',
			'walker'         => new HavocWP_Custom_Nav_Walker(),
		);

		// Check if custom menu.
		if ( $menu = havocwp_header_custom_menu() ) {
			$menu_args['menu'] = $menu;
		}

		do_action( 'havoc_before_nav' );

		// If is not full screen header style.
		if ( 'full_screen' !== $header_style ) {
			?>
			<div id="site-navigation-wrap" class="<?php echo esc_attr( $wrap_classes ); ?>">
			<?php
		}
		?>

			<?php do_action( 'havoc_before_nav_inner' ); ?>

			<?php
			// Add container if is medium header style.
			if ( 'medium' === $header_style ) {
				?>
				<div class="container clr">
				<?php
			}
			?>

			<nav id="site-navigation" class="<?php echo esc_attr( $inner_classes ); ?>"<?php havocwp_schema_markup( 'site_navigation' ); ?> role="navigation" <?php echo $hvc_nav_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

				<?php
				// Display global multisite menu.
				if ( is_multisite() && $ms_global_menu ) :

					switch_to_blog( 1 );
					wp_nav_menu( $menu_args );
					restore_current_blog();

				else :

					// Display this site's menu.
					wp_nav_menu( $menu_args );

				endif;

				// If is not top menu header style.
				if ( 'top' !== $header_style
					&& 'full_screen' !== $header_style
					&& 'vertical' !== $header_style ) {

					// Header search.
					if ( 'drop_down' === havocwp_menu_search_style() ) {
						get_template_part( 'partials/header/search-dropdown' );
					} elseif ( 'header_replace' === havocwp_menu_search_style() ) {
						get_template_part( 'partials/header/search-replace' );
					}
				}

				// Social links if full screen header style.
				if ( 'full_screen' === $header_style
					&& true === get_theme_mod( 'havoc_menu_social', false ) ) {
					get_template_part( 'partials/header/social' );
				}
				?>

			</nav><!-- #site-navigation -->

			<?php
			// Add container if is medium header style.
			if ( 'medium' === $header_style ) {
				?>
				</div>
				<?php
			}
			?>

			<?php do_action( 'havoc_after_nav_inner' ); ?>

		<?php
		// If is not full screen header style.
		if ( 'full_screen' !== $header_style ) {
			?>
			</div><!-- #site-navigation-wrap -->
			<?php
		}
		?>

		<?php do_action( 'havoc_after_nav' ); ?>

	<?php endif;

}
?>
