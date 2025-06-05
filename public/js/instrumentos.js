const selectTipo = document.getElementById('tipo');
const inputModelo = document.getElementById('modelo');
const inputPrecio = document.getElementById('precioMax');
const precioValueBox = document.getElementById('precioValueBox');
const tarjetas = document.querySelectorAll('.instrumento-tarjeta');

// Actualizar valor del slider al moverlo
inputPrecio.addEventListener('input', function () {
    precioValueBox.textContent = this.value + "€";
    filtrarInstrumentos();
});

// Eventos de filtro
selectTipo.addEventListener('change', filtrarInstrumentos);
inputModelo.addEventListener('input', filtrarInstrumentos);

function filtrarInstrumentos() {
    const tipo = selectTipo.value.toLowerCase();
    const modelo = inputModelo.value.toLowerCase();
    const precioMax = parseInt(inputPrecio.value);

    tarjetas.forEach(function (tarjeta) {
        const tarjetaTipo = tarjeta.getAttribute('data-tipo').toLowerCase();
        const tarjetaModelo = tarjeta.getAttribute('data-modelo');
        const tarjetaPrecio = parseFloat(tarjeta.getAttribute('data-precio'));

        const pasaTipo = !tipo || tarjetaTipo === tipo;
        const pasaModelo = !modelo || tarjetaModelo.includes(modelo);
        const pasaPrecio = tarjetaPrecio <= precioMax;

        if (pasaTipo && pasaModelo && pasaPrecio) {
            tarjeta.style.display = '';
        } else {
            tarjeta.style.display = 'none';
        }
    });
}

precioValueBox.textContent = inputPrecio.value + "€";
filtrarInstrumentos();