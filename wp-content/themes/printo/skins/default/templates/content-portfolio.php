<?php
/**
 * The Portfolio template to display the content
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

$printo_post_format = get_post_format();
$printo_post_format = empty( $printo_post_format ) ? 'standard' : str_replace( 'post-format-', '', $printo_post_format );

?><div class="
<?php
if ( ! empty( $printo_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( printo_is_blog_style_use_masonry( $printo_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $printo_columns ) : esc_attr( $printo_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $printo_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $printo_columns )
		. ( 'portfolio' != $printo_blog_style[0] ? ' ' . esc_attr( $printo_blog_style[0] )  . '_' . esc_attr( $printo_columns ) : '' )
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

	$printo_hover   = ! empty( $printo_template_args['hover'] ) && ! printo_is_inherit( $printo_template_args['hover'] )
								? $printo_template_args['hover']
								: printo_get_theme_option( 'image_hover' );

	if ( 'dots' == $printo_hover ) {
		$printo_post_link = empty( $printo_template_args['no_links'] )
								? ( ! empty( $printo_template_args['link'] )
									? $printo_template_args['link']
									: get_permalink()
									)
								: '';
		$printo_target    = ! empty( $printo_post_link ) && false === strpos( $printo_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$printo_components = ! empty( $printo_template_args['meta_parts'] )
							? ( is_array( $printo_template_args['meta_parts'] )
								? $printo_template_args['meta_parts']
								: explode( ',', $printo_template_args['meta_parts'] )
								)
							: printo_array_get_keys_by_value( printo_get_theme_option( 'meta_parts' ) );

	// Featured image
	printo_show_post_featured( apply_filters( 'printo_filter_args_featured',
        array(
			'hover'         => $printo_hover,
			'no_links'      => ! empty( $printo_template_args['no_links'] ),
			'thumb_size'    => ! empty( $printo_template_args['thumb_size'] )
								? $printo_template_args['thumb_size']
								: printo_get_thumb_size(
									printo_is_blog_style_use_masonry( $printo_blog_style[0] )
										? (	strpos( printo_get_theme_option( 'body_style' ), 'full' ) !== false || $printo_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( printo_get_theme_option( 'body_style' ), 'full' ) !== false || $printo_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => printo_is_blog_style_use_masonry( $printo_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $printo_components,
			'class'         => 'dots' == $printo_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $printo_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $printo_post_link )
												? '<a href="' . esc_url( $printo_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $printo_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $printo_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $printo_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!