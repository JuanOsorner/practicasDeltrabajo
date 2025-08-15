<?php
$servername = "localhost";
$username = "userdatacenter";
$password = "adpq8PzWqDsz!gU";
$dbname = "datacenter";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Conexión fallida: " . $conn->connect_error]);
    exit;
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$tipo_documento = $_POST['tipo_documento'];
$tipo_usuario = $_POST['tipo_usuario'];
$correo = $_POST['correo'];
$numero_documento = $_POST['numero_documento'];
$empresa = $_POST['empresa'];
$nombre_rack = $_POST['nombre_rack'];
$actividad = $_POST['actividad'];
$fecha = $_POST['fecha'];
$observacion = $_POST['observacion'];
$firma = $_POST['firma']; // Firma en base64

// Preparar la consulta para insertar datos en la base de datos
$sql = "INSERT INTO formulario_registro (nombre, tipo_documento, tipo_usuario, numero_documento, correo, empresa, nombre_rack, actividad, fecha, observacion, firma)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssssssss', $nombre, $tipo_documento, $tipo_usuario, $numero_documento, $correo, $empresa, $nombre_rack, $actividad, $fecha, $observacion, $firma);

// Ejecutar la consulta y verificar el resultado
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Datos guardados correctamente."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al guardar los datos: " . $stmt->error]);
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
