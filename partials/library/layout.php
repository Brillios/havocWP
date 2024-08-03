<?php
/**
 * Outputs correct library layout
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article class="single-library-article clr">

	<div class="entry clr"<?php havocwp_schema_markup( 'entry_content' ); ?>>
		<?php the_content(); ?>
	</div>

</article>
