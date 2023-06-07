<?php
/**
 * Skin Setup
 *
 * @package PRINTO
 * @since PRINTO 1.76.0
 */


//--------------------------------------------
// SKIN DEFAULTS
//--------------------------------------------

// Return theme's (skin's) default value for the specified parameter
if ( ! function_exists( 'printo_theme_defaults' ) ) {
	function printo_theme_defaults( $name='', $value='' ) {
		$defaults = array(
			'page_width'          => 1290,
			'page_boxed_extra'  => 60,
			'page_fullwide_max' => 1920,
			'page_fullwide_extra' => 60,
			'sidebar_width'       => 410,
			'sidebar_gap'       => 40,
			'grid_gap'          => 30,
			'rad'               => 0
		);
		if ( empty( $name ) ) {
			return $defaults;
		} else {
			if ( $value === '' && isset( $defaults[ $name ] ) ) {
				$value = $defaults[ $name ];
			}
			return $value;
		}
	}
}


// WOOCOMMERCE SETUP
//--------------------------------------------------

// Allow extended layouts for WooCommerce
if ( ! function_exists( 'printo_skin_woocommerce_allow_extensions' ) ) {
	add_filter( 'printo_filter_load_woocommerce_extensions', 'printo_skin_woocommerce_allow_extensions' );
	function printo_skin_woocommerce_allow_extensions( $allow ) {
		return false;
	}
}


// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)


//--------------------------------------------
// SKIN SETTINGS
//--------------------------------------------
if ( ! function_exists( 'printo_skin_setup' ) ) {
	add_action( 'after_setup_theme', 'printo_skin_setup', 1 );
	function printo_skin_setup() {

		$GLOBALS['PRINTO_STORAGE'] = array_merge( $GLOBALS['PRINTO_STORAGE'], array(

			// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
			'theme_pro_key'       => 'env-themerex',

			'theme_doc_url'       => '//printo.themerex.net/doc',

			'theme_demofiles_url' => '//demofiles.themerex.net/printo/',
			
			'theme_rate_url'      => '//themeforest.net/download',

			'theme_custom_url'    => '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themeinstall',

			'theme_support_url'   => '//themerex.net/support/',

			'theme_download_url'  => '//themeforest.net/user/themerex/portfolio',

			'theme_video_url'     => '//www.youtube.com/channel/UCnFisBimrK2aIE-hnY70kCA',   // ThemeREX

			'theme_privacy_url'   => '//themerex.net/privacy-policy/',                       // ThemeREX

			'portfolio_url'       => '//themeforest.net/user/themerex/portfolio',            // ThemeREX

			// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
			// (i.e. 'children,kindergarten')
			'theme_categories'    => '',
		) );
	}
}


// Add/remove/change Theme Settings
if ( ! function_exists( 'printo_skin_setup_settings' ) ) {
	add_action( 'after_setup_theme', 'printo_skin_setup_settings', 1 );
	function printo_skin_setup_settings() {
		// Example: enable (true) / disable (false) thumbs in the prev/next navigation
		printo_storage_set_array( 'settings', 'thumbs_in_navigation', false );
	}
}



