<?php
include('../Models/Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST['rut'];
    $clave = $_POST['clave'];

    if (empty($rut) || empty($clave)) {
        header("Location: ../index.php?error=Complete los campos requeridos");
        exit();
    }

    $sql = "SELECT * FROM Usuario WHERE rut_usuario = ? AND clave_usuario = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $rut, $clave);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['rut_usuario'] = $row['rut_usuario'];
            $_SESSION['id_tipo_usuario'] = $row['id_tipo_usuario'];

            // Verificar si es admin o no
            if ($row['id_tipo_usuario'] == 1) {
                $_SESSION['esAdmin'] = true;
            } else {
                $_SESSION['esAdmin'] = false;
            }

            // Redirigir al usuario a la página de selección de empresa
            header("Location: ../Views/seleccionar_sucursal.php");
            exit();
        } else {
            header("Location: ../index.php?error=Credenciales incorrectas");
            exit();
        }
    } else {
        header("Location: ../index.php?error=Error en la consulta");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
