<?php
/**
 * The template for displaying 404 pages.
 *
 * @package HavocWP WordPress theme
 */

// Get ID.
$get_id = get_theme_mod( 'havoc_error_page_template' );

// Check if page is Elementor page.
$elementor = get_post_meta( $get_id, '_elementor_edit_mode', true );

// Get content.
$get_content = havocwp_error_page_template_content();

// If blank page.
if ( 'on' === get_theme_mod( 'havoc_error_page_blank', 'off' ) ) { ?>

	<!DOCTYPE html>
	<html class="<?php echo esc_attr( havocwp_html_classes() ); ?>" <?php language_attributes(); ?>>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<link rel="profile" href="https://gmpg.org/xfn/11">

			<?php wp_head(); ?>
		</head>

		<!-- Begin Body -->
		<body <?php body_class(); ?><?php havocwp_schema_markup( 'html' ); ?>>

			<?php wp_body_open(); ?>

			<?php do_action( 'havoc_before_outer_wrap' ); ?>

			<div id="outer-wrap" class="site clr">

				<a class="skip-link screen-reader-text" href="#main"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-header-skip-link', false ) ); ?></a>

				<?php do_action( 'havoc_before_wrap' ); ?>

				<div id="wrap" class="clr">

					<?php do_action( 'havoc_before_main' ); ?>

					<main id="main" class="site-main clr"<?php havocwp_schema_markup( 'main' ); ?> role="main">

	<?php
} else {

	get_header();

}
?>

						<?php do_action( 'havoc_before_content_wrap' ); ?>

						<div id="content-wrap" class="container clr">

							<?php do_action( 'havoc_before_primary' ); ?>

							<div id="primary" class="content-area clr">

								<?php do_action( 'havoc_before_content' ); ?>

								<div id="content" class="clr site-content">

									<?php do_action( 'havoc_before_content_inner' ); ?>

									<article class="entry clr">

										<?php
										// Elementor `404` location.
										if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

											// Check if there is a template.
											if ( ! empty( $get_id ) ) {

												// If Elementor.
												if ( HAVOCWP_ELEMENTOR_ACTIVE && $elementor ) {

													HavocWP_Elementor::get_error_page_content();

												} elseif ( HAVOCWP_BEAVER_BUILDER_ACTIVE && ! empty( $get_id ) ) {

													echo do_shortcode( '[fl_builder_insert_layout id="' . $get_id . '"]' );

												} else if ( class_exists( 'SiteOrigin_Panels' ) && get_post_meta( $get_id, 'panels_data', true ) ) {

													echo SiteOrigin_Panels::renderer()->render( $get_id );

												} else {

													// If Gutenberg.
													if ( havoc_is_block_template( $get_id ) ) {
														$get_content = apply_filters( 'havoc_error_page_template_content', do_blocks( $get_content ) );
													}

													// Display template content.
													echo do_shortcode( $get_content );

												}
											} else {
												?>

												<div class="error404-content clr">
													<?php
													$logo_404 = get_theme_mod( 'havoc_404_logo' );
													if ( ! empty( $logo_404 ) ) {
														?>

														<img src="<?php echo esc_url( $logo_404 ); ?>" alt="<?php esc_attr_e( '404 Logo', 'havocwp' ); ?>" title="<?php esc_attr_e( '404 Logo', 'havocwp' ); ?>" />
													<?php } ?>

													<h2 class="error-title"><?php esc_html_e( 'This page could not be found!', 'havocwp' ); ?></h2>
													<p class="error-text"><?php esc_html_e( 'We are sorry. But the page you are looking for is not available.', 'havocwp' ); ?><br /><?php esc_html_e( 'Perhaps you can try a new search.', 'havocwp' ); ?></p>
													<?php get_search_form(); ?>
													<a class="error-btn button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back To Homepage', 'havocwp' ); ?></a>

												</div><!-- .error404-content -->

												<?php
											}
										}
										?>

									</article><!-- .entry -->

									<?php do_action( 'havoc_after_content_inner' ); ?>

								</div><!-- #content -->

								<?php do_action( 'havoc_after_content' ); ?>

							</div><!-- #primary -->

							<?php do_action( 'havoc_after_primary' ); ?>

						</div><!-- #content-wrap -->

						<?php do_action( 'havoc_after_content_wrap' ); ?>

<?php
// If blank page.
if ( 'on' === get_theme_mod( 'havoc_error_page_blank', 'off' ) ) {
	?>

					</main><!-- #main-content -->

					<?php do_action( 'havoc_after_main' ); ?>

				</div><!-- #wrap -->

				<?php do_action( 'havoc_after_wrap' ); ?>

			</div><!-- .outer-wrap -->

			<?php do_action( 'havoc_after_outer_wrap' ); ?>

			<?php wp_footer(); ?>

		</body>
	</html>

	<?php
} else {

	get_footer();

}
?>
