<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'printo_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'printo_essential_grid_theme_setup9', 9 );
	function printo_essential_grid_theme_setup9() {
		if ( printo_exists_essential_grid() ) {
			add_action( 'wp_enqueue_scripts', 'printo_essential_grid_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_essential_grid', 'printo_essential_grid_frontend_scripts', 10, 1 );
			add_filter( 'printo_filter_merge_styles', 'printo_essential_grid_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'printo_filter_tgmpa_required_plugins', 'printo_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'printo_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('printo_filter_tgmpa_required_plugins',	'printo_essential_grid_tgmpa_required_plugins');
	function printo_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( printo_storage_isset( 'required_plugins', 'essential-grid' ) && printo_storage_get_array( 'required_plugins', 'essential-grid', 'install' ) !== false && printo_is_theme_activated() ) {
			$path = printo_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || printo_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => printo_storage_get_array( 'required_plugins', 'essential-grid', 'title' ),
					'slug'     => 'essential-grid',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'version'  => '2.2.4.2',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'printo_exists_essential_grid' ) ) {
	function printo_exists_essential_grid() {
		return defined( 'EG_PLUGIN_PATH' ) || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'printo_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'printo_essential_grid_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_essential_grid', 'printo_essential_grid_frontend_scripts', 10, 1 );
	function printo_essential_grid_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && printo_need_frontend_scripts( 'essential_grid' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$printo_url = printo_get_file_url( 'plugins/essential-grid/essential-grid.css' );
			if ( '' != $printo_url ) {
				wp_enqueue_style( 'printo-essential-grid', $printo_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'printo_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('printo_filter_merge_styles', 'printo_essential_grid_merge_styles');
	function printo_essential_grid_merge_styles( $list ) {
		$list[ 'plugins/essential-grid/essential-grid.css' ] = false;
		return $list;
	}
}
