<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'printo_mailchimp_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'printo_mailchimp_theme_setup9', 9 );
	function printo_mailchimp_theme_setup9() {
		if ( printo_exists_mailchimp() ) {
			add_action( 'wp_enqueue_scripts', 'printo_mailchimp_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_mailchimp', 'printo_mailchimp_frontend_scripts', 10, 1 );
			add_filter( 'printo_filter_merge_styles', 'printo_mailchimp_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'printo_filter_tgmpa_required_plugins', 'printo_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'printo_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('printo_filter_tgmpa_required_plugins',	'printo_mailchimp_tgmpa_required_plugins');
	function printo_mailchimp_tgmpa_required_plugins( $list = array() ) {
		if ( printo_storage_isset( 'required_plugins', 'mailchimp-for-wp' ) && printo_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'install' ) !== false ) {
			$list[] = array(
				'name'     => printo_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'title' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'printo_exists_mailchimp' ) ) {
	function printo_exists_mailchimp() {
		return function_exists( '__mc4wp_load_plugin' ) || defined( 'MC4WP_VERSION' );
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue styles for frontend
if ( ! function_exists( 'printo_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'printo_mailchimp_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_mailchimp', 'printo_mailchimp_frontend_scripts', 10, 1 );
	function printo_mailchimp_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && printo_need_frontend_scripts( 'mailchimp' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$printo_url = printo_get_file_url( 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' );
			if ( '' != $printo_url ) {
				wp_enqueue_style( 'printo-mailchimp-for-wp', $printo_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'printo_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'printo_filter_merge_styles', 'printo_mailchimp_merge_styles');
	function printo_mailchimp_merge_styles( $list ) {
		$list[ 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( printo_exists_mailchimp() ) {
	$printo_fdir = printo_get_file_dir( 'plugins/mailchimp-for-wp/mailchimp-for-wp-style.php' );
	if ( ! empty( $printo_fdir ) ) {
		require_once $printo_fdir;
	}
}

