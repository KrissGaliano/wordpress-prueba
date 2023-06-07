<?php
/**
 * Required plugins
 *
 * @package PRINTO
 * @since PRINTO 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$printo_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'printo' ),
	'page_builders' => esc_html__( 'Page Builders', 'printo' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'printo' ),
	'socials'       => esc_html__( 'Socials and Communities', 'printo' ),
	'events'        => esc_html__( 'Events and Appointments', 'printo' ),
	'content'       => esc_html__( 'Content', 'printo' ),
	'other'         => esc_html__( 'Other', 'printo' ),
);
$printo_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'printo' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'printo' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $printo_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'printo' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'printo' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $printo_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'printo' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'printo' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $printo_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'printo' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'printo' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $printo_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'printo' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'printo' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $printo_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'printo' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'printo' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $printo_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'printo' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'printo' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $printo_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'printo' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'printo' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $printo_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'printo' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $printo_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'printo' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $printo_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'printo' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'printo' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $printo_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'printo' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => printo_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $printo_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'printo' ),
		'description' => '',
		'required'    => false,
		'logo'        => printo_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $printo_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'printo' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => printo_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $printo_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'printo' ),
		'description' => '',
		'required'    => false,
		'logo'        => printo_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $printo_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'printo' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => printo_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $printo_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'printo' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => printo_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $printo_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'printo' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $printo_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'printo' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $printo_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'printo' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'printo' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $printo_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'printo' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'printo' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $printo_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'printo' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'printo' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $printo_theme_required_plugins_groups['other'],
	),
);

if ( PRINTO_THEME_FREE ) {
	unset( $printo_theme_required_plugins['js_composer'] );
	unset( $printo_theme_required_plugins['booked'] );
	unset( $printo_theme_required_plugins['the-events-calendar'] );
	unset( $printo_theme_required_plugins['calculated-fields-form'] );
	unset( $printo_theme_required_plugins['essential-grid'] );
	unset( $printo_theme_required_plugins['revslider'] );
	unset( $printo_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $printo_theme_required_plugins['trx_updater'] );
	unset( $printo_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
printo_storage_set( 'required_plugins', $printo_theme_required_plugins );
