<?php 

   /**
    * Template part for displaying header side information
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package cetalog
   */

    $cetalog_side_hide = get_theme_mod( 'cetalog_side_hide', false );
    $header_social_switch = get_theme_mod( 'header_social_switch', false );
    $cetalog_side_logo = get_theme_mod( 'cetalog_side_logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );
    $cetalog_side_title = get_theme_mod('cetalog_side_title', 'ELEVATE YOUR BUSINESS WITH');
    $cetalog_side_text = get_theme_mod( 'cetalog_side_text', __( 'Limitless customization options & Elementor compatibility let.', 'cetalog' ) );
    $cetalog_side_img = get_theme_mod( 'cetalog_side_img');
    $cetalog_side_button_title = get_theme_mod('cetalog_side_button_title', __('GET IN TOUCH', 'cetalog'));
    $cetalog_side_button_link = get_theme_mod('cetalog_side_button_link', __('#', 'cetalog'));
    $cetalog_side_phone = get_theme_mod( 'cetalog_side_phone', __( '+0989787698659', 'cetalog' ) );
    $cetalog_side_email = get_theme_mod( 'cetalog_side_email', __( 'info@themepure.net', 'cetalog' ) );
?>




<!-- mobile menu style start -->
<div class="tp-offcanvas-area fix">
   <div class="tp-side-info">

      <?php if(!empty($cetalog_side_hide)) : ?>
      <div class="tp-side-logo">
            <a href="<?php echo esc_url( home_url( '/' ) );?>">
               <img src="<?php echo esc_url($cetalog_side_logo); ?>" alt="logo">
            </a>
      </div>
      <?php endif; ?>

      <div class="tp-side-close">
            <button> <i class="fa-thin fa-xmark"></i></button>
      </div>

      <div class="tp-mobile-menu-pos"></div>

      <?php if(!empty($cetalog_side_hide)) : ?>
      <div class="tp-side-content p-relative">
            <?php if(!empty($cetalog_side_title)) : ?>
            <h3 class="tp-side-title d-none d-xl-block"><?php echo cetalog_kses($cetalog_side_title); ?></h3>
            <?php endif; ?>
            <?php if(!empty($cetalog_side_text)) : ?>
            <p class="d-none d-xl-block"><?php echo cetalog_kses($cetalog_side_text); ?></p>
            <?php endif; ?>
            <div class="tp-side-content-inner-content">
               <?php if(!empty($cetalog_side_img)) : ?>
               <div class="tp-side-thumb text-center d-none d-xl-block">
                  <img src="<?php echo esc_url($cetalog_side_img); ?>" alt="side-img">
               </div>
               <?php endif; ?>
               <?php if(!empty($cetalog_side_button_title)) : ?>
               <div class="tp-side-btn text-xl-center mb-80">
                  <a class="tp-btn" href="<?php echo esc_url($cetalog_side_button_link); ?>"><?php echo cetalog_kses($cetalog_side_button_title); ?></a>
               </div>
               <?php endif; ?>
               <div class="tp-side-contact mb-40">
                  <?php if(!empty($cetalog_side_phone)) : ?>
                  <p class="call">
                     <?php echo cetalog_kses($cetalog_side_phone); ?>
                  </p>
                  <?php endif; ?>
                  <?php if(!empty($cetalog_side_email)) : ?>
                  <p class="mail">
                     <?php echo cetalog_kses($cetalog_side_email); ?>
                  </p>
                  <?php endif; ?>
               </div>
               <?php if(!empty($header_social_switch)) : ?>
               <div class="tp-footer-social-1">
                  <?php cetalog_header_social_profiles(); ?>
               </div>
               <?php endif; ?>
            </div>
      </div>
      <?php endif; ?>

   </div>
   <div class="offcanvas-overlay"></div>
</div>
<!-- mobile menu style end -->

<!-- search popup start -->
<div class="search__popup">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="search__wrapper">
                    <div class="search__top d-flex justify-content-between align-items-center">
                        <div class="search__logo">
                           <?php cetalog_header_logo();?>
                        </div>
                        <div class="search__close">
                            <button type="button" class="search__close-btn search-close-btn">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="search__form">
                        <?php cetalog_search_form(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="search-popup-overlay"></div>
<!-- search popup end -->
