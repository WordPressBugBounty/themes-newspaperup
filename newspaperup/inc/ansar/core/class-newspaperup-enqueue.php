<?php
/**
 * Enqueue and register scripts and styles.
 */
class Newspaperup_Enqueue_Scripts {

	/**
	 * Check if debug is on
	 *
	 * @var boolean
	 */
	private $is_debug;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action('wp_enqueue_scripts',  array( $this, 'newspaperup_scripts_n_styles',) );

		add_action('admin_enqueue_scripts',  array( $this, 'newspaperup_admin_scripts',) );

		add_action('wp_footer', array( $this, 'newspaperup_custom_js',) );

		add_action('wp_print_footer_scripts',  array( $this, 'newspaperup_skip_link_focus_fix',) );
		
		add_action('customize_controls_print_footer_scripts',  array( $this, 'newspaperup_customizer_scripts',) );
	}

	

	/**
	 * Enqueue styles and scripts.
	 *
	 * @since 1.0.0
	 */

	public function newspaperup_scripts_n_styles() {

		wp_enqueue_style('all-css', NEWSPAPERUP_THEME_URI .'css/all.css', array(), NEWSPAPERUP_THEME_VERSION );
	
		wp_enqueue_style('dark', NEWSPAPERUP_THEME_URI . 'css/colors/dark.css', array(), NEWSPAPERUP_THEME_VERSION );
	
		wp_enqueue_style('core', NEWSPAPERUP_THEME_URI . 'css/core.css', array(), NEWSPAPERUP_THEME_VERSION );
		
		wp_style_add_data('core', 'rtl', 'replace' );
		
		wp_enqueue_style('newspaperup-style', get_stylesheet_uri() );
		
		wp_style_add_data('newspaperup-style', 'rtl', 'replace' );
		
		wp_enqueue_style('wp-core', NEWSPAPERUP_THEME_URI . 'css/wp-core.css', array(), NEWSPAPERUP_THEME_VERSION );
		
		wp_enqueue_style('default', NEWSPAPERUP_THEME_URI . 'css/colors/default.css', array(), NEWSPAPERUP_THEME_VERSION );
	
		wp_enqueue_style('swiper-bundle-css', NEWSPAPERUP_THEME_URI . 'css/swiper-bundle.css', array(), NEWSPAPERUP_THEME_VERSION );
		
		wp_enqueue_style('menu-core-css', NEWSPAPERUP_THEME_URI . 'css/sm-core-css.css', array(), NEWSPAPERUP_THEME_VERSION );
		
		wp_enqueue_style('smartmenus',NEWSPAPERUP_THEME_URI.'css/sm-clean.css', array(), NEWSPAPERUP_THEME_VERSION );	 
	
		/* Js script */
	
		wp_enqueue_script('newspaperup-navigation', NEWSPAPERUP_THEME_URI . 'js/navigation.js', array('jquery'), NEWSPAPERUP_THEME_VERSION);
	
		wp_enqueue_script('swiper-bundle', NEWSPAPERUP_THEME_URI . 'js/swiper-bundle.js', array('jquery'), NEWSPAPERUP_THEME_VERSION);
	
		wp_enqueue_script('sticky-js', NEWSPAPERUP_THEME_URI . 'js/hc-sticky.js' , array('jquery'), NEWSPAPERUP_THEME_VERSION);
	
		wp_enqueue_script('sticky-header-js', NEWSPAPERUP_THEME_URI . 'js/jquery.sticky.js' , array('jquery'), NEWSPAPERUP_THEME_VERSION);
	
		wp_enqueue_script('smartmenus-js', NEWSPAPERUP_THEME_URI . 'js/jquery.smartmenus.js', array(), NEWSPAPERUP_THEME_VERSION );
	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	
		wp_enqueue_script('jquery-cookie', NEWSPAPERUP_THEME_URI . 'js/jquery.cookie.min.js', array('jquery'), NEWSPAPERUP_THEME_VERSION);

		newspaperup_customize_options();
	}
	
	public function newspaperup_admin_scripts() {
	
		wp_enqueue_script( 'media-upload' );
	
		wp_enqueue_media();
	
		wp_enqueue_style('newspaperup-admin-style', NEWSPAPERUP_THEME_URI . 'css/admin-style.css', array(), NEWSPAPERUP_THEME_VERSION );

		wp_enqueue_script(
			'newspaperup-admin-script',
			NEWSPAPERUP_THEME_URI . 'inc/ansar/customizer-admin/js/admin-script.js',
			array( 'jquery' ), NEWSPAPERUP_THEME_VERSION,
			'',
			true
		);

		wp_localize_script(
			'newspaperup-admin-script',
			'newspaperup_ajax_object',
			array(
				'ajax_url'      => admin_url( 'admin-ajax.php' ),
				'install_nonce' => wp_create_nonce( 'newspaperup_install_plugin_nonce' ),
				'can_install'   => current_user_can( 'install_plugins' ),
			)
		);
		
		wp_enqueue_style('newspaperup-admin-style-css', NEWSPAPERUP_THEME_URI . 'css/customizer-controls.css', array(), NEWSPAPERUP_THEME_VERSION );
	}
	
	//Custom Color
	public function newspaperup_custom_js() {
	
		wp_enqueue_script('newspaperup_custom-js', NEWSPAPERUP_THEME_URI . 'js/custom.js' , array('jquery'), NEWSPAPERUP_THEME_VERSION);	
		
		wp_enqueue_script('newspaperup-dark', NEWSPAPERUP_THEME_URI . 'js/dark.js' , array('jquery'), NEWSPAPERUP_THEME_VERSION);
	
		theme_options_color();
	
		theme_options_dark_color();
	}

	/**
	 * Fix skip link focus in IE11.
	 *
	 * This does not enqueue the script because it is tiny and because it is only for IE11,
	 * thus it does not warrant having an entire dedicated blocking script being loaded.
	 *
	 * @link https://git.io/vWdr2
	 */
	public function newspaperup_skip_link_focus_fix() {
		// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
		</script>
		<?php
	}

	public function newspaperup_customizer_scripts() {
		wp_enqueue_style( 'newspaperup-customizer-styles', NEWSPAPERUP_THEME_URI . 'css/customizer-controls.css', array(), NEWSPAPERUP_THEME_VERSION );
		wp_enqueue_style('newspaperup-custom-controls-css', NEWSPAPERUP_THEME_URI . 'inc/ansar/customize/css/customizer.css', array(), NEWSPAPERUP_THEME_VERSION );
	}
}
