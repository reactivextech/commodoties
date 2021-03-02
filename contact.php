<?php
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
          // Recibir vía POST los datos del formulario
          $name = $_POST["name"];
          $email = $_POST["email"];
          $subject = $_POST["subject"];
          $message = $_POST["message"];

          if (empty($correo)){ // Validar si la dirección de correo no esta vacia
            $error=1;
            $mensaje="Please complete all the fields of the form.";
            $datos=0;
          } else {

            $usuario_mail="info@micomcommodities.com"; // Direccion de envio
            $remite = "www.micomcommodities.com"; //Nombre de Quien remite o envia
            $remite_email = "no-reply@micomcommodities.com";
            $asunto = "Contact email from $remite";

            // Armar un mensaje html para el cuerpo del correo electrónico
            $message = "<!doctype html>
            <html class=''><head><meta charset='utf-8'>
            <title>They have sent the following contact form</title>
            </head>
            <body>
            <h1>Contact from www.micomcommodities.com <br clear='all'/>(online)</h1><br clear='all'/>
            Name: ".$name." <br clear='all'/>
            Email: ".$email." <br clear='all'/>
            Subject: ".$subject." <br clear='all'/>
            Message: <br clear='all'/> ".$message." <br clear='all'/>
            </body></html>";

            $cabeceras = "From: ".$remite." <".$remite_email.">\r\n";
            $cabeceras = $cabeceras."Mime-Version: 1.0\n";
            $cabeceras = $cabeceras.'Content-type: text/html; charset=utf-8' . "\r\n";

            // Realizar el envío con la función mail de php
            $enviar_email = mail($usuario_mail, $asunto, $mensaje, $cabeceras);

            if($enviar_email) { // Envío exitoso
              $error=0;
              $mensaje="Mail sent, we will be answering you as soon as possible.";
              $datos=0;
            }else { // No se pudo enviar el correo
              $error=1;
              $mensaje="The mail could not be sent, please try again.";
              $datos=0;
            }
          }

        // Empaquetado de la respuesta en formato JSON
          $resp=[
            "error"=>$error,
            "mensaje"=>$mensaje,
            "datos"=>$datos,
          ];

        echo json_encode($resp);

        } else {
          $resp=[
           "error"=>1,
           "mensaje"=>"The server denied the request.",
           "datos"=>0
          ];
          echo json_encode($resp);
        }
        ?>