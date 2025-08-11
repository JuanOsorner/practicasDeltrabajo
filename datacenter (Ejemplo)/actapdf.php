<?php

require 'vendor/autoload.php'; // Asegúrate de que esta línea apunte correctamente a tu autoloader

use Dompdf\Dompdf;
use Dompdf\Options;

// Inicializa dompdf
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$servername = "localhost";
$username = "userdatacenter";
$password = "adpq8PzWqDsz!gU";
$dbname = "datacenter";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el número de documento desde la URL
$numero_documento = $_GET['numero_documento'];

// Consulta SQL para obtener el último registro con ese número de documento
$sql = "SELECT *
        FROM formulario_registro 
        WHERE numero_documento = '$numero_documento' 
        ORDER BY id DESC 
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos del último registro
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $valorid = $id;
    $nombre = $row['nombre'];
    $tipo_documento = $row['tipo_documento'];
    $tipo_usuario = $row['tipo_usuario'];
    $correo = $row['correo'];
    $empresa = $row['empresa'];
    $nombre_rack = $row['nombre_rack'];
    $actividad = $row['actividad'];
    $fecha = $row['fecha'];
    $observacion = $row['observacion'];
    $firma = $row['firma'];
} else {
    echo "No se encontraron registros para el número de documento: $numero_documento";
}

if ($id < 100) {
    $valorid = '00' . $id;
} elseif ($id < 1000) {
    $valorid = '0' . $id;
} else {
    $valorid = $id;
}


// Carga el contenido HTML
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargo de Responsabilidad - Ingreso a Datacenter</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    h1, h2 {
        text-align: center;
    }
    .header, .content {
        margin-bottom: 20px;
    }
    .table-container {
        width: 100%;
        margin: 0 auto;
        padding: 0;
    }
    .table-container table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0; /* Eliminar margen inferior de las tablas */
    }
    .table-container td {
        padding: 5px; /* Ajusta el padding según sea necesario */
    }
    .section {
        margin-top: 10px; /* Reduce el margen superior entre secciones */
        text-align: center;
    }
    .section-title {
        font-weight: bold;
        margin-top: 10px; /* Ajusta según tus necesidades */
        font-size: 18px;
    }
    .signatures {
        margin-top: 50px;
        text-align: center;
    }
    .signature-line {
        margin-top: 60px;
        text-align: center;
    }
    .signature-line span {
        border-top: 1px solid #000;
        display: inline-block;
        width: 300px;
        text-align: center;
    }
