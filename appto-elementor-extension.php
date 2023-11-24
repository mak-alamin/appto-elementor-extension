<?php

/**
 * Plugin Name: AppTo Elementor Extension
 * Description: AppTo Elementor extension with advanced features
 * Plugin URI:  https://
 * Version:     1.0.0
 * Author:      Mak Alamin
 * Author URI:  https://
 * Text Domain: appto-extension
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// SVG + XML File uploads
function appto_custom_mime_types($mimes)
{
  $mimes['xml'] = 'application/xml';
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';

  return $mimes;
}
add_filter('upload_mimes', 'appto_custom_mime_types');

/**
 * Main AppTo Elementor Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class AppTo_Elementor_Extension
{

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';


	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';


	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';


	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var AppTo_Elementor_Extension The single instance of the class.
	 */
	private static $_instance = null;


	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return AppTo_Elementor_Extension An instance of the class.
	 */
	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct()
	{
		add_action('plugins_loaded', [$this, 'on_plugins_loaded']);
	}


	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n()
	{

		load_plugin_textdomain('appto-extension');
	}


	/**
	 * On Plugins Loaded
	 *
	 * Checks if Elementor has loaded, and performs some compatibility checks.
	 * If All checks pass, inits the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_plugins_loaded()
	{
		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
	}


	/**
	 * Compatibility Checks
	 *
	 * Checks if the installed version of Elementor meets the plugin's minimum requirement.
	 * Checks if the installed PHP version meets the plugin's minimum requirement.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function is_compatible()
	{
		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}


	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init()
	{
		$this->i18n();

		$this->define_constants();

		// Elementor Widgets Register
		add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);

		add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);

		// add_action('elementor/controls/controls_registered', [$this, 'init_controls']);
	}

	/**
	 * Define Constants
	 */
	public function define_constants()
	{
		define('APPTO_ELE_EXT_PLUGIN_DIR', plugin_dir_path(__FILE__));

		define('APPTO_ELE_EXT_ASSET_DIR', plugin_dir_path(__FILE__) . '/assets');

		define('APPTO_ELE_EXT_ASSET_URL', plugins_url('/assets', __FILE__));
	}

	/**
	 * APPTO Widget Category
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function add_elementor_widget_categories($elements_manager)
	{
		$elements_manager->add_category(
			'appto-widgets',
			[
				'title' => __('APPTO', 'appto-extension'),
				'icon' => 'fa fa-plug',
			]
		);
	}


	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets()
	{
		//Include autoload files
		require_once __DIR__ . '/vendor/autoload.php';

		//Register Banner_Slider widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Inc\Widgets\Banner_Slider\Banner_Slider());

		//Register Tab_Horizon widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Inc\Widgets\Tab_Horizon\Tab_Horizon());

		//Register Carousel widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Inc\Widgets\Carousel\Carousel());

		//Register Testimonial widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Inc\Widgets\Testimonial\Testimonial());

		//Register Post_Grid widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Inc\Widgets\Post_Grid\Post_Grid());
	}


	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls()
	{

		// Include Control files
		// require_once( __DIR__ . '/controls/test-control.php' );

		// Register control
		// \Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );

	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'appto-extension'),
			'<strong>' . esc_html__('AppTo Elementor Extension', 'appto-extension') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'appto-extension') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'appto-extension'),
			'<strong>' . esc_html__('AppTo Elementor Extension', 'appto-extension') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'appto-extension') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'appto-extension'),
			'<strong>' . esc_html__('AppTo Elementor Extension', 'appto-extension') . '</strong>',
			'<strong>' . esc_html__('PHP', 'appto-extension') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
}

AppTo_Elementor_Extension::instance();
