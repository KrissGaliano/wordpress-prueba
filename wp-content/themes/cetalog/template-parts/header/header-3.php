<?php 

   /**
    * Template part for displaying header layout two
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package cetalog
   */

	// info
   $cetalog_search = get_theme_mod( 'cetalog_search', false );

   // header right
   $cetalog_header_right = get_theme_mod( 'cetalog_header_right', false );
   $cetalog_menu_col = !empty($cetalog_header_right) ? 'col-xl-6 d-none d-xl-block' : 'col-xl-10 d-none d-xl-block text-end';
   $cetalog_menu_justify = !empty($cetalog_header_right) ? NULL : 'justify-content-end';
   $cetalog_side_hide = get_theme_mod( 'cetalog_side_hide', false );

   // button 1
   $cetalog_hbtn1_title = get_theme_mod('cetalog_hbtn1_title', __('Login', 'cetalog'));
   $cetalog_hbtn1_url = get_theme_mod('cetalog_hbtn1_url', '#');

   // button 2
   $cetalog_hbtn2_title = get_theme_mod('cetalog_hbtn2_title', __('Contact Us', 'cetalog'));
   $cetalog_hbtn2_url = get_theme_mod('cetalog_hbtn2_url', '#');

?>

<header id="header-sticky" class="tp-header-transparent home-3-sticky header__sticky">
   <div class="tp-header-area tp-header-space-3 p-relative z-index-1">
      <div class="container-fluid">
         <div class="row align-items-center">
            <div class="col-6 col-xl-2">
               <div class="tp-header-logo">
                  <?php cetalog_header_logo();?>
               </div>
            </div>
            <div class="col-xl-6 d-none d-xl-block">
               <div class="tp-main-menu-area d-flex align-items-center">
                  <div class="tp-main-menu home-3 d-none d-xl-block">
                     <nav id="tp-mobile-menu">
                        <?php cetalog_header_menu();?>
                     </nav>
                  </div>
               </div>
            </div>
            <?php if(!empty($cetalog_header_right)) : ?>
            <div class="col-lg-6 col-xl-4 d-none d-lg-block">
               <div class="tp-header-right-3 d-flex align-items-center justify-content-end">
                  <?php if(!empty($cetalog_search)) : ?>
                  <div class="tp-header-search home-3 search-open-btn">
                     <a href="javascript:void(0);"><i class="fa-regular fa-magnifying-glass"></i></a>
                  </div>
                  <?php endif; ?>
                  <?php if(!empty($cetalog_hbtn1_title)) : ?>
                  <div class="tp-header-login home-3 ml-20">
                     <a href="<?php echo esc_url($cetalog_hbtn1_url); ?>"><?php echo cetalog_kses($cetalog_hbtn1_title); ?></a>
                  </div>
                  <?php endif; ?>
                  <?php if(!empty($cetalog_hbtn2_title)) : ?>
                  <div class="tp-header-btn d-flex ml-20">
                     <a class="tp-btn-black shine-effect" href="<?php echo esc_url($cetalog_hbtn2_url); ?>"><?php echo cetalog_kses($cetalog_hbtn2_title); ?></a>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
            <?php endif; ?>
            <div class="mobile-menu home3-hamburger-color d-xl-none">
               <button class="tp-side-action tp-toogle hamburger-btn">
                  <span></span>
                  <span></span>
                  <span></span>
               </button>
            </div>
         </div>
      </div>
   </div>
</header>

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>