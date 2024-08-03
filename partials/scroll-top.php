<?php
/**
 * The template for displaying the scroll top button.
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If no scroll top button.
if ( ! havocwp_display_scroll_up_button() ) {
	return;
}

// Get arrow.

$arrow = apply_filters( 'havoc_scroll_top_arrow', get_theme_mod( 'havoc_scroll_top_arrow', 'angle_up' ) );
$arrow = in_array( $arrow, havocwp_get_scrolltotop_icons(), true ) && $arrow ? $arrow : 'angle_up';

// Position.
$position = apply_filters( 'havoc_scroll_top_position', get_theme_mod( 'havoc_scroll_top_position' ) );
$position = $position ? $position : 'right'; ?>

<a aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-scroll-top', false ) ); ?>" href="#" id="scroll-top" class="scroll-top-<?php echo esc_attr( $position ); ?>"><?php havocwp_icon( $arrow ); ?></a>
