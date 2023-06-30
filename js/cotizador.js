(function() {
    "use strict";

    const regalo = document.getElementById('regalo');
    document.addEventListener('DOMContentLoaded', function(){

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

            let formulario_editar = document.getElementsByClassName('editar-registrado');
            if(formulario_editar.length > 0) {
                if(pase_dia.value || pase_completo.value || pase_dosdias.value) {
                    mostrarDias();
                }
            }

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
                    document.getElementById('viernes').style.display = 'flex';
                    document.getElementById('sabado').style.display = 'flex';
                    document.getElementById('domingo').style.display = 'flex';
                }
                else if(boleto2Dias>=1) {
                    document.getElementById('viernes').style.display = 'flex';
                    document.getElementById('sabado').style.display = 'flex';
                    document.getElementById('domingo').style.display = 'none';
                }
                else if(boletoDia>=1) {
                    document.getElementById('viernes').style.display = 'flex';
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