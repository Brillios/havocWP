<?php
/**
 * HavocWP SVG Icons
 *
 * @package HavocWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load SVG
 */
function havoc_get_svg_icon() {

	$is_svg = get_theme_mod( 'havoc_disable_svg_icons', 'enabled' );

	if ( ( true === $is_svg || 'disabled' === $is_svg ) || 'svg' !== havocwp_theme_icon_class() ) {
		return;
	}

	// Define SVG file.
	$svg = HAVOCWP_THEME_DIR . '/assets/fonts/hvc-icons/hvc-icons.svg';

	// If it exists, include it.
	if ( file_exists( $svg ) ) {
		require_once apply_filters( 'havoc_get_svg_icon', $svg );
	}
}
add_action( 'wp_footer', 'havoc_get_svg_icon' );

/**
 * Backward compatibility with HavocWP v-3.3.5
 */
function havoc_comp_svg_disable_option() {

	$is_svg = get_theme_mod( 'havoc_disable_svg_icons', 'enabled' );

	if ( true === $is_svg ) {
		set_theme_mod( 'havoc_disable_svg_icons', 'disabled' );
	} else if ( false === $is_svg ) {
		set_theme_mod( 'havoc_disable_svg_icons', 'enabled' );
	}
}
add_action( 'init', 'havoc_comp_svg_disable_option' );

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 * @type string $icon Required SVG icon filename.
 * @type string $title Optional SVG title.
 * @type string $desc Optional SVG description.
 * }
 * @param bool  $location Location check.
 *
 * @return string SVG markup.
 */
function havoc_svg_icon( $args = array(), $location = true ) {

	$is_svg = get_theme_mod( 'havoc_disable_svg_icons', 'enabled' );

	if ( ( true === $is_svg || 'disabled' === $is_svg ) || 'svg' !== havocwp_theme_icon_class() ) {
		return;
	}

	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'havocwp' );
	}

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'class'       => '',
		'title'       => '',
		'desc'        => '',
		'aria_hidden' => true,
		'fallback'    => false,
	);

	// Get icon class.
	$svg         = '';
	$has_icon    = '';
	$theme_icons = havocwp_theme_icons();
	$icon_class  = havocwp_theme_icon_class();

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	if ( empty( $args['icon'] ) || 'none' === $args['icon'] ) {
		return;
	}

	// Set aria hidden.
	$aria_hidden = '';

	if ( true === $args['aria_hidden'] ) {
		$aria_hidden = ' aria-hidden="true"';
	}

	// Set aria labelledby.
	$aria_labelledby = '';

	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="title desc"';
	}

	// Check if $args['icon'] is set and not empty
	if ( false === $location ) {
		if (isset($theme_icons[$args['icon']])) {
			$has_icon = $theme_icons[$args['icon']][$icon_class];
		}
	} else {
		// Set a default icon if $args['icon'] is not set or empty
		$has_icon = $args['icon'];
	}


	$class = '';
	if ( ! empty( $args['class'] ) ) {
		$class = $args['class'];
	}

	// Add SVG markup.
	$svg = '<svg class="hvc-icon hvc-icon--' . $has_icon . ' ' . $class . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// If there is a title, display it.
	if ( $args['title'] ) {
		$svg .= '<title>' . esc_html( $args['title'] ) . '</title>';
	}

	// If there is a description, display it.
	if ( $args['desc'] ) {
		$svg .= '<desc>' . esc_html( $args['desc'] ) . '</desc>';
	}

	$svg .= '<use xlink:href="#hvc-icon-' . $has_icon . '"></use>';

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon--' . $has_icon . '"></span>';
	}

	$svg .= '</svg>';

	return $svg;
}

/**
 * Allowed HTML for svg icons.
 */
function havoc_svg_icon_allowed_html() {

	$array = array(
		'svg' => array(
			'class'       => array(),
			'aria-hidden' => array(),
			'role'        => array(),
		),
		'use' => array(
			'xlink:href' => array(),
		),
	);

	return apply_filters( 'havoc_svg_icon_allowed_html', $array );
}

/**
 * Havoc SVG print icon
 */
function havoc_svg_print_icon( $args = array(), $echo = true ) {

	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'havocwp' );
	}

	$icon = wp_kses( havoc_svg_icon( $args, false ), havoc_svg_icon_allowed_html() );

	$icon = apply_filters( "havoc_svg_print_icon_{$icon}", $icon );

	/**
	 * Print or return icon
	 */
	if ( $echo ) {
		echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $icon;
	}

}

/**
 * Return SVG markup.
 *
 * @param string  $icon        Icon class.
 * @param bool    $echo        Print string.
 * @param string  $class       Icon class.
 * @param string  $title       Optional SVG title.
 * @param string  $desc        Optional SVG description.
 * @param string  $aria_hidden Optional SVG description.
 * @param boolean $fallback    Fallback icon.
 *
 * @return string SVG Icon.
 */
function havoc_svg( $icon, $location = true, $echo = true, $class = '', $title = '', $desc = '', $aria_hidden = true, $fallback = false ) {

	$hvc_icon = wp_kses(
		havoc_svg_icon(
			array(
				'icon'        => $icon,
				'class'       => $class,
				'title'       => $title,
				'desc'        => $desc,
				'area_hidden' => $aria_hidden,
				'fallback'    => $fallback,
			),
			$location
		),
		havoc_svg_icon_allowed_html()
	);

	/**
	 * Print or return icon
	 */
	if ( $echo ) {
		echo $hvc_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $hvc_icon;
	}
}
