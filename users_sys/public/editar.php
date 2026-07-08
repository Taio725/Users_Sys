<?php 
include_once("db/conexion.php"); 

$ci = $_GET['Ci'];
$pagina = $_GET['pag'] ?? 1;

try {
    $sql = "SELECT * FROM usuarios WHERE Ci = :ci";
    //preparar
    $stmt = $conn->prepare($sql);
    //enlazar
    $stmt->bindParam(':ci', $ci);
    //vincular
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        var_dump($e);
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

    <div class="inicio">
        <h2 class="titulo-central">Editar Usuario</h2>

            <form action="editar_motor.php" method="POST" class="formulario-central">
            
                <p>
                    <label>Nombre</label>
                    <input type="text" class="nombre" name="Nombre" 
                    value="<?= htmlspecialchars($usuario['Nombre']) ?>" required>
                </p>

                <p>
                    <label>Cédula</label>
                    <input type="text" name="Ci" class="etiqueta-pri" value="<?= htmlspecialchars($usuario['Ci']) ?>">
                </p>

                <p>
                    <label>Email</label>
                    <input type="email" name="Email" class="etiqueta-pri" value="<?= htmlspecialchars($usuario['Email']) ?>" required>
                </p>

                <p>
                    <label>Dirección</label>
                    <input type="text" name="Direccion" class="etiqueta-pri" value="<?= htmlspecialchars($usuario['Direccion']) ?>">
                </p>

                <p>
                    <label>Teléfono</label>
                    <input type="text" name="Telefono" class="etiqueta-pri" value="<?= htmlspecialchars($usuario['Telefono']) ?>">
                </p>

                <!-- Campos ocultos -->
                <p>
                    <input type="hidden" name="Ci_texto" value="<?= htmlspecialchars($usuario['Ci']) ?>">
                    <input type="hidden" name="pag" value="<?= $pagina ?>">
                </p>

                <p>
                    <button type="submit">Actualizar</button>
                </p>
            
                <p class="botones">
                    <button>
                        <a href="index.php" class="inicio">Inicio</a>
                    </button>
                </p>
                
            </form>
    </div>

</body>