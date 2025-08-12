document.addEventListener('DOMContentLoaded', () => {
    const contenedor = document.getElementById('contendorMensajes');
    const addSignatureBtn = document.getElementById('addsignature');
    const inputs = document.querySelectorAll('#formConteiner input');

    // Cargar el toast desde el HTML externo
    async function cargarToastHTML() {
        try {
            const respuesta = await fetch('view/contenidoHTML.html');
            const contenidoHtml = await respuesta.text();
            contenedor.innerHTML = contenidoHtml;
            mostrarToast();
        } catch (error) {
            console.log('Error al cargar el contenido HTML:', error);
        }
    }

    // Mostrar el toast y ocultarlo después de 3 segundos
    function mostrarToast() {
        const mensajeError1 = document.getElementById('mensajeError1');
        if (mensajeError1) {
            mensajeError1.style.display = 'flex';
            setTimeout(() => {
                mensajeError1.style.display = 'none';
            }, 3000);
        }
    }

    addSignatureBtn.addEventListener('click', (e) => {
        e.preventDefault();
        let hayVacio = false;
        inputs.forEach(input => {
            if (input.value.trim() === '') {
                hayVacio = true;
            }
        });
        if (hayVacio) {
            cargarToastHTML();
        }else{
            alert('Todos los campos están completos. Procediendo con la firma.');
        }
    });
});
/* 
Vamos a llamar del contrnido HTML.php todo el contenido 
html para mostrarlo en el index.php
*/