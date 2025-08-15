<!--Esto es para llamar la libreria-->
<?PHP
require_once __DIR__ . '/library/head.php';
require_once __DIR__ . '/library/menu.php';
?>

<div class="content">
    <div class="center-wrap">
        <main id="main-content" role="main">
            <h2 class="welcome-title">Registro de usuarios al DataCenter</h2>

            <section class="form-card" aria-label="Formulario de registro de usuarios">
                <form id="user-register-form" action="process_register.php" method="post" novalidate>
                    
                    <div class="form-container">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nombre">Nombre Completo</label><hr>
                                <input type="text" id="nombre" name="nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="correo">Correo Electrónico</label><hr>
                                <input type="email" id="correo" name="correo" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="identificacion">Documento de Identificación</label><hr>
                                <table class="tabla-identificacion">
                                    <tr>
                                        <td>
                                            <select id="tipo_documento" name="tipo_documento" class="select-documento">
                                                <option value="CC">CC</option>
                                                <option value="TI">TI</option>
                                                <option value="PP">PP</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" id="identificacion" name="identificacion" placeholder="Número">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono de Contacto</label><hr>
                                <input type="tel" id="telefono" name="telefono">
                            </div>

                            <div class="form-group">
                                <label for="empresa_nombre">Empresa y NIT</label><hr>
                                <select id="empresa_nombre" name="empresa_nombre" style="margin-bottom: 15px;">
                                    <option value="">Seleccione una empresa...</option>
                                    <option value="Jolifoods SAS">Jolifoods SAS</option>
                                    <option value="Proveedor Externo A">Proveedor Externo A</option>
                                    <option value="Proveedor Externo B">Proveedor Externo B</option>
                                </select>
                                <input type="text" id="empresa_nit" name="empresa_nit" placeholder="NIT (si aplica)">
                            </div>
                        </div>

                        <div class="form-button-container">
                            <button type="submit" class="btn btn-entry">Registrar Usuario</button>
                        </div>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>

<script type="module" src="controller/js/main.js"></script>
</body>
</html>