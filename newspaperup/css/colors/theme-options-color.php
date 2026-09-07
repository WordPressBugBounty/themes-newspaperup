<?php
function theme_options_color() {

	// /*=================== Blog Post Color ===================*/	
	?>
  <style type="text/css"> 
    :root {
      --wrap-color: <?php echo esc_attr(newspaperup_get_option('body_background_color')); ?>;
    }
  /* Top Bar Color*/
  .bs-head-detail, .bs-latest-news .bn_title .title i {
    background: <?php echo esc_attr(get_theme_mod('top_bar_bg_color',''))?>;
  }
  .bs-head-detail, .bs-latest-news .bs-latest-news-slider a{
    color: <?php echo esc_attr(get_theme_mod('top_bar_color',''))?>;
  }
  /*==================== Site title and tagline ====================*/
  .site-title a, .site-description{
    color: <?php echo esc_attr(get_theme_mod('header_text_color', "000")); ?>;
  }
  body.dark .site-title a, body.dark .site-description{
    color: <?php echo esc_attr(get_theme_mod('header_text_dark_color', "#fff")); ?>;
  }
  /*=================== Blog Post Color ===================*/
  .site-branding-text .site-title a:hover{
    color: <?php echo esc_attr(get_theme_mod('header_text_color_on_hover',''))?> !important;
  }
  body.dark .site-branding-text .site-title a:hover{
    color: <?php echo esc_attr(get_theme_mod('header_text_dark_color_on_hover',''))?> !important;
  }
  /* Footer Color*/
  footer .bs-footer-copyright {
    background: <?php echo newspaperup_get_option('newspaperup_footer_copy_bg'); ?>;
  }
  footer .bs-widget p, footer .site-title a, footer .site-title a:hover , footer .site-description, footer .site-description:hover, footer .bs-widget h6, footer .mg_contact_widget .bs-widget h6 {
    color: <?php echo newspaperup_get_option('newspaperup_footer_text_color'); ?>;
  }
  footer .bs-footer-copyright p, footer .bs-footer-copyright a {
    color: <?php echo newspaperup_get_option('newspaperup_footer_copy_text'); ?>;
  }
  @media (min-width: 992px) {
      
      .archive-class .sidebar-right, .archive-class .sidebar-left , .index-class .sidebar-right, .index-class .sidebar-left{
        flex: 100;
        max-width:<?php echo esc_attr(get_theme_mod('newspaperup_archive_page_sidebar_width')); ?>% !important;
      }
      .archive-class .content-right , .index-class .content-right {
        max-width: calc((100% - <?php echo esc_attr(get_theme_mod('newspaperup_archive_page_sidebar_width')); ?>%)) !important;
      }
    }
  </style>
  <?php 
}
function newspaperup_customize_options() {
  // Initialize string
  $newspaperup_custom_css = '';

  if (get_theme_mod('enable_newspaperup_typo', false) == true) {
    $newspaperup_custom_css .= ':root {
                        --Fontheading:'. newspaperup_get_option('heading_fontfamily').';
                        --Weightheading:'. newspaperup_get_option('heading_fontweight').';
                        --Fontmenus:'. newspaperup_get_option('newspaperup_menu_fontfamily').';
                      }';
  }
  if ( ! empty( $newspaperup_custom_css ) ) {
      wp_add_inline_style( 'newspaperup-style', $newspaperup_custom_css );
  }
}