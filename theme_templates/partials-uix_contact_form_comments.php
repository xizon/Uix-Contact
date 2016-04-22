<?php
/**
 * The template for displaying Comments Form.
 *
 *
 */



/*
* Extend WordPress comment form with your own custom fields.
*/


$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$required_text = sprintf( ' ' . __('Required fields are marked %s','uix-contact'), '<span class="req-icon">*</span>' );
$post_id = get_the_ID();
$user = wp_get_current_user();
$user_identity = $user->exists() ? $user->display_name : '';



$uix_contact_custom_default_fields =  array( 

'author' => '<p class="uix-contact-commentform-author">
				  <label for="author">'.__( 'Name', 'uix-contact' ).'</label>'.( $req ? '<span class="req-icon">*</span>' : '' ).
				  '<input id="author" name="author" type="text" class="required" value="'.esc_attr( $commenter['comment_author'] ).'" size="45" '.$aria_req.' />
			</p>',
			
'email'  => '<p class="uix-contact-commentform-email">
				  <label for="email">'.__( 'Email', 'uix-contact' ).'</label>'.( $req ? '<span class="req-icon">*</span>' : '' ).
				  '<input id="email" name="email" type="text" class="required email" value="'.esc_attr( $commenter['comment_author_email'] ).'" size="45" '.$aria_req.' />
			 </p>',
			 
'url'    => '<p class="uix-contact-commentform-url">
				 <label for="url">'.__( 'Website', 'uix-contact' ).'</label>'.
				 '<input id="url" name="url" type="text" value="'.esc_attr( $commenter['comment_author_url'] ).'" size="45" />
			</p>', );


$commenter = wp_get_current_commenter();
$req = get_option(  'require_name_email'  );
$aria_req = (  $req ? " aria-required='true'" : ''  );


$commentform_args = array( 

	'fields'               => apply_filters( 'comment_form_default_fields',$uix_contact_custom_default_fields ),
	
	'comment_field'        => '<p class="uix-contact-commentform-comment">
									<label for="comment">'.__( 'Comment', 'uix-contact' ).'</label>'.( $req ? '<span class="req-icon">*</span>' : '' ).
									'<textarea id="comment" class="required" name="comment" cols="45" rows="8" '.$aria_req.'></textarea>
							   </p>
							   
							   ',
							   
	'must_log_in'          => '<p class="must-log-in">
								   '.__( 'You must be', 'uix-contact' ).' <a href="'.wp_login_url( apply_filters( 'the_permalink',get_permalink( $post_id ) ) ).'">'.__( 'logged in', 'uix-contact' ).'</a> '.__( 'to post a comment', 'uix-contact' ).'.
							  </p>',
	
	'logged_in_as'         => ''.__( 'Logged in as', 'uix-contact' ).' <a href="'.admin_url( 'profile.php' ).'">'.$user_identity.'</a>.
							   <a href="'.wp_logout_url( apply_filters( 'the_permalink',get_permalink( $post_id ) ) ).'" title="'.__( 'Log out of this account', 'uix-contact' ).'">'.__( 'Log out', 'uix-contact' ).'?</a>
							   <hr>
							   ',
							   
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	
	
	'id_form'              => 'uix-contact-commentform',
	'id_submit'            => 'submit',
	'class_submit'         => 'submit btn-custom-default',
	'title_reply'          => __( 'Leave a Reply', 'uix-contact' ),
	'title_reply_to'       => __( 'Leave a Reply to %s', 'uix-contact' ),
	'cancel_reply_link'    => __( 'Cancel reply', 'uix-contact' ),
	'label_submit'         => __( 'Leave a message', 'uix-contact' )
 );
	
		

comment_form( $commentform_args ); 

// If comments are closed and there are comments,let's leave a little note,shall we?
if ( ! comments_open() ) {
    echo '<p class="no-comments">'.__( 'Comments are closed.', 'uix-contact' ).'</p>';	
}

