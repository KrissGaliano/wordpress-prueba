<?php
/**
 * The template to display Admin notices
 *
 * @package PRINTO
 * @since PRINTO 1.0.1
 */

$printo_theme_slug = get_option( 'template' );
$printo_theme_obj  = wp_get_theme( $printo_theme_slug );
?>
<div class="printo_admin_notice printo_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$printo_theme_img = printo_get_file_url( 'screenshot.jpg' );
	if ( '' != $printo_theme_img ) {
		?>
		<div class="printo_notice_image"><img src="<?php echo esc_url( $printo_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'printo' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="printo_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'printo' ),
				$printo_theme_obj->get( 'Name' ) . ( PRINTO_THEME_FREE ? ' ' . __( 'Free', 'printo' ) : '' ),
				$printo_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="printo_notice_text">
		<p class="printo_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $printo_theme_obj->description ) );
			?>
		</p>
		<p class="printo_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'printo' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="printo_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=printo_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'printo' );
			?>
		</a>
	</div>
</div>
