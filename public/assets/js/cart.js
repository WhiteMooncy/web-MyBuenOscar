function actualizarCantidad(index, accion) {
    fetch('actualizar_carrito.php', {
        method: 'POST',
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `index=${index}&accion=${accion}`
    }).then(() => location.reload());
}

function editarItem(index) {
    alert('Función para editar el ítem ' + index);
}

function continuarCompra() {
    alert('Redirigiendo a la página de pago...');
}