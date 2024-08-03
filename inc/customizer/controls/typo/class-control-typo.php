<?php
/**
 * Customizer Control: havocwp-typo.
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
class HavocWP_Customizer_Typo_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'havocwp-typo';

	/**
	 * Array
	 *
	 * 	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * 	 * @access public
	 * @param  object $manager
	 * @param  string $id
	 * @param  array  $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'family'      => esc_html__( 'Font Family', 'havocwp' ),
				'size'        => esc_html__( 'Font Size', 'havocwp' ),
				'weight'      => esc_html__( 'Font Weight', 'havocwp' ),
				'style'       => esc_html__( 'Font Style', 'havocwp' ),
				'transform'   => esc_html__( 'Text Transform', 'havocwp' ),
				'line_height' => esc_html__( 'Line Height', 'havocwp' ),
				'spacing'     => esc_html__( 'Letter Spacing', 'havocwp' ),
			)
		);
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'havocwp-select2', HAVOCWP_INC_DIR_URI . 'customizer/controls/select2.min.js', array( 'jquery' ), false, true );
		wp_enqueue_style( 'select2', HAVOCWP_INC_DIR_URI . 'customizer/controls/select2.min.css', null );
		wp_enqueue_script( 'havocwp-typo-js', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/js/typo.min.js', array( 'jquery', 'customize-base', 'select2' ), false, true );
		wp_enqueue_style( 'havocwp-typo', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/css/typo.min.css', null );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : '',
			);

			if ( 'family' === $setting_key ) {
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			} elseif ( 'weight' === $setting_key ) {
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			} elseif ( 'style' === $setting_key ) {
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();

			} elseif ( 'transform' === $setting_key ) {
				$this->json[ $setting_key ]['choices'] = $this->get_text_transform_choices();
			}
		}

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() { ?>
		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul class="havocwp-typo-wrap">

			<# if ( data.family && data.family.choices ) { #>
				<li class="typography-font-family">

					<# if ( data.family.label ) { #>
						<span class="label">{{ data.family.label }}</span>
					<# } #>

					<select {{{ data.family.link }}}>

						<# _.each( data.family.choices, function( label, choice ) { #>
							<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
						<# } ) #>

					</select>
				</li>
			<# } #>

			<# if ( data.size ) { #>
				<li class="typography-font-size">

					<# if ( data.size.label ) { #>
						<span class="label">{{ data.size.label }}</span>
					<# } #>

					<input type="text" {{{ data.size.link }}} name="{{ data.size.name }}" value="{{ data.size.value }}" placeholder="<?php esc_attr_e( 'px - em - rem', 'havocwp' ); ?>" />

				</li>
			<# } #>

			<# if ( data.weight && data.weight.choices ) { #>
				<li class="typography-font-weight">

					<# if ( data.weight.label ) { #>
						<span class="label">{{ data.weight.label }}</span>
					<# } #>

					<select {{{ data.weight.link }}}>

						<# _.each( data.weight.choices, function( label, choice ) { #>

							<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

						<# } ) #>

					</select>
				</li>
			<# } #>

			<# if ( data.style && data.style.choices ) { #>
				<li class="typography-font-style">

					<# if ( data.style.label ) { #>
						<span class="label">{{ data.style.label }}</span>
					<# } #>

					<select {{{ data.style.link }}}>

						<# _.each( data.style.choices, function( label, choice ) { #>

							<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

						<# } ) #>

					</select>
				</li>
			<# } #>

			<# if ( data.transform && data.transform.choices ) { #>
				<li class="typography-text-transform">

					<# if ( data.transform.label ) { #>
						<span class="label">{{ data.transform.label }}</span>
					<# } #>

					<select {{{ data.transform.link }}}>

						<# _.each( data.transform.choices, function( label, choice ) { #>

							<option value="{{ choice }}" <# if ( choice === data.transform.value ) { #> selected="selected" <# } #>>{{ label }}</option>

						<# } ) #>

					</select>
				</li>
			<# } #>

			<# if ( data.line_height ) { #>
				<li class="typography-line-height">

					<# if ( data.line_height.label ) { #>
						<span class="label">{{ data.line_height.label }}</span>
					<# } #>

					<input type="text" {{{ data.line_height.link }}} name="{{ data.line_height.name }}" value="{{ data.line_height.value }}" placeholder="<?php esc_attr_e( 'px - em - rem', 'havocwp' ); ?>" />

				</li>
			<# } #>

			<# if ( data.spacing ) { #>
				<li class="typography-letter-spacing">

					<# if ( data.spacing.label ) { #>
						<span class="label">{{ data.spacing.label }}</span>
					<# } #>

					<input type="text" {{{ data.spacing.link }}} name="{{ data.spacing.name }}" value="{{ data.spacing.value }}" placeholder="<?php esc_attr_e( 'px - em - rem', 'havocwp' ); ?>" />

				</li>
			<# } #>

		</ul>
		<?php
	}

	/**
	 * Returns the available font families.
	 *
	 * 	 * @access public
	 * @return array
	 */
	public function get_font_families() {

		$fonts = array( '' => esc_html__( 'Default', 'havocwp' ) );
		$id    = '';

		// Add custom fonts from child themes
		if ( function_exists( 'havoc_add_custom_fonts' ) ) {
			$get_fonts = havoc_add_custom_fonts();
			if ( $get_fonts && is_array( $get_fonts ) ) {
				foreach ( $get_fonts as $font ) {
					$fonts[ $font ] = $font;
				}
			}
		}

		// Get Standard font options
		if ( $std_fonts = havocwp_standard_fonts() ) {
			foreach ( $std_fonts as $font ) {
				$fonts[ $font ] = $font;
			}
		}

		// Google font options
		if ( $google_fonts = havocwp_google_fonts_array() ) {
			foreach ( $google_fonts as $font ) {
				$fonts[ $font ] = $font;
			}
		}

		return $fonts;

	}

	/**
	 * Returns the available font weights.
	 *
	 * 	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			''    => esc_html__( 'Default', 'havocwp' ),
			'100' => esc_html__( 'Thin: 100', 'havocwp' ),
			'200' => esc_html__( 'Light: 200', 'havocwp' ),
			'300' => esc_html__( 'Book: 300', 'havocwp' ),
			'400' => esc_html__( 'Normal: 400', 'havocwp' ),
			'500' => esc_html__( 'Medium: 500', 'havocwp' ),
			'600' => esc_html__( 'Semibold: 600', 'havocwp' ),
			'700' => esc_html__( 'Bold: 700', 'havocwp' ),
			'800' => esc_html__( 'Extra Bold: 800', 'havocwp' ),
			'900' => esc_html__( 'Black: 900', 'havocwp' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * 	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			''       => esc_html__( 'Default', 'havocwp' ),
			'normal' => esc_html__( 'Normal', 'havocwp' ),
			'italic' => esc_html__( 'Italic', 'havocwp' ),
		);
	}

	/**
	 * Returns the available text transform.
	 *
	 * 	 * @access public
	 * @return array
	 */
	public function get_text_transform_choices() {

		return array(
			''           => esc_html__( 'Default', 'havocwp' ),
			'capitalize' => esc_html__( 'Capitalize', 'havocwp' ),
			'lowercase'  => esc_html__( 'Lowercase', 'havocwp' ),
			'uppercase'  => esc_html__( 'Uppercase', 'havocwp' ),
		);
	}
}
