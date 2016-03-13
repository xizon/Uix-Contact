<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'credits' ) {
?>


        <h3>
           <?php _e( 'I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:', 'uix-contact' ); ?>
        </h3>  
        <p>
        
        <ul>
            <li><a href="http://w-shadow.com" target="_blank" rel="nofollow">Plugin Update Checker Library</a></li>
            <li><a href="http://kirki.org/" target="_blank" rel="nofollow">Kirki</a></li>
            <li><a href="https://github.com/PHPMailer/" target="_blank" rel="nofollow">PHPMailer</a></li>
            <li><a href="http://jqueryvalidation.org/" target="_blank" rel="nofollow">Form validation</a></li>


        </ul>
        
        </p> 
        
    
<?php } ?>