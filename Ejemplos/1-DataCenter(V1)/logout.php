<?php
session_start(); // Iniciar la sesión

// Destruir la sesión
session_destroy();

// Redirigir al login
header("Location: index.php");
exit();
?>
