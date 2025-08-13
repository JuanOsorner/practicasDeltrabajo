<?php
header('Content-Type: text/html; charset=UTF-8');
$valorid = $valorid ?? '';
$nombre = $nombre ?? '';
$empresa = $empresa ?? '';
$identificacion = $identificacion ?? '';
$placa = $placa ?? '';
$tipoDocumento = $tipoDocumento ?? '';
$ARL = $ARL ?? '';
$fecha = $fecha ?? date('Y-m-d');
$hora = $hora ?? date('H:i');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Acceso Datacenter - Jolifoods SAS</title>
    <meta name="description" content="Registro y descargo de responsabilidad de ingreso al datacenter de Jolifoods SAS" />
    <link rel="stylesheet" href="model/index.css">
</head>

<body>

    <!-- MENÚ VERTICAL -->
    <nav id="side-nav" aria-label="Navegación principal">
        <div class="nav-top" style="display: flex; align-items: center; gap: 10px;">
            <img src="model/src/logoJolifoods.png" alt="Logo Jolifoods" class="nav-logo">
            <h1 class="nav-brand">Jolifoods</h1>
        </div>

        <ul class="nav-list">
            <li class="nav-item"><a class="nav-link active" href="#main-content">Registro</a></li>
            <li class="nav-item"><a class="nav-link" href="#policies">Políticas</a></li>
            <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
            <li class="nav-item"><a class="nav-link" href="#help">Ayuda</a></li>
        </ul>

        <div class="nav-bottom">
            <small class="nav-copy">© <?php echo date('Y'); ?> Jolifoods SAS</small>
        </div>
    </nav>

    <!-- Content: desplazado por el ancho del side-nav -->
    <div class="content">
        <div class="center-wrap">
            <main id="main-content" role="main" aria-labelledby="welcome-title">
                <div class="welcome-wrap">
                    <h2 id="welcome-title" class="welcome-title">Data Center Jolifoods</h2>
                </div>

                <section class="form-card" aria-label="Formulario de registro de acceso">
                    <form id="access-form" action="process_access.php" method="post" novalidate>
                        <input type="hidden" name="valorid" id="valorid" value="<?php echo htmlspecialchars($valorid); ?>">

                        <div id="formConteiner" class="form-container">
                            <div class="disclaimer">
                                <h3>Descargo de responsabilidad - Ingreso al Datacenter</h3>
                                <p>
                                    Al firmar y registrarse, acepto cumplir con las normas de seguridad del datacenter de Jolifoods SAS,
                                    no introducir equipos no autorizados, seguir las indicaciones del personal y aceptar la verificación de
                                    identidad y pertenencias. Declaro que la información que presento es veraz.
                                </p>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nombre">Nombre de quien ingresa</label> <br> <hr> <br>
                                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="empresa">Autorizado por</label> <br> <hr> <br>
                                    <input type="text" id="empresa" name="empresa" value="<?php echo htmlspecialchars($empresa); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="identificacion">Tipo y número de identificación</label> <br> <hr> <br>
                                    <table class="tabla-identificacion">
                                        <tr>
                                            <td style="padding:0; border:none; width:1%; vertical-align:middle;">
                                                <select id="motivo" name="motivo" class="select-documento">
                                                    <option value=""></option>
                                                    <option value="CC" <?php echo ($tipoDocumento === 'CEDULA') ? 'selected' : ''; ?>>CC</option>
                                                    <option value="TI" <?php echo ($tipoDocumento === 'TARJETA IDENTIDAD') ? 'selected' : ''; ?>>TI</option>
                                                    <option value="PP" <?php echo ($tipoDocumento === 'PASAPORTE') ? 'selected' : ''; ?>>PP</option>
                                                </select>
                                            </td>
                                            <td style="padding:0 0 0 8px; border:none; vertical-align:middle; width:99%;">
                                                <input type="number" id="identificacion" name="identificacion" value="<?php echo htmlspecialchars($identificacion); ?>">
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <label for="placa">Empresa</label> <br> <hr> <br>
                                    <input type="text" id="placa" name="placa" value="<?php echo htmlspecialchars($placa); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="motivo">ARL</label> <br> <hr> <br>
                                    <input type="text" id="ARL" name="ARL" value = "<?php echo htmlspecialchars($ARL); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="fecha">Fecha</label> <br> <hr> <br>
                                    <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="hora">Hora de entrada</label> <br> <hr> <br>
                                    <input type="time" id="hora" name="hora" value="<?php echo htmlspecialchars($hora); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="hora">Hora de salida</label> <br> <hr> <br>
                                    <input type="time" id="hora" name="hora" value="<?php echo htmlspecialchars($hora); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="hora">Añadir evidencia</label> <br> <hr> <br>
                                    <button type="button" id="añadirEvidencia" class="btn btn-img">
                                        añadir evidencia
                                    </button>
                                </div>
                            </div>

                            <div class="signature-section">
                                <!-- Cuadro de texto Motivo encima de la firma -->
                                <div class="motivo-section">
                                    <label for="motivo-firma" style="font-weight:600; font-size:0.9rem; margin-bottom:8px; display:inline-block;">Motivo</label>
                                    <textarea name="cuadroTexto" id="cuadroTexto" rows="5" cols="40"></textarea>
                                </div>
                                <div class="signature-duo" style="display: flex; gap: 24px; justify-content: center;">
                                    <div class="signature-block">
                                        <label for="signature-pad-usuario">Firma de usuario:</label>
                                        <div class="signature-pad-wrap">
                                            <canvas id="signature-pad-usuario" width="600" height="160" aria-label="Área para firma de usuario"></canvas>
                                        </div>
                                        <div class="signature-controls">
                                            <button type="button" id="clear-signature-usuario" class="btn btn-exit">Borrar firma usuario</button>
                                            <input type="hidden" name="signature-usuario" id="signature-data-usuario" value="">
                                        </div>
                                    </div>
                                    <div class="signature-block">
                                        <label for="signature-pad-responsable">Firma de responsable:</label>
                                        <div class="signature-pad-wrap">
                                            <canvas id="signature-pad-responsable" width="600" height="160" aria-label="Área para firma de responsable"></canvas>
                                        </div>
                                        <div class="signature-controls">
                                            <button type="button" id="clear-signature-responsable" class="btn btn-exit">Borrar firma responsable</button>
                                            <input type="hidden" name="signature-responsable" id="signature-data-responsable" value="">
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: center; margin-top: 24px;">
                                    <button type="button" id="addsignature" class="btn btn-entry">Finalizar formulario</button>
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="checkbox-label">
                                    <input type="checkbox" id="acepto" name="acepto" required>
                                    Acepto el descargo de responsabilidad y las políticas de seguridad del Datacenter.
                                </label>
                            </div>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </div>
    <!--Aqui vamos a cargar todo el contenido HTML-->
    <div id="contendorMensajes"></div>
    <!--SCRIPTS-->
    <script type="module" src="controller/js/menssageController.js"></script>
    <script type="module" src="controller/js/canvasController.js"></script>
    <script type="module" src="controller/js/main.js"></script>
</body>
</html>
