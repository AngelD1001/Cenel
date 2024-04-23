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
<h1>Mantenedor de Categoria</h1>
<div class="container-crud">
        <!-- Primer bloque es el CRUD donde veremos todos los productos que existan-->
        <div class="crud-container">
            <div class="crud-table">
                <table class="crud-table-inner">
                    <thead class="crud-header-row">
                        <tr>
                            <th>ID</th>

                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_tipos_usuario">
                        <!-- Aquí se llenarán dinámicamente los datos de los tipos de usuario -->
                        <?php
                        include('../Controllers/tipoUsuarioController.php');

                        $tipoUsuarioMostrar = new TipoUsuarioController($conexion);
                        $tiposUsuario = $tipoUsuarioMostrar->mostrarTiposUsuario();

                        foreach ($tiposUsuario as $tipoUsuario) {
                            echo "<tr>";
                            echo "<td>" . $tipoUsuario['id_tipo_usuario'] . "</td>";
                            echo "<td>" . $tipoUsuario['nombre_tipo_usuario'] . "</td>";
                            echo "<td>";

                            // Formulario para eliminar y editar el tipo de usuario
                            echo "<form method='POST' action='../Controllers/tipoUsuarioController.php'>";
                            echo "<input type='hidden' name='id_tipo_usuario' value='" . $tipoUsuario['id_tipo_usuario'] . "'>";
                            echo '<button type="button" class="editar" onclick="editarTipoUsuario(' . $tipoUsuario['id_tipo_usuario'] . ', \'' . $tipoUsuario['nombre_tipo_usuario'] . '\')">Editar</button>';
                            echo "<button type='submit' name='eliminar_tipo_usuario' class='borrar'>Eliminar</button>";
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
                <form id="formulario-edicion" action="../Controllers/tipoUsuarioController.php" method="post">
                    
                    <input type="hidden" id="id_tipo_usuario" name="id_tipo_usuario">


                    <label for="nombre">Tipo de usuario</label>
                    <input type="text" id="nombre" name="nombre" required>

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