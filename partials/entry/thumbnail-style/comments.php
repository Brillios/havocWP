<?php
/**
 * The default template for displaying post meta.
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'post' === get_post_type() ) {
	?>

	<div class="blog-entry-comments clr">
		<?php havocwp_icon( 'comment' ); ?><?php comments_popup_link( esc_html__( '0 Comments', 'havocwp' ), esc_html__( '1 Comment', 'havocwp' ), esc_html__( '% Comments', 'havocwp' ), 'comments-link' ); ?>
	</div>

	<?php
}
?>
