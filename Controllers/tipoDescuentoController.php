<?php

class TipoDescuentoController {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerTiposDescuento() {
        // Array asociativo para almacenar los tipos de pago
        $tiposDescuento = array();

        // Consulta SQL para obtener los tipos de pago desde la base de datos
        $query = "SELECT id_tipo_descuento, nombre_tipo_descuento FROM tipo_descuento";
        $resultado = $this->conexion->query($query);

        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                // Almacenar el tipo de pago en el array asociativo
                $tiposDescuento[$fila['id_tipo_descuento']] = $fila['nombre_tipo_descuento'];
            }
        }

        return $tiposDescuento;
    }
}
?>
