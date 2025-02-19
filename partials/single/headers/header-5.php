<?php
/**
 * HavocWP Single Post Header template
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Only display for standard posts.
if ( 'post' !== get_post_type() ) {
	return;
}

// Heading tag.
$heading = 'h1';
$heading = apply_filters( 'single_havoc_header_5_h_tag', $heading );

// Display meta filter.
$display_sph_meta = true;
$display_sph_meta = apply_filters( 'display_single_havoc_header_5_meta', $display_sph_meta );

?>

<div class="havoc-single-post-header single-post-header-wrap single-header-havoc-5">
	<div class="sh-container head-row row-center">
		<div class="col-xs-12 col-l-8">

			<?php do_action( 'havoc_before_page_header' ); ?>

			<header class="blog-post-title">

				<?php the_title( '<' . esc_attr( $heading ) . ' class="single-post-title">', '</' . esc_attr( $heading ) . '>' ); ?>

				<?php if ( true === $display_sph_meta ) { ?>

					<?php do_action( 'havoc_single_post_header_meta' ); ?>

				<?php } ?>

				<div class="blog-post-author">

					<div class="blog-post-author-content">
						<?php
						wp_kses_post(
							havoc_get_post_author(
								array(
									'prefix' => '',
									'before' => '<span class="post-author-name">',
									'after'  => '</span>',
								)
							)
						);
						?>
					</div>

					<?php
					wp_kses_post(
						havoc_get_post_author_avatar(
							array(
								'before' => '<div class="post-author-avatar">',
								'after'  => '</div>',
							)
						)
					);
					?>

				</div><!-- .blog-post-author -->

			</header><!-- .blog-post-title -->

			<?php do_action( 'havoc_after_page_header' ); ?>

		</div>
	</div>
</div>
