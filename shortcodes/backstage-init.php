<?php
/**
 * Add shortcodes
 *
 * Search content for shortcodes and filter shortcodes through their hooks.
 */



/**
 * To add buttons to the editor
 *
 */
function uix_contact_register_buttons( $buttons ) {
    array_push( $buttons, 'uix_contact_btn' ); 
    return $buttons;
}
add_filter( 'mce_buttons', 'uix_contact_register_buttons' );


function uix_contact_add_buttons( $plugin_array ) {
    $plugin_array['uix_contact'] = UixContact::plug_directory() .'shortcodes/core/tinymce-plugin.js';
    return $plugin_array;
}
add_filter( "mce_external_plugins", "uix_contact_add_buttons" );





