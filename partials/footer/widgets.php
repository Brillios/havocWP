<?php
/**
 * Footer widgets
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get ID.
$get_id = havocwp_custom_footer_template();

// Check if page is Elementor page.
$elementor = get_post_meta( $get_id, '_elementor_edit_mode', true );

// Get content.
$get_content = havocwp_footer_template_content();

// Get footer widgets columns.
$columns    = apply_filters( 'havoc_footer_widgets_columns', get_theme_mod( 'havoc_footer_widgets_columns', '4' ) );
$grid_class = havocwp_grid_class( $columns );

// Responsive columns.
$tablet_columns = get_theme_mod( 'havoc_footer_widgets_tablet_columns' );
$mobile_columns = get_theme_mod( 'havoc_footer_widgets_mobile_columns' );

// Visibility.
$visibility = get_theme_mod( 'havoc_footer_widgets_visibility', 'all-devices' );

// Classes.
$wrap_classes = array( 'havocwp-row', 'clr' );

if ( ! empty( $tablet_columns ) ) {
	$wrap_classes[] = 'tablet-' . $tablet_columns . '-col';
}

if ( ! empty( $mobile_columns ) ) {
	$wrap_classes[] = 'mobile-' . $mobile_columns . '-col';
}

if ( 'all-devices' !== $visibility ) {
	$wrap_classes[] = $visibility;
}

$wrap_classes = implode( ' ', $wrap_classes );

// Get inner classes.
$inner_classes = array( 'footer-widgets-inner' );

// Add container class.
if ( true === get_theme_mod( 'havoc_add_footer_container', true ) ) {
	$inner_classes[] = 'container';
}

// Turn inner classes into space seperated string.
$inner_classes = implode( ' ', $inner_classes );

?>

<?php do_action( 'havoc_before_footer_widgets' ); ?>

<div id="footer-widgets" class="<?php echo esc_attr( $wrap_classes ); ?>">

	<?php do_action( 'havoc_before_footer_widgets_inner' ); ?>

	<div class="<?php echo esc_attr( $inner_classes ); ?>">

		<?php
		// Check if there is a template for the footer.
		if ( ! empty( $get_id ) ) {

			if ( HAVOCWP_ELEMENTOR_ACTIVE && $elementor ) {

				// If Elementor.
				HavocWP_Elementor::get_footer_content();

			} elseif ( HAVOCWP_BEAVER_BUILDER_ACTIVE && ! empty( $get_id ) ) {

				// If Beaver Builder.
				echo do_shortcode( '[fl_builder_insert_layout id="' . $get_id . '"]' );

			} else if ( class_exists( 'SiteOrigin_Panels' ) && get_post_meta( $get_id, 'panels_data', true ) ) {

				echo SiteOrigin_Panels::renderer()->render( $get_id );

			} else {

				// If Gutenberg.
				if ( havoc_is_block_template( $get_id ) ) {
					$get_content = apply_filters( 'havoc_footer_template_content', do_blocks( $get_content ) );
				}

				// Display template content.
				echo do_shortcode( $get_content );

			}

			// Display widgets.
		} else {

			// Footer box 1.
			?>
			<div class="footer-box <?php echo esc_attr( $grid_class ); ?> col col-1">
				<?php dynamic_sidebar( 'footer-one' ); ?>
			</div><!-- .footer-one-box -->

			<?php
			// Footer box 2.
			if ( $columns > '1' ) :
				?>
				<div class="footer-box <?php echo esc_attr( $grid_class ); ?> col col-2">
					<?php dynamic_sidebar( 'footer-two' ); ?>
				</div><!-- .footer-one-box -->
				<?php
			endif;
			?>

			<?php
			// Footer box 3.
			if ( $columns > '2' ) :
				?>
				<div class="footer-box <?php echo esc_attr( $grid_class ); ?> col col-3 ">
					<?php dynamic_sidebar( 'footer-three' ); ?>
				</div><!-- .footer-one-box -->
				<?php
			endif;
			?>

			<?php
			// Footer box 4.
			if ( $columns > '3' ) :
				?>
				<div class="footer-box <?php echo esc_attr( $grid_class ); ?> col col-4">
					<?php dynamic_sidebar( 'footer-four' ); ?>
				</div><!-- .footer-box -->
				<?php
			endif;
			?>

			<?php
		}
		?>

	</div><!-- .container -->

	<?php do_action( 'havoc_after_footer_widgets_inner' ); ?>

</div><!-- #footer-widgets -->

<?php do_action( 'havoc_after_footer_widgets' ); ?>
