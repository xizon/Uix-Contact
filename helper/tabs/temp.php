<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'temp' ) {
	
	
	$wpnonce_url = 'edit.php?post_type='.UixContact::get_slug().'&page='.UixContact::HELPER;
	$wpnonce_action = 'temp-filesystem-nonce';
	
?>     

     <?php if( UixContact::tempfile_exists() ) { ?>
	 
	 
         <p>
           <?php _e( 'Uix Contact template files already exists.', 'uix-contact' ); ?>
   
        </p>  
        
    <?php } else {  ?>

         <h3><?php _e( 'Copy Uix Contact template files in your templates directory:', 'uix-contact' ); ?></h3>
         <p>
           <?php _e( 'As a workaround you can use FTP, access the Uix Contact template files path <code>/wp-content/plugins/uix-contact/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-contact' ); ?>
   
        </p>   
         
         <form method="post">
          <?php
		  
            $output = "";

            if ( !empty( $_POST ) ) {
				
				
                  $output = UixContact::templates( $wpnonce_action, $wpnonce_url );
				  echo $output;
			
            } else {
				
				wp_nonce_field( $wpnonce_action );
				echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Click This Button to Copy Files', 'uix-contact' ).'"  /></p>';
				
			}

          ?>
         </form>
         
         
    <?php } ?>
    
<?php } ?>