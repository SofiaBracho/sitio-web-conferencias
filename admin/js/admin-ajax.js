$(document).ready( function() {
    // Al enviar el formulario
    $('#guardar-registro').on('submit', function(e) {
        e.preventDefault();

        let datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                let resultado = data;

                console.log(data);

                if(resultado.respuesta == 'exito') {
                    swal({
                        type: 'success',
                        title: 'Correcto',
                        text: 'Se guardó correctamente'
                    })
                    setTimeout(function() { 
                        window.location.href = 'admin-area.php';
                    }, 2000);
                } else {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Hubo un error'
                    })
                }
            }
        });
    });

    // Cuando el formulario contiene un archivo
    $('#guardar-registro-archivo').on('submit', function(e) {
        e.preventDefault();

        let datos = new FormData(this);
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data) {
                let resultado = data;

                console.log(data);

                if(resultado.respuesta == 'exito') {
                    swal({
                        type: 'success',
                        title: 'Correcto',
                        text: 'Se guardó correctamente'
                    })
                    setTimeout(function() { 
                        window.location.href = 'admin-area.php';
                    }, 2000);
                } else {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Hubo un error'
                    })
                }
            }
        });
    });

    $('.borrar_registro').on('click', function(e) {
        e.preventDefault();

        let id = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');

        swal({
            title: '¿Estás seguro que deseas eliminar el ' + tipo + '?',
            text: 'No podrás revertirlo',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if(result.value) {
                // Borrar de la BD
                $.ajax({
                    type: 'post',
                    data: {
                        'id': id,
                        'registro': 'eliminar'
                    },
                    url: 'modelo-'+tipo+'.php',
                    dataType: 'json',
                    success: function(data) {
                        if(data.respuesta == 'exito') {
                            // Borrar del HTML
                            $('[data-id="'+data.id_eliminado+'"]').parents('tr').remove();

                            // Mostrar mensaje
                            swal({
                                title: '¡Borrado!',
                                text: 'El administrador ha sido borrado',
                                type: 'success'
                            })
                        } else {
                            swal({
                                title: 'Error',
                                text: 'Hubo un error',
                                type: 'error'
                            })
                        }
                    }
                });
            }
        })
    });
});