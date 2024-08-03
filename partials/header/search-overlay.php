<?php
/**
 * Site header search overlay
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Post type.
$search_post_type = get_theme_mod( 'havoc_menu_search_source', 'any' );

// Search attributes.
$item_search_overlay_attrs = apply_filters( 'havocwp_attrs_overlay_search_bar', '' );

// SEO link txt.
$anchorlink_text = esc_html( havocwp_theme_strings( 'hvc-string-hs-overlay-close-anchor', false ) );

?>

<div id="searchform-overlay" class="header-searchform-wrap clr" <?php echo $item_search_overlay_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container clr">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-searchform">
			<a href="<?php echo esc_url( havoc_get_site_name_anchors( $anchorlink_text ) ); ?>" class="search-overlay-close" aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-close-search-form', false ) ); ?>"><span></span></a>
			<span class="screen-reader-text"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-search-form-label', false ) ); ?></span>
			<input aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-search-field', false ) ); ?>" class="searchform-overlay-input" type="search" name="s" autocomplete="off" value="" />
			<span class="search-text"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-search-overlay-search-text', false ) ); ?><span aria-hidden="true"><i></i><i></i><i></i></span></span>
			<?php if ( 'any' !== $search_post_type ) { ?>
				<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
			<?php } ?>
			<?php do_action( 'wpml_add_language_form_field' ); ?>
		</form>
	</div>
</div><!-- #searchform-overlay -->
