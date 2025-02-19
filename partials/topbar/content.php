<?php
/**
 * Topbar content
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the template.
$template = get_theme_mod( 'havoc_top_bar_template' );

// Check if page is Elementor page.
$elementor = get_post_meta( $template, '_elementor_edit_mode', true );

// Get content.
$get_content = havocwp_topbar_template_content();

// Get topbar content.
$content = get_theme_mod( 'havoc_top_bar_content' );
$content = havocwp_tm_translation( 'havoc_top_bar_content', $content );

// Display topbar content.
if ( ! empty( $template )
	|| $content
	|| has_nav_menu( 'topbar_menu' )
	|| is_customize_preview() ) : ?>

	<div id="top-bar-content" class="<?php echo esc_attr( havocwp_topbar_content_classes() ); ?>">

		<?php
		// Get topbar menu.
		if ( has_nav_menu( 'topbar_menu' ) ) {
			get_template_part( 'partials/topbar/nav' );
		}
		?>

		<?php
		// If template.
		if ( ! empty( $template ) ) {
			?>

			<div id="topbar-template">

				<?php
				// If Elementor.
				if ( HAVOCWP_ELEMENTOR_ACTIVE && $elementor ) {

					HavocWP_Elementor::get_topbar_content();

					// If Beaver Builder.
				} elseif ( HAVOCWP_BEAVER_BUILDER_ACTIVE && ! empty( $template ) ) {

					echo do_shortcode( '[fl_builder_insert_layout id="' . $template . '"]' );

					// Else.
				} else if ( class_exists( 'SiteOrigin_Panels' ) && get_post_meta( $template, 'panels_data', true ) ) {

					echo SiteOrigin_Panels::renderer()->render( $template );

				} else {

					// If Gutenberg.
					if ( havoc_is_block_template( $template ) ) {
						$get_content = apply_filters( 'havocwp_topbar_template_content', do_blocks( $get_content ) );
					}

					// Display template content.
					echo do_shortcode( $get_content );

				}
				?>

			</div>

			<?php
		} else {
			?>

			<?php
			// Check if there is content for the topbar.
			if ( $content
				|| is_customize_preview() ) :
				?>

				<span class="topbar-content">

					<?php
					// Display top bar content.
					echo do_shortcode( $content );
					?>

				</span>

				<?php
			endif;

		}
		?>

	</div><!-- #top-bar-content -->

<?php endif; ?>
