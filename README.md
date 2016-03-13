# Uix Contact
This is a WordPress Plugin. Uix Contact allowing user to change different receiving messages options with the WordPress theme customizer and take advantage of built-in contact form.

Copyright (c) 2016 UIUX Lab [@uiux_lab](http://twitter.com/uiux_lab)


[Plugin URI](http://uiux.cc/wp-plugins/uix-contact/)

### Licensing

Licensed under the [GPL3.0](http://www.gnu.org/licenses/gpl-3.0.en.html).

### Description

Uix Contact allowing user to change different receiving messages options with the WordPress theme customizer and take advantage of built-in contact form. This plugin reconfigures the "phpmailer" function to use SMTP instead of mail() and creates an options page that allows you to specify various options. 

Setting an SMTP server for Wordpress is essential if you want to send or recieve HMTL emails from the built-in contact form. 

By default, the theme to use built-in WordPress comments form in lieu of a contact form. You could receive messages with My Email (Instead of using the comments).



### Updates 

##### Version 1.0.0
Initial Release.


### Tested under

- WP 4.2.*
- WP 4.3.*
- WP 4.4.1
- WP 4.4.2


###Features

- Quickly create a simple PHP contact form using SMTP or Post Comment.
- You can use WordPress theme customizer to manage settings for SMTP server and your email address that has Uix Contact plug-in installed.
- You can use custom e-mail templates to send messages.


###Credits

#####I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:

- [Automatic Theme & Plugin Updater for Self-Hosted Themes/Plugins](https://github.com/jeremyclark13/automatic-theme-plugin-update)
- [Kirki](http://kirki.org/)
- [PHPMailer](https://github.com/PHPMailer/)
- [Form validation](http://jqueryvalidation.org/)


###How to use?

1.After activating your theme, you can see a prompt pointed out as absolutely critical. Go to **"Appearance -> Install Plugins"**.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

![](https://github.com/xizon/Uix-Contact/blob/master/helper/img/plug.jpg)

2.You need to create Uix Contact template files in your templates directory. You can create the files on the WordPress admin panel. As a workaround you can use FTP, access the Uix Contact template files path (`/wp-content/plugins/uix-contact/theme_templates/`) and upload files to your theme templates directory (`/wp-content/themes/{your-theme}/`).  


Please check if you have the **4** template files `uix-contact-style.css`, `uix-contact.php`, `partials-uix_contact_form_smtp.php` and `partials-uix_contact_form_comments.php` in your templates directory. If you can't find these files, then just copy them from the directory **"/wp-content/plugins/uix-contact/theme_templates/"** to your templates directory.

![](https://github.com/xizon/Uix-Contact/blob/master/helper/img/temp.jpg)


3.You can pretty much custom every aspect of the look and feel of this page by modifying the `*.php` template files **(Access the path to the themes directory)**. **Best Practices for Editing WordPress Template Files:**

　(1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to **"Appearance > Editor"** from your sidebar.
  
  ![](https://github.com/xizon/Uix-Contact/blob/master/helper/img/editor.jpg)

　(2) You can connect to your site via an **FTP** client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.


4.**Adding Uix Contact to Web Pages.**

There are three different ways you can add the Uix Contact widget to your site's pages:

　(1)  **Shortcode** - Embed a shortcode into the editor of any post, page, or custom post type. 

　　Use `[uix_contact_form_smtp]` or `[uix_contact_form_comments]` to add it to your Post, Widgets or Page content.  Go to your WordPress admin panel, edit or create a new post (or page). You’ll see our tiny little button in the toolbar, preceded by a separator:

![](https://github.com/xizon/Uix-Contact/blob/master/helper/img/sc.jpg)
  
  
　(2)  **Template tags** - Add a simple PHP function to one of your theme's template files. 

　　Place `<?php get_template_part( 'partials', 'uix_contact_form_smtp' ); ?>`  or  `<?php get_template_part( 'partials', 'uix_contact_form_comments' ); ?>` in your templates.


　(3)  **Create a Custom Page** - Create a new WordPress file or edit an existing one.

　　Just make sure to select this new created template file as the **"Template"** for this page from the **"Attributes"** section. Save the page and hit **"Preview"** to see how it looks. ( You should specify the template name, in this case I used `Uix Contact`. The "Template Name: Uix Contact" tells WordPress that this will be a custom page template. )


![](https://github.com/xizon/Uix-Contact/blob/master/helper/img/menu.jpg)

![](https://github.com/xizon/Uix-Contact/blob/master/helper/img/add-page.jpg)


　　In your dashboard go to Appearance and select Menus. You’ll be able to add items to the menu. On the left you have your contact pages.



5.The Uix Contact plugin allows users to easily enable a "Customizer Page" to themes. Go to **"Appearance -> Customize"**.

![](https://github.com/xizon/Uix-Contact/blob/master/helper/img/customize.jpg)


6.You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original `.css` files. Go to **"Appearance -> Customize"**.

![](https://github.com/xizon/Uix-Contact/blob/master/helper/img/css.jpg)
