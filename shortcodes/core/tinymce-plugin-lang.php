<?php
// This file is based on wp-includes/js/tinymce/langs/wp-langs.php

if ( ! defined( 'ABSPATH' ) )
    exit;

if ( ! class_exists( '_WP_Editors' ) )
    require( ABSPATH . WPINC . '/class-wp-editor.php' );

function uix_contact_custom_tinymce_plugin_translation() {
    $strings = array(
        'lang_1' => __( 'Uix Contact', 'uix-contact' ),
		'lang_2' => __( 'Insert Uix Contact', 'uix-contact' ),
		'lang_3' => __( 'Make a contact form use Post Comment (send private messages in WordPress)', 'uix-contact' ),
		'lang_4' => __( 'Make a contact form use SMTP (send email with PHPMailer)', 'uix-contact' ),
		
		
		
    );
    $locale = _WP_Editors::$mce_locale;
    $translated = 'tinyMCE.addI18n("' . $locale . '.uix_contact_custom_tinymce_plugin", ' . json_encode( $strings ) . ");\n";

     return $translated;
}

$strings = uix_contact_custom_tinymce_plugin_translation();