</style>
</head>
<body>

    <div class="table-container" style="font-size: 10px;">
        <table>
            <tr>
                <!-- Imagen centrada -->
                <td style="vertical-align: middle; text-align: center; width: 20%;">
                    <img src="https://media.licdn.com/dms/image/v2/C4E0BAQEDdMh-3SX52Q/company-logo_200_200/company-logo_200_200/0/1631374215338/jolifoods_logo?e=2147483647&v=beta&t=EZjP7jHZojIaeb7aTE9Ytm6CMHkt1PsAzJTq4GJNoKk" alt="Jolifoods Logo" style="max-width: 100px; height: auto;">
                </td>
                <!-- Título centrado -->
                <td style="vertical-align: middle; text-align: center; width: 60%;">
                    <div class="section-title">DESCARGO DE RESPONSABILIDAD</div>
                </td>
                <!-- Texto centrado -->
                <td style="vertical-align: middle; text-align: center; width: 20%; font-size: 14px;">
                    <strong style="font-size: 90%;">FR-PTIC-08</strong><br>
                    <strong style="font-size: 80%;">Edición 02</strong><br>
                    <strong style="font-size: 70%;">Vigente desde 10-10-2024</strong>
                </td>
            </tr>
        </table>
    </div>

    <center><h1>Acta No.'.$valorid.'</h1></center>

    <div class="section">
        <div class="section-title">Datos del Visitante</div>
    </div>

    <br>

    <div class="table-container" style="font-size: 12px; width: 100%;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="vertical-align: top;"><strong>Nombre:</strong></td>
                <td style="vertical-align: top;"><strong>Tipo de Documento:</strong></td>
                <td style="vertical-align: top;"><strong>Tipo de Usuario:</strong></td> 
            </tr>
            <tr>
                <td style="vertical-align: top;">' . htmlspecialchars(ucwords(strtolower($nombre))) . '</td>
                <td style="vertical-align: top;">' . htmlspecialchars($tipo_documento) . '</td>
                <td style="vertical-align: top;">' . htmlspecialchars($tipo_usuario) . '</td>
            </tr>
            <tr>
                <td style="vertical-align: top;"><strong>Correo Electrónico:</strong></td>
                <td style="vertical-align: top;"><strong>No. de Documento:</strong></td>
                <td style="vertical-align: top;"><strong>Empresa:</strong></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">' . htmlspecialchars($correo) . '</td>
                <td style="vertical-align: top;">' . htmlspecialchars($numero_documento) . '</td>
                <td style="vertical-align: top;">' . htmlspecialchars($empresa) . '</td>
            </tr>
            <tr>
                <td style="vertical-align: top;"><strong>Nombre del Rack:</strong></td>
                <td style="vertical-align: top;"><strong>Actividad:</strong></td>
                <td style="vertical-align: top;"><strong>Fecha:</strong></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">' . htmlspecialchars($nombre_rack) . '</td>
                <td style="vertical-align: top;">' . htmlspecialchars($actividad) . '</td>
                <td style="vertical-align: top;">' . htmlspecialchars($fecha) . '</td>
            </tr>
            <tr>
                <td colspan="6" style="vertical-align: top;"><strong>Observación:</strong></td>
            </tr>
            <tr>
                <td colspan="6" style="vertical-align: top;">' . htmlspecialchars($observacion) . '</td>
            </tr>
        </table>
    </div>
    
    <div class="section">

        <p style="text-align: center; font-weight: bold;">CONDICIONES DE ACCESO DATA CENTER DE JOLI FOODS S.A.S.</p>
        <p style="text-align: left;">Este documento establece los requisitos, obligaciones y restricciones que deben cumplir los visitantes o contratistas para acceder y permanecer en el Data Center de JOLI FOODS S.A.S. La firma de este documento implica la aceptación de los términos y condiciones aquí descritos, y libera a JOLI FOODS S.A.S de cualquier responsabilidad derivada de incidentes, daños o perjuicios que puedan ocurrir durante la visita.</p>
    
        <p style="text-align: center; font-weight: bold;">1. OBJETO DEL DOCUMENTO</p>
        <p style="text-align: left;">El propósito de este documento es definir las políticas y normativas de seguridad que regulan el acceso de visitantes o contratistas al Data Center de JOLI FOODS S.A.S. Estas directrices buscan proteger la integridad de la infraestructura tecnológica, los sistemas críticos y los datos almacenados en el Data Center, garantizando su confidencialidad, integridad y disponibilidad, adicional que cualquier interacción se realice bajo condiciones controladas y seguras, en conformidad con los estándares de seguridad corporativos y las leyes aplicables. </p>
    
        <p style="text-align: center; font-weight: bold;">2. DECLARACIONES</p>
        <p style="text-align: left;">2.1. El visitante declara haber sido informado sobre las normas de seguridad, procedimientos de emergencia y las condiciones bajo las cuales se permite su acceso al Data Center.</p>
        <p style="text-align: left;">2.2. El visitante reconoce que el Data Center contiene infraestructura crítica para el funcionamiento de JOLI FOODS S.A.S, y que cualquier daño o alteración puede tener consecuencias graves tanto para la empresa como para sus clientes.</p>
        <p style="text-align: left;">2.3. El visitante se compromete a no realizar ninguna acción que pueda comprometer la seguridad, confidencialidad, integridad, disponibilidad o funcionamiento de los equipos, sistemas o datos alojados en el Data Center.</p>
    
        <p style="text-align: center; font-weight: bold;">3. NORMAS DE ACCESO Y PERMANENCIA</p>
        <p style="text-align: left;">3.1. El acceso al Data Center se limitará a las áreas para las cuales el visitante haya recibido autorización previa.</p>
        <p style="text-align: left;">3.2. Durante su permanencia en el Data Center, el visitante deberá estar acompañado en todo momento por personal autorizado de JOLI FOODS S.A.S.</p>
        <p style="text-align: left;">3.3. Se prohíbe estrictamente:</p>
        <ul style="text-align: left;">
            <li>Utilizar dispositivos electrónicos no autorizados dentro del Data Center.</li>
            <li>Tomar fotografías o grabar videos sin autorización previa y por escrito.</li>
            <li>Alterar, mover, sacar del Data Center o desconectar cualquier equipo sin la debida autorización del personal autorizado por JOLI FOODS S.A.S.</li>
            <li>Ingresar con alimentos, bebidas o cualquier sustancia que pueda representar un riesgo para los equipos o sistemas.</li>
        </ul>
    
        <p style="text-align: center; font-weight: bold;">4. RESPONSABILIDAD</p>
        <p style="text-align: left;">4.1. JOLI FOODS S.A.S no será responsable por ningún daño o pérdida que sufra el visitante durante su ingreso o permanencia en el Data Center, salvo en casos de negligencia grave o dolo demostrable por parte de JOLI FOODS S.A.S.</p>
        <p style="text-align: left;">4.2. El visitante asume total responsabilidad por cualquier daño que cause a los equipos, sistemas o instalaciones del Data Center, ya sea por acción directa, negligencia o incumplimiento de las normas de seguridad.</p>
        <p style="text-align: left;">4.3. En caso de que el visitante cause un daño que interrumpa el servicio o afecte a terceros, se compromete a indemnizar a JOLI FOODS S.A.S por los costos, pérdidas y perjuicios resultantes.</p>
    
        <p style="text-align: center; font-weight: bold;">5. CONFIDENCIALIDAD</p>
        <p style="text-align: left;">5.1. El visitante se compromete a mantener la confidencialidad de cualquier información a la que tenga acceso durante su estancia en el Data Center. Esto incluye, pero no se limita a, información técnica, operativa, financiera o relacionada con clientes.</p>
        <p style="text-align: left;">5.2. La obligación de confidencialidad subsistirá aún después de finalizado el acceso al Data Center y no se verá afectada por la terminación de la relación laboral, contractual o cualquier otra relación con JOLI FOODS S.A.S.</p>
    
        <p style="text-align: center; font-weight: bold;">6. TERMINACIÓN DEL ACCESO</p>
        <p style="text-align: left;">JOLI FOODS S.A.S se reserva el derecho de revocar el acceso al Data Center en cualquier momento y sin previo aviso, en caso de que el visitante incumpla alguna de las condiciones aquí establecidas o si considera que existe una razón justificada para dicha revocación.</p>
    
        <p style="text-align: center; font-weight: bold;">7. ACEPTACIÓN</p>
        <p style="text-align: left;">Al firmar el presente documento, el visitante declara haber leído, comprendido y aceptado todos los términos y condiciones establecidos.</p>
    </div>
    
    <div class="signatures">
        <p>Firmado en aceptación:</p>

        ' . (!empty($firma) ? '
        <div class="signature">
            <p><strong>Firma:</strong></p>
            <img src="' . htmlspecialchars($firma) . '" width="250" />
        </div>' : '') . '
        <div class="signature-line" style="margin-top: 25px;">
            
            <span></span>
            <br>
            <b>Nombre visitante:</b>
            <br>
            '. ucwords(strtolower($nombre)) .'
        </div>
    </div>
</body>
</html>';

$dompdf->loadHtml($html);

// (Opcional) Configura el tamaño y orientación de la página
$dompdf->setPaper('A4', 'portrait');

// Renderiza el HTML a PDF
$dompdf->render();

// Genera el nombre del archivo PDF
$filename = $valorid.' - Ingreso_Datacenter.pdf';

// Guarda el archivo PDF en la carpeta 'pdf' en /var/www/html
$pdfPath = '/var/www/html/pdf/' . $filename;
file_put_contents($pdfPath, $dompdf->output());


// Forzar la descarga del PDF en el navegador
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'. $filename .'"');
echo $dompdf->output();
?>