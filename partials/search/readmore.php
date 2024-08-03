<?php
/**
 * Search result page entry read more
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="search-entry-readmore clr">
	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-search-continue-reading', false ) ); ?>"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-search-continue-reading', false ) ); ?></a>
	<span class="screen-reader-text"><?php the_title(); ?></span>
</div><!-- .search-entry-readmore -->
