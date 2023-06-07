<?php 

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cetalog
*/

$cetalog_footer_menu = get_theme_mod( 'cetalog_footer_menu');
$cetalog_footer_bg_url_from_page = function_exists( 'get_field' ) ? get_field( 'cetalog_footer_bg' ) : '';
$cetalog_footer_bg_color_from_page = function_exists( 'get_field' ) ? get_field( 'cetalog_footer_bg_color' ) : '';
$cetalog_footer_bottom_border_color = function_exists( 'get_field' ) ? get_field( 'cetalog_footer_bottom_border_color' ) : '';
$footer_bg_color = get_theme_mod( 'cetalog_footer_bg_color', '#1A1819' );

$footer_bg_img = get_theme_mod( 'cetalog_footer_bg' );
// bg image
$bg_img = !empty( $cetalog_footer_bg_url_from_page['url'] ) ? $cetalog_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color = !empty( $cetalog_footer_bg_color_from_page ) ? $cetalog_footer_bg_color_from_page : $footer_bg_color;

$footer_bg = !empty($bg_img) ? "background: url($bg_img)" : "background: $bg_color";

$bottom_border = $cetalog_footer_bottom_border_color ? $cetalog_footer_bottom_border_color : '#323232';

// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-' . $num ) ) {
        $footer_columns++;
    }
}

switch ( $footer_columns ) {
case '1':
    $footer_class[1] = 'col-lg-12';
    break;
case '2':
    $footer_class[1] = 'col-lg-6 col-md-6';
    $footer_class[2] = 'col-lg-6 col-md-6';
    break;
case '3':
    $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
    $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
    $footer_class[3] = 'col-xl-4 col-lg-6';
    break;
case '4':
    $footer_class[1] = 'col-xl-3 col-lg-3 col-sm-6 col-12';
    $footer_class[2] = 'col-xl-3 col-lg-3 col-sm-6 col-12';
    $footer_class[3] = 'col-xl-3 col-lg-3 col-sm-6 col-12';
    $footer_class[4] = 'col-xl-3 col-lg-3 col-sm-6 col-12';
    break;
default:
    $footer_class = 'col-lg-3 col-md-6';
    break;
}

?>


<footer class="p-relative include-bg fix" style="<?php echo esc_attr($footer_bg);?>">
    <div class="tp-footer-area-3">
        <?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4') ): ?>
        <div class="tp-footer-top-widget-3 p-relative pt-115" style="border-color:<?php echo esc_attr($bottom_border); ?>">
            <div class="container container-large">
                <div class="row">

                    <?php
                        if ( $footer_columns < 4 ) {
                        print '<div class="col-xl-3 col-lg-3 col-sm-6 col-12">';
                        dynamic_sidebar( 'footer-1' );
                        print '</div>';

                        print '<div class="col-xl-3 col-lg-3 col-sm-6 col-12">';
                        dynamic_sidebar( 'footer-2' );
                        print '</div>';

                        print '<div class="col-xl-3 col-lg-3 col-sm-6 col-12">';
                        dynamic_sidebar( 'footer-3' );
                        print '</div>';

                        print '<div class="col-xl-3 col-lg-3 col-sm-6 col-12">';
                        dynamic_sidebar( 'footer-4' );
                        print '</div>';
                        } else {
                            for ( $num = 1; $num <= $footer_columns; $num++ ) {
                                if ( !is_active_sidebar( 'footer-' . $num ) ) {
                                    continue;
                                }
                                print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                dynamic_sidebar( 'footer-' . $num );
                                print '</div>';
                            }
                        }
                    ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="tp-footer-bottom-widget ">
            <div class="container container-large">
                <div class="tp-footer-copyright-2">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="tp-footer-copyright-inner-2 pb-20">
                                <p><?php echo cetalog_copyright_text(); ?></p>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <?php if(!empty($cetalog_footer_menu)) : ?>
                            <div class="tp-footer-copyright-link-2 text-lg-end pb-20">
                                <?php echo cetalog_kses($cetalog_footer_menu); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>