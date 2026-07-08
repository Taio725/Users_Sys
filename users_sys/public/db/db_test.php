<?php

require_once 'credenciales_bd.php';

try {
    $dsn = sprintf("mysql:host=%s;dbname=%s", DB_HOST, DB_NAME);
    echo $dsn;
    $conn = new PDO($dsn, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
    echo "Conexion exitosa.";
} catch (PDOException $e) {
    var_dump($e);
}
