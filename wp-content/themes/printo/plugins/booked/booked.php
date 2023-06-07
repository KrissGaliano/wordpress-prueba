<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'printo_booked_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'printo_booked_theme_setup9', 9 );
	function printo_booked_theme_setup9() {
		if ( printo_exists_booked() ) {
			add_action( 'wp_enqueue_scripts', 'printo_booked_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'printo_booked_frontend_scripts', 10, 1 );
			add_action( 'wp_enqueue_scripts', 'printo_booked_frontend_scripts_responsive', 2000 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'printo_booked_frontend_scripts_responsive', 10, 1 );
			add_filter( 'printo_filter_merge_styles', 'printo_booked_merge_styles' );
			add_filter( 'printo_filter_merge_styles_responsive', 'printo_booked_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'printo_filter_tgmpa_required_plugins', 'printo_booked_tgmpa_required_plugins' );
			add_filter( 'printo_filter_theme_plugins', 'printo_booked_theme_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( ! function_exists( 'printo_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('printo_filter_tgmpa_required_plugins',	'printo_booked_tgmpa_required_plugins');
	function printo_booked_tgmpa_required_plugins( $list = array() ) {
		if ( printo_storage_isset( 'required_plugins', 'booked' ) && printo_storage_get_array( 'required_plugins', 'booked', 'install' ) !== false && printo_is_theme_activated() ) {
			$path = printo_get_plugin_source_path( 'plugins/booked/booked.zip' );
			if ( ! empty( $path ) || printo_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => printo_storage_get_array( 'required_plugins', 'booked', 'title' ),
					'slug'     => 'booked',
					'source'   => ! empty( $path ) ? $path : 'upload://booked.zip',
					'version'  => '2.3',
					'required' => false,
				);
			}
		}
		return $list;
	}
}


// Filter theme-supported plugins list
if ( ! function_exists( 'printo_booked_theme_plugins' ) ) {
	//Handler of the add_filter( 'printo_filter_theme_plugins', 'printo_booked_theme_plugins' );
	function printo_booked_theme_plugins( $list = array() ) {
		return printo_add_group_and_logo_to_slave( $list, 'booked', 'booked-' );
	}
}


// Check if plugin installed and activated
if ( ! function_exists( 'printo_exists_booked' ) ) {
	function printo_exists_booked() {
		return class_exists( 'booked_plugin' );
	}
}


// Return a relative path to the plugin styles depend the version
if ( ! function_exists( 'printo_booked_get_styles_dir' ) ) {
	function printo_booked_get_styles_dir( $file ) {
		$base_dir = 'plugins/booked/';
		return $base_dir
				. ( defined( 'BOOKED_VERSION' ) && version_compare( BOOKED_VERSION, '2.4', '<' ) && printo_get_folder_dir( $base_dir . 'old' )
					? 'old/'
					: ''
					)
				. $file;
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'printo_booked_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'printo_booked_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'printo_booked_frontend_scripts', 10, 1 );
	function printo_booked_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && printo_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$printo_url = printo_get_file_url( printo_booked_get_styles_dir( 'booked.css' ) );
			if ( '' != $printo_url ) {
				wp_enqueue_style( 'printo-booked', $printo_url, array(), null );
			}
		}
	}
}


// Enqueue responsive styles for frontend
if ( ! function_exists( 'printo_booked_frontend_scripts_responsive' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'printo_booked_frontend_scripts_responsive', 2000 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'printo_booked_frontend_scripts_responsive', 10, 1 );
	function printo_booked_frontend_scripts_responsive( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && printo_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$printo_url = printo_get_file_url( printo_booked_get_styles_dir( 'booked-responsive.css' ) );
			if ( '' != $printo_url ) {
				wp_enqueue_style( 'printo-booked-responsive', $printo_url, array(), null, printo_media_for_load_css_responsive( 'booked' ) );
			}
		}
	}
}


// Merge custom styles
if ( ! function_exists( 'printo_booked_merge_styles' ) ) {
	//Handler of the add_filter('printo_filter_merge_styles', 'printo_booked_merge_styles');
	function printo_booked_merge_styles( $list ) {
		$list[ printo_booked_get_styles_dir( 'booked.css' ) ] = false;
		return $list;
	}
}


// Merge responsive styles
if ( ! function_exists( 'printo_booked_merge_styles_responsive' ) ) {
	//Handler of the add_filter('printo_filter_merge_styles_responsive', 'printo_booked_merge_styles_responsive');
	function printo_booked_merge_styles_responsive( $list ) {
		$list[ printo_booked_get_styles_dir( 'booked-responsive.css' ) ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( printo_exists_booked() ) {
	$printo_fdir = printo_get_file_dir( printo_booked_get_styles_dir( 'booked-style.php' ) );
	if ( ! empty( $printo_fdir ) ) {
		require_once $printo_fdir;
	}
}
