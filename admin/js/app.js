$(function () {
    $("#registros").DataTable({
      "paging": true,
      "pageLength": 10,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "language": {
          paginate: {
              next: 'Siguiente',
              previous: 'Anterior',
              last: 'Último',
              first: 'Primero'
          },
          info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
          emptyTable: 'No hay registros',
          infoEmpty: '0 registros',
          search: 'Buscar: '
      }
    });

    $('#crear_registro_admin').attr('disabled', true);

    $("#repetir_password").on('input', function() {
        let nuevo_password = $("#password").val();
        
        if($(this).val() == nuevo_password) {
            $("#resultado-password").text('¡Correcto!');
            $("#resultado-password").parents('.form-group').addClass('has-success').removeClass('has-error');
            $("#password").parents('.form-group').addClass('has-success').removeClass('has-error');
            $('#crear_registro_admin').attr('disabled', false);
        } else {
            $("#resultado-password").text('Los campos no coinciden');
            $("#resultado-password").parents('.form-group').addClass('has-error').removeClass('has-success');
            $("#password").parents('.form-group').addClass('has-error').removeClass('has-success');
            $('#crear_registro_admin').attr('disabled', true);
        }
    });

    //Date range picker
    $('#fecha').datetimepicker({
        format: 'L'
    });
    //Initialize Select2 Elements
    $('.seleccion').select2()
    //Timepicker
    $('#hora').datetimepicker({
      format: 'LT'
    })

    // $('#icono').iconpicker();

    //-------------
    //- LINE CHART -
    //--------------
    $.getJSON('servicio-grafico.php', function(data) {
        var areaChartData = {
        labels  : data.fecha,
        datasets: [
            {
            label               : 'Digital Goods',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : data.cantidad
            },
        ]
        }

        var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                gridLines : {
                    display : false,
                }
                }],
                yAxes: [{
                gridLines : {
                    display : false,
                }
                }]
            }
            }

            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
            var lineChartData = jQuery.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, { 
            type: 'line',
            data: lineChartData, 
            options: lineChartOptions
        })
    });
    
    
});