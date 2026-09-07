<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'newspaperup_theme_fonts',1 );
add_action( 'enqueue_block_editor_assets', 'newspaperup_theme_fonts',1 );
add_action( 'customize_preview_init', 'newspaperup_theme_fonts', 1 );

function newspaperup_theme_fonts() {
    $url = newspaperup_fonts_url();
    if ( $url ) {
        require_once get_theme_file_path( 'inc/ansar/font/wptt-webfont-loader.php' );
        wp_enqueue_style( 'newspaperup-theme-fonts', wptt_get_webfont_url( $url ), array(), NEWSPAPERUP_THEME_VERSION );
    }
}

function newspaperup_fonts_url() {
    $h = newspaperup_get_option( 'heading_fontfamily' );
    $hw = newspaperup_get_option( 'heading_fontweight' );
    $m = newspaperup_get_option( 'newspaperup_menu_fontfamily' );
    $mw = get_theme_mod( 'newspaperup_menu_fontweight', '500' );
    
    return add_query_arg( array(
        'family'  => implode( '|', array_unique( array( "$h:$hw,700", "$m:$mw,400", 'Lexend Deca:500,600','Outfit:400,500' ) ) ),
        'subset'  => 'latin,latin-ext',
        'display' => 'swap',
    ), 'https://fonts.googleapis.com/css' );
}