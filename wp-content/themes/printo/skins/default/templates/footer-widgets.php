<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package PRINTO
 * @since PRINTO 1.0.10
 */

// Footer sidebar
$printo_footer_name    = printo_get_theme_option( 'footer_widgets' );
$printo_footer_present = ! printo_is_off( $printo_footer_name ) && is_active_sidebar( $printo_footer_name );
if ( $printo_footer_present ) {
	printo_storage_set( 'current_sidebar', 'footer' );
	$printo_footer_wide = printo_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $printo_footer_name ) ) {
		dynamic_sidebar( $printo_footer_name );
	}
	$printo_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $printo_out ) ) {
		$printo_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $printo_out );
		$printo_need_columns = true;   //or check: strpos($printo_out, 'columns_wrap')===false;
		if ( $printo_need_columns ) {
			$printo_columns = max( 0, (int) printo_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $printo_columns ) {
				$printo_columns = min( 4, max( 1, printo_tags_count( $printo_out, 'aside' ) ) );
			}
			if ( $printo_columns > 1 ) {
				$printo_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $printo_columns ) . ' widget', $printo_out );
			} else {
				$printo_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $printo_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'printo_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $printo_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $printo_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'printo_action_before_sidebar', 'footer' );
				printo_show_layout( $printo_out );
				do_action( 'printo_action_after_sidebar', 'footer' );
				if ( $printo_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $printo_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'printo_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
