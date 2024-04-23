


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
<h1>Mantenedor de Productos</h1>
<div class="container-crud">
        <!-- Primer bloque es el CRUD donde veremos todos los productos que existan-->
        <div class="crud-container">
            <div class="crud-table">
                <table class="crud-table-inner">
                    <thead class="crud-header-row">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_productos">
                        <!-- Aquí se llenarán dinámicamente los datos de los productos -->
                        <?php
                        include('../Controllers/productoController.php');

                        $productoMostrar = new ProductoController($conexion);
                        $productos = $productoMostrar->mostrarProductos(); 
                        
                        foreach ($productos as $producto) {
                            echo "<tr>";
                            echo "<td>" . $producto['id_producto'] . "</td>";
                            echo "<td>" . $producto['nombre_producto'] . "</td>";
                            echo "<td>" . $producto['nombre_categoria'] . "</td>";
                            echo "<td>" . $producto['descripcion_producto'] . "</td>";
                            echo "<td>";


                            // Formulario para eliminar y editar  el producto
                            echo "<form method='POST' action='../Controllers/productoController.php'>";
                            echo "<input type='hidden' name='id_producto' value='" . $producto['id_producto'] . "'>";
                            echo '<button type="button" class="editar" onclick="editarProducto(' . $producto['id_producto'] . ', \'' . $producto['nombre_producto'] . '\', \'' . $producto['nombre_categoria'] . '\', \'' . $producto['descripcion_producto'] . '\')">Editar</button>';
                            echo "<button type='submit' name='eliminar_producto' class='borrar'>Eliminar</button>";
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
                <form id="formulario-edicion" action="../Controllers/productoController.php" method="post">
                    
                    <input type="hidden" id="id_producto" name="id_producto">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="categoria">Categoría</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Seleccionar Categoría</option>
                        <?php

                        include('../Controllers/categoriaController.php');
                        // Crear una instancia del controlador

                        // Llamar al método que muestra las categorías
                        $categorias = $categoriaController->mostrarCategorias();

                        foreach ($categorias as $categoria) {
                            echo '<option value="' . $categoria['id_categoria_producto'] . '">' . $categoria['nombre_categoria_producto'] . '</option>';
                        }
                        ?>
                    </select>


                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="1" required></textarea>

                    <button type="submit" class="guardarbtn">Guardar</button>
                </form>
            </div>
        </div>
</div>

<div class="crud-container-stock">
    <div>
        <select class="selec-stock" id="categoria" name="categoria" required>
            <option value="">Seleccionar Stock</option>
            <option value="">Local</option>
            <option value="">C 1</option>
            <option value="">C 2</option>
        </select>
        <input name="registrar"  id="registrar" class="btn-stock" type="submit"  value="Editar Stock" >

        <div class="crud-table">
            <form action="cajaModel.php" method="post">
                <table class="crud-table-inner">
                    <thead class="crud-header-row">
                        <tr>
                            <th>Gas</th>
                            <th>Lleno</th>
                            <th>Vacio</th>
                            <th>Concho</th>
                            <th>Dañado</th>
                            <th>Catalitico Lleno</th>
                            <th>Catalitico Vacio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $gases = ["15 KG", "11 KG", "5 KG", "45 KG", "VMF", "VMH"];

                    foreach ($gases as $gas) {
                        echo "<tr>";
                        echo "<td>$gas</td>";
                        
                        $clasificaciones = ["Lleno", "Vacio", "Concho", "Dañado", "Catalitico Lleno", "Catalitico Vacio"];
                        $totalGas = 0;

                        foreach ($clasificaciones as $clasificacion) {
                            $inputName = $gas . '-' . $clasificacion;
                            echo "<td><input class='stock-place' type='number' name='$inputName' placeholder='0' oninput='sumarGas(\"$gas\", \"$clasificacion\")' readonly></td>";
                        }

                        echo "<td name='{$gas}-Total'></td>";  // Añadir un espacio para el total, será actualizado por JavaScript
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>
                <b id=totalGeneral style="margin-left: 88.5%;">Total general: 0</b>  
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