<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */

$printo_args = get_query_var( 'printo_logo_args' );

// Site logo
$printo_logo_type   = isset( $printo_args['type'] ) ? $printo_args['type'] : '';
$printo_logo_image  = printo_get_logo_image( $printo_logo_type );
$printo_logo_text   = printo_is_on( printo_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$printo_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $printo_logo_image['logo'] ) || ! empty( $printo_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $printo_logo_image['logo'] ) ) {
			if ( empty( $printo_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($printo_logo_image['logo']) && (int) $printo_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$printo_attr = printo_getimagesize( $printo_logo_image['logo'] );
				echo '<img src="' . esc_url( $printo_logo_image['logo'] ) . '"'
						. ( ! empty( $printo_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $printo_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $printo_logo_text ) . '"'
						. ( ! empty( $printo_attr[3] ) ? ' ' . wp_kses_data( $printo_attr[3] ) : '' )
						. '>';
			}
		} else {
			printo_show_layout( printo_prepare_macros( $printo_logo_text ), '<span class="logo_text">', '</span>' );
			printo_show_layout( printo_prepare_macros( $printo_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
