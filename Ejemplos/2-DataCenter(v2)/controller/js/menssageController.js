export class menssageController {
    static async cargarContenidoHTML(contenedorMensajes) {
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
    static mostrarToast(mensajeError){
        //Verifica que tengun un valor truthy
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
                }, 500); // 500ms es la duración de la animación
            }, 5000);
        }
    }
}