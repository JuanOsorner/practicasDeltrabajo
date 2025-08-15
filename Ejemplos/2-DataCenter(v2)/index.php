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
    <link rel="icon" type="image/png" href="model/src/logoJolifoods.png">
    <meta name="description" content="Registro y descargo de responsabilidad de ingreso al datacenter de Jolifoods SAS" />
    <link rel="stylesheet" href="model/index.css">
</head>
<body>
    <button id="toggle-btn" aria-label="Alternar menú">☰</button>

    <nav id="side-nav" class="collapsed" aria-label="Navegación principal">
        <div class="nav-top">
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

    <div class="content nav-collapsed">
        <div class="center-wrap">
            <main id="main-content" role="main" aria-labelledby="welcome-title">
                <div class="welcome-wrap">
                    <h2 id="welcome-title" class="welcome-title">Data Center Jolifoods</h2>
                </div>

                <section class="form-card" aria-label="Formulario de registro de acceso">
                    <form id="access-form" action="process_access.php" method="post" novalidate>
                        <input type="hidden" name="valorid" id="valorid" value="<?php echo htmlspecialchars($valorid); ?>">

                        <div class="form-container">
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
                                    <label for="nombre">Nombre de quien ingresa</label><hr>
                                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="empresa">Supervisado por</label><hr>
                                    <input type="text" id="empresa" name="empresa" value="<?php echo htmlspecialchars($empresa); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="identificacion">Tipo y número de identificación</label><hr>
                                    <table class="tabla-identificacion">
                                        <tr>
                                            <td style="width: auto; padding-right: 8px;">
                                                <select id="tipo_documento" name="tipo_documento" class="select-documento">
                                                    <option value=""></option>
                                                    <option value="CC" <?php echo ($tipoDocumento === 'CC') ? 'selected' : ''; ?>>CC</option>
                                                    <option value="TI" <?php echo ($tipoDocumento === 'TI') ? 'selected' : ''; ?>>TI</option>
                                                    <option value="PP" <?php echo ($tipoDocumento === 'PP') ? 'selected' : ''; ?>>PP</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" id="identificacion" name="identificacion" value="<?php echo htmlspecialchars($identificacion); ?>">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for="placa">Empresa</label><hr>
                                    <input type="text" id="placa" name="placa" value="<?php echo htmlspecialchars($placa); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="ARL">ARL</label><hr>
                                    <input type="text" id="ARL" name="ARL" value = "<?php echo htmlspecialchars($ARL); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha</label><hr>
                                    <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="hora_entrada">Hora de entrada</label><hr>
                                    <input type="time" id="hora_entrada" name="hora_entrada" value="<?php echo htmlspecialchars($hora); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="hora_salida">Hora de salida</label><hr>
                                    <input type="time" id="hora_salida" name="hora_salida">
                                </div>
                                <div class="form-group">
                                    <label for="añadirEvidencia">Añadir evidencia</label><hr>
                                    <button type="button" id="añadirEvidencia" class="btn btn-img">
                                        
                                        Añadir evidencia
                                    </button>
                                </div>
                            </div> <div class="signature-section">
                                <div class="motivo-section">
                                    <label for="cuadroTexto">Motivo</label>
                                    <textarea name="cuadroTexto" id="cuadroTexto" rows="4"></textarea>
                                </div>
                                
                                <div class="signature-duo">
                                    <div class="signature-block">
                                        <label for="signature-pad-usuario">Firma de usuario:</label>
                                        <div class="signature-pad-wrap">
                                            <canvas id="signature-pad-usuario" aria-label="Área para firma de usuario"></canvas>
                                        </div>
                                        <div class="signature-controls">
                                            <button type="button" id="clear-signature-usuario" class="btn btn-exit">Borrar firma</button>
                                            <input type="hidden" name="signature-usuario" id="signature-data-usuario">
                                        </div>
                                    </div>
                                    <div class="signature-block">
                                        <label for="signature-pad-responsable">Firma de responsable:</label>
                                        <div class="signature-pad-wrap">
                                            <canvas id="signature-pad-responsable" aria-label="Área para firma de responsable"></canvas>
                                        </div>
                                        <div class="signature-controls">
                                            <button type="button" id="clear-signature-responsable" class="btn btn-exit">Borrar firma</button>
                                            <input type="hidden" name="signature-responsable" id="signature-data-responsable">
                                        </div>
                                    </div>
                                </div>
                                
                                <div style="display: flex; justify-content: center; margin-top: 24px; width: 100%; max-width: 400px;">
                                    <button type="button" id="addsignature" class="btn btn-entry">Finalizar formulario</button>
                                </div>
                            </div> <div class="form-row">
                                <label class="checkbox-label">
                                    <input type="checkbox" id="acepto" name="acepto" required>
                                    Acepto el descargo de responsabilidad y las políticas de seguridad.
                                </label>
                            </div>

                        </div> </form>
                </section>
            </main>
        </div>
    </div>

    <div id="contendorMensajes">
        </div>

    <script type="module" src="controller/js/menssageController.js"></script>
    <script type="module" src="controller/js/canvasController.js"></script>
    <script type="module" src="controller/js/botones.js"></script>
    <script type="module" src="controller/js/main.js"></script>
</body>
</html>
