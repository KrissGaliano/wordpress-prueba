<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package PRINTO
 * @since PRINTO 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$printo_copyright_scheme = printo_get_theme_option( 'copyright_scheme' );
if ( ! empty( $printo_copyright_scheme ) && ! printo_is_inherit( $printo_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $printo_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$printo_copyright = printo_get_theme_option( 'copyright' );
			if ( ! empty( $printo_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$printo_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $printo_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$printo_copyright = printo_prepare_macros( $printo_copyright );
				// Display copyright
				echo wp_kses( nl2br( $printo_copyright ), 'printo_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
