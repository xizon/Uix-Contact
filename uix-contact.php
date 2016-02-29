<?php
/*
Plugin Name: Uix Contact
Plugin URI: http://uiux.cc/wp-plugins/uix-contact/
Description: Uix Contact allowing user to change different receiving messages options with the WordPress theme customizer and take advantage of built-in contact form.
Author: UIUX Lab
Author URI: http://uiux.cc
Version: 1.0.0
Text Domain: uix-contact
License: GPLv2 or later
*/


class UixContact {
	
	const PREFIX = 'uix';
	const CUSPAGE = 'uix-contact-custom-submenu-page';

	
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
		add_action( 'admin_init', array( __CLASS__, 'check_update' ) );
		add_action( 'admin_init', array( __CLASS__, 'templates' ) );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_action( 'wp_head', array( __CLASS__, 'do_my_shortcodes' ) );
		add_action( 'init', array( __CLASS__, 'customizer' ) );
		add_filter( 'comments_open', array( __CLASS__, 'comments_open' ), 10, 2 );
		

	}
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
	
		// Form validation
		wp_enqueue_script( self::PREFIX . '-contact-js-validate', self::plug_directory() .'assets/js/jquery.validate.min.js', array( 'jquery' ), '1.14.0', true );	
	
		
		//Main stylesheets and scripts to Front-End
		wp_enqueue_style( self::PREFIX . '-contact-frontend-style', get_template_directory_uri() .'/uix-contact-style.css', false, self::ver(), 'all');
			

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
			self::CUSPAGE,
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
			'http://uiux.cc/wp-plugins/'.self::get_slug().'/update/info.json',
			__FILE__
		);

	}
	
	
	/**
	 * Add plugin actions links
	 */
	public static function actions_links( $links ) {
		$links[] = '<a href="' . admin_url( "customize.php" ) . '">' . __( 'Settings', 'uix-contact' ) . '</a>';
		$links[] = '<a href="' . admin_url( "admin.php?page=".self::CUSPAGE."&tab=usage" ) . '">' . __( 'How to use?', 'uix-contact' ) . '</a>';
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
	
		  if( $currentScreen->base === "post" || mb_strlen( strpos( $currentScreen->base, '_page_' ), 'UTF8' ) > 0 ) {
			
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
	 * Callback the plugin directory
	 *
	 *
	 */
	public static function plug_directory() {

	  return plugin_dir_url( __FILE__ );

	}
	
	
	
	
	/*
	 * Move template files to your theme directory
	 *
	 *
	 */
	public static function templates() {
		
		
		$filenames = array();
		$filepath = WP_PLUGIN_DIR .'/'.self::get_slug(). '/theme_templates/';
		$themepath = get_stylesheet_directory() . '/';

		foreach ( glob( dirname(__FILE__). "/theme_templates/*") as $file ) {
			$filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		}	
		
	
		self::init_filesystem();
		global $wp_filesystem;

		foreach ( $filenames as $filename ) {
			if ( ! file_exists( $themepath . $filename ) ) {
				$filecontent = $wp_filesystem->get_contents( $filepath . $filename );
				$wp_filesystem->put_contents(  $themepath . $filename, $filecontent, FS_CHMOD_FILE);
			} 
		}
		
	}
	

	/**
	 * Initialize the WP_Filesystem
	 *
	 */
	public static function init_filesystem() {
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
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
