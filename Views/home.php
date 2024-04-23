<?php
// Incluye el archivo de conexión a la base de datos
include('../Models/Conexion.php');

session_start();

// Verificar si se ha seleccionado una sucursal
if (!isset($_SESSION['id_sucursal'])) {
    // Redirigir al usuario a la página de selección de sucursal si no se ha seleccionado ninguna
    header("Location: ../Views/seleccionar_sucursal.php");
    exit();
}

// Obtener el ID y nombre de la sucursal seleccionada
$id_sucursal = $_SESSION['id_sucursal'];

// Consulta para obtener el nombre de la sucursal seleccionada
$sql = "SELECT nombre_sucursal FROM Sucursal WHERE id_sucursal = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_sucursal);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $nombre_sucursal);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Mensaje de bienvenida con el nombre de la sucursal
$mensaje_bienvenida = "Bienvenido a la Sucursal " . $nombre_sucursal;
?>



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
<style>
        /* Estilo para el botón */
        #botonTurno {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Estilo para el botón al pasar el cursor */
        #botonTurno:hover {
            background-color: #0056b3;
        }
    </style>
<!--=============== Class ira con "-" y todo lo que sea ID con "--" ===============-->
<body>

<!--=============== HEADER FIN ===============-->
<?php
include '../menu.php' 
?>
<!--=============== HEADER FIN ===============-->
<h1><?php echo $mensaje_bienvenida; ?></h1>
<section class="section-clock">
    <div class="container-clock">
        <div class="clock">
            <div id="Date">Jueves 15 de Febrero 2024</div>
            <ul>
                <li id="hours">10</li>
                <li id="point">:</li>
                <li id="min">34</li>
                <li id="point">:</li>
                <li id="sec">30</li>
            </ul>
        </div>
        <button id="botonTurno" onclick="toggleTurno()">Iniciar Turno</button>
    </div>
    

</section>

<!--=============== Assets JS ===============-->
<script>
    function clock(){
        var monthNames = [
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];

        var dayNames = [
            "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"
        ];

                var today = new Date();
            
                document.getElementById('Date').innerHTML = (dayNames[today.getDay()] + " " + 
                today.getDate() + '   de   ' + monthNames[today.getMonth()] + ' ' +today.getFullYear());

                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                var day = h<11 ? 'AM': 'PM';

                h = h<10? '0'+h: h;
                m = m<10? '0'+m: m;
                s = s<10? '0'+s: s;               
            
                document.getElementById('hours').innerHTML = h;
                document.getElementById('min').innerHTML = m;
                document.getElementById('sec').innerHTML = s;
            
            }var inter = setInterval(clock,400);
            
</script>

<script>
        function toggleTurno() {
        var boton = document.getElementById("botonTurno");
        if (boton.innerText === "Iniciar Turno") {
            // Realizar acciones para iniciar el turno
            Swal.fire('Turno iniciado', '', 'success');
            // Cambiar el texto del botón a "Cerrar Turno"
            boton.innerText = "Cerrar Turno";
        } else {
            // Realizar acciones para cerrar el turno
            Swal.fire('Turno cerrado', '', 'success');
            // Cambiar el texto del botón a "Iniciar Turno"
            boton.innerText = "Iniciar Turno";
        }
    }
</script>
<script src="../clock.js"></script>
<script src="../Assets/js/menu.js"></script>
<script src="../Assets/js/utilidades.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>