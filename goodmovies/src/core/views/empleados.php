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
    <link rel="stylesheet" href="../../public/css/usuariosAdmin.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/modal.css">
    <link rel="stylesheet" href="../../public/libs/line-awesome/css/line-awesome.css">
</head>

<body>
    <?php 
    include 'template.php'; 


        
    include('../../config/conexion.php');


    $sqlTotalUsuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios WHERE rol='empleado'";
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
                <small>Empleados / Panel</small>
            </div>

            <div class="page-content">

                <div class="analytics">

                    <!-- consulta para la tarjetas  -->
            <?php
            $sql = "SELECT COUNT(*) AS total_usuarios FROM usuarios WHERE rol='empleado'";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total_usuarios = $row["total_usuarios"];
            } else {
                $total_usuarios = 0;
            }

            // Consulta para la tarjeta de usuarios activos
            $sqlUsuariosActivos = "SELECT COUNT(*) AS total_usuarios_activos FROM usuarios WHERE estado = 1 AND rol='empleado'";
            $resultUsuariosActivos = $conexion->query($sqlUsuariosActivos);

            if (!$resultUsuariosActivos) {
                die("Error en la consulta de usuarios activos: " . mysqli_error($conexion));
            }

            $total_usuarios_activos = 0;

            if ($resultUsuariosActivos) {
                $row = $resultUsuariosActivos->fetch_assoc();
                $total_usuarios_activos = $row["total_usuarios_activos"];
            }

            // Consulta para la tarjeta de usuarios inactivos
            $sqlUsuariosInactivos = "SELECT COUNT(*) AS total_usuarios_inactivos FROM usuarios WHERE estado = 0 AND rol='empleado'";
            $resultUsuariosInactivos = $conexion->query($sqlUsuariosInactivos);

            $total_usuarios_inactivos = 0; 

            if ($resultUsuariosInactivos) {
                $row = $resultUsuariosInactivos->fetch_assoc();
                $total_usuarios_inactivos = $row["total_usuarios_inactivos"];
            }


            // Consulta SQL para obtener el promedio de suscripción semanal
            $sqlPromedioSemanal = "SELECT COUNT(*) AS total_usuarios, WEEK(fyh_creacion) AS semana
            FROM usuarios WHERE rol='empleado'
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
                            <small>Cantidad de Empleados</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo number_format($promedioSemanal, 2); ?> Empleados/semana</h2>
                            <span class="las la-eye"></span>
                        </div>
                        <div class="card-progress">
                            <small>Promedio de empleados semanal</small>
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
                            <small>Empleados activos</small>
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
                            <small>Empleados inactivos</small>
                            <div class="card-indicator">
                                <div class="indicator four" style="width: <?php echo ($total_usuarios_inactivos / $total_usuarios) * 100; ?>%"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="content-2">
                    <div class="recent-payments">
                        <div class="title">
                            <h2>Empleados</h2>
                            <div class="add">

                                <div class="estado">
                                    <span for="filtro-estado" >Filtrar por estado:</span>
                                    <select id="filtro-estado">
                                        <option value="todos">Todos</option>
                                        <option value="activos">Activos</option>
                                        <option value="inactivos">Inactivos</option>
                                    </select>
                            
                                    <button id="openModalButton">Agregar registro</button>
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
                    
                        <table class="tabla-admin" >
                            <thead>
                                <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>">
                                    <th>ID</th>
                                    <th>USUARIO</th>
                                    
                                    <th>FECHA-REGISTRO</th>
                                    <th>ESTADO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>

                            <?php
                            
                            

                            function generarFilaAdmin($fila)
                            {
                                ?>
                                <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>" data-usuario-id="<?php echo $fila['IDuSUARIO']; ?>">
                                    <td>
                                        <?php echo $fila['IDuSUARIO']; ?>
                                    </td>
                                    <td>
                                        <div class="client">
                                            <div class="client-info">
                                                <h4>
                                                    <?php echo $fila['nombres'] . ' ' . $fila['apellidos']; ?>
                                                </h4>
                                                <small>
                                                    <?php echo $fila['correo']; ?>
                                                </small>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="rol">
                                            <h4></h4>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fecha">
                                            <?php echo $fila['fyh_creacion']; ?>
                                        </div>
                                    </td>
                                    <td>
                                    <td>
                                        <div class="estado">
                                            <?php
                                            if ($fila['estado'] == 1) {
                                                echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=0&page=empleados.php" class="btn btn-success">Activo</a></p>';
                                            } else {
                                                echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=1&page=empleados.php" class="btn btn-danger">Inactivo</a></p>';
                                            }
                                            ?>
                                        </div>
                                    </td>

                                    <div class="actions">
                                        <span class="las la-edit" data-user-id="<?php echo $fila['IDuSUARIO']; ?>"></span>
                                        <span class="las la-trash" data-id="<?php echo $fila['IDuSUARIO']; ?>"></span>

                                    </div>
                                    </td>
                                </tr>

                                <?php
                            }

                            $sqlTodos = "SELECT IDuSUARIO, nombres, apellidos, correo, estado, rol, fyh_creacion FROM usuarios WHERE rol='empleado' ";
                            $resultadoTodos = $conexion->query($sqlTodos);
                            ?>

                            <!-- tbody de todos -->
                            <tbody class="todos" id="todos">
                                <?php
                                while ($fila = $resultadoTodos->fetch_assoc()) {
                                    
                                    ?>
                                    <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>" data-usuario-id="<?php echo $fila['IDuSUARIO']; ?>">
                                        <td>
                                            <?php echo $fila['IDuSUARIO']; ?>
                                        </td>
                                        <td>
                                            <div class="client">
                                                <div class="client-info">
                                                    <h4>
                                                        <?php echo $fila['nombres'] . ' ' . $fila['apellidos']; ?>
                                                    </h4>
                                                    <small>
                                                        <?php echo $fila['correo']; ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="fecha">
                                                <?php echo $fila['fyh_creacion']; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="estado">
                                            <?php
                                            if ($fila['estado'] == 1) {
                                                echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=0&page=empleados.php" class="btn btn-success">Activo</a></p>';
                                            } else {
                                                echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=1&page=empleados.php" class="btn btn-danger">Inactivo</a></p>';
                                            }
                                            ?>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="actions">
                                                <span class="las la-edit" data-user-id="<?php echo $fila['IDuSUARIO']; ?>"></span>
                                                <span class="las la-trash" data-id="<?php echo $fila['IDuSUARIO']; ?>"></span>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <!-- tbody de full -->
                            <tbody class="full" id="activos" style="display: none;">
                                <?php
                                $sqlAdministradorFull = "SELECT IDuSUARIO, nombres, apellidos, correo, estado, rol, fyh_creacion FROM usuarios WHERE estado = 1 AND rol='empleado'";
                                $resultadoAministradorFull = $conexion->query($sqlAdministradorFull);

                                while ($fila = $resultadoAministradorFull->fetch_assoc()) {
                                    
                                    ?>
                                    <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>" data-usuario-id="<?php echo $fila['IDuSUARIO']; ?>">
                                        <td>
                                            <?php echo $fila['IDuSUARIO']; ?>
                                        </td>
                                        <td>
                                            <div class="client">
                                                <div class="client-info">
                                                    <h4>
                                                        <?php echo $fila['nombres'] . ' ' . $fila['apellidos']; ?>
                                                    </h4>
                                                    <small>
                                                        <?php echo $fila['correo']; ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>


                                        <td>
                                            <div class="fecha">
                                                <?php echo $fila['fyh_creacion']; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="estado">
                                            <?php
                                            if ($fila['estado'] == 1) {
                                                echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=0&page=empleados.php" class="btn btn-success">Activo</a></p>';
                                            } else {
                                                echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=1&page=empleados.php" class="btn btn-danger">Inactivo</a></p>';
                                            }
                                            ?>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="actions">
                                                <span class="las la-edit" data-user-id="<?php echo $fila['IDuSUARIO']; ?>"></span>
                                                <span class="las la-trash" data-id="<?php echo $fila['IDuSUARIO']; ?>"></span>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tbody class="full" id="inactivos" style="display: none;">
                                <?php
                                $sqlAdministradorFull = "SELECT IDuSUARIO, nombres, apellidos, correo, estado, rol, fyh_creacion FROM usuarios WHERE estado = 0 AND rol='empleado'";
                                $resultadoAministradorFull = $conexion->query($sqlAdministradorFull);

                                while ($fila = $resultadoAministradorFull->fetch_assoc()) {
                                    
                                    ?>
                                    <tr data-estado="<?php echo ($fila['estado'] == 1 ? 'activo' : 'inactivo'); ?>" data-usuario-id="<?php echo $fila['IDuSUARIO']; ?>">
                                        <td>
                                            <?php echo $fila['IDuSUARIO']; ?>
                                        </td>
                                        <td>
                                            <div class="client">
                                                <div class="client-info">
                                                    <h4>
                                                        <?php echo $fila['nombres'] . ' ' . $fila['apellidos']; ?>
                                                    </h4>
                                                    <small>
                                                        <?php echo $fila['correo']; ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>


                                        <td>
                                            <div class="fecha">
                                                <?php echo $fila['fyh_creacion']; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="estado">
                                            <?php
                                            if ($fila['estado'] == 1) {
                                                echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=0&page=empleados.php" class="btn btn-success">Activo</a></p>';
                                            } else {
                                                echo '<p><a href="../models/estado.php?tabla=usuarios&IDuSUARIO=' . $fila['IDuSUARIO'] . '&estado=1&page=empleados.php" class="btn btn-danger">Inactivo</a></p>';
                                            }
                                            ?>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="actions">
                                                <span class="las la-edit" data-user-id="<?php echo $fila['IDuSUARIO']; ?>"></span>
                                                <span class="las la-trash" data-id="<?php echo $fila['IDuSUARIO']; ?>"></span>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    
                    </div>

                </div>

            </div>

            <div class="container-modal active">
                <div class="v--modal-box v--modal">
                    <h4 class="modal-title">Agregar Empleados</h4>
                    <p class="text-center">Rectifica los datos</p>

                    <form id="formAdmin" method="post" action="../models/guardar_administrador.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input required type="text" name="nombres" placeholder="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Apellido</label>
                            <input required type="text" name="apellidos" placeholder="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input required type="email" name="correo" placeholder="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Contraseña predeterminada: 123</label>
                        </div>

                        <div class="form-group">
                            <label class="estado" for="">Estado: </label>
                            <select name="estado" id="">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="modal-submit btn btn-block btn-primary">Guardar
                                empleado</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="container-modal-edit">
                <div class="v--modal-box-edit v--modal-edit">
                    <h4 class="modal-title">Editar empleado</h4>
                    <form id="formAdmin-edit" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" id="nombre-edit" name="nombre-edit" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Apellido</label>
                            <input type="text" id="apellido-edit" name="apellido-edit" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" id="correo-edit" name="correo-edit" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Una vez se actualicen los cambios del empleado la contraseña predeterminada de este sera: 456</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="guardarCambios" class="modal-submit btn btn-block btn-primary">Editar empleado</button>
                        </div>
                    </form>
                </div>
            </div>

            


            <div class="modal-background active"></div>


        </main>
    </div>

    <script src="../controllers/funcionTabla.js"></script>
    <script src="../controllers/actualizarEmpleado.js"></script>
    <script  src="../controllers/mensajeRegistroEmpleado.js"></script>
    <script  src="../controllers/eliminarEmpleado.js"></script>
</body>

</html>