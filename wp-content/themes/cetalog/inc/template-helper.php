<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cetalog
 */

/** 
 *
 * cetalog header
 */

function cetalog_check_header() {
    $cetalog_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
    $cetalog_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );

    if ( $cetalog_header_style == 'header-style-1' ) {
        get_template_part( 'template-parts/header/header-1' );
    } 
    elseif ( $cetalog_header_style == 'header-style-2' ) {
        get_template_part( 'template-parts/header/header-2' );
    } 
    elseif ( $cetalog_header_style == 'header-style-3' ) {
        get_template_part( 'template-parts/header/header-3' );
    } 
    else {

        /** default header style **/
        if ( $cetalog_default_header_style == 'header-style-2' ) {
            get_template_part( 'template-parts/header/header-2' );
        } 
        elseif ( $cetalog_default_header_style == 'header-style-3' ) {
            get_template_part( 'template-parts/header/header-3' );
        }
        else {
            get_template_part( 'template-parts/header/header-1' );
        }
    }

}
add_action( 'cetalog_header_style', 'cetalog_check_header', 10 );


/**
 * [cetalog_header_lang description]
 * @return [type] [description]
 */
function cetalog_header_lang_defualt() {
    $cetalog_header_lang = get_theme_mod( 'cetalog_header_lang', false );
    if ( $cetalog_header_lang ): ?>

    <ul>
        <li><a href="javascript:void(0)" class="lang__btn"><?php print esc_html__( 'English', 'cetalog' );?> <i class="fa-light fa-angle-down"></i></a>
        <?php do_action( 'cetalog_language' );?>
        </li>
    </ul>

    <?php endif;?>
<?php
}

/**
 * [cetalog_language_list description]
 * @return [type] [description]
 */
function _cetalog_language( $mar ) {
    return $mar;
}
function cetalog_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul>';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul>';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'cetalog' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Bangla', 'cetalog' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'cetalog' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _cetalog_language( $mar );
}
add_action( 'cetalog_language', 'cetalog_language_list' );


// header logo
function cetalog_header_logo() { ?>
      <?php
        $cetalog_logo_on = function_exists( 'get_field' ) ? get_field( 'is_enable_sec_logo' ) : NULL;
        $cetalog_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $cetalog_logo_black = get_template_directory_uri() . '/assets/img/logo/logo-black.png';

        $cetalog_site_logo = get_theme_mod( 'logo', $cetalog_logo );
        $cetalog_secondary_logo = get_theme_mod( 'seconday_logo', $cetalog_logo_black );
      ?>

      <?php if ( !empty( $cetalog_logo_on ) ) : ?>
         <a class="secondary-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img src="<?php print esc_url( $cetalog_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'cetalog' );?>" />
         </a>
      <?php else : ?>
         <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img src="<?php print esc_url( $cetalog_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'cetalog' );?>" />
         </a>
      <?php endif; ?>
   <?php
}

// header logo
function cetalog_header_logo_white() {?>
    <?php
        $cetalog_logo_black = get_template_directory_uri() . '/assets/img/logo/logo-white.png';
        $cetalog_secondary_logo = get_theme_mod( 'seconday_logo', $cetalog_logo_black );
    ?>
      <a href="<?php print esc_url( home_url( '/' ) );?>">
          <img src="<?php print esc_url( $cetalog_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'cetalog' );?>" />
      </a>
    <?php
}

function cetalog_mobile_logo() {
    // side info
    $cetalog_mobile_logo_hide = get_theme_mod( 'cetalog_mobile_logo_hide', false );

    $cetalog_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

    ?>

    <?php if ( !empty( $cetalog_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $cetalog_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'cetalog' );?>" />
        </a>
    </div>
    <?php endif;?>



<?php }

/**
 * [cetalog_header_social_profiles description]
 * @return [type] [description]
 */
function cetalog_header_social_profiles() {
    $cetalog_topbar_fb_url = get_theme_mod( 'cetalog_topbar_fb_url', __( '#', 'cetalog' ) );
    $cetalog_topbar_twitter_url = get_theme_mod( 'cetalog_topbar_twitter_url', __( '#', 'cetalog' ) );
    $cetalog_topbar_linkedin_url = get_theme_mod( 'cetalog_topbar_linkedin_url', __( '#', 'cetalog' ) );
    $cetalog_topbar_instagram_url = get_theme_mod( 'cetalog_topbar_instagram_url', __( '#', 'cetalog' ) );
    $cetalog_topbar_youtube_url = get_theme_mod( 'cetalog_topbar_youtube_url', __( '#', 'cetalog' ) );
    $cetalog_topbar_skype_url = get_theme_mod( 'cetalog_topbar_skype_url', __( '#', 'cetalog' ) );
    ?>
    
        <?php if ( !empty( $cetalog_topbar_fb_url ) ): ?>
          <a href="<?php print esc_url( $cetalog_topbar_fb_url );?>"><span><i class="fa-brands fa-facebook-f"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $cetalog_topbar_twitter_url ) ): ?>
            <a href="<?php print esc_url( $cetalog_topbar_twitter_url );?>"><span><i class="fa-brands fa-twitter"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $cetalog_topbar_linkedin_url ) ): ?>
            <a href="<?php print esc_url( $cetalog_topbar_linkedin_url );?>"><span><i class="fa-brands fa-linkedin"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $cetalog_topbar_instagram_url ) ): ?>
            <a href="<?php print esc_url( $cetalog_topbar_instagram_url );?>"><span><i class="fa-brands fa-instagram"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $cetalog_topbar_youtube_url ) ): ?>
            <a href="<?php print esc_url( $cetalog_topbar_youtube_url );?>"><span><i class="fa-brands fa-youtube"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $cetalog_topbar_skype_url ) ): ?>
            <a href="<?php print esc_url( $cetalog_topbar_skype_url );?>"><span><i class="fa-brands fa-skype"></i></span></a>
        <?php endif;?>

