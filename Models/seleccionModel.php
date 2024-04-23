<?php
include('Conexion.php');


    session_start();
    if (!isset($_SESSION["id_usuario"])) {
        header("Location: ../index.php");
        exit();
    }
    $sql = "SELECT s.id_sucursal, s.nombre_sucursal 
            FROM Asignacion_sucursal asu 
            INNER JOIN Sucursal s ON asu.id_sucursal = s.id_sucursal 
            WHERE asu.id_usuario = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $_SESSION["id_usuario"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $sucursales = array();

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sucursales[] = $row;
            }
        } else {
            $error = "El usuario no tiene sucursales asignadas.";
        }
    } else {
        header("Location: ../index.php?error=Error en la consulta");
        exit();
    }
?>
