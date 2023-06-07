<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */

$printo_template_args = get_query_var( 'printo_template_args' );
$printo_columns = 1;
if ( is_array( $printo_template_args ) ) {
	$printo_columns    = empty( $printo_template_args['columns'] ) ? 1 : max( 1, $printo_template_args['columns'] );
	$printo_blog_style = array( $printo_template_args['type'], $printo_columns );
	if ( ! empty( $printo_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $printo_columns > 1 ) {
	    $printo_columns_class = printo_get_column_class( 1, $printo_columns, ! empty( $printo_template_args['columns_tablet']) ? $printo_template_args['columns_tablet'] : '', ! empty($printo_template_args['columns_mobile']) ? $printo_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $printo_columns_class ); ?>">
		<?php
	}
}
$printo_expanded    = ! printo_sidebar_present() && printo_get_theme_option( 'expand_content' ) == 'expand';
$printo_post_format = get_post_format();
$printo_post_format = empty( $printo_post_format ) ? 'standard' : str_replace( 'post-format-', '', $printo_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $printo_post_format ) );
	printo_add_blog_animation( $printo_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$printo_hover      = ! empty( $printo_template_args['hover'] ) && ! printo_is_inherit( $printo_template_args['hover'] )
							? $printo_template_args['hover']
							: printo_get_theme_option( 'image_hover' );
	$printo_components = ! empty( $printo_template_args['meta_parts'] )
							? ( is_array( $printo_template_args['meta_parts'] )
								? $printo_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $printo_template_args['meta_parts'] ) )
								)
							: printo_array_get_keys_by_value( printo_get_theme_option( 'meta_parts' ) );
	printo_show_post_featured( apply_filters( 'printo_filter_args_featured',
		array(
			'no_links'   => ! empty( $printo_template_args['no_links'] ),
			'hover'      => $printo_hover,
			'meta_parts' => $printo_components,
			'thumb_size' => ! empty( $printo_template_args['thumb_size'] )
							? $printo_template_args['thumb_size']
							: printo_get_thumb_size( strpos( printo_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $printo_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$printo_template_args
	) );

	// Title and post meta
	$printo_show_title = get_the_title() != '';
	$printo_show_meta  = count( $printo_components ) > 0 && ! in_array( $printo_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $printo_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'printo_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'printo_action_before_post_title' );
				if ( empty( $printo_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'printo_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'printo_filter_show_blog_excerpt', empty( $printo_template_args['hide_excerpt'] ) && printo_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'printo_filter_show_blog_meta', $printo_show_meta, $printo_components, 'excerpt' ) ) {
				if ( count( $printo_components ) > 0 ) {
					do_action( 'printo_action_before_post_meta' );
					printo_show_post_meta(
						apply_filters(
							'printo_filter_post_meta_args', array(
								'components' => join( ',', $printo_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'printo_action_after_post_meta' );
				}
			}

			if ( printo_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'printo_action_before_full_post_content' );
					the_content( '' );
					do_action( 'printo_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'printo' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'printo' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				printo_show_post_content( $printo_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'printo_filter_show_blog_readmore',  ! isset( $printo_template_args['more_button'] ) || ! empty( $printo_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $printo_template_args['no_links'] ) ) {
					do_action( 'printo_action_before_post_readmore' );
					if ( printo_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						printo_show_post_more_link( $printo_template_args, '<p>', '</p>' );
					} else {
						printo_show_post_comments_link( $printo_template_args, '<p>', '</p>' );
					}
					do_action( 'printo_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $printo_template_args ) ) {
	if ( ! empty( $printo_template_args['slider'] ) || $printo_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
