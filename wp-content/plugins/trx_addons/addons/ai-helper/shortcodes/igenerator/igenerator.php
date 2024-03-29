<?php
/**
 * Shortcode: Image Generator
 *
 * @package ThemeREX Addons
 * @since v2.20.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	exit;
}

use TrxAddons\AiHelper\OpenAi;
use TrxAddons\AiHelper\Lists;


// Load required styles and scripts for the frontend
if ( ! function_exists( 'trx_addons_sc_igenerator_load_scripts_front' ) ) {
	add_action( "wp_enqueue_scripts", 'trx_addons_sc_igenerator_load_scripts_front', TRX_ADDONS_ENQUEUE_SCRIPTS_PRIORITY );
	add_action( 'trx_addons_action_pagebuilder_preview_scripts', 'trx_addons_sc_igenerator_load_scripts_front', 10, 1 );
	function trx_addons_sc_igenerator_load_scripts_front( $force = false ) {
		static $loaded = false;
		$debug    = trx_addons_is_on( trx_addons_get_option( 'debug_mode' ) );
		$optimize = ! trx_addons_is_off( trx_addons_get_option( 'optimize_css_and_js_loading' ) );
		$preview_elm = trx_addons_is_preview( 'elementor' );
		$preview_gb  = trx_addons_is_preview( 'gutenberg' );
		$theme_full  = current_theme_supports( 'styles-and-scripts-full-merged' );
		$need        = ! $loaded && ( ! $preview_elm || $debug ) && ! $preview_gb && $optimize && (
						$force === true
							|| ( $preview_elm && $debug )
							|| trx_addons_sc_check_in_content( array(
											'sc' => 'sc_igenerator',
											'entries' => array(
												array( 'type' => 'sc',  'sc' => 'trx_sc_igenerator' ),
												array( 'type' => 'gb',  'sc' => 'wp:trx-addons/igenerator' ),
												array( 'type' => 'elm', 'sc' => '"widgetType":"trx_sc_igenerator"' ),
												array( 'type' => 'elm', 'sc' => '"shortcode":"[trx_sc_igenerator' ),
											)
								) )
							);
		if ( ! $loaded && ! $preview_gb && ( ( ! $optimize && $debug ) || ( $optimize && $need ) ) ) {
			$loaded = true;
			wp_enqueue_style( 'trx_addons-sc_igenerator', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/igenerator.css'), array(), null );
			wp_enqueue_script( 'trx_addons-sc_igenerator', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/igenerator.js'), array('jquery'), null, true );
			do_action( 'trx_addons_action_load_scripts_front', $force, 'sc_igenerator' );
		}
		if ( ! $loaded && $preview_elm && $optimize && ! $debug && ! $theme_full ) {
			do_action( 'trx_addons_action_load_scripts_front', false, 'sc_igenerator', 2 );
		}
	}
}

// Enqueue responsive styles for frontend
if ( ! function_exists( 'trx_addons_sc_igenerator_load_scripts_front_responsive' ) ) {
	add_action( 'wp_enqueue_scripts', 'trx_addons_sc_igenerator_load_scripts_front_responsive', TRX_ADDONS_ENQUEUE_RESPONSIVE_PRIORITY );
	add_action( 'trx_addons_action_load_scripts_front_sc_igenerator', 'trx_addons_sc_igenerator_load_scripts_front_responsive', 10, 1 );
	function trx_addons_sc_igenerator_load_scripts_front_responsive( $force = false  ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && trx_addons_need_frontend_scripts( 'sc_igenerator' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			wp_enqueue_style( 'trx_addons-sc_igenerator-responsive', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/igenerator.responsive.css'), array(), null, trx_addons_media_for_load_css_responsive( 'sc-igenerator', 'sm' ) );
		}
	}
}
	
// Merge shortcode's specific styles to the single stylesheet
if ( ! function_exists( 'trx_addons_sc_igenerator_merge_styles' ) ) {
	add_filter( "trx_addons_filter_merge_styles", 'trx_addons_sc_igenerator_merge_styles' );
	function trx_addons_sc_igenerator_merge_styles( $list ) {
		$list[ TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/igenerator.css' ] = false;
		return $list;
	}
}

// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( ! function_exists( 'trx_addons_sc_igenerator_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_sc_igenerator_merge_styles_responsive' );
	function trx_addons_sc_igenerator_merge_styles_responsive( $list ) {
		$list[ TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/igenerator.responsive.css' ] = false;
		return $list;
	}
}

// Merge shortcode's specific scripts into single file
if ( ! function_exists( 'trx_addons_sc_igenerator_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_sc_igenerator_merge_scripts');
	function trx_addons_sc_igenerator_merge_scripts($list) {
		$list[ TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/igenerator.js' ] = false;
		return $list;
	}
}

// Load styles and scripts if present in the cache of the menu
if ( ! function_exists( 'trx_addons_sc_igenerator_check_in_html_output' ) ) {
	add_filter( 'trx_addons_filter_get_menu_cache_html', 'trx_addons_sc_igenerator_check_in_html_output', 10, 1 );
	add_action( 'trx_addons_action_show_layout_from_cache', 'trx_addons_sc_igenerator_check_in_html_output', 10, 1 );
	add_action( 'trx_addons_action_check_page_content', 'trx_addons_sc_igenerator_check_in_html_output', 10, 1 );
	function trx_addons_sc_igenerator_check_in_html_output( $content = '' ) {
		if ( ! trx_addons_need_frontend_scripts( 'sc_igenerator' )
			&& ! trx_addons_is_off( trx_addons_get_option( 'optimize_css_and_js_loading' ) )
		) {
			$checklist = apply_filters( 'trx_addons_filter_check_in_html', array(
							'class=[\'"][^\'"]*sc_igenerator'
							),
							'sc_igenerator'
						);
			foreach ( $checklist as $item ) {
				if ( preg_match( "#{$item}#", $content, $matches ) ) {
					trx_addons_sc_igenerator_load_scripts_front( true );
					break;
				}
			}
		}
		return $content;
	}
}

// Check allowed image size
if ( ! function_exists( 'trx_addons_sc_igenerator_check_image_size' ) ) {
	function trx_addons_sc_igenerator_check_image_size( $size ) {
		$allowed_sizes = Lists::get_list_ai_image_sizes();
		return ! empty( $allowed_sizes[ $size ] ) ? $size : trx_addons_sc_igenerator_default_image_size();
	}
}

// Return default image size
if ( ! function_exists( 'trx_addons_sc_igenerator_default_image_size' ) ) {
	function trx_addons_sc_igenerator_default_image_size() {
		return apply_filters( 'trx_addons_filter_sc_igenerator_default_image_size', '256x256' );
	}
}

// Encode settings to add its to the shortcode output
if ( ! function_exists( 'trx_addons_sc_igenerator_encode_settings' ) ) {
	function trx_addons_sc_igenerator_encode_settings( $args ) {
		$args = serialize( $args );
		for ( $i = 0; $i < strlen( $args ); $i++ ) {
			$args[ $i ] = chr( ord( $args[ $i ] ) - ( $i % 5 ) );
		}
		return $args;
	}
}

// Decode settings to add its to the shortcode output
if ( ! function_exists( 'trx_addons_sc_igenerator_decode_settings' ) ) {
	function trx_addons_sc_igenerator_decode_settings( $args ) {
		for ( $i = 0; $i < strlen( $args ); $i++ ) {
			$args[ $i ] = chr( ord( $args[ $i ] ) + ( $i % 5 ) );
		}
		return unserialize( $args );
	}
}


// trx_sc_igenerator
//-------------------------------------------------------------
/*
[trx_sc_igenerator id="unique_id" number="2" prompt="prompt text for ai"]
*/
if ( ! function_exists( 'trx_addons_sc_igenerator' ) ) {
	function trx_addons_sc_igenerator( $atts, $content = null ) {	
		$atts = trx_addons_sc_prepare_atts( 'trx_sc_igenerator', $atts, trx_addons_sc_common_atts( 'id,title', array(
			// Individual params
			"type" => "default",
			"tags" => "",
			"tags_label" => "",
			"prompt" => "",
			"prompt_width" => "100",
			"number" => "3",
			"columns" => "",
			"columns_tablet" => "",
			"columns_mobile" => "",
			"size" => trx_addons_sc_igenerator_default_image_size(),
			"demo_images" => "",
			"demo_images_url" => "",
			'demo_thumb_size' => apply_filters( 'trx_addons_filter_thumb_size',
													trx_addons_get_thumb_size( 'avatar' ),
													'trx_addons_sc_igenerator',
													$atts
												),
		) ) );
		// Load shortcode-specific scripts and styles
		trx_addons_sc_igenerator_load_scripts_front( true );

		// Load template
		$output = '';
		$atts['number'] = max( 1, min( 10, (int)$atts['number'] ) );
		if ( empty( $atts['columns'] ) ) $atts['columns'] = $atts['number'];
		$atts['columns'] = max( 1, min( $atts['number'], (int)$atts['columns'] ) );
		if ( ! empty( $atts['columns_tablet'] ) ) $atts['columns_tablet'] = max( 1, min( $atts['number'], (int)$atts['columns_tablet'] ) );
		if ( ! empty( $atts['columns_mobile'] ) ) $atts['columns_mobile'] = max( 1, min( $atts['number'], (int)$atts['columns_mobile'] ) );
		$atts['size'] = trx_addons_sc_igenerator_check_image_size( $atts['size'] );
		if ( ! is_array( $atts['demo_images'] ) ) {
			$demo_images = explode( '|', $atts['demo_images'] );
			$atts['demo_images'] = array();
			foreach ( $demo_images as $img ) {
				$atts['demo_images'][] = array( 'url' => $img );
			}
		}

		ob_start();
		trx_addons_get_template_part( array(
										TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/tpl.' . trx_addons_esc( $atts['type'] ) . '.php',
										TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/tpl.default.php'
										),
										'trx_addons_args_sc_igenerator',
										$atts
									);
		$output = ob_get_contents();
		ob_end_clean();
		return apply_filters( 'trx_addons_sc_output', $output, 'trx_sc_igenerator', $atts, $content );
	}
}

