<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="sidebar close">

    <div class="logo-details">
        
        <i class='bx bxs-hot'></i>
        <span class="logo-name">Cenel</span>
    </div>
    
    <ul class="nav-links">
        <!-- Home -->
        <li>
        <a href="../Views/home.php">
                <i class='bx bx-home' ></i>
                <span class="link-name">Inicio</span>
            </a>
            <ul class="sub-menu blank">
                <ul><a class="link-name" href="./html/inicio.html">Inicio</a></ul>
            </ul>
        </li>

        <?php if($_SESSION['id_tipo_usuario'] == 1): // Solo para admin ?>
        <!-- Mantenedor -->
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class='bx bx-grid-alt '></i>
                    <span class="link-name">Mantenedor</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <ul><a href="../Mantenedores/producto.php">Producto</a></ul>
                <ul><a href="../Mantenedores/ciudad.php">Ciudad</a></ul>
                <ul><a href="../Mantenedores/categoria.php">Categoria</a></ul>
                <ul><a href="../Mantenedores/tipoUser.php">Tipo Usuarios</a></ul>
                <ul><a href="../Mantenedores/empresa.php">Empresa</a></ul>
                <ul><a href="../Mantenedores/usuario.php">Usuarios</a></ul>
            </ul>
        </li>
        <?php endif; ?>
        <!-- Nuevo pedido -->
        <li>
            <a href="../maintainers/form.php">
                <i class='bx bxs-truck'></i>
                <span class="link-name">Nuevo pedido</span>
            </a>
            <ul class="sub-menu blank">
                <ul><a class="link-name" href="./html/maintainers/form.php">Nuevo pedido</a></ul>
            </ul>
        </li>

        <!-- Mapa -->
        <li>
            <a href="../maintainers/map.php">
                <i class='bx bx-map-alt'></i>
                <span class="link-name">Mapa</span>
            </a>
            <ul class="sub-menu blank">
                <ul><a class="link-name" href="./html/maintainers/map.php">Mapa</a></ul>
            </ul>
        </li>

        <!-- Ventas -->
        <li>
            <div class="icon-link">
                <a href="#">
                <i class="ri-inbox-2-fill"></i>
                    <span class="link-name">Ventas</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <ul><a href="../Views/registrar_venta.php">Ventas</a></ul>
                <ul><a href="../Views/caja.php">Caja</a></ul>
                <ul><a href="#">Movimientos</a></ul>
                            
            </ul>
        </li>

        <!-- Ventas -->
        <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="ri-building-line"></i>
                        <span class="link-name">Empresa</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <ul><a href="#">Resumen</a></ul>
                    <ul><a href="#">Reportes</a></ul>
                                
                </ul>
        </li>

        
        <!-- Cierre Sesion -->
        <li>

        <a href="../CerrarSesion.php" class="sesion-end">
            <div class="name-sesion">
                <div class="c-name">Cerrar Sesion</div>
            </div>
            <i class='bx bx-log-out' ></i>
        </a>
        </li>
    </ul>
</div>

