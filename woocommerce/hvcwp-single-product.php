<?php
/**
 * Single product template.
 *
 * @package HavocWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Get price conditional display state.
$havoc_woo_single_cond = get_theme_mod( 'havoc_woo_single_conditional', false );

// Conditional vars.
$show_woo_single = '';
$show_woo_single = ( is_user_logged_in() && $havoc_woo_single_cond === true );

/**
 * Display Single Product template
 */

// Get elements.
$elements = havocwp_woo_summary_elements_positioning();

// Loop through elements.
foreach ( $elements as $element ) {

	do_action( 'havoc_before_single_product_' . $element );

	// Title.
	if ( 'title' === $element ) {

		woocommerce_template_single_title();

	}

	// Rating.
	if ( 'rating' === $element ) {

		woocommerce_template_single_rating();

	}

	// Price.
	if ( 'price' === $element ) {

		if ( false === $havoc_woo_single_cond || $show_woo_single ) {

			woocommerce_template_single_price();

		}
	}

	// Excerpt.
	if ( 'excerpt' === $element ) {

		woocommerce_template_single_excerpt();

	}

	// Quantity & Add to cart button.
	if ( 'quantity-button' === $element ) {

		if ( false === $havoc_woo_single_cond || $show_woo_single ) {

			woocommerce_template_single_add_to_cart();

		} else {

			// Get Add to Cart button message display state.
			$havoc_woo_single_msg = get_theme_mod( 'havoc_woo_single_cond_msg', 'yes' );

			if ( 'yes' === $havoc_woo_single_msg ) {

				// Get Add to Cart button replacement message.
				$havoc_woo_single_msg_txt = get_theme_mod( 'havoc_woo_single_cond_msg_text' );
				$havoc_woo_single_msg_txt = $havoc_woo_single_msg_txt ? $havoc_woo_single_msg_txt : esc_html__( 'Log in to view price and purchase', 'havocwp' );

				$woo_single_myaccunt_link = get_theme_mod( 'havoc_single_add_myaccount_link', false );

				echo '<div class="hvc-woo-single-cond-notice">';
				if ( false === $woo_single_myaccunt_link ) {
					echo '<span>'. $havoc_woo_single_msg_txt .'</span>';
				} else {
					echo '<a href="' . esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) . '">' . $havoc_woo_single_msg_txt . '</a>';
				}
				echo '</div>';

			}
		}
	}

	// Meta.
	if ( 'meta' === $element ) {
		woocommerce_template_single_meta();
	}

	do_action( 'havoc_after_single_product_' . $element );

}
