<?php
/*
Plugin Name: Uix Contact
Plugin URI: https://uiux.cc/wp-plugins/uix-contact/
Description: Uix Contact allowing user to change different receiving messages options with the WordPress theme customizer and take advantage of built-in contact form.
Author: UIUX Lab
Author URI: https://uiux.cc
Version: 1.0.0
Text Domain: uix-contact
License: GPLv2 or later
*/


class UixContact {
	
	const PREFIX = 'uix';
	const HELPER = 'uix-contact-custom-submenu-page';
	const NOTICEID = 'uix-contact-helper-tip';

	
	/**
	 * Initialize
	 *
	 */
	public static function init() {
	
		self::load_phpmailer();
		
		
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'actions_links' ), -10 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backstage_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'print_custom_stylesheet' ) ); 
		add_action( 'current_screen', array( __CLASS__, 'do_register_shortcodes' ) );
		add_action( 'current_screen', array( __CLASS__, 'usage_notice' ) );
		add_action( 'admin_init', array( __CLASS__, 'check_update' ) );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_action( 'wp_head', array( __CLASS__, 'do_my_shortcodes' ) );
		add_action( 'init', array( __CLASS__, 'customizer' ) );
		

	}
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
	
		// Form validation
		wp_enqueue_script( 'validate', self::plug_directory() .'assets/js/jquery.validate.min.js', array( 'jquery' ), '1.14.0', true );	
	
		
		//Main stylesheets and scripts to Front-End
		if( !self::tempfile_exists() ) {
			wp_enqueue_style( self::PREFIX . '-contact-frontend-style', self::plug_directory() .'theme_templates/uix-contact-style.css', false, self::ver(), 'all');
		} else {
			wp_enqueue_style( self::PREFIX . '-contact-frontend-style', get_template_directory_uri() .'/uix-contact-style.css', false, self::ver(), 'all');
		}
		
			

	}
	
	

	
	/*
	 * Enqueue scripts and styles  in the backstage
	 *
	 *
	 */
	public static function backstage_scripts() {
	
		  //Check if screen’s ID, base, post type, and taxonomy, among other data points
		  $currentScreen = get_current_screen();
		  
		
		  if( $currentScreen->base === "customize" ) {
			  
				if ( is_admin()) {
						
						wp_enqueue_style( self::PREFIX . '-contact-mce-main', self::plug_directory() .'style.css', false, self::ver(), 'all');
		
							
				}
  
		  } 
	

	}
	
	
	
	/**
	 * Internationalizing  Plugin
	 *
	 */
	public static function tc_i18n() {
	
	
	    load_plugin_textdomain( 'uix-contact', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
		

	}
	
	/*
	 * The function finds the position of the first occurrence of a string inside another string.
	 *
	 * As strpos may return either FALSE (substring absent) or 0 (substring at start of string), strict versus loose equivalency operators must be used very carefully.
	 *
	 */
	public static function inc_str( $str, $incstr ) {
	
		if ( mb_strlen( strpos( $str, $incstr ), 'UTF8' ) > 0 ) {
			return true;
		} else {
			return false;
		}

	}

	
	
	/*
	 * Create customizable menu in backstage  panel
	 *
	 * Add a submenu page
	 *
	 */
	 public static function options_admin_menu() {
	
		//Add a top level menu page.
		add_menu_page(
			__( 'Uix Contact Settings', 'uix-contact' ),
			__( 'Uix Contact', 'uix-contact' ),
			'manage_options',
			self::HELPER,
			'uix_contact_options_page',
			'dashicons-email',
			'81.' . rand( 0, 99 )
			
		);
	
	
		
	 }
	 
	public static function uix_contact_options_page(){
		
	}
	
	
	
	/*
	 * A full-featured email creation and transfer class for PHP
	 *
	 */
	 public static function load_phpmailer() {
		 
		 require_once 'phpmailer/PHPMailerAutoload.php';
	 }
	
	
	
	/*
	 * Load helper
	 *
	 */
	 public static function load_helper() {
		 
		 require_once 'helper/settings.php';
	 }
	
	
	


	/*
	 * Enable update check on every request.
	 *
	 *
	 */
	public static function check_update() {
	
		require_once 'inc/plugin-update-checker.php';
		$myUpdateChecker = PucFactory::buildUpdateChecker(
			'https://uiux.cc/wp-plugins/'.self::get_slug().'/update/info.json',
			__FILE__
		);

	}
	
	
	/**
	 * Add plugin actions links
	 */
	public static function actions_links( $links ) {
		$links[] = '<a href="' . admin_url( "customize.php" ) . '">' . __( 'Settings', 'uix-contact' ) . '</a>';
		$links[] = '<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=usage" ) . '">' . __( 'How to use?', 'uix-contact' ) . '</a>';
		return $links;
	}
	
	
	/*
	 * Register shortcodes
	 *
	 *
	 */
	public static function do_register_shortcodes() {
	
		  //Check if screen’s ID, base, post type, and taxonomy, among other data points
		  $currentScreen = get_current_screen();
	
		  if( $currentScreen->base === "post" || self::inc_str( $currentScreen->base, '_page_' ) ) {
			
				require_once 'shortcodes/backstage-init.php';
		
		  } 
	

	}
	
	/*
	 * Register shortcodes of front-end
	 *
	 *
	 */
	public static function do_my_shortcodes() {
	
		  require_once 'shortcodes/frontpage-init.php';
	
	}
	

	
	
	/*
	 * Get plugin slug
	 *
	 *
	 */
	public static function get_slug() {

         return dirname( plugin_basename( __FILE__ ) );
	
	}
	

	
	/*
	 * Building WordPress themes using the Kirki Customizer
	 *
	 *
	 */
	public static function customizer() {
		
		if ( !class_exists( 'Kirki' ) ) {
		    require_once 'customizer-extras/kirki/kirki.php';
		}
		
		require_once 'customizer-extras/options-init.php';


	}	
	

	/*
	 *  Add admin one-time notifications
	 *
	 *
	 */
	public static function usage_notice() {
		
		
		  //Check if screen’s ID, base, post type, and taxonomy, among other data points
		  $currentScreen = get_current_screen();
		  
		 
		  if( $currentScreen->id == 'page' ) {
			  add_action( 'admin_notices', array( __CLASS__, 'usage_notice_app' ) );
			  add_action( 'admin_notices', array( __CLASS__, 'template_notice_required' ) );
		  }
		
	
	}	
	
	public static function usage_notice_app() {
		
		global $current_user ;
		$user_id = $current_user->ID;
		
		/* Check that the user hasn't already clicked to ignore the message */
		if ( ! get_user_meta( $user_id, self::NOTICEID ) ) {
			echo '<div class="updated"><p>
				'.__( 'Do you want to create a custom contact page?  Learn how to do it.', 'uix-contact' ).'
				<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=usage" ) . '">' . __( 'How to use?', 'uix-contact' ) . '</a>
				 | 
			';
			printf( __( '<a href="%1$s">Hide Notice</a>' ), '?post_type='.self::get_slug().'&'.self::NOTICEID.'=0');
			
			echo "</p></div>";
		}
	
	}	
	
	public static function template_notice_required() {
		
		if( !self::tempfile_exists() ) {
			echo '
				<div class="error notice">
					<p>' . __( '<strong>You need to create Uix Contact template files in your templates directory. You can create the files on the WordPress admin panel.</strong>', 'uix-contact' ) . ' <a class="button button-primary" href="' . admin_url( "admin.php?page=".self::HELPER."&tab=temp" ) . '">' . __( 'Create now!', 'uix-contact' ) . '</a><br>' . __( 'As a workaround you can use FTP, access the Uix Contact template files path <code>/wp-content/plugins/uix-contact/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-contact' ) . '</p>
				</div>
			';
	
		}
	
	}	

	
	public static function nag_ignore() {
		    global $current_user;
			$user_id = $current_user->ID;
			
			/* If user clicks to ignore the notice, add that to their user meta */
			if ( isset( $_GET[ self::NOTICEID ]) && '0' == $_GET[ self::NOTICEID ] ) {
				 add_user_meta( $user_id, self::NOTICEID, 'true', true);

				if ( wp_get_referer() ) {
					/* Redirects user to where they were before */
					wp_safe_redirect( wp_get_referer() );
				} else {
					/* This will never happen, I can almost gurantee it, but we should still have it just in case*/
					wp_safe_redirect( home_url() );
				}
		    }
	}
	
	/*
	 * Checks whether a template file or directory exists
	 *
	 *
	 */
	public static function tempfile_exists() {

	      if( !file_exists( get_stylesheet_directory() . '/uix-contact.php' ) ) {
			  return false;
		  } else {
			  return true;
		  }

	}
		
	
	/*
	 * Callback the plugin directory
	 *
	 *
	 */
	public static function plug_directory() {

	  return plugin_dir_url( __FILE__ );

	}
	
	
	
	
	/*
	 * Copy template files to your theme directory
	 *
	 *
	 */
	
	public static function templates( $nonceaction, $nonce ){
	
		  global $wp_filesystem;
			
		  $filenames = array();
		  $filepath = WP_PLUGIN_DIR .'/'.self::get_slug(). '/theme_templates/';
		  $themepath = get_stylesheet_directory() . '/';

	      foreach ( glob( dirname(__FILE__). "/theme_templates/*") as $file ) {
			$filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		  }	
		  

		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  $contentdir = $filepath; 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir, '' ) ) {
	
				foreach ( $filenames as $filename ) {
					
				
					if ( ! file_exists( $themepath . $filename ) ) {
						
						$dir1 = $wp_filesystem->find_folder( $filepath );
						$file1 = trailingslashit( $dir1 ) . $filename;
						
						$dir2 = $wp_filesystem->find_folder( $themepath );
						$file2 = trailingslashit( $dir2 ) . $filename;
									
						$filecontent = $wp_filesystem->get_contents( $file1 );
	
						$wp_filesystem->put_contents( $file2, $filecontent, FS_CHMOD_FILE );
						
			
					} 
				}
				
				
				if ( self::tempfile_exists() ) {
					return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-contact' );
				} else {
					return __( '<div class="notice notice-error"><p><strong>There was a problem copying your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.</p></div>', 'uix-contact' );
				}
				
		
				
				
		  } 
	}	 



	/**
	 * Initialize the WP_Filesystem
	 * 
	 * Example:
	 
            $output = "";
			$wpnonce_url = 'edit.php?post_type='.UixContact::get_slug().'&page='.UixContact::HELPER;
			$wpnonce_action = 'temp-filesystem-nonce';

            if ( !empty( $_POST ) ) {
				
				
                  $output = UixContact::wpfilesystem_write_file( $wpnonce_action, $wpnonce_url, 'helper/tabs/', '1.txt', 'This is test.' );
				  echo $output;
			
            } else {
				
				wp_nonce_field( $wpnonce_action );
				echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Click This Button to Copy Files', 'uix-contact' ).'"  /></p>';
				
			}
	 *
	 */
	public static function wpfilesystem_connect_fs( $url, $method, $context, $fields = null) {
		  global $wp_filesystem;
		  if ( false === ( $credentials = request_filesystem_credentials( $url, $method, false, $context, $fields) ) ) {
			return false;
		  }
		
		  //check if credentials are correct or not.
		  if( !WP_Filesystem( $credentials ) ) {
			request_filesystem_credentials( $url, $method, true, $context);
			return false;
		  }
		
		  return true;
	}
	
	public static function wpfilesystem_write_file( $nonceaction, $nonce, $path, $pathname, $text ){
		  global $wp_filesystem;
		  
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  $contentdir = trailingslashit( WP_PLUGIN_DIR .'/'.self::get_slug() ).$path; 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir, '' ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				$wp_filesystem->put_contents( $file, $text, FS_CHMOD_FILE );
			
				return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-contact' );
				
		  } 
	}	
	
	 
	public static function wpfilesystem_read_file( $nonceaction, $nonce, $path, $pathname, $type = 'plugin' ){
		  global $wp_filesystem;
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
	
		  if ( $type == 'plugin' ) {
			  $contentdir = trailingslashit( WP_PLUGIN_DIR .'/'.self::get_slug() ).$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_template_directory() ).$path; 
		  } 	  
		
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				
				
				if( $wp_filesystem->exists( $file ) ) {
					
				    return $wp_filesystem->get_contents( $file );
	
				} else {
					return '';
				}
		
		
		  } 
	}	 
	
	
	

	/*
	 * Returns current plugin version.
	 *
	 *
	 */
	public static function ver() {
	
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_folder = get_plugins( '/' . self::get_slug() );
		$plugin_file = basename( ( __FILE__ ) );
		return $plugin_folder[$plugin_file]['Version'];


	}
	




	/*
	 * Print Custom Stylesheet
	 *
	 *
	 */
	public static function print_custom_stylesheet() {
	
		$custom_css = get_theme_mod( 'custom_uix_contact_css' );

		wp_add_inline_style( self::PREFIX . '-contact-frontend-style', $custom_css );

	}
		
		
		
	
	/*
	 * Callback function of "do shortcodes"
	 *
	 *
	 */
	public static function do_callback( $str ) {

	  return do_shortcode( $str );
	  

	}
	
	
	/*
	 * Enable comments on pages.
	 *
	 *
	 */
	public static function comments_open( $open, $post_id ) {

		$post = get_post( $post_id );
		
		if ( 'page' == $post->post_type )
			$open = true;
	
		return $open;
		

	}
	
	
	
	
	/*
	 * Uix Contact Scripts
	 *
	 *
	 */
	public static function plug_scripts( $str ) {

?>

		<script>
            ( function($) {
                'use strict';
            
                $( document ).ready( function() {
                
                    /*! 
                     * ************************************
                     * Uix Contact
                     *************************************
                     */
                    $( '#uix-contact-commentform' ).validate( {
                            submitHandler: function( form ) {
                    
                                var acturl = $(form).attr( 'action' );
                                
                                //Normal submitting
                                /*
                                $(form).find( "[type='submit']" ).attr('disabled', 'disabled');
                                $(form).find( "[type='submit']" ).val('Your message has been sent successfully.');
                                this.form.submit();
                                */
                                
                                //Submit A Form Without Page Refresh using jQuery
                                
                                $(form).find( "[type='submit']" ).val( 'Please wait.. Process Loading...' );
                                $(form).find( "[type='submit']" ).attr( 'disabled', 'disabled' );
                                $.post( acturl, $(form).serialize(), function( data ) {
									
								     	$(form).find( "[type='submit']" ).val( 'Your message has been sent successfully.' );
                                        return false;
                                });
                                
                                
                            
                            },
                            rules: {
                                email: "required email"
                            },
                            messages: {
                                author: "Please specify your name.",
                                comment: "Please enter your message.",
                                email: {
                                    required: "We need your email address to contact you.",
                                    email: "Your email address must be in the format of name@domain.com"
                                },
                                
                                my_author: "Please specify your name.",
                                my_comment: "Please enter your message.",
                                my_email: {
                                    required: "We need your email address to contact you.",
                                    email: "Your email address must be in the format of name@domain.com"
                                }
                            
                            }
                    });
            
            
                } ); 
            
            
                
            } ) ( jQuery );
        </script>

<?php
	}
	

}

add_action( 'plugins_loaded', array( 'UixContact', 'init' ) );
