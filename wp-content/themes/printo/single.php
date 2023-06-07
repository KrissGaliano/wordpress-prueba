<?php
/**
 * The template to display single post
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */

// Full post loading
$full_post_loading          = printo_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = printo_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = printo_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$printo_related_position   = printo_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$printo_posts_navigation   = printo_get_theme_option( 'posts_navigation' );
$printo_prev_post          = false;
$printo_prev_post_same_cat = printo_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( printo_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	printo_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'printo_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $printo_posts_navigation ) {
		$printo_prev_post = get_previous_post( $printo_prev_post_same_cat );  // Get post from same category
		if ( ! $printo_prev_post && $printo_prev_post_same_cat ) {
			$printo_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $printo_prev_post ) {
			$printo_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $printo_prev_post ) ) {
		printo_sc_layouts_showed( 'featured', false );
		printo_sc_layouts_showed( 'title', false );
		printo_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $printo_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/content', 'single-' . printo_get_theme_option( 'single_style' ) ), 'single-' . printo_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $printo_related_position, 'inside' ) === 0 ) {
		$printo_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'printo_action_related_posts' );
		$printo_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $printo_related_content ) ) {
			$printo_related_position_inside = max( 0, min( 9, printo_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $printo_related_position_inside ) {
				$printo_related_position_inside = mt_rand( 1, 9 );
			}

			$printo_p_number         = 0;
			$printo_related_inserted = false;
			$printo_in_block         = false;
			$printo_content_start    = strpos( $printo_content, '<div class="post_content' );
			$printo_content_end      = strrpos( $printo_content, '</div>' );

			for ( $i = max( 0, $printo_content_start ); $i < min( strlen( $printo_content ) - 3, $printo_content_end ); $i++ ) {
				if ( $printo_content[ $i ] != '<' ) {
					continue;
				}
				if ( $printo_in_block ) {
					if ( strtolower( substr( $printo_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$printo_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $printo_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $printo_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$printo_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $printo_content[ $i + 1 ] && in_array( $printo_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$printo_p_number++;
					if ( $printo_related_position_inside == $printo_p_number ) {
						$printo_related_inserted = true;
						$printo_content = ( $i > 0 ? substr( $printo_content, 0, $i ) : '' )
											. $printo_related_content
											. substr( $printo_content, $i );
					}
				}
			}
			if ( ! $printo_related_inserted ) {
				if ( $printo_content_end > 0 ) {
					$printo_content = substr( $printo_content, 0, $printo_content_end ) . $printo_related_content . substr( $printo_content, $printo_content_end );
				} else {
					$printo_content .= $printo_related_content;
				}
			}
		}

		printo_show_layout( $printo_content );
	}

	// Comments
	do_action( 'printo_action_before_comments' );
	comments_template();
	do_action( 'printo_action_after_comments' );

	// Related posts
	if ( 'below_content' == $printo_related_position
		&& ( 'scroll' != $printo_posts_navigation || printo_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || printo_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'printo_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $printo_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $printo_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $printo_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $printo_prev_post ) ); ?>"
			<?php do_action( 'printo_action_nav_links_single_scroll_data', $printo_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
