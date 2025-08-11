<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        #signatureCanvas {
            border: 1px solid #ffffff;
            width: 100%;
            height: 200px;
            touch-action: none; /* Evita el desplazamiento mientras se dibuja en móviles */
        }
        .form-check-input.form-check-lg {
            width: 1.5em; /* Aumenta el tamaño del radio button */
            height: 1.5em; /* Aumenta el tamaño del radio button */
            margin-right: 0.5em; /* Espacio entre el radio button y la etiqueta */
        }
        .form-group {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        #video {
            width: 100%;
            height: 300px;
            border: 1px solid black;
        }
        #result {
            margin-top: 20px;
            font-size: 20px;
            color: #FBBD00;
        }
        #qrInput {
            margin-top: 20px;
            font-size: 18px;
            padding: 10px;
            width: 80%;
        }

        label {
            text-align: center;
            font-weight: bolder;
            color: #FBBD00 ;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        input{
            text-align: center;
            margin-bottom: 3px;
        }

        option{
            text-align: center;
            background-color: grey;
            color: white;
        }

        h3{
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .required::before  {
            content: "*";
            color: rgb(253, 253, 253);
            font-weight: bold;
        }
        
    </style>
</head>
<body style="background-color: #352460 ; color: white;">


    <div class="container mt-4">
    
    <div class="text-right">
    <button type="button" class="btn btn-outline-warning" onclick="document.getElementById('loginDialog').showModal()">
        <i class="fa-solid fa-user-tie"></i>
    </button>
</div>

<!-- Dialog -->
<dialog id="loginDialog">
    <form id="loginForm" onsubmit="return loginUser(event)">
        <div class="modal-header">
            <h5 class="modal-title">Login</h5>
            <button type="button" class="btn-close" onclick="document.getElementById('loginDialog').close()"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="user" name="usuario" placeholder="Ingrese su usuario" required>
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="loginPassword" name="contrasena" placeholder="Ingrese su contraseña" >
            </div>
            <div id="errorMessage" class="text-danger" style="display: none;">Usuario o contraseña incorrectos</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="document.getElementById('loginDialog').close()">Cerrar</button>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </div>
    </form>
</dialog>

<script>
function loginUser(event) {
    event.preventDefault(); // Evitar el envío del formulario

    // Obtener los datos del formulario
    const usuario = document.getElementById('user').value;
    const contrasena = document.getElementById('loginPassword').value;

    // Enviar los datos a login.php usando AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Procesar la respuesta del servidor
            const response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                // Redirigir a la página de dashboard
                window.location.href = response.redirect;
            } else {
                // Mostrar el mensaje de error
                document.getElementById('errorMessage').innerText = response.message;
                document.getElementById('errorMessage').style.display = 'block';
            }
        }
    };

    xhr.send(`usuario=${encodeURIComponent(usuario)}&contrasena=${encodeURIComponent(contrasena)}`);
}
</script>






        <center><img src="logo.png" style="width: 35%;"></center>
        <br>
        <h3 class="text-center mb-4"><b>Formulario Registro Ingreso DataCenter.</b></h3>
        <form id="registroForm">
            
            <div class="form-row">
                
                <div class="form-group col-md-6">
                    <label for="tipo_documento" class="required">Tipo de Documento</label>
                    <select id="tipo_documento" class="form-control" name="tipo_documento" required>
                        <option value="" disabled>Selecciona tipo de documento</option>
                        <option value="cc" selected>Cédula de Ciudadanía</option>
                        <option value="documento_extranjero">Documento de Extranjería</option>
                    </select>

                </div>
                <div class="form-group col-md-6">
                    <label for="numero_documento" class="required">Número de Documento</label>
                    <input type="text" class="form-control" id="numero_documento" name="numero_documento" placeholder="Ingrese número de documento." maxlength="10" required>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const input = document.getElementById('numero_documento');
                            
                            input.addEventListener('input', function() {
                                // Permite solo números
                                this.value = this.value.replace(/\D/g, '');
                            });
                        });
                    </script> 

                </div>
                <div class="form-group col-md-12">
                   
                    <label for="nombre" class="required">Nombre</label>
                    <input type="text" class="form-control uppercase" id="nombre" name="nombre" placeholder="Ingrese nombre." required>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const input = document.getElementById('nombre');
                            
                            input.addEventListener('input', function() {
                                // Convierte el valor del campo a mayúsculas
                                this.value = this.value.toUpperCase();
                                
                                // Permite solo letras (y espacios si es necesario)
                                this.value = this.value.replace(/[^A-Z\s]/g, '');
                            });
                        });
                    </script>
                 
                </div>
            </div>

            <div class="form-row" >
                <div class="form-group col-md-6">
                    <label for="corre" class="required">Correo</label>
                    <input type="mail" id="correo" class="form-control" name="correo" placeholder="Ingrese el correo electronico" required> 
                </div>
                <div class="form-group col-md-6">
                    <label for="tipo_usuario" class="required">Tipo de Usuario</label>
                    <select id="tipo_usuario" class="form-control" name="tipo_usuario" required>
                        <option value="" disabled selected>Selecciona un tipo de usuario</option>
                        <option value="empleado">Empleado</option>
                        <option value="externo">Externo</option>
                    </select>

                    <script>
                        document.getElementById('tipo_usuario').addEventListener('change', function() {
                            let tipouser = this.value;

                            if (tipouser == 'empleado') {
                                document.getElementById('empresa').value = 'Jolifoods SAS';
                                document.getElementById('empresa').readOnly = true; // Corregido
                            } else {
                                document.getElementById('empresa').value = '';
                                document.getElementById('empresa').readOnly = false; // Hacerlo editable nuevamente si no es 'empleado'
                            }
                        });
                    </script>
                </div>
                
            </div>

            <!-- botones de entra y salida -->
            <div class="form-row">
                <div class="form-group col-md-12 d-flex justify-content-center">
                    <div class="d-flex flex-column align-items-center">
                        <button type="button" id="entradaButton" class="btn btn-warning" style="font-size: 20px; font-weight: bolder; width: 300px; color: white;"><i class="fa-solid fa-door-open"></i> Entrada</button>
                        <button type="button" id="salidaButton" class="btn mx-2 mt-3" style="font-size: 20px; font-weight: bolder; width: 300px; background-color: rgb(241, 78, 78); color: white; "><i class="fa-solid fa-door-closed" style="margin-right: 25px;"></i>Salida</button>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('entradaButton').addEventListener('click', function() {
                    document.getElementById('display1').style.display = '';
                    document.getElementById('display2').style.display = '';
                    document.getElementById('sendentrada').style.display = '';
                    document.getElementById('sendsalida').style.display = 'none';

                    
                      
                });  

                document.getElementById('salidaButton').addEventListener('click', function() {
                    document.getElementById('display1').style.display = 'none';
                    document.getElementById('display2').style.display = 'none';
                    document.getElementById('sendentrada').style.display = 'none';
                    document.getElementById('sendsalida').style.display = '';
                    
                      
                });  

            </script>

            <!-- datos que se ocultan segun el boton bloque 1 -->
            <div class="form-row" style="display: none;" id="display1">
                <div class="form-group col-md-6">
                    <label for="empresa" >Empresa</label>
                    <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Ingrese nombre de la empresa.">
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const input = document.getElementById('empresa');
                            
                            input.addEventListener('input', function() {
                                // Convierte el valor del campo a mayúsculas
                                this.value = this.value.toUpperCase();
                                
                                // Permite solo letras (y espacios si es necesario)
                                this.value = this.value.replace(/[^A-Z\s]/g, '');
                            });
                        });
                    </script>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombre_rack">Nombre del Rack</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nombre_rack" name="nombre_rack" placeholder="Ingrese nombre de DataCenter.">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="button" id="btn-leer-qr" data-toggle="modal" data-target="#qrModal" style="color: white;"><i class="fa-solid fa-qrcode" style="color: white;"></i> Leer QR</button>
                        </div>
                    </div>
                </div>

                <!-- Modal para escanear el código QR -->
                <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content" style="background-color: #352460f6;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="qrModalLabel">Escanear Código QR</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color: white;">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <video id="video" style="width: 100%;" autoplay></video>
                                <canvas id="canvas" style="display: none;"></canvas>
                                <p id="result">Escaneando...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal" style="color: white;"><i class="fa-solid fa-door-open"></i> Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <!-- datos que se ocultan segun el boton bloque 2 -->
            <div class="form-row" style="display: none;" id="display2">
                <div class="form-group col-md-12">
                    <label for="actividad">Actividad</label>
                    <select id="actividad" class="form-control" name="actividad" >
                        <option value="" disabled selected>Selecciona una actividad</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Revision">Revisión</option>
                        <option value="Aseo">Aseo</option>
                        <option value="Ingreso">Ingreso</option>
                    </select>
                </div>
                
            </div>

            <div class="form-group col-md-6 mx-auto">
                <?php
                date_default_timezone_set('America/Bogota');
                $fechaActual = date('Y-m-d H:i:s');
                ?>
                <div class="form-group col-md-12">
                    <label for="actividad">Horario</label>
                    <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $fechaActual; ?>" readonly>
                </div>
                <label for="observacion">Observación</label>
                <textarea class="form-control" id="observacion" name="observacion" rows="2"></textarea>
            </div>


            <div class="form-row">
                <div class="form-group col-md-12 d-flex justify-content-center">
                    <div class="d-flex flex-column align-items-center">
                        <small>
                            <input type="checkbox"  required> 
                            <a href="ttmd.html" class="required" target="_blank"> Aceptación de política de tratamiento de datos personales.</a>
                        </small>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12 d-flex justify-content-center">
                    <div class="d-flex flex-column align-items-center">
                        <small>
                            <input type="checkbox"  required> 
                            <a href="ddsr.html" class="required" target="_blank"> Aceptación descargue de responsabilidad ingreso datacenter.</a>
                        </small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="signatureCanvas" class="required">Firma</label>
                <canvas id="signatureCanvas" style="background-color: #0000001e; border-radius: 10px;"></canvas>
                <div class="d-flex justify-content-center mt-2">
                    <button type="button" class="btn btn-secondary col-md-3" id="clearCanvas"><i class="fa-solid fa-eraser"></i> Limpiar Firma</button>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" id="sendentrada" class="btn btn-warning col-md-6" style="color: white;display: none;"><i class="fa-solid fa-paper-plane" style="color: white;"></i> Enviar Entrada</button>
                <button type="submit" id="sendsalida" class="btn btn-danger col-md-6" style="color: white;display: none;"><i class="fa-solid fa-paper-plane" style="color: white;"></i> Enviar Salida</button>
            </div>    
        </form>
        <br>
        
    </div>

    <!-- Envio de datos a la base de datos y cavas de firma -->
    
        <script>
                $(document).ready(function() {
                // Inicializa la cámara QR
                let videoStream;

                $('#btn-leer-qr').on('click', function() {
                    $('#qrModal').on('shown.bs.modal', function () {
                        navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
                        .then(function(stream) {
                            videoStream = stream;
                            const video = document.getElementById('video');
                            video.srcObject = stream;
                            video.setAttribute("playsinline", true); // Requerido para iOS Safari
                            video.play();
                            requestAnimationFrame(scanQRCode);
                        })
                        .catch(function(error) {
                            console.error("No se pudo acceder a la cámara:", error);
                            document.getElementById('result').textContent = "No se pudo acceder a la cámara.";
                        });
                    });
                });

                $('#qrModal').on('hide.bs.modal', function () {
                    if (videoStream) {
                        let tracks = videoStream.getTracks();
                        tracks.forEach(function(track) {
                            track.stop();
                        });
                    }
                });

                function scanQRCode() {
                    const video = document.getElementById('video');
                    const canvas = document.getElementById('canvas');
                    const result = document.getElementById('result');

                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                        canvas.height = video.videoHeight;
                        canvas.width = video.videoWidth;
                        const context = canvas.getContext('2d');
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                        const code = jsQR(imageData.data, canvas.width, canvas.height, {
                            inversionAttempts: "dontInvert",
                        });

                        if (code) {
                            result.textContent = `Código QR detectado: ${code.data}`;
                            $('#qrModal').modal('hide');
                            document.getElementById('nombre_rack').value = code.data;
                            return;
                        }
                    }
                    requestAnimationFrame(scanQRCode);
                }

                // Manejo del envío del formulario
                $('#registroForm').on('submit', function(e) {
                    e.preventDefault(); // Evita el envío normal del formulario

                    var formData = new FormData(this);
                    var canvas = document.getElementById('signatureCanvas');
                    var processedCanvas = document.createElement('canvas'); // Canvas invisible para procesar la firma
                    var processedCtx = processedCanvas.getContext('2d');

                    // Configura el tamaño del canvas de procesamiento igual al canvas original
                    processedCanvas.width = canvas.width;
                    processedCanvas.height = canvas.height;

                    // Copia el contenido del canvas de firma
                    processedCtx.drawImage(canvas, 0, 0);

                    // Procesa la imagen para convertir el trazo blanco a negro y el fondo a blanco
                    var imageData = processedCtx.getImageData(0, 0, processedCanvas.width, processedCanvas.height);
                    for (var i = 0; i < imageData.data.length; i += 4) {
                        // Convertir blanco a negro
                        if (imageData.data[i] === 255 && imageData.data[i + 1] === 255 && imageData.data[i + 2] === 255) {
                            imageData.data[i] = 0; // Rojo
                            imageData.data[i + 1] = 0; // Verde
                            imageData.data[i + 2] = 0; // Azul
                        }
                    }
                    processedCtx.putImageData(imageData, 0, 0);

                    // Añadir la imagen procesada al FormData
                    formData.append('firma', processedCanvas.toDataURL('image/png'));

                    // Determina la URL del archivo PHP en función del botón presionado
                    var url = '';
                    var isEntrada = false;

                    if ($('#sendentrada').is(':visible') && $('#sendentrada').is(':focus')) {
                        url = 'conexion.php';
                        isEntrada = true; // Indica que es una entrada
                    } else if ($('#sendsalida').is(':visible') && $('#sendsalida').is(':focus')) {
                        url = 'conexion2.php';
                        isEntrada = false; // Indica que es una salida
                    }

                        if (url) {
                            $.ajax({
                                url: url, // Archivo PHP que procesará los datos
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    const jsonResponse = JSON.parse(response); // Analiza la respuesta JSON
                                    Swal.fire({
                                        icon: jsonResponse.status === 'success' ? 'success' : 'error',
                                        title: jsonResponse.status === 'success' ? 'Éxito' : 'Error',
                                        text: jsonResponse.message,
                                    }).then(() => {
                                        // Asegúrate de obtener el valor antes de limpiar el formulario
                                        const numeroDocumento = document.getElementById('numero_documento').value;

                                        // Solo redirigir si es entrada
                                        if (isEntrada) {
                                            window.location.href = `actapdf.php?numero_documento=${encodeURIComponent(numeroDocumento)}`;
                                        }

                                        // Limpia el formulario
                                        $('#registroForm')[0].reset();
                                        limpiarFirma();

                                        // Oculta elementos
                                        document.getElementById('display1').style.display = 'none';
                                        document.getElementById('display2').style.display = 'none';
                                        $('#sendentrada').hide();
                                        $('#sendsalida').hide();
                                    });
                                },
                                error: function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Hubo un problema al guardar los datos',
                                    });
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo determinar qué acción realizar.',
                            });
                    }

                });

                // Inicializa el lienzo para la firma
                var canvas = document.getElementById('signatureCanvas');
                var ctx = canvas.getContext('2d');
                var isDrawing = false;

                // Ajusta el tamaño del canvas según la resolución del dispositivo
                function setCanvasSize() {
                    const scale = window.devicePixelRatio || 1;
                    canvas.width = canvas.clientWidth * scale;
                    canvas.height = canvas.clientHeight * scale;
                    ctx.scale(scale, scale);
                }
                setCanvasSize();

                // Configura el color del trazo aquí
                ctx.strokeStyle = '#FFFFFF'; // Color blanco
                ctx.lineWidth = 2; // Ajusta el grosor del trazo si es necesario

                // Función para obtener la posición relativa al cuadro del canvas
                function getPosition(event) {
                    var rect = canvas.getBoundingClientRect(); // Obtiene las dimensiones del canvas
                    return {
                        x: (event.clientX - rect.left),
                        y: (event.clientY - rect.top)
                    };
                }

                // Manejo del inicio del dibujo
                function startDrawing(event) {
                    isDrawing = true;
                    var pos = getPosition(event);
                    ctx.beginPath();
                    ctx.moveTo(pos.x, pos.y);
                }

                // Manejo del proceso de dibujo
                function draw(event) {
                    if (!isDrawing) return;
                    var pos = getPosition(event);
                    ctx.lineTo(pos.x, pos.y);
                    ctx.stroke();
                }

                // Manejo del final del dibujo
                function stopDrawing() {
                    isDrawing = false;
                    ctx.closePath();
                }

                // Eventos de mouse
                canvas.addEventListener('mousedown', startDrawing);
                canvas.addEventListener('mousemove', draw);
                canvas.addEventListener('mouseup', stopDrawing);
                canvas.addEventListener('mouseout', stopDrawing);

                // Eventos de toque para dispositivos móviles
                canvas.addEventListener('touchstart', function(event) {
                    startDrawing(event.touches[0]);
                });
                canvas.addEventListener('touchmove', function(event) {
                    draw(event.touches[0]);
                });
                canvas.addEventListener('touchend', stopDrawing);

                // Manejo del evento de limpieza de la firma
                document.getElementById('clearCanvas').addEventListener('click', function(e) {
                    e.preventDefault(); // Previene el comportamiento por defecto
                    limpiarFirma();
                });

                document.getElementById('clearCanvas').addEventListener('touchstart', function(e) {
                    e.preventDefault(); // Previene el comportamiento por defecto en móviles
                    limpiarFirma();
                }, {passive: false}); // Asegura que no se capturen eventos táctiles no deseados

                function limpiarFirma() {
                    var canvas = document.getElementById('signatureCanvas');
                    var ctx = canvas.getContext('2d');
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                }
            });

        </script>

        
        

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
