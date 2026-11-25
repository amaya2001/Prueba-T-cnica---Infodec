// Estado de carga: al enviar el formulario, desactiva el botón y cambia su texto.
// El evento "submit" solo ocurre si el navegador ya validó el campo obligatorio.
const formulario = document.querySelector('form');

if (formulario) {
    formulario.addEventListener('submit', function () {
        const boton = formulario.querySelector('button');
        boton.disabled = true;
        boton.textContent = 'Consultando…';
    });
}
