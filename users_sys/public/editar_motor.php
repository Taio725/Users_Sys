<?php
include_once("db/conexion.php");


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $nombre = $_POST["Nombre"];

    $cedula = $_POST["Ci"];

    $correo   = $_POST["Email"];

    $direccion = $_POST["Direccion"];

    $telefono = $_POST["Telefono"];

    $pagina = $_POST['pag'];

    $ci = $_POST['Ci'];


    //validaciones 

    //array para capturar errores
    $errores = [];

    /*Validaciones*/
    if (empty($nombre) || strlen($nombre) < 3) {
        $errores[] = "El nombre es obligatorio y debe tener al menos 3 caracteres.";
    } 

    if (!ctype_alpha($nombre)){
        $errores = ["Solo son validos caracteres no numericos"];
    }

    if (!is_numeric($cedula)) {
        $errores[] = "La cédula debe contener solo números.";
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del correo electrónico no es válido.";
    }

    if (empty($telefono) || !is_numeric($telefono)) {
        $errores[] = "El teléfono es obligatorio y debe ser numérico.";
    }

    if (!empty($errores)) {
        foreach($errores as $error) {
            echo "<li>$error</li>";
            echo '<a href="editar.php">Volver al formulario</a>';
        }
        die();
    }

    try {
        $sql_input = "UPDATE usuarios
            SET Nombre    = :nombre,
                Ci        = :ci,
                Email     = :email,
                Direccion = :direccion,
                Telefono  = :telefono
            WHERE Ci      = :ci";
        
        $stmt = $conn->prepare($sql_input);

        $stmt->bindParam(':nombre', $nombre);

        $stmt->bindParam(':ci', $cedula);

        $stmt->bindParam(':email', $correo);

        $stmt->bindParam(':direccion', $direccion);

        $stmt->bindParam(':telefono', $telefono);

        $stmt->bindParam(':ci_texto', $cedula,PDO::PARAM_STR);

           // Executar
        if ($stmt->execute()) {
            $registros_actualizados = $stmt->rowCount();

            if ($registros_actualizados) {
                echo "$registros_actualizados registro(s) actualizado(s).";
            } else {
                echo "No se enviaron datos, no hubieron registros actualizados.";
            }
            
            echo "<p><a href='editar.php?Ci=$ci&pag=$pagina'>Volver a la lista de Usuarios</a></p>";
        } else {
            echo "Ocurrio un error.";
        }
    } catch (PDOException $e) {
        var_dump($e);
    }
} else {
    echo "Este archivo no se puede accesar de manera automatica.";
}