<?php
include('Conexion.php');

class CategoriaModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerCategorias() {
        $categorias = array();
    
        // Query para seleccionar todas las categorías
        $sql = "SELECT * FROM Categoria_Producto";
    
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);
    
        // Verificar si la consulta fue exitosa
        if ($result === false) {
            return null;
        }
    
        // Procesar los resultados de la consulta
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categorias[] = $row;
            }
        }
    
        // Devolver las categorías obtenidas
        return $categorias;
    }
    
    // Método para guardar una nueva categoría en la base de datos.
    public function guardarCategoria($nombre_categoria_producto) {
        // Escapar el valor del nombre para evitar inyección SQL
        $nombre_categoria_producto = $this->conexion->real_escape_string($nombre_categoria_producto);
        
        // Query para insertar la nueva categoría
        $sql = "INSERT INTO Categoria_Producto (nombre_categoria_producto) VALUES ('$nombre_categoria_producto')";
        
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);

        // Verificar si la inserción fue exitosa
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }
    // Método para eliminar una categoría por su ID.
    public function eliminarCategoria($id_categoria_producto) {
        $sql = "DELETE FROM Categoria_Producto WHERE id_categoria_producto = $id_categoria_producto";
        $result = $this->conexion->query($sql);
        return $result !== false;
    }

    // Método para obtener una categoría por su ID.
    public function obtenerCategoriaPorId($id_categoria_producto) {
        $id_categoria_producto = $this->conexion->real_escape_string($id_categoria_producto);
        
        $sql = "SELECT * FROM Categoria_Producto WHERE id_categoria_producto = $id_categoria_producto";
        $result = $this->conexion->query($sql);

        if ($result === false) {
            return null;
        }

        return $result->fetch_assoc();
    }
    
    public function actualizarCategoria($id_categoria_producto, $nombre_categoria_producto) {
        // Verificar que el ID de la categoría no esté vacío
        if (!empty($id_categoria_producto)) {
            // Escapar los valores para evitar la inyección SQL
            $nombre_categoria_producto = $this->conexion->real_escape_string($nombre_categoria_producto);
            
            // Construir la consulta SQL de actualización
            $sql = "UPDATE Categoria_Producto SET nombre_categoria_producto = '$nombre_categoria_producto' WHERE id_categoria_producto = $id_categoria_producto";
            
            // Ejecutar la consulta SQL de actualización
            $result = $this->conexion->query($sql);
    
            // Verificar si la consulta se ejecutó correctamente
            if ($result !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            // Manejar el caso donde el ID de la categoría está vacío
            return false;
        }
    }
    
}


?>
