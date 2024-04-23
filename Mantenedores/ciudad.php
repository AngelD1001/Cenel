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
<h1>Mantenedor de Ciudades</h1>
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
                    <tbody id="tabla_ciudades">

                        <?php
                        include('../Controllers/ciudadController.php');

                        $ciudadMostrar = new CiudadController($conexion);
                        $ciudades = $ciudadMostrar->mostrarCiudades(); // mostrar las ciudades desde el controlador

                        foreach ($ciudades as $ciudad) {
                            echo "<tr>";
                            echo "<td>" . $ciudad['id_ciudad'] . "</td>";
                            echo "<td>" . $ciudad['nombre_ciudad'] . "</td>";

                            echo "<td>";

                            // Formulario para eliminar y editar la ciudad
                            echo "<form method='POST' action='../Controllers/ciudadController.php'>";
                            echo "<input type='hidden' name='id_ciudad' value='" . $ciudad['id_ciudad'] . "'>";
                            echo '<button type="button" class="editar" onclick="editarCiudad(' . $ciudad['id_ciudad'] . ', \'' . $ciudad['nombre_ciudad'] . '\')">Editar</button>';

                            echo "<button type='submit' name='eliminar_ciudad' class='borrar'>Eliminar</button>";
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
                <form id="formulario-edicion" action="../Controllers/ciudadController.php" method="post">
                    
                    <input type="hidden" id="id_ciudad" name="id_ciudad">

                    <label for="nombre_ciudad">Nombre</label>
                    <input type="text" id="nombre_ciudad" name="nombre_ciudad" required>

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