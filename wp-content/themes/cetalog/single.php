<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cetalog
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

?>

<section class="postbox__area blog-single-area pt-100 pb-90">
    <div class="container container-large">
        <div class="row">
			<div class="col-lg-<?php print esc_attr( $blog_column );?>">
				<div class="postbox__wrapper postbox__details">
					<?php
						while ( have_posts() ):
						the_post();

						get_template_part( 'template-parts/content', get_post_format() );

    					?>

						<div class="tp-blog-detils-tag-box pt-20">
							<div class="row">

							<?php print cetalog_get_tag();?>

							<?php cetalog_blog_social_share(); ?>

							</div>
						</div>

						<?php echo get_template_part( 'template-parts/biography' );?>

						<?php

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ):
								comments_template();
							endif;

							endwhile; // End of the loop.
						?>
				</div>
			</div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
		        <div class="col-lg-4 col-12">
		        	<div class="tp-blog-left-box pl-25">
						<?php get_sidebar();?>
	            	</div>
	            </div>
			<?php endif;?>
		</div>
	</div>
</section>

<?php
get_footer();