//--------------------------------------------
// SKIN FONTS
//--------------------------------------------
if ( ! function_exists( 'printo_skin_setup_fonts' ) ) {
	add_action( 'after_setup_theme', 'printo_skin_setup_fonts', 1 );
	function printo_skin_setup_fonts() {
		// Fonts to load when theme start
		// It can be:
		// - Google fonts (specify name, family and styles)
		// - Adobe fonts (specify name, family and link URL)
		// - uploaded fonts (specify name, family), placed in the folder css/font-face/font-name inside the skin folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		printo_storage_set(
			'load_fonts', array(
				array(
					'name'   => 'Open Sans',
					'family' => 'sans-serif',
					'link'   => '',
					'styles' => 'ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800'
				),
				array(
					'name'   => 'Red Hat Display',
					'family' => 'sans-serif',
					'link'   => '',
					'styles' => 'ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,300;1,400;1,500;1,600;1,700;1,900'
				),
				// Google font
				array(

				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		printo_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		// Settings of the main tags.
		// Default value of 'font-family' may be specified as reference to the array $load_fonts (see above)
		// or as comma-separated string.
		// In the second case (if 'font-family' is specified manually as comma-separated string):
		//    1) Font name with spaces in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
		//    2) If font-family inherit a value from the 'Main text' - specify 'inherit' as a value
		// example:
		// Correct:   'font-family' => basekit_get_load_fonts_family_string( $load_fonts[0] )
		// Correct:   'font-family' => 'Roboto,sans-serif'
		// Correct:   'font-family' => '"PT Serif",sans-serif'
		// Incorrect: 'font-family' => 'Roboto,sans-serif'
		// Incorrect: 'font-family' => 'PT Serif,sans-serif'

		$font_description = esc_html__( 'Font settings for the %s of the site. To ensure that the elements scale properly on mobile devices, please use only the following units: "rem", "em" or "ex"', 'printo' );

		printo_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'main text', 'printo' ) ),
					'font-family'     => '"Open Sans",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.62em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.57em',
				),
				'post'    => array(
					'title'           => esc_html__( 'Article text', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'article text', 'printo' ) ),
					'font-family'     => '',			// Example: '"PR Serif",serif',
					'font-size'       => '',			// Example: '1.286rem',
					'font-weight'     => '',			// Example: '400',
					'font-style'      => '',			// Example: 'normal',
					'line-height'     => '',			// Example: '1.75em',
					'text-decoration' => '',			// Example: 'none',
					'text-transform'  => '',			// Example: 'none',
					'letter-spacing'  => '',			// Example: '',
					'margin-top'      => '',			// Example: '0em',
					'margin-bottom'   => '',			// Example: '1.4em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H1', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
					'font-size'       => '3.167em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.04em',
					'margin-bottom'   => '0.46em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H2', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
					'font-size'       => '2.611em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.021em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.67em',
					'margin-bottom'   => '0.56em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H3', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
					'font-size'       => '1.944em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.086em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.94em',
					'margin-bottom'   => '0.72em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H4', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
					'font-size'       => '1.556em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.214em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.15em',
					'margin-bottom'   => '0.83em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H5', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
					'font-size'       => '1.333em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.417em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0',
					'margin-top'      => '1.3em',
					'margin-bottom'   => '0.84em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H6', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
					'font-size'       => '1.056em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.474em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.75em',
					'margin-bottom'   => '1.1em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'text of the logo', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
					'font-size'       => '1.5em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.05em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'buttons', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
					'font-size'       => '12px',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '20px',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '0.2em',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'input fields, dropdowns and textareas', 'printo' ) ),
					'font-family'     => 'inherit',
					'font-size'       => '16px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',     // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'post meta (author, categories, publish date, counters, share, etc.)', 'printo' ) ),
					'font-family'     => 'inherit',
					'font-size'       => '14px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'main menu items', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
					'font-size'       => '17px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.02em',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'dropdown menu items', 'printo' ) ),
					'font-family'     => '"Open Sans",sans-serif',
					'font-size'       => '15px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'other' => array(
					'title'           => esc_html__( 'Other', 'printo' ),
					'description'     => sprintf( $font_description, esc_html__( 'specific elements', 'printo' ) ),
					'font-family'     => '"Red Hat Display",sans-serif',
				),
			)
		);

		// Font presets
		printo_storage_set(
			'font_presets', array(
				'karla' => array(
								'title'  => esc_html__( 'Karla', 'printo' ),
								'load_fonts' => array(
													// Google font
													array(
														'name'   => 'Dancing Script',
														'family' => 'fantasy',
														'link'   => '',
														'styles' => '300,400,700',
													),
													// Google font
													array(
														'name'   => 'Sansita Swashed',
														'family' => 'fantasy',
														'link'   => '',
														'styles' => '300,400,700',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Dancing Script",fantasy',
														'font-size'       => '1.25rem',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
														'font-size'       => '4em',
													),
													'h2'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h3'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h4'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h5'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h6'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'logo'    => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'button'  => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'submenu' => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
												),
							),
				'roboto' => array(
								'title'  => esc_html__( 'Roboto', 'printo' ),
								'load_fonts' => array(
													// Google font
													array(
														'name'   => 'Noto Sans JP',
														'family' => 'serif',
														'link'   => '',
														'styles' => '300,300italic,400,400italic,700,700italic',
													),
													// Google font
													array(
														'name'   => 'Merriweather',
														'family' => 'sans-serif',
														'link'   => '',
														'styles' => '300,300italic,400,400italic,700,700italic',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Noto Sans JP",serif',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h2'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h3'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h4'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h5'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h6'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'logo'    => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'button'  => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'submenu' => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
												),
							),
				'garamond' => array(
								'title'  => esc_html__( 'Garamond', 'printo' ),
								'load_fonts' => array(
													// Adobe font
													array(
														'name'   => 'Europe',
														'family' => 'sans-serif',
														'link'   => 'https://use.typekit.net/qmj1tmx.css',
														'styles' => '',
													),
													// Adobe font
													array(
														'name'   => 'Sofia Pro',
														'family' => 'sans-serif',
														'link'   => 'https://use.typekit.net/qmj1tmx.css',
														'styles' => '',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Sofia Pro",sans-serif',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h2'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h3'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h4'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h5'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h6'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'logo'    => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'button'  => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'submenu' => array(
														'font-family'     => 'Europe,sans-serif',
													),
												),
							),
			)
		);
	}
}


