<div class="front_page_section front_page_section_testimonials<?php
	$printo_scheme = printo_get_theme_option( 'front_page_testimonials_scheme' );
	if ( ! empty( $printo_scheme ) && ! printo_is_inherit( $printo_scheme ) ) {
		echo ' scheme_' . esc_attr( $printo_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( printo_get_theme_option( 'front_page_testimonials_paddings' ) );
	if ( printo_get_theme_option( 'front_page_testimonials_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$printo_css      = '';
		$printo_bg_image = printo_get_theme_option( 'front_page_testimonials_bg_image' );
		if ( ! empty( $printo_bg_image ) ) {
			$printo_css .= 'background-image: url(' . esc_url( printo_get_attachment_url( $printo_bg_image ) ) . ');';
		}
		if ( ! empty( $printo_css ) ) {
			echo ' style="' . esc_attr( $printo_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$printo_anchor_icon = printo_get_theme_option( 'front_page_testimonials_anchor_icon' );
	$printo_anchor_text = printo_get_theme_option( 'front_page_testimonials_anchor_text' );
if ( ( ! empty( $printo_anchor_icon ) || ! empty( $printo_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_testimonials"'
									. ( ! empty( $printo_anchor_icon ) ? ' icon="' . esc_attr( $printo_anchor_icon ) . '"' : '' )
									. ( ! empty( $printo_anchor_text ) ? ' title="' . esc_attr( $printo_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_testimonials_inner
	<?php
	if ( printo_get_theme_option( 'front_page_testimonials_fullheight' ) ) {
		echo ' printo-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$printo_css      = '';
			$printo_bg_mask  = printo_get_theme_option( 'front_page_testimonials_bg_mask' );
			$printo_bg_color_type = printo_get_theme_option( 'front_page_testimonials_bg_color_type' );
			if ( 'custom' == $printo_bg_color_type ) {
				$printo_bg_color = printo_get_theme_option( 'front_page_testimonials_bg_color' );
			} elseif ( 'scheme_bg_color' == $printo_bg_color_type ) {
				$printo_bg_color = printo_get_scheme_color( 'bg_color', $printo_scheme );
			} else {
				$printo_bg_color = '';
			}
			if ( ! empty( $printo_bg_color ) && $printo_bg_mask > 0 ) {
				$printo_css .= 'background-color: ' . esc_attr(
					1 == $printo_bg_mask ? $printo_bg_color : printo_hex2rgba( $printo_bg_color, $printo_bg_mask )
				) . ';';
			}
			if ( ! empty( $printo_css ) ) {
				echo ' style="' . esc_attr( $printo_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_testimonials_content_wrap content_wrap">
			<?php
			// Caption
			$printo_caption = printo_get_theme_option( 'front_page_testimonials_caption' );
			if ( ! empty( $printo_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_testimonials_caption front_page_block_<?php echo ! empty( $printo_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $printo_caption, 'printo_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$printo_description = printo_get_theme_option( 'front_page_testimonials_description' );
			if ( ! empty( $printo_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_testimonials_description front_page_block_<?php echo ! empty( $printo_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $printo_description ), 'printo_kses_content' ); ?></div>
				<?php
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_testimonials_output">
				<?php
				if ( is_active_sidebar( 'front_page_testimonials_widgets' ) ) {
					dynamic_sidebar( 'front_page_testimonials_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! printo_exists_trx_addons() ) {
						printo_customizer_need_trx_addons_message();
					} else {
						printo_customizer_need_widgets_message( 'front_page_testimonials_caption', 'ThemeREX Addons - Testimonials' );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
