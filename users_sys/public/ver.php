<?php
include_once("db/conexion.php");

$ci = $_GET['Ci'];

try {

    // Query para traer solo 1 usuario
        $sql_query = "SELECT
            Nombre,
            Ci,
            Direccion,
            Email,
            Telefono
        FROM usuarios
        WHERE Ci = :ci
        LIMIT 1";

    // Preparar
        $stmt = $conn->prepare($sql_query);

    // Vincular
        $stmt->bindValue(':ci', $ci, PDO::PARAM_INT);

    // Ejecutar
        $stmt->execute();

    // Extraer solo 1 usuario
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        die("Usuario no encontrado.");
    }

} catch(PDOException $k) {
    var_dump($k);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizacion</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    
<table border="1" align="center">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ci</th>
            <th>Direccion</th>
            <th>Email</th>
            <th>Telefono</th>
        </tr>
    </thead>

    <tbody>
        
            <tr align="center">
                <td><?= $usuario['Nombre']; ?></td>
                <td><?= $usuario['Ci']; ?></td>
                <td><?= $usuario['Direccion']; ?></td>
                <td><?= $usuario['Email']; ?></td>
                <td><?= $usuario['Telefono']; ?></td>
            </tr>
</table>

<a class="etiqueta"  href="index.php" class="inicio">Inicio</a>
    

</body>