<?php
}

function cetalog_footer_social_profiles() {
    $cetalog_footer_fb_url = get_theme_mod( 'cetalog_footer_fb_url', __( '#', 'cetalog' ) );
    $cetalog_footer_twitter_url = get_theme_mod( 'cetalog_footer_twitter_url', __( '#', 'cetalog' ) );
    $cetalog_footer_instagram_url = get_theme_mod( 'cetalog_footer_instagram_url', __( '#', 'cetalog' ) );
    $cetalog_footer_linkedin_url = get_theme_mod( 'cetalog_footer_linkedin_url', __( '#', 'cetalog' ) );
    $cetalog_footer_youtube_url = get_theme_mod( 'cetalog_footer_youtube_url', __( '#', 'cetalog' ) );
    ?>

        <ul>
        <?php if ( !empty( $cetalog_footer_fb_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $cetalog_footer_fb_url );?>">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $cetalog_footer_twitter_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $cetalog_footer_twitter_url );?>">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $cetalog_footer_instagram_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $cetalog_footer_instagram_url );?>">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $cetalog_footer_linkedin_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $cetalog_footer_linkedin_url );?>">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $cetalog_footer_youtube_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $cetalog_footer_youtube_url );?>">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif;?>
        </ul>
<?php
}

/**
 * [cetalog_header_menu description]
 * @return [type] [description]
 */
function cetalog_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'cetalog_Navwalker_Class::fallback',
            'walker'         => new cetalog_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [cetalog_header_menu description]
 * @return [type] [description]
 */
function cetalog_mobile_menu() {
    ?>
    <?php
        $cetalog_menu = wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'menu_id'        => 'mobile-menu-active',
            'echo'           => false,
        ] );

    $cetalog_menu = str_replace( "menu-item-has-children", "menu-item-has-children has-children", $cetalog_menu );
        echo wp_kses_post( $cetalog_menu );
    ?>
    <?php
}

/**
 * [cetalog_search_menu description]
 * @return [type] [description]
 */
function cetalog_header_search_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'header-search-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'cetalog_Navwalker_Class::fallback',
            'walker'         => new cetalog_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [cetalog_footer_menu description]
 * @return [type] [description]
 */
function cetalog_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0',
        'container'      => '',
        'fallback_cb'    => 'cetalog_Navwalker_Class::fallback',
        'walker'         => new cetalog_Navwalker_Class,
    ] );
}


/**
 * [cetalog_category_menu description]
 * @return [type] [description]
 */
function cetalog_category_menu() {
    wp_nav_menu( [
        'theme_location' => 'category-menu',
        'menu_class'     => 'cat-submenu m-0',
        'container'      => '',
        'fallback_cb'    => 'cetalog_Navwalker_Class::fallback',
        'walker'         => new cetalog_Navwalker_Class,
    ] );
}


/**
* cetalog elements footer
*/
function cetalog_element_footer_style($template_id) { ?>
    <div class="el-footer-area">
        <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($template_id, true); ?>
    </div>
<?php
}

