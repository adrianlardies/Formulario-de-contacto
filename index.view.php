<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario Contacto</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'> <!-- Agregamos una fuente de google fonts, en este caso Roboto -->
    <link rel="stylesheet" href="estilos.css"> <!-- Para enlazar nuestros estilos css -->
</head>
<body>
    <div class="wrap"> <!-- Creo un contenedor que es donde voy a alojar el formulario -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> <!-- De esta forma redirecciono al usuario a la misma página una vez que se envien los archivos, lo hago para corregir errores por ejemplo y que se mantenga escrito el mensaje que escribió incorrectamente. También para que pueda ver los warning de error al rellenar incorrectamente los campos -->
            <input type="text" class="form-control" id="nombre"name="nombre" placeholder="Nombre:" value="<?php if(!$enviado && isset($nombre)) echo $nombre?>"> <!-- Le añadimos la clase para añadir los estilos, le asigno ese nombre porque es el control de nuestro formulario -->
            <!-- Explicación del if en value: si la variable enviado es false y además la variable nombre esta seteada entonces echo nombre. Esto lo hacemos para que no se borren los campos completados pero el formulario está incompleto y se le ha dado a enviar, para que el usuario no tenga que reescribir todo. -->
            <input type="text" class="form-control" id="correo"name="correo" placeholder="Correo:" value="<?php if(!$enviado && isset($correo)) echo $correo?>"> <!-- El id lo usaremos para trabajar con JavaScript -->

            <textarea name="mensaje" class="form-control" id="mensaje" placeholder="Mensaje:"><?php if(!$enviado && isset($mensaje)) echo $mensaje?></textarea>

            <?php if(!empty($errores)): ?> <!-- Si no está vacío errores entonces mostramos un div con la clase alert y la clase error y mostraremos la variable errores -->
				<div class="alert error" role="alert">
					<?php echo $errores; ?>
				</div>
			<?php elseif($enviado) : ?> <!-- Esta varible $enviado la vamos a estar generando (darle el valor true) cuando el usuario haya rellenado todos los datos correctamente -->
				<div class="alert success" role="alert">
					<?php echo 'Enviado Correctamente'; ?>
				</div>
			<?php endif; ?>

            <input type="submit" name="submit" class="btn btn-primary" value="Enviar Correo"> <!-- El nombre de la clase puede ser botón o el que queramos, añadimos ese nombre porque está relacionado con Bootsrap -->
        </form>
    </div>
</body>
</html>