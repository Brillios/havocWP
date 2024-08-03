<?php
/**
 * Customizer Control: havocwp-typography.
 *
 * @package     HavocWP WordPress theme
 * @subpackage  Controls
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Typography control
 */
class HavocWP_Customizer_Typography_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'havocwp-typography';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		// Don't call is The Event Calendar active to avoid conflict
		if ( ! class_exists( 'Tribe__Events__Main' ) || ! class_exists( 'LearnPress' ) || ! defined( 'TUTOR_VERSION' ) || ! defined( 'LEARNDASH_VERSION' ) ) {
			wp_enqueue_script( 'havocwp-select2', HAVOCWP_INC_DIR_URI . 'customizer/controls/select2.min.js', array( 'jquery' ), false, true );
			wp_enqueue_style( 'select2', HAVOCWP_INC_DIR_URI . 'customizer/controls/select2.min.css', null );
			wp_enqueue_script( 'havocwp-typography-js', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/js/typography.min.js', array( 'jquery', 'havocwp-select2' ), false, true );
			wp_localize_script( 'havocwp-select2', 'havoc_wp_fonts_list', $this->fonts_list() );

		}
		wp_enqueue_style( 'havocwp-typography', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/css/typography.min.css', null );
	}


	/**
	 * Fonts List.
	 *
	 * @access public
	 */
	public function fonts_list() {
		ob_start();
		?>
		<option value=""><?php esc_html_e( 'Default', 'havocwp' ); ?></option>
		<?php
				// Add custom fonts from child themes
				if ( function_exists( 'havoc_add_custom_fonts' ) ) {
					$fonts = havoc_add_custom_fonts();
					if ( $fonts && is_array( $fonts ) ) { ?>
						<optgroup label="<?php esc_attr_e( 'Custom Fonts', 'havocwp' ); ?>">
							<?php foreach ( $fonts as $font ) { ?>
								<option value="<?php echo esc_attr( $font ); ?>"><?php echo esc_html( $font ); ?></option>
							<?php } ?>
						</optgroup>
					<?php }
				}

				// Get Standard font options
				if ( $std_fonts = havocwp_standard_fonts() ) { ?>
					<optgroup label="<?php esc_attr_e( 'Standard Fonts', 'havocwp' ); ?>">
						<?php
						// Loop through font options and add to select
						foreach ( $std_fonts as $font ) { ?>
							<option value="<?php echo esc_attr( $font ); ?>"><?php echo esc_html( $font ); ?></option>
						<?php } ?>
					</optgroup>
				<?php }

				// Google font options
				if ( $google_fonts = havocwp_google_fonts_array() ) { ?>
					<optgroup label="<?php esc_attr_e( 'Google Fonts', 'havocwp' ); ?>">
						<?php
						// Loop through font options and add to select
						foreach ( $google_fonts as $font ) { ?>
							<option value="<?php echo esc_attr( $font ); ?>"><?php echo esc_html( $font ); ?></option>
						<?php } ?>
					</optgroup>
				<?php } ?>
				<?php do_action('havoc_customizer_fonts'); ?>
		<?php

		$content = str_replace( [ "\n", "\r", "\t" ], '', ob_get_clean());

		return [
			'content' => $content
		];
	}


	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper in $this->render().
	 *
	 * @access protected
	 */
	protected function render_content() {
		$this_val = $this->value();
		$has_val  = $this_val ? $this_val : esc_html__( 'Default', 'havocwp' );
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>

			<select class="havocwp-typography-select" <?php $this->link(); ?> data-value="<?php echo $this_val ?>">
				<option value="" <?php if ( ! $this_val ) echo 'selected="selected"'; ?>><?php echo $has_val; ?></option>
			</select>

		</label>

		<?php
	}
}
