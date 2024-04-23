<?php
$host = "localhost";
$User = "root";
$pass = "1234"; 
$db = "id21813621_pruebacenel_db";

// Crear la conexión a la base de datos
$conexion = mysqli_connect($host, $User , $pass, $db);

// Verificar la conexión
if (!$conexion) {
    echo "Conexión fallida: " . mysqli_connect_error();
}

