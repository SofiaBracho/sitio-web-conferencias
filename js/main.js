$(function() {

    /*if(document.getElementById('mapa')) {
        var map = L.map('mapa').setView([10.67166, -71.65339], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([10.67166, -71.65339]).addTo(map)
            .bindPopup('GLWebcamp <br/> Conferencia de Diseño Web')
            .openPopup()
    }*/

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
    // $('.invitado-info').colorbox({inline:true, width:"50%"});

});