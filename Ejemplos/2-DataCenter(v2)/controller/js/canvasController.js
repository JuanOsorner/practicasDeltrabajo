export class canvasController{
    //Creamos la variable booleana interna para controlar el estado del dibujo
    //Creamos la lista para guardar las coordenadas y poder borrar el trazo
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
    static empezarDibujo(e,canvas,ctx){
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
        //Si no estamos dibujando no hacemos nada
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
/*
Retrospectiva: Lo que hace este codigo es: 

1. Creamos un metodo para encontrar la posición del puntero o dedo en el canvas. 

✳️ Usamos matematicas sencillas del plano cartesiano para calcular la 
posición del mouse o dedo en el canvas.

✳️ Si el canvas inicia en x0 pixel y el puntero esta en x1 pixel entonces tomamos la distancia para
ubicar el puntero en el canvas.

✳️ nos ubicamos

2. Logica del dibujo 

➡️ Creamos una variable booleana para controlar el estado del dibujo

(*) Ejemplo: Cuando dibujamos en la vida real, cambiamos del estado de no dibujar a dibujar.

➡️ La función empezarDibujo inicia cuando hacemos click o tocamos el canvas

(*) Esta función cambia el estado de no dibujar a dibujar 
y nos ubica en la posición del canvas.

➡️ La función dibujar se activa cuando movemos el mouse o el dedo sobre el canvas, sino 
retorna para no hacer nada.

➡️ La función terminarDibujo cambia el estado de dibujar a no dibujar.
*/