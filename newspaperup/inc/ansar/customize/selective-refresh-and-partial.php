<?php
function newspaperup_selective_refresh( $wp_customize ) {
	
	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'        => '.site-title a , .site-title-footer a',
            'render_callback' => 'newspaperup_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'        => '.site-description , .site-description-footer',
            'render_callback' => 'newspaperup_customize_partial_blogdescription',
        ));
		$wp_customize->selective_refresh->add_partial('custom_logo', array(
			'selector'        => '.site-logo', 
			'render_callback' => 'custom_logo_selective_refresh'
		));
        $wp_customize->selective_refresh->add_partial('newspaperup_social_icons', array(
            'selector'        => 'footer .bs-social ',
        ));
        $wp_customize->selective_refresh->add_partial('newspaperup_scrollup_enable', array(
            'selector'        => '.bs_upscr',
        ));
        $wp_customize->selective_refresh->add_partial('you_missed_title', array(
            'selector'          => '.missed .bs-widget-title',
            'render_callback'   => 'newspaperup_customize_partial_you_missed_title',
        ));
        $wp_customize->selective_refresh->add_partial('sidebar_menu', array(
            'selector'        => '.navbar-wp [data-bs-toggle=offcanvas]',
            'render_callback' => 'newspaperup_customize_partial_sidebar_menu',
        ));
        $wp_customize->selective_refresh->add_partial('newspaperup_related_post_title', array(
            'selector'        => '.bs-related-post-info .mb-3 .title',
            'render_callback' => 'newspaperup_customize_partial_newspaperup_related_post_title',
        ));
        $wp_customize->selective_refresh->add_partial('newspaperup_menu_search', array(
            'selector'        => '.desk-header .right-nav a',
            'render_callback' => 'newspaperup_customize_partial_newspaperup_menu_search',
        ));
        $wp_customize->selective_refresh->add_partial('newspaperup_lite_dark_switcher', array(
            'selector'        => '.switch .slider',    
        ));
        $wp_customize->selective_refresh->add_partial('single_post_meta', array(
            'selector'        => '.bs-blog-post .bs-header .bs-blog-meta ',
        )); 
        $wp_customize->selective_refresh->add_partial('newspaperup_drop_caps_enable', array(
            'selector'        => '.content-right .bs-blog-post .bs-blog-meta', 
        ));   
        $wp_customize->selective_refresh->add_partial('hide_copyright', array(
            'selector'        => '.bs-footer-copyright .container', 
        ));   
        $wp_customize->selective_refresh->add_partial('newspaperup_main_banner_section_background_image', array(
            'selector'        => '.homemain .bs-blog-post.three .bs-blog-meta', 
        ));
        $wp_customize->selective_refresh->add_partial('newspaperup_archive_page_layout', array(
            'selector'        => '.index-class .row, .archive-class > .container > .row', 
            'render_callback' => 'newspaperup_customize_partial_archive_page'
        ));    
        $wp_customize->selective_refresh->add_partial('newspaperup_single_page_layout', array(
            'selector'        => '.single-class > .container .page-entry-title + .row', 
            'render_callback' => 'newspaperup_customize_partial_single_page'
        ));    
        $wp_customize->selective_refresh->add_partial('newspaperup_page_layout', array(
            'selector'        => '.page-class > .container > .row', 
            'render_callback' => 'newspaperup_customize_partial_page'
        ));
        $wp_customize->selective_refresh->add_partial('breaking_news_title', array(
            'selector'        => '.bs-latest-news .bn_title .title span', 
            'render_callback' => 'newspaperup_customize_partial_breaking_news_title'
        ));
	}
}
add_action( 'customize_register', 'newspaperup_selective_refresh' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function newspaperup_customize_partial_blogname() {
	bloginfo('name');
}

function newspaperup_customize_partial_blogdescription() {
	bloginfo('description');
}

function custom_logo_selective_refresh() {
	if( get_theme_mod( 'custom_logo' ) === "" ) return;
	echo '<div id="site-logo">'.the_custom_logo().'</div>';
}

function newspaperup_customize_partial_footer_social_icon_enable() {
    return get_theme_mod( 'newspaperup_social_icons' ); 
}

function newspaperup_customize_partial_newspaperup_related_post_title() {
    return get_theme_mod( 'newspaperup_related_post_title' ); 
}

function newspaperup_customize_partial_you_missed_title() {
	if( get_theme_mod( 'you_missed_title' ) === "" ) return;
	echo '<h2 class="title">'.get_theme_mod( 'you_missed_title' ).'</h2>';
}

function newspaperup_customize_partial_sidebar_menu() {
    return get_theme_mod( 'sidebar_menu' ); 
}

function newspaperup_customize_partial_breaking_news_title() {
    return get_theme_mod( 'breaking_news_title' ); 
}

function newspaperup_customize_partial_newspaperup_menu_subscriber() {
    return get_theme_mod( 'newspaperup_menu_subscriber' ); 
}

function newspaperup_customize_partial_archive_page() {
    do_action('newspaperup_action_main_content_layouts');
}

function newspaperup_customize_partial_single_page() {
    do_action('newspaperup_action_single_main_content_layouts');
}

function newspaperup_customize_partial_page() {
    get_template_part('sections/page','data'); 
}
