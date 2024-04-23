////====== FUNCION DE RELLENADO DE RUT ========////
function mostrarMensajeError(mensaje) {
    var mensajeErrorContainer = document.getElementById("mensajeErrorRut");
    mensajeErrorContainer.innerHTML = `<span class="badge bg-danger jsspan">${mensaje}</span>`;
}
function validarYFormatearRut() {
    var rutInput = document.getElementById('rut');
    var rut = rutInput.value.trim();
    
    var errorRut = document.getElementById('mensajeErrorRut');
    errorRut.innerHTML = ''; // Limpiar mensaje de error
    
    if (rut === '') {
        mostrarMensajeError('Por favor ingresa un RUT.');
        rutInput.focus();
        return;
    }
    
    if (!validarRut(rut)) {
        mostrarMensajeError('El RUT ingresado no es válido.');
        rutInput.focus();
        return;
    }
    
    var rutFormateado = formatearRut(rut);
    rutInput.value = rutFormateado;

    // Limpiar mensaje de error después de formatear el RUT válido
    errorRut.innerHTML = '';
}


function validarRut(rut) {
    rut = rut.replace(/\./g, '').replace(/\-/g, '').toUpperCase();
    
    var rutRegex = /^(\d{1,3}(\.?\d{3}){2})\-?([\dkK])$/;
    
    if (!rutRegex.test(rut)) {
        return false;
    }
    
    var cuerpoRut = rut.slice(0, -1);
    var dv = rut.slice(-1);
    
    var suma = 0;
    var multiplo = 2;
    
    for (var i = cuerpoRut.length - 1; i >= 0; i--) {
        suma += parseInt(cuerpoRut.charAt(i)) * multiplo;
        
        if (multiplo < 7) {
            multiplo++;
        } else {
            multiplo = 2;
        }
    }
    
    var dvEsperado = 11 - (suma % 11);
    dv = (dv === 'K') ? 10 : parseInt(dv);
    
    return (dvEsperado === dv || (dvEsperado === 11 && dv === 0));
}

function formatearRut(rut) {
    rut = rut.replace(/\./g, '').replace(/\-/g, '').toUpperCase();
    var rutFormateado = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
    return rutFormateado;
}


////====== FUNCION DE RELLENADO DE RUT ========////
function validarTelefono() {
    var telefonoInput = document.getElementById("telefono");
    var telefonoValue = telefonoInput.value.trim();

    // Expresión regular para validar el número de teléfono completo con código de país
    var telefonoRegex = /^(\+?56)?(\s?)(0?9)(\s?)[9876543]\d{7}$/;

    if (telefonoValue.length === 8 && /^[9876543]\d{7}$/.test(telefonoValue)) {
        // Autocompletar automáticamente el código de país "569"
        telefonoInput.value = "+569" + telefonoValue;

        // Limpiar mensaje de error del teléfono
        var mensajeErrorContainer = document.getElementById("mensajeErrorTelefono");
        mensajeErrorContainer.innerHTML = '';
        
        return true;
    }

    if (!telefonoRegex.test(telefonoInput.value)) {
        // El número de teléfono no es válido
        mostrarMensajeErrorTelefono("Número de teléfono no válido");
        return false; // Evita que el formulario se envíe si el teléfono no es válido
    }

    return true; // Permite el envío del formulario si el teléfono es válido
}

function mostrarMensajeErrorTelefono(mensaje) {
    var mensajeErrorContainer = document.getElementById("mensajeErrorTelefono");
    mensajeErrorContainer.innerHTML = `<span class="badge bg-danger jsspan">${mensaje}</span>`;
}

////====== FUNCION DE RELLANDO TELEFONO ========////


////====== FUNCION DE HORA Y FECHA AUTOMATICA ========////
function obtenerFechaHoraActual() {
    const ahora = new Date();
    const anio = ahora.getFullYear();
    const mes = (ahora.getMonth() + 1).toString().padStart(2, '0');
    const dia = ahora.getDate().toString().padStart(2, '0');
    const horas = ahora.getHours().toString().padStart(2, '0');
    const minutos = ahora.getMinutes().toString().padStart(2, '0');

    return `${anio}-${mes}-${dia}T${horas}:${minutos}`;
}

// Función para actualizar la fecha cada segundo
function actualizarFechaHora() {
    const campoFecha = document.getElementById('fecha');
    campoFecha.value = obtenerFechaHoraActual();
}

// Establecer la fecha actual al cargar la página
window.addEventListener('load', function () {
    actualizarFechaHora();
    // Actualizar la fecha cada segundo
    setInterval(actualizarFechaHora, 1000);
});

////====== FUNCION DE HORA Y FECHA AUTOMATICA ========////
function habilitarEdicion() {
    var inputs = document.querySelectorAll('input[type="number"]');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].removeAttribute('disabled');
    }
}

function editarProducto(id, nombre, categoria, descripcion) {

    document.getElementById('id_producto').value = id;
    document.getElementById('nombre').value = nombre;
    document.getElementById('descripcion').value = descripcion;


    var selectElement = document.getElementById('categoria');
    for (var i = 0; i < selectElement.options.length; i++) {
        if (selectElement.options[i].text === categoria) {

            selectElement.value = selectElement.options[i].value;
            break;
        }
    }
}

function editarUsuario(id,rut, nombre, apellido,  email, id_tipousuario) {
    document.getElementById('id_usuario').value = id;
    document.getElementById('rut').value = rut;

    document.getElementById('nombre').value = nombre;
    document.getElementById('apellido').value = apellido;

    document.getElementById('email').value = email;

    var selectElement = document.getElementById('id_tipousuario');
    for (var i = 0; i < selectElement.options.length; i++) {
        if (selectElement.options[i].text === id_tipousuario) {
            selectElement.value = selectElement.options[i].value;
            break;
        }
    }
}

function editarCiudad(id_ciudad, nombre_ciudad) {
    document.getElementById('id_ciudad').value = id_ciudad;
    document.getElementById('nombre_ciudad').value = nombre_ciudad;


}



function editarCategoria(id, nombre_categoria_producto) {

    document.getElementById('id_categoria_producto').value = id;
    document.getElementById('nombre_categoria_producto').value = nombre_categoria_producto;

}

function editarTipoUsuario(id, nombre) {

    document.getElementById('id_tipo_usuario').value = id;
    document.getElementById('nombre').value = nombre;

}

function editarEmpresa(id, nombre) {
    document.getElementById('id_empresa').value = id;
    document.getElementById('nombre_empresa').value = nombre;
}



