<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "userdatacenter";
$password = "adpq8PzWqDsz!gU";
$dbname = "datacenter";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Conexión fallida: " . $conn->connect_error]);
    exit;
}

// Obtener datos del formulario
$numero_documento = $_POST['numero_documento'];
$fecha_salida = $_POST['fecha'];
$observacion_salida = $_POST['observacion'];
$firma = $_POST['firma']; // Firma en base64

// Consulta para obtener el último registro con el número de documento específico
$sql = "SELECT id FROM formulario_registro WHERE numero_documento=? ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $numero_documento);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró un registro
if ($result->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "No se encontró ningún registro con el número de documento especificado."]);
    exit;
}

// Obtener el ID del último registro
$ultimo_id = $result->fetch_assoc()['id'];

// Actualizar datos
$sql_update = "UPDATE formulario_registro SET fecha_salida=?, observacion_salida=?, firma_salida=? WHERE id=?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param('ssss', $fecha_salida, $observacion_salida, $firma, $ultimo_id);

// Ejecutar y verificar actualización
if ($stmt_update->execute()) {
    echo json_encode(["status" => "success", "message" => "Operación realizada con éxito."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al actualizar: " . $stmt_update->error]);
}

$stmt_update->close();
$stmt->close();
$conn->close();
?>
