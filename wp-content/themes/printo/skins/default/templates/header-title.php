<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */

// Page (category, tag, archive, author) title

if ( printo_need_page_title() ) {
	printo_sc_layouts_showed( 'title', true );
	printo_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								printo_show_post_meta(
									apply_filters(
										'printo_filter_post_meta_args', array(
											'components' => join( ',', printo_array_get_keys_by_value( printo_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', printo_array_get_keys_by_value( printo_get_theme_option( 'counters' ) ) ),
											'seo'        => printo_is_on( printo_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$printo_blog_title           = printo_get_blog_title();
							$printo_blog_title_text      = '';
							$printo_blog_title_class     = '';
							$printo_blog_title_link      = '';
							$printo_blog_title_link_text = '';
							if ( is_array( $printo_blog_title ) ) {
								$printo_blog_title_text      = $printo_blog_title['text'];
								$printo_blog_title_class     = ! empty( $printo_blog_title['class'] ) ? ' ' . $printo_blog_title['class'] : '';
								$printo_blog_title_link      = ! empty( $printo_blog_title['link'] ) ? $printo_blog_title['link'] : '';
								$printo_blog_title_link_text = ! empty( $printo_blog_title['link_text'] ) ? $printo_blog_title['link_text'] : '';
							} else {
								$printo_blog_title_text = $printo_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $printo_blog_title_class ); ?>">
								<?php
								$printo_top_icon = printo_get_term_image_small();
								if ( ! empty( $printo_top_icon ) ) {
									$printo_attr = printo_getimagesize( $printo_top_icon );
									?>
									<img src="<?php echo esc_url( $printo_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'printo' ); ?>"
										<?php
										if ( ! empty( $printo_attr[3] ) ) {
											printo_show_layout( $printo_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $printo_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $printo_blog_title_link ) && ! empty( $printo_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $printo_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $printo_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'printo_action_breadcrumbs' );
						$printo_breadcrumbs = ob_get_contents();
						ob_end_clean();
						printo_show_layout( $printo_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
