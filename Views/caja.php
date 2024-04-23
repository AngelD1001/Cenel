<?php
include_once '../Models/Conexion.php';
include_once '../Controllers/stockController.php';

// Crear una instancia de StockManager
$stockManager = new StockManager($conexion);

// Obtener las bodegas asignadas al stock
$bodegas = $stockManager->obtenerBodegasAsignadas();

// Obtener los estados de los productos
$estadosProductos = $stockManager->obtenerEstadosProductos();

// Verificar si se ha enviado un formulario y se ha seleccionado una bodega
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bodega'])) {
    $bodegaSeleccionada = $_POST['bodega'];
    // Obtener el stock por bodega
    $stockPorBodega = $stockManager->obtenerStockPorBodega($bodegaSeleccionada);
} else {
    // Si no se ha seleccionado ninguna bodega, obtén el stock de una bodega por defecto
    // O simplemente deja la variable $stockPorBodega como vacía para que se muestre la tabla sin datos
    $stockPorBodega = $stockManager->obtenerStockPorBodega('Local'); // Cambia 'Local' por la bodega que prefieras
}
?>

<!DOCTYPE html>
<html lang="es">
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

    <script src="../Assets/js/utilidades.js"></script>

    <title>Cenel</title>
</head>
<body>

<?php include '../menu.php'; ?>

<h2 style="text-align: center">Conteo de Stock</h2>
<div class="container-crud">
    <div>

        <form method="post">
            <select name="bodega" onchange="this.form.submit()">
                <option value="">Seleccionar Bodega</option>
                <?php foreach ($bodegas as $bodega) : ?>
                    <option value="<?= $bodega ?>" <?= isset($bodegaSeleccionada) && $bodegaSeleccionada == $bodega ? 'selected' : '' ?>><?= $bodega ?></option>
                    
                <?php endforeach; ?>
               
            </select>
        </form>

        <div class="crud_table">
    <table>
        <thead class="crud-header-row">
            <tr>
                <th>Producto</th>
                <?php foreach ($estadosProductos as $estadoProducto) : ?>
                    <th><?= $estadoProducto ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($stockPorBodega) && !empty($stockPorBodega)) : ?>
                <?php foreach ($stockPorBodega as $producto => $clasificaciones) : ?>
                    <tr>
                        <td><?= $producto ?></td>
                        <?php foreach ($estadosProductos as $estadoProducto) : ?>
                            <td><?= isset($clasificaciones[$estadoProducto]) ? $clasificaciones[$estadoProducto] : 0 ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="<?= count($estadosProductos) + 1 ?>">No hay datos disponibles</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

    </div>
</div>

<script src="../Assets/js/menu.js"></script>
</body>
</html>
