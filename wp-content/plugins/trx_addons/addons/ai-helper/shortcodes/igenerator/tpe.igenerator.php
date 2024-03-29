<?php
/**
 * Template to represent shortcode as a widget in the Elementor preview area
 *
 * Written as a Backbone JavaScript template and using to generate the live preview in the Elementor's Editor
 *
 * @package ThemeREX Addons
 * @since v2.20.2
 */

extract( get_query_var( 'trx_addons_args_sc_igenerator' ) );
?><#
settings = trx_addons_elm_prepare_global_params( settings );

var id = settings._element_id ? settings._element_id + '_sc' : 'sc_igenerator_' + ( '' + Math.random() ).replace( '.', '' );

var link_class = "<?php echo apply_filters('trx_addons_filter_sc_item_link_classes', 'sc_igenerator_item_link sc_button sc_button_size_small', 'sc_igenerator'); ?>";
var link_class_over = "<?php echo apply_filters('trx_addons_filter_sc_item_link_classes', 'sc_igenerator_item_link sc_igenerator_item_link_over', 'sc_igenerator'); ?>";

#><div id="{{ id }}" class="<# print( trx_addons_apply_filters('trx_addons_filter_sc_classes', 'sc_igenerator sc_igenerator_' + settings.type, settings ) ); #>">

	<?php $element->sc_show_titles( 'sc_igenerator' ); ?>

	<div class="sc_igenerator_content sc_item_content">
		<div class="sc_igenerator_form">
			<div class="sc_igenerator_form_inner">
				<div class="sc_igenerator_form_field sc_igenerator_form_field_prompt">
					<input type="text" value="{{ settings.prompt }}" class="sc_igenerator_form_field_prompt_text" placeholder="<?php esc_attr_e('Describe what you want or hit a tag below', 'trx_addons'); ?>">
					<a href="#" class="sc_igenerator_form_field_prompt_button<# if ( ! settings.prompt ) print( ' sc_igenerator_form_field_prompt_button_disabled' ); #>"><?php esc_html_e('Generate', 'trx_addons'); ?></a>
				</div>
				<div class="sc_igenerator_form_field sc_igenerator_form_field_tags">
					<span class="sc_igenerator_form_field_tags_label">{{ settings.tags_label }}</span>
					<span class="sc_igenerator_form_field_tags_list"><#
						_.each( settings.tags, function( tag ) {
							#><a href="#" class="sc_igenerator_form_field_tags_item" data-tag-prompt="{{ tag.prompt }}">{{ tag.title }}</a><#
						} );
					#></span>
				</div>
			</div>
		</div>
		<div class="sc_igenerator_images sc_igenerator_images_columns_{{ settings.number.size }} sc_igenerator_images_size_{{ settings.size.size }}"></div>
	</div>

	<?php $element->sc_show_links('sc_igenerator'); ?>

</div><#

settings = trx_addons_elm_restore_global_params( settings );
#>