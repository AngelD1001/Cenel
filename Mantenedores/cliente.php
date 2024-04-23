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

<h1>Mantenedor de Clientes</h1>
<div class="container-crud">
    <!-- Primer bloque -->
    <div class="crud-container">
        <div class="crud-table">
            <table class="crud-table-inner">
                <thead class="crud-header-row">
                    <tr>
                        <th>Id</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla_cliente">
                <tr>
        <td>1</td>
        <td>22.345.678-9</td>
        <td>Juan</td>
        <td>Pérez</td>
        <td>+56912345678</td>
        <td>
        <button class="editar">Editar</button>
        <button class="borrar">Borrar</button>
        </td>
    </tr>
    <tr>
        <td>2</td>
        <td>18.765.432-1</td>
        <td>María</td>
        <td>González</td>
        <td>+56998765432</td>
        <td>
        <button class="editar">Editar</button>
        <button class="borrar">Borrar</button>
        </td>
    </tr>
    <tr>
        <td>3</td>
        <td>16.789.012-3</td>
        <td>Carlos</td>
        <td>Ruiz</td>
        <td>+56956789012</td>
        <td>
        <button class="editar">Editar</button>
        <button class="borrar">Borrar</button>
        </td>
    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Segundo bloque -->
    <div class="crud-container-two">
        <div class="crud-header">
            <h2>Crear Nuevo Cliente</h2>
        </div>
        <div class="crud-form">
            <form id="formularioCreacion">
                <label for="rut">Rut</label>
                <input type="text" id="rut" name="rut" onblur="validarYFormatearRut()">
                <div id="mensajeErrorRut" ></div>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required>
                
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" required onblur="validarTelefono()">
                <div id="mensajeErrorTelefono"></div>

                <button type="submit" class="guardarbtn">Guardar Cliente</button>
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