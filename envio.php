<?php
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

$header = 'From: ' . $email . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$mensaje = "Este mensaje fue enviado por " . $nombre . ", ". $apellido ." \r\n";
$mensaje .= "Su e-mail es: " . $email . " \r\n";
$mensaje .= "Su contacto es: " . $telefono . " \r\n";
$mensaje .= "Su Asunto es: " . $asunto . " \r\n";
$mensaje .= "Mensaje: " . $_POST['mensaje'] . " \r\n";
$mensaje .= "Enviado el " . date('d/m/Y', time());

$para = 'comunidaderbrands@gmail.com';
$asunto = 'Mensaje de mi sitio web';

mail($para, $asunto, utf8_decode($mensaje), $header);

echo'<script type="text/javascript">
        alert("Mensaje enviado");
        window.location.href="index.html";
        </script>';

?>
