<?php
/**
 * Mobile Menu sidr close
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get icon.
$icon_html  = '';
$icon_type  = havocwp_theme_icon_class();
$theme_icon = havocwp_theme_icons();
$icon       = $theme_icon['close_x'][ $icon_type ];
$icon_class = get_theme_mod( 'havoc_mobile_menu_close_btn_icon', $icon );

if ( 'svg' === $icon_type ) {
	$icon_html = havocwp_icon( 'close_x', false );
} else {
	$icon_html = '<i class="icon ' . esc_attr( $icon_class ) . '" aria-hidden="true"></i>';
}

$icon = apply_filters( 'havoc_mobile_menu_close_btn_icon', $icon );

// Text.
$text = get_theme_mod( 'havoc_mobile_menu_close_btn_text' );
$text = havocwp_tm_translation( 'havoc_mobile_menu_close_btn_text', $text );
$text = $text ? $text : esc_html__( 'Close Menu', 'havocwp' );

// SEO link txt.
$anchorlink_text = esc_html( havocwp_theme_strings( 'hvc-string-sidr-close-anchor', false ) );

?>

<div id="sidr-close">
	<a href="<?php echo esc_url( havoc_get_site_name_anchors( $anchorlink_text ) ); ?>" class="toggle-sidr-close" aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-close-mobile-menu', false ) ); ?>">
		<?php echo wp_kses_post( $icon_html ); ?><span class="close-text"><?php echo do_shortcode( $text ); ?></span>
	</a>
</div>
