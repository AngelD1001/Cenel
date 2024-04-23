// Asigna un event listener a todos los botones de producto al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.producto').forEach(boton => {
        boton.addEventListener('click', function() {
            const producto = {
                id: this.getAttribute('data-id'),
                nombre: this.textContent,
                precio: parseFloat(this.getAttribute('data-precio')) // Asegúrate de incluir el precio en el botón o de alguna otra forma accesible
            };
            agregarProductoALista(producto);
        });
    });
});

function agregarProductoALista(producto) {
  const productoExistente = document.querySelector('#product-item-' + producto.id);
  if (!productoExistente) {
    const productList = document.getElementById('product-list');
    const item = document.createElement('div');
    item.className = 'product-item';
    item.id = 'product-item-' + producto.id;
    
    // Aquí puedes usar el precio del producto que obtuviste de la base de datos
    const precioProducto = producto.precio;
    
    item.innerHTML = `
      <div class="product-actions">
          <button onclick="cambiarCantidad(${producto.id}, 1)">+</button>
          <span id="cantidad-${producto.id}">1</span>
          <button onclick="cambiarCantidad(${producto.id}, -1)">−</button>
      </div>
      <div class="product-info">
          ${producto.nombre}<br>
          $/unidad: ${precioProducto.toLocaleString('es-CL', { style: 'currency', currency: 'CLP' })}
      </div>
      <div class="product-price" id="precio-${producto.id}">
          ${precioProducto.toLocaleString('es-CL', { style: 'currency', currency: 'CLP' })}
      </div>
      <div class="product-remove">
          <button onclick="eliminarProducto(${producto.id})"><i class="ri-delete-bin-6-line"></i></button>
      </div>
    `;
    productList.appendChild(item);
  } else {
    cambiarCantidad(producto.id, 1); // Aumentar la cantidad si el producto ya existe
  }
  document.getElementById('resultados-busqueda').style.display = 'none';
  actualizarTotal();
}

function cambiarCantidad(idProducto, cambio) {
    const cantidadElement = document.getElementById('cantidad-' + idProducto); // Corrección aquí
    let cantidadActual = parseInt(cantidadElement.textContent, 10);
    cantidadActual += cambio;
    if (cantidadActual < 1) cantidadActual = 1; // Para no tener cantidad negativa
    cantidadElement.textContent = cantidadActual;
    // Actualizar el precio total aquí si es necesario
}

function eliminarProducto(idProducto) {
    const item = document.getElementById('product-item-' + idProducto); // Corrección aquí
    if (item) {
        item.parentNode.removeChild(item);
    }
    // Actualizar el total aquí si es necesario
}

function actualizarTotal() {
  const productosEnLista = document.querySelectorAll('.product-item');
  let total = 0;
  productosEnLista.forEach(item => {
    const id = item.id.split('-')[2];
    const precio = productos.find(producto => producto.id == id).precio;
    const cantidad = parseInt(document.getElementById(`cantidad-${id}`).innerText);
    total += precio * cantidad;
  });
  document.getElementById('total-compra').innerText = total.toLocaleString('es-CL', { style: 'currency', currency: 'CLP' });
}



// TURNO CONFIRMAR SWEET ALERT
// script.js
function toggleTurno() {
  Swal.fire({
    title: "¿Estás seguro de confirmar el pago?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, confirmar",
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Se ha confirmado el pago",
        icon: "success"
      });
    }
  });
}