<?php 
include_once("db/conexion.php"); 

$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Nuevo Usuario</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1 class="titulo-central">Insertar Nuevo Usuario</h1>

        <form action="agregar_motor.php" method="post" class="formulario-central">
            <p>
                <label for="Nombre" class="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre">
            </p>

            <p>
                <label for="Cedula" class="ci">Ci:</label>
                <input type="number" name="ci" id="ci">
            </p>

            <p>
                <label for="Direccion" class="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion">
            </p>

            <p>
                <label for="telefono" class="telefono">Telefono</label>
                <input type="number" name="telefono" id="telefono" >
            </p>

            <p>
                <label for="Correo" class="Correo">Correo</label>
                <input type="email" name="correo" id="correo" >
            </p>

            <p>
                <input type="hidden" name="Ci_texto" id="Ci_texto" value="">
            </p>

            <p class="botones">
                <button type="submit" name="registrar"
                    class="form-envio" onclick="return confirm('¿Deseas registrar a este usuario?');">
                    Registrar
                </button>
            </p>

            <p class="botones">
                <button>
                    <a href="index.php" class="inicio">Inicio</a>
                </button>
            </p>
    </form>
    
</body>
</html>

