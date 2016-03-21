<?php
/**
 * Building WordPress themes using the Kirki Customizer
 *
 */

if ( class_exists( 'Kirki' )  && class_exists( 'UixContact' )  ) {
	
	global $wp_customize;
	
	$uix_contact_kirki_config_id = 'uix_contact_kirki_custom';
	
	/*
	*
	* Kirki customizer configuration
	*
	*/
	
	Kirki::add_config( $uix_contact_kirki_config_id, array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );
	

	
	
	//Function of "Allowing html in text"
	function uix_contact_kirki_do_not_filter_anything( $value ) {
		return $value;
	}
		
	
			
	//This function adds some styles to the WordPress Customizer
	function uix_contact_kirki_custom_style() {
	
		wp_enqueue_style( 'kirki-customizer-custom-css', UixContact::plug_directory() .  'customizer-extras/css/main.css', null, null );

	}
	if ( $wp_customize ) {
	
		add_action( 'customize_controls_print_styles', 'uix_contact_kirki_custom_style', 100 );
		
	}
	


    /*
     * ------------------------------------------------------------------------------------------------
     */

	
	Kirki::add_section( 'panel-theme-uix-contact', array(
		'title'          => __( 'Uix Contact Settings', 'uix-contact' ),
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
	) );
	
	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	 
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'checkbox',
        'settings'    => 'custom_uix_contact_mode',
        'label'       => __( 'Receiving Messages with My Email (Instead of using the comments)', 'uix-contact' ),
        'description' => __( 'By default, the theme to use built-in WordPress comments form in lieu of a contact form.<br>
You can edit the <em>&quot;partials-comments_form.php, partials-comments.php, partials-smtp_form.php&quot;</em> files so that customize the contact form.', 'uix-contact' ),
        'section'     => 'panel-theme-uix-contact',
        'default'     => false,
        'priority'    => 10,
    
    ) );
    

    
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'text',
        'settings'    => 'custom_uix_contact_toemail',
        'label'       => __( 'Receiving Messages Address', 'uix-contact' ),
        'description'        => __( 'Receiving messages sent via Contact Form. If you leave this blank, the WordPress email will be used.', 'uix-contact' ),
        'section'     => 'panel-theme-uix-contact',
        'default'     => get_bloginfo( 'admin_email' ),
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );
    
    
    /*Usage*/
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'custom',
        'settings'    => 'custom_usage-smtp',
        'section'     => 'panel-theme-uix-contact',
        'default'     => '<div class="kirki-tipbox"><div>
        <strong><i class="fa fa-cogs"></i> SMTP Options:</strong><br>
        '.__( 'Setting an SMTP server for Wordpress is essential if you want to send or recieve HMTL emails from the built-in contact form.', 'uix-contact' ).'
        </div></div>',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );
     
    
    
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'text',
        'settings'    => 'custom_uix_contact_smtp_fromname',
        'label'       => __( 'Email &quot;From&quot; Name', 'uix-contact' ),
        'help'        => __( 'The name your recipients will see as part of the &quot;from&quot; or &quot;sender&quot; value when they receive your message. The name as it will appear in recipient clients.', 'uix-contact' ),
        'section'     => 'panel-theme-uix-contact',
        'default'     => '',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );	
    
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'text',
        'settings'    => 'custom_uix_contact_smtp_frommail',
        'label'       => __( 'Email &quot;From&quot; Address', 'uix-contact' ),
        'help'        => __( 'An email has two addresses associated with sending it: the sender, and the from address. The sender is where computers should respond (in the case of bounce messages or errors); the from address is where people should respond. In most cases, the sender and the from address match. But they do not always, and they do not have to. The email address that will be used to send emails to your recipients.', 'uix-contact' ),
        'section'     => 'panel-theme-uix-contact',
        'default'     => '',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );	
    
    
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'text',
        'settings'    => 'custom_uix_contact_smtp_host',
        'label'       => __( 'SMTP Host', 'uix-contact' ),
        'help'        => __( 'Like for example google smtp host is &quot;smtp.gmail.com&quot;', 'uix-contact' ),
        'section'     => 'panel-theme-uix-contact',
        'default'     => '',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );
    
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'text',
        'settings'    => 'custom_uix_contact_smtp_port',
        'label'       => __( 'SMTP Port', 'uix-contact' ),
        'help'        => __( 'Note: Gmail users need to use the server &quot;smtp.gmail.com&quot; with TLS enabled and port 587.', 'uix-contact' ),
        'section'     => 'panel-theme-uix-contact',
        'default'     => '',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );	
    
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'switch',
        'settings'    => 'custom_uix_contact_smtp_authentication',
        'label'       => __( 'SMTP Authentication', 'uix-contact' ),
        'description' => '',
        'section'     => 'panel-theme-uix-contact',
        'default'     => true,
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );	
        
    
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'text',
        'settings'    => 'custom_uix_contact_smtp_user',
        'label'       => __( 'SMTP Username', 'uix-contact' ),
        'description' => '',
        'section'     => 'panel-theme-uix-contact',
        'default'     => '',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );	
    
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'password',
        'settings'    => 'custom_uix_contact_smtp_pass',
        'label'       => __( 'SMTP Password', 'uix-contact' ),
        'description' => '',
        'section'     => 'panel-theme-uix-contact',
        'default'     => '',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );	
    

    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'radio-buttonset',
        'settings'    => 'custom_uix_contact_smtp_type',
        'label'       => __( 'Type of Encryption', 'uix-contact' ),
        'description' => '',
        'section'     => 'panel-theme-uix-contact',
        'default'     => 'none',
        'priority'    => 10,
        'choices'     => array(
            'none'   => 'None',
            'ssl' => 'SSL',
            'tls'  => 'TLS',
        ),
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );	
        

    
    
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'text',
        'settings'    => 'custom_uix_contact_msg_sub',
        'label'       => __( 'Message Subject Template', 'uix-contact' ),
        'description' => __( 'You can use the following placeholders in the subject templates, which will be replaced by the actual values when the email is sent: <br> <code>{site_name}</code> --> Your Site Name', 'uix-contact' ),
        'help' => __( 'The &quot;Subject&quot; section of an e-mail is where one can identify what the e-mail is about with a short phrase.And it is completely optional and does not affect whether the e-mail will be sent properly or not. <br>This will become a mark of the subject for the &quot;Contact Form&quot; E-mail you receive. You can change this if you like.', 'uix-contact' ),
        'section'     => 'panel-theme-uix-contact',
        'default'  => '{site_name} You have a new message',
        'priority'    => 10,
        'sanitize_callback' => 'uix_contact_kirki_do_not_filter_anything',//Allowing html in text
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );	
        
    Kirki::add_field( $uix_contact_kirki_config_id, array(
        'type'        => 'textarea',
        'settings'    => 'custom_uix_contact_msg_bodytemp',
        'label'       => __( 'Message Body Template', 'uix-contact' ),
        'description' => __( 'You can use the following placeholders in the message templates, which will be replaced by the actual values when the email is sent: <br> <code>{site_name}</code> --> Your Site Name<br> <code>{user_name}</code> --> User Name<br> <code>{user_email}</code> --> User Email<br> <code>{user_info}</code> --> Website or Tel.<br> <code>{message}</code> --> Message', 'uix-contact' ),
        'help' => __( 'You can customize the HTML template to match your content of mail by making a few simple style changes. 
', 'uix-contact' ),
        'section'     => 'panel-theme-uix-contact',
        'default'     => '
'.__( 'You have a new message from contact form.', 'uix-contact' ).'

'.__( 'Name', 'uix-contact' ).': {user_name}
'.__( 'Email', 'uix-contact' ).': {user_email}
'.__( 'Website/Tel.', 'uix-contact' ).': {user_info} 

{message} 
            ',
        'priority'    => 10,
        'sanitize_callback' => 'uix_contact_kirki_do_not_filter_anything',//Allowing html in text
        'required'    => array(
            array(
                'setting'  => 'custom_uix_contact_mode',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );			



	
	
	//Read css file value
	global $org_cssname_uix_contact;
	global $org_csspath_uix_contact;

    $org_cssname_uix_contact = 'uix-contact-style.css';
	$org_csspath_uix_contact = get_template_directory_uri() .'/'. $org_cssname_uix_contact;
	
	
	function uix_contact_view_style() {
		

		global $org_cssname_uix_contact;
		global $org_csspath_uix_contact;
	
		
		wp_nonce_field( 'customize-filesystem-nonce' );
		
		// capture output from WP_Filesystem
		ob_start();
		
			UixContact::wpfilesystem_read_file( 'customize-filesystem-nonce', 'customize.php', '', $org_cssname_uix_contact, 'theme' );
			$filesystem_uix_contact_out = ob_get_contents();
		ob_end_clean();
		
		if ( empty( $filesystem_uix_contact_out ) ) {
			
			$style_org_code_uix_contact = UixContact::wpfilesystem_read_file( 'customize-filesystem-nonce', 'customize.php', '', $org_cssname_uix_contact, 'theme' );
			
			echo '
					 <div class="uix-contact-dialog-mask"></div>
					 <div class="uix-contact-dialog" id="uix-contact-view-css-container">  
						<textarea rows="15" style=" width:95%;" class="regular-text">'.$style_org_code_uix_contact.'</textarea>
						<a href="javascript:" id="uix_contact_close_css" class="close button button-primary">'.__( 'Close', 'uix-contact' ).'</a>  
					</div>
					<script type="text/javascript">
						
					( function($) {
						
						"use strict";
						
						$( function() {
							
							var dialog_uix_contact = $( "#uix-contact-view-css-container, .uix-contact-dialog-mask" );  
							
							$( "#uix_contact_view_css" ).click( function() {
								dialog_uix_contact.show();
							});
							$( "#uix_contact_close_css" ).click( function() {
								dialog_uix_contact.hide();
							});
						
				
						} );
						
					} ) ( jQuery );
					
					</script>
			
			';	
	
		} else {
			
			echo '
					
					<script type="text/javascript">
						
					( function($) {
						
						"use strict";
						
						$( function() {
							
							$( "#uix_contact_view_css" ).attr({ "href": "'.$org_csspath_uix_contact.'", "target":"_blank" });
				
						} );
						
					} ) ( jQuery );
					
					</script>
			
			';	
			
			
		}
		
	}
	
    add_action( 'customize_controls_print_scripts', 'uix_contact_view_style' );


	Kirki::add_field( $uix_contact_kirki_config_id, array(
		'type'        => 'custom',
		'settings'    => 'custom_uix_contact_css_tip',
		'label'       => __( 'Custom CSS', 'uix-contact' ),
		'description' => __( 'You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original <code>.css</code> files.', 'uix-contact' ),
		'section'     => 'panel-theme-uix-contact',
		'default'     => '
        <p>'.__( 'CSS file root directory:', 'uix-contact' ).'
            <a href="javascript:" id="uix_contact_view_css" >'.$org_csspath_uix_contact.'</a>
        </p>  
		',
		'priority'    => 10
	) );
	
	Kirki::add_field( $uix_contact_kirki_config_id, array(
		'type'        => 'code',
		'settings'    => 'custom_uix_contact_css',
		'label'       => '',
		'description' => '',
		'section'     => 'panel-theme-uix-contact',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
			'language' => 'css',
			'theme'    => 'monokai',
			'height'   => 250,
		),
	) );

	


}