<?php
/**
 * Displays the post entry header
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Heading tag.
$heading = get_theme_mod( 'havoc_blog_entries_heading_tag', 'h2' );
$heading = $heading ? $heading : 'h2';
$heading = apply_filters( 'havoc_blog_entries_heading', $heading );

$post_link  = havoc_link_post_url( get_the_ID() );
$link_target = havoc_link_post_url_target( get_the_ID() );

?>

<?php do_action( 'havoc_before_blog_entry_title' ); ?>

<header class="blog-entry-header clr">
	<<?php echo esc_attr( $heading ); ?> class="blog-entry-title entry-title">
		<a href="<?php echo esc_url( $post_link ); ?>" <?php if ( $link_target ) { ?> target="<?php echo esc_attr( $link_target ); ?>" <?php } ?> rel="bookmark"><?php the_title(); ?></a>
	</<?php echo esc_attr( $heading ); ?>><!-- .blog-entry-title -->
</header><!-- .blog-entry-header -->

<?php do_action( 'havoc_after_blog_entry_title' ); ?>
