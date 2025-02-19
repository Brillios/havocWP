<?php
/**
 * Full screen mobile style template part.
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'fullscreen' !== havocwp_mobile_menu_style()
	|| ! havocwp_display_navigation() ) {
	return;
}

// Navigation classes.
$classes = array( 'clr' );

// If social.
if ( true === get_theme_mod( 'havoc_menu_social', false ) ) {
	$classes[] = 'has-social';
}

// Turn classes into space seperated string.
$classes = implode( ' ', $classes );

// Fullscreen menu attributes.
$fullscreen_menu_attrs = apply_filters( 'havocwp_attrs_mobile_fullscreen', '' );
$fs_menu_close_attrs   = apply_filters( 'havocwp_attrs_mobile_fullscreen_close', '' );

// Menu Location.
$menu_location = apply_filters( 'havoc_main_menu_location', 'main_menu' );

// Menu arguments.
$menu_args = array(
	'theme_location' => $menu_location,
	'menu_class'     => 'fs-dropdown-menu',
	'container'      => false,
	'fallback_cb'    => false,
);

// Check if custom menu.
if ( $menu = havocwp_header_custom_menu() ) {
	$menu_args['menu'] = $menu;
}

// Left menu for the Center header style.
$left_menu = get_theme_mod( 'havoc_center_header_left_menu' );
$left_menu = '0' !== $left_menu ? $left_menu : '';
$left_menu = apply_filters( 'havoc_center_header_left_menu', $left_menu );

// Menu arguments.
$left_menu_args = array(
	'menu'        => $left_menu,
	'container'   => false,
	'fallback_cb' => false,
);

// Top bar menu Location.
$top_menu_location = 'topbar_menu';

// Menu arguments.
$top_menu_args = array(
	'theme_location' => $top_menu_location,
	'menu_class'     => 'fs-dropdown-menu',
	'container'      => false,
	'fallback_cb'    => false,
);

// SEO link txt.
$anchorlink_text = esc_html( havocwp_theme_strings( 'hvc-string-mobile-fullscreen-anchor', false ) );

?>

<div id="mobile-fullscreen" class="clr" <?php echo $fullscreen_menu_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

	<div id="mobile-fullscreen-inner" class="clr">

		<a href="<?php echo esc_url( havoc_get_site_name_anchors( $anchorlink_text ) ); ?>" class="close" aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-close-mobile-menu', false ) ); ?>" <?php echo $fs_menu_close_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<div class="close-icon-wrap">
				<div class="close-icon-inner"></div>
			</div>
		</a>

		<nav class="<?php echo esc_attr( $classes ); ?>"<?php havocwp_schema_markup( 'site_navigation' ); ?> role="navigation">

			<?php
			// If has mobile menu.
			if ( has_nav_menu( 'mobile_menu' ) ) {
				get_template_part( 'partials/mobile/mobile-nav' );
			} else {

				// If has center header style and left menu.
				if ( 'center' === havocwp_header_style()
					&& $left_menu ) {
					wp_nav_menu( $left_menu_args );
				}

				// Navigation.
				wp_nav_menu( $menu_args );

				// If has top bar menu.
				if ( has_nav_menu( $top_menu_location ) ) {
					wp_nav_menu( $top_menu_args );
				}
			}

			// Mobile search form.
			if ( get_theme_mod( 'havoc_mobile_menu_search', true ) ) {
				get_template_part( 'partials/mobile/mobile-fullscreen-search' );
			}

			// Social.
			if ( true === get_theme_mod( 'havoc_menu_social', false ) ) {
				get_template_part( 'partials/header/social' );
			}
			?>

		</nav>

	</div>

</div>
