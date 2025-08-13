export class canvasController{
    //Le metemos el canvas
    static dibujando = false;
    //1. Debemos encontrar la posición del dedo o el mouse
    static tomarPosicion(e,canvas){
        const tect = canvas.getBoundingClientRect();
        //La e la tomamos desde el main
        //Verificamos valor truthy
        if(e.touches){
            return {
                x : e.touches[0].clientX - tect.left,
                y : e.touches[0].clientY - tect.top
            }
        }else{
            return{
                x : e.clientX - tect.left,
                y : e.clientY - tect.top
            };
        }
    }
    //2. Función para iniciar el dibujo
    static empezarDibujo(e,ctx){
        this.dibujando = true;
        //Se calcula la posición del mouse o dedo
        const pos = this.tomarPosicion(e, canvas);
        //Inicia un nuevo camino
        ctx.beginPath();
        //Nos movemos a la ubicación
        ctx.moveTo(pos.x, pos.y);
    }
    //3. Función para dibujar
    static dibujar(e,canvas,ctx){
        if(!this.dibujando)return;
        //Se calcula la posición del mouse o dedo
        const pos = this.tomarPosicion(e,canvas);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }
    static terminarDibujo(){
        //Recordar que cuando llamamos las variables y metodos internos usamos this.
        this.dibujando = false;
    }

}
//Misión repasar el codigo.