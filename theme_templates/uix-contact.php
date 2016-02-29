<?php
/**
 * Template Name: Uix Contact
 *
 * The template for displaying contact pages.
 *
 */

 
// Return if doesn't have the class.
if ( !class_exists( 'UixContact' ) ) { 
    echo '
		<p><strong><span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;">'.__( 'This theme comes packaged with the following plugins:', 'uix-contact' ).' </span>
		<span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;">'.__( 'The following required plugin is currently inactive:', 'uix-contact' ).' <em>Uix contact</em>.</span>
		<span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;"><a href="'.admin_url().'/themes.php?page='.wp_get_theme()->get( 'TextDomain' ).'-install-required-plugins&#038;plugin_status=activate">'.__( 'Begin activating plugin', 'uix-contact' ).'</a></span>
		</strong></p>
	';
    return;
}


add_action( 'wp_footer', array( 'UixContact', 'plug_scripts' ), 100 );

get_header(); ?>
 

<?php 
   // Start the loop.
   while ( have_posts() ) : the_post();?>
   
   
    <div class="uix-contact-container">
            
            <header>
            
                <h1 class="heading">
                    <?php the_title();?>
                </h1>
                
                <?php the_content(); ?>
                
            </header>
   
            
            <section class="body">
            
              
					 <?php
            
                        if ( get_theme_mod( 'custom_uix_contact_mode', false ) ) {
                            //Using SMTP
                            echo '<!-- Using SMTP -->';
                            get_template_part( 'partials', 'uix_contact_form_smtp' );
                        } else {
                            //Using Comment
                            echo '<!-- Using Comment -->';
                            get_template_part( 'partials', 'uix_contact_form_comments' );
                        }		
         
                        ?>
                            
                  
            </section>

    </div><!-- /.container -->

  <?php
// End the loop.
endwhile;
?>  


<?php get_footer(); ?>


