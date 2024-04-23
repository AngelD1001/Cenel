<?php
include('Conexion.php');

class CiudadModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerCiudades() {
        $ciudades = array();
    
        // Query para seleccionar todas las ciudades
        $sql = "SELECT * FROM Ciudad";
    
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);
    
        // Verificar si la consulta fue exitosa
        if ($result === false) {
            return null;
        }
    
        // Procesar los resultados de la consulta
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ciudades[] = $row;
            }
        }
    
        // Devolver las ciudades obtenidas
        return $ciudades;
    }

    // Método para guardar una nueva ciudad en la base de datos.
    public function guardarCiudad($nombre) {
    // Escapar el valor del nombre para evitar inyección SQL
        $nombre = $this->conexion->real_escape_string($nombre);
        
        // Query para insertar la nueva ciudad
        $sql = "INSERT INTO Ciudad (nombre_ciudad) VALUES ('$nombre')";
        
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);

        // Verificar si la inserción fue exitosa
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

        // Método para eliminar una ciudad por su ID.
    public function eliminarCiudad($id_ciudad) {
        $sql = "DELETE FROM Ciudad WHERE id_ciudad = $id_ciudad";
        $result = $this->conexion->query($sql);
        return $result !== false;
    }

    // Método para obtener una ciudad por su ID.
    public function obtenerCiudadPorId($id_ciudad) {
        $id_ciudad = $this->conexion->real_escape_string($id_ciudad);
        
        $sql = "SELECT * FROM Ciudad WHERE id_ciudad = $id_ciudad";
        $result = $this->conexion->query($sql);

        if ($result === false) {
            return null;
        }

        return $result->fetch_assoc();
    }
    public function actualizarCiudad($id_ciudad, $nombre_ciudad) {
        // Verificar que el ID de la ciudad no esté vacío
        if (!empty($id_ciudad)) {
            // Escapar los valores para evitar la inyección SQL
            $nombre_ciudad = $this->conexion->real_escape_string($nombre_ciudad);
            
            // Construir la consulta SQL de actualización
            $sql = "UPDATE Ciudad SET nombre_ciudad = '$nombre_ciudad' WHERE id_ciudad = $id_ciudad";
            
            // Ejecutar la consulta SQL de actualización
            $result = $this->conexion->query($sql);
    
            // Verificar si la consulta se ejecutó correctamente
            if ($result !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            // Manejar el caso donde el ID de la ciudad está vacío
            return false;
        }
    }
    

}
?>
