<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'about' ) {
?>

        <p>
        <?php _e( 'Uix Contact allowing user to change different receiving messages options with the WordPress theme customizer and take advantage of built-in contact form. This plugin reconfigures the "phpmailer" function to use SMTP instead of mail() and creates an options page that allows you to specify various options. ', 'uix-contact' ); ?>
        </p>  
        

        <p>
        <?php _e( 'Setting an SMTP server for Wordpress is essential if you want to send or recieve HMTL emails from the built-in contact form. ', 'uix-contact' ); ?>
        </p>  
        
 
        <p>
        <?php _e( 'By default, the theme to use built-in WordPress comments form in lieu of a contact form. You could receive messages with My Email (Instead of using the comments).', 'uix-contact' ); ?>
        </p>       
        
        
        <h3>
        <?php _e( 'Features', 'uix-contact' ); ?>
        </h3>  
        <p>
        <?php _e( '* Quickly create a simple PHP contact form using SMTP or Post Comment.', 'uix-contact' ); ?><br>
        <?php _e( '* You can use WordPress theme customizer to manage settings for SMTP server and your email address that has Uix Contact plug-in installed.', 'uix-contact' ); ?><br>
        <?php _e( '* You can use custom e-mail templates to send messages.', 'uix-contact' ); ?><br>
       
<?php } ?>