//--------------------------------------------
// COLOR SCHEMES
//--------------------------------------------
if ( ! function_exists( 'printo_skin_setup_schemes' ) ) {
	add_action( 'after_setup_theme', 'printo_skin_setup_schemes', 1 );
	function printo_skin_setup_schemes() {

		// Theme colors for customizer
		// Attention! Inner scheme must be last in the array below
		printo_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'printo' ),
					'description' => esc_html__( 'Colors of the main content area', 'printo' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'printo' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'printo' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'printo' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'printo' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'printo' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'printo' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'printo' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'printo' ),
				),
			)
		);

		printo_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'printo' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'printo' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'printo' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'printo' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'printo' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'printo' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'printo' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'printo' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'printo' ),
					'description' => esc_html__( 'Color of the text inside this block', 'printo' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'printo' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'printo' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'printo' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'printo' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'printo' ),
					'description' => esc_html__( 'Color of the links inside this block', 'printo' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'printo' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'printo' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Accent 2', 'printo' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'printo' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Accent 2 hover', 'printo' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'printo' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Accent 3', 'printo' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'printo' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Accent 3 hover', 'printo' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'printo' ),
				),
			)
		);

		// Default values for each color scheme
		$schemes = array(

			// Color scheme: 'default'
			'default' => array(
				'title'    => esc_html__( 'Default', 'printo' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#F8F8F8', //ok RF 
					'bd_color'         => '#E1DFDF', //ok RF E5E5E5

					// Text and links colors
					'text'             => '#797C7F', //ok RF
					'text_light'       => '#A5A6AA', //ok
					'text_dark'        => '#1B1E25', //ok RF
					'text_link'        => '#EE5536', //ok RF
					'text_hover'       => '#DB4527', //ok RF
					'text_link2'       => '#E5B10D', //ok
					'text_hover2'      => '#D5A305', //ok
					'text_link3'       => '#393E4B', //ok
					'text_hover3'      => '#2B303D', //ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#ffffff', //ok
					'alter_bg_hover'   => '#F1F1F1', //ok
					'alter_bd_color'   => '#E1DFDF', //ok RF
					'alter_bd_hover'   => '#DCDCDC', //ok
					'alter_text'       => '#797C7F', //ok
					'alter_light'      => '#A5A6AA', //ok
					'alter_dark'       => '#1B1E25', //ok RF
					'alter_link'       => '#EE5536', //ok RF
					'alter_hover'      => '#DB4527', //ok RF
					'alter_link2'      => '#E5B10D', //ok
					'alter_hover2'     => '#D5A305', //ok
					'alter_link3'      => '#393E4B', //ok
					'alter_hover3'     => '#2B303D', //ok

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#1B1E25', //ok RF
					'extra_bg_hover'   => '#3f3d47',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#96999F', //ok
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#ffffff', // ok
					'extra_link'       => '#EE5536', //ok RF
					'extra_hover'      => '#ffffff', //ok
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent', //ok
					'input_bg_hover'   => 'transparent', //ok
					'input_bd_color'   => '#E1DFDF', //ok RF
					'input_bd_hover'   => '#1B1E25', //ok RF
					'input_text'       => '#A5A6AA', //ok
					'input_light'      => '#A5A6AA', //ok
					'input_dark'       => '#1B1E25', //ok RF

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#1B1E25', //ok RF
					'inverse_link'     => '#ffffff', //ok
					'inverse_hover'    => '#ffffff', //ok

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'dark'
			'dark'    => array(
				'title'    => esc_html__( 'Dark', 'printo' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#2C313D', //ok
					'bd_color'         => '#474B55', //ok #3C3F47

					// Text and links colors
					'text'             => '#D2D3D5', //ok
					'text_light'       => '#96999F', //ok
					'text_dark'        => '#F9F9F9', //ok +
					'text_link'        => '#EE5536', //ok RF
					'text_hover'       => '#DB4527', //ok RF
					'text_link2'       => '#E5B10D', //ok
					'text_hover2'      => '#D5A305', //ok
					'text_link3'       => '#393E4B', //ok
					'text_hover3'      => '#2B303D', //ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#1B1E25', //ok RF
					'alter_bg_hover'   => '#2C313D', //ok
					'alter_bd_color'   => '#474B55', //ok #323641
					'alter_bd_hover'   => '#53535C', //ok
					'alter_text'       => '#D2D3D5', //ok +
					'alter_light'      => '#96999F', //ok
					'alter_dark'       => '#F9F9F9', //ok +
					'alter_link'       => '#EE5536', //ok RF
					'alter_hover'      => '#DB4527', //ok RF
					'alter_link2'      => '#E5B10D', //ok
					'alter_hover2'     => '#D5A305', //ok
					'alter_link3'      => '#393E4B', //ok
					'alter_hover3'     => '#2B303D', //ok

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#1B1E25', // RF
					'extra_bg_hover'   => '#3f3d47',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#96999F',
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#ffffff',
					'extra_link'       => '#EE5536', //RF
					'extra_hover'      => '#ffffff',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => '#transparent', //ok
					'input_bg_hover'   => '#transparent', //ok
					'input_bd_color'   => '#474B55', //ok - #3C3F47
					'input_bd_hover'   => '#474B55', //ok - #3C3F47
					'input_text'       => '#D2D3D5', //ok
					'input_light'      => '#D2D3D5', //ok
					'input_dark'       => '#ffffff',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#e36650',
					'inverse_bd_hover' => '#cb5b47',
					'inverse_text'     => '#F9F9F9', //ok
					'inverse_light'    => '#6f6f6f',
					'inverse_dark'     => '#1B1E25', //ok RF
					'inverse_link'     => '#ffffff', //ok
					'inverse_hover'    => '#1B1E25', //ok RF

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'default'
			'light' => array(
				'title'    => esc_html__( 'Light', 'printo' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#ffffff', //ok - GO
					'bd_color'         => '#E1DFDF', //ok RF

					// Text and links colors
					'text'             => '#797C7F', //ok RF
					'text_light'       => '#A5A6AA', //ok
					'text_dark'        => '#1B1E25', //ok RF
					'text_link'        => '#EE5536', //ok RF
					'text_hover'       => '#DB4527', //ok RF
					'text_link2'       => '#E5B10D', //ok
					'text_hover2'      => '#D5A305', //ok
					'text_link3'       => '#393E4B', //ok
					'text_hover3'      => '#2B303D', //ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#F8F8F8', //ok - RF
					'alter_bg_hover'   => '#ffffff', //ok - GO
					'alter_bd_color'   => '#E1DFDF', //ok RF
					'alter_bd_hover'   => '#DCDCDC', //ok
					'alter_text'       => '#797C7F', //ok
					'alter_light'      => '#A5A6AA', //ok
					'alter_dark'       => '#1B1E25', //ok RF
					'alter_link'       => '#EE5536', //ok RF
					'alter_hover'      => '#DB4527', //ok RF
					'alter_link2'      => '#E5B10D', //ok
					'alter_hover2'     => '#D5A305', //ok
					'alter_link3'      => '#393E4B', //ok
					'alter_hover3'     => '#2B303D', //ok

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#1B1E25', //ok RF
					'extra_bg_hover'   => '#3f3d47',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#96999F', //ok
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#ffffff', // ok
					'extra_link'       => '#EE5536', //ok RF
					'extra_hover'      => '#ffffff', //ok
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent', //ok
					'input_bg_hover'   => 'transparent', //ok
					'input_bd_color'   => '#E1DFDF', //ok RF
					'input_bd_hover'   => '#1B1E25', //ok RF
					'input_text'       => '#A5A6AA', //ok
					'input_light'      => '#A5A6AA', //ok
					'input_dark'       => '#1B1E25', //ok RF

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#1B1E25', //ok RF
					'inverse_link'     => '#ffffff', //ok
					'inverse_hover'    => '#ffffff', //ok

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),
		);
		printo_storage_set( 'schemes', $schemes );
		printo_storage_set( 'schemes_original', $schemes );

		// Add names of additional colors
		//---> For example:
		//---> printo_storage_set_array( 'scheme_color_names', 'new_color1', array(
		//---> 	'title'       => __( 'New color 1', 'printo' ),
		//---> 	'description' => __( 'Description of the new color 1', 'printo' ),
		//---> ) );


		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		printo_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_00' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
                'alter_dark_015'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.15,
                ),
                'alter_dark_02'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.2,
                ),
                'alter_dark_05'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.5,
                ),
                'alter_dark_08'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.8,
                ),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_05' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.5,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
                'text_dark_003'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.03,
                ),
                'text_dark_005'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.05,
                ),
                'text_dark_008'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.08,
                ),
				'text_dark_015'      => array(
					'color' => 'text_dark',
					'alpha' => 0.15,
				),
				'text_dark_02'      => array(
					'color' => 'text_dark',
					'alpha' => 0.2,
				),
                'text_dark_03'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.3,
                ),
                'text_dark_05'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.5,
                ),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
                'text_dark_08'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.8,
                ),
                'text_link_007'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.07,
                ),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
                'text_link_03'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.3,
                ),
				'text_link_04'      => array(
					'color' => 'text_link',
					'alpha' => 0.4,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
				'text_link2_08'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.8,
                ),
                'text_link2_007'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.07,
                ),
				'text_link2_02'      => array(
					'color' => 'text_link2',
					'alpha' => 0.2,
				),
                'text_link2_03'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.3,
                ),
				'text_link2_05'      => array(
					'color' => 'text_link2',
					'alpha' => 0.5,
				),
                'text_link3_007'      => array(
                    'color' => 'text_link3',
                    'alpha' => 0.07,
                ),
				'text_link3_02'      => array(
					'color' => 'text_link3',
					'alpha' => 0.2,
				),
                'text_link3_03'      => array(
                    'color' => 'text_link3',
                    'alpha' => 0.3,
                ),
                'inverse_text_03'      => array(
                    'color' => 'inverse_text',
                    'alpha' => 0.3,
                ),
                'inverse_link_08'      => array(
                    'color' => 'inverse_link',
                    'alpha' => 0.8,
                ),
                'inverse_hover_08'      => array(
                    'color' => 'inverse_hover',
                    'alpha' => 0.8,
                ),
				'text_dark_blend'   => array(
					'color'      => 'text_dark',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Simple scheme editor: lists the colors to edit in the "Simple" mode.
		// For each color you can set the array of 'slave' colors and brightness factors that are used to generate new values,
		// when 'main' color is changed
		// Leave 'slave' arrays empty if your scheme does not have a color dependency
		printo_storage_set(
			'schemes_simple', array(
				'text_link'        => array(),
				'text_hover'       => array(),
				'text_link2'       => array(),
				'text_hover2'      => array(),
				'text_link3'       => array(),
				'text_hover3'      => array(),
				'alter_link'       => array(),
				'alter_hover'      => array(),
				'alter_link2'      => array(),
				'alter_hover2'     => array(),
				'alter_link3'      => array(),
				'alter_hover3'     => array(),
				'extra_link'       => array(),
				'extra_hover'      => array(),
				'extra_link2'      => array(),
				'extra_hover2'     => array(),
				'extra_link3'      => array(),
				'extra_hover3'     => array(),
			)
		);

		// Parameters to set order of schemes in the css
		printo_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// Color presets
		printo_storage_set(
			'color_presets', array(
				'autumn' => array(
								'title'  => esc_html__( 'Autumn', 'printo' ),
								'colors' => array(
												'default' => array(
																	'text_link'  => '#d83938',
																	'text_hover' => '#f2b232',
																	),
												'dark' => array(
																	'text_link'  => '#d83938',
																	'text_hover' => '#f2b232',
																	)
												)
							),
				'green' => array(
								'title'  => esc_html__( 'Natural Green', 'printo' ),
								'colors' => array(
												'default' => array(
																	'text_link'  => '#75ac78',
																	'text_hover' => '#378e6d',
																	),
												'dark' => array(
																	'text_link'  => '#75ac78',
																	'text_hover' => '#378e6d',
																	)
												)
							),
			)
		);
	}
}


