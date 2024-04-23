<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="./Assets/css/stylelogin.css">
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Cenel Login</title>
</head> 

<body>
    <section>
        <div class="contenedor">
            <div class="formulario">
                <form action="./Controllers/sesionController.php" method="POST">
                    <h2>Iniciar Sesión</h2>
                    <div class="input-contenedor">
                        <i class='bx bxs-user' ></i>
                        <input type="text" id="rut" name="rut" onblur="validarYFormatearRut()" required>
                        <label for="rut">Rut</label>
                        <!-- <div id="e-rut"></div> onblur="lostFocus(this.id)" -->
                        <div id="mensajeErrorRut" ></div>
                    </div>

                    <div class="input-contenedor">
                        <i class='bx bxs-lock-alt' ></i>
                        <input type="password" name="clave" required>
                        <label for="clave">Contraseña</label>
                        <!-- <div id="e-pass"></div> -->
                    </div>
                    <div>
                        <a href="#" class="link-recuperar">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div>
                        <button type="submit">Acceder</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>


<script src="./Assets/js/utilidades.js"></script>
</html>
