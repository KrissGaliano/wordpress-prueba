<?php
/**
 * The template to display the background video in the header
 *
 * @package PRINTO
 * @since PRINTO 1.0.14
 */
$printo_header_video = printo_get_header_video();
$printo_embed_video  = '';
if ( ! empty( $printo_header_video ) && ! printo_is_from_uploads( $printo_header_video ) ) {
	if ( printo_is_youtube_url( $printo_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $printo_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php printo_show_layout( printo_get_embed_video( $printo_header_video ) ); ?></div>
		<?php
	}
}
