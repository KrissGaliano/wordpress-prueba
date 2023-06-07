<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cetalog_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_style_2_switch', false );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'cetalog' ),
        'id'            => 'blog-sidebar',
        'description'          => esc_html__( 'Set Your Blog Widget', 'cetalog' ),
        'before_widget' => '<div id="%1$s" class="sidebar__widget tp-read-blog__search-box mb-40 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="sidebar__widget-title">',
        'after_title'   => '</h3>',
    ] );


    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'cetalog' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'cetalog' ), $num ),
            'before_widget' => '<div id="%1$s" class="tp-footer__widget default-footer tp-footer-widget-3 mb-40 tp-space-col-'.$num.' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<span class="tp-footer-widget__title">',
            'after_title'   => '</span>',
        ] );
    }

    // footer 2
    if ( $footer_style_2_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'cetalog' ), $num ),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'cetalog' ), $num ),
                'before_widget' => '<div id="%1$s" class="tp-footer__widget secondary-footer tp-footer-widget-3 mb-40 tp-space-col-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<span class="tp-footer-widget__title">',
                'after_title'   => '</span>',
            ] );
        }
    }    
}
add_action( 'widgets_init', 'cetalog_widgets_init' );