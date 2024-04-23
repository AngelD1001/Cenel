<?php
include('Conexion.php');

class EmpresaModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerEmpresas() {
        $empresas = array();
    
        // Query para seleccionar todas las empresas
        $sql = "SELECT * FROM Empresa";
    
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);
    
        // Verificar si la consulta fue exitosa
        if ($result === false) {
            return null;
        }
    
        // Procesar los resultados de la consulta
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $empresas[] = $row;
            }
        }
    
        // Devolver las empresas obtenidas
        return $empresas;
    }
    // Método para guardar una nueva empresa en la base de datos.
    public function guardarEmpresa($nombre) {
        // Escapar el valor del nombre para evitar inyección SQL
        $nombre = $this->conexion->real_escape_string($nombre);
        
        // Query para insertar la nueva empresa
        $sql = "INSERT INTO empresa (nombre_empresa) VALUES ('$nombre')";
        
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);

        // Verificar si la inserción fue exitosa
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    // Método para eliminar una empresa por su ID.
    public function eliminarEmpresa($id_empresa) {
        $sql = "DELETE FROM empresa WHERE id_empresa = $id_empresa";
        $result = $this->conexion->query($sql);
        return $result !== false;
    }

    // Método para obtener una empresa por su ID.
    public function obtenerEmpresaPorId($id_empresa) {
        $id_empresa = $this->conexion->real_escape_string($id_empresa);
        
        $sql = "SELECT * FROM empresa WHERE id_empresa = $id_empresa";
        $result = $this->conexion->query($sql);

        if ($result === false) {
            return null;
        }

        return $result->fetch_assoc();
    }

    // Método para actualizar una empresa por su ID.
    public function actualizarEmpresa($id_empresa, $nombre) {
        // Verificar que el ID de la empresa no esté vacío
        if (!empty($id_empresa)) {
            // Escapar los valores para evitar la inyección SQL
            $nombre = $this->conexion->real_escape_string($nombre);
            
            // Construir la consulta SQL de actualización
            $sql = "UPDATE empresa SET nombre_empresa = '$nombre' WHERE id_empresa = $id_empresa";
            
            // Ejecutar la consulta SQL de actualización
            $result = $this->conexion->query($sql);

            // Verificar si la consulta se ejecutó correctamente
            if ($result !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            // Manejar el caso donde el ID de la empresa está vacío
            return false;
        }
}

}

