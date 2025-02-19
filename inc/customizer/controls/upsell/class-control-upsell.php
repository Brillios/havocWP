<?php
/**
 * Customizer Control: havocwp-upsell.
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
 * Upsell control
 */
class HavocWP_Customizer_Upsell_Section_Control extends WP_Customize_Section {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'havocwp-upsell';
	public $url  = '';
	public $id = '';

	/**
	 * JSON.
	 */
	public function json() {
		$json 			= parent::json();
		$json['url'] 	= esc_url( $this->url );
		$json['id'] 	= $this->id;
		return $json;
	}

	/**
	 * Render template
	 *
	 * @access protected
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3>
				<a href="{{{ data.url }}}" target="_blank">{{ data.title }}</a>
			</h3>
		</li>
		<?php
	}
}

/**
 * Enqueue control related scripts/styles.
 *
 * @access public
 */
function havocwp_upsell_enqueue() {
	wp_enqueue_script( 'havocwp-upsell', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/js/upsell.min.js', array( 'customize-controls' ), false, true );
	wp_enqueue_style( 'havocwp-upsell', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/css/upsell.min.css', null );
}
add_action( 'customize_controls_enqueue_scripts', 'havocwp_upsell_enqueue' );