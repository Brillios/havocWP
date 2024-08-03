<?php
/**
 * Post single meta style
 * 
 * Minimal style without icons.
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) or exit;

// Get meta sections.
$sections = havocwp_blog_single_meta();

// Return if sections are empty, not post type or quote post format.
if ( empty( $sections ) || 'post' !== get_post_type() || 'quote' === get_post_format() ) {
	return;
}

// Don't display modified date if the same as the published date.
$havoc_date_onoff = false;
$havoc_date_onoff = apply_filters( 'havoc_single_2_modified_date_state', $havoc_date_onoff );
$display_mod_date = ( false === $havoc_date_onoff || ( true === $havoc_date_onoff && ( get_the_date() != get_the_modified_date() ) ) ) ? true : false;

do_action( 'havoc_before_single_post_meta' );
?>

<ul class="meta-item meta <?php echo havocwp_theme_single_post_separator(); ?> clr">

	<?php
	// Loop through meta sections.
	foreach ( $sections as $section ) {
		?>

		<?php if ( 'author' === $section ) { ?>
			<li class="meta-author"><?php havoc_get_post_author(); ?></li>
		<?php } ?>

		<?php if ( 'date' === $section ) { ?>
			<li class="meta-date"><?php havoc_get_post_date(); ?></li>
		<?php } ?>

		<?php if ( 'mod-date' === $section && true === $display_mod_date ) { ?>
				<li class="meta-mod-date"><?php havoc_get_post_modified_date(); ?></li>
		<?php } ?>

		<?php if ( 'categories' === $section ) { ?>
			<li class="meta-cat"><?php havoc_get_post_categories(); ?></li>
		<?php } ?>

		<?php if ( 'tags' === $section ) { ?>
			<li class="meta-cat"><?php havoc_get_post_tags(); ?></li>
		<?php } ?>

		<?php if ( 'reading-time' === $section ) { ?>
			<li class="meta-rt"><?php havoc_get_post_reading_time(); ?></li>
		<?php } ?>

		<?php if ( 'comments' === $section && comments_open() && ! post_password_required() ) { ?>
			<li class="meta-comments"><?php comments_popup_link( esc_html__( '0 Comments', 'havocwp' ), esc_html__( '1 Comment', 'havocwp' ), esc_html__( '% Comments', 'havocwp' ), 'comments-link' ); ?></li>
		<?php } ?>

	<?php } ?>

</ul>

<?php do_action( 'havoc_after_single_post_meta' ); ?>
