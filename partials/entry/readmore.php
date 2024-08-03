<?php
/**
 * Displays post entry read more
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define read more icon.
$icon = '';
$icon = is_rtl() ? havocwp_icon( 'angle_left', false ) : havocwp_icon( 'angle_right', false );

$post_link   = havoc_link_post_url( get_the_ID() );
$link_target = havoc_link_post_url_target( get_the_ID() );

$blog_continue_reading_content = '';

ob_start();

?>

<a href="<?php echo esc_url( $post_link ); ?>" 
	<?php if ( $link_target ) { ?>
		target="<?php echo esc_attr( $link_target ); ?>" 
	<?php } ?>>
	<?php echo esc_html( havocwp_theme_strings( 'hvc-string-post-continue-reading', false ) ); ?><span class="screen-reader-text"><?php the_title(); ?></span><?php echo wp_kses_post( $icon ); ?>
</a>

<?php $blog_continue_reading_content .= ob_get_clean(); ?>

<?php do_action( 'havoc_before_blog_entry_readmore' ); ?>

<div class="blog-entry-readmore clr">
	<?php echo $blog_continue_reading_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped during generation. ?>
</div><!-- .blog-entry-readmore -->

<?php do_action( 'havoc_after_blog_entry_readmore' ); ?>
