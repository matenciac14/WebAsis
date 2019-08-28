<?php
	ini_set("SMTP","javsas.com");
	ini_set("smtp_port","localhost");
	ini_set('sendmail_from', 'contacto@javsas.com');

    //variables para los campos de texto
    $tipoid = strip_tags($_POST["tipoid"]);
    $numeroid = strip_tags($_POST["id"]);
	$nombre = strip_tags($_POST["nombre"]);	
    $mail = strip_tags($_POST["email"]);
    $telefono = strip_tags($_POST["telefono"]);
	

	//variables para los datos del archivo
	$nameFile = $_FILES['archivo']['name'];
	$sizeFile = $_FILES['archivo']['size'];
	$typeFile = $_FILES['archivo']['type'];
	$tempFile = $_FILES["archivo"]["tmp_name"];
	$fecha= time();
	$fechaFormato = date("j/n/Y",$fecha);

	$correoDestino = "desarrollo@erbrands.com";
	
	//asunto del correo
	$asunto = "Enviado por " . $nombre . " ". $telefono;

 	
 	// -> mensaje en formato Multipart MIME
	$cabecera = "MIME-VERSION: 1.0\r\n";
	$cabecera .= "Content-type: multipart/mixed;";
	//$cabecera .="boundary='=P=A=L=A=B=R=A=Q=U=E=G=U=S=T=E=N='"
	$cabecera .="boundary=\"=C=T=E=C=\"\r\n";
	$cabecera .= "From: {$mail}";

	//Primera parte del cuerpo del mensaje
	$cuerpo = "--=C=T=E=C=\r\n";
	$cuerpo .= "Content-type: text/plain";
	$cuerpo .= "charset=utf-8\r\n";
	$cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
	$cuerpo .= "\r\n"; // línea vacía
	$cuerpo .= "Correo enviado por: --> " . $nombre . "______ ";
	$cuerpo .= " con fecha: " . $fechaFormato . "\r\n";
    $cuerpo .= "Email: " . $mail . "\r\n";
    $cuerpo .= "Tipo de Identificacion: " . $tipoid . "\r\n";
	$cuerpo .= "Identificacion: " . $numeroid . "\r\n";
	$cuerpo .= "tipoID: " . $tipoid . "\r\n";
	$cuerpo .= "Telefono: " . $telefono . "\r\n";
	$cuerpo .= "\r\n";// línea vacía

 	// -> segunda parte del mensaje (archivo adjunto)
        //    -> encabezado de la parte
    $cuerpo .= "--=C=T=E=C=\r\n";
    $cuerpo .= "Content-Type: application/octet-stream; ";
    $cuerpo .= "name=" . $nameFile . "\r\n";
    $cuerpo .= "Content-Transfer-Encoding: base64\r\n";
    $cuerpo .= "Content-Disposition: attachment; ";
    $cuerpo .= "filename=" . $nameFile . "\r\n";
    $cuerpo .= "\r\n"; // línea vacía

    $fp = fopen($tempFile, "rb");
    $file = fread($fp, $sizeFile);
	$file = chunk_split(base64_encode($file));

    $cuerpo .= "$file\r\n";
    $cuerpo .= "\r\n"; // línea vacía
    // Delimitador de final del mensaje.
    $cuerpo .= "--=C=T=E=C=--\r\n";
    
	//Enviar el correo
	if(mail($correoDestino, $asunto, $cuerpo, $cabecera)){
		echo'<script type="text/javascript">
        alert("Mensaje enviado");
        window.location.href="trabajaconnosotros.html";
        </script>';
	}else{
		echo'<script type="text/javascript">
        alert("ERROR Mensaje no enviado");
        window.location.href="trabajaconnosotros.html";
        </script>';
	}

?>