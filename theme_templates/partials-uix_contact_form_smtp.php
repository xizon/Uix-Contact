<?php
/**
 * The template for displaying SMTP Form.
 *
 *
 */

/*
 * Form input values
*/
$exAuthor = '';
$exEmail = '';
$exURL = '';
$exComment = '';

if( isset( $_POST['my_author'] ) ) $exAuthor = $_POST['my_author'];
if( isset( $_POST['my_email'] ) )  $exEmail = $_POST['my_email'];
if( isset( $_POST['my_url'] ) )  $exURL = $_POST['my_url'];
if( isset( $_POST['my_comment'] ) ) { if( function_exists( 'stripslashes' ) ) { $exComment = stripslashes( $_POST['my_comment'] ); } else { $exComment = $_POST['my_comment']; } }

/*
 * Status of emails being sent by your PHP apps.
*/
$emailSentStatus = '';
$emailError = false;
$infoError = '';


/*
 * Get Vars of SMTP
*/
$emailTo = get_theme_mod( 'custom_uix_contact_toemail' );
$sendTemp = wpautop( get_theme_mod( 'custom_uix_contact_msg_bodytemp' ) );
$fromname = get_theme_mod( 'custom_uix_contact_smtp_fromname' );
$frommail = get_theme_mod( 'custom_uix_contact_smtp_frommail' );
$smtpserver = get_theme_mod( 'custom_uix_contact_smtp_host' );
$smtpserverport = get_theme_mod( 'custom_uix_contact_smtp_port' );
$smtpuser = get_theme_mod( 'custom_uix_contact_smtp_user' );
$smtpsecure = '';	
$smtppass = get_theme_mod( 'custom_uix_contact_smtp_pass' );
$smtpauthen = get_theme_mod( 'custom_uix_contact_smtp_authentication', true );	
$blogname = get_bloginfo( 'name', 'display' );	
$mailPostTitle = str_replace( '{site_name}', $blogname, get_theme_mod( 'custom_uix_contact_msg_sub' ) );



if ( empty( $sendTemp ) ) {
	$sendTemp = '
<p>'.__( 'You have a new message from contact form.', 'uix-contact' ).'</p>
<p></p>
<p>'.__( 'Name', 'uix-contact' ).': {user_name}</p>
<p>'.__( 'Email', 'uix-contact' ).': {user_email}</p>
<p>'.__( 'Website/Tel.', 'uix-contact' ).': {user_info} </p>
<p></p>
<p>{message}</p>
				';		
}

if ( empty( $mailPostTitle ) ) {
	$mailPostTitle = str_replace( '{site_name}', $blogname, '{site_name} You have a new message' );
}



if ( empty( $emailTo ) ) $emailTo = get_bloginfo( 'admin_email' );

if ( get_theme_mod( 'custom_uix_contact_smtp_type' ) == 'none' )  $smtpsecure = '';	
if ( get_theme_mod( 'custom_uix_contact_smtp_type' ) == 'ssl' )  $smtpsecure = 'SSL';	
if ( get_theme_mod( 'custom_uix_contact_smtp_type' ) == 'tls' )  $smtpsecure = 'TLS';	

/*
 * Send data to SMTP server
*/

