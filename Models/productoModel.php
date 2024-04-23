<?php
include('Conexion.php');

class ProductoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    //Método para buscar productos.
    //Agregando un JOIN para obtener el nombre de la categoria.
    public function obtenerProductos() {
        $productos = array();
    
        $sql = "SELECT p.id_producto, p.nombre_producto, c.nombre_categoria_producto AS nombre_categoria, p.descripcion_producto, dlp.detalle_precio
                FROM Producto p
                INNER JOIN Categoria_Producto c ON p.id_categoria_producto = c.id_categoria_producto
                INNER JOIN Detalle_Lista_Precio dlp ON p.id_producto = dlp.id_producto
                WHERE dlp.id_lista_precios = 6"; // ID de la lista de precios por defecto
    
        $result = $this->conexion->query($sql);
    
        if ($result === false) {
            return null;
        }
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }
    
        return $productos;
    }
    

    // Método para guardar un nuevo producto en la base de datos.
    public function guardarProducto($nombre, $id_categoria, $descripcion) {
        // Escapar los valores para evitar inyección SQL
        $nombre = $this->conexion->real_escape_string($nombre);
        $descripcion = $this->conexion->real_escape_string($descripcion);
        
        // Query para insertar el nuevo producto
        $sql = "INSERT INTO Producto (nombre_producto, id_categoria_producto, descripcion_producto) VALUES ('$nombre', $id_categoria, '$descripcion')";
        
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);

        // Verificar si la inserción fue exitosa
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    // Método para eliminar un producto por su ID.
    public function eliminarProducto($id_producto) {
        $sql = "DELETE FROM Producto WHERE id_producto = $id_producto";
        $result = $this->conexion->query($sql);
        return $result !== false;
    }

    public function obtenerProductoPorId($id_producto) {
        $id_producto = $this->conexion->real_escape_string($id_producto);
        
        $sql = "SELECT * FROM Producto WHERE id_producto = $id_producto";
        $result = $this->conexion->query($sql);

        if ($result === false) {
            return null;
        }

        return $result->fetch_assoc();
    }

    public function actualizarProducto($id_producto, $nombre, $id_categoria, $descripcion) {
        // Verificar que el ID del producto no esté vacío
        if (!empty($id_producto)) {
            // Escapar los valores para evitar la inyección SQL
            $nombre = $this->conexion->real_escape_string($nombre);
            $descripcion = $this->conexion->real_escape_string($descripcion);
            
            // Construir la consulta SQL de actualización
            $sql = "UPDATE Producto SET nombre_producto = '$nombre', id_categoria_producto = $id_categoria, descripcion_producto = '$descripcion' WHERE id_producto = $id_producto";
            
            // Ejecutar la consulta SQL de actualización
            $result = $this->conexion->query($sql);
    
            // Verificar si la consulta se ejecutó correctamente
            if ($result !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            // Manejar el caso donde el ID del producto está vacío
            return false;
        }
    }
    

}
?>
