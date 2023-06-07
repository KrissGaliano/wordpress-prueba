<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package PRINTO
 * @since PRINTO 1.0
 */

							do_action( 'printo_action_page_content_end_text' );
							
							// Widgets area below the content
							printo_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'printo_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'printo_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'printo_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'printo_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$printo_body_style = printo_get_theme_option( 'body_style' );
					$printo_widgets_name = printo_get_theme_option( 'widgets_below_page' );
					$printo_show_widgets = ! printo_is_off( $printo_widgets_name ) && is_active_sidebar( $printo_widgets_name );
					$printo_show_related = printo_is_single() && printo_get_theme_option( 'related_position' ) == 'below_page';
					if ( $printo_show_widgets || $printo_show_related ) {
						if ( 'fullscreen' != $printo_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $printo_show_related ) {
							do_action( 'printo_action_related_posts' );
						}

						// Widgets area below page content
						if ( $printo_show_widgets ) {
							printo_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $printo_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'printo_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'printo_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! printo_is_singular( 'post' ) && ! printo_is_singular( 'attachment' ) ) || ! in_array ( printo_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="printo_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'printo_action_before_footer' );

				// Footer
				$printo_footer_type = printo_get_theme_option( 'footer_type' );
				if ( 'custom' == $printo_footer_type && ! printo_is_layouts_available() ) {
					$printo_footer_type = 'default';
				}
				get_template_part( apply_filters( 'printo_filter_get_template_part', "templates/footer-" . sanitize_file_name( $printo_footer_type ) ) );

				do_action( 'printo_action_after_footer' );

			}
			?>

			<?php do_action( 'printo_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'printo_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'printo_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>