// cetalog_check_footer
function cetalog_check_footer() {
    $cetalog_element_footer_switch = get_theme_mod('cetalog_element_footer_switch', false );
    if(!empty($cetalog_element_footer_switch)) {
        $element_footer_styles = function_exists('get_field') ? get_field( 'element_footer_styles' ) : NULL;
        if (!empty($element_footer_styles->ID)) {
            cetalog_element_footer_style($element_footer_styles->ID);
        }
        else{
            $template_id = get_theme_mod('choose_default_footer_el' );
            cetalog_element_footer_style($template_id);
        }
    }
    else{
        $cetalog_footer_style = function_exists( 'get_field' ) ? get_field( 'footer_style' ) : NULL;
        $cetalog_default_footer_style = get_theme_mod( 'choose_default_footer', 'footer-style-1' );

        if ( $cetalog_footer_style == 'footer-style-1' ) {
            get_template_part( 'template-parts/footer/footer-1' );
        } 
        elseif ( $cetalog_footer_style == 'footer-style-2' ) {
            get_template_part( 'template-parts/footer/footer-2' );
        } 
        elseif ( $cetalog_footer_style == 'footer-style-3' ) {
            get_template_part( 'template-parts/footer/footer-3' );
        }
        elseif ( $cetalog_footer_style == 'footer-style-4' ) {
            get_template_part( 'template-parts/footer/footer-4' );
        } else {

            /** default footer style **/
            if ( $cetalog_default_footer_style == 'footer-style-2' ) {
                get_template_part( 'template-parts/footer/footer-2' );
            } 
            elseif ( $cetalog_default_footer_style == 'footer-style-3' ) {
                get_template_part( 'template-parts/footer/footer-3' );
            } 
            elseif ( $cetalog_default_footer_style == 'footer-style-4' ) {
                get_template_part( 'template-parts/footer/footer-4' );
            } 
            else {
                get_template_part( 'template-parts/footer/footer-1' );
            }

        }
    }
}

/**
 *
 * cetalog footer
 */
add_action( 'cetalog_footer_style', 'cetalog_check_footer', 10 );


// cetalog_copyright_text
function cetalog_copyright_text() {
   print get_theme_mod( 'cetalog_copyright', esc_html__( '© 2023 Cetalog, All Rights Reserved. Design By Theme Pure', 'cetalog' ) );
}

/**
 *
 * pagination
 */
if ( !function_exists( 'cetalog_pagination' ) ) {

    function _cetalog_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function cetalog_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<nav class="read-pagination" aria-label="..."><ul class="pagination">';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li class="page-item">' . $pg . '</li>';
            }
            $pagi .= '</ul></nav>';
        }

        print _cetalog_pagi_callback( $pagi );
    }
}


