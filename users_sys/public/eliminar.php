<?php
include_once("db/conexion.php"); 

$pagina = $_GET['pag'];
$cedula = $_GET['Ci'];

try {
    // Preparar la consulta
    $sql = "DELETE FROM usuarios WHERE Ci = :ci";
    $stmt = $conn->prepare($sql);

    // Vincular parámetro
    $stmt->bindParam(':ci', $cedula, PDO::PARAM_INT);

    // Ejecutar
    if ($stmt->execute()) {
        // Redirigir
        header("Location: index.php?pag=$pagina");
        exit;
    } else {
        echo "Ocurrió un error al eliminar el usuario.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}   