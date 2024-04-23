<?php
include('../Models/usuarioModel.php'); 

class UsuarioController {
    private $usuarioModel;

    public function __construct($conexion) {
        $this->usuarioModel = new UsuarioModel($conexion);
    }

    public function guardarUsuario($nombre, $apellido, $rut, $email, $clave, $id_tipousuario) {
        // Llamar al método del modelo para guardar el usuario
        $resultado = $this->usuarioModel->guardarUsuario($nombre, $apellido, $rut, $email, $clave, $id_tipousuario);
    
        if ($resultado) {
            // Usuario guardado correctamente
            header("Location: ../Mantenedores/usuario.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al guardar el usuario
            echo "Error al guardar el usuario.";
        }
    }

    public function mostrarUsuarios() {
        // Obtener los usuarios del modelo
        $usuarios = $this->usuarioModel->obtenerUsuarios();
        
        // Verificar si se obtuvieron correctamente
        if ($usuarios === null) {
            // Manejar el caso donde no se obtuvieron usuarios
            die("No se han obtenido usuarios");
        }

        // Devolver los usuarios
        return $usuarios;
    }

    public function eliminarUsuario($id_usuario) {
        // Llamar al método del modelo para eliminar el usuario
        $resultado = $this->usuarioModel->eliminarUsuario($id_usuario);

        if ($resultado) {
            // Usuario eliminado correctamente
            return true;
        } else {
            // Error al eliminar el usuario
            return false;
        }
    }

    public function obtenerUsuarioPorId($id_usuario) {
        $usuario = $this->usuarioModel->obtenerUsuarioPorId($id_usuario);
        // Verificar si se obtuvieron los datos correctamente
        if ($usuario) {
            // Si los datos se obtienen correctamente, imprimir un mensaje en pantalla
            echo "Datos del usuario obtenidos en el controlador: <pre>" . print_r($usuario, true) . "</pre>";
        } else {
            // Si no se obtienen los datos correctamente, imprimir un mensaje de error en pantalla
            echo "Error: No se pudieron obtener los datos del usuario en el controlador.";
        }
        return $usuario;
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellido, $rut, $email, $clave, $id_tipousuario) {
        return $this->usuarioModel->actualizarUsuario($id_usuario, $nombre, $apellido, $rut, $email, $clave, $id_tipousuario);
    }

    public function actualizarUsuarioSinClave($id_usuario, $nombre, $apellido, $rut, $email, $id_tipousuario) {
        return $this->usuarioModel->actualizarUsuarioSinClave($id_usuario, $nombre, $apellido, $rut, $email, $id_tipousuario);
    }
    
}
// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear una instancia del controlador
    $usuarioController = new UsuarioController($conexion);

    // Verificar si se recibieron los datos del formulario para actualizar un usuario
    if (isset($_POST['id_usuario']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['rut']) && isset($_POST['email']) && isset($_POST['id_tipousuario'])) {
        // Obtener los datos del formulario
        $id_usuario = $_POST["id_usuario"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $rut = $_POST["rut"];
        $email = $_POST["email"];
        $id_tipousuario = $_POST["id_tipousuario"];

        // Verificar si se proporcionó una nueva contraseña
        if (isset($_POST['clave']) && !empty($_POST['clave'])) {
            $clave = $_POST["clave"];
            // Llamar al método para actualizar el usuario con la nueva contraseña
            $resultado = $usuarioController->actualizarUsuario($id_usuario, $nombre, $apellido, $rut, $email, $clave, $id_tipousuario);
        } else {
            // Llamar al método para actualizar el usuario sin cambiar la contraseña
            $resultado = $usuarioController->actualizarUsuarioSinClave($id_usuario, $nombre, $apellido, $rut, $email, $id_tipousuario);
        }

        if ($resultado) {
            // Usuario actualizado correctamente
            header("Location: ../Mantenedores/usuario.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } 
    }

    // Verificar si se solicitó eliminar un usuario
    if (isset($_POST['eliminar_usuario'])) {
        // Obtener el ID del usuario a eliminar desde la solicitud
        $id_usuario = $_POST['id_usuario'];

        // Llamar al método para eliminar el usuario
        $resultado = $usuarioController->eliminarUsuario($id_usuario);

        if ($resultado) {
            // Usuario eliminado correctamente
            header("Location: ../Mantenedores/usuario.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            // Error al eliminar el usuario
            echo "Error al eliminar el usuario.";
        }
    }

    // Verificar si se recibieron los datos del formulario para guardar un usuario
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['rut']) && isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['id_tipousuario'])) {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $rut = $_POST["rut"];
        $email = $_POST["email"];
        $clave = $_POST["clave"];
        $id_tipousuario = $_POST["id_tipousuario"];

        // Llamar al método para guardar el usuario
        $usuarioController->guardarUsuario($nombre, $apellido, $rut, $email, $clave, $id_tipousuario);
    }
}
