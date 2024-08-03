<?php
/**
 * After Container template.
 *
 * @package HavocWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} ?>

			</article><!-- #post -->

			<?php do_action( 'havoc_after_content_inner' ); ?>

		</div><!-- #content -->

		<?php do_action( 'havoc_after_content' ); ?>

	</div><!-- #primary -->

	<?php do_action( 'havoc_after_primary' ); ?>

</div><!-- #content-wrap -->

<?php do_action( 'havoc_after_content_wrap' ); ?>
