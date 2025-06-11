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

// Mostrar alerta al añadir al carrito
$('.btn-editar-comentario').on('click', function() {
    var comentarioId = $(this).data('id');
    var contenido = $(this).data('contenido');
    $('#comentario_contenido').val(contenido);

    $('#formEditarComentario').attr('action', '/comentarios/' + comentarioId);
});

// Mostrar modal de edición de comentario
      var updateUrl = "{{ route('comentarios.update', ':id') }}";

    
      $('#editarComentarioModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); 
          var id = button.data('id'); 
          var contenido = button.data('contenido'); 
  
          $('#contenidoComentario').val(contenido);
  
          var actionUrl = updateUrl.replace(':id', id);
          $('#formEditarComentario').attr('action', actionUrl);
      });
  
