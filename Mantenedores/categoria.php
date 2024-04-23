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
                    <tbody id="tabla_categorias">
            
                    <?php
                    include('../Controllers/categoriaController.php');

                    // Obtener la sucursal del usuario desde la sesión
                    $id_sucursal = $_SESSION['id_sucursal'];

                    $categoriaMostrar = new CategoriaController($conexion, $id_sucursal);
                    $categorias = $categoriaMostrar->mostrarCategorias($id_sucursal); // Método nuevo para obtener categorías por sucursal
                    foreach ($categorias as $categoria) {
                        echo "<tr>";
                        echo "<td>" . $categoria['id_categoria_producto'] . "</td>";
                        echo "<td>" . $categoria['nombre_categoria_producto'] . "</td>";
                        echo "<td>";

                        // Formulario para eliminar y editar la categoría
                        echo "<form method='POST' action='../Controllers/categoriaController.php'>";
                        echo "<input type='hidden' name='id_categoria_producto' value='" . $categoria['id_categoria_producto'] . "'>";
                        echo '<button type="button" class="editar" onclick="editarCategoria(' . $categoria['id_categoria_producto'] . ', \'' . $categoria['nombre_categoria_producto'] . '\')">Editar</button>';
                        echo "<button type='submit' name='eliminar_categoria' class='borrar'>Eliminar</button>";
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
                <form id="formulario-edicion" action="../Controllers/categoriaController.php" method="post">
                    
                    <input type="hidden" id="id_categoria_producto" name="id_categoria_producto">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre_categoria_producto" name="nombre_categoria_producto" required>

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