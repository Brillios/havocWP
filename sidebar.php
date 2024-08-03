<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package HavocWP WordPress theme
 */

// Retunr if full width or full screen.
if ( in_array( havocwp_post_layout(), array( 'full-screen', 'full-width' ), true ) ) {
	return;
} ?>

<?php do_action( 'havoc_before_sidebar' ); ?>

<aside id="right-sidebar" class="sidebar-container widget-area sidebar-primary"<?php havocwp_schema_markup( 'sidebar' ); ?> role="complementary" aria-label="<?php esc_attr_e( 'Primary Sidebar', 'havocwp' ); ?>">

	<?php do_action( 'havoc_before_sidebar_inner' ); ?>

	<div id="right-sidebar-inner" class="clr">

		<?php
		$sidebar = havocwp_get_sidebar();
		if ( $sidebar ) {
			dynamic_sidebar( $sidebar );
		}
		?>

	</div><!-- #sidebar-inner -->

	<?php do_action( 'havoc_after_sidebar_inner' ); ?>

</aside><!-- #right-sidebar -->

<?php do_action( 'havoc_after_sidebar' ); ?>
