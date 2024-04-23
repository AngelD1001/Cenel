<?php

include('../Models/ciudadModel.php'); 

class CiudadController {
    private $ciudadModel;

    public function __construct($conexion) {
        $this->ciudadModel = new CiudadModel($conexion);
    }

    public function guardarCiudad($nombre) {
        // Llamar al método del modelo para guardar la ciudad
        $resultado = $this->ciudadModel->guardarCiudad($nombre);
    
        if ($resultado) {
            // Ciudad guardada correctamente
            header("Location: ../Mantenedores/ciudad.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al guardar la ciudad
            echo "Error al guardar la ciudad.";
        }
    }

    public function mostrarCiudades() {
        // Obtener las ciudades del modelo
        $ciudades = $this->ciudadModel->obtenerCiudades();
        
        // Verificar si se obtuvieron correctamente
        if ($ciudades === null) {
            // Manejar el caso donde no se obtuvieron ciudades
            die("No se han obtenido ciudades");
        }

        // Devolver las ciudades
        return $ciudades;
    }

    public function eliminarCiudad($id_ciudad) {
        // Llamar al método del modelo para eliminar la ciudad
        $resultado = $this->ciudadModel->eliminarCiudad($id_ciudad);

        if ($resultado) {
            // Ciudad eliminada correctamente
            return true;
        } else {
            // Error al eliminar la ciudad
            return false;
        }
    }
    public function obtenerCiudadPorId($id_ciudad) {
        $ciudad = $this->ciudadModel->obtenerCiudadPorId($id_ciudad);
        // Verificar si se obtuvieron los datos correctamente
        if ($ciudad) {
            // Si los datos se obtienen correctamente, imprimir un mensaje en pantalla
            echo "Datos de la ciudad obtenidos en el controlador: <pre>" . print_r($ciudad, true) . "</pre>";
        } else {
            // Si no se obtienen los datos correctamente, imprimir un mensaje de error en pantalla
            echo "Error: No se pudieron obtener los datos de la ciudad en el controlador.";
        }
        return $ciudad;
    }
    
    public function actualizarCiudad($id_ciudad, $nombre) {
        return $this->ciudadModel->actualizarCiudad($id_ciudad, $nombre);
    }
}
// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear una instancia del controlador
    $ciudadController = new CiudadController($conexion);

    // Verificar si se recibieron los datos del formulario para actualizar una ciudad
    if (isset($_POST['id_ciudad']) && isset($_POST['nombre_ciudad']) ) {
        // Obtener los datos del formulario
        $id_ciudad = $_POST["id_ciudad"];
        $nombre_ciudad = $_POST["nombre_ciudad"];


        // Llamar al método para actualizar la ciudad
        $resultado = $ciudadController->actualizarCiudad($id_ciudad, $nombre_ciudad);

        if ($resultado) {
            // Ciudad actualizada correctamente
            header("Location: ../Mantenedores/ciudad.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } 
    }

    // Verificar si se solicitó eliminar una ciudad
    if (isset($_POST['eliminar_ciudad'])) {
        // Obtener el ID de la ciudad a eliminar desde la solicitud
        $id_ciudad = $_POST['id_ciudad'];

        // Llamar al método para eliminar la ciudad
        $resultado = $ciudadController->eliminarCiudad($id_ciudad);

        if ($resultado) {
            // Ciudad eliminada correctamente
            header("Location: ../Mantenedores/ciudad.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al eliminar la ciudad
            echo "Error al eliminar la ciudad.";
        }
    }

    // Verificar si se recibieron los datos del formulario para guardar una ciudad
    if (isset($_POST['nombre_ciudad']) ) {
        // Obtener los datos del formulario
        $nombre_ciudad = $_POST["nombre_ciudad"];


        // Llamar al método para guardar la ciudad
        $ciudadController->guardarCiudad($nombre_ciudad);
    }
}