// Enqueue clone specific style
if ( ! function_exists( 'printo_clone_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'printo_clone_frontend_scripts', 1150 );
	function printo_clone_frontend_scripts() {
		$printo_url = printo_get_file_url( printo_skins_get_current_skin_dir() . 'extra-style.css' );
		if ( '' != $printo_url ) {
			wp_enqueue_style( 'printo-extra-skin-' . esc_attr( printo_skins_get_current_skin_name() ), $printo_url, array(), null );
		}
	}
}

// Custom styles
$printo_clone_style_path = printo_get_file_dir( printo_skins_get_current_skin_dir() . 'extra-style.php' );
if ( ! empty( $printo_clone_style_path ) ) {
	require_once $printo_clone_style_path;
}


// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'printo_clone_skin_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'printo_clone_skin_theme_setup3', 3 );
	function printo_clone_skin_theme_setup3() {
		printo_storage_set_array_after( 'options', 'remove_margins', array(
			'extra_bg_image' => array(
				"title" => esc_html__('Extra background image', 'printo'),
				"desc" => wp_kses_data( __('Select or upload background-image to display it in the page. Does not work for boxed body style.', 'printo') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'printo')
				),
				'dependency' => array(
					'body_style' => array( 'wide', 'fullwide', 'fullscreen' ),
				),
				"std" => '',
				'pro_only'   => PRINTO_THEME_FREE,
				"type" => "image"
			),
			'extra_bg_image_size' => array(
				"title" => esc_html__('Extra background image size', 'printo'),
				"desc" => wp_kses_data( __('Use size contain (cover original).', 'printo') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'printo')
				),
				'dependency' => array(
					'body_style' => array( 'wide', 'fullwide', 'fullscreen' ),
				),
				"std" => 0,
				'pro_only'   => PRINTO_THEME_FREE,
				"type" => "switch"
			),

			'use_extra_style' => array(
				'title' => esc_html__('Use custom BG layout', 'printo'),
				'desc' => wp_kses_data( __('Use the layout as the background of the site.', 'printo') ),
				'std' => 0,
				'override'   => array(
					'mode'    => 'page',
					'section' => esc_html__( 'Content', 'printo' ),
				),
				'pro_only'   => PRINTO_THEME_FREE,
				'type' => 'switch'
			),
			'extra_style' => array(
				'title'      => esc_html__( 'Select custom layout', 'printo' ),
				'desc'       => wp_kses( __( 'Select custom BG from Layouts Builder', 'printo' ), 'printo_kses_content' ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'printo')
				),		
				'dependency' => array(
					'use_extra_style' => array( 1 )
				),		
				'std'        => '',
				'options'    => array(),
				'pro_only'   => PRINTO_THEME_FREE,
				'type'       => 'select',
			),
			)
		);		
	}
}



