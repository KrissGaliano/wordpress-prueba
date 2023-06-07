<?php
/**
 * The style "default" of the IGenerator
 *
 * @package ThemeREX Addons
 * @since v2.20.2
 */

$args = get_query_var('trx_addons_args_sc_igenerator');

?><div <?php if ( ! empty( $args['id'] ) ) echo ' id="' . esc_attr( $args['id'] ) . '"'; ?> 
	class="sc_igenerator sc_igenerator_<?php
		echo esc_attr( $args['type'] );
		if ( ! empty( $args['class'] ) ) echo ' ' . esc_attr( $args['class'] );
		?>"<?php
	if ( ! empty( $args['css'] ) ) echo ' style="' . esc_attr( $args['css'] ) . '"';
	trx_addons_sc_show_attributes( 'sc_igenerator', $args, 'sc_wrapper' );
	?>><?php

	trx_addons_sc_show_titles('sc_igenerator', $args);

	?><div class="sc_igenerator_content sc_item_content"<?php trx_addons_sc_show_attributes( 'sc_igenerator', $args, 'sc_items_wrapper' ); ?>>
		<div class="sc_igenerator_form"
			data-igenerator-settings="<?php
				echo esc_attr( trx_addons_sc_igenerator_encode_settings( array(
					'number' => $args['number'],
					'columns' => $args['columns'],
					'columns_tablet' => $args['columns_tablet'],
					'columns_mobile' => $args['columns_mobile'],
					'size' => $args['size'],
					'demo_thumb_size' => $args['demo_thumb_size'],
					'demo_images' => $args['demo_images'],
				) ) );
			?>">
			<div class="sc_igenerator_form_inner<?php
				if ( empty( $args['prompt_width_extra'] ) &&  ! empty( $args['prompt_width'] ) && (int)$args['prompt_width'] < 100 ) {
					echo ' ' . esc_attr( trx_addons_add_inline_css_class( 'width: ' . $args['prompt_width'] . '%' ) );
				}
			?>">
				<div class="sc_igenerator_form_field sc_igenerator_form_field_prompt">
					<input type="text" value="<?php echo esc_attr( $args['prompt'] ); ?>" class="sc_igenerator_form_field_prompt_text" placeholder="<?php esc_attr_e('Describe what you want or hit a tag below', 'trx_addons'); ?>">
					<a href="#" class="sc_igenerator_form_field_prompt_button<?php if ( empty( $args['prompt'] ) ) echo ' sc_igenerator_form_field_prompt_button_disabled'; ?>"><?php esc_html_e('Generate', 'trx_addons'); ?></a>
				</div>
				<div class="sc_igenerator_form_field sc_igenerator_form_field_tags"><?php
					if ( ! empty( $args['tags_label'] ) ) {
						?><span class="sc_igenerator_form_field_tags_label"><?php echo esc_html( $args['tags_label'] ); ?></span><?php
					}
					if ( ! empty( $args['tags'] ) && is_array( $args['tags'] ) ) {
						?><span class="sc_igenerator_form_field_tags_list"><?php
							foreach ( $args['tags'] as $tag ) {
								?><a href="#" class="sc_igenerator_form_field_tags_item" data-tag-prompt="<?php echo esc_attr( $tag['prompt'] ); ?>"><?php echo esc_html( $tag['title'] ); ?></a><?php
							}
						?></span><?php
					}
				?></div>
			</div>
			<div class="trx_addons_loading"></div>
			<div class="sc_igenerator_message"></div>
		</div>
		<div class="sc_igenerator_images sc_igenerator_images_columns_<?php echo esc_attr( $args['columns'] ); ?> sc_igenerator_images_size_<?php echo esc_attr( $args['size'] ); ?>"></div>
	</div>

	<?php trx_addons_sc_show_links('sc_igenerator', $args); ?>

</div>