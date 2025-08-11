<?php
// Inicializar variable para el hash
$hashedPassword = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password']; // Obtener la contraseña del formulario
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Generar el hash
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Generador de Hash de Contraseña</h2>
        <form method="post">
            <div class="form-group">
                <label for="password">Ingrese la Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Generar Hash</button>
        </form>

        <?php if (!empty($hashedPassword)): ?>
            <div class="mt-4">
                <h5>Hash de la Contraseña:</h5>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($hashedPassword); ?>" readonly>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
