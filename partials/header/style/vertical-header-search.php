<?php
/**
 * Search Form for The Vertical Header Style
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Post type.
$search_post_type = get_theme_mod( 'havoc_menu_search_source', 'any' );

?>

<div id="vertical-searchform" class="header-searchform-wrap clr">
	<form id="verh-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-searchform" aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-website-search-form', false ) ); ?>">
		<label for="verh-input"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-vertical-header-search-text', false ) ); ?></label>	
		<input aria-labelledby="verh-search verh-input" id="verh-input" type="search" name="s" autocomplete="off" value="" />
		<button class="search-submit"><?php havocwp_icon( 'search' ); ?><span class="screen-reader-text"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-mobile-submit-search', false ) ); ?></span></button>
		<div class="search-bg"></div>
		<?php if ( 'any' !== $search_post_type ) { ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
		<?php } ?>
		<?php do_action( 'wpml_add_language_form_field' ); ?>
	</form>
</div><!-- #vertical-searchform -->
