<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'granola_cf7_get_css' ) ) {
	add_filter( 'granola_filter_get_css', 'granola_cf7_get_css', 10, 2 );
	function granola_cf7_get_css( $css, $args ) {
		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS

		.sc_layouts_title .breadcrumbs {
			{$fonts['p_font-family']}
		}

CSS;
		}

		return $css;
	}
}

