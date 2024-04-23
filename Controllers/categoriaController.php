<?php

// Incluir los archivos necesarios
include('../Models/categoriaModel.php'); // Ruta a tu modelo

class CategoriaController {
    private $categoriaModel;

    public function __construct($conexion) {
        $this->categoriaModel = new CategoriaModel($conexion);
    }

    public function mostrarCategorias() {
        // Obtener las categorías del modelo
        $categorias = $this->categoriaModel->obtenerCategorias();
        
        // Verificar si se obtuvieron las categorías correctamente
        if ($categorias === null) {
            // Manejar el caso donde no se obtuvieron categorías
            die("No se han obtenido categorías");
        }

        // Devolver las categorías
        return $categorias;
    }

    public function guardarCategoria($nombre_categoria_producto) {
        // Llamar al método del modelo para guardar la categoría
        $resultado = $this->categoriaModel->guardarCategoria($nombre_categoria_producto);
        
        if ($resultado) {
            // Categoría guardada correctamente
            header("Location: ../Mantenedores/categoria.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al guardar la categoría
            echo "Error al guardar la categoría.";
        }
    }

    
    public function eliminarCategoria($id_categoria_producto) {
        // Llamar al método del modelo para eliminar la categoría
        $resultado = $this->categoriaModel->eliminarCategoria($id_categoria_producto);
    
        if ($resultado) {
            // Categoría eliminada correctamente
            return true;
        } else {
            // Error al eliminar la categoría
            return false;
        }
    }
    public function obtenerCategoriaPorId($id_categoria_producto) {
        $categoria = $this->categoriaModel->obtenerCategoriaPorId($id_categoria_producto);
        // Verificar si se obtuvieron los datos correctamente
        if ($categoria) {
            // Si los datos se obtienen correctamente, imprimir un mensaje en pantalla
            echo "Datos de la categoría obtenidos en el controlador: <pre>" . print_r($categoria, true) . "</pre>";
        } else {
            // Si no se obtienen los datos correctamente, imprimir un mensaje de error en pantalla
            echo "Error: No se pudieron obtener los datos de la categoría en el controlador.";
        }
        return $categoria;
    }
    
    public function actualizarCategoria($id_categoria_producto, $nombre) {
        return $this->categoriaModel->actualizarCategoria($id_categoria_producto, $nombre);
    }
    

}
// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear una instancia del controlador
    $categoriaController = new CategoriaController($conexion);

    // Verificar si se recibieron los datos del formulario para actualizar una categoría
    if (isset($_POST['id_categoria_producto']) && isset($_POST['nombre_categoria_producto'])) {
        // Obtener los datos del formulario
        $id_categoria_producto = $_POST["id_categoria_producto"];
        $nombre_categoria_producto = $_POST["nombre_categoria_producto"];

        // Llamar al método para actualizar la categoría
        $resultado = $categoriaController->actualizarCategoria($id_categoria_producto, $nombre_categoria_producto);

        if ($resultado) {
            // Categoría actualizada correctamente
            header("Location: ../Mantenedores/categoria.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } 
    }

    // Verificar si se solicitó eliminar una categoría
    if (isset($_POST['eliminar_categoria'])) {
        // Obtener el ID de la categoría a eliminar desde la solicitud
        $id_categoria_producto = $_POST['id_categoria_producto'];

        // Llamar al método para eliminar la categoría
        $resultado = $categoriaController->eliminarCategoria($id_categoria_producto);

        if ($resultado) {
            // Categoría eliminada correctamente
            header("Location: ../Mantenedores/categoria.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al eliminar la categoría
            echo "Error al eliminar la categoría.";
        }
    }

    // Verificar si se recibieron los datos del formulario para guardar una categoría
    if (isset($_POST['nombre_categoria_producto'])) {
        // Obtener los datos del formulario
        $nombre_categoria_producto = $_POST["nombre_categoria_producto"];

        // Llamar al método para guardar la categoría
        $categoriaController->guardarCategoria($nombre_categoria_producto);
    }
}

// Crear una instancia del controlador y obtener las categorías
$categoriaController = new CategoriaController($conexion);
$categorias = $categoriaController->mostrarCategorias();


?>
