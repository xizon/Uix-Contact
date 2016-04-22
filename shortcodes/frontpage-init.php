<?php

/**
 * Enable the use of shortcodes in ...
 *
 */

add_filter( 'widget_text', 'do_shortcode' ); //text widgets.
add_filter( 'the_excerpt', 'do_shortcode' ); //excerpt.
add_filter( 'comment_text', 'do_shortcode' ); //comment.

//----------------------------------------------------------------------------------------------------
//[shortcode - Post Comment]
//----------------------------------------------------------------------------------------------------
	
function uix_contact_comment_fun( $atts, $content = null ){
	
	 global $post;

	//Enqueue scripts and styles.
	add_action( 'wp_footer', array( 'UixContact', 'plug_scripts' ), 100 );
	

    // capture output from the widgets
	ob_start();
	
	    if( !UixContact::tempfile_exists() ) {
			require_once WP_PLUGIN_DIR .'/'.UixContact::get_slug(). '/theme_templates/partials-uix_contact_form_comments.php';
		} else {
			require_once get_template_directory() . '/partials-uix_contact_form_comments.php';
		}
		
		$out = ob_get_contents();
	ob_end_clean();
	 

   $return_string = $out;
   
	// If comments are closed and there are comments,let's leave a little note,shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		$return_string = '<p class="no-comments uix-contact-no-comments">'.__( 'Comments are closed.', 'uix-contact' ).'</p>';
	} 
   
   
   return UixContact::do_callback( $return_string );
}
add_shortcode( 'uix_contact_form_comments', 'uix_contact_comment_fun' );



//----------------------------------------------------------------------------------------------------
//[shortcode - SMTP]
//----------------------------------------------------------------------------------------------------
	
function uix_contact_smtp_fun( $atts, $content = null ){
	
	 global $post;

	//Enqueue scripts and styles.
	add_action( 'wp_footer', array( 'UixContact', 'plug_scripts' ), 100 );
	 
    // capture output from the widgets
	ob_start();
	
	    if( !UixContact::tempfile_exists() ) {
			require_once WP_PLUGIN_DIR .'/'.UixContact::get_slug(). '/theme_templates/partials-uix_contact_form_smtp.php';
		} else {
			require_once get_template_directory() . '/partials-uix_contact_form_smtp.php';
		}
		
		
		$out = ob_get_contents();
	ob_end_clean();
	 
	
   $return_string = $out;
   
   return UixContact::do_callback( $return_string );
}
add_shortcode( 'uix_contact_form_smtp', 'uix_contact_smtp_fun' );


