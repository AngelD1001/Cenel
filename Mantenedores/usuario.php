<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="../Assets/css/stylemenu.css">
    <link rel="stylesheet" href="../Assets/css/stylebtn.css">
    <link rel="stylesheet" href="../Assets/css/style.css">
    <!--=============== BOXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Cenel</title>
</head>
<!--=============== Class ira con "-" y todo lo que sea ID con "--" ===============-->
<body>
    
<!--=============== HEADER FIN ===============-->
<?php
include '../menu.php' 
?>
<!--=============== HEADER FIN ===============-->
<h1>Mantenedor de Usuario</h1>
<div class="container-crud">
        <!-- Primer bloque es el CRUD donde veremos todos los productos que existan-->
        <div class="crud-container">
            <div class="crud-table">
                <table class="crud-table-inner">
                    <thead class="crud-header-row">
                        <tr>
                            <th>ID</th>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_usuarios">

                        <?php
                        include('../Controllers/usuarioController.php');

                        $usuarioMostrar = new UsuarioController($conexion);
                        $usuarios = $usuarioMostrar->mostrarUsuarios(); // Obtener usuarios desde el controlador

                        foreach ($usuarios as $usuario) {
                            echo "<tr>";
                            echo "<td>" . $usuario['id_usuario'] . "</td>";
                            echo "<td>" . $usuario['rut_usuario'] . "</td>";
                            echo "<td>" . $usuario['nombre_usuario'] . "</td>";
                            echo "<td>" . $usuario['apellido_usuario'] . "</td>";
                            echo "<td>" . $usuario['email_usuario'] . "</td>";
                            echo "<td>" . $usuario['nombre_tipo_usuario'] . "</td>";
                            // Puedes agregar más columnas según la estructura de tu tabla de usuarios

                            echo "<td>";

                            // Formulario para eliminar y editar el usuario
                            echo "<form method='POST' action='../Controllers/usuarioController.php'>";
                            echo "<input type='hidden' name='id_usuario' value='" . $usuario['id_usuario'] . "'>";
                            echo '<button type="button" class="editar" onclick="editarUsuario(' . $usuario['id_usuario'] . ', \'' . $usuario['rut_usuario'] . '\', \'' . $usuario['nombre_usuario'] . '\', \'' . $usuario['apellido_usuario'] . '\', \'' . $usuario['email_usuario'] . '\', \'' . $usuario['nombre_tipo_usuario'] . '\')">Editar</button>';                            
                            echo "<button type='submit' name='eliminar_usuario' class='borrar'>Eliminar</button>";
                            echo "</form>";

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>


        <!-- Segundo bloque es el formulario de guardar-->
        <div class="crud-container-two">
            <div class="crud-header">
                <h2>Formulario</h2>
            </div>
            <div class="crud-form">
                <form id="formulario-edicion" action="../Controllers/usuarioController.php" method="post">
                    
                    <input type="hidden" id="id_usuario" name="id_usuario">

                    <label for="rut">Rut</label>
                    <input type="text" id="rut" name="rut" onblur="validarYFormatearRut()">
                    <div id="mensajeErrorRut" ></div>

                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" >

                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" required>

                    <label for="clave">Clave</label>
                    <input type="text" id="clave" name="clave" >

                    <label for="id_tipousuario">Usuario</label>
                    <select id="id_tipousuario" name="id_tipousuario" required>
                        <option value="">Seleccionar Tipo de Usuario</option>
                        <?php

                        include('../Controllers/tipoUsuarioController.php');
                        // Crear una instancia del controlador

                        // Llamar al método que muestra las categorías
                        $tiposusuarios = $tipousuarioController->mostrarTiposUsuario();

                        foreach ($tiposusuarios as $tiposusuario) {
                            echo '<option value="' . $tiposusuario['id_tipo_usuario'] . '">' . $tiposusuario['nombre_tipo_usuario'] . '</option>';
                        }
                        ?>
                    </select>

                    <button type="submit" class="guardarbtn">Guardar</button>
                </form>
            </div>
        </div>
        
</div>


<!--=============== Assets JS ===============-->
<script src="../Assets/js/menu.js"></script>
<script src="../Assets/js/modal.js"></script>
<script src="../Assets/js/utilidades.js"></script>
</body>
</html>