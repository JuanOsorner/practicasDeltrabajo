<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redirigir al login
    header("Location: index.php");
    exit();
}

// Conexión a la base de datos
$servername = "localhost";
$username = "userdatacenter";
$password = "adpq8PzWqDsz!gU";
$dbname = "datacenter";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos de la tabla formulario_registro
$sql = "SELECT id, nombre, tipo_documento, tipo_usuario, numero_documento, correo, empresa, nombre_rack, actividad, fecha, observacion, fecha_salida, observacion_salida FROM formulario_registro";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Agregar estilos y scripts de DataTables y Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
</head>
<body>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Bienvenido al Dashboard</h1>
            <!-- Botón de cerrar sesión -->
            <form action="logout.php" method="post" class="mb-0">
                <button type="submit" class="btn btn-danger">Cerrar sesión</button>
            </form>
        </div>
        
        <p>Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>

        <!-- Tabla para mostrar registros -->
        <table id="dataTable" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center align-middle">ID</th>
                    <th class="text-center align-middle">Nombre</th>
                    <th class="text-center align-middle">Tipo Documento</th>
                    <th class="text-center align-middle">Tipo Usuario</th>
                    <th class="text-center align-middle">Número Documento</th>
                    <th class="text-center align-middle">Correo</th>
                    <th class="text-center align-middle">Empresa</th>
                    <th class="text-center align-middle">Nombre Rack</th>
                    <th class="text-center align-middle">Actividad</th>
                    <th class="text-center align-middle">Fecha</th>
                    <th class="text-center align-middle">Observación</th>
                    <th class="text-center align-middle">Fecha Salida</th>
                    <th class="text-center align-middle">Observación Salida</th>
                </tr>
            </thead>

            <tbody>
            <?php
                if ($result->num_rows > 0) {
                // Mostrar cada registro en la tabla
                while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td class='text-center align-middle'>" . htmlspecialchars($row['id']) . "</td>
                <td class='align-middle text-center'>" . htmlspecialchars($row['nombre']) . "</td>
                <td class='align-middle text-center'>" . htmlspecialchars($row['tipo_documento']) . "</td>
                <td class='align-middle text-center'>" . htmlspecialchars($row['tipo_usuario']) . "</td>
                <td class='align-middle text-center'>" . htmlspecialchars($row['numero_documento']) . "</td>
                <td class='align-middle text-center'>" . htmlspecialchars($row['correo']) . "</td>
                <td class='align-middle text-center'>" . htmlspecialchars($row['empresa']) . "</td>
                <td class='align-middle text-center'>" . htmlspecialchars($row['nombre_rack']) . "</td>
                <td class='align-middle text-center'>" . htmlspecialchars($row['actividad']) . "</td>
                <td class='align-middle text-center'>" . htmlspecialchars($row['fecha']) . "</td>
                <td class='align-middle text-center'>
                    <button class='btn btn-info btn-sm' data-observation='" . htmlspecialchars($row['observacion']) . "' onclick='showObservation(\"" . htmlspecialchars($row['observacion']) . "\")'>
                        <i class='fa-regular fa-comment'></i>
                    </button>
                </td>";

            // Mostrar la fecha de salida, si existe
            echo "<td class='align-middle text-center'>";
            if (!empty($row['fecha_salida'])) {
                echo htmlspecialchars($row['fecha_salida']);
            } else {
                echo 'Sin registrar';
            }
            echo "</td>"; // Cierra la celda de fecha de salida
            
            echo "<td class='align-middle text-center'>"; // Cierra la fila antes de la observación salida
            // Verificar si 'observacion_salida' no está vacío antes de mostrar el botón
            if (!empty($row['observacion_salida'])) {
                echo "<button class='btn btn-info btn-sm' data-observation='" . htmlspecialchars($row['observacion_salida']) . "' onclick='showObservation(\"" . htmlspecialchars($row['observacion_salida']) . "\")'>
                        <i class='fa-regular fa-comment'></i>
                    </button>";
            } else {
                echo 'Sin registrar';
            }
            
            echo "</td>        
            </tr>"; // Cierra la celda de observación y la fila
            }
        } else {
            echo "<tr><td colspan='13' class='text-center'>No hay registros disponibles</td></tr>";
        }

// Cerrar conexión
$conn->close();
?>

            </tbody>
        </table>
    </div>

    <script>
        // Inicializar DataTable
        $(document).ready(function() {
            $('#dataTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json' // Cambiar idioma a español
                },
                dom: 'Bfrtip', // Incluir botones en la parte superior de la tabla
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar Excel',
                        className: 'btn btn-success',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    // Si es la columna de observaciones, reemplaza el botón con el texto
                                    if (column === 10) { // Cambia el índice según la posición de la columna de observaciones
                                        return $(node).find('button').data('observation'); // Obtiene el texto del atributo data-observation
                                    } else if (column === 12) { // Para la columna de observación salida
                                        return $(node).find('button').data('observation') || 'Sin registrar'; // Maneja el caso si no hay observación
                                    }
                                    return data; // Retorna el valor original para otras columnas
                                }
                            }
                        }
                    }
                ]
            });
        });

        function showObservation(observation) {
            Swal.fire({
                title: 'Observación',
                text: observation,
                icon: 'info',
                confirmButtonText: 'Cerrar'
            });
        }
    </script>
</body>
</html>
