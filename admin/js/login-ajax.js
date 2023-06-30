$(document).ready(function() {

    $('#login-admin').on('submit', function(e) {
        e.preventDefault();

        let datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {

                resultado = data;
                if(resultado.respuesta == 'exitoso') {
                    swal({
                        type: 'success',
                        title: 'Login correcto',
                        text: `¡Bienvenido ${resultado.usuario}!`
                    })
                    setTimeout(function() { 
                        window.location.href = 'admin-area.php';
                    }, 2000);
                } else {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Usuario o contraseña inválido'
                    })
                }
            }
        });
    });
});