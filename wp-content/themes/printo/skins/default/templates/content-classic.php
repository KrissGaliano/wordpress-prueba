<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */

$printo_template_args = get_query_var( 'printo_template_args' );

if ( is_array( $printo_template_args ) ) {
	$printo_columns    = empty( $printo_template_args['columns'] ) ? 2 : max( 1, $printo_template_args['columns'] );
	$printo_blog_style = array( $printo_template_args['type'], $printo_columns );
    $printo_columns_class = printo_get_column_class( 1, $printo_columns, ! empty( $printo_template_args['columns_tablet']) ? $printo_template_args['columns_tablet'] : '', ! empty($printo_template_args['columns_mobile']) ? $printo_template_args['columns_mobile'] : '' );
} else {
	$printo_blog_style = explode( '_', printo_get_theme_option( 'blog_style' ) );
	$printo_columns    = empty( $printo_blog_style[1] ) ? 2 : max( 1, $printo_blog_style[1] );
    $printo_columns_class = printo_get_column_class( 1, $printo_columns );
}
$printo_expanded   = ! printo_sidebar_present() && printo_get_theme_option( 'expand_content' ) == 'expand';

$printo_post_format = get_post_format();
$printo_post_format = empty( $printo_post_format ) ? 'standard' : str_replace( 'post-format-', '', $printo_post_format );

?><div class="<?php
	if ( ! empty( $printo_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( printo_is_blog_style_use_masonry( $printo_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $printo_columns ) : esc_attr( $printo_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $printo_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $printo_columns )
				. ' post_layout_' . esc_attr( $printo_blog_style[0] )
				. ' post_layout_' . esc_attr( $printo_blog_style[0] ) . '_' . esc_attr( $printo_columns )
	);
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
								: explode( ',', $printo_template_args['meta_parts'] )
								)
							: printo_array_get_keys_by_value( printo_get_theme_option( 'meta_parts' ) );

	printo_show_post_featured( apply_filters( 'printo_filter_args_featured',
		array(
			'thumb_size' => ! empty( $printo_template_args['thumb_size'] )
				? $printo_template_args['thumb_size']
				: printo_get_thumb_size(
					'classic' == $printo_blog_style[0]
						? ( strpos( printo_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $printo_columns > 2 ? 'big' : 'huge' )
								: ( $printo_columns > 2
									? ( $printo_expanded ? 'square' : 'square' )
									: ($printo_columns > 1 ? 'square' : ( $printo_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( printo_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $printo_columns > 2 ? 'masonry-big' : 'full' )
								: ($printo_columns === 1 ? ( $printo_expanded ? 'huge' : 'big' ) : ( $printo_columns <= 2 && $printo_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $printo_hover,
			'meta_parts' => $printo_components,
			'no_links'   => ! empty( $printo_template_args['no_links'] ),
        ),
        'content-classic',
        $printo_template_args
    ) );

	// Title and post meta
	$printo_show_title = get_the_title() != '';
	$printo_show_meta  = count( $printo_components ) > 0 && ! in_array( $printo_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $printo_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'printo_filter_show_blog_meta', $printo_show_meta, $printo_components, 'classic' ) ) {
				if ( count( $printo_components ) > 0 ) {
					do_action( 'printo_action_before_post_meta' );
					printo_show_post_meta(
						apply_filters(
							'printo_filter_post_meta_args', array(
							'components' => join( ',', $printo_components ),
							'seo'        => false,
							'echo'       => true,
						), $printo_blog_style[0], $printo_columns
						)
					);
					do_action( 'printo_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'printo_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'printo_action_before_post_title' );
				if ( empty( $printo_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'printo_action_after_post_title' );
			}

			if( !in_array( $printo_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'printo_filter_show_blog_readmore', ! $printo_show_title || ! empty( $printo_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $printo_template_args['no_links'] ) ) {
						do_action( 'printo_action_before_post_readmore' );
						printo_show_post_more_link( $printo_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'printo_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $printo_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('printo_filter_show_blog_excerpt', empty($printo_template_args['hide_excerpt']) && printo_get_theme_option('excerpt_length') > 0, 'classic')) {
			printo_show_post_content($printo_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $printo_template_args['more_button'] )) {
			if ( empty( $printo_template_args['no_links'] ) ) {
				do_action( 'printo_action_before_post_readmore' );
				printo_show_post_more_link( $printo_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'printo_action_after_post_readmore' );
			}
		}
		$printo_content = ob_get_contents();
		ob_end_clean();
		printo_show_layout($printo_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
