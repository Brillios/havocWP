<?php
/**
 * Full Screen Header Style
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get classes.
$classes = array( 'clr' );

// Add container class.
if ( true !== get_theme_mod( 'havoc_header_full_width', false ) ) {
	$classes[] = 'container';
}

// Turn classes into space seperated string.
$classes = implode( ' ', $classes );

// SEO link txt.
$anchorlink_text = esc_html( havocwp_theme_strings( 'hvc-string-fullscreen-header-anchor', false ) );

?>

<?php do_action( 'havoc_before_header_inner' ); ?>

<div id="site-header-inner" class="<?php echo esc_attr( $classes ); ?>">

	<?php do_action( 'havoc_header_inner_left_content' ); ?>

	<?php get_template_part( 'partials/header/logo' ); ?>

	<div id="site-navigation-wrap" class="clr">

		<div class="menu-bar-wrap clr">
			<div class="menu-bar-inner clr">
				<a href="<?php echo esc_url( havoc_get_site_name_anchors( $anchorlink_text ) ); ?>" class="menu-bar"><span class="ham"></span><span class="screen-reader-text"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-open-menu', false ) ); ?></span></a>
			</div>
		</div>

		<div id="full-screen-menu" class="clr">
			<div id="full-screen-menu-inner" class="clr">
				<?php get_template_part( 'partials/header/nav' ); ?>
			</div>
		</div>

	</div><!-- #site-header-wrap -->

	<?php do_action( 'havoc_header_inner_right_content' ); ?>

</div><!-- #site-header-inner -->

<?php get_template_part( 'partials/mobile/mobile-dropdown' ); ?>

<?php do_action( 'havoc_after_header_inner' ); ?>
