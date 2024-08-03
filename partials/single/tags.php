<?php
/**
 * Blog single tags
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display tags.

if ( ! has_tag() ) {
	return;
}

?>

<div class="post-tags clr">
	<?php the_tags( '<span class="hvc-tag-text">' . esc_attr__( 'Tags: ', 'havocwp' ) . '</span>', '<span class="hvc-sep">,</span> ', '' ); ?>
</div>
