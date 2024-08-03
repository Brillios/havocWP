<?php
/**
 * Site header search dropdown HTML
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Search attributes.
$item_search_attrs = apply_filters( 'havocwp_attrs_search_bar', '' );

?>

<div id="searchform-dropdown" class="header-searchform-wrap clr" <?php echo $item_search_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php get_search_form(); ?>
</div><!-- #searchform-dropdown -->
