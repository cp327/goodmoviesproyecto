<?php
// Función para obtener detalles del cliente desde la base de datos
function obtenerDetallesCliente($clienteId) {
    include '../../config/conexion.php';
    // Consulta SQL
    $consulta = "SELECT nombres, apellidos, membresia_inicio, membresia_expiracion FROM usuarios WHERE IDuSUARIO = ?";

    // Preparar y ejecutar la consulta con un parámetro
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $clienteId);
    $stmt->execute();

    // Obtener resultados
    $result = $stmt->get_result();

    // Verificar si se obtuvieron resultados
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $detallesCliente = [
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'membresia_inicio' => $row['membresia_inicio'],
                'membresia_expiracion' => $row['membresia_expiracion'],
            ];

            // Verificar si ambas fechas son nulas
            if ($detallesCliente['membresia_inicio'] === null && $detallesCliente['membresia_expiracion'] === null) {
                // Cliente aún no realiza su primera compra
                $detallesCliente['mensaje'] = 'El cliente aún no ha realizado su primera compra.';
            }
        } else {
            // No se encontraron resultados
            $detallesCliente = [];
        }
    } else {
        // Error en la consulta
        die("Error en la consulta: " . $stmt->error);
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();

    return $detallesCliente;
}

// Obtener el clienteId desde la URL
$clienteId = isset($_GET['IDuSUARIO']) ? $_GET['IDuSUARIO'] : null;

// Verificar si se proporciona un clienteId y obtener detalles del cliente
$detallesCliente = [];
if ($clienteId !== null) {
    $detallesCliente = obtenerDetallesCliente($clienteId);
}
?>

<?php if (!empty($detallesCliente)): ?>
    <?php if (isset($detallesCliente['mensaje'])): ?>
        <p><?php echo $detallesCliente['mensaje']; ?></p>
    <?php else: ?>
        <table class="table">
            <tr>
                <th>Fecha de Compra de la Membresía</th>
                <th>Fecha de Expiración de la Membresía</th>
            </tr>
            <tr>
                <td><?php echo $detallesCliente['membresia_inicio']; ?></td>
                <td><?php echo $detallesCliente['membresia_expiracion']; ?></td>
            </tr>
        </table>
    <?php endif; ?>
<?php else: ?>
    <p>No se encontraron resultados para el ID de cliente proporcionado o hay un problema con la base de datos.</p>
<?php endif; ?>
