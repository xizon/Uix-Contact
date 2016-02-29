<?php

function uix_contact_options_page(){
	
    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

  
?>



<div class="wrap">
    
    <h2><?php _e( 'Uix Contact Helper', 'uix-contact' ); ?></h2>
    <?php
	
	if( !isset( $_GET[ 'tab' ] ) ) {
		$active_tab = 'about';
	}
	
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	} 
	
	$tabs = array();
	$tabs[] = [
	    'tab'     =>  'about', 
		'title'   =>  __( 'About', 'uix-contact' )
	];
	$tabs[] = [
	    'tab'     =>  'usage', 
		'title'   =>  __( 'How to use?', 'uix-contact' )
	];
	
	$tabs[] = [
	    'tab'     =>  'credits', 
		'title'   =>  __( 'Credits', 'uix-contact' )
	];
	

	
	?>
    <h2 class="nav-tab-wrapper">
        <?php foreach ( $tabs as $key ) :  ?>
            <?php $url = 'admin.php?page=' . rawurlencode( UixContact::CUSPAGE ) . '&tab=' . rawurlencode( $key[ 'tab' ] ); ?>
            <a href="<?php echo esc_attr( is_network_admin() ? network_admin_url( $url ) : admin_url( $url ) ) ?>"
               class="nav-tab<?php echo $active_tab === $key[ 'tab' ] ? esc_attr( ' nav-tab-active' ) : '' ?>">
                <?php echo $key[ 'title' ] ?>
            </a>
        <?php endforeach ?>
    </h2>

    <?php 
		foreach ( glob( WP_PLUGIN_DIR .'/'.UixContact::get_slug(). "/helper/tabs/*.php") as $file ) {
			include $file;
		}	
	?>
        
    
    
</div>
 
    <?php
     
}