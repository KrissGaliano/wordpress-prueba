<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package cetalog
 */

get_header();
?>

<section class="postbox__area pt-120 pb-120">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xxl-6">
            <?php 
               $cetalog_error_title = get_theme_mod('cetalog_error_title', __('Page not found', 'cetalog'));
               $cetalog_error_link_text = get_theme_mod('cetalog_error_link_text', __('Back To Home', 'cetalog'));
               $cetalog_error_desc = get_theme_mod('cetalog_error_desc', __('Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'cetalog'));
            ?>
            <div class="error__item text-center">
               <div class="error__thumb">
                  <h4><?php echo esc_html__('404','cetalog'); ?></h4>
               </div>
               <div class="error__content">
                  <h3 class="error__title"><?php print esc_html($cetalog_error_title);?></h3>
                  <p><?php print esc_html($cetalog_error_desc);?></p>
                  <a href="<?php print esc_url(home_url('/'));?>" class="tp-btn button-bounce-shine mt-15"><?php print esc_html($cetalog_error_link_text);?></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
get_footer();
