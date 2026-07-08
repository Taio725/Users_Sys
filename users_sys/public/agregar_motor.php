<?php
include_once("db/conexion.php"); 

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $nombre    = trim($_POST["nombre"]);

    $cedula    = trim($_POST["ci"]);

    $direccion = trim($_POST["direccion"]);

    $telefono  = trim($_POST["telefono"]);

    $correo    = trim($_POST["correo"]);

    $ci_texto  = trim($_POST["Ci_texto"]);

    //array para capturar errores
    $errores = [];

    /*Validaciones*/
    if (empty($nombre) || strlen($nombre) < 3) {
        $errores[] = "El nombre es obligatorio y debe tener al menos 3 caracteres.";
    } 

    if (!ctype_alpha($nombre)){
        $errores[] = "Solo son validos caracteres no numericos";
    }

    if (!is_numeric($cedula)) {
        $errores[] = "La cédula debe contener solo números.";
    }

    $regex_caracteres = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 -]+$/";

    if (!preg_match($regex_caracteres, $direccion)) {
        $errores[] = "La direccion no es valida";
    }

     // Usuario debe ser un correo valido
    $regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (!preg_match($regex_email, $correo)) {
        $errores[] = "Sintaxis de correo incorrecta.";
    }

    if (empty($telefono) || !is_numeric($telefono)) {
        $errores[] = "El teléfono es obligatorio y debe ser numérico.";
    }

    if (!empty($errores)) {
        foreach($errores as $error) {
            var_dump($errores);
            echo "<li>$error</li>";
            echo '<a href="agregar.php">Volver al formulario</a>';
        }
        die();


    }

    try {
        $stmt = $conn->prepare("INSERT INTO usuarios 
                    (nombre, ci, direccion, telefono, email, Ci_texto)
            VALUES  (:nombre, :ci, :direccion, :telefono, :correo, :ci_texto)
        ");

        $stmt->bindParam(':nombre', $nombre,PDO::PARAM_STR);

        $stmt->bindParam(':ci', $cedula,PDO::PARAM_INT);

        $stmt->bindParam(':direccion', $direccion,PDO::PARAM_STR);

        $stmt->bindParam(':correo', $correo,PDO::PARAM_STR);

        $stmt->bindParam(':telefono', $telefono,PDO::PARAM_INT);

        $stmt->bindParam(':ci_texto', $cedula,PDO::PARAM_STR);

        $stmt->execute();

        echo "<script>window.location='index.php?pag=1';</script>";

    } catch (PDOException $e) {

        if ($e->getCode() == 23000) { 
            var_dump($e);
            
        } else {
            echo "<script>alert('Error: ".$e->getMessage()."');</script>";
        } 
    }
}