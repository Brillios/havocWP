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

// Display meta filter.
$display_sph_meta = true;
$display_sph_meta = apply_filters( 'display_single_havoc_header_2_meta', $display_sph_meta );

// Display breadcrumbs filter.
$display_breadcrumbs = true;
$display_breadcrumbs = apply_filters( 'display_single_havoc_header_2_breadcrumbs', $display_breadcrumbs );

// Heading tag.
$heading = 'h1';
$heading = apply_filters( 'single_havoc_header_2_h_tag', $heading );

?>

<div class="havoc-single-post-header single-post-header-wrap single-header-havoc-2 sh-container">
	<div class="head-row row-center">
		<div class="col-xs-12 col-l-8 col-ml-9">

			<?php do_action( 'havoc_before_page_header' ); ?>

			<header class="blog-post-title">

				<?php the_title( '<' . esc_attr( $heading ) . ' class="single-post-title">', '</' . esc_attr( $heading ) . '>' ); ?>

				<?php if ( true === $display_sph_meta ) { ?>

					<div class="blog-post-meta">
						<?php do_action( 'havoc_single_post_header_meta' ); ?>
					</div><!-- .blog-post-meta -->

				<?php } ?>

				<?php if ( true === $display_breadcrumbs ) { ?>
					<?php if ( function_exists( 'havocwp_breadcrumb_trail' ) ) { ?>
						<div class="blog-post-breadcrumbs">
							<?php do_action( 'havoc_breadcrumbs_main' ); ?>
						</div>
					<?php } ?>
				<?php } ?>

			</header><!-- .blog-post-title -->

			<?php do_action( 'havoc_after_page_header' ); ?>

		</div>
	</div>
</div>

<?php havocwp_paint_post_thumbnail( 'full', array( 'name' => 'havoc-sh-2' ) ); ?>
