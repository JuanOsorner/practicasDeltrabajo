export class botones{
    static dinamicaBotonEvidencia(){
        //Aqui colocamos la logica del boton de agregar evidencia
    }
    static dinamicaBotonBorrarFirma(canvas,ctx,id){
        try{
            if(id !== 'clear-signature-usuario' && id !== 'clear-signature-responsable'){
                throw new Error("‼️ Revisar modulo de mensajes"+
                    "\n \n ➡️ El id del boton de borrar firma usuario no coincide"+ 
                    "con el esperado");
            }
            document.getElementById(id).addEventListener('click', (e) => {
                // Evitamos que el boton recargue la pagina
                e.preventDefault();
                //Limpiamos el canvas
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            });
        }catch(error){
            console.log("ERROR AL INICIALIZAR EL BOTON DE BORRAR: ",error.message)
        }
    }
    static dinamicaBotonGuardarFirma(){
        //Aqui colocamos la logica del boton de guardar firma
    }
    static botonFinalizarFormulario(idMenERROR,idBtn,idinput,idSelect){
        try{
            if(idBtn !== 'addsignature' || idinput !== '#formConteiner input:not([type="hidden"])' 
                || idSelect !== 'tipo_documento'){
                    throw new Error("‼️ Revisar el modulo de mensajes"+
                        "\n ➡️ Error en correspondencia de los ids (boton,input,select)");
            }
            //Logica para mostrar mensaje cualquiera
            document.getElementById(idBtn).addEventListener('click', (e)=>{
                e.preventDefault();
                let hayVacio = false;
                //RECORDAR QUE DEBEMOS TOMAR TODOS LOS OBJETOS
                document.querySelectorAll(idinput).forEach(input => {
                    if(input.value.trim() === ''){
                        hayVacio = true;
                    }
                    const selectDocumento = document.getElementById(idSelect);
                    if(selectDocumento && selectDocumento.value.trim() === ''){
                        hayVacio = true;
                    }
                    if(hayVacio){
                        //Esto puede devolver NULL
                        return document.getElementById('mensajeError');
                    }
                });
            });
        }catch(error){
            console.log("ERROR AL INICIALIZAR EL BOTON FINALIZAR FORMULARIO: ", error.message);
        }
    }
}