<?php

/**
 * cetalog_scripts description
 * @return [type] [description]
 */
function cetalog_scripts() {

    /**
     * all css files
    */

    wp_enqueue_style( 'cetalog-fonts', cetalog_fonts_url(), array(), time() );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', CETALOG_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', CETALOG_THEME_CSS_DIR.'bootstrap.css', array() );
    }
    wp_enqueue_style( 'meanmenu', CETALOG_THEME_CSS_DIR . 'meanmenu.css', [] );
    wp_enqueue_style( 'animate', CETALOG_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'swiper', CETALOG_THEME_CSS_DIR . 'swiper-bundle.css', [] );
    wp_enqueue_style( 'slick', CETALOG_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'nouislider', CETALOG_THEME_CSS_DIR . 'nouislider.css', [] );
    wp_enqueue_style( 'magnific-popup', CETALOG_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'font-awesome-pro', CETALOG_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'spacing', CETALOG_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'hover-reveal', CETALOG_THEME_CSS_DIR . 'hover-reveal.css', [] );
    wp_enqueue_style( 'nice-select', CETALOG_THEME_CSS_DIR . 'nice-select.css', [] );
    wp_enqueue_style( 'cetalog-core', CETALOG_THEME_CSS_DIR . 'cetalog-core.css', [], time() );
    wp_enqueue_style( 'cetalog-unit', CETALOG_THEME_CSS_DIR . 'cetalog-unit.css', [], time() );
    wp_enqueue_style( 'cetalog-custom', CETALOG_THEME_CSS_DIR . 'cetalog-custom.css', [], time() );
    wp_enqueue_style( 'cetalog-style', get_stylesheet_uri() );

    // all js
    wp_enqueue_script( 'waypoints', CETALOG_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'bootstrap-bundle', CETALOG_THEME_JS_DIR . 'bootstrap-bundle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'meanmenu', CETALOG_THEME_JS_DIR . 'meanmenu.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'swiper-bundle', CETALOG_THEME_JS_DIR . 'swiper-bundle.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'slick', CETALOG_THEME_JS_DIR . 'slick.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'nouislider', CETALOG_THEME_JS_DIR . 'nouislider.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'magnific-popup', CETALOG_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'parallax', CETALOG_THEME_JS_DIR . 'parallax.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'nice-select', CETALOG_THEME_JS_DIR . 'nice-select.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'purecounter', CETALOG_THEME_JS_DIR . 'purecounter.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wow', CETALOG_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'charming', CETALOG_THEME_JS_DIR . 'charming.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'tween-max', CETALOG_THEME_JS_DIR . 'tween-max.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'hover-reveal', CETALOG_THEME_JS_DIR . 'hover-reveal.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope-pkgd', CETALOG_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'cetalog-main', CETALOG_THEME_JS_DIR . 'main.js', [ 'jquery' ], time(), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'cetalog_scripts' );

/*
Register Fonts
 */
function cetalog_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'cetalog' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?'. urlencode('family=Montserrat+Alternates:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap');
    }
    return $font_url;
}