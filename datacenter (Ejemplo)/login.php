<?php
session_start();

// Parámetros de conexión
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

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Inicializar respuesta
$response = ["status" => "error", "message" => ""];

// Verificar que el usuario y la contraseña no estén vacíos
if (!empty($usuario) && !empty($contrasena)) {
    // Consulta para verificar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña (asumimos que está hasheada con password_hash)
        if (password_verify($contrasena, $row['contrasena'])) {
            // Autenticación exitosa, guardar sesión
            $_SESSION['usuario'] = $usuario;
            $response["status"] = "success";
            $response["redirect"] = "dashboard.php";
        } else {
            $response["message"] = "Usuario o contraseña incorrectos";
        }
    } else {
        $response["message"] = "Usuario o contraseña incorrectos";
    }
} else {
    $response["message"] = "Por favor, complete todos los campos.";
}

// Devolver respuesta en formato JSON
echo json_encode($response);

$conn->close();
?>
