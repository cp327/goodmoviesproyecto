<?php
include("../../config/conexion.php");

// Iniciar sesión
session_start();

// Verificar si se ha enviado el formulario
if (!empty($_POST["entrar"])) {
    // Validar que se han proporcionado datos de correo y contraseña
    if (empty($_POST["correo"]) || empty($_POST["contraseña"])) {
        $_SESSION['mensaje_alerta'] = 'Los campos están vacíos';
    } else {
        // Obtener datos del formulario
        $correo = mysqli_real_escape_string($conexion, $_POST["correo"]);
        $contraseña = mysqli_real_escape_string($conexion, $_POST["contraseña"]);

        // Consulta segura para evitar inyección SQL
        $sql = $conexion->prepare("SELECT IDuSUARIO, correo, contraseña, rol, membresia_expiracion, estado FROM usuarios WHERE correo = ?");
        $sql->bind_param("s", $correo);
        $sql->execute();
        $sql->store_result();

        // Verificar si se encontraron datos en la base de datos
        if ($sql->num_rows > 0) {
            // Obtener datos del usuario
            $sql->bind_result($idUsuario, $correoUsuario, $contraseñaUsuario, $rolUsuario, $membresiaExpiracion, $estadoUsuario);
            $sql->fetch();

            // Verificar la contraseña utilizando password_verify
            if (password_verify($contraseña, $contraseñaUsuario)) {
                // Contraseña válida

                // Verificar el estado del empleado
                if ($estadoUsuario == 0 and $rolUsuario == "empleado") {
                    // El empleado está desactivado, mostrar alerta
                    $_SESSION['mensaje_alerta'] = 'El empleado está desactivado. Comuníquese con el administrador.';
                } else {
                    // Almacenar datos en la sesión
                    $_SESSION['IDuSUARIO'] = $idUsuario;
                    $_SESSION['correo'] = $correoUsuario;
                    $_SESSION['rol'] = $rolUsuario;

                    // Establecer la zona horaria de Colombia
                    date_default_timezone_set('America/Bogota');

                    // Obtener la hora actual en formato colombiano
                    $fechaHoraActual = date('Y-m-d H:i:s');

                    // Redirigir según el rol (opcional)
                    if ($rolUsuario == 'cliente') {
                        // Verificar membresía
                        if ($membresiaExpiracion === null) {
                            // El cliente no tiene membresía
                            header("Location: ../views/compra.php");
                            exit;
                        } elseif ($membresiaExpiracion < $fechaHoraActual) {
                            // La membresía ha expirado
                            header("Location: ../views/compra.php");
                            exit;
                        } else {
                            // Membresía válida, redirigir a home.php
                            header("Location: ../../app/views/home.php");
                            exit;
                        }
                    } elseif ($rolUsuario == 'empleado') {
                        header("Location: ../../admin/views/home.php");
                        exit;
                    } elseif ($rolUsuario == 'admin') {
                        header("Location: ../../core/views/home.php");
                        exit;
                    } else {
                        // Rol no reconocido, manejar según tus necesidades
                        header("Location: ../views/compra.php");
                        exit;
                    }
                }
            } else {
                // Contraseña no válida
                $_SESSION['mensaje_alerta'] = 'Los datos ingresados no son correctos o no existen';
            }
        } else {
            $_SESSION['mensaje_alerta'] = 'Los datos ingresados no son correctos o no existen';
        }

        // Cerrar la consulta
        $sql->close();
    }
}

// Cerrar sesión si se hace clic en "Salir"
if (isset($_GET['salir'])) {
    // Limpiar todas las variables de sesión
    session_unset();

    // Destruir la sesión
    session_destroy();

    // Redirigir al index
    header("Location:../../../index.php");
    exit;
}

// Imprimir script JavaScript para redirigir automáticamente a login.php
echo '<script>
        window.location.href = "../views/login.php";
      </script>';
?>