// Add custom list layouts
if ( ! function_exists( 'printo_skin_options_get_list_choises' ) ) {
    add_action('printo_filter_options_get_list_choises', 'printo_skin_options_get_list_choises', 11, 2);
    function printo_skin_options_get_list_choises($list, $id) {
		if ( strpos( $id, 'extra_style' ) === 0 ) {
			$list = printo_skin_trx_addons_list_custom_styles();
		} 
        return $list;
    }
}

if ( ! function_exists( 'printo_skin_trx_addons_list_custom_styles' ) ) {
	function printo_skin_trx_addons_list_custom_styles( $list = array() ) {
		if ( printo_exists_layouts() ) {
			$layouts  = printo_get_list_posts(
				false, array(
					'post_type'    => TRX_ADDONS_CPT_LAYOUTS_PT,
					'meta_key'     => 'trx_addons_layout_type',
					'meta_value'   => 'custom',
					'orderby'      => 'ID',
					'order'        => 'asc',
					'not_selected' => false,
				)
			);
			$new_list = array();
			foreach ( $layouts as $id => $title ) {
				if ( 'none' != $id ) {
					$new_list[ 'extra-custom-' . intval( $id ) ] = $title;
				}
			}
			$list = printo_array_merge( $new_list, $list );
		}
		$list = printo_array_merge( array( 'inherit' => esc_html__( 'Inherit', 'printo' ) ), $list );
		return $list;
	}
}