// Add shortcode [trx_sc_igenerator]
if ( ! function_exists( 'trx_addons_sc_igenerator_add_shortcode' ) ) {
	add_action( 'init', 'trx_addons_sc_igenerator_add_shortcode', 20 );
	function trx_addons_sc_igenerator_add_shortcode() {
		add_shortcode( "trx_sc_igenerator", "trx_addons_sc_igenerator" );
	}
}


// Add number of generated images to the total number and save to the transient
if ( ! function_exists( 'trx_addons_sc_igenerator_set_total_generated' ) ) {
	function trx_addons_sc_igenerator_set_total_generated( $number ) {
		$data = get_transient( 'trx_addons_sc_igenerator_total' );
		if ( ! is_array( $data ) || $data['date'] != date( 'Y-m-d' ) ) {
			$data = array(
				'per_hour' => array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ),
				'per_day' => 0,
				'date' => date( 'Y-m-d' ),
			);
		}
		$hour = (int) date( 'H' );
		$data['per_hour'][ $hour ] += $number;
		$data['per_day'] += $number;
		set_transient( 'trx_addons_sc_igenerator_total', $data, 24 * 60 * 60 );
	}
}

// Get number of generated images from the transient
if ( ! function_exists( 'trx_addons_sc_igenerator_get_total_generated' ) ) {
	function trx_addons_sc_igenerator_get_total_generated( $per = 'hour' ) {
		$data = get_transient( 'trx_addons_sc_igenerator_total' );
		if ( ! is_array( $data ) ) {
			return 0;
		}
		if ( $per == 'hour' ) {
			$hour = (int) date( 'H' );
			return $data['per_hour'][ $hour ];
		} else if ( $per == 'day' ) {
			return $data['per_day'];
		} else if ( $per == 'all' ) {
			return $data;
		} else {
			return 0;
		}
	}
}

