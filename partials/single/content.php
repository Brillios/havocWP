<?php
/**
 * Post single content
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php do_action( 'havoc_before_single_post_content' ); ?>

<div class="entry-content clr"<?php havocwp_schema_markup( 'entry_content' ); ?>>
	<?php
	the_content();

	wp_link_pages(
		array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'havocwp' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		)
	);
	?>

</div><!-- .entry -->

<?php do_action( 'havoc_after_single_post_content' ); ?>
