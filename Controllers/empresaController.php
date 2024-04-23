<?php

include('../Models/empresaModel.php'); 

class EmpresaController {
    private $empresaModel;

    public function __construct($conexion) {
        $this->empresaModel = new EmpresaModel($conexion);
    }

    public function mostrarEmpresas() {
        // Obtener las empresas del modelo
        $empresas = $this->empresaModel->obtenerEmpresas();
        
        // Verificar si se obtuvieron las empresas correctamente
        if ($empresas === null) {
            // Manejar el caso donde no se obtuvieron empresas
            die("No se han obtenido empresas");
        }

        // Devolver las empresas
        return $empresas;
    }

    public function guardarEmpresa($nombre) {
        // Llamar al método del modelo para guardar la empresa
        $resultado = $this->empresaModel->guardarEmpresa($nombre);
        
        if ($resultado) {
            // Empresa guardada correctamente
            header("Location: ../Mantenedores/empresa.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al guardar la empresa
            echo "Error al guardar la empresa.";
        }
    }
    
    public function eliminarEmpresa($id_empresa) {
        // Llamar al método del modelo para eliminar la empresa
        $resultado = $this->empresaModel->eliminarEmpresa($id_empresa);
    
        if ($resultado) {
            // Empresa eliminada correctamente
            return true;
        } else {
            // Error al eliminar la empresa
            return false;
        }
    }
    public function obtenerEmpresaPorId($id_empresa) {
        $empresa = $this->empresaModel->obtenerEmpresaPorId($id_empresa);
        // Verificar si se obtuvieron los datos correctamente
        if ($empresa) {
            // Si los datos se obtienen correctamente, imprimir un mensaje en pantalla
            echo "Datos de la empresa obtenidos en el controlador: <pre>" . print_r($empresa, true) . "</pre>";
        } else {
            // Si no se obtienen los datos correctamente, imprimir un mensaje de error en pantalla
            echo "Error: No se pudieron obtener los datos de la empresa en el controlador.";
        }
        return $empresa;
    }
    
    public function actualizarEmpresa($id_empresa, $nombre) {
        return $this->empresaModel->actualizarEmpresa($id_empresa, $nombre);
    }
    
}

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear una instancia del controlador
    $empresaController = new EmpresaController($conexion);

    // Verificar si se recibieron los datos del formulario para actualizar una empresa
    if (isset($_POST['id_empresa']) && isset($_POST['nombre_empresa'])) {
        // Obtener los datos del formulario
        $id_empresa = $_POST["id_empresa"];
        $nombre_empresa = $_POST["nombre_empresa"];

        // Llamar al método para actualizar la empresa
        $resultado = $empresaController->actualizarEmpresa($id_empresa, $nombre_empresa);

        if ($resultado) {
            // Empresa actualizada correctamente
            header("Location: ../Mantenedores/empresa.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al actualizar la empresa
            echo "Error al actualizar la empresa.";
        }
    }

    // Verificar si se solicitó eliminar una empresa
    if (isset($_POST['eliminar_empresa'])) {
        // Obtener el ID de la empresa a eliminar desde la solicitud
        $id_empresa = $_POST['id_empresa'];

        // Llamar al método para eliminar la empresa
        $resultado = $empresaController->eliminarEmpresa($id_empresa);

        if ($resultado) {
            // Empresa eliminada correctamente
            header("Location: ../Mantenedores/empresa.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al eliminar la empresa
            echo "Error al eliminar la empresa.";
        }
    }

    // Verificar si se recibieron los datos del formulario para guardar una empresa
    if (isset($_POST['nombre_empresa'])) {
        // Obtener los datos del formulario
        $nombre_empresa = $_POST["nombre_empresa"];

        // Llamar al método para guardar la empresa
        $empresaController->guardarEmpresa($nombre_empresa);
    }
}
// Crear una instancia del controlador y obtener las categorías
$empresaController = new EmpresaController($conexion);
$empresas = $empresaController->mostrarEmpresas();