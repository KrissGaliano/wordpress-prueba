<div class="front_page_section front_page_section_subscribe<?php
	$printo_scheme = printo_get_theme_option( 'front_page_subscribe_scheme' );
	if ( ! empty( $printo_scheme ) && ! printo_is_inherit( $printo_scheme ) ) {
		echo ' scheme_' . esc_attr( $printo_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( printo_get_theme_option( 'front_page_subscribe_paddings' ) );
	if ( printo_get_theme_option( 'front_page_subscribe_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$printo_css      = '';
		$printo_bg_image = printo_get_theme_option( 'front_page_subscribe_bg_image' );
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
	$printo_anchor_icon = printo_get_theme_option( 'front_page_subscribe_anchor_icon' );
	$printo_anchor_text = printo_get_theme_option( 'front_page_subscribe_anchor_text' );
if ( ( ! empty( $printo_anchor_icon ) || ! empty( $printo_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_subscribe"'
									. ( ! empty( $printo_anchor_icon ) ? ' icon="' . esc_attr( $printo_anchor_icon ) . '"' : '' )
									. ( ! empty( $printo_anchor_text ) ? ' title="' . esc_attr( $printo_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_subscribe_inner
	<?php
	if ( printo_get_theme_option( 'front_page_subscribe_fullheight' ) ) {
		echo ' printo-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$printo_css      = '';
			$printo_bg_mask  = printo_get_theme_option( 'front_page_subscribe_bg_mask' );
			$printo_bg_color_type = printo_get_theme_option( 'front_page_subscribe_bg_color_type' );
			if ( 'custom' == $printo_bg_color_type ) {
				$printo_bg_color = printo_get_theme_option( 'front_page_subscribe_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_subscribe_content_wrap content_wrap">
			<?php
			// Caption
			$printo_caption = printo_get_theme_option( 'front_page_subscribe_caption' );
			if ( ! empty( $printo_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_subscribe_caption front_page_block_<?php echo ! empty( $printo_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $printo_caption, 'printo_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$printo_description = printo_get_theme_option( 'front_page_subscribe_description' );
			if ( ! empty( $printo_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_subscribe_description front_page_block_<?php echo ! empty( $printo_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $printo_description ), 'printo_kses_content' ); ?></div>
				<?php
			}

			// Content
			$printo_sc = printo_get_theme_option( 'front_page_subscribe_shortcode' );
			if ( ! empty( $printo_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_subscribe_output front_page_block_<?php echo ! empty( $printo_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					printo_show_layout( do_shortcode( $printo_sc ) );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
