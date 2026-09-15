<?php
/**
 * Newspaperup Theme Customizer
 *
 * @package Newspaperup
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newspaperup_customize_register($wp_customize) {
    
	
}
add_action('customize_register', 'newspaperup_customize_register');

/************************* Theme Customizer with Sanitize function *********************************/
function newspaperup_theme_option( $wp_customize ){   
    $newspaperup_default = newspaperup_get_default_theme_options();


}
add_action('customize_register','newspaperup_theme_option');