document.addEventListener('DOMContentLoaded', () => {
    // 1. Elementos del DOM
    const contenedorMensajes = document.getElementById('contendorMensajes');
    const addSignatureBtn = document.getElementById('addsignature');
    const inputs = document.querySelectorAll('#formConteiner input:not([type="hidden"])');
    const selectDocumento = document.getElementById('motivo');

    // 2. Cargar el HTML del toast de forma asíncrona al iniciar
    async function cargarToastHTML() {
        try {
            const respuesta = await fetch('../../view/contenidoHTML.html');
            if (!respuesta.ok) {
                throw new Error('Error al cargar el contenido HTML');
            }
            const contenidoHtml = await respuesta.text();
            contenedorMensajes.innerHTML = contenidoHtml;
        } catch (error) {
            console.error('Error al cargar el contenido HTML:', error);
        }
    }

    // 3. Función para mostrar el toast
    function mostrarToast() {
        const mensajeError = document.getElementById('mensajeError1');
        if (mensajeError) {
            // Eliminar la clase de salida por si estaba activa y mostrar el toast
            mensajeError.classList.remove('toast-hide');
            mensajeError.classList.add('toast-show');

            // Configurar el temporizador para ocultar el toast después de 3 segundos
            setTimeout(() => {
                // Añadir la clase de salida y luego remover el toast del flujo
                mensajeError.classList.remove('toast-show');
                mensajeError.classList.add('toast-hide');

                // Después de que la animación de salida termine, ocultar el elemento
                setTimeout(() => {
                    mensajeError.style.display = 'none';
                }, 500000); // 500ms es la duración de la animación
            }, 5000);
        }
    }

    // 4. Lógica de validación y evento del botón
    addSignatureBtn.addEventListener('click', (e) => {
        e.preventDefault();
        let hayVacio = false;

        // Validar inputs
        inputs.forEach(input => {
            if (input.value.trim() === '') {
                hayVacio = true;
            }
        });

        // Validar el select
        if (selectDocumento && selectDocumento.value.trim() === '') {
            hayVacio = true;
        }

        if (hayVacio) {
            mostrarToast();
        } else {
            alert('Todos los campos están completos. Procediendo con la firma.');
            // Aquí podrías agregar la lógica para enviar el formulario o la firma
        }
    });

    // 5. Llamamos a la función de carga una única vez al inicio
    cargarToastHTML();
});

/* 
Mision: Entender como funciona los cambios al codigo sugeridos por la IA
*/