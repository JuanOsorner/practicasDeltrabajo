import { menssageController } from './menssageController.js';
import { canvasController } from './canvasController.js';
document.addEventListener('DOMContentLoaded', () => {
    //Aqui vamos a colocar toda la logica del negocio
    /*Mensajes de error */

    /*Cargar contenido DOM */
    const addSignatureBtn = document.getElementById('addsignature');
    const contenedorMensajes = document.getElementById('contendorMensajes');
    const inputs = document.querySelectorAll('#formConteiner input:not([type="hidden"])');
    const selectDocumento = document.getElementById('motivo');
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
            menssageController.mostrarToast(document.getElementById('mensajeError1'));
        } else {
            // Aquí puedes agregar la lógica para manejar el caso cuando todos los campos están completos
            console.log('Todos los campos están completos.');
        }
    });
    // Cargar el contenido HTML del toast al iniciar
    menssageController.cargarContenidoHTML(contenedorMensajes);
    
    /*-------------------*/

    /*Canvas*/
    // Aquí puedes agregar la lógica específica del canvasController si es necesario
    const canvas = document.getElementById('signature-pad-usuario');
    const ctx = canvas.getContext('2d');
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#000000';

    // Eventos para el ratón
    canvas.addEventListener('mousedown', (e) => {
        canvasController.empezarDibujo(e, canvas, ctx);
    });
    canvas.addEventListener('mousemove', (e) => {
        canvasController.dibujar(e, canvas, ctx);
    });
    canvas.addEventListener('mouseup', () => {
        canvasController.terminarDibujo();
    });

    // Eventos para pantallas táctiles
    canvas.addEventListener('touchstart', (e) => {
        e.preventDefault();
        canvasController.empezarDibujo(e, canvas, ctx);
    });
    canvas.addEventListener('touchmove', (e) => {
        e.preventDefault();
        canvasController.dibujar(e, canvas, ctx);
    });
    canvas.addEventListener('touchend', () => {
        canvasController.terminarDibujo();
    });
    //AQUI ES DONDE HACEMOS USO DE LAS e PARA LOS EVENTOS DEL CANVAS
});