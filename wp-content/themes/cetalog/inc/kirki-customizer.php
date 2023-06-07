<?php
/**
 * cetalog customizer
 *
 * @package cetalog
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function cetalog_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'cetalog_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'Cetalog Customizer', 'cetalog' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'header_top_setting', [
        'title'       => esc_html__( 'Header Info Setting', 'cetalog' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'section_header_logo', [
        'title'       => esc_html__( 'Header Setting', 'cetalog' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'header_social', [
        'title'       => esc_html__( 'Header Social', 'cetalog' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'cetalog' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'header_side_setting', [
        'title'       => esc_html__( 'Side Info', 'cetalog' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'cetalog' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'cetalog' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'cetalog' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'color_setting', [
        'title'       => esc_html__( 'Color Setting', 'cetalog' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'cetalog' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'typo_setting', [
        'title'       => esc_html__( 'Typography Setting', 'cetalog' ),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

    $wp_customize->add_section( 'slug_setting', [
        'title'       => esc_html__( 'Slug Settings', 'cetalog' ),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
        'panel'       => 'cetalog_customizer',
    ] );

}

add_action( 'customize_register', 'cetalog_customizer_panels_sections' );

function _header_top_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_preloader',
        'label'    => esc_html__( 'Preloader On/Off', 'cetalog' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];


    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_backtotop',
        'label'    => esc_html__( 'Back To Top On/Off', 'cetalog' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_header_right',
        'label'    => esc_html__( 'Header Right On/Off', 'cetalog' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_search',
        'label'    => esc_html__( 'Header Search On/Off', 'cetalog' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];

    // button 1 title
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_hbtn1_title',
        'label'    => esc_html__( 'Button 1 Title', 'cetalog' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Login', 'cetalog' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_hbtn1_url',
        'label'    => esc_html__( 'Button 1 URL', 'cetalog' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'cetalog' ),
        'priority' => 10,
    ];

    // button 2 title
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_hbtn2_title',
        'label'    => esc_html__( 'Button 2 Title', 'cetalog' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Contact Us', 'cetalog' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_hbtn2_url',
        'label'    => esc_html__( 'Button 2 URL', 'cetalog' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'cetalog' ),
        'priority' => 10,
    ];

    

    return $fields;

}
add_filter( 'kirki/fields', '_header_top_fields' );

/*
Header Social
 */
