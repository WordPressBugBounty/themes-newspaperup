<?php
/**
 * Newspaperup Theme Customizer
 *
 * @package Newspaperup
 */

function banner_slider_option($control) {

        $banner_slider_option = $control->manager->get_setting('banner_options_main')->value();

        if($banner_slider_option == 'banner_slider_section_option'){
            return true;
        } else{
           return false;
        }
    }

    function banner_slider_category_function($control){
  $no_option = $control->manager->get_setting('banner_options_main')->value();
  $banner_slider_category_option = $control->manager->get_setting('banner_slider_section_option')->value();
        if ($banner_slider_category_option == 'banner_slider_category_option' && $no_option == 'banner_slider_section_option') {
            return true;
        }else{ return false;}
    }

    function header_video_act_call($control){
        $video_banner_section = $control->manager->get_setting('banner_options_main')->value();
    
        if($video_banner_section == 'header_video'){
            return true;
        }else{
            return false;
        }
        }


function video_banner_section_function($control){
    $video_banner_section = $control->manager->get_setting('banner_options_main')->value();

    if($video_banner_section == 'video_banner_section'){
        return true;
    }else{
        return false;
    }
    }


function slider_callback($control){
  $banner_slider_option = $control->manager->get_setting('banner_options_main')->value();
  $banner_slider_section_option = $control->manager->get_setting('banner_slider_section_option')->value();
    if ($banner_slider_option == 'banner_slider_section_option' && $banner_slider_section_option == 'latest_post_show') {
        return true;
    }else{
        return false;
    }
}

function overlay_text($control){
    $banner_slider_option = $control->manager->get_setting('banner_options_main')->value();
    if($banner_slider_option == 'header_video' || $banner_slider_option == 'video_banner_section'){
        return true;
    }else{
       return false;
    }
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newspaperup_customize_register($wp_customize) {
    
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('custom_logo')->transport = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport 		= 'postMessage';
}
add_action('customize_register', 'newspaperup_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newspaperup_customize_preview_js() {
    wp_enqueue_media();
	wp_enqueue_script('newspaperup-customizer', get_template_directory_uri().'/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'newspaperup_customize_preview_js');

/************************* Theme Customizer with Sanitize function *********************************/
function newspaperup_theme_option( $wp_customize ){   
    $newspaperup_default = newspaperup_get_default_theme_options();

    function newspaperup_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
}
add_action('customize_register','newspaperup_theme_option');

if ( ! function_exists( 'newspaperup_get_social_icon_default' ) ) {

    function newspaperup_get_social_icon_default() {
        return apply_filters(
            'newspaperup_get_social_icon_default',
            json_encode(
                array(
                    array(
                        'icon_value' => 'fab fa-facebook',
                        'link'       => '#',
                        'id'         => 'customizer_repeater_header_social_001',
                    ),
                    array(
                        'icon_value' => 'fa-brands fa-x-twitter',
                        'link'       => '#',
                        'id'         => 'customizer_repeater_header_social_003',
                    ),
                    array(
                        'icon_value' => 'fab fa-instagram',
                        'link'       => '#',
                        'id'         => 'customizer_repeater_header_social_005',
                    ),
                    array(
                        'icon_value' => 'fab fa-youtube',
                        'link'       => '#',
                        'id'         => 'customizer_repeater_header_social_006',
                    ),
                    array(
                        'icon_value' => 'fab fa-telegram',
                        'link'       => '#',
                        'id'         => 'customizer_repeater_header_social_008',
                    ),
                )
            )
        );
    }
}
