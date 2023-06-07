<?php
/**
 * The template to display the socials in the footer
 *
 * @package PRINTO
 * @since PRINTO 1.0.10
 */


// Socials
if ( printo_is_on( printo_get_theme_option( 'socials_in_footer' ) ) ) {
	$printo_output = printo_get_socials_links();
	if ( '' != $printo_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php printo_show_layout( $printo_output ); ?>
			</div>
		</div>
		<?php
	}
}
