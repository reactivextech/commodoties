<?php
	if (isset($_POST['fname'])){
		$nombres=htmlentities($_POST['fname']);
		$email_cliente=htmlentities($_POST['email']);
		$subject=utf8_decode($_POST['subject']);
		$mensaje=htmlentities($_POST['message']);

	/*SIGUE RECOLECTANDO DATOS PARA FUNCION MAIL*/
	$message = '';
	$message .= '<p>Hello, a new message has been registered from the contact form of the website, according to the following detail:</p> ';
	$message .= '<p>Client: '.$nombres.'</p> ';
	$message .= '<p>Email: '.$email_cliente.'</p> ';
	$message .= '<p>Subjec: '.$subject.'</p> ';
	$message .= '<p>Message: '.$mensaje.'</p> ';

	$header = "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html; charset=UTF-8\r\n";
	$header .= "From: ". $nombres . " <" . $email_cliente . ">\r\n";
	$email='info@micomcommodities.com';//Ingresa tu dirección de correo

	if (mail($email,$subject,$message,$header)){
		echo 'success';
	}	 else {
		echo 'The message could not be sent.';
	}
	/*FINALIZA RECOLECTANDO DATOS PARA FUNCION MAIL*/
	}
?>