if( isset( $_POST['submitted'] ) && $_POST['submitted'] == true ) { 


	//------Field (url)
	$url = trim( $_POST['my_url'] );
	
	
	//------Field (author)
	if( trim( $_POST['my_author'] ) == '' ) {
		$infoError = '<span class="error">'.__( 'Please specify your name.', 'uix-contact' ).'</span>';
		$emailError = true;
	} else {
		$name = trim( $_POST['my_author'] );
	}

	//------Field (email from)
	if( trim( $_POST['my_email'] ) == '' )  {
		$infoError = '<span class="error">'.__( 'We need your email address to contact you.', 'uix-contact' ).'</span>';
		$emailError = true;
	} else if ( !preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', trim( $_POST['my_email'] ) ) ) {
		$infoError = '<span class="error">'.__( 'Your email address must be in the format of name@domain.com', 'uix-contact' ).'</span>';
		$emailError = true;
	} else {
		$email = trim( $_POST['my_email'] );
	}
 
 
	//------Field (comment)
	if( trim( $_POST['my_comment'] ) == '' ) {
		$infoError = '<span class="error">'.__( 'Please enter your message.', 'uix-contact' ).'</span>';
		$emailError = true;
	} else {
		if( function_exists( 'stripslashes' ) ) {
			$comments = stripslashes( nl2br( $_POST['my_comment'] ) );
		} else {
			$comments = nl2br( $_POST['my_comment'] );
		}
	}
	
	
	
	 
	//------Field (email to)
	$mailbody = '
	<html>
	<head>
	<meta charset="utf-8">
	</head>
	
	<body>
	'.$sendTemp.'
	</body>
	</html>
			
	';
	
	
	if ( $emailError == false ) {
	

		$mailbody = str_replace( '{site_name}', $blogname,
					str_replace( '{user_name}', $name,
					str_replace( '{user_email}', $email,
					str_replace( '{user_info}', $url,
					str_replace( '{message}', $comments,
					$mailbody
					)))));
		
		
	
		$mail = new PHPMailer;
		
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $smtpserver;                            // Specify main and backup SMTP servers
		$mail->SMTPAuth = $smtpauthen;                        // Enable SMTP authentication
		$mail->Username = $smtpuser;                          // SMTP username
		$mail->Password = $smtppass;                          // SMTP password
		$mail->SMTPSecure = $smtpsecure;                      // `tls`, `ssl`
		$mail->Port = $smtpserverport;                        // TCP port to connect to
		
		$mail->From = $frommail;                              //Sender
		$mail->FromName = $fromname;
		
		//-----
		$mail->setFrom( $frommail, $fromname );
		$mail->addAddress( $emailTo );                        // Add a recipient,Name is optional
		$mail->isHTML( true );                                  // Set email format to HTML
		
		
		
		
		$mail->Subject = $mailPostTitle;
		$mail->Body    = $mailbody;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		
		if( !$mail->send() ) {
			$emailSentStatus = '	<p>'.__( 'Mailer Error: ', 'uix-contact' ).'' . $mail->ErrorInfo.'</p>';
		} else {
			$emailSent = true;
		}

	}

}

if( isset( $_POST['submitted'] ) ) { 
	$emailSentStatus = '	<p>'.$infoError.'</p>';
} 

if( isset( $emailSent ) && $emailSent == true ) { 
	$emailSentStatus = '	<p>'.__( 'Thanks, your email was sent successfully.', 'uix-contact' ).'</p>';
} 


?>


<?php echo $emailSentStatus; ?>

<form id="uix-contact-commentform" action="<?php the_permalink(); ?>"  method="post">
		<p>
           <label for="my_author"><?php _e( 'Name', 'uix-contact' ); ?></label><span class="req-icon">*</span>
			<input type="text" name="my_author" id="my_author" size="45" value="<?php echo $exAuthor; ?>" class="required" />

		</p>
		<p>
           <label for="my_email"><?php _e( 'Email', 'uix-contact' ); ?></label><span class="req-icon">*</span>
			<input type="text" name="my_email" id="my_email" size="45" value="<?php echo $exEmail; ?>" class="required email" />

	    </p>
		<p>
           <label for="my_url"><?php _e( 'Website', 'uix-contact' ); ?></label>
			<input type="text" name="my_url" id="my_url" size="45" value="<?php echo $exURL; ?>"  />
	    </p>
		<p>
           <label for="my_comment"><?php _e( 'Message', 'uix-contact' ); ?></label><span class="req-icon">*</span>
 		    <textarea name="my_comment" id="my_comment" cols="45" rows="8" class="required" ><?php echo $exComment; ?></textarea>

		</p>
		   <input type="submit" class="submit btn-custom-default" value="Send Message">
		<p>
	    <input type="hidden" name="submitted" id="submitted" value="true" />


</form>