if ( ! function_exists( 'printo_skin_get_custom_bg_layout_id' ) ) {
	function printo_skin_get_custom_bg_layout_id() {
		static $layout_id = -1;
		if ( -1 == $layout_id /*&& printo_get_theme_option( 'header_type' ) == 'custom'*/ ) {
			$layout_id = printo_get_custom_layout_id( 'extra' );
		}
		return $layout_id;
	}
}

if ( ! function_exists( 'printo_skin_custom_bg_layout' ) ) {
    add_action('printo_action_page_wrap_start', 'printo_skin_custom_bg_layout');
    function printo_skin_custom_bg_layout() {
		$use_extra_style = printo_is_on(printo_get_theme_option('use_extra_style'));
		$layout_style = printo_skin_get_custom_bg_layout_id();
		if($use_extra_style) {
			// Catch output to the buffer
			ob_start();
			do_action( 'printo_action_show_layout', $layout_style  );
			$printo_out = trim( ob_get_contents() );
			ob_end_clean();
			if ( ! empty( $printo_out ) ) { ?>
				<div class="custom_bg_layout_area">
					<?php printo_show_layout($printo_out); ?>
				</div>
			<?php
			}
		}
    }
}


// add body class
if ( ! function_exists( 'printo_skin_filter_body_wrap_class' ) ) {
    add_action('printo_filter_body_wrap_class', 'printo_skin_filter_body_wrap_class');
    function printo_skin_filter_body_wrap_class($class) {
		$use_extra_style = printo_is_on(printo_get_theme_option('use_extra_style'));
		$layout_style = printo_get_theme_option( "extra_style" );
		if($use_extra_style && !printo_is_off($layout_style) && !printo_is_inherit($layout_style)) {
			$class = $class . ' extra_bg_layout';
		}

        return $class;
    }
}