function _header_social_fields( $fields ) {
    // header section social
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'header_social_switch',
        'label'    => esc_html__( 'Header Social On/Off', 'cetalog' ),
        'section'  => 'header_social',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_topbar_fb_url',
        'label'    => esc_html__( 'Facebook URL', 'cetalog' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_topbar_twitter_url',
        'label'    => esc_html__( 'Twitter URL', 'cetalog' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_topbar_linkedin_url',
        'label'    => esc_html__( 'Linkedin URL', 'cetalog' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_topbar_instagram_url',
        'label'    => esc_html__( 'Instagram URL', 'cetalog' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_topbar_youtube_url',
        'label'    => esc_html__( 'Youtube URL', 'cetalog' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_topbar_skype_url',
        'label'    => esc_html__( 'Skype URL', 'cetalog' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'cetalog' ),
        'priority' => 10,
    ];


    return $fields;
}
add_filter( 'kirki/fields', '_header_social_fields' );

/*
Header Settings
 */
function _header_header_fields( $fields ) {
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'cetalog' ),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__( 'Select an option...', 'cetalog' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
            'header-style-3' => get_template_directory_uri() . '/inc/img/header/header-3.png',
        ],
        'default'     => 'header-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'cetalog' ),
        'description' => esc_html__( 'Upload Your Logo.', 'cetalog' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__( 'Header Secondary Logo', 'cetalog' ),
        'description' => esc_html__( 'Header Logo Black', 'cetalog' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'preloader_logo',
        'label'       => esc_html__( 'Preloader Logo', 'cetalog' ),
        'description' => esc_html__( 'Upload Preloader Logo.', 'cetalog' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/favicon.png',
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_header_fields' );

/*
Header Side Info
 */
function _header_side_fields( $fields ) {
    // side info settings
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_side_hide',
        'label'    => esc_html__( 'Side Info On/Off', 'cetalog' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];  

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'cetalog_side_logo',
        'label'       => esc_html__( 'Logo Side', 'cetalog' ),
        'description' => esc_html__( 'Logo Side', 'cetalog' ),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    // side title
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_side_title',
        'label'    => esc_html__( 'Title', 'cetalog' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'ELEVATE YOUR BUSINESS WITH', 'cetalog' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'cetalog_side_text',
        'label'    => esc_html__( 'Side Description Text', 'cetalog' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Limitless customization options & Elementor compatibility let.', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'cetalog_side_img',
        'label'       => esc_html__( 'Side Image', 'cetalog' ),
        'section'     => 'header_side_setting',
    ];

    // btn-title
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_side_button_title',
        'label'    => esc_html__( 'Button Title', 'cetalog' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'GET IN TOUCH', 'cetalog' ),
        'priority' => 10,
    ];

    // btn-link
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_side_button_link',
        'label'    => esc_html__( 'Button Link', 'cetalog' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'cetalog' ),
        'priority' => 10,
    ];

    // contact
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_side_phone',
        'label'    => esc_html__( 'Phone Number', 'cetalog' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '+0989787698659', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_side_email',
        'label'    => esc_html__( 'Email ID', 'cetalog' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'info@themepure.net', 'cetalog' ),
        'priority' => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_side_fields' );

/*
_header_page_title_fields
 */
function _header_page_title_fields( $fields ) {
    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'cetalog' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'cetalog' ),
        'section'     => 'breadcrumb_setting',
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'cetalog' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'cetalog' ),
        'section'     => 'breadcrumb_setting',
        'default'     => '#666E8F',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_info_switch',
        'label'    => esc_html__( 'Breadcrumb Info switch', 'cetalog' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_blog_btn_switch',
        'label'    => esc_html__( 'Blog BTN On/Off', 'cetalog' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta On/Off', 'cetalog' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_blog_author',
        'label'    => esc_html__( 'Blog Author Meta On/Off', 'cetalog' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_blog_date',
        'label'    => esc_html__( 'Blog Date Meta On/Off', 'cetalog' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta On/Off', 'cetalog' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'cetalog_singleblog_social',
        'label'    => esc_html__( 'Blog Details Social Meta On/Off', 'cetalog' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'cetalog' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read more', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'cetalog' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'cetalog' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'cetalog' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'cetalog' ),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'cetalog' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
            'footer-style-2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
        ],
        'default'     => 'footer-style-1',
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__( 'Widget Number', 'cetalog' ),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__( 'Select an option...', 'cetalog' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__( 'Widget Number 4', 'cetalog' ),
            '3' => esc_html__( 'Widget Number 3', 'cetalog' ),
            '2' => esc_html__( 'Widget Number 2', 'cetalog' ),
        ],
    ]; 

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'cetalog_footer_bg',
        'label'       => esc_html__( 'Footer Background Image.', 'cetalog' ),
        'description' => esc_html__( 'Footer Background Image.', 'cetalog' ),
        'section'     => 'footer_setting',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_footer_bg_color',
        'label'       => __( 'Footer BG Color', 'cetalog' ),
        'description' => esc_html__( 'This is a Footer bg color control.', 'cetalog' ),
        'section'     => 'footer_setting',
        'default'     => '#1A1819',
        'priority'    => 10,
    ];
    
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_2_switch',
        'label'    => esc_html__( 'Footer Style 2 On/Off', 'cetalog' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'cetalog' ),
            'off' => esc_html__( 'Disable', 'cetalog' ),
        ],
    ];    

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'cetalog_footer_menu',
        'label'    => esc_html__( 'Footer Menu', 'cetalog' ),
        'section'  => 'footer_setting',
        'priority' => 10,
    ];    

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_copyright',
        'label'    => esc_html__( 'Copy Right', 'cetalog' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copyright &copy; 2023 Theme_Pure. All Rights Reserved', 'cetalog' ),
        'priority' => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );

// color
function cetalog_color_fields( $fields ) {
    // Color Settings 1
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_theme_color_1',
        'label'       => __( 'Theme Color', 'cetalog' ),
        'description' => esc_html__( 'This is a Theme color control.', 'cetalog' ),
        'section'     => 'color_setting',
        'default'     => '#162DE4',
        'priority'    => 10,
    ];

    // Color Settings 2
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_theme_color_2',
        'label'       => __( 'Theme Color 2', 'cetalog' ),
        'description' => esc_html__( 'This is a Theme color control.', 'cetalog' ),
        'section'     => 'color_setting',
        'default'     => '#030A39',
        'priority'    => 10,
    ];

    // Color Settings 3
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_theme_color_3',
        'label'       => __( 'Theme Color 3', 'cetalog' ),
        'description' => esc_html__( 'This is a Theme color control.', 'cetalog' ),
        'section'     => 'color_setting',
        'default'     => '#FF3A8A',
        'priority'    => 10,
    ];

    // Color Settings 4
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_theme_color_4',
        'label'       => __( 'Theme Color 4', 'cetalog' ),
        'description' => esc_html__( 'This is a Theme color control.', 'cetalog' ),
        'section'     => 'color_setting',
        'default'     => '#7924C8',
        'priority'    => 10,
    ];

    // Heading Color Settings 1
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_theme_head_color_1',
        'label'       => __( 'Theme Heading Color 1', 'cetalog' ),
        'description' => esc_html__( 'This is a Theme heading color control.', 'cetalog' ),
        'section'     => 'color_setting',
        'default'     => '#000D44',
        'priority'    => 10,
    ];

    // Heading Color Settings 2
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_theme_head_color_2',
        'label'       => __( 'Theme Heading Color 2', 'cetalog' ),
        'description' => esc_html__( 'This is a Theme heading color control.', 'cetalog' ),
        'section'     => 'color_setting',
        'default'     => '#52525C',
        'priority'    => 10,
    ];

    // body color
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_theme_body_color',
        'label'       => __( 'Theme Body Color', 'cetalog' ),
        'description' => esc_html__( 'This is a Theme body color control.', 'cetalog' ),
        'section'     => 'color_setting',
        'default'     => '#727885',
        'priority'    => 10,
    ];

    // Gradient Color 1
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_theme_gra_1',
        'label'       => __( 'Gradient Primary Color', 'cetalog' ),
        'description' => esc_html__( 'This is a Theme gradient color control.', 'cetalog' ),
        'section'     => 'color_setting',
        'default'     => '#00EEFF',
        'priority'    => 10,
    ];

    // Gradient Color 2
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'cetalog_theme_gra_2',
        'label'       => __( 'Gradient Secondary Color', 'cetalog' ),
        'description' => esc_html__( 'This is a Theme gradient color control.', 'cetalog' ),
        'section'     => 'color_setting',
        'default'     => '#003CFF',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', 'cetalog_color_fields' );

