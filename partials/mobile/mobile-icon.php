<?php
/**
 * Mobile Menu icon
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled.
if ( ! havocwp_display_navigation() ) {
	return;
}

// Menu Location.
$menu_location = apply_filters( 'havoc_main_menu_location', 'main_menu' );

// Multisite global menu.
$ms_global_menu = apply_filters( 'havoc_ms_global_menu', false );

// Menu data attributes.
$toggle_menu_attrs = apply_filters( 'havocwp_menu_toggle_data_attrs', '' );

// Display if menu is defined.
if ( has_nav_menu( $menu_location ) || $ms_global_menu ) :

	// Get menu icon.
	$icon = get_theme_mod( 'havoc_mobile_menu_open_icon', 'fa fa-bars' );
	$icon = apply_filters( 'havoc_mobile_menu_navbar_open_icon', $icon );

	// Custom hamburger button.
	$btn = get_theme_mod( 'havoc_mobile_menu_open_hamburger', 'default' );

	// Get menu text.
	$text = get_theme_mod( 'havoc_mobile_menu_text' );
	$text = havocwp_tm_translation( 'havoc_mobile_menu_text', $text );
	$text = $text ? $text : esc_html__( 'Menu', 'havocwp' );

	// Get close menu text.
	$close_text = get_theme_mod( 'havoc_mobile_menu_close_text' );
	$close_text = havocwp_tm_translation( 'havoc_mobile_menu_close_text', $close_text );
	$close_text = $close_text ? $close_text : esc_html__( 'Close', 'havocwp' );

	// SEO link txt.
	$anchorlink_text = esc_html( havocwp_theme_strings( 'hvc-string-mobile-icon-anchor', false ) );

	if ( HAVOCWP_WOOCOMMERCE_ACTIVE ) {

		// Get cart icon.
		$woo_icon = get_theme_mod( 'havoc_woo_menu_icon', 'icon_handbag' );
		$woo_icon = in_array( $woo_icon, havocwp_get_cart_icons(), true ) && $woo_icon ? $woo_icon : 'icon_handbag';

		// If has custom cart icon.
		$custom_icon = get_theme_mod( 'havoc_woo_menu_custom_icon' );
		if ( '' !== $custom_icon ) {
			$woo_icon = $custom_icon;
		}

		if ( '' !== $custom_icon ) {
			$cart_icon = '<i class="' . esc_attr( $woo_icon ) . '" aria-hidden="true"></i>';
		} else {
			$cart_icon = havocwp_icon( $woo_icon, false );
		}

		// Cart Icon.
		$cart_icon = apply_filters( 'havoc_menu_cart_icon_html', $cart_icon );

	}

	// Classes.
	$classes = array( 'havocwp-mobile-menu-icon', 'clr' );

	// Position.
	if ( 'three' === get_theme_mod( 'havoc_mobile_elements_positioning', 'one' ) ) {
		$classes[] = 'mobile-left';
	} else {
		$classes[] = 'mobile-right';
	}

	// Turn classes into space seperated string.
	$classes = implode( ' ', $classes ); ?>

	<?php do_action( 'havoc_mobile_menu_icon_before' ); ?>

	<div class="<?php echo esc_attr( $classes ); ?>">

		<?php do_action( 'havoc_before_mobile_icon' ); ?>

		<?php
		// If big header style.
		if ( 'big' === havocwp_header_style() ) {
			?>
			<div class="container clr">
			<?php
		}
		?>

		<?php do_action( 'havoc_before_mobile_icon_inner' ); ?>

		<a href="<?php echo esc_url( havoc_get_site_name_anchors( $anchorlink_text ) ); ?>" class="mobile-menu" <?php echo $toggle_menu_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> aria-label="<?php esc_attr_e( 'Mobile Menu', 'havocwp' ); ?>">
			<?php
			if ( 'default' !== $btn ) {
				?>
				<div class="hamburger hamburger--<?php echo esc_attr( $btn ); ?>" aria-expanded="false" role="navigation">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
				<?php
			} else {
				?>
				<i class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
				<?php
			}

			// Mobile menu text.
			if ( get_theme_mod( 'havoc_mobile_menu_display_opening_text', true ) ) {
				?>
				<span class="havocwp-text"><?php echo do_shortcode( $text ); ?></span>
				<span class="havocwp-close-text"><?php echo do_shortcode( $close_text ); ?></span>
				<?php
			}
			?>
		</a>

		<?php do_action( 'havoc_after_mobile_icon_inner' ); ?>

		<?php
		// If big header style.
		if ( 'big' === havocwp_header_style() ) {
			?>
			</div>
			<?php
		}
		?>

		<?php do_action( 'havoc_after_mobile_icon' ); ?>

	</div><!-- #havocwp-mobile-menu-navbar -->

	<?php do_action( 'havoc_mobile_menu_icon_after' ); ?>

<?php endif; ?>
