<?php

class TipoPagoController {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerTiposPago() {
        // Array asociativo para almacenar los tipos de pago
        $tiposPago = array();

        // Consulta SQL para obtener los tipos de pago desde la base de datos
        $query = "SELECT id_tipo_pago, nombre_tipo_pago FROM tipo_pago";
        $resultado = $this->conexion->query($query);

        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                // Almacenar el tipo de pago en el array asociativo
                $tiposPago[$fila['id_tipo_pago']] = $fila['nombre_tipo_pago'];
            }
        }

        return $tiposPago;
    }
}
?>
