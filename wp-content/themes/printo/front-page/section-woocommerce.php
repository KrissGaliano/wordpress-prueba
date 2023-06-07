<?php
$printo_woocommerce_sc = printo_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $printo_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$printo_scheme = printo_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $printo_scheme ) && ! printo_is_inherit( $printo_scheme ) ) {
			echo ' scheme_' . esc_attr( $printo_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( printo_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( printo_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$printo_css      = '';
			$printo_bg_image = printo_get_theme_option( 'front_page_woocommerce_bg_image' );
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
		$printo_anchor_icon = printo_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$printo_anchor_text = printo_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $printo_anchor_icon ) || ! empty( $printo_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $printo_anchor_icon ) ? ' icon="' . esc_attr( $printo_anchor_icon ) . '"' : '' )
											. ( ! empty( $printo_anchor_text ) ? ' title="' . esc_attr( $printo_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( printo_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' printo-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$printo_css      = '';
				$printo_bg_mask  = printo_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$printo_bg_color_type = printo_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $printo_bg_color_type ) {
					$printo_bg_color = printo_get_theme_option( 'front_page_woocommerce_bg_color' );
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
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$printo_caption     = printo_get_theme_option( 'front_page_woocommerce_caption' );
				$printo_description = printo_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $printo_caption ) || ! empty( $printo_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $printo_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $printo_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $printo_caption, 'printo_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $printo_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $printo_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $printo_description ), 'printo_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $printo_woocommerce_sc ) {
						$printo_woocommerce_sc_ids      = printo_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$printo_woocommerce_sc_per_page = count( explode( ',', $printo_woocommerce_sc_ids ) );
					} else {
						$printo_woocommerce_sc_per_page = max( 1, (int) printo_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$printo_woocommerce_sc_columns = max( 1, min( $printo_woocommerce_sc_per_page, (int) printo_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$printo_woocommerce_sc}"
										. ( 'products' == $printo_woocommerce_sc
												? ' ids="' . esc_attr( $printo_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $printo_woocommerce_sc
												? ' category="' . esc_attr( printo_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $printo_woocommerce_sc
												? ' orderby="' . esc_attr( printo_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( printo_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $printo_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $printo_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
