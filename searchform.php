<?php
/**
 * The template for displaying search forms.
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Post type.
$search_post_type = get_theme_mod( 'havoc_menu_search_source', 'any' );

// Generate unique form ID.
$havoc_sf_id = havocwp_unique_id( 'havoc-search-form-' );

?>

<form aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-search-form-label', false ) ); ?>" role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">	
	<input aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-search-field', false ) ); ?>" type="search" id="<?php echo esc_attr( $havoc_sf_id ); ?>" class="field" autocomplete="off" placeholder="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-search-text', false ) ); ?>" name="s">
	<?php if ( 'any' !== $search_post_type ) { ?>
		<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
	<?php } ?>
	<?php do_action( 'wpml_add_language_form_field' ); ?>
</form>
