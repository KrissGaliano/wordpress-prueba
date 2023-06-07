<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cetalog
 */

$cetalog_blog_btn = get_theme_mod( 'cetalog_blog_btn', 'Read more' );
$cetalog_blog_btn_switch = get_theme_mod( 'cetalog_blog_btn_switch', true );

?>

<?php if ( !empty( $cetalog_blog_btn_switch ) ): ?>
<div class="tp-read-blog__btn">
    <a href="<?php the_permalink();?>" class="tp-btn button-bounce-shine"><?php print esc_html( $cetalog_blog_btn );?></a>                               
</div>
<?php endif;?>
