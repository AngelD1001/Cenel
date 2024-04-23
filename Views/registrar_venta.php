<?php
include('../Controllers/productoController.php');
include('../Controllers/StockController.php');
require_once('../Controllers/TipoPagoController.php');
require_once('../Controllers/TipoDescuentoController.php');

// Obtener tipos de pago
$tipoDescuentoController = new TipoDescuentoController($conexion);
$tiposDescuento = $tipoDescuentoController->obtenerTiposDescuento();
// Obtener tipos de pago
$tipoPagoController = new TipoPagoController($conexion);
$tiposPago = $tipoPagoController->obtenerTiposPago();
// Obtener bodegas
$stockManager = new StockManager($conexion);
$bodegasAsignadas = $stockManager->obtenerBodegasAsignadas();
// Obtener productos con precios
$productoController = new ProductoController($conexion);
$productos = $productoController->mostrarProductosConPrecio();
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Punto de Venta</title>
<link rel="stylesheet" href="../Assets/css/styleventas.css">
<link rel="stylesheet" href="../Assets/css/stylemenu.css">

<link href="https://cdn.jsdelivr.net/npm/remixicon@4.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<!--=============== HEADER FIN ===============-->
<?php
include '../menu.php' 
?>
<!--=============== HEADER FIN ===============-->
<h1>Modulo de ventas</h1>
<div class="contenedor-principal">
    <div class="seccion-izquierda">
    <!-- Buscador y lista de productos -->
        <div class="search-bar">
            <i class="ri-barcode-fill"></i>
            <input type="text" id="search-input" placeholder="Buscar cliente...">
            <button id="search-button"><i class="ri-search-line"></i></button>
        </div>

        <div id="resultados-busqueda" class="resultados-busqueda"></div>
        <form action="procesar_bodega.php" method="post">
                <label for="bodega">Selecciona una bodega:</label>
                <select name="bodega" id="bodega">
                    <?php foreach ($bodegasAsignadas as $bodega): ?>
                        <option value="<?php echo $bodega; ?>"><?php echo $bodega; ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        <div id="product-list" class="product-list"></div>
      

            <!-- Resumen de compra -->
            <div class="resumen-compra">
                <span class="total-etiqueta">Total</span>
                <span id="total-compra">$0</span>
                <button id="btn-pagar" class="btn-pagar">Pagar</button>
            </div>

</div>

    <div class="seccion-derecha">
        <!-- Resumen de compra y opciones de pago -->
        <div class="area-pago">
        <h2>Productos</h2>
            <ul>
            <?php foreach ($productos as $producto): ?>
                <li>
                    <button class="producto" data-id="<?php echo $producto['id_producto']; ?>" data-precio="<?php echo $producto['detalle_precio']; ?>">
                        <?php echo $producto['nombre_producto']; ?>
                    </button>
                    <span class="precio-producto">$<?php echo $producto['detalle_precio']; ?></span>
                </li>
            <?php endforeach;?>

            </ul>

            
        </div>
        <form>
        <h2>Detalle del pago</h2>
        <!-- Tipos de pago-->
        <label for="pago">Tipo de pago:</label>
        <select name="tipoPago" id="tipoPago">
            <?php
            foreach ($tiposPago as $idTipoPago => $nombreTipoPago) {
                echo "<option value=\"" . $idTipoPago . "\">" . $nombreTipoPago . "</option>";
            }
            ?>
        </select>
        <input type="number" name="monto" id="monto" step="0.01" placeholder="Ingrese el monto" required>
        <!-- Tipos de descuento-->
        <label for="descuento">Tipo de descuento:</label>
        <select name="tipoDescuento" id="tipoDescuento">
            <?php
            foreach ($tiposDescuento as $idTipoDescuento => $nombreTipoDescuento) {
                echo "<option value=\"" . $idTipoDescuento . "\">" . $nombreTipoDescuento . "</option>";
            }
            ?>
        </select>
        <input type="number" name="monto" id="monto" step="0.01" placeholder="Ingrese el monto" required>

        
        </form>
        <button id="btn-confirmar" class="btn-confirmar" onclick="toggleTurno()">CONFIRMAR PAGO</button>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../Assets/js/registro-ventas.js"></script>
<script src="../Assets/js/menu.js"></script>
</body>
</html>
