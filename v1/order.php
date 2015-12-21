<?php

	/* Simple order form script 
		Uses $_POST variables: email, model, date
	**/

	$email = htmlspecialchars($_POST['email']);
	$model = htmlspecialchars($_POST['model']);
	$date = htmlspecialchars($_POST['date']);

	/* You can edit the templates below to customize reservation emails. Remember to change $mail_address to your email address. */
	$mail_subject = "New email";
	$mail_content = "Someone has submitted the form!\r\n \r\nEmail: ".$name."\r\nChosen type: ".$model."\r\nDate: ".$date."\r\n";
	$mail_address = "yourmail@mail.com";   /*  Your email **/

	$mail_content = wordwrap($mail_content, 70, "\r\n");
	$headers = 'X-Mailer: PHP/'.phpversion();
	mail($mail_address, $mail_subject, $mail_content, $headers);

	header('Location: /confirm.html');
?>