if ( ! function_exists( 'printo_skin_filter_page_wrap_class' ) ) {
    add_action('printo_filter_page_wrap_class', 'printo_skin_filter_page_wrap_class');
    function printo_skin_filter_page_wrap_class($class) {
        $extra_bg_image = printo_get_theme_option('extra_bg_image');
        $extra_bg_image_size = printo_is_on(printo_get_theme_option('extra_bg_image_size'));
        $body_boxed_style = printo_get_theme_option( 'body_style' ) == 'boxed';
        if (!empty( $extra_bg_image ) && !$body_boxed_style ) {
            $custom_bg = ' ' . 'with_bg' .($extra_bg_image_size ? ' contain_size' : ''). ' ' . printo_add_inline_css_class('background-image: url(' . esc_url($extra_bg_image) . ');');
            $class = $class . $custom_bg;
        }
        return $class;
    }
}


// Filter to add/remove shortcodes
if ( ! function_exists( 'printo_skin_trx_addons_sc_list_additionally' ) ) {
	add_filter('trx_addons_sc_list', 'printo_skin_trx_addons_sc_list_additionally', 11);
	function printo_skin_trx_addons_sc_list_additionally( $list = array() ) {

        // Grid Style 7
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_7'] = array(
            'title'  => esc_html__('Grid style 7', 'printo'),
            'args' => array( /*'hover' => 'link' - specific hovers work satisfactorily*/ ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                        ),
                // Three posts
                        array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                        ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                        ),
                // Seven posts
                        array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                ),
                array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                        ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

		return $list;
	}
}


// Activation methods
if ( ! function_exists( 'printo_skin_filter_activation_methods2' ) ) {
    add_filter( 'trx_addons_filter_activation_methods', 'printo_skin_filter_activation_methods2', 11, 1 );
    function printo_skin_filter_activation_methods2( $args ) {
        $args['elements_key'] = true;
        return $args;
    }
}