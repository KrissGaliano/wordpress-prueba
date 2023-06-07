<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package PRINTO
 * @since PRINTO 1.0.06
 */

$printo_header_css   = '';
$printo_header_image = get_header_image();
$printo_header_video = printo_get_header_video();
if ( ! empty( $printo_header_image ) && printo_trx_addons_featured_image_override( is_singular() || printo_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$printo_header_image = printo_get_current_mode_image( $printo_header_image );
}

$printo_header_id = printo_get_custom_header_id();
$printo_header_meta = get_post_meta( $printo_header_id, 'trx_addons_options', true );
if ( ! empty( $printo_header_meta['margin'] ) ) {
	printo_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( printo_prepare_css_value( $printo_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $printo_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $printo_header_id ) ) ); ?>
				<?php
				echo ! empty( $printo_header_image ) || ! empty( $printo_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $printo_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $printo_header_image ) {
					echo ' ' . esc_attr( printo_add_inline_css_class( 'background-image: url(' . esc_url( $printo_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( printo_is_on( printo_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight printo-full-height';
				}
				$printo_header_scheme = printo_get_theme_option( 'header_scheme' );
				if ( ! empty( $printo_header_scheme ) && ! printo_is_inherit( $printo_header_scheme  ) ) {
					echo ' scheme_' . esc_attr( $printo_header_scheme );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $printo_header_video ) ) {
		get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'printo_action_show_layout', $printo_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
