<?php
    $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
    
    $cetalog_facebook = get_the_author_meta( 'cetalog_facebook' );
    $cetalog_twitter = get_the_author_meta( 'cetalog_twitter' );
    $cetalog_behance = get_the_author_meta( 'cetalog_behance' );
    $cetalog_linkedin = get_the_author_meta( 'cetalog_linkedin' );
    $cetalog_instagram = get_the_author_meta( 'cetalog_instagram' );
    $cetalog_youtube = get_the_author_meta( 'cetalog_youtube' );

    $deef_write_by = get_the_author_meta( 'deef_write_by' );
    $author_bio_avatar_size = 180;
    if ( $author_data != '' ):
?>

    <div class="tp-blog-details-comment">
        <div class="tp-blog-details-comment-wrapper d-flex">
            <div class="tp-blog-details-comment-thumb">
                <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>  
            </div>
            <div class="tp-blog-details-comment-content">
                <h5><?php print get_the_author(); ?></h5>
                <p><?php the_author_meta( 'description' );?></p>
                <div class="tp-blog-details-postbox__share">
                    <?php if(!empty($cetalog_facebook)) : ?>
                    <a href="<?php echo esc_url($cetalog_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($cetalog_twitter)) : ?>
                    <a href="<?php echo esc_url($cetalog_twitter); ?>"><i class="fab fa-twitter"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($cetalog_behance)) : ?>
                    <a href="<?php echo esc_url($cetalog_behance); ?>"><i class="fab fa-behance-square"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($cetalog_linkedin)) : ?>
                    <a href="<?php echo esc_url($cetalog_linkedin); ?>"><i class="fab fa-linkedin"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($cetalog_instagram)) : ?>
                    <a href="<?php echo esc_url($cetalog_instagram); ?>"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($cetalog_youtube)) : ?>
                    <a href="<?php echo esc_url($cetalog_youtube); ?>"><i class="fab fa-youtube"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif;?>