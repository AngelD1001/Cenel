<?php
// Incluir el archivo de conexión y el modelo de usuario
include('../Models/Conexion.php');
include('../Models/UsuarioModel.php');

// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["rut_usuario"])) {
    header("Location: ../index.php");
    exit();
}

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['empresas'])) {
    // Obtener las empresas seleccionadas por el usuario desde el formulario
    $empresasSeleccionadas = $_POST['empresas'];

    // Establecer la sesión con las empresas seleccionadas
    $_SESSION['empresas_seleccionadas'] = $empresasSeleccionadas;

    // Redirigir a alguna página que muestre las empresas seleccionadas
    header("Location: ../Views/seleccionar_sucursal.php");
    exit();
} else {
    // Si no se recibieron datos válidos, redirigir al usuario a la página anterior
    header("Location: ../index.php.php");
    exit();
}
?>
