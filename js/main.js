(function() {
    "use strict";

    const regalo = document.getElementById('regalo');
    document.addEventListener('DOMContentLoaded', function(){

        if(document.getElementById('mapa')) {
            var map = L.map('mapa').setView([10.67166, -71.65339], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([10.67166, -71.65339]).addTo(map)
                .bindPopup('GLWebcamp <br/> Conferencia de Diseño Web')
                .openPopup()
        }

        // Campos datos usuario
        let nombre = document.getElementById('nombre');
        let apellido = document.getElementById('apellido');
        let email = document.getElementById('email');

        // Campos pases 
        let pase_dia = document.getElementById('pase_dia');
        let pase_dosdias = document.getElementById('pase_dosdias');
        let pase_completo = document.getElementById('pase_completo');

        // Botones y divs
        let errorDiv = document.getElementById('error');
        let lista_productos = document.getElementById('lista-productos');
        let suma = document.getElementById('suma-total');
        let botonRegistro = document.getElementById('btnRegistro');
        let calcular = document.getElementById('calcular');

        // Extras

        let camisas = document.getElementById('camisa_evento');
        let etiquetas = document.getElementById('etiquetas');

        botonRegistro.disabled = true;

        if(document.getElementById('calcular')) {

            calcular.addEventListener('click', calcularMonto);

            pase_dia.addEventListener('blur', mostrarDias);
            pase_dosdias.addEventListener('blur', mostrarDias);
            pase_completo.addEventListener('blur', mostrarDias);

            nombre.addEventListener('blur', validarCampos);
            apellido.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarMail);


            function validarCampos(){
                if(this.value == '') {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = 'Este campo es obligatorio';

                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red';
                } else {
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                }
            }

            function validarMail() {
                if(this.value.indexOf('@') > -1) {
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                } else {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = 'Este campo debe tener un @';

                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red';
                }
            }

            function calcularMonto(event) {
                event.preventDefault();
                
                if(regalo.value === '') {
                    alert('Selecciona un regalo');
                    regalo.focus();
                }else {
                    let boletoDia = parseInt(pase_dia.value, 10) || 0,
                        boleto2Dias = parseInt(pase_dosdias.value, 10) || 0,
                        boletoCompleto = parseInt(pase_completo.value, 10) || 0,
                        cantCamisas = parseInt(camisas.value, 10) || 0,
                        cantEtiquetas = parseInt(etiquetas.value, 10) || 0;

                    let totalPagar = (boletoDia * 30) + (boleto2Dias * 45) + (boletoCompleto * 50) + ((cantCamisas * 10) * .93) + (cantEtiquetas * 2);

                    let listadoProductos = [];

                    if(boletoDia >= 1) {
                        listadoProductos.push(boletoDia + ' Pases por día');
                    }
                    if(boleto2Dias >= 1) {
                        listadoProductos.push(boleto2Dias + ' Pases por 2 días');
                    }
                    if(boletoCompleto >= 1) {
                        listadoProductos.push(boletoCompleto + ' Pases completos');
                    }
                    if(cantCamisas >= 1) {
                        listadoProductos.push(cantCamisas + ' Camisas');
                    }
                    if(cantEtiquetas >= 1) {
                        listadoProductos.push(cantEtiquetas + ' Paquetes de etiquetas');
                    }

                    lista_productos.innerHTML = '';

                    for(let i=0; i < listadoProductos.length; i++) {
                        lista_productos.innerHTML += listadoProductos[i] + '<br/>';
                    }

                    suma.innerHTML = '$ ' + totalPagar.toFixed(2);

                    botonRegistro.disabled = false;
                    document.getElementById('total_pagar').value = totalPagar;
                }
            }

            function mostrarDias() {
                let boletoDia = parseInt(pase_dia.value, 10) || 0,
                    boleto2Dias = parseInt(pase_dosdias.value, 10) || 0,
                    boletoCompleto = parseInt(pase_completo.value, 10) || 0;

                if(boletoCompleto>=1) {
                    document.getElementById('viernes').style.display = 'block';
                    document.getElementById('sabado').style.display = 'block';
                    document.getElementById('domingo').style.display = 'block';
                }
                else if(boleto2Dias>=1) {
                    document.getElementById('viernes').style.display = 'block';
                    document.getElementById('sabado').style.display = 'block';
                    document.getElementById('domingo').style.display = 'none';
                }
                else if(boletoDia>=1) {
                    document.getElementById('viernes').style.display = 'block';
                    document.getElementById('sabado').style.display = 'none';
                    document.getElementById('domingo').style.display = 'none';
                }
                else {
                    document.getElementById('viernes').style.display = 'none';
                    document.getElementById('sabado').style.display = 'none';
                    document.getElementById('domingo').style.display = 'none';
                }
            }
        }

    }) // DOM CONTENT LOADED
})();

$(function() {

    $('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');

    // Lettering
    $('.nombre-sitio').lettering();
    $('.nombre-sitio span').mouseenter(function() {
        this.style.color = 'red';
        this.style.top = '-10px';
    });
    $('.nombre-sitio span').mouseleave(function() {
        this.style.color = 'white';
        this.style.top = '10px';
    });

    // Menu fijo
    let windowHeight = $(window).height();
    let barraAltura = $('.barra').innerHeight();

    $(window).scroll(function() {
        let scroll = $(window).scrollTop();

        if(scroll > windowHeight) {
            $('.barra').addClass('fixed');
            $('body').css({'margin-top': barraAltura+'px'});
        } else {
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top': '0px'});
        }
    });

    // Menu de hamburguesa 
    $('.menu-movil').on('click', function() {
        $('.navegacion-principal').slideToggle();
    });

    
    if(windowHeight > 768) {
        $('.navegacion-principal').show();
    }

    // Programa de conferencias
    $('.programa-evento .info-curso').hide();
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').on('click', function() {

        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');

        $('.ocultar').hide();
        let enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);

        return false;
    });

    // Contador 
    let resumenLista = $('.resumen-evento');
    if(resumenLista.length>0) {
        $('.resumen-evento').waypoint(function() {
            $('.resumen-evento li:nth-child(1) p').animateNumber({ number: 6 }, 1200);
            $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 15 }, 1200);
            $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 3 }, 1500);
            $('.resumen-evento li:nth-child(4) p').animateNumber({ number: 9 }, 1500);
        }, {
            offset: '60%'
        });
    }

    //Cuenta Regresiva
    $("#dias").countdown("2020/06/01 08:00:00", function(event) {
        $(this).text(event.strftime('%D'));
    });
    $("#horas").countdown("2020/06/01 08:00:00", function(event) {
        $(this).text(event.strftime('%H'));
    });
    $("#minutos").countdown("2020/06/01 08:00:00", function(event) {
        $(this).text(event.strftime('%M'));
    });
    $("#segundos").countdown("2020/06/01 08:00:00", function(event) {
        $(this).text(event.strftime('%S'));
    });

    //Colorbox

    if($('.invitado-info')) {
        $('.invitado-info').colorbox({inline:true, width:"50%"});
    }
    

    



});