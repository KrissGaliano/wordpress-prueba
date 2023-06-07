<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */

if ( printo_sidebar_present() ) {
	
	$printo_sidebar_type = printo_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $printo_sidebar_type && ! printo_is_layouts_available() ) {
		$printo_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $printo_sidebar_type ) {
		// Default sidebar with widgets
		$printo_sidebar_name = printo_get_theme_option( 'sidebar_widgets' );
		printo_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $printo_sidebar_name ) ) {
			dynamic_sidebar( $printo_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$printo_sidebar_id = printo_get_custom_sidebar_id();
		do_action( 'printo_action_show_layout', $printo_sidebar_id );
	}
	$printo_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $printo_out ) ) {
		$printo_sidebar_position    = printo_get_theme_option( 'sidebar_position' );
		$printo_sidebar_position_ss = printo_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $printo_sidebar_position );
			echo ' sidebar_' . esc_attr( $printo_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $printo_sidebar_type );

			$printo_sidebar_scheme = apply_filters( 'printo_filter_sidebar_scheme', printo_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $printo_sidebar_scheme ) && ! printo_is_inherit( $printo_sidebar_scheme ) && 'custom' != $printo_sidebar_type ) {
				echo ' scheme_' . esc_attr( $printo_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="printo_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'printo_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $printo_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$printo_title = apply_filters( 'printo_filter_sidebar_control_title', 'float' == $printo_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'printo' ) : '' );
				$printo_text  = apply_filters( 'printo_filter_sidebar_control_text', 'above' == $printo_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'printo' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $printo_title ); ?>"><?php echo esc_html( $printo_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'printo_action_before_sidebar', 'sidebar' );
				printo_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $printo_out ) );
				do_action( 'printo_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'printo_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
