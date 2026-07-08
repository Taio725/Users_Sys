<?php
include_once("db/conexion.php"); 
?>
<html>
<head>    
    <title>USER-SYS</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" href="logo.png">
</head>
<body>

<?php

$filasmax = 5;

// archivo1.txt
// archivo2.txt
// archivo3.txt
// archivo4.txt
// archivo5.txt
// data.txt
// bin.txt

// archivo*.txt

// %

    // Determinar la página actual
    $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;

    // Búsqueda o listado paginado
    if (isset($_POST['btnbuscar']) && !empty($_POST['buscar'])) {

        $ci_texto = $buscar = $_POST['buscar'];

        $ci_comodin = $ci_texto . '%';
        
        // Consulta segura con PDO
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Ci_texto LIKE :ci");
        $stmt->bindParam(':ci', $ci_comodin, PDO::PARAM_STR);
        $stmt->execute();

        $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $maxusutabla = count($sql);

    } else {
    // Paginación
        $filas = ($pagina - 1) * $filasmax;

        $stmt = $conn->prepare("SELECT * FROM usuarios ORDER BY nombre ASC LIMIT :filas, :filasmax");
        $stmt->bindValue(':filas', $filas, PDO::PARAM_INT);
        $stmt->bindValue(':filasmax', $filasmax, PDO::PARAM_INT);
        $stmt->execute();

        $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $maxusutabla = count($sql);
    }

    // Contar total de usuarios
    $stmtTotal = $conn->query("SELECT COUNT(*) as num_usuarios FROM usuarios");
    //$maxusutabla = $stmtTotal->fetch(PDO::FETCH_ASSOC)['num_usuarios'];
    ?>

<!--- --------------->

<div class="inicio">
        <form method="POST">
            <h1>Lista de usuarios</h1>

            <a href="index.php" class="etiqueta" >Inicio</a>
            <a href="agregar.php?pag=<?php echo $pagina; ?>" class="etiqueta" >Crear usuario</a>

            <input type="text" name="buscar" placeholder="Ingresar Ci de usuario" style='width:20%'>
            <input type="submit" value="Buscar" name="btnbuscar" class="buscar">
        </form>

    <table>
        <tr>
            <th>Nombre</th>
            <th>CI</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Acción</th>
        </tr>

        <?php foreach ($sql as $mostrar): ?>
            <tr>
                <td><?php echo htmlspecialchars($mostrar['Nombre']); ?></td>
                <td><?php echo htmlspecialchars($mostrar['Ci']); ?></td>
                <td><?php echo htmlspecialchars($mostrar['Direccion']); ?></td>
                <td><?php echo htmlspecialchars($mostrar['Telefono']); ?></td>
                <td><?php echo htmlspecialchars($mostrar['Email']); ?></td>
                <td style='width:30%'>
                    <a class="etiqueta" href="ver.php?Ci=<?php echo $mostrar['Ci']; ?>&pag=<?php echo $pagina; ?>">Ver</a>
                    <a class="etiqueta" href="editar.php?Ci=<?php echo $mostrar['Ci']; ?>&pag=<?php echo $pagina; ?>">Modificar</a>
                    <a class="etiqueta" href="eliminar.php?Ci=<?php echo $mostrar['Ci']; ?>&pag=<?php echo $pagina; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div style='text-align:right'>
        <br>
        <?php echo "Total de usuarios: ".$maxusutabla; ?>
    </div>
</div>
</body>
</html>
