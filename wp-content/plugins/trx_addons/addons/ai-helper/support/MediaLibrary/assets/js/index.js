/* global jQuery, TRX_ADDONS_STORAGE */

jQuery( document ).ready( function() {
	if ( ! wp.media ) {
		return;
	}
	var View = wp.media.View;
	var oldMediaFrameSelect = wp.media.view.MediaFrame.Select;
	var oldMediaFramePost = wp.media.view.MediaFrame.Post;
	var __ = wp.i18n.__;
	var l10n = wp.media.view.l10n;

	// Add a template to the media frame
	if ( jQuery( '#tmpl-trx-addons-ai-helper-image-generator').length == 0 ) {
		jQuery( 'body' ).append(
			`<script type="text/html" id="tmpl-trx-addons-ai-helper-image-generator">
				<div id="trx-addons-ai-helper-image-generator-inner">
					<div id="trx-addons-ai-helper-image-generator-header">
						<div id="trx-addons-ai-helper-image-generator-header-title">
							<h2>{{ data.title }}</h2>
						</div>
						<# if ( data.canClose ) { #>
							<button type="button" class="close media-modal-close" aria-label="Close dialog">
								<span class="media-modal-icon"></span>
							</button>
						<# } #>
					</div>
					<div id="trx-addons-ai-helper-image-generator-body">
						<div id="trx-addons-ai-helper-image-generator-settings">
							<div id="trx-addons-ai-helper-image-generator-settings-new">
								<div class="trx-addons-ai-helper-image-generator-settings-item">
									<label for="trx-addons-ai-helper-image-generator-template" class="trx-addons-ai-helper-image-generator-settings-item-title">{{ wp.i18n.__( 'Template' ) }}</label>
									<div class="trx-addons-ai-helper-image-generator-settings-item-field">
										<select id="trx-addons-ai-helper-image-generator-template">
											<# for ( var i in data.templates ) { #>
												<option value="{{ i }}"<# if ( i == data.template ) print(' selected') #>>{{ data.templates[i].title }}</option>
											<# } #>
										</select>
									</div>
								</div>
								<div class="trx-addons-ai-helper-image-generator-settings-item">
									<label for="trx-addons-ai-helper-image-generator-prompt" class="trx-addons-ai-helper-image-generator-settings-item-title">{{ wp.i18n.__( 'Prompt for AI' ) }}</label>
									<div class="trx-addons-ai-helper-image-generator-settings-item-field">
										<textarea id="trx-addons-ai-helper-image-generator-prompt" rows="3"
											placeholder="{{ wp.i18n.__( 'Your requirements for generated images' ) }}"><#
												if ( data.prompt ) {
													#>{{ data.prompt }}<#
												}
										#></textarea>
									</div>
								</div>
								<div class="trx-addons-ai-helper-image-generator-settings-item">
									<label for="trx-addons-ai-helper-image-generator-size" class="trx-addons-ai-helper-image-generator-settings-item-title">{{ wp.i18n.__( 'Size' ) }}</label>
									<div class="trx-addons-ai-helper-image-generator-settings-item-field">
										<select id="trx-addons-ai-helper-image-generator-size">
											<# for ( var i in data.sizes ) { #>
												<option value="{{ i }}"<# if ( i == data.size ) print(' selected') #>>{{ data.sizes[i] }}</option>
											<# } #>
										</select>
									</div>
								</div>
								<div class="trx-addons-ai-helper-image-generator-settings-item">
									<label for="trx-addons-ai-helper-image-generator-number" class="trx-addons-ai-helper-image-generator-settings-item-title">{{ wp.i18n.__( '# of images' ) }}</label>
									<div class="trx-addons-ai-helper-image-generator-settings-item-field">
										<select id="trx-addons-ai-helper-image-generator-number">
											<# for ( var n in data.numbers ) { #>
												<option value="{{ n }}"<# if ( n == data.number ) print(' selected') #>>{{ n }}</option>
											<# } #>
										</select>
										<label class="trx-addons-ai-helper-image-generator-append"><input id="trx-addons-ai-helper-image-generator-append" name="trx-addons-ai-helper-image-generator-append" type="radio" value="append"<# if ( data.append == 'append' ) { #> checked<# } #>>
												{{ wp.i18n.__( 'Append' ) }}
										</label>
										<label class="trx-addons-ai-helper-image-generator-append"><input id="trx-addons-ai-helper-image-generator-replace" name="trx-addons-ai-helper-image-generator-append" type="radio" value="replace"<# if ( data.append == 'replace' ) { #> checked<# } #>>
												{{ wp.i18n.__( 'Replace' ) }}
										</label>
									</div>
								</div>
								<div class="trx-addons-ai-helper-image-generator-settings-item">
									<button id="trx-addons-ai-helper-image-generator-generate" type="button" class="components-button trx-addons-ai-helper-image-generator-button is-primary">
										<span class="dashicon dashicons dashicons-images-alt trx-addons-ai-helper-image-generator-button-icon"></span>
										<span class="trx-addons-ai-helper-image-generator-button-text">{{ wp.i18n.__( 'Generate images' ) }}</span>
									</button>
								</div>
							</div>
							<div class="trx-addons-ai-helper-image-generator-settings-subtitle trx-addons-ai-helper-image-generator-settings-selected-subtitle trx_addons_hidden">
								<h3>{{ data.subtitle }}</h3>
							</div>
							<div id="trx-addons-ai-helper-image-generator-settings-selected" class="trx_addons_hidden">
								<div class="trx-addons-ai-helper-image-generator-settings-item">
									<label for="trx-addons-ai-helper-image-generator-variations" class="trx-addons-ai-helper-image-generator-settings-item-title">{{ wp.i18n.__( '# of variations' ) }}</label>
									<div class="trx-addons-ai-helper-image-generator-settings-item-field">
										<select id="trx-addons-ai-helper-image-generator-variations">
											<# for ( var n in data.numbers ) { #>
												<option value="{{ n }}"<# if ( n == data.variations ) print(' selected') #>>{{ n }}</option>
											<# } #>
										</select>
										<button id="trx-addons-ai-helper-image-generator-make-variations" type="button" class="components-button trx-addons-ai-helper-image-generator-button is-secondary">
											<span class="dashicon dashicons dashicons-format-gallery trx-addons-ai-helper-image-generator-button-icon"></span>
											<span class="trx-addons-ai-helper-image-generator-button-text">{{ wp.i18n.__( 'Make variations' ) }}</span>
										</button>
									</div>
								</div>
								<hr>
								<div class="trx-addons-ai-helper-image-generator-settings-item">
									<label for="trx-addons-ai-helper-image-generator-filename" class="trx-addons-ai-helper-image-generator-settings-item-title">{{ wp.i18n.__( 'Name' ) }}</label>
									<div class="trx-addons-ai-helper-image-generator-settings-item-field">
										<input type="text" id="trx-addons-ai-helper-image-generator-filename" placeholder="{{ wp.i18n.__( 'File name' ) }}" value="{{ data.filename }}">
									</div>
								</div>
								<div class="trx-addons-ai-helper-image-generator-settings-item">
									<label for="trx-addons-ai-helper-image-generator-caption" class="trx-addons-ai-helper-image-generator-settings-item-title">{{ wp.i18n.__( 'Caption' ) }}</label>
									<div class="trx-addons-ai-helper-image-generator-settings-item-field">
										<textarea id="trx-addons-ai-helper-image-generator-caption" rows="2"
											placeholder="{{ wp.i18n.__( 'Caption of the image' ) }}"><#
												if ( data.caption ) {
													#>{{ data.caption }}<#
												}
										#></textarea>
									</div>
								</div>
								<div class="trx-addons-ai-helper-image-generator-settings-item">
									<button id="trx-addons-ai-helper-image-generator-upload" type="button" class="components-button trx-addons-ai-helper-image-generator-button is-primary">
										<span class="dashicon dashicons dashicons-upload trx-addons-ai-helper-image-generator-button-icon"></span>
										<span class="trx-addons-ai-helper-image-generator-button-text">{{ wp.i18n.__( 'Add to Media Library' ) }}</span>
									</button>
								</div>
							</div>
							<div id="trx-addons-ai-helper-image-generator-settings-busy">
							</div>
						</div>
						<div id="trx-addons-ai-helper-image-generator-preview"<# if ( data.images.length == 0 ) { #> class="trx_addons_hidden"<# } #>><#
							if ( data.images.length ) {
								data.images.forEach( function( img ) {
									#><a href="javascript:void(0)" class="trx-addons-ai-helper-image-generator-preview-image"><img src="{{ img }}" alt=""></a><#
								} )
							}
						#></div>
					</div>
				</div>
			</script>`
		);
	}

	// Extend the media frame with our custom view
	wp.media.view.TrxAddonsAiHelperImageGenerator = View.extend( {
		tagName:   'div',
		className: 'trx-addons-ai-helper-image-generator',
		template:  wp.template('trx-addons-ai-helper-image-generator'),
	
		events: {
			'click .close': 'hide',
			'change #trx-addons-ai-helper-image-generator-template':       'changeTemplate',
			'change #trx-addons-ai-helper-image-generator-prompt':         'changePrompt',
			'change #trx-addons-ai-helper-image-generator-size':           'changeSize',
			'change #trx-addons-ai-helper-image-generator-number':         'changeNumber',
			'change #trx-addons-ai-helper-image-generator-append':         'changeAppend',
			'change #trx-addons-ai-helper-image-generator-replace':        'changeReplace',
			'click #trx-addons-ai-helper-image-generator-generate':        'generateImages',
			'change #trx-addons-ai-helper-image-generator-variations':     'changeVariations',
			'click #trx-addons-ai-helper-image-generator-make-variations': 'makeVariations',
			'change #trx-addons-ai-helper-image-generator-filename':       'changeFilename',
			'change #trx-addons-ai-helper-image-generator-caption':        'changeCaption',
			'click #trx-addons-ai-helper-image-generator-upload':          'addToUploads',
			'click .trx-addons-ai-helper-image-generator-preview-image':   'clickImage',
			'keydown .trx-addons-ai-helper-image-generator-preview-image': 'keydownImage'
		},
	
		initialize: function() {
			_.defaults( this.options, {
				title: '',
				status:  true,
				canClose: false,
				templates: TRX_ADDONS_STORAGE['ai_helper_generate_image_templates'],
				sizes: TRX_ADDONS_STORAGE['ai_helper_generate_image_sizes'],
				numbers: TRX_ADDONS_STORAGE['ai_helper_generate_image_numbers']
			} );
			if ( ! this.controller.state().get('template' ) )   this.controller.state().set('template', 'default');
			if ( ! this.controller.state().get('prompt' ) )     this.controller.state().set('prompt', '');
			if ( ! this.controller.state().get('size' ) )       this.controller.state().set('size', '1024x1024');
			if ( ! this.controller.state().get('number' ) )     this.controller.state().set('number', 3);
			if ( ! this.controller.state().get('append' ) )     this.controller.state().set('append', 'append');
			if ( ! this.controller.state().get('variations' ) ) this.controller.state().set('variations', 3);
			if ( ! this.controller.state().get('filename' ) )   this.controller.state().set('filename', '');
			if ( ! this.controller.state().get('caption' ) )    this.controller.state().set('caption', '');
			if ( ! this.controller.state().get('images' ) )     this.controller.state().set('images', []);
		},

		/**
		 * Restore data from the state
		 * 
		 * @return object with data
		 */
		prepare: function() {
			var data = {
				// Options
				title:     this.options.title,
				canClose:  this.options.canClose,
				templates: this.options.templates,
				sizes:     this.options.sizes,
				numbers:   this.options.numbers,
				subtitle:  this.options.subtitle,
				// States
				template:   this.controller.state().get('template'),
				prompt:     this.controller.state().get('prompt'),
				size:       this.controller.state().get('size'),
				number:     this.controller.state().get('number'),
				append:     this.controller.state().get('append'),
				variations: this.controller.state().get('variations'),
				filename:   this.controller.state().get('filename'),
				caption:    this.controller.state().get('caption'),
				images:     this.controller.state().get('images')
			};
			return data;
		},

		/**
		 * @return {wp.media.view.TrxAddonsAiHelperImageGenerator} Returns itself to allow chaining.
		 */
		dispose: function() {
			if ( this.disposing ) {
				/**
				 * call 'dispose' directly on the parent class
				 */
				return View.prototype.dispose.apply( this, arguments );
			}
	
			/*
			* Run remove on `dispose`, so we can be sure to refresh the
			* uploader with a view-less DOM. Track whether we're disposing
			* so we don't trigger an infinite loop.
			*/
			this.disposing = true;
			return this.remove();
		},
		remove: function() {
			/**
			 * call 'remove' directly on the parent class
			 */
			var result = View.prototype.remove.apply( this, arguments );
	
			_.defer( _.bind( this.refresh, this ) );
			return result;
		},
		refresh: function() {
		},
		ready: function() {
			this.refresh();
			return this;
		},
		show: function() {
			this.$el.removeClass( 'hidden' );
		},
		hide: function() {
			this.$el.addClass( 'hidden' );
		},

		/**
		 * Change template in the state
		 */
		changeTemplate: function(e) {
			var value = jQuery( e.target ).val();
			this.controller.state().set('template', value);
			jQuery( '#trx-addons-ai-helper-image-generator-prompt' ).val( this.options.templates[value].prompt ).trigger('change');
		},

		/**
		 * Change prompt in the state
		 */
		changePrompt: function(e) {
			var value = jQuery( e.target ).val();
			this.controller.state().set('prompt', value);
		},

		/**
		 * Change size of the image in the state
		 */
		changeSize: function(e) {
			var value = jQuery( e.target ).val();
			this.controller.state().set('size', value);
		},

		/**
		 * Change number of images in the state
		 */
		changeNumber: function(e) {
			var value = jQuery( e.target ).val();
			this.controller.state().set('number', value);
		},

		/**
		 * Change append mode in the state
		 */
		changeAppend: function(e) {
			var checkbox = jQuery( e.target ),
				value = checkbox.prop('checked') ? 'append' : 'replace';
			this.controller.state().set('append', value);
		},

		/**
		 * Change append mode in the state
		 */
		changeReplace: function(e) {
			var checkbox = jQuery( e.target ),
				value = checkbox.prop('checked') ? 'replace' : 'append';
			this.controller.state().set('append', value);
		},

		/**
		 * Change number of variations in the state
		 */
		changeVariations: function(e) {
			var value = jQuery( e.target ).val();
			this.controller.state().set('variations', value);
		},

		/**
		 * Change a name of file in the state
		 */
		changeFilename: function(e) {
			var value = jQuery( e.target ).val();
			this.controller.state().set('filename', value);
		},

		/**
		 * Change a caption of the image in the state
		 */
		changeCaption: function(e) {
			var value = jQuery( e.target ).val();
			this.controller.state().set('caption', value);
		},

		/**
		 * Click on the image - select it for make variations or add to uploads
		 */
		clickImage: function(e) {
			var $image = jQuery( e.target );
			if ( ! $image.hasClass( 'trx-addons-ai-helper-image-generator-preview-image' ) ) {
				$image = $image.parents( '.trx-addons-ai-helper-image-generator-preview-image' );
			}
			if ( ! $image.hasClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' ) ) {
				var url = $image.find( 'img' ).attr( 'src' ).split('?')[0],
					parts = url.split('/'),
					filename = parts[parts.length-1];
				$image.parent().find( '.trx-addons-ai-helper-image-generator-preview-image-selected' ).removeClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' );
				$image.addClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' );
				jQuery( '#trx-addons-ai-helper-image-generator-filename').val( filename ).trigger( 'change' );
				jQuery( '#trx-addons-ai-helper-image-generator-caption').val( '' ).trigger( 'change' );
			}
			// Display settings for the selected image
			jQuery( '#trx-addons-ai-helper-image-generator-settings-selected, .trx-addons-ai-helper-image-generator-settings-selected-subtitle' ).removeClass( 'trx_addons_hidden' );
		},

		/**
		 * Move selecton to the next/prev image with keyboard arrows
		 */
		keydownImage: function(e) {
			var $image = jQuery( e.target ),
				$images = $image.parent().find( '.trx-addons-ai-helper-image-generator-preview-image' ),
				idx = $image.index(),
				handled = false;
			// If 'Enter' or 'Space' is pressed - switch state of the image
//				if ( [ 13, 32 ].indexOf( e.which ) >= 0 ) {		// Enter, Space
//					$image.trigger( 'click' );
//					handled = true;
//				} else
			if ( 37 == e.which ) {					// Left
				$images
					.removeClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' )
					.eq( Math.max( 0, idx - 1 ) ).focus().addClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' );
				handled = true;
			} else if ( 38 == e.which ) {			// Up
				$images
					.removeClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' )
					.eq( Math.max( 0, idx - 3 ) ).focus().addClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' );
				handled = true;
			} else if ( 39 == e.which ) {			// Right
				$images
					.removeClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' )
					.eq( Math.min( $images.length - 1, idx + 1 ) ).focus().addClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' );
				handled = true;
			} else if ( 40 == e.which ) {			// Down
				$images
					.removeClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' )
					.eq( Math.min( $images.length - 1, idx + 3 ) ).focus().addClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' );
				handled = true;
			}
//				if ( handled ) {
//					e.preventDefault();
//					return false;
//				}
			return true;
		},

		/**
		 * Generate images
		 */
		generateImages: function() {
			var self      = this,
				$button   = jQuery( '#trx-addons-ai-helper-image-generator-generate' ),
				$preview  = jQuery( '#trx-addons-ai-helper-image-generator-preview' ),
				$busy     = jQuery( '#trx-addons-ai-helper-image-generator-settings-busy' ),
				size      = self.controller.state().get('size'),
				number    = self.controller.state().get('number'),
				append    = self.controller.state().get('append'),
				prompt    = self.controller.state().get('prompt');

			if ( number < 1 || prompt == '' ) {
				return;
			}

			// Set to busy state
			$busy.addClass( 'is-busy' );

			// Disable button
			$button
				.prop( 'disabled', true )
				.addClass( 'is-busy' );

			// Send request via AJAX (REST API is not used, because a current user can't be detected)
			jQuery.post( TRX_ADDONS_STORAGE['ajax_url'], {
				nonce: TRX_ADDONS_STORAGE['ajax_nonce'],
				action: 'trx_addons_ai_helper_generate_images',
				size: size,
				number: number,
				prompt: prompt
			}, function( response ) {
				// Prepare response
				var rez = {};
				if ( response == '' || response == 0 ) {
					rez = { error: TRX_ADDONS_STORAGE['msg_ai_helper_error'] };
				} else if ( typeof response == 'string' ) {
					try {
						rez = JSON.parse( response );
					} catch (e) {
						rez = { error: TRX_ADDONS_STORAGE['msg_ai_helper_error'] };
						console.log( response );
					}
				} else {
					rez = response;
				}
				// Set to normal state
				$busy.removeClass( 'is-busy' );
				// Enable button
				$button
					.prop( 'disabled', false )
					.removeClass( 'is-busy' );
				// Show images
				if ( ! rez.error ) {
					var images = rez.data,
						images_from_state = [];
					if ( images.length > 0 ) {
						$preview.removeClass( 'trx_addons_hidden' );
						if ( append != 'append' ) {
							$preview.empty();
						} else {
							images_from_state = self.controller.state().get('images');
						}
						for ( var i = 0; i < images.length; i++ ) {
							$preview.append( '<a href="javascript:void(0)" class="trx-addons-ai-helper-image-generator-preview-image"><img src="' + images[i].url + '" alt=""></a>' );
							if ( i === 0 ) {
								$preview
									.find( '.trx-addons-ai-helper-image-generator-preview-image' ).removeClass( 'trx-addons-ai-helper-image-generator-preview-image-selected' )
									.eq( images_from_state.length ).trigger( 'click' );
							}
							images_from_state.push( images[i].url );
						}
						self.controller.state().set('images', images_from_state);
					}
				} else {
					alert( rez.error );
				}
			} );
		},
		
		/**
		 * Make variations of the selected image
		 */
		makeVariations: function() {
			var self       = this,
				$button    = jQuery( '#trx-addons-ai-helper-image-generator-make-variations' ),
				$preview   = jQuery( '#trx-addons-ai-helper-image-generator-preview' ),
				$busy      = jQuery( '#trx-addons-ai-helper-image-generator-settings-busy' ),
				$selected  = $preview.find( '.trx-addons-ai-helper-image-generator-preview-image-selected' ),
				idx        = $selected.index(),
				images_from_state = self.controller.state().get('images'),
				url        = images_from_state[idx],
				size       = self.controller.state().get('size'),
				number     = self.controller.state().get('variations');

			if ( number < 1 ) {
				return;
			}

			// Set to busy state
			$busy.addClass( 'is-busy' );

			// Disable button
			$button
				.prop( 'disabled', true )
				.addClass( 'is-busy' );

			// Send request via AJAX (REST API is not used, because a current user can't be detected)
			jQuery.post( TRX_ADDONS_STORAGE['ajax_url'], {
				nonce: TRX_ADDONS_STORAGE['ajax_nonce'],
				action: 'trx_addons_ai_helper_make_variations',
				size: size,
				number: number,
				image: url
			}, function( response ) {
				// Prepare response
				var rez = {};
				if ( response == '' || response == 0 ) {
					rez = { error: TRX_ADDONS_STORAGE['msg_ai_helper_error'] };
				} else if ( typeof response == 'string' ) {
					try {
						rez = JSON.parse( response );
					} catch (e) {
						rez = { error: TRX_ADDONS_STORAGE['msg_ai_helper_error'] };
						console.log( response );
					}
				} else {
					rez = response;
				}
				// Set to normal state
				$busy.removeClass( 'is-busy' );
				// Enable button
				$button
					.prop( 'disabled', false )
					.removeClass( 'is-busy' );
				// Show images
				if ( ! rez.error ) {
					var images = rez.data;
					if ( images.length > 0 ) {
						for ( var i = 0; i < images.length; i++ ) {
							$selected.after( '<a href="javascript:void(0)" class="trx-addons-ai-helper-image-generator-preview-image"><img src="' + images[i].url + '" alt=""></a>' );
							images_from_state.splice( idx, 0, images[i].url );
						}
						self.controller.state().set('images', images_from_state);
					}
				} else {
					alert( rez.error );
				}
			} );
		},

		/**
		 * Upload a selected image to the media library
		 * and insert it to the tab "Media Library"
		 */
		addToUploads: function() {
			var self       = this,
				$button    = jQuery( '#trx-addons-ai-helper-image-generator-upload' ),
				$preview   = jQuery( '#trx-addons-ai-helper-image-generator-preview' ),
				$busy      = jQuery( '#trx-addons-ai-helper-image-generator-settings-busy' ),
				$selected  = $preview.find( '.trx-addons-ai-helper-image-generator-preview-image-selected' ),
				idx        = $selected.index(),
				images_from_state = self.controller.state().get('images'),
				url        = images_from_state[idx],
				filename   = self.controller.state().get('filename'),
				caption    = self.controller.state().get('caption');

			if ( ! url ) {
				return;
			}

			// Set to busy state
			$busy.addClass( 'is-busy' );

			// Disable button
			$button
				.prop( 'disabled', true )
				.addClass( 'is-busy' );

			// Send request via AJAX (REST API is not used, because a current user can't be detected)
			jQuery.post( TRX_ADDONS_STORAGE['ajax_url'], {
				nonce: TRX_ADDONS_STORAGE['ajax_nonce'],
				action: 'trx_addons_ai_helper_add_to_uploads',
				image: url,
				filename: filename,
				caption: caption
			}, function( response ) {
				// Prepare response
				var rez = {};
				if ( response == '' || response == 0 ) {
					rez = { error: TRX_ADDONS_STORAGE['msg_ai_helper_error'] };
				} else if ( typeof response == 'string' ) {
					try {
						rez = JSON.parse( response );
					} catch (e) {
						rez = { error: TRX_ADDONS_STORAGE['msg_ai_helper_error'] };
						console.log( response );
					}
				} else {
					rez = response;
				}
				// Set to normal state
				$busy.removeClass( 'is-busy' );
				// Enable button
				$button
					.prop( 'disabled', false )
					.removeClass( 'is-busy' );
				// Add to tab 'Media Library'
				if ( ! rez.error ) {
					var attachment = wp.media.attachment( rez.data );
					attachment.fetch();
					self.controller.state().get('library').add( attachment ? [ attachment ] : [] );
					// Switch to the tab 'Media Library' and select the uploaded image
					self.controller.setState( 'library' );
					self.controller.state().frame.content.mode('browse');
					self.controller.state().get('selection').add( attachment );
					self.controller.state().frame.trigger( 'library:selection:add' );
			
				} else {
					alert( rez.error );
				}
			} );
		}
	} );

	/**
	 * Extending the current media library frame to add a new tab
	 */
	var newMediaFrame = {
		
		// initialize: function() {
		// 	// Calling the initalize method from the current frame before adding new functionality
		// 	oldMediaFrame.prototype.initialize.apply( this, arguments );
		// },

		bindHandlers: function() {
			// Calling the initalize method from the current frame before adding new functionality
			this.oldMediaFrame.prototype.bindHandlers.apply( this, arguments );
			// Add a new tab
			this.on( 'router:render:browse', this.aiHelperRouter, this );
			this.on( 'content:render:trx-addons-ai-helper-image-generator', this.aiHelperContent, this );
		},

		// Add a new tab
		aiHelperRouter: function( routerView ) {
			routerView.set( {
				upload: {
					text:     l10n.uploadFilesTitle,
					priority: 20
				},
				'trx-addons-ai-helper-image-generator': {
					text:     __( 'AI Image Generator' ),
					priority: 30
				},
				browse: {
					text:     l10n.mediaLibraryTitle,
					priority: 40
				}
			} );
		},

		// Add a new tab content
		aiHelperContent: function() {
			this.$el.removeClass( 'hide-toolbar' );
			this.content.set( new wp.media.view.TrxAddonsAiHelperImageGenerator( {
				controller: this,
				title: __( 'Generate images with AI Helper' ),
				subtitle: __( 'Process a selected image' ),
				canClose: false
			} ) );
		}
	
	};

	// Extending the current media library frame to add a new tab
	wp.media.view.MediaFrame.Post = oldMediaFramePost.extend( Object.assign( { oldMediaFrame: oldMediaFramePost }, newMediaFrame ) );
	wp.media.view.MediaFrame.Select = oldMediaFrameSelect.extend( Object.assign( { oldMediaFrame: oldMediaFrameSelect }, newMediaFrame ) );
} );