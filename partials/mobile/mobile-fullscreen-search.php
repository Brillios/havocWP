<?php
/**
 * Search for the full screen mobile style.
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'fullscreen' !== havocwp_mobile_menu_style() ) {
	return;
}

// Post type.
$search_post_type = get_theme_mod( 'havoc_menu_search_source', 'any' ); ?>

<div id="mobile-search" class="clr">
	<form id="mfs-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-searchform" aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-search-form-label', false ) ); ?>">
		<span class="search-text"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-mobile-fs-search-text', false ) ); ?><span><i></i><i></i><i></i></span></span>
		<input id="mfs-input" aria-labelledby="mfs-search mfs-input" type="search" name="s" value="" autocomplete="off" />
		<?php if ( 'any' !== $search_post_type ) { ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
		<?php } ?>
	</form>
</div>
