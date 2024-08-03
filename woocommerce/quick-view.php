<?php
/**
 * Quick view template.
 *
 * @package HavocWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} ?>

<div id="hvc-qv-wrap">
	<div class="hvc-qv-container">
		<div class="hvc-qv-content-wrap">
			<div class="hvc-qv-content-inner">
				<a href="#" class="hvc-qv-close" aria-label="<?php echo esc_attr( havocwp_theme_strings( 'hvc-string-woo-quick-view-close', false ) ); ?>">×</a>
				<div id="hvc-qv-content" class="woocommerce single-product"></div>
			</div>
		</div>
	</div>
	<div class="hvc-qv-overlay"></div>
</div>
