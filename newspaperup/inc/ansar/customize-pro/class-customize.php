<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Newspaperup_Customize {
	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {
		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}
		return $instance;
	}
	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}
	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {
		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		add_action( 'after_setup_theme', array( $this, 'customizer_helpers' ) );
		
		add_action( 'customize_register', array( $this, 'customize_controls' ), 10 );

		add_action( 'customize_register', array( $this, 'customize_options' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
		
		// Enqueues our Customizer preview assets.
		add_action( 'customize_preview_init', array( $this, 'load_preview_assets' ) );
	}
	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {
		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . '/inc/ansar/customize-pro/section-pro.php' );
		// Register custom section types.
		$manager->register_section_type( 'Newspaperup_Customize_Section_Pro' );
		// Register sections.
		$manager->add_section(
			new Newspaperup_Customize_Section_Pro(
				$manager,
				'newspaperup_pro_upsell',
				array(
					'pro_text' => esc_html__( 'UPGRADE TO PRO','newspaperup' ),
					'pro_url'  => 'https://themeansar.com/themes/newspaperup-pro/',
					'priority'	=> 1
				)
			)
		);
		$manager->add_section(
			new Newspaperup_Customize_Section_Pro(
				$manager,
				'newspaperup_support_form',
				array(
					'pro_text' => esc_html__( 'Get Support','newspaperup' ),
					'pro_url'  => 'https://themeansar.ticksy.com/',
					'priority'	=> 1000,
				)
			)
		);
	}
	/**
	 * Sets up the customizer Controls.
	*/
	public function customize_controls( $wp_customize ) {
		// Load customize controls.
		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/controls/customize-control-helper.php';
		require NEWSPAPERUP_THEME_DIR . 'inc/ansar/customizer-repeater/customizer-repeater-control.php';
    }
	/**
	 * Loads Customizer helper functions and sanitization callbacks.
	 *
	 * @since 1.0.0
	 */
	public function customizer_helpers() {

		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/customizer-callback.php';
		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/selective-refresh-and-partial.php';
		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/customizer-default.php';
		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/customizer-sanitize.php';
	}
	/**
	 * Sets up the customizer options.
	*/
	public function customize_options( $wp_customize ) {

		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/settings/header-options.php';
		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/settings/theme-options.php';
		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/settings/theme-layout.php';
		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/settings/customize-core.php';
		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/settings/frontpage-options.php';
		require NEWSPAPERUP_THEME_DIR . '/inc/ansar/customize/settings/footer-options.php';

		// Customize Tweaks
		$wp_customize->get_setting('blogname')->transport         = 'postMessage';
		$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
		$wp_customize->get_setting('custom_logo')->transport      = 'postMessage';
		$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
	}
	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		wp_enqueue_script( 'newspaperup-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/ansar/customize-pro/customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'newspaperup-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/ansar/customize-pro/customize-controls.css' );
	}
		
	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function load_preview_assets() {

		wp_enqueue_media();

		// Enqueue the customizer preview script.
		wp_enqueue_script('newspaperup-customizer-preview', NEWSPAPERUP_THEME_URI . '/js/customizer.js', ['customize-preview'], NEWSPAPERUP_THEME_VERSION, true);
	}
}
// Doing this customizer thang!
Newspaperup_Customize::get_instance();