<?php
/**
 * Customizer Control: havocwp-info.
 *
 * @package     HavocWP WordPress theme
 * @subpackage  Controls
 *  */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Range control
 */
class HavocWP_Customizer_Info_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'havocwp-info';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_style( 'havocwp-info', HAVOCWP_INC_DIR_URI . 'customizer/assets/min/css/info.min.css', null );
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
	protected function content_template() {
		?>
		<h4 class="havocwp-customizer-info">{{{ data.label }}}</h4>
		<div class="description">{{{ data.description }}}</div>
		<?php
	}
}
