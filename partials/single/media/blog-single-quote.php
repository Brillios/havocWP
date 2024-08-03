<?php
/**
 * Blog single quote format
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if Havoc Extra is not active.
if ( ! HAVOC_EXTRA_ACTIVE ) {
	return;
}


?>

<div class="post-quote-wrap">

	<div class="post-quote-content">

		<?php echo wp_kses_post( get_post_meta( get_the_ID(), 'havoc_quote_format', true ) ); ?>

		<span class="post-quote-icon"><?php havocwp_icon( 'quote' ); ?></span>

	</div>

	<div class="post-quote-author"><?php the_title(); ?></div>

</div>
