<?php
/**
 * Outputs page article
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="entry clr"<?php havocwp_schema_markup( 'entry_content' ); ?>>

	<?php do_action( 'havoc_before_page_entry' ); ?>

	<?php
	the_content();

	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'havocwp' ),
			'after'  => '</div>',
		)
	);
	?>

	<?php do_action( 'havoc_after_page_entry' ); ?>

</div>
