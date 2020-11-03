<?php
namespace WPAndAjax;

/**
 * Plugin Name:       Landing Page for Gutenberg
 * Plugin URI:        https://github.com/wpajax/landing-page-gutenberg-template
 * Description:       Creates a blank template for creating landing pages with Gutenberg and the theme Twenty Twenty One
 * Version:           1.0.0
 * Requires at least: 5.5
 * Requires PHP:      7.2
 * Author:            Ronald Huereca
 * Author URI:        https://wpandajax.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       landing-page-gutenberg-template
 * Domain Path:       /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WPAJAX_LANDING_VERSION', '1.0.0' );
define( 'WPAJAX_LANDING_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPAJAX_LANDING_URL', plugins_url( '/', __FILE__ ) );
define( 'WPAJAX_LANDING_SLUG', plugin_basename( __FILE__ ) );
define( 'WPAJAX_LANDING_FILE', __FILE__ );
define( 'WPAJAX_LANDING_PLUGIN_URI', 'https://github.com/wpajax/landing-page-gutenberg-template' );

// Setup the plugin auto loader.
require_once 'autoloader.php';

/**
 * The plugin base class.
 */
class Landing_Page_Gutenberg {

	/**
	 * Landing_Page_Gutenberg instance.
	 *
	 * @var Landing_Page_Gutenberg $instance
	 */
	private static $instance = null;

	/**
	 * Return a class instance.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Class Constructor
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ), 20 );
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Fired when the init action for WordPress is triggered.
	 */
	public function init() {
		/* Translations can be sent to ronald@mediaron.com - .po and .mo please. */
		load_plugin_textdomain(
			'landing-page-guttenberg-template',
			false,
			dirname( plugin_basename( WPAJAX_LANDING_FILE ) ) . '/languages/'
		);
	}

	/**
	 * Fired when the plugins for WordPress have finished loading.
	 */
	public function plugins_loaded() {

		// Admin enqueue actions.
		$this->admin_enqueue = new \WPAndAjax\Includes\Enqueue();
		$this->admin_enqueue->run();

		$this->meta_boxes = new \WPAndAjax\Includes\Meta_Boxes();
		$this->meta_boxes->run();

		$this->template = new \WPAndAjax\Includes\Template();
		$this->template->run();
	}
}
Landing_Page_Gutenberg::get_instance();
