<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package PRINTO
 * @since PRINTO 1.0.50
 */

$printo_template_args = get_query_var( 'printo_template_args' );
if ( is_array( $printo_template_args ) ) {
	$printo_columns    = empty( $printo_template_args['columns'] ) ? 2 : max( 1, $printo_template_args['columns'] );
	$printo_blog_style = array( $printo_template_args['type'], $printo_columns );
} else {
	$printo_blog_style = explode( '_', printo_get_theme_option( 'blog_style' ) );
	$printo_columns    = empty( $printo_blog_style[1] ) ? 2 : max( 1, $printo_blog_style[1] );
}
$printo_blog_id       = printo_get_custom_blog_id( join( '_', $printo_blog_style ) );
$printo_blog_style[0] = str_replace( 'blog-custom-', '', $printo_blog_style[0] );
$printo_expanded      = ! printo_sidebar_present() && printo_get_theme_option( 'expand_content' ) == 'expand';
$printo_components    = ! empty( $printo_template_args['meta_parts'] )
							? ( is_array( $printo_template_args['meta_parts'] )
								? join( ',', $printo_template_args['meta_parts'] )
								: $printo_template_args['meta_parts']
								)
							: printo_array_get_keys_by_value( printo_get_theme_option( 'meta_parts' ) );
$printo_post_format   = get_post_format();
$printo_post_format   = empty( $printo_post_format ) ? 'standard' : str_replace( 'post-format-', '', $printo_post_format );

$printo_blog_meta     = printo_get_custom_layout_meta( $printo_blog_id );
$printo_custom_style  = ! empty( $printo_blog_meta['scripts_required'] ) ? $printo_blog_meta['scripts_required'] : 'none';

if ( ! empty( $printo_template_args['slider'] ) || $printo_columns > 1 || ! printo_is_off( $printo_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $printo_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( printo_is_off( $printo_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $printo_custom_style ) ) . "-1_{$printo_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $printo_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $printo_columns )
					. ' post_layout_' . esc_attr( $printo_blog_style[0] )
					. ' post_layout_' . esc_attr( $printo_blog_style[0] ) . '_' . esc_attr( $printo_columns )
					. ( ! printo_is_off( $printo_custom_style )
						? ' post_layout_' . esc_attr( $printo_custom_style )
							. ' post_layout_' . esc_attr( $printo_custom_style ) . '_' . esc_attr( $printo_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'printo_action_show_layout', $printo_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $printo_template_args['slider'] ) || $printo_columns > 1 || ! printo_is_off( $printo_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
