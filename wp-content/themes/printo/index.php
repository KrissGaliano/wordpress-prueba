<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */

$printo_template = apply_filters( 'printo_filter_get_template_part', printo_blog_archive_get_template() );

if ( ! empty( $printo_template ) && 'index' != $printo_template ) {

	get_template_part( $printo_template );

} else {

	printo_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$printo_stickies   = is_home()
								|| ( in_array( printo_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) printo_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$printo_post_type  = printo_get_theme_option( 'post_type' );
		$printo_args       = array(
								'blog_style'     => printo_get_theme_option( 'blog_style' ),
								'post_type'      => $printo_post_type,
								'taxonomy'       => printo_get_post_type_taxonomy( $printo_post_type ),
								'parent_cat'     => printo_get_theme_option( 'parent_cat' ),
								'posts_per_page' => printo_get_theme_option( 'posts_per_page' ),
								'sticky'         => printo_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $printo_stickies )
															&& count( $printo_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		printo_blog_archive_start();

		do_action( 'printo_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'printo_action_before_page_author' );
			get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'printo_action_after_page_author' );
		}

		if ( printo_get_theme_option( 'show_filters' ) ) {
			do_action( 'printo_action_before_page_filters' );
			printo_show_filters( $printo_args );
			do_action( 'printo_action_after_page_filters' );
		} else {
			do_action( 'printo_action_before_page_posts' );
			printo_show_posts( array_merge( $printo_args, array( 'cat' => $printo_args['parent_cat'] ) ) );
			do_action( 'printo_action_after_page_posts' );
		}

		do_action( 'printo_action_blog_archive_end' );

		printo_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'printo_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
