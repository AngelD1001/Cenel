<?php
// Incluir los archivos necesarios
include('../Models/tipoUsuarioModel.php'); // Ruta a tu modelo

class TipoUsuarioController {
    private $tipoUsuarioModel;

    public function __construct($conexion) {
        $this->tipoUsuarioModel = new TipoUsuarioModel($conexion);
    }

    public function mostrarTiposUsuario() {
        // Obtener los tipos de usuario del modelo
        $tiposUsuario = $this->tipoUsuarioModel->obtenerTiposUsuario();
        
        // Verificar si se obtuvieron los tipos de usuario correctamente
        if ($tiposUsuario === null) {
            // Manejar el caso donde no se obtuvieron tipos de usuario
            die("No se han obtenido tipos de usuario");
        }

        // Devolver los tipos de usuario
        return $tiposUsuario;
    }

    public function guardarTipoUsuario($nombreTipoUsuario) {
        // Llamar al método del modelo para guardar el tipo de usuario
        $resultado = $this->tipoUsuarioModel->guardarTipoUsuario($nombreTipoUsuario);
        
        if ($resultado) {
            // Tipo de usuario guardado correctamente
            header("Location: ../Mantenedores/tipoUser.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al guardar el tipo de usuario
            echo "Error al guardar el tipo de usuario.";
        }
    }

    public function eliminarTipoUsuario($id_tipo_usuario) {
        // Llamar al método del modelo para eliminar el tipo de usuario
        $resultado = $this->tipoUsuarioModel->eliminarTipoUsuario($id_tipo_usuario);
    
        if ($resultado) {
            // Tipo de usuario eliminado correctamente
            return true;
        } else {
            // Error al eliminar el tipo de usuario
            return false;
        }
    }
    
    public function obtenerTipoUsuarioPorId($id_tipo_usuario) {
        $tipoUsuario = $this->tipoUsuarioModel->obtenerTipoUsuarioPorId($id_tipo_usuario);
        // Verificar si se obtuvieron los datos correctamente
        if ($tipoUsuario) {
            // Si los datos se obtienen correctamente, imprimir un mensaje en pantalla
            echo "Datos del tipo de usuario obtenidos en el controlador: <pre>" . print_r($tipoUsuario, true) . "</pre>";
        } else {
            // Si no se obtienen los datos correctamente, imprimir un mensaje de error en pantalla
            echo "Error: No se pudieron obtener los datos del tipo de usuario en el controlador.";
        }
        return $tipoUsuario;
    }
    
    public function actualizarTipoUsuario($id_tipo_usuario, $nombre) {
        return $this->tipoUsuarioModel->actualizarTipoUsuario($id_tipo_usuario, $nombre);
    }
    
    
}
// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear una instancia del controlador
    $tipoUsuarioController = new TipoUsuarioController($conexion);

    // Verificar si se recibieron los datos del formulario para actualizar un tipo de usuario
    if (isset($_POST['id_tipo_usuario']) && isset($_POST['nombre'])) {
        // Obtener los datos del formulario
        $id_tipo_usuario = $_POST["id_tipo_usuario"];
        $nombre_tipousuario = $_POST["nombre"];

        // Llamar al método para actualizar el tipo de usuario
        $resultado = $tipoUsuarioController->actualizarTipoUsuario($id_tipo_usuario, $nombre);

        if ($resultado) {
            // Tipo de usuario actualizado correctamente
            header("Location: ../Mantenedores/tipoUser.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al actualizar el tipo de usuario
            echo "Error al actualizar el tipo de usuario.";
        }
    }

    // Verificar si se solicitó eliminar un tipo de usuario
    if (isset($_POST['eliminar_tipo_usuario'])) {
        // Obtener el ID del tipo de usuario a eliminar desde la solicitud
        $id_tipo_usuario = $_POST['id_tipo_usuario'];

        // Llamar al método para eliminar el tipo de usuario
        $resultado = $tipoUsuarioController->eliminarTipoUsuario($id_tipo_usuario);

        if ($resultado) {
            // Tipo de usuario eliminado correctamente
            header("Location: ../Mantenedores/tipoUser.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al eliminar el tipo de usuario
            echo "Error al eliminar el tipo de usuario.";
        }
    }

    // Verificar si se recibieron los datos del formulario para guardar un tipo de usuario
    if (isset($_POST['nombre'])) {
        // Obtener los datos del formulario
        $nombre_tipousuario = $_POST["nombre"];

        // Llamar al método para guardar el tipo de usuario
        $tipoUsuarioController->guardarTipoUsuario($nombre_tipousuario);
    }
}
// Crear una instancia del controlador y obtener las categorías
$tipousuarioController = new TipoUsuarioController($conexion);
$tiposusuarios = $tipousuarioController->mostrarTiposUsuario();
?>
