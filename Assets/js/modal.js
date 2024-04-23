function abrirModal(tipo) {
    var modal;
    if (tipo === 'ver') {
        modal = document.getElementById('modalVer');
        // Configurar la fecha actual al abrir el modal
        configurarFechaActual();
        // Cargar y mostrar movimientos anteriores
        mostrarMovimientosAnteriores();
    }

    modal.style.display = 'block';
}

function cerrarModal(idModal) {
    var modal = document.getElementById(idModal);
    modal.style.display = 'none';
}

function configurarFechaActual() {
    console.log('Configurando fecha actual');
    var fechaActual = obtenerFechaActual();
    var inputFecha = document.getElementById('fechamodal');
    inputFecha.value = fechaActual;
}

function obtenerFechaActual() {
    const ahora = new Date();
    const anio = ahora.getFullYear();
    const mes = (ahora.getMonth() + 1).toString().padStart(2, '0');
    const dia = ahora.getDate().toString().padStart(2, '0');

    return `${anio}-${mes}-${dia}`;
}

function mostrarMovimientosAnteriores() {
    // Aquí puedes agregar la lógica para cargar y mostrar movimientos anteriores
    // Puedes recuperar datos de una base de datos, localStorage, etc.
    var movimientosAnteriores = ['Movimiento 1', 'Movimiento 2', 'Movimiento 3'];
    
    var container = document.getElementById('movimientosAnteriores');
    container.innerHTML = '';

    movimientosAnteriores.forEach(function(movimiento) {
        var p = document.createElement('p');
        p.textContent = movimiento;
        container.appendChild(p);
    });
}
