<?php
/**
 * The Header
 *
 * @package HavocWP WordPress theme
 */

?>
<!DOCTYPE html>
<html class="<?php echo esc_attr( havocwp_html_classes() ); ?>" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php havocwp_schema_markup( 'html' ); ?>>

	<?php wp_body_open(); ?>

	<?php do_action( 'havoc_before_outer_wrap' ); ?>

	<div id="outer-wrap" class="site clr">

		<a class="skip-link screen-reader-text" href="#main"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-header-skip-link', false ) ); ?></a>

		<?php do_action( 'havoc_before_wrap' ); ?>

		<div id="wrap" class="clr">

			<?php do_action( 'havoc_top_bar' ); ?>

			<?php do_action( 'havoc_header' ); ?>

			<?php do_action( 'havoc_before_main' ); ?>

			<main id="main" class="site-main clr"<?php havocwp_schema_markup( 'main' ); ?> role="main">

				<?php do_action( 'havoc_page_header' ); ?>
