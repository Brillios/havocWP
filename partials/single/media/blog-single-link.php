<?php
/**
 * Blog single link format media
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if there isn't a thumbnail defined.
if ( ! has_post_thumbnail() ) {
	return;
}

$icon_class = '';
if ( 'svg' === havocwp_theme_icon_class() ) {
	$icon_class = 'link-post-svg-icon';
} else {
	$icon_class = '';
}

// Image args.
$img_args = array(
	'alt' => get_the_title(),
);

if ( havocwp_get_schema_markup( 'image' ) ) {
	$img_args['itemprop'] = 'image';
}

// Caption.
$caption = get_the_post_thumbnail_caption();

?>

<div class="thumbnail">

	<?php
	// Display post thumbnail.
	the_post_thumbnail( 'full', $img_args );

	// Caption.
	if ( $caption ) {
		?>
		<div class="thumbnail-caption">
			<?php echo wp_kses_post( $caption ); ?>
		</div>
		<?php
	}
	?>

	<div class="link-entry <?php echo esc_attr( $icon_class ); ?> clr">

		<a aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-link-post-format', false ) ); ?>" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'havoc_link_format', true ) ); ?>" target="_<?php echo esc_attr( get_post_meta( get_the_ID(), 'havoc_link_format_target', true ) ); ?>"><?php havocwp_icon( 'link' ); ?>

			<?php if ( 'blank' === get_post_meta( get_the_ID(), 'havoc_link_format_target', true ) ) { ?>
				<span class="screen-reader-text"><?php echo esc_html( havocwp_theme_strings( 'hvc-string-new-tab-alert', false ) ); ?></span>
			<?php } ?>

		</a>

	</div>

</div>
