/*! 
 * ************************************
 * Adding Buttons
 *
 * @windowManager:
 
		ed.windowManager.open( {
			title: 'Insert Uix Contact',
			body: [
				{
					type: 'textbox',
					name: 'uix_contact_value_1',
					label: 'Text Box',
					value: '30'
				},
				{
					type: 'textbox',
					name: 'uix_contact_value_2',
					label: 'Multiline Text Box',
					value: 'You can say a lot of stuff in here',
					multiline: true,
					minWidth: 300,
					minHeight: 100
				},
				{
					type: 'listbox',
					name: 'uix_contact_value_3',
					label: 'List Box',
					'values': [
						{text: 'Option 1', value: '1'},
						{text: 'Option 2', value: '2'},
						{text: 'Option 3', value: '3'}
					]
				},
				{
					type: 'checkbox',
					name: 'uix_contact_value_4',
					label: 'Executar automaticamente?',
					text: 'Sim',
					classes: 'checkclass'
				},
				
				{
					type: 'textbox',
					name: 'uix_contact_value_5',
					label: 'Image',
					id: 'uix_contact_value_5',
					value: ''
				},
					{
						type: 'button',
						name: 'uix_contact_value_imgBtn',
						text: 'Select Image',
						label: ' ',
						classes : 'upload_image_button',
						onclick: function() {
							window.mb = window.mb || {};
					
							window.mb.frame = wp.media({
								frame: 'post',
								state: 'insert',
								library : {
									type : 'image'
								},
								multiple: false
							});
					
							window.mb.frame.on('insert', function() {
								var json = window.mb.frame.state().get('selection').first().toJSON();
					
								jQuery( '#uix_contact_value_5' ).val( json.url );
								
								
								
							});
					
							window.mb.frame.open();
						}
					},
			 
					{
						type: 'colorpicker',
						name: 'uix_contact_value_6',
						label: 'Color',
						value: '#333333'
					},
					{
						type   : 'combobox',
						name   : 'uix_contact_value_7',
						label  : 'combobox',
						values : [
							{ text: 'Test', value: 'test' },
							{ text: 'Test2', value: 'test2' }
						]
					},
					{
						type   : 'container',
						name   : 'uix_contact_value_8',
						label  : ' ',
						html   : '<i style=color:red>but needs some styling?</i>'
					},
				  
												
				
				
			],
			onsubmit: function( e ) {
				ed.insertContent( '[random_shortcode textbox="' + e.data.uix_contact_value_1 + '" multiline="' + e.data.uix_contact_value_2 + '" listbox="' + e.data.uix_contact_value_3 + '" checkbox="'+ e.data.uix_contact_value_4 +'" image="' + e.data.uix_contact_value_5 + '" color="' + e.data.uix_contact_value_6 + '"]');
			}
		});
					
 
 *************************************
 */	

var custom_uploader;

 (function() {
    tinymce.create('tinymce.plugins.uix_contact', {
		
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {
			
           
				
			ed.addButton( 'uix_contact_btn', {
				text: '',
				title: ed.getLang( 'uix_contact_custom_tinymce_plugin.lang_1' ),
				image 	: url + '/icon.png',
				onclick: function() {
					ed.windowManager.open( {
						title: ed.getLang( 'uix_contact_custom_tinymce_plugin.lang_2' ),
						body: [
					
							{
								type: 'listbox',
								name: 'uix_contact_form',
								label: '',
								'values': [
									{text: ed.getLang( 'uix_contact_custom_tinymce_plugin.lang_3' ), value: '1'},
									{text: ed.getLang( 'uix_contact_custom_tinymce_plugin.lang_4' ), value: '2'},
								]
							},
					
							
						],
						onsubmit: function( e ) {
							
							
							switch( e.data.uix_contact_form )
							{
							case '1':
							
							  ed.insertContent( '[uix_contact_form_comments]');
							  break;
							  
							case '2':
							
							  ed.insertContent( '[uix_contact_form_smtp]');
							  break;
							  
							default:
							
							
							  
							}
	
						
						}
					});
				}

			});
				
     
			
			
			
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        }


    });
	
    // Register plugin
    tinymce.PluginManager.add( 'uix_contact', tinymce.plugins.uix_contact );
	
	
})();

