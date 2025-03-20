<?php
//seguridad
session_start();
$varsesion=$_SESSION['correo'];
if($varsesion==null || $varsesion=''){
    // echo 'NO TIENE ACCESO';
    header("location:../../../index.php");
    // echo 'NO TIENE ACCESO';
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>GOODMOVIES</title>
    <link rel="icon" href="../../public/img/logo/logoGM.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/libs/line-awesome/css/line-awesome.css">
    <link rel="stylesheet" href="../../public/css/style.css">
</head> 

<body class="body">
    <?php 
    include 'template.php'; 
    
        
    include("../../config/conexion.php");

    $sqlTotalUsuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios WHERE rol='cliente'";
    $resultadoTotalUsuarios = $conexion->query($sqlTotalUsuarios);

    if ($resultadoTotalUsuarios) {
        $filaTotalUsuarios = $resultadoTotalUsuarios->fetch_assoc();
        $totalUsuarios = $filaTotalUsuarios['total_usuarios'];
    } else {
        // Manejar el error si la consulta no se ejecuta correctamente
        $totalUsuarios = 0; // Valor predeterminado si hay un error
    }

    ?>

    <input type="checkbox" id="menu-toggle">

    <div class="main-content">
        
        <main>
            
            <div class="page-header">
                <h1>Panel administrativo</h1>
                <small>Clientes / Panel</small>
            </div>
            
            <div class="page-content">
            
                <div class="analytics">

                <?php
                    // Consulta para el total de usuarios
                    $sqlTotalUsuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios WHERE rol='cliente'";
                    $resultTotalUsuarios = $conexion->query($sqlTotalUsuarios);

                    $total_usuarios = 0;

                    if ($resultTotalUsuarios) {
                        $row = $resultTotalUsuarios->fetch_assoc();
                        $total_usuarios = $row["total_usuarios"];
                    } else {
                        die("Error en la consulta de total de usuarios: " . mysqli_error($conexion));
                    }

                    // Consulta para usuarios activos
                    $sqlUsuariosActivos = "SELECT COUNT(*) AS total_usuarios_activos FROM usuarios WHERE estado = 1 AND rol='cliente'";
                    $resultUsuariosActivos = $conexion->query($sqlUsuariosActivos);

                    $total_usuarios_activos = 0;

                    if ($resultUsuariosActivos) {
                        $row = $resultUsuariosActivos->fetch_assoc();
                        $total_usuarios_activos = $row["total_usuarios_activos"];
                    } else {
                        die("Error en la consulta de usuarios activos: " . mysqli_error($conexion));
                    }

                    // Consulta para usuarios inactivos
                    $sqlUsuariosInactivos = "SELECT COUNT(*) AS total_usuarios_inactivos FROM usuarios WHERE estado = 0 AND rol='cliente'";
                    $resultUsuariosInactivos = $conexion->query($sqlUsuariosInactivos);

                    $total_usuarios_inactivos = 0;

                    if ($resultUsuariosInactivos) {
                        $row = $resultUsuariosInactivos->fetch_assoc();
                        $total_usuarios_inactivos = $row["total_usuarios_inactivos"];
                    } else {
                        die("Error en la consulta de usuarios inactivos: " . mysqli_error($conexion));
                    }




                // Consulta SQL para obtener el promedio de suscripción semanal
                $sqlPromedioSemanal = "SELECT COUNT(*) AS total_usuarios, WEEK(fyh_creacion) AS semana
                FROM usuarios WHERE rol='cliente'
                GROUP BY semana";

                $resultadoPromedioSemanal = $conexion->query($sqlPromedioSemanal);

                if ($resultadoPromedioSemanal) {
                $totalSemanas = 0;
                $totalUsuarios = 0;

                while ($fila = $resultadoPromedioSemanal->fetch_assoc()) {
                $totalSemanas++;
                $totalUsuarios += $fila['total_usuarios'];
                }

                $promedioSemanal = ($totalSemanas > 0) ? ($totalUsuarios / ($totalSemanas * 7)) : 0;

                } else {
                // Manejar el error si la consulta no se ejecuta correctamente
                $promedioSemanal = 0; 
                }           

            
                ?>

                        <div class="card">
                            <div class="card-head">
                            <h2><?php  echo $total_usuarios;?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>Cantidad de clientes</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo number_format($promedioSemanal, 2); ?> usuarios/semana</h2>
                            <span class="las la-eye"></span>
                        </div>
                        <div class="card-progress">
                            <small>Promedio de suscripción semanal</small>
                            <div class="card-indicator">
                                <div class="indicator two" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $total_usuarios_activos; ?></h2>
                            <span class="las la-grin-alt"></span>
                        </div>
                        <div class="card-progress">
                            <small>Clientes activos</small>
                            <div class="card-indicator">
                                <div class="indicator three" style="width: <?php echo ($total_usuarios_activos / $total_usuarios) * 100; ?>%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $total_usuarios_inactivos; ?></h2>
                            <span class="las la-frown"></span>
                        </div>
                        <div class="card-progress">
                            <small>Clientes inactivos</small>
                            <div class="card-indicator">
                                <div class="indicator four" style="width: <?php echo ($total_usuarios_inactivos / $total_usuarios) * 100; ?>%"></div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="records table-responsive">

                    <div class="record-header">
                        <div class="add">

                            <div  class="estado">
                                <span for="filtro-estado"  ></span>
                                <select id="filtro-estado">
                                    <option value="todos">Todos</option>
                                    <option value="activos">Activos</option>
                                    <option value="inactivos">Inactivos</option>
                                </select>
                            </div>

                            
                        </div>

                        
                    </div> 

                    <div class="pagination" id="paginacion-todos" >
                        <a href="#" class="pagina-anterior-todos">&laquo; Anterior</a>
                        <span id="pagina-actual-todos">Página 1</span>
                        <a href="#" class="pagina-siguiente-todos">Siguiente &raquo;</a>
                        <input type="search" placeholder="Busca por email" class="record-search-todos">
                    </div>

                    <div class="pagination" id="paginacion-activos" >
                        <a href="#" class="pagina-anterior-activos" >&laquo; Anterior</a>
                        <span id="pagina-actual-activos">Página 1</span>
                        <a href="#" class="pagina-siguiente-activos">Siguiente &raquo;</a>
                        
                    </div>

                    <div class="pagination" id="paginacion-inactivos" >
                        <a href="#" class="pagina-anterior-inactivos" >&laquo; Anterior</a>
                        <span id="pagina-actual-inactivos">Página 1</span>
                        <a href="#" class="pagina-siguiente-inactivos">Siguiente &raquo;</a>
                        
                    </div>


                    <div class="table-responsive">
                        <table class="tabla-usuarios" id="tabla-usuarios" width="100%">
                            <thead>
                                <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>">
                                    <th>ID</th>
                                    <th><span class=""></span> CLIENTE</th>
                                    <th><span class=""></span> FECHA DE CREACIÓN</th>
                                    
                                    <th><span class=""></span> ACCIONES</th>
                                </tr>
                            </thead>

                            <?php
                                

                                // Función para generar filas de usuario
                                function generarFilaUsuario($fila)
                                {
                                ?>
                                    <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>" data-usuario-id="<?php echo $fila['IDuSUARIO']; ?>" >
                                        <td><?php echo $fila['IDuSUARIO']; ?></td>
                                        <td>
                                            <div class="client">
                                                <div class="client-info">
                                                    <h4><?php echo $fila['nombres'] . ' ' . $fila['apellidos']; ?></h4>
                                                    <small><?php echo $fila['correo']; ?></small>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <!-- <td>
                                            <div class="estado">
                                                <?php

                                                if ($fila['estado'] == 1) {
                                                    echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=0" class="btn btn-success">Activo</a></p>';
                                                } else {
                                                    echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=1" class="btn btn-danger">Inactivo</a></p>';
                                                }
                                                ?>
                                            </div>
                                        </td> -->
                                        <td>
                                            <div class="fecha">
                                                <?php echo $fila['fyh_creacion']; ?>
                                            </div>
                                        </td>
                                        <td>
                                        <button class="btn btn-primary abrir-modal" data-cliente-id="<?php echo $fila['IDuSUARIO']; ?>">
    Ver Detalles del Cliente <?php echo $fila['IDuSUARIO']; ?>
</button>
                                        </td>
                                    </tr>
                                    
                                <?php
                                }
                               
                                ?>


                                <!-- tbody de "todos" -->
                                <tbody class="todos" id="todos">
                                    <?php

                                    // Consulta SQL para cargar todos los usuarios
                                    $sqlTodos = "SELECT IDuSUARIO, nombres, apellidos, correo, estado, fyh_creacion, membresia_inicio, membresia_expiracion FROM usuarios WHERE rol='cliente'";
                                    $resultadoTodos = $conexion->query($sqlTodos); // Ejecución de la consulta

                                    // Muestra los resultados de todos los usuarios utilizando la función
                                    while ($fila = $resultadoTodos->fetch_assoc()) {
                                    ?>
                                        <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>" data-usuario-id="<?php echo $fila['IDuSUARIO']; ?>" >
                                            <td>
                                                <?php echo $fila['IDuSUARIO']; ?>
                                            </td>
                                            <td>
                                                <div class="client">
                                                    <div class="client-info">
                                                        <h4><?php echo $fila['nombres'] . ' ' . $fila['apellidos']; ?></h4>
                                                        <small><?php echo $fila['correo']; ?></small>
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- <td>
                                                <div class="estado">
                                                <?php

                                                if ($fila['estado'] == 1) {
                                                    echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=0" class="btn btn-success">Activo</a></p>';
                                                } else {
                                                    echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=1" class="btn btn-danger">Inactivo</a></p>';
                                                }
                                                ?>
                                                </div>
                                            </td> -->
                                            <td>
                                                <div class="fecha">
                                                    <?php echo $fila['fyh_creacion']; ?>
                                                </div>
                                            </td>
                                            <td>
                                            <button class="btn btn-primary abrir-modal" data-cliente-id="<?php echo $fila['IDuSUARIO']; ?>">
    Ver Detalles del Cliente <?php echo $fila['IDuSUARIO']; ?>
</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            

                                <!-- tbody de "activos" -->
                                <tbody id="activos" style="display: none;">
                                    <?php
                                    

                                    // Consulta SQL para cargar usuarios activos
                                    $sqlActivos = "SELECT IDuSUARIO, nombres, apellidos, correo, estado, fyh_creacion, membresia_inicio, membresia_expiracion FROM usuarios WHERE estado = 1 AND rol='cliente'";
                                    $resultadoActivos = $conexion->query($sqlActivos); // Ejecución de la consulta

                                    // Muestra los resultados de usuarios activos utilizando la función
                                    while ($fila = $resultadoActivos->fetch_assoc()) {
                                    ?>
                                        <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>" data-usuario-id="<?php echo $fila['IDuSUARIO']; ?>" >
                                            <td><?php echo $fila['IDuSUARIO']; ?></td>
                                            <td>
                                                <div class="client">
                                                    <div class="client-info">
                                                        <h4><?php echo $fila['nombres'] . ' ' . $fila['apellidos']; ?></h4>
                                                        <small><?php echo $fila['correo']; ?></small>
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- <td>
                                                <div class="estado">
                                                <?php

                                                if ($fila['estado'] == 1) {
                                                    echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=0" class="btn btn-success">Activo</a></p>';
                                                } else {
                                                    echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=1" class="btn btn-danger">Inactivo</a></p>';
                                                }
                                                ?>
                                                </div>
                                            </td> -->
                                            <td>
                                                <div class="fecha">
                                                    <?php echo $fila['fyh_creacion']; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                <button class="btn btn-primary abrir-modal" data-cliente-id="<?php echo $fila['IDuSUARIO']; ?>">
    Ver Detalles del Cliente <?php echo $fila['IDuSUARIO']; ?>
</button>
                                            </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                                <!-- tbody de "inactivos" -->
                                <tbody id="inactivos" style="display: none;">
                                    <?php
                                    

                                    // Consulta SQL para cargar usuarios inactivos
                                    $sqlInactivos = "SELECT IDuSUARIO, nombres, apellidos, correo, estado, fyh_creacion, membresia_inicio, membresia_expiracion FROM usuarios WHERE estado = 0 AND rol='cliente'";
                                    $resultadoInactivos = $conexion->query($sqlInactivos); // Ejecución de la consulta

                                    // Muestra los resultados de usuarios inactivos utilizando la función
                                    while ($fila = $resultadoInactivos->fetch_assoc()) {
                                    ?>
                                        <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>" data-usuario-id="<?php echo $fila['IDuSUARIO']; ?>" >
                                            <td><?php echo $fila['IDuSUARIO']; ?></td>
                                            <td>
                                                <div class="client">
                                                    <div class="client-info">
                                                        <h4><?php echo $fila['nombres'] . ' ' . $fila['apellidos']; ?></h4>
                                                        <small><?php echo $fila['correo']; ?></small>
                                                        <h4><?php echo $fila['membresia_inicio'] . ' ' . $fila['membresia_expiracion']; ?></h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- <td>
                                                <div class="estado">
                                                <?php

                                                if ($fila['estado'] == 1) {
                                                    echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=0" class="btn btn-success">Activo</a></p>';
                                                } else {
                                                    echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=1" class="btn btn-danger">Inactivo</a></p>';
                                                }
                                                ?>
                                                </div>
                                            </td> -->
                                            <td>
                                                <div class="fecha">
                                                    <?php echo $fila['fyh_creacion']; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                <button class="btn btn-primary abrir-modal" data-cliente-id="<?php echo $fila['IDuSUARIO']; ?>">
    Ver Detalles del Cliente <?php echo $fila['IDuSUARIO']; ?>
</button>
                                            </div>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>



                        </table>
                        
                    </div>
<!-- Modal -->


                </div>  
                <!-- aqui termina la tabla brrr -->
                
                
            </div>

            
        </main>   
    </div>
<!-- Modal Bootstrap -->
<div class="modal" id="clienteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de compra del Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal se cargará aquí -->
                <div id="modalContentContainer">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script para manejar la apertura del modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Manejar la apertura del modal al hacer clic en el botón
        var abrirModalButtons = document.querySelectorAll('.abrir-modal');
        var modalContentContainer = document.querySelector('#modalContentContainer');

        abrirModalButtons.forEach(function (boton) {
            boton.addEventListener('click', function () {
                // Obtener el ID del cliente desde el atributo de datos
                var clienteId = boton.getAttribute('data-cliente-id');

                // Cargar el contenido del modal utilizando Fetch API
                fetch('../models/consulta_cliente.php?IDuSUARIO=' + clienteId)
                    .then(response => response.text())
                    .then(data => {
                        // Verificar si el contenedor del modal existe antes de asignar el contenido
                        if (modalContentContainer) {
                            // Insertar el contenido en el contenedor del modal
                            modalContentContainer.innerHTML = data;

                            // Mostrar el modal
                            var clienteModal = new bootstrap.Modal(document.getElementById('clienteModal'));
                            clienteModal.show();
                        } else {
                            console.error('No se encontró el contenedor del modal');
                        }
                    })
                    .catch(error => console.error('Error al cargar el contenido del modal:', error));
            });
        });
    });
</script>

    <script>
        var totalUsuarios = <?php echo $totalUsuarios; ?>;
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../controllers/funcionTabla.js"></script>
    
    
</body>
</html>
