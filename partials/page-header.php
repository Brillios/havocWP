<?php
/**
 * The template for displaying the page header.
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if page header is disabled.
if ( ! havocwp_has_page_header() ) {
	return;
}

// Classes.
$classes = array( 'page-header' );

// Get header style.
$style = havocwp_page_header_style();

// Add classes for title style.
if ( $style ) {
	$classes[ $style . '-page-header' ] = $style . '-page-header';
}

// Visibility.
$visibility = get_theme_mod( 'havoc_page_header_visibility', 'all-devices' );
if ( 'all-devices' !== $visibility ) {
	$classes[] = $visibility;
}

// Turn into space seperated list.
$classes = implode( ' ', $classes );

// Heading tag.
$heading = get_theme_mod( 'havoc_page_header_heading_tag', 'h1' );
$heading = $heading ? $heading : 'h1';
$heading = apply_filters( 'havoc_page_header_heading', $heading );

?>

<?php do_action( 'havoc_before_page_header' ); ?>

<header class="<?php echo esc_attr( $classes ); ?>">

	<?php do_action( 'havoc_before_page_header_inner' ); ?>

	<div class="container clr page-header-inner">

		<?php
		// Return if page header is disabled.
		if ( havocwp_has_page_header_heading() ) {
			?>

			<<?php echo esc_attr( $heading ); ?> class="page-header-title clr"<?php havocwp_schema_markup( 'headline' ); ?>><?php echo wp_kses_post( havocwp_has_page_title() ); ?></<?php echo esc_attr( $heading ); ?>>

			<?php get_template_part( 'partials/page-header-subheading' ); ?>

		<?php } ?>

		<?php do_action( 'havoc_breadcrumbs_main' ); ?>

	</div><!-- .page-header-inner -->

	<?php havocwp_page_header_overlay(); ?>

	<?php do_action( 'havoc_after_page_header_inner' ); ?>

</header><!-- .page-header -->

<?php do_action( 'havoc_after_page_header' ); ?>
