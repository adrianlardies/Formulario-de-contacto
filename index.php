<?php

$errores = ''; // Cadena en blanco.
$enviado = '';

// Queremos comprobar si nuestro formulario ha sido enviado. Nuestro submit es el que le pusimos de name submit en el html. Esto significa simplemente que presiono el submit, pudo hacerlo sin haber introducido ningún dato.
if(isset($_POST['submit'])){
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$mensaje = $_POST['mensaje'];

    if(!empty($nombre)){ // Comprobamos que tiene algo de contenido.
		// Saneamos el nombre para eliminar caracteres que no deberian estar.
		$nombre = trim($nombre); // Trim quita los espacios.
		$nombre = filter_var($nombre, FILTER_SANITIZE_STRING); // Esta función nos pèrmite sanear o validar información, en este caso eliminar caracteres que no nos sirven.
		// Comprobamos que el nombre despues de quitar los caracteres ilegales no este vacio.
		if($nombre == ""){
			$errores.= 'Por favor, ingresa un nombre.<br />';
		}
	}else{ // Si no escribe bien el nombre mostraremos la variable errores + el texto indicado. La variable la hemos creado al principio para que aquí pueda ser captada.
		$errores.= 'Por favor, ingresa un nombre.<br />';
	}

	if(!empty($correo)){ // Hacemos lo mismo con correo.
		$correo = filter_var($correo, FILTER_SANITIZE_EMAIL); // Guardamos en la variable correo el resultado de la función filter_var.
		// Comprobamos que sea un correo válido.
		if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) { // Esta función nos devuelve false, si el correo que le pasamos como variable está bien nos devuelve correo, sino false.
			$errores.= "Por favor, ingresa un correo válido.<br />";
		}
	}else{ // Anteriormente comprobamos que el correo introducido era válido, este mensaje es si no ha introducido nada (empty).
		$errores.= 'Por favor, ingresa un correo.<br />';
	}

	if(!empty($mensaje)){
		// Podemos sanear la cadena de texto con filter_var, pero queremos que en el mensaje los signos se conviertan en entidades html, de esta forma evitamos que el usuario pueda inyectar código.
		$mensaje = htmlspecialchars($mensaje);
		$mensaje = trim($mensaje);
		$mensaje = stripslashes($mensaje); // Lo que estamos haciendo el sobreescribir constantemente la variable mensaje con el resultado de aplicar la función.
	}else{
		$errores.= 'Por favor, ingresa el mensaje.<br />';
	}

    // Comprobamos si hay errores, si no hay entonces enviamos.
	if (!$errores) {
		$enviar_a = 'tunombre@tuempresa.com'; // Aquí es donde vamos a recibir los formularios.
		$asunto = 'Correo enviado desde miPagina.com';
		$mensaje_preparado = "De: $nombre \n";
		$mensaje_preparado.= "Correo: $correo \n";
		$mensaje_preparado.= 'Mensaje: '.$mensaje;

		// mail($enviar_a, $asunto, $mensaje); // Nos dará error por el localhost. Función para enviar el email. Esta función con Xampp no funciona porque los archivos hay que subirlos a un hosting para que funciones correctamente.
		$enviado = 'true'; // En html tenemos el if de esta variable enviado.
	}

}

require 'index.view.php'; // Queremos incluir la vista html.

?>