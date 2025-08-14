# 😎 Work's practices 

## 🦾 Tips to JS

1. Remember that is so important when you are working whit DOM write in the .js this: 

        document.addEventListener("DOMcontentLoaded" ()=>{//HERE THE DOM CODE});

this is to load all of DOM. There exist other DOM objet like: target, currentTarget, event, etc.

💥target is the element that triggered the event.

2. Remember that a promies is when you're waiting for a response. There exist a lot exambles: 

💥 asyc: makes a fuction asynchronous, meaning it will return a promise.
💥 await: is used to wait for a promise to resolve before continuing with the code. 
💥 fetch: is used to make a request to a server and return a promise.
💥 text: is used to convert a response to text.

3. querySelector('') taje the first element with a specific id and return just it, 
unless querySelectorAll('') return a NodeList with all elements with the id

## Canvas

1. Canvas is a drawing space controling by javaScript

2. We need context to work, for example we work in 2d or 3d

3. All we draw isn't HTML, else pixels

### 🔴 Example: 

                <canvas id="miCanvas" width="300" height="150"></canvas>
                <script>
                        const canvas = document.getElementById("miCanvas");
                        const ctx = canvas.getContext("2d");

                        ctx.fillStyle = "blue";
                        ctx.fillRect(10, 10, 100, 50);
                </script>

4. steps: 

🟠 Create first the space where we can draw 

                <canvas id="firma" width="500" height="200"></canvas>
                <canvas id="firma" width="500" height="200"></canvas>
                <br>
                <button id="limpiar">Limpiar</button>
                <button id="guardar">Guardar</button>

🟠 After that create a script 

🟠 Later get the id and after that create the context 

                const canvas = document.getElementById("firma");
                const ctx = canvas.getContext("2d");

🟠 We need the structure of the lines, then: 
        
                ctx.lineWidth = 2;
                ctx.lineCap = "round";
                ctx.strokeStyle = "#000";
        
🟠🟡 lineWidth difine a width

☀️Pro tip: For signatures is better use lineWidth beteween 1.5 and 3 and lineCap "round"

🟠🟡 lineCap difine the curves

🟠🟡 strokeStyle difine the color 

🟠 If we need translate to our pc the side and position of our canvas in the window we need
write: 

              const rect = canvas.getBoundingClientRect();



### 🟠 Figures 

--> Lines commands

                tx.beginPath(); // Begin a new stroke
                ctx.moveTo(x1, y1); // Move the pen without drawing
                ctx.lineTo(x2, y2); // Draw to this position
                ctx.stroke(); // Paint the stroke
                ctx.closePath(); // Close the shape

--> Rectangles commands 

                ctx.fillStyle = "red"; // Fill color
                ctx.fillRect(x, y, width, height); // Fill

                ctx.strokeStyle = "blue"; // Border color
                ctx.strokeRect(x, y, width, height); // Border only

                ctx.clearRect(x, y, width, height); // Clear area

---> arcs and circles

                ctx.beginPath();
                ctx.arc(cx, cy, radius, angStart, angEnd); // radians
                ctx.stroke();

### ---> 🔥To draw it you need to understand how works the randians: Write MathPI*(HERE THE METRIC: 1/4,1/6,...,2)🔥 

## ‼️EXPORT CANVAS

                canvas.toDataURL("image/png"); // retrun the image in Base64
                canvas.toDataURL("image/jpeg", 0.8); // JPEG 80%

### ---> 🔥The next example code is using to redraw our draw and save it🔥

                //4. Función para redibujar las coordenadas guardadas
                static redibujar(ctx) {
                        ctx.beginPath();
                        //Recorremos las coordenadas guardadas
                        this.trazos.forEach(trazo => {
                            //Nos movemos a la primera posición del trazo
                            ctx.moveTo(trazo[0].x, trazo[0].y);
                            //Recorremos cada punto del trazo
                                trazo.forEach(punto => {
                                //Creamos una linea hasta cada punto
                                ctx.lineTo(punto.x, punto.y);
                                });
                        });
                        //Dibujamos el trazo
                        ctx.stroke();
                    }

## 🟣 To remain: 

beginPath() → Starts a new stroke.

moveTo(x,y) → Moves the pen without drawing.

lineTo(x,y) → Draws from the last position.

stroke() → Draws the line.

closePath() → Closes the current stroke.

toDataURL() → Converts the drawing to a Base64 image.

fill() →  The browser fills the area bounded by that path, using the color or style defined in:

### ☀️Tip: use this only when you define the area. 


### Example:
                ctx.beginPath();
                ctx.arc(50, 50, 20, 0, Math.PI * 2); // A circle

### Then write 

                ctx.fill()

getBoundingClientRect() → This return the position and sides of the canvas in the window (viewport). This is using to translate coordenates from the event
to relative Canvas coordenates 

# ERROR MESSAGES ❌ 

If you want to create a profesional error messages you should try: 

                try{
                        //(TRY THIS AND IF EXIST A PROBLEM CATCH A ERROR)
                        if(condition){
                                thorw new Error("Error description");
                        }
                        LOGIC
                }catch(error){
                        console.log("ERROR",error)
                }
