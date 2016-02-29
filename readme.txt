=== Uix Contact ===
Contributors: UIUX Lab
Author URI: http://uiux.cc
Plugin URL: http://uiux.cc/wp-plugins/uix-contact/
Tags: contact, php contact form, SMTP, phpMailer, mailer
Requires at least: 4.2
Tested up to: 4.4.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Uix Contact allowing user to change different receiving messages options with the WordPress theme customizer and take advantage of built-in contact form.

== Description ==

Uix Contact allowing user to change different receiving messages options with the WordPress theme customizer and take advantage of built-in contact form. This plugin reconfigures the "phpmailer" function to use SMTP instead of mail() and creates an options page that allows you to specify various options. 

Setting an SMTP server for Wordpress is essential if you want to send or recieve HMTL emails from the built-in contact form. 

By default, the theme to use built-in WordPress comments form in lieu of a contact form. You could receive messages with My Email (Instead of using the comments).


= Credits and Special Thanks =
 - Automatic Theme & Plugin Updater for Self-Hosted Themes/Plugins (https://github.com/jeremyclark13/automatic-theme-plugin-update)
 - Kirki (http://kirki.org/)
 - PHPMailer (https://github.com/PHPMailer/)
 - Form validation (http://jqueryvalidation.org/)


= Features =

* Quickly create a simple PHP contact form using SMTP or Post Comment.
* You can use WordPress theme customizer to manage settings for SMTP server and your email address that has Uix Contact plug-in installed.
* You can use custom e-mail templates to send messages.



== Installation ==

1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to "Appearance -> Install Plugins".
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

2. Please check if you have the 4 template files "uix-contact-style.css", "uix-contact.php", "partials-uix_contact_form_smtp.php" and "partials-uix_contact_form_comments.php" in your templates directory. If you can't find these files, then just copy them from the directory '/wp-content/plugins/uix-contact/theme_templates/' to your templates directory. 

3. You can pretty much custom every aspect of the look and feel of this page by modifying the "*.php" template files (Access the path to the themes directory) . Best Practices for Editing WordPress Template Files:

  (1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to "Appearance > Editor" from your sidebar.

  (2) You can connect to your site via an FTP client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.


4. Adding Uix Contact to Web Pages.

There are three different ways you can add the Uix Contact widget to your site's pages:

  (1) Shortcode - Embed a shortcode into the editor of any post, page, or custom post type. 
      
      Use [uix_contact_form_smtp] or [uix_contact_form_comments] to add it to your Post, Widgets or Page content.
	  
	  Go to your WordPress admin panel, edit or create a new post (or page). You’ll see a Uix Contact button in the toolbar.
  
  (2) Template tags - Add a simple PHP function to one of your theme's template files. 
  
      Place <?php get_template_part( 'partials', 'uix_contact_form_smtp' ); ?>  or  <?php get_template_part( 'partials', 'uix_contact_form_comments' ); ?> in your templates.
	  
      
  (3) Create a Custom Page - Create a new WordPress file or edit an existing one. 
  
      Just make sure to select this new created template file as the "Template" for this page from the "Attributes" section. Save the page and hit "Preview" to see how it looks. ( You should specify the template name, in this case I used "Uix Contact". The "Template Name: Uix Contact" tells WordPress that this will be a custom page template. )
	  
   

5. The Uix Contact plugin allows users to easily enable a "Customizer Page" to themes. Go to "Appearance -> Customize".

6. You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original ".css" files. Go to "Appearance -> Customize".



== Changelog ==

= 1.0.0 =
*Release Date - 1st February, 2016*

* First release.
