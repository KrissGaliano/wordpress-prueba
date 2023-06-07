<?php
/**
 * The Header: Logo and main menu
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( printo_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'printo_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'printo_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('printo_action_body_wrap_attributes'); ?>>

		<?php do_action( 'printo_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'printo_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('printo_action_page_wrap_attributes'); ?>>

			<?php do_action( 'printo_action_page_wrap_start' ); ?>

			<?php
			$printo_full_post_loading = ( printo_is_singular( 'post' ) || printo_is_singular( 'attachment' ) ) && printo_get_value_gp( 'action' ) == 'full_post_loading';
			$printo_prev_post_loading = ( printo_is_singular( 'post' ) || printo_is_singular( 'attachment' ) ) && printo_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $printo_full_post_loading && ! $printo_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="printo_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to content", 'printo' ); ?></a>
				<?php if ( printo_sidebar_present() ) { ?>
				<a class="printo_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to sidebar", 'printo' ); ?></a>
				<?php } ?>
				<a class="printo_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to footer", 'printo' ); ?></a>

				<?php
				do_action( 'printo_action_before_header' );

				// Header
				$printo_header_type = printo_get_theme_option( 'header_type' );
				if ( 'custom' == $printo_header_type && ! printo_is_layouts_available() ) {
					$printo_header_type = 'default';
				}
				get_template_part( apply_filters( 'printo_filter_get_template_part', "templates/header-" . sanitize_file_name( $printo_header_type ) ) );

				// Side menu
				if ( in_array( printo_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'printo_action_after_header' );

			}
			?>

			<?php do_action( 'printo_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( printo_is_off( printo_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $printo_header_type ) ) {
						$printo_header_type = printo_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $printo_header_type && printo_is_layouts_available() ) {
						$printo_header_id = printo_get_custom_header_id();
						if ( $printo_header_id > 0 ) {
							$printo_header_meta = printo_get_custom_layout_meta( $printo_header_id );
							if ( ! empty( $printo_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$printo_footer_type = printo_get_theme_option( 'footer_type' );
					if ( 'custom' == $printo_footer_type && printo_is_layouts_available() ) {
						$printo_footer_id = printo_get_custom_footer_id();
						if ( $printo_footer_id ) {
							$printo_footer_meta = printo_get_custom_layout_meta( $printo_footer_id );
							if ( ! empty( $printo_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'printo_action_page_content_wrap_class', $printo_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'printo_filter_is_prev_post_loading', $printo_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( printo_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'printo_action_page_content_wrap_data', $printo_prev_post_loading );
			?>>
				<?php
				do_action( 'printo_action_page_content_wrap', $printo_full_post_loading || $printo_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'printo_filter_single_post_header', printo_is_singular( 'post' ) || printo_is_singular( 'attachment' ) ) ) {
					if ( $printo_prev_post_loading ) {
						if ( printo_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'printo_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$printo_path = apply_filters( 'printo_filter_get_template_part', 'templates/single-styles/' . printo_get_theme_option( 'single_style' ) );
					if ( printo_get_file_dir( $printo_path . '.php' ) != '' ) {
						get_template_part( $printo_path );
					}
				}

				// Widgets area above page
				$printo_body_style   = printo_get_theme_option( 'body_style' );
				$printo_widgets_name = printo_get_theme_option( 'widgets_above_page' );
				$printo_show_widgets = ! printo_is_off( $printo_widgets_name ) && is_active_sidebar( $printo_widgets_name );
				if ( $printo_show_widgets ) {
					if ( 'fullscreen' != $printo_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					printo_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $printo_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'printo_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $printo_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'printo_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'printo_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="printo_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( printo_is_singular( 'post' ) || printo_is_singular( 'attachment' ) )
							&& $printo_prev_post_loading 
							&& printo_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'printo_action_between_posts' );
						}

						// Widgets area above content
						printo_create_widgets_area( 'widgets_above_content' );

						do_action( 'printo_action_page_content_start_text' );
