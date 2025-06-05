function mostrarAlertaCarrito() {
    const alerta = document.getElementById('alertaCarrito');
    alerta.style.display = 'block';
    alerta.style.opacity = '1';
    setTimeout(() => {
        alerta.style.transition = 'opacity 1s';
        alerta.style.opacity = '0';
    }, 2000);
    setTimeout(() => { alerta.style.display = 'none'; }, 3000);
}

$('#editarComentarioModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que abre el modal
    var comentarioId = button.data('id');
    var comentarioContenido = button.data('contenido');
    var modal = $(this);
    modal.find('#comentario_id').val(comentarioId);
    modal.find('#comentario_contenido').val(comentarioContenido);

    var action = "{{ url('/comentarios') }}/" + comentarioId;
    modal.find('#formEditarComentario').attr('action', action);
});

$('.btn-editar-comentario').on('click', function() {
    var comentarioId = $(this).data('id');
    var contenido = $(this).data('contenido');
    $('#comentario_contenido').val(contenido);

    // Cambia la acción del formulario al endpoint correcto
    $('#formEditarComentario').attr('action', '/comentarios/' + comentarioId);
});
