<?php
/**
 * Single related posts
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only display for standard posts.
if ( 'post' !== get_post_type() ) {
	return;
}

// Number of columns for entries.
$havocwp_columns = apply_filters( 'havoc_related_blog_posts_columns', absint( get_theme_mod( 'havoc_blog_related_columns', '3' ) ) );

// Term.
$term_tax = get_theme_mod( 'havoc_blog_related_taxonomy', 'category' );
$term_tax = $term_tax ? $term_tax : 'category';

// Create an array of current term ID's.
$terms     = wp_get_post_terms( get_the_ID(), $term_tax );
$terms_ids = array();
foreach ( $terms as $termkey ) {
	$terms_ids[] = $termkey->term_id;
}

// Query args.
$args = array(
	'posts_per_page' => apply_filters( 'havoc_related_blog_posts_count', absint( get_theme_mod( 'havoc_blog_related_count', '3' ) ) ), // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page.
	'orderby'        => 'rand',
	'post__not_in'   => array( get_the_ID() ),
	'no_found_rows'  => true,
	'tax_query'      => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote', 'post-format-link' ),
			'operator' => 'NOT IN',
		),
	),
);

// If category.
if ( 'category' === $term_tax ) {
	$args['category__in'] = $terms_ids;
}

// If tags.
if ( 'post_tag' === $term_tax ) {
	$args['tag__in'] = $terms_ids;
}

// Define image alt text usage status.
$srp_seo_set = get_theme_mod( 'havoc_enable_srp_fimage_alt', false );
$srp_seo_set = $srp_seo_set ? $srp_seo_set : false;

// Title tag.
$heading_tag = 'h3';
$heading_tag = apply_filters( 'havoc_single_related_post_title_tag', $heading_tag );

// Display date.
$srp_date = true;
$srp_date = apply_filters( 'havoc_related_posts_date', $srp_date );

// Args.
$args = apply_filters( 'havoc_blog_post_related_query_args', $args );

do_action( 'havoc_before_single_post_related_posts' );

// Related query arguments.
$havocwp_related_query = new WP_Query( $args );

// If the custom query returns post display related posts section.
if ( $havocwp_related_query->have_posts() ) :

	// Wrapper classes.
	$classes = 'clr';
	if ( 'full-screen' === havocwp_post_layout() ) {
		$classes .= ' container';
	} ?>

	<section id="related-posts" class="<?php echo esc_attr( $classes ); ?>">

		<<?php echo esc_attr( $heading_tag ); ?> class="theme-heading related-posts-title">
			<span class="text"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-single-related-posts', false ) ); ?></span>
		</<?php echo esc_attr( $heading_tag ); ?>>

		<div class="havocwp-row clr">

			<?php $havocwp_count = 0; ?>

			<?php
			foreach ( $havocwp_related_query->posts as $post ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited -- No override.
				setup_postdata( $post );
				?>

				<?php
				$havocwp_count++;

				// Disable embeds.
				$show_embeds = apply_filters( 'havoc_related_blog_posts_embeds', false );

				// Get post format.
				$format = get_post_format();

				// Add classes.
				$classes   = array( 'related-post', 'clr', 'col' );
				$classes[] = havocwp_grid_class( $havocwp_columns );
				$classes[] = 'col-' . $havocwp_count;
				?>

				<article <?php post_class( $classes ); ?>>

					<?php
					// Display post video.
					if ( $show_embeds && 'video' === $format && havocwp_get_post_video_html() === $video ) :
						?>

						<div class="related-post-video">
							<?php echo $video; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div><!-- .related-post-video -->

						<?php
						// Display post audio.
					elseif ( $show_embeds && 'audio' === $format && havocwp_get_post_audio_html() === $audio ) :
						?>

						<div class="related-post-video">
							<?php echo $audio; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div><!-- .related-post-audio -->

						<?php
						// Display post thumbnail.
					elseif ( has_post_thumbnail() ) :
						?>

						<figure class="related-post-media clr">

							<a href="<?php the_permalink(); ?>" class="related-thumb">

								<?php
								// Image width.
								$img_width  = apply_filters( 'havoc_related_blog_posts_img_width', absint( get_theme_mod( 'havoc_blog_related_img_width' ) ) );
								$img_height = apply_filters( 'havoc_related_blog_posts_img_height', absint( get_theme_mod( 'havoc_blog_related_img_height' ) ) );

								// Images attr.
								$img_id  = get_post_thumbnail_id( get_the_ID(), 'full' );
								$img_url = wp_get_attachment_image_src( $img_id, 'full', true );
								if ( HAVOC_EXTRA_ACTIVE
									&& function_exists( 'havoc_extra_image_attributes' ) ) {
									$img_atts = havoc_extra_image_attributes( $img_url[1], $img_url[2], $img_width, $img_height );
								}

								// If Havoc Extra is active and has a custom size.
								if ( HAVOC_EXTRA_ACTIVE
									&& function_exists( 'havoc_extra_resize' )
									&& ! empty( $img_atts ) ) {
									?>

									<img src="<?php echo havoc_extra_resize( $img_url[0], $img_atts['width'], $img_atts['height'], $img_atts['crop'], true, $img_atts['upscale'] ); ?>" alt="<?php the_title_attribute(); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>"<?php havocwp_schema_markup( 'image' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> />

									<?php
								} else {

									// Images size.
									if ( 'full-width' === havocwp_post_layout()
										|| 'full-screen' === havocwp_post_layout() ) {
										$size = 'medium_large';
									} else {
										$size = 'medium';
									}

									// Retreive image alt text or use HavocWP default text if image alt text not set.
									$srpfe_img_alt = get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', true );

									$srp_fimage_alt = ( false === $srp_seo_set || ( true === $srp_seo_set && ! $srpfe_img_alt ) ) ? esc_attr( havocwp_theme_strings( 'hvc-string-read-more-article', false ) ) . ' ' . esc_attr( get_the_title() ) : esc_attr( $srpfe_img_alt );

									// Image args.
									$img_args = array(
										'alt' => esc_attr( $srp_fimage_alt ),
									);
									if ( havocwp_get_schema_markup( 'image' ) ) {
										$img_args['itemprop'] = 'image';
									}

									// Display post thumbnail.
									the_post_thumbnail( $size, $img_args );

								}
								?>
							</a>

						</figure>

					<?php endif; ?>

					<h3 class="related-post-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h3><!-- .related-post-title -->

					<?php if ( true === $srp_date ) { ?>			
						<time class="published" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>"><?php havocwp_icon( 'date' ); ?><?php echo esc_html( get_the_date() ); ?></time>
					<?php } ?>	

				</article><!-- .related-post -->

				<?php
				if ( $havocwp_columns === $havocwp_count ) {
					$havocwp_count = 0;
				}
				?>

			<?php endforeach; ?>

		</div><!-- .havocwp-row -->

	</section><!-- .related-posts -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php do_action( 'havoc_after_single_post_related_posts' ); ?>
