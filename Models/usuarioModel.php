<?php
include('Conexion.php');

class UsuarioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    //Método para buscar Usuarios.
    //Agregando un JOIN para obtener el nombre de tipo de user.
    public function obtenerUsuarios() {
        $usuarios = array();

        $sql = "SELECT u.id_usuario, u.nombre_usuario, u.apellido_usuario, u.rut_usuario, u.email_usuario, u.clave_usuario, tu.nombre_tipo_usuario 
        FROM Usuario u
        INNER JOIN Tipo_Usuario tu ON u.id_tipo_usuario = tu.id_tipo_usuario";

        $result = $this->conexion->query($sql);

        if ($result === false) {
            return null;
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }

        return $usuarios;
    }

    // Método para guardar un nuevo usuario en la base de datos.
    public function guardarUsuario($nombre, $apellido, $rut, $email, $clave, $id_tipo_usuario) {
        // Escapar los valores para evitar inyección SQL
        $nombre = $this->conexion->real_escape_string($nombre);
        $apellido = $this->conexion->real_escape_string($apellido);
        $rut = $this->conexion->real_escape_string($rut);
        $email = $this->conexion->real_escape_string($email);
        $clave = $this->conexion->real_escape_string($clave);
        
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO Usuario (nombre_usuario, apellido_usuario, rut_usuario, email_usuario, clave_usuario, id_tipo_usuario) VALUES ('$nombre', '$apellido', '$rut', '$email', '$clave', $id_tipo_usuario)";
        
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);

        // Verificar si la inserción fue exitosa
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }
    // Método para eliminar un usuario por su ID.
    public function eliminarUsuario($id_usuario) {
        $sql = "DELETE FROM Usuario WHERE id_usuario = $id_usuario";
        $result = $this->conexion->query($sql);
        return $result !== false;
    }

    // Método para obtener un usuario por su ID.
    public function obtenerUsuarioPorId($id_usuario) {
        $id_usuario = $this->conexion->real_escape_string($id_usuario);
        
        $sql = "SELECT * FROM Usuario WHERE id_usuario = $id_usuario";
        $result = $this->conexion->query($sql);

        if ($result === false) {
            return null;
        }

        return $result->fetch_assoc();
    }
    public function actualizarUsuario($id_usuario, $nombre, $apellido, $rut, $email, $clave, $id_tipo_usuario) {
        // Verificar que el ID del usuario no esté vacío
        if (!empty($id_usuario)) {
            // Escapar los valores para evitar la inyección SQL
            $nombre = $this->conexion->real_escape_string($nombre);
            $apellido = $this->conexion->real_escape_string($apellido);
            $rut = $this->conexion->real_escape_string($rut);
            $email = $this->conexion->real_escape_string($email);
            $clave = $this->conexion->real_escape_string($clave);
            
            // Construir la consulta SQL de actualización
            $sql = "UPDATE Usuario SET nombre_usuario = '$nombre', apellido_usuario = '$apellido', rut_usuario = '$rut', email_usuario = '$email', clave_usuario = '$clave', id_tipo_usuario = $id_tipo_usuario WHERE id_usuario = $id_usuario";
            
            // Ejecutar la consulta SQL de actualización
            $result = $this->conexion->query($sql);
    
            // Verificar si la consulta se ejecutó correctamente
            if ($result !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            // Manejar el caso donde el ID del usuario está vacío
            return false;
        }
    }
    
    public function actualizarUsuarioSinClave($id_usuario, $nombre, $apellido, $rut, $email, $id_tipo_usuario) {
        // Verificar que el ID del usuario no esté vacío
        if (!empty($id_usuario)) {
            // Escapar los valores para evitar la inyección SQL
            $nombre = $this->conexion->real_escape_string($nombre);
            $apellido = $this->conexion->real_escape_string($apellido);
            $rut = $this->conexion->real_escape_string($rut);
            $email = $this->conexion->real_escape_string($email);
            
            // Construir la consulta SQL de actualización sin la contraseña
            $sql = "UPDATE Usuario SET nombre_usuario = '$nombre', apellido_usuario = '$apellido', rut_usuario = '$rut', email_usuario = '$email', id_tipo_usuario = $id_tipo_usuario WHERE id_usuario = $id_usuario";
            
            // Ejecutar la consulta SQL de actualización
            $result = $this->conexion->query($sql);
    
            // Verificar si la consulta se ejecutó correctamente
            if ($result !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            // Manejar el caso donde el ID del usuario está vacío
            return false;
        }
    }
    
}
?>