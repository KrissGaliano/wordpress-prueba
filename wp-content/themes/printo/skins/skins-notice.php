<?php
/**
 * The template to display Admin notices
 *
 * @package PRINTO
 * @since PRINTO 1.0.64
 */

$printo_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$printo_skins_args = get_query_var( 'printo_skins_notice_args' );
?>
<div class="printo_admin_notice printo_skins_notice notice notice-info is-dismissible" data-notice="skins">
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
		<?php esc_html_e( 'New skins available', 'printo' ); ?>
	</h3>
	<?php

	// Description
	$printo_total      = $printo_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$printo_skins_msg  = $printo_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $printo_total, 'printo' ), $printo_total ) . '</strong>'
							: '';
	$printo_total      = $printo_skins_args['free'];
	$printo_skins_msg .= $printo_total > 0
							? ( ! empty( $printo_skins_msg ) ? ' ' . esc_html__( 'and', 'printo' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $printo_total, 'printo' ), $printo_total ) . '</strong>'
							: '';
	$printo_total      = $printo_skins_args['pay'];
	$printo_skins_msg .= $printo_skins_args['pay'] > 0
							? ( ! empty( $printo_skins_msg ) ? ' ' . esc_html__( 'and', 'printo' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $printo_total, 'printo' ), $printo_total ) . '</strong>'
							: '';
	?>
	<div class="printo_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'printo' ), $printo_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="printo_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $printo_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'printo' );
			?>
		</a>
	</div>
</div>