// header top bg color
function cetalog_breadcrumb_bg_color() {
    $color_code = get_theme_mod( 'cetalog_breadcrumb_bg_color', '#222' );
    wp_enqueue_style( 'cetalog-custom', CETALOG_THEME_CSS_DIR . 'cetalog-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style( 'cetalog-breadcrumb-bg', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'cetalog_breadcrumb_bg_color' );

// breadcrumb-spacing top
function cetalog_breadcrumb_spacing() {
    $padding_px = get_theme_mod( 'cetalog_breadcrumb_spacing', '160px' );
    wp_enqueue_style( 'cetalog-custom', CETALOG_THEME_CSS_DIR . 'cetalog-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style( 'cetalog-breadcrumb-top-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'cetalog_breadcrumb_spacing' );

// breadcrumb-spacing bottom
function cetalog_breadcrumb_bottom_spacing() {
    $padding_px = get_theme_mod( 'cetalog_breadcrumb_bottom_spacing', '160px' );
    wp_enqueue_style( 'cetalog-custom', CETALOG_THEME_CSS_DIR . 'cetalog-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style( 'cetalog-breadcrumb-bottom-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'cetalog_breadcrumb_bottom_spacing' );

// scrollup
function cetalog_scrollup_switch() {
    $scrollup_switch = get_theme_mod( 'cetalog_scrollup_switch', false );
    wp_enqueue_style( 'cetalog-custom', CETALOG_THEME_CSS_DIR . 'cetalog-custom.css', [] );
    if ( $scrollup_switch ) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style( 'cetalog-scrollup-switch', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'cetalog_scrollup_switch' );

// theme color
function cetalog_custom_color() {
    $cetalog_theme_color_1 = get_theme_mod( 'cetalog_theme_color_1', '#162DE4' );
    $cetalog_theme_color_2 = get_theme_mod( 'cetalog_theme_color_2', '#030A39' );
    $cetalog_theme_color_3 = get_theme_mod( 'cetalog_theme_color_3', '#FF3A8A' );
    $cetalog_theme_color_4 = get_theme_mod( 'cetalog_theme_color_4', '#7924C8' );
    $cetalog_theme_head_color_1 = get_theme_mod( 'cetalog_theme_head_color_1', '#000D44' );
    $cetalog_theme_head_color_2 = get_theme_mod( 'cetalog_theme_head_color_2', '#52525C' );
    $cetalog_theme_body_color = get_theme_mod( 'cetalog_theme_body_color', '#727885' );
    $cetalog_theme_gra_1 = get_theme_mod( 'cetalog_theme_gra_1', '#00EEFF' );
    $cetalog_theme_gra_2 = get_theme_mod( 'cetalog_theme_gra_2', '#003CFF' );

    wp_enqueue_style( 'cetalog-custom', CETALOG_THEME_CSS_DIR . 'cetalog-custom.css', [] );
    
    if ( !empty($cetalog_theme_color_1)) {
        $custom_css = '';
        $custom_css .= "html:root{
            --tp-theme-primary: " . $cetalog_theme_color_1 . ";
            --tp-theme-secondary: " . $cetalog_theme_color_2 . ";
            --tp-heading-primary: " . $cetalog_theme_head_color_1 . ";
            --tp-text-body: " . $cetalog_theme_body_color . ";
            --tp-heading-secondary: " . $cetalog_theme_head_color_2 . ";
            --tp-gradient-primary: linear-gradient(180deg, ".$cetalog_theme_gra_1." 0%, ".$cetalog_theme_gra_2." 100%);
        }";
        $custom_css .= "body .tp-round-btn { background: " . $cetalog_theme_color_3 . "}";
        $custom_css .= "body .tp-btn-hover.alt-color b { background: " . $cetalog_theme_color_4 . "}";

        wp_add_inline_style( 'cetalog-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'cetalog_custom_color' );


// cetalog_kses_intermediate
function cetalog_kses_intermediate( $string = '' ) {
    return wp_kses( $string, cetalog_get_allowed_html_tags( 'intermediate' ) );
}

function cetalog_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function cetalog_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}


// / This code filters the Archive widget to include the post count inside the link /
add_filter( 'get_archives_link', 'cetalog_archive_count_span' );
function cetalog_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'cetalog_cat_count_span');
function cetalog_cat_count_span($links) {
  $links = str_replace('</a> (', '<span> (', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}


// post format
function cetalog_post_format(){
    $cetalog_audio_url = function_exists( 'get_field' ) ? get_field( 'format_style' ) : NULL;
    $gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';
    $cetalog_video_url = function_exists( 'get_field' ) ? get_field( 'format_style' ) : NULL;

    $cetalog_blog_single_social = get_theme_mod( 'cetalog_blog_single_social', false );
    $blog_tag_col = $cetalog_blog_single_social ? 'col-xl-7' : 'col-xl-12';
    ?>
    <!-- if post has image -->
    <?php if ( has_post_format('image') ): ?>
    <?php if(has_post_thumbnail()) : ?>
    <div class="tp-read-blog-thumb">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    </div>
    <?php endif; ?>
    <!-- if post has audio -->
    <?php elseif ( has_post_format('audio') ): ?>
    <?php if ( !empty( $cetalog_audio_url ) ): ?>
    <div class="tp-read-blog-thumb">
        <?php echo wp_oembed_get( $cetalog_audio_url ); ?>
    </div>
    <?php endif; ?>
    <!-- if post has video -->
    <?php elseif ( has_post_format('video') ): ?>
    <?php if ( has_post_thumbnail() ): ?>
    <div class="tp-read-blog-thumb p-relative">
        <a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?></a>
        <?php if(!empty($cetalog_video_url)) : ?>
        <div class="tp-blog-play">
            <a class="popup-video" href="<?php print esc_url( $cetalog_video_url );?>"><i class="fa-sharp fa-solid fa-play"></i></a>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <!-- if post has gallery -->
    <?php elseif ( has_post_format('gallery') ): ?>
    <?php if ( !empty( $gallery_images ) ): ?>
    <div class="tp-read-blog-active">
        <?php foreach ( $gallery_images as $key => $image ): ?>
        <div class="tp-read-blog-thumb">
            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"></a>
        </div>
        <?php endforeach;?>
    </div>
    <?php endif; ?>
    <!-- if post has standared -->
    <?php else : ?>
        <?php if(has_post_thumbnail()) : ?>
        <div class="tp-read-blog-thumb">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php
}


// blog single social share
function cetalog_blog_social_share(){

    $cetalog_singleblog_social = get_theme_mod( 'cetalog_singleblog_social', false );
    $post_url = get_the_permalink();
    $end_class = has_tag() ? 'text-lg-end' : 'text-lg-start';

    if(!empty($cetalog_singleblog_social)) : ?>    
    <div class="col-md-5">
       <div class="tp-blog-details-postbox__share <?php echo esc_attr($end_class); ?>">
          <span><?php echo esc_html__('Share On:', 'cetalog');?></span>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-facebook" ></i></a>
          <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
          <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a>
       </div>
    </div>
    <?php endif ; 

}