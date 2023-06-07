<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cetalog
 */
?>

<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
   <!-- theme style switch -->
   <meta name="theme-style-mode" content="1">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>

    <?php wp_body_open();?>


    <?php
        $cetalog_preloader = get_theme_mod( 'cetalog_preloader', false );
        $cetalog_backtotop = get_theme_mod( 'cetalog_backtotop', false );
        $preloader_logo = get_theme_mod('preloader_logo', get_template_directory_uri() . '/assets/img/logo/favicon.png');
        $cetalog_line_wrapper = function_exists( 'get_field' ) ? get_field( 'active_line_wrapper' ) : NULL;
    ?>

    <?php if ( !empty( $cetalog_preloader ) ): ?>
    <!-- pre loader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <!-- loading content here -->
                <div class="loading-content text-center">
                    <div class="loading-logo mb-40 m-img">
                        <img src="<?php echo esc_url($preloader_logo); ?>" alt="preloader-logo">
                    </div>
                    <div class="loading-text">
                        <span class="loading__letter">L</span>
                        <span class="loading__letter">o</span>
                        <span class="loading__letter">a</span>
                        <span class="loading__letter">d</span>
                        <span class="loading__letter">i</span>
                        <span class="loading__letter">n</span>
                        <span class="loading__letter">g</span>
                        <span class="loading__letter">.</span>
                        <span class="loading__letter">.</span>
                        <span class="loading__letter">.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- pre loader area end -->
    <?php endif;?>

    <?php if(!empty($cetalog_line_wrapper)) : ?>
    <!-- page line wrapper -->
    <div class="tp-line-wrapper d-none d-md-block">
        <div class="tp-line-item"></div>
        <div class="tp-line-item"></div>
        <div class="tp-line-item"></div>
        <div class="tp-line-item"></div>
        <div class="tp-line-item"></div>
        <div class="tp-line-item"></div>
        <div class="tp-line-item"></div>
        <div class="tp-line-item"></div>
    </div>
    <!-- page line wrapper -->
    <?php endif; ?>

   <?php if(!empty($cetalog_backtotop)) : ?>
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
        </button>
   </div>
   <?php endif; ?>

    
    <!-- header start -->
    <?php do_action( 'cetalog_header_style' );?>
    <!-- header end -->
    
    <!-- wrapper-box start -->
    <?php do_action( 'cetalog_before_main_content' );?>