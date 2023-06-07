<?php
/**
 * The template to display the site logo in the footer
 *
 * @package PRINTO
 * @since PRINTO 1.0.10
 */

// Logo
if ( printo_is_on( printo_get_theme_option( 'logo_in_footer' ) ) ) {
	$printo_logo_image = printo_get_logo_image( 'footer' );
	$printo_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $printo_logo_image['logo'] ) || ! empty( $printo_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $printo_logo_image['logo'] ) ) {
					$printo_attr = printo_getimagesize( $printo_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $printo_logo_image['logo'] ) . '"'
								. ( ! empty( $printo_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $printo_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'printo' ) . '"'
								. ( ! empty( $printo_attr[3] ) ? ' ' . wp_kses_data( $printo_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $printo_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $printo_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
