<?php
/**
 * The template to display the widgets area in the header
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */

// Header sidebar
$printo_header_name    = printo_get_theme_option( 'header_widgets' );
$printo_header_present = ! printo_is_off( $printo_header_name ) && is_active_sidebar( $printo_header_name );
if ( $printo_header_present ) {
	printo_storage_set( 'current_sidebar', 'header' );
	$printo_header_wide = printo_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $printo_header_name ) ) {
		dynamic_sidebar( $printo_header_name );
	}
	$printo_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $printo_widgets_output ) ) {
		$printo_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $printo_widgets_output );
		$printo_need_columns   = strpos( $printo_widgets_output, 'columns_wrap' ) === false;
		if ( $printo_need_columns ) {
			$printo_columns = max( 0, (int) printo_get_theme_option( 'header_columns' ) );
			if ( 0 == $printo_columns ) {
				$printo_columns = min( 6, max( 1, printo_tags_count( $printo_widgets_output, 'aside' ) ) );
			}
			if ( $printo_columns > 1 ) {
				$printo_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $printo_columns ) . ' widget', $printo_widgets_output );
			} else {
				$printo_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $printo_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'printo_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $printo_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $printo_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'printo_action_before_sidebar', 'header' );
				printo_show_layout( $printo_widgets_output );
				do_action( 'printo_action_after_sidebar', 'header' );
				if ( $printo_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $printo_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'printo_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
