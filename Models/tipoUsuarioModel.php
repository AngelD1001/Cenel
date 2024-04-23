<?php
include('Conexion.php');

class TipoUsuarioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerTiposUsuario() {
        $tiposUsuario = array();
    
        // Query para seleccionar todos los tipos de usuario
        $sql = "SELECT * FROM Tipo_Usuario";
    
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);
    
        // Verificar si la consulta fue exitosa
        if ($result === false) {
            return null;
        }
    
        // Procesar los resultados de la consulta
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tiposUsuario[] = $row;
            }
        }
    
        // Devolver los tipos de usuario obtenidos
        return $tiposUsuario;
    }

        // Método para guardar un nuevo tipo de usuario en la base de datos.
    public function guardarTipoUsuario($nombreTipoUsuario) {
        // Escapar el valor del nombre para evitar inyección SQL
        $nombreTipoUsuario = $this->conexion->real_escape_string($nombreTipoUsuario);
        
        // Query para insertar el nuevo tipo de usuario
        $sql = "INSERT INTO Tipo_Usuario (nombre_tipo_usuario) VALUES ('$nombreTipoUsuario')";
        
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);

        // Verificar si la inserción fue exitosa
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    // Método para eliminar un tipo de usuario por su ID.
    public function eliminarTipoUsuario($id_tipo_usuario) {
        $sql = "DELETE FROM Tipo_Usuario WHERE id_tipo_usuario = $id_tipo_usuario";
        $result = $this->conexion->query($sql);
        return $result !== false;
    }

    // Método para obtener un tipo de usuario por su ID.
    public function obtenerTipoUsuarioPorId($id_tipo_usuario) {
        $id_tipo_usuario = $this->conexion->real_escape_string($id_tipo_usuario);
        
        $sql = "SELECT * FROM Tipo_Usuario WHERE id_tipo_usuario = $id_tipo_usuario";
        $result = $this->conexion->query($sql);

        if ($result === false) {
            return null;
        }

        return $result->fetch_assoc();
    }
    
    public function actualizarTipoUsuario($id_tipo_usuario, $nombreTipoUsuario) {
        // Verificar que el ID del tipo de usuario no esté vacío
        if (!empty($id_tipo_usuario)) {
            // Escapar los valores para evitar la inyección SQL
            $nombreTipoUsuario = $this->conexion->real_escape_string($nombreTipoUsuario);
            
            // Construir la consulta SQL de actualización
            $sql = "UPDATE Tipo_Usuario SET nombre_tipo_usuario = '$nombreTipoUsuario' WHERE id_tipo_usuario = $id_tipo_usuario";
            
            // Ejecutar la consulta SQL de actualización
            $result = $this->conexion->query($sql);
    
            // Verificar si la consulta se ejecutó correctamente
            if ($result !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            // Manejar el caso donde el ID del tipo de usuario está vacío
            return false;
        }
    }
    
}
