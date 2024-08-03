<?php
/**
 * Mobile search template.
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Post type.
$search_post_type = get_theme_mod( 'havoc_menu_search_source', 'any' );

// Assign mobile search form unique ID.
$havoc_msf_id = havocwp_unique_id( 'havoc-mobile-search-' );
?>

<div id="mobile-menu-search" class="clr">
	<form aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-search-form-label', false ) ); ?>" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-searchform">
		<input aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-search-field', false ) ); ?>" value="" class="field" id="<?php echo esc_attr( $havoc_msf_id ); ?>" type="search" name="s" autocomplete="off" placeholder="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-mobile-search-text', false ) ); ?>" />
		<button aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-mobile-submit-search', false ) ); ?>" type="submit" class="searchform-submit">
			<?php havocwp_icon( 'search' ); ?>
		</button>
		<?php if ( 'any' !== $search_post_type ) { ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
		<?php } ?>
		<?php do_action( 'wpml_add_language_form_field' ); ?>
	</form>
</div><!-- .mobile-menu-search -->