// 404
function cetalog_404_fields( $fields ) {
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_error_title',
        'label'    => esc_html__( 'Not Found Title', 'cetalog' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Page not found', 'cetalog' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'cetalog_error_desc',
        'label'    => esc_html__( '404 Description Text', 'cetalog' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted', 'cetalog' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'cetalog' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'cetalog' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'cetalog_404_fields' );


/**
 * Added Fields
 */
function cetalog_typo_fields( $fields ) {
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__( 'Body Font', 'cetalog' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__( 'Heading h1 Fonts', 'cetalog' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__( 'Heading h2 Fonts', 'cetalog' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__( 'Heading h3 Fonts', 'cetalog' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__( 'Heading h4 Fonts', 'cetalog' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__( 'Heading h5 Fonts', 'cetalog' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__( 'Heading h6 Fonts', 'cetalog' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter( 'kirki/fields', 'cetalog_typo_fields' );

/**
 * Added Fields
 */
function cetalog_slug_setting( $fields ) {
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_ev_slug',
        'label'    => esc_html__( 'Event Slug', 'cetalog' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourevent', 'cetalog' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'cetalog_port_slug',
        'label'    => esc_html__( 'Portfolio Slug', 'cetalog' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourportfolio', 'cetalog' ),
        'priority' => 10,
    ];

    return $fields;
}

add_filter( 'kirki/fields', 'cetalog_slug_setting' );


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function CETALOG_THEME_option( $name ) {
    $value = '';
    if ( class_exists( 'cetalog' ) ) {
        $value = Kirki::get_option( cetalog_get_theme(), $name );
    }

    return apply_filters( 'CETALOG_THEME_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function cetalog_get_theme() {
    return 'cetalog';
}