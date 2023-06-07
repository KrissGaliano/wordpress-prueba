<?php
/**
 * The template to display default site footer
 *
 * @package PRINTO
 * @since PRINTO 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$printo_footer_scheme = printo_get_theme_option( 'footer_scheme' );
if ( ! empty( $printo_footer_scheme ) && ! printo_is_inherit( $printo_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $printo_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
