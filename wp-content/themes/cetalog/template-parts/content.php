<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cetalog
 */

$cetalog_audio_url = function_exists( 'get_field' ) ? get_field( 'format_style' ) : NULL;
$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';
$cetalog_video_url = function_exists( 'get_field' ) ? get_field( 'format_style' ) : NULL;

$cetalog_blog_single_social = get_theme_mod( 'cetalog_blog_single_social', false );
$blog_tag_col = $cetalog_blog_single_social ? 'col-xl-7' : 'col-xl-12';

$postFormat = '';

// post has image
if ( has_post_format('image') ){
    $postFormat = 'format-image';
} 
// post has audio
elseif ( has_post_format('audio') ){
    $postFormat = 'format-audio';
} 
// post has video
elseif ( has_post_format('video') ){
    $postFormat = 'format-video';
} 
// post has gallery
elseif ( has_post_format('gallery') ){
    $postFormat = 'format-gallery';
} 
// post has standared
else {
    $postFormat = 'format-standared';
}

$thumbnail_class = has_post_thumbnail() ? NULL : 'no-thumbnail';


if ( is_single() ) : ?>

<article id="post-<?php the_ID();?>" <?php post_class( "postbox__item tp-read-blog-items mb-20 $thumbnail_class" );?> >

    <?php cetalog_post_format(); ?>

    <div class="postbox__details-content-wrapper postbox__content postbox__text fix tp-read-blog-content">
        
        <!-- blog meta -->
        <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
        <?php the_content();?>
        <?php
            wp_link_pages( [
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'cetalog' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ] );
        ?>

    </div>

</article>


<?php else: ?>

<article id="post-<?php the_ID();?>" <?php post_class( "postbox__item tp-read-blog-items mb-50 $thumbnail_class"  );?> >

    <?php cetalog_post_format(); ?>

    <div class="tp-read-blog-content">
        <!-- blog meta -->
        <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
        <h3 class="tp-read-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php the_excerpt();?>
        <!-- blog btn -->
        <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
    </div>
</article>



<?php endif;?>