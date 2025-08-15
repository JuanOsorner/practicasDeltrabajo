<?php
// Rutas absolutas y seguras para incluir los archivos
require_once __DIR__ . '/library/head.php';
require_once __DIR__ . '/library/menu.php';
?>

<div class="content">
    <div class="center-wrap">
        <main id="main-content" role="main">
            <h2 class="welcome-title">Proceso de Actividad en DataCenter</h2>

            <section class="form-card" aria-label="Formulario de proceso de actividad">
                <form id="activity-form" action="process_activity.php" method="post" novalidate>
                    <div class="form-container">
                        
                        <div class="form-group">
                            <label for="cuadroTexto">Motivo de la Entrada</label>
                            <hr>
                            <textarea name="cuadroTexto" id="cuadroTexto" rows="4" placeholder="Describa el propósito de su visita..."></textarea>
                        </div>
                        
                        <div class="form-grid" style="gap: 15px; margin-bottom: 30px; text-align: center;">
                            <button type="button" id="btn-modal-herramientas" class="btn btn-img">Registro de Herramientas</button>
                            <button type="button" id="btn-modal-activos" class="btn btn-img">Registro de Activos</button>
                            <button type="button" id="btn-modal-actividades" class="btn btn-img">Registro de Actividades</button>
                        </div>

                        <div class="signature-section">
                            <div class="signature-duo">
                                <div class="signature-block">
                                    <label for="signature-pad-usuario">Firma de Usuario:</label>
                                    <div class="signature-pad-wrap">
                                        <canvas id="signature-pad-usuario"></canvas>
                                    </div>
                                    <div class="signature-controls">
                                        <button type="button" id="clear-signature-usuario" class="btn btn-exit">Borrar</button>
                                    </div>
                                </div>
                                <div class="signature-block">
                                    <label for="signature-pad-acompanante">Firma de Acompañante:</label>
                                    <div class="signature-pad-wrap">
                                        <canvas id="signature-pad-acompanante"></canvas>
                                    </div>
                                    <div class="signature-controls">
                                        <button type="button" id="clear-signature-acompanante" class="btn btn-exit">Borrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-button-container">
                            <button type="submit" class="btn btn-entry">Finalizar Proceso</button>
                        </div>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>

<div id="modal-container"></div>

<script type="module" src="controller/js/canvasController.js"></script>
<script type="module" src="controller/js/main.js"></script>
</body>
</html>