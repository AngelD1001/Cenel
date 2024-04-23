<?php

include('../Models/productoModel.php'); 

class ProductoController {
    private $conexion;
    private $productoModel;

    public function __construct($conexion) {
        $this->conexion = $conexion;
        $this->productoModel = new ProductoModel($conexion);
    }
    public function guardarProducto($nombre, $id_categoria, $descripcion) {
        // Llamar al método del modelo para guardar el producto
        $resultado = $this->productoModel->guardarProducto($nombre, $id_categoria, $descripcion);
    
        if ($resultado) {
            // Producto guardado correctamente
            header("Location: ../Mantenedores/producto.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al guardar el producto
            echo "Error al guardar el producto.";
        }
    }

    public function mostrarProductos() {
        // Obtener los productos del modelo
        $productos = $this->productoModel->obtenerProductos();
        
        // Verificar si se obtuvieron correctamente
        if ($productos === null) {
            // Manejar el caso donde no se obtuvieron 
            die("No se han obtenido categorías");
        }

        // Devolver los productos
        return $productos;
    }

    public function eliminarProducto($id_producto) {
        // Llamar al método del modelo para eliminar el producto
        $resultado = $this->productoModel->eliminarProducto($id_producto);

        if ($resultado) {
            // Producto eliminado correctamente
            return true;
        } else {
            // Error al eliminar el producto
            return false;
        }
    }

    public function obtenerProductoPorId($id_producto) {
        $producto = $this->productoModel->obtenerProductoPorId($id_producto);
        // Verificar si se obtuvieron los datos correctamente
        if ($producto) {
            // Si los datos se obtienen correctamente, imprimir un mensaje en pantalla
            echo "Datos del producto obtenidos en el controlador: <pre>" . print_r($producto, true) . "</pre>";
        } else {
            // Si no se obtienen los datos correctamente, imprimir un mensaje de error en pantalla
            echo "Error: No se pudieron obtener los datos del producto en el controlador.";
        }
        return $producto;
    }
    
    public function actualizarProducto($id_producto, $nombre, $id_categoria, $descripcion) {
        return $this->productoModel->actualizarProducto($id_producto, $nombre, $id_categoria, $descripcion);
    }

    public function mostrarProductosConPrecio() {
        $productos = array();

        $sql = "SELECT p.id_producto, p.nombre_producto, c.nombre_categoria_producto AS nombre_categoria, p.descripcion_producto, dlp.detalle_precio
                FROM Producto p
                INNER JOIN Categoria_Producto c ON p.id_categoria_producto = c.id_categoria_producto
                INNER JOIN Detalle_Lista_Precio dlp ON p.id_producto = dlp.id_producto
                WHERE dlp.id_lista_precios = 6";

        $resultado = $this->conexion->query($sql);

        if ($resultado === false) {
            return null;
        }

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $productos[] = $row;
            }
        }

        return $productos;
    }

}



// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear una instancia del controlador
    $productoController = new ProductoController($conexion);

    // Verificar si se recibieron los datos del formulario para actualizar un producto
    if (isset($_POST['id_producto']) && isset($_POST['nombre']) && isset($_POST['categoria']) && isset($_POST['descripcion'])) {
        // Obtener los datos del formulario
        $id_producto = $_POST["id_producto"];
        $nombre = $_POST["nombre"];
        $id_categoria = $_POST["categoria"];
        $descripcion = $_POST["descripcion"];

        // Llamar al método para actualizar el producto
        $resultado = $productoController->actualizarProducto($id_producto, $nombre, $id_categoria, $descripcion);

        if ($resultado) {
            // Producto actualizado correctamente
            header("Location: ../Mantenedores/producto.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } 
    }

    // Verificar si se solicitó eliminar un producto
    if (isset($_POST['eliminar_producto'])) {
        // Obtener el ID del producto a eliminar desde la solicitud
        $id_producto = $_POST['id_producto'];

        // Llamar al método para eliminar el producto
        $resultado = $productoController->eliminarProducto($id_producto);

        if ($resultado) {
            // Producto eliminado correctamente
            header("Location: ../Mantenedores/producto.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al eliminar el producto
            echo "Error al eliminar el producto.";
        }
    }

    // Verificar si se recibieron los datos del formulario para guardar un producto
    if (isset($_POST['nombre']) && isset($_POST['categoria']) && isset($_POST['descripcion'])) {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $id_categoria = $_POST["categoria"];
        $descripcion = $_POST["descripcion"];

        // Llamar al método para guardar el producto
        $productoController->guardarProducto($nombre, $id_categoria, $descripcion);
    }
}
?>
