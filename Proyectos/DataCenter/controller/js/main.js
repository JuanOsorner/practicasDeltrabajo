import { menssageController } from './menssageController.js';
import { canvasController } from './canvasController.js';
import { botones } from './botones.js';
document.addEventListener('DOMContentLoaded', () => {
    //Aqui vamos a colocar toda la logica del negocio

    /*--------(MODULO MENSAJES DE ERROR)--------------*/
    /*Cargar contenido DOM */
    const addSignatureBtn = document.getElementById('addsignature');
    const contenedorMensajes = document.getElementById('contendorMensajes');
    const inputs = document.querySelectorAll('#formConteiner input:not([type="hidden"])');
    const selectDocumento = document.getElementById('motivo');
    //NECESITO AJUSTAR ALGO AQUI
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
            menssageController.mostrarToast(document.getElementById('mensajeError'));
        } else {
            // Aquí puedes agregar la lógica para manejar el caso cuando todos los campos están completos
            console.log('Todos los campos están completos.');
        }
    });
    // Cargar el contenido HTML del toast al iniciar
    menssageController.cargarContenidoHTML(contenedorMensajes);
    /*---------------------------------*/
    
    /*--------(MODULO CANVAS)-----------*/
    /*Canvas*/
    const canvas = document.getElementById('signature-pad-usuario');
    const ctx = canvas.getContext('2d');
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#ffffffff';
    /*Canvas1*/
    const canvas1 = document.getElementById('signature-pad-responsable');
    const ctx1 = canvas1.getContext('2d');
    ctx1.lineWidth = 2;
    ctx1.lineCap = 'round';
    ctx1.strokeStyle = '#ffffffff';

    // Eventos para el ratón canvas: usamos e.
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

    // Eventos para el ratón canvas1: usamos e.
    canvas1.addEventListener('mousedown', (e) => {
        canvasController.empezarDibujo(e, canvas1, ctx1);
    });
    canvas1.addEventListener('mousemove', (e) => {
        canvasController.dibujar(e, canvas1, ctx1);
    });
    canvas1.addEventListener('mouseup', () => {
        canvasController.terminarDibujo();
    });

    // Eventos para pantallas táctiles canvas1
    canvas1.addEventListener('touchstart', (e) => {
        e.preventDefault();
        canvasController.empezarDibujo(e, canvas1, ctx1);
    });
    canvas1.addEventListener('touchmove', (e) => {
        e.preventDefault();
        canvasController.dibujar(e, canvas1, ctx1);
    });
    canvas1.addEventListener('touchend', () => {
        canvasController.terminarDibujo();
    });

    /*Botones para borrar y guardar firma*/

    /*Canvas*/
    botones.dinamicaBotonBorrarFirma(canvas,ctx,'clear-signature-usuario');
    /*Canvas1*/
    botones.dinamicaBotonBorrarFirma(canvas1,ctx1,'clear-signature-responsable');
    /*-------------------------*/
});