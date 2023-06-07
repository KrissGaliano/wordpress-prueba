<?php
/**
 * 'Band' template to display the content
 *
 * Used for index/archive/search.
 *
 * @package PRINTO
 * @since PRINTO 1.71.0
 */

$printo_template_args = get_query_var( 'printo_template_args' );

$printo_columns       = 1;

$printo_expanded      = ! printo_sidebar_present() && printo_get_theme_option( 'expand_content' ) == 'expand';

$printo_post_format   = get_post_format();
$printo_post_format   = empty( $printo_post_format ) ? 'standard' : str_replace( 'post-format-', '', $printo_post_format );

if ( is_array( $printo_template_args ) ) {
	$printo_columns    = empty( $printo_template_args['columns'] ) ? 1 : max( 1, $printo_template_args['columns'] );
	$printo_blog_style = array( $printo_template_args['type'], $printo_columns );
	if ( ! empty( $printo_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $printo_columns > 1 ) {
	    $printo_columns_class = printo_get_column_class( 1, $printo_columns, ! empty( $printo_template_args['columns_tablet']) ? $printo_template_args['columns_tablet'] : '', ! empty($printo_template_args['columns_mobile']) ? $printo_template_args['columns_mobile'] : '' );
				?><div class="<?php echo esc_attr( $printo_columns_class ); ?>"><?php
	}
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_band post_format_' . esc_attr( $printo_post_format ) );
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
			'thumb_bg'   => true,
			'thumb_ratio'   => '1:1',
			'thumb_size' => ! empty( $printo_template_args['thumb_size'] )
								? $printo_template_args['thumb_size']
								: printo_get_thumb_size( 
								in_array( $printo_post_format, array( 'gallery', 'audio', 'video' ) )
									? ( strpos( printo_get_theme_option( 'body_style' ), 'full' ) !== false
										? 'full'
										: ( $printo_expanded 
											? 'big' 
											: 'medium-square'
											)
										)
									: 'masonry-big'
								)
		),
		'content-band',
		$printo_template_args
	) );

	?><div class="post_content_wrap"><?php

		// Title and post meta
		$printo_show_title = get_the_title() != '';
		$printo_show_meta  = count( $printo_components ) > 0 && ! in_array( $printo_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );
		if ( $printo_show_title ) {
			?>
			<div class="post_header entry-header">
				<?php
				// Categories
				if ( apply_filters( 'printo_filter_show_blog_categories', $printo_show_meta && in_array( 'categories', $printo_components ), array( 'categories' ), 'band' ) ) {
					do_action( 'printo_action_before_post_category' );
					?>
					<div class="post_category">
						<?php
						printo_show_post_meta( apply_filters(
															'printo_filter_post_meta_args',
															array(
																'components' => 'categories',
																'seo'        => false,
																'echo'       => true,
																'cat_sep'    => false,
																),
															'hover_' . $printo_hover, 1
															)
											);
						?>
					</div>
					<?php
					$printo_components = printo_array_delete_by_value( $printo_components, 'categories' );
					do_action( 'printo_action_after_post_category' );
				}
				// Post title
				if ( apply_filters( 'printo_filter_show_blog_title', true, 'band' ) ) {
					do_action( 'printo_action_before_post_title' );
					if ( empty( $printo_template_args['no_links'] ) ) {
						the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
					} else {
						the_title( '<h4 class="post_title entry-title">', '</h4>' );
					}
					do_action( 'printo_action_after_post_title' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}

		// Post content
		if ( ! isset( $printo_template_args['excerpt_length'] ) && ! in_array( $printo_post_format, array( 'gallery', 'audio', 'video' ) ) ) {
			$printo_template_args['excerpt_length'] = 13;
		}
		if ( apply_filters( 'printo_filter_show_blog_excerpt', empty( $printo_template_args['hide_excerpt'] ) && printo_get_theme_option( 'excerpt_length' ) > 0, 'band' ) ) {
			?>
			<div class="post_content entry-content">
				<?php
				// Post content area
				printo_show_post_content( $printo_template_args, '<div class="post_content_inner">', '</div>' );
				?>
			</div><!-- .entry-content -->
			<?php
		}
		// Post meta
		if ( apply_filters( 'printo_filter_show_blog_meta', $printo_show_meta, $printo_components, 'band' ) ) {
			if ( count( $printo_components ) > 0 ) {
				do_action( 'printo_action_before_post_meta' );
				printo_show_post_meta(
					apply_filters(
						'printo_filter_post_meta_args', array(
							'components' => join( ',', $printo_components ),
							'seo'        => false,
							'echo'       => true,
						), 'band', 1
					)
				);
				do_action( 'printo_action_after_post_meta' );
			}
		}
		// More button
		if ( apply_filters( 'printo_filter_show_blog_readmore', ! $printo_show_title || ! empty( $printo_template_args['more_button'] ), 'band' ) ) {
			if ( empty( $printo_template_args['no_links'] ) ) {
				do_action( 'printo_action_before_post_readmore' );
				printo_show_post_more_link( $printo_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'printo_action_after_post_readmore' );
			}
		}
		?>
	</div>
</article>
<?php

if ( is_array( $printo_template_args ) ) {
	if ( ! empty( $printo_template_args['slider'] ) || $printo_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
