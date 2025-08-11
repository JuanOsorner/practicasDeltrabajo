<?php
// index.php - Formulario / Descargo (menú vertical morado)
$valorid = $valorid ?? '';
$nombre = $nombre ?? '';
$empresa = $empresa ?? '';
$identificacion = $identificacion ?? '';
$placa = $placa ?? '';
$motivo = $motivo ?? '';
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
    <link rel="stylesheet" href="model/modal.css"> <!-- estilos para futuros modales -->
</head>

<body>
    <!-- Fondo de olas (SVG) -->
    <div id="wave-bg" aria-hidden="true">
        <svg viewBox="0 0 2560 800" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
            <path class="wave wave-1" d="M0,160 C640,260 1280,60 2560,160 L2560,800 L0,800 Z" />
            <path class="wave wave-2" d="M0,260 C640,160 1280,360 2560,260 L2560,800 L0,800 Z" />
            <path class="wave wave-3" d="M0,200 C640,120 1280,300 2560,200 L2560,800 L0,800 Z" />
            <path class="wave wave-4" d="M0,320 C640,220 1280,420 2560,320 L2560,800 L0,800 Z" />
        </svg>
    </div>

    <!-- MENÚ VERTICAL -->
    <nav id="side-nav" aria-label="Navegación principal">
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
            <a class="nav-link small" href="#login">Iniciar sesión</a>
            <small class="nav-copy">© <?php echo date('Y'); ?> Jolifoods SAS</small>
        </div>
    </nav>

    <!-- Content: desplazado por el ancho del side-nav -->
    <div class="content">
        <div class="center-wrap">
            <main id="main-content" role="main" aria-labelledby="welcome-title">
                <div class="welcome-wrap">
                    <h2 id="welcome-title" class="welcome-title">Bienvenido al Data Center de Jolifoods</h2>
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
                                    <label for="nombre">Nombre completo</label> <br> <hr> <br>
                                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="empresa">Empresa / Dependencia</label> <br> <hr> <br>
                                    <input type="text" id="empresa" name="empresa" value="<?php echo htmlspecialchars($empresa); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="identificacion">Tipo y número de identificación</label> <br> <hr> <br>
                                    <input type="text" id="identificacion" name="identificacion" value="<?php echo htmlspecialchars($identificacion); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="placa">Placa vehículo (si aplica)</label> <br> <hr> <br>
                                    <input type="text" id="placa" name="placa" value="<?php echo htmlspecialchars($placa); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="motivo">Motivo de la visita</label> <br> <hr> <br>
                                    <select id="motivo" name="motivo">
                                        <option value="">Seleccione</option>
                                        <option value="mantenimiento" <?php echo ($motivo === 'mantenimiento') ? 'selected' : ''; ?>>Mantenimiento</option>
                                        <option value="soporte" <?php echo ($motivo === 'soporte') ? 'selected' : ''; ?>>Soporte técnico</option>
                                        <option value="inspeccion" <?php echo ($motivo === 'inspeccion') ? 'selected' : ''; ?>>Inspección</option>
                                        <option value="otro" <?php echo ($motivo === 'otro') ? 'selected' : ''; ?>>Otro</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="fecha">Fecha</label> <br> <hr> <br>
                                    <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="hora">Hora</label> <br> <hr> <br>
                                    <input type="time" id="hora" name="hora" value="<?php echo htmlspecialchars($hora); ?>">
                                </div>
                            </div>

                            <div class="signature-section">
                                <label for="signature-pad">Firma (toque o dibuje):</label>
                                <div class="signature-pad-wrap">
                                    <canvas id="signature-pad" width="600" height="160" aria-label="Área para firma"></canvas>
                                </div>
                                <div class="signature-controls">
                                    <button type="button" id="add-signature" class="btn btn-entry">Añadir firma</button>
                                    <button type="button" id="clear-signature" class="btn btn-exit">Borrar firma</button>
                                    <input type="hidden" name="signature" id="signature-data" value="">
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
    <!--Vamos a realizar -->
    <script src="controller/js/controller1.js"></script>
</body>
</html>
