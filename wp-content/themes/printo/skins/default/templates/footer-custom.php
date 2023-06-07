<?php
/**
 * The template to display default site footer
 *
 * @package PRINTO
 * @since PRINTO 1.0.10
 */

$printo_footer_id = printo_get_custom_footer_id();
$printo_footer_meta = get_post_meta( $printo_footer_id, 'trx_addons_options', true );
if ( ! empty( $printo_footer_meta['margin'] ) ) {
	printo_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( printo_prepare_css_value( $printo_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $printo_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $printo_footer_id ) ) ); ?>
						<?php
						$printo_footer_scheme = printo_get_theme_option( 'footer_scheme' );
						if ( ! empty( $printo_footer_scheme ) && ! printo_is_inherit( $printo_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $printo_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'printo_action_show_layout', $printo_footer_id );
	?>
</footer><!-- /.footer_wrap -->
