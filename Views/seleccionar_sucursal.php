<?php
include('../Models/seleccionModel.php');

// Verificar si se ha enviado el formulario para seleccionar una sucursal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_sucursal'])) {
    // Establecer la sesión de la sucursal seleccionada
    session_start();
    $_SESSION['id_sucursal'] = $_POST['id_sucursal'];
    // Redirigir al home
    header("Location: ../Views/home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="../Assets/css/stylesucursales.css">
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Seleccionar Sucursal</title>

</head>
<body>
<section>
    <div class="contenedor">
        <h2>Seleccionar Sucursal</h2>
        <div class="sucursales">
        <?php if (!empty($error)) : ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <ul>
                <?php foreach ($sucursales as $sucursal): ?>
                    <li>
                        <?php
                            
                            $url_destino = '';
                            switch ($sucursal['id_sucursal']) {
                                case 1:
                                    $url_destino = '../Views/home.php';
                                    break;
                                case 2:
                                    $url_destino = '../Views/home.php';
                                    break;
                            //Si se agrega otra direc, pone un case más, como por ejemplo
                            //case 3: -----
                                default:
                                    $url_destino = '#'; 
                                    break;
                            }
                        ?>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="id_sucursal" value="<?php echo $sucursal['id_sucursal']; ?>">
                                <button type="submit" class="boton-sucursal"><?php echo $sucursal['nombre_sucursal']; ?></button>
                            </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
    
</body>
</html>


