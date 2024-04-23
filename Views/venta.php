<?php
include('../Controllers/productoController.php');
include('../Controllers/StockController.php');

// Obtener bodegas
$stockManager = new StockManager($conexion);
$bodegasAsignadas = $stockManager->obtenerBodegasAsignadas();

// Obtener productos
$productoController = new ProductoController($conexion);
$productos = $productoController->mostrarProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto de Venta</title>
    <!--  CSS -->
    <link rel="stylesheet" href="../Assets/css/stylemenu.css">
    <link rel="stylesheet" href="../Assets/css/stylebtn.css">
    <link rel="stylesheet" href="../Assets/css/style.css">
    <!-- iconos -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Estilos específicos para esta página -->
    <style>
        .contenedor {
            display: flex;
        }
        .productos {
            flex: 1;
            padding: 20px;
        }
        .seleccionados {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
    }
    #tablaProductos {
        width: 100%;
        height: 10%;
    }

    </style>
</head>
<body>
    <?php include '../menu.php'; ?>

    <div class="contenedor">
        
        <div class="seleccionados">
            <!-- Aquí irán los productos seleccionados -->
            <h2>Detalle de venta</h2>
            <form action="procesar_bodega.php" method="post">
                <label for="bodega">Selecciona una bodega:</label>
                <select name="bodega" id="bodega">
                    <?php foreach ($bodegasAsignadas as $bodega): ?>
                        <option value="<?php echo $bodega; ?>"><?php echo $bodega; ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
            <table id="tablaProductos">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody id="productosSeleccionados">
                    <!-- Aquí se agregarán los productos seleccionados -->
                </tbody>
            </table>

            <ul id="productosSeleccionados">
                <!-- Aquí se agregarán los productos seleccionados -->
            </ul>

            <p>Total: $ <span id="totalVenta">0</span></p>
            <button id="botonPagar">Pagar</button>
        </div>

        <div class="productos">
            <h2>Productos</h2>
            <ul>
                <?php foreach ($productos as $producto): ?>
                    <li>
                        <button class="producto" data-id="<?php echo $producto['id_producto']; ?>"><?php echo $producto['nombre_producto']; ?></button>
                        
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>


    <script>
    // Obtener referencia a los botones de producto
    const botonesProductos = document.querySelectorAll('.producto');

    // Agregar un evento de clic a cada botón de producto
    botonesProductos.forEach(boton => {
        boton.addEventListener('click', () => {
            // Obtener la información del producto
            const idProducto = boton.getAttribute('data-id');
            const nombreProducto = boton.textContent; // Puedes modificar esto para obtener más información del producto si lo necesitas

            // Verificar si el producto ya está en la tabla de productos seleccionados
            const tablaProductos = document.getElementById('productosSeleccionados');
            let productoExistente = null;
            const filas = tablaProductos.getElementsByTagName('tr');
            for (let i = 0; i < filas.length; i++) {
                const fila = filas[i];
                if (fila.getAttribute('data-id') === idProducto) {
                    productoExistente = fila;
                    break;
                }
            }

            // Si el producto ya está en la tabla, actualizar el conteo
            if (productoExistente) {
                const cantidadCelda = productoExistente.querySelector('.cantidad');
                const cantidadExistente = parseInt(cantidadCelda.textContent, 10);
                cantidadCelda.textContent = cantidadExistente + 1;
            } else {
                // Si el producto no está en la tabla, agregarlo como nueva fila
                const nuevaFila = document.createElement('tr');
                nuevaFila.setAttribute('data-id', idProducto);

                const nombreCelda = document.createElement('td');
                nombreCelda.textContent = nombreProducto;
                nuevaFila.appendChild(nombreCelda);

                const cantidadCelda = document.createElement('td');
                cantidadCelda.classList.add('cantidad');
                cantidadCelda.textContent = '1';
                nuevaFila.appendChild(cantidadCelda);

                const accionesCelda = document.createElement('td');
                const botonDisminuir = document.createElement('button');
                botonDisminuir.textContent = 'menos';
                botonDisminuir.addEventListener('click', () => {
                    const cantidad = parseInt(cantidadCelda.textContent, 10);
                    if (cantidad > 1) {
                        cantidadCelda.textContent = cantidad - 1;
                    }
                });
                accionesCelda.appendChild(botonDisminuir);

                const botonEliminar = document.createElement('button');
                botonEliminar.textContent = 'Eliminar';
                botonEliminar.addEventListener('click', () => {
                    tablaProductos.removeChild(nuevaFila);
                });
                accionesCelda.appendChild(botonEliminar);

                nuevaFila.appendChild(accionesCelda);

                tablaProductos.appendChild(nuevaFila);
            }
        });
    });
</script>




<script src="../Assets/js/menu.js"></script>
</body>
</html>
