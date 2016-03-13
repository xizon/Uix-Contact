<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'usage' ) {
?>


        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to <strong>"Appearance -> Install Plugins"</strong>.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)</h4>', 'uix-contact' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixContact::plug_directory(); ?>helper/img/plug.jpg" alt="">
        </p> 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">2. You need to create Uix Contact template files in your templates directory. You can create the files on the WordPress admin panel.</h4>', 'uix-contact' ); ?>
     
        </p>  
        <p>
           &nbsp;&nbsp;&nbsp;&nbsp;<a class="button button-primary" href="<?php echo admin_url( "admin.php?page=".UixContact::HELPER."&tab=temp" ); ?>"><?php _e( 'Create now!', 'uix-contact' ); ?></a>
     
        </p>  
         <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;As a workaround you can use FTP, access the Uix Contact template files path <code>/wp-content/plugins/uix-contact/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-contact' ); ?>
   
        </p>  
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;Please check if you have the 2 template files <code>"uix-contact-style.css"</code>, <code>"uix-contact.php"</code>, <code>"partials-uix_contact_form_smtp.php"</code> and <code>"partials-uix_contact_form_comments.php"</code> in your templates directory. If you can\'t find these files, then just copy them from the directory "/wp-content/plugins/uix-contact/theme_templates/" to your templates directory.', 'uix-contact' ); ?>
      
        </p>  
        <p>
           <img src="<?php echo UixContact::plug_directory(); ?>helper/img/temp.jpg" alt="">
        </p> 
  
     
         <p>
           <?php _e( '<h4 class="uix-bg-custom-title">3. You can pretty much custom every aspect of the look and feel of this page by modifying the <code>*.php</code> template files <strong>(Access the path to the themes directory)</strong> . Best Practices for Editing WordPress Template Files:</h4>', 'uix-contact' ); ?>
        </p> 
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to <strong>"Appearance > Editor"</strong> from your sidebar.', 'uix-contact' ); ?>
        </p>   
          
        <p>
           <img src="<?php echo UixContact::plug_directory(); ?>helper/img/editor.jpg" alt="">
        </p> 
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(2) You can connect to your site via an <strong>FTP</strong> client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.', 'uix-contact' ); ?>
        </p>  
         
    
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">4. Adding Uix Contact to Web Pages.</h4>', 'uix-contact' ); ?>
        </p>   
        <p>
           <?php _e( 'There are three different ways you can add the Uix Contact widget to your site\'s pages:', 'uix-contact' ); ?>
        </p>  
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(1) <strong>Shortcode</strong> - Embed a shortcode into the editor of any post, page, or custom post type.', 'uix-contact' ); ?>
        </p>  
        <p>
        
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Use <code>[uix_contact_form_smtp]</code> or <code>[uix_contact_form_comments]</code> to add it to your Post, Widgets or Page content. Go to your WordPress admin panel, edit or create a new post (or page). You’ll see our tiny little button in the toolbar, preceded by a separator:', 'uix-contact' ); ?>
        </p> 
        
         <p>
           <img src="<?php echo UixContact::plug_directory(); ?>helper/img/sc.jpg" alt="">
        </p>         
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(2) <strong>Template tags</strong> - Add a simple PHP function to one of your theme\'s template files.', 'uix-contact' ); ?>
        </p> 
        
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Place <code>&lt;?php get_template_part( \'partials\', \'uix_contact_form_smtp\' ); ?&gt;</code>  or  <code>&lt;?php get_template_part( \'partials\', \'uix_contact_form_comments\' ); ?&gt;</code> in your templates.', 'uix-contact' ); ?>
        </p> 

        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(3) <strong>Create a Custom Page</strong> - Create a new WordPress file or edit an existing one. ', 'uix-contact' ); ?>
        </p> 
        
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Just make sure to select this new created template file as the "Template" for this page from the "Attributes" section. Save the page and hit "Preview" to see how it looks. ( You should specify the template name, in this case I used "Uix Contact". The "Template Name: Uix Contact" tells WordPress that this will be a custom page template. )', 'uix-contact' ); ?>
        </p> 

        <p>
           <img src="<?php echo UixContact::plug_directory(); ?>helper/img/menu.jpg" alt=""> <img src="<?php echo UixContact::plug_directory(); ?>helper/img/add-page.jpg" alt="">
        </p> 
        
         <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In your dashboard go to Appearance and select Menus. You’ll be able to add items to the menu. On the left you have your contact pages.', 'uix-contact' ); ?>
        </p>        


        
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">5. The Uix Contact plugin allows users to easily enable a "Customizer Page" to themes. Go to <strong>"Appearance -> Customize"</strong>.</h4>', 'uix-contact' ); ?>
        </p>   
        <p>
           <img src="<?php echo UixContact::plug_directory(); ?>helper/img/customize.jpg" alt="">
        </p>  
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">6. You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original <code>.css</code> files. Go to <strong>"Appearance -> Customize"</strong>.</h4>', 'uix-contact' ); ?>
        </p>   
        <p>
           <img src="<?php echo UixContact::plug_directory(); ?>helper/img/css.jpg" alt="">
        </p>  
<?php } ?>