// Log a visitor ip address to the json file
if ( ! function_exists( 'trx_addons_sc_igenerator_log_to_json' ) ) {
	function trx_addons_sc_igenerator_log_to_json( $number ) {
		$ip = ! empty( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
		$date = date( 'Y-m-d' );
		$time = date( 'H:i:s' );
		$hour = date( 'H' );
		$json = trx_addons_fgc( TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/debug.json' );
		if ( empty( $json ) ) $json = '[]';
		$ips = json_decode( $json, true );
		if ( ! is_array( $ips ) ) {
			$ips = array();
		}
		if ( empty( $ips[ $date ] ) ) {
			$ips[ $date ] = array( 'total' => 0, 'ip' => array(), 'hour' => array() );
		}
		// Log total
		$ips[ $date ]['total'] += $number;
		// Log by IP
		if ( empty( $ips[ $date ]['ip'][ $ip ] ) ) {
			$ips[ $date ]['ip'][ $ip ] = array();
		}
		if ( empty( $ips[ $date ]['ip'][ $ip ][ $time ] ) ) {
			$ips[ $date ]['ip'][ $ip ][ $time ] = 0;
		}
		$ips[ $date ]['ip'][ $ip ][ $time ] += $number;
		// Log by hour
		if ( empty( $ips[ $date ]['hour'][ $hour ] ) ) {
			$ips[ $date ]['hour'][ $hour ] = array();
		}
		if ( empty( $ips[ $date ]['hour'][ $hour ][ $time ] ) ) {
			$ips[ $date ]['hour'][ $hour ][ $time ] = 0;
		}
		$ips[ $date ]['hour'][ $hour ][ $time ] += $number;
		trx_addons_fpc( TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/debug.json', json_encode( $ips, JSON_PRETTY_PRINT ) );
	}
}

// Callback function to generate images from the shortcode AJAX request
if ( ! function_exists( 'trx_addons_sc_igenerator_generate_images' ) ) {
	add_action( 'wp_ajax_nopriv_trx_addons_ai_helper_igenerator', 'trx_addons_sc_igenerator_generate_images' );
	add_action( 'wp_ajax_trx_addons_ai_helper_igenerator', 'trx_addons_sc_igenerator_generate_images' );
	function trx_addons_sc_igenerator_generate_images() {

		trx_addons_verify_nonce();

		$prompt = trx_addons_get_value_gp( 'prompt' );
		$settings = trx_addons_sc_igenerator_decode_settings( trx_addons_get_value_gp( 'settings' ) );
		$size = ! empty( $settings[ 'size' ] ) ? trx_addons_sc_igenerator_check_image_size( $settings[ 'size' ] ) : trx_addons_sc_igenerator_default_image_size();
		$number = ! empty( $settings[ 'number' ] ) ? max( 1, min( 10, $settings['number'] ) ) : 3;
		$count = (int)trx_addons_get_value_gp( 'count' );

		$limit_per_hour = trx_addons_get_option( 'ai_helper_sc_igenerator_limit_per_hour' );
		$limit_per_visitor = trx_addons_get_option( 'ai_helper_sc_igenerator_limit_per_visitor' );
	
		$answer = array(
			'error' => '',
			'data' => array(
				'images' => array(),
				'number' => $number,
				'columns' => ! empty( $settings[ 'columns' ] ) ? max( 1, min( 12, $settings['columns'] ) ) : 3,
				'columns_tablet' => ! empty( $settings[ 'columns_tablet' ] ) ? max( 1, min( 12, $settings['columns_tablet'] ) ) : '',
				'columns_mobile' => ! empty( $settings[ 'columns_mobile' ] ) ? max( 1, min( 12, $settings['columns_mobile'] ) ) : '',
				'message' => ''
			)
		);

		if ( ! empty( $prompt ) ) {

			$generated_per_hour = trx_addons_sc_igenerator_get_total_generated();
			$lph = $limit_per_hour < $generated_per_hour + $number;
			$lpv = $limit_per_visitor < $count;
			$demo = $count == 0 || $lph || $lpv;

			if ( OpenAi::instance()->get_api_key() != '' && ! $demo ) {

				// Log a visitor ip address to the json file
				//trx_addons_sc_igenerator_log_to_json( $number );

				$api = OpenAi::instance();
				$response = $api->generate_images( array(
					'prompt' => apply_filters( 'trx_addons_filter_ai_helper_prompt', $prompt, compact( 'size', 'number' ),'sc_igenerator' ),
					'size' => $size,
					'n' => $number,
				) );
				if ( ! empty( $response['data'] ) && ! empty( $response['data'][0]['url'] ) ) {
					$answer['data']['images'] = $response['data'];
				} else {
					if ( ! empty( $response['error']['message'] ) ) {
						$answer['error'] = $response['error']['message'];
					} else {
						$answer['error'] = __( 'Error! Unknown response from the OpenAI API.', 'trx_addons' );
					}
				}
				trx_addons_sc_igenerator_set_total_generated( $number );
			} else {
				if ( OpenAi::instance()->get_api_key() != '' && $demo ) {
					$answer['data']['message'] = '<p data-lp="' . ( $lph ? 'lph' . $generated_per_hour : ( $lpv ? 'lpv' : '' ) ) . '">' . __( 'Limits are reached!', 'trx_addons' ) . '</p>'
												. '<p>' . __( 'The limit of the number of images that can be generated within 1 hour has been reached. Therefore, instead of generated images, you see demo samples.', 'trx_addons' ) . '</p>'
												. '<p>' . __( ' Please try again later.', 'trx_addons' ) . '</p>';
				}
				if ( ! empty( $settings['demo_images'] ) && ! empty( $settings['demo_images'][0]['url'] ) ) {
					$images = array();
					foreach ( $settings['demo_images'] as $img ) {
						$images[] = trx_addons_add_thumb_size( $img['url'], $settings['demo_thumb_size'] );
					}
				} else {
					$images = trx_addons_get_list_files( TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/images/' . trx_addons_esc( $size ) );
				}
				if ( is_array( $images ) && count( $images ) > 0 ) {
					shuffle( $images );
					for ( $i = 0; $i < min( $number, count( $images ) ); $i++ ) {
						$answer['data']['images'][] = array(
							'url' => $images[ $i ]
						);
					}
				} else {
					$answer['error'] = __( 'Error! OpenAI API key is not specified.', 'trx_addons' );
				}
			}
		} else {
			$answer['error'] = __( 'Error! The prompt is empty.', 'trx_addons' );
		}

		// Return response to the AJAX handler
		trx_addons_ajax_response( apply_filters( 'trx_addons_filter_sc_igenerator_answer', $answer ) );
	}
}


// Add shortcodes
//----------------------------------------------------------------------------

// Add shortcodes to Elementor
if ( trx_addons_exists_elementor() && function_exists('trx_addons_elm_init') ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/igenerator-sc-elementor.php';
}

// Add shortcodes to Gutenberg
if ( trx_addons_exists_gutenberg() && function_exists( 'trx_addons_gutenberg_get_param_id' ) ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/shortcodes/igenerator/igenerator-sc-gutenberg